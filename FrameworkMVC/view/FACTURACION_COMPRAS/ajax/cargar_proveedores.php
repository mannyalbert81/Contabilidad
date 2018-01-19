<?php
include'../../../core/Conectar.php';
//include'../../../core/EntidadBase.php';




$cn = new Conectar();
$conn = $cn->conexion();

session_start();
  $_id_usuarios= $_SESSION['id_usuarios'];
  
  
  
		if(!$conn)
		{
			die( "No se pudo conectar");
		}

		
		 $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
		 
		   
		  
		  if($action == 'ajax'){
		  
		  	$c =  pg_escape_string($conn,(strip_tags($_REQUEST['c'], ENT_QUOTES)));
		  
		  	if ( $_GET['c'] != "" )
		  	{
		  	
		  	//$q = "codigo_plan_cuentas LIKE '%".$q."%'";
		  	//$q = "nombre_plan_cuentas LIKE '%".$q."%'";
		  	}
		  	
		  
			include 'pagination.php'; 
			//las variables de paginación
			
			
			$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
			$per_page = 10; //la cantidad de registros que desea mostrar
			$adjacents  = 4; //brecha entre páginas después de varios adyacentes
			$offset = ($page - 1) * $per_page;
			
			
			
			
			$count_query   = pg_query($conn,"SELECT count(*) AS numrows FROM public.fc_proveedores WHERE fc_proveedores.id_usuario='$_id_usuarios' AND (fc_proveedores.ruc_proveedores LIKE '%".$c."%' OR fc_proveedores.razon_social_proveedores LIKE '%".$c."%') ");
			
			if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
			$total_pages = ceil($numrows/$per_page);
			$reload = 'index.php';
			//consulta principal para recuperar los datos
			
			$query = pg_query($conn,"SELECT * FROM public.fc_proveedores WHERE fc_proveedores.id_usuario='$_id_usuarios'  AND (fc_proveedores.ruc_proveedores LIKE '%".$c."%' OR fc_proveedores.razon_social_proveedores LIKE '%".$c."%') ORDER BY fc_proveedores.id_proveedores LIMIT $per_page OFFSET $offset");
			
			if ($numrows>0){
				?>
				 <section style="height:425px; overflow-y:scroll;">
                  <table class="table table-hover">
					  <thead>
						<tr class="info">
						 
						  <th style="text-align: left;">Ci / Ruc</th>
						  <th style="text-align: left;">Razon Social</th>
						  <th style="text-align: left;">Tipo Cliente</th>
						  <th style="text-align: left;">Cuenta Pagar</th>
						  <th style="text-align: left;">Cuenta Cobrar</th>
						  <th style="text-align: left;">Cuenta Anticipo Entregado</th>
						  <th style="text-align: left;">Cuenta Anticipo Recibido</th>
						  <th style="text-align: left;"># Dias Crédito</th>
						   <th></th>
						</tr>
					</thead>
					<tbody>
					<?php
					while($row = pg_fetch_array($query)){
						$id_proveedores=$row['id_proveedores'];
						$id_tipo_cliente_proveedor=$row['id_tipo_cliente_proveedor'];
						$result_tipo_cli = pg_query($conn,"SELECT * FROM tipo_cliente_proveedor WHERE id_tipo_cliente_proveedor='$id_tipo_cliente_proveedor'");
						while($row5 = pg_fetch_array($result_tipo_cli)){
						$nombre_tipo_cliente_proveedor= $row5['nombre_tipo_cliente_proveedor'];
						}
						
						
						$id_cuenta_pagar=$row['id_cuenta_pagar'];
						$resultCuenta_Pagar= pg_query($conn,"SELECT * FROM plan_cuentas WHERE id_plan_cuentas='$id_cuenta_pagar'");
						while($row0 = pg_fetch_array($resultCuenta_Pagar)){
						
						$codigo_cuenta_pagar=  $row0['codigo_plan_cuentas'];
						$nombre_cuenta_pagar= $row0['nombre_plan_cuentas'];
						$var_pagar= $codigo_cuenta_pagar.'<br>'.$nombre_cuenta_pagar;
						}
						
						$id_cuenta_cobrar=$row['id_cuenta_cobrar'];
						$resultCuenta_cobrar= pg_query($conn,"SELECT * FROM plan_cuentas WHERE id_plan_cuentas='$id_cuenta_cobrar'");
						while($row1 = pg_fetch_array($resultCuenta_cobrar)){
							
							$codigo_cuenta_cobrar= $row1['codigo_plan_cuentas'];
							$nombre_cuenta_cobrar= $row1['nombre_plan_cuentas'];
							$var_cobrar= $codigo_cuenta_cobrar.'<br>'.$nombre_cuenta_cobrar;
							
						}
						
						
						$id_cuenta_anticipo_entregado= $row['id_cuenta_anticipo_entregado'];
						$resultCuenta_anticipo_entregado= pg_query($conn,"SELECT * FROM plan_cuentas WHERE id_plan_cuentas='$id_cuenta_anticipo_entregado'");
						while($row2 = pg_fetch_array($resultCuenta_anticipo_entregado)){
						
						$codigo_cuenta_anticipo_entregado= $row2['codigo_plan_cuentas'];
						$nombre_cuenta_anticipo_entregado= $row2['nombre_plan_cuentas'];
						$var_entregado= $codigo_cuenta_anticipo_entregado.'<br>'.$nombre_cuenta_anticipo_entregado;
						}
						
						$id_cuenta_anticipo_recibido= $row['id_cuenta_anticipo_recibido'];
						$resultCuenta_anticipo_recibido= pg_query($conn,"SELECT * FROM plan_cuentas WHERE id_plan_cuentas='$id_cuenta_anticipo_recibido'");
						while($row3 = pg_fetch_array($resultCuenta_anticipo_recibido)){
						
						$codigo_cuenta_anticipo_recibido= $row3['codigo_plan_cuentas'];
						$nombre_cuenta_anticipo_recibido= $row3['nombre_plan_cuentas'];
						$var_recibido= $codigo_cuenta_anticipo_recibido.'<br>'.$nombre_cuenta_anticipo_recibido;
						}
						?>
						<tr>
						   
						    <td><?php echo $row['ruc_proveedores'];?></td>
							<td><?php echo $row['razon_social_proveedores'];?></td>
							<td><?php echo $nombre_tipo_cliente_proveedor;?></td>
							<td><?php echo $var_pagar;?></td>
							<td><?php echo $var_cobrar;?></td>
							<td><?php echo $var_entregado;?></td>
							<td><?php echo $var_recibido;?></td>
							<td><?php echo $row['dias_credito_cliente_proveedor'];?></td>
							<td><span class="pull-right">
							     <a href="#" class='btn btn-default' title='Editar' onclick="obtener_datos('<?php echo $id_proveedores;?>');" data-dismiss="modal"><i class="glyphicon glyphicon-edit"></i></a> 
								 <a href="#" class='btn btn-default' title='Borrar' onclick="eliminar('<?php echo $id_proveedores; ?>')" data-dismiss="modal"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
					            </span>
							</td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
				</section>
				
				<div class="table-pagination pull-right">
					<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
				</div>
				<div class="col-md-3 col-lg-3 pull-left" style="margin-bottom:0px;">
				<span><strong>Registros: </strong><?php echo $numrows;?></span>
				</div>
		
				
					<?php
					
				} else {
					?>
					<div class="alert alert-warning alert-dismissable">
		              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		              <h4>Aviso!!!</h4> No hay datos para mostrar
		              
		            </div>
					<?php
				}
			}
					
?>