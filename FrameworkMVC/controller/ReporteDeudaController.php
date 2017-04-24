<?php

class ReporteDeudaController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	
	public function index(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
		$reporte_deuda = new ReporteDeudaModel(); 
		$usuarios = new UsuariosModel();
		
		$entidades = new EntidadesModel();
		$columnas_enc = "entidades.id_entidades,
  							entidades.nombre_entidades";
		$tablas_enc ="public.usuarios,
						  public.entidades";
		$where_enc ="entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
		$id_enc="entidades.nombre_entidades";
		$resultEnt=$entidades->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ReporteDeuda";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $usuarios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["id_entidades"])){
	
					$id_entidades=$_POST['id_entidades'];
					$ruc_clientes=$_POST['ruc_clientes'];
					$razon_social_clientes=$_POST['razon_social_clientes'];
					$numero_credito_amortizacion_cabeza=$_POST['numero_credito_amortizacion_cabeza'];
					$numero_pagare_amortizacion_cabeza=$_POST['numero_pagare_amortizacion_cabeza'];
										
					$columnas = "amortizacion_cabeza.id_amortizacion_cabeza, 
									  amortizacion_cabeza.numero_credito_amortizacion_cabeza, 
									  amortizacion_cabeza.numero_pagare_amortizacion_cabeza, 
										fc_clientes.id_clientes,
									  fc_clientes.ruc_clientes, 
									  fc_clientes.razon_social_clientes, 
									  fc_clientes.direccion_clientes, 
									  fc_clientes.telefono_clientes, 
									  fc_clientes.celular_clientes, 
									  fc_clientes.email_clientes, 
									  tipo_creditos.nombre_tipo_creditos, 
									  amortizacion_cabeza.capital_prestado_amortizacion_cabeza, 
									  entidades.ruc_entidades, 
									  entidades.nombre_entidades, 
									  entidades.telefono_entidades, 
									  entidades.direccion_entidades, 
									  entidades.ciudad_entidades, 
									  entidades.logo_entidades, 
									  amortizacion_cabeza.total_deuda";
																					
	
	
					$tablas=" 	   public.fc_clientes, 
									  public.amortizacion_cabeza, 
									  public.tipo_creditos, 
									  public.entidades";
										
					$where="    amortizacion_cabeza.id_fc_clientes = fc_clientes.id_clientes AND
								  tipo_creditos.id_tipo_creditos = amortizacion_cabeza.id_tipo_creditos AND
								  entidades.id_entidades = amortizacion_cabeza.id_entidades";
																
					$id="fc_clientes.ruc_clientes";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
					
					if($ruc_clientes!=""){$where_1=" AND fc_clientes.ruc_clientes = '$ruc_clientes'";}
	
					if($razon_social_clientes!=""){$where_2=" AND fc_clientes.razon_social_clientes = '$razon_social_clientes'";}
	
					if($numero_credito_amortizacion_cabeza!=""){$where_3=" AND amortizacion_cabeza.numero_credito_amortizacion_cabeza = '$numero_credito_amortizacion_cabeza'";}
					
					if($numero_pagare_amortizacion_cabeza!=""){$where_4=" AND amortizacion_cabeza.numero_pagare_amortizacion_cabeza = '$numero_pagare_amortizacion_cabeza'";}
					
					
					$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	
	
					//$resultSet=$ccomprobantes->getCondiciones($columnas ,$tablas , $where_to, $id);
	
					
					//comienza paginacion
					
					
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
					
					if($action == 'ajax')
					{
						$html="";
						$resultSet=$reporte_deuda->getCantidad("*", $tablas, $where_to);
						$cantidadResult=(int)$resultSet[0]->total;
							
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
							
						$per_page = 50; //la cantidad de registros que desea mostrar
						$adjacents  = 9; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
							
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
							
							
						$resultSet=$reporte_deuda->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
							
						$count_query   = $cantidadResult;
							
						$total_pages = ceil($cantidadResult/$per_page);
						
						if ($cantidadResult>0)
						{
						
							
							
							//<th style="color:#456789;font-size:80%;"></th>
						
							$html.='<div class="pull-left">';
							$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
							$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
							$html.='</div><br>';
							$html.='<section style="height:425px; overflow-y:scroll;">';
							$html.='<table class="table table-hover">';
							$html.='<thead>';
							$html.='<tr class="info">';
							$html.='<th>Id</th>';
							$html.='<th>Nro. Crédito</th>';
							$html.='<th>Nro. Pagaré</th>';
							$html.='<th>Ruc</th>';
							$html.='<th>Razon</th>';
							$html.='<th>Tipo Crédito</th>';
							$html.='<th>Capital Prestado</th>';	
							$html.='<th>Total Deuda</th>';
							$html.='<th>Imprimir</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							foreach ($resultSet as $res)
							{
								//<td style="color:#000000;font-size:80%;"> <?php echo ;</td>
						
								
								$html.='<tr>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->id_amortizacion_cabeza.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->numero_credito_amortizacion_cabeza.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->numero_pagare_amortizacion_cabeza.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->ruc_clientes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->razon_social_clientes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_tipo_creditos.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->capital_prestado_amortizacion_cabeza.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->total_deuda.'</td>';
								$html.='<td style="color:#000000;font-size:80%;"><span class="pull-right"><a href="index.php?controller=ReporteDeuda&action=ReporteDeudaIndividual&id_amortizacion_cabeza='. $res->id_amortizacion_cabeza .'" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span></td>';
								$html.='</tr>';
						
							}
								
							$html.='</tbody>';
							$html.='</table>';
							$html.='</section>';
							$html.='<div class="table-pagination pull-right">';
							$html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents).'';
							$html.='</div>';
							$html.='</section>';
								
						
						}else{
						
							$html.='<div class="alert alert-warning alert-dismissable">';
							$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
							$html.='<h4>Aviso!!!</h4> No hay datos para mostrar';
							$html.='</div>';
						
						}
							
						echo $html;
						die();
						
					}
					
					if(isset($_POST['reporte']))
					{
						
						//parametros q van al servidor de reportes
						
						$parametros = array();
						$parametros['id_entidades']=isset($_POST['id_entidades'])?trim($_POST['id_entidades']):'';
						$parametros['ruc_clientes']=(isset($_POST['ruc_clientes']))?trim($_POST['ruc_clientes']):'';
						$parametros['razon_social_clientes']=(isset($_POST['razon_social_clientes']))?trim($_POST['razon_social_clientes']):'';
						$parametros['numero_credito_amortizacion_cabeza']=(isset($_POST['numero_credito_amortizacion_cabeza']))?trim($_POST['numero_credito_amortizacion_cabeza']):'';
						$parametros['numero_pagare_amortizacion_cabeza']=(isset($_POST['numero_pagare_amortizacion_cabeza']))?trim($_POST['numero_pagare_amortizacion_cabeza']):'';
					
						//para local 
						$pagina="conReporteDeuda.aspx";
												
						$conexion_rpt = array();
						$conexion_rpt['pagina']=$pagina;
						//$conexion_rpt['port']="59584";
						
						$this->view("ReporteRpt", array(
								"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
						));
						
						die();
						
					}
					
	
		}
	
				
				$this->view("ReporteDeuda",array(
						"resultSet"=>$resultSet, 
						"resultEnt"=>$resultEnt 
						
							
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Reporte de Deuda"
	
				));
	
				exit();
			}
	
		}
		else
		{
			$this->view("ErrorSesion",array(
					"resultSet"=>""
	
			));
	
		}
	
	}
	public function ReporteDeudaIndividual()
	{
	
		if(isset($_REQUEST['id_amortizacion_cabeza']))
		{
	
	
	
			$parametros = array();
		
			$parametros['id_amortizacion_cabeza']=isset($_GET['id_amortizacion_cabeza'])?trim($_GET['id_amortizacion_cabeza']):'';
	
	
			//aqui poner la pagina
	
			$pagina="conReporteDeudaIndividual.aspx";
	
			$conexion_rpt = array();
			$conexion_rpt['pagina']=$pagina;
			//$conexion_rpt['port']="59584";
	
			$this->view("ReporteRpt", array(
					"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
			));
	
	
		}
	
	
	}
	public function paginate($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
			
}
?>