<?php

class ConsultaHistorialCreditosController extends ControladorBase{

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
		
		$historial = new ConsultaHistorialCreditosModel();
		
		$columnas_suc="historial_prestamos_sudamericano.s";
		$tablas_suc="public.historial_prestamos_sudamericano";
		$where_suc="historial_prestamos_sudamericano.id_historial_prestamos_sudamericano >0 GROUP BY historial_prestamos_sudamericano.s";
		$id_suc="historial_prestamos_sudamericano.s";
		$resultS=$historial->getCondiciones($columnas_suc, $tablas_suc, $where_suc, $id_suc);
		
		$columnas_suc1="historial_prestamos_sudamericano.aa_ddd";
		$tablas_suc1="public.historial_prestamos_sudamericano";
		$where_suc1="historial_prestamos_sudamericano.id_historial_prestamos_sudamericano >0 GROUP BY historial_prestamos_sudamericano.aa_ddd";
		$id_suc1="historial_prestamos_sudamericano.aa_ddd";
		$resultAA_DDD=$historial->getCondiciones($columnas_suc1, $tablas_suc1, $where_suc1, $id_suc1);
		
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ConsultaHistorialCreditos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $historial->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["operacion"]))
				{
	
	
					$operacion=$_POST['operacion'];
					$cuenta=$_POST['cuenta'];
					$s=$_POST['s'];
					$aa_ddd=$_POST['aa_ddd'];
					$fecha_concede=$_POST['fecha_concede'];
					$fecha_vencimiento=$_POST['fecha_vencimiento'];
										
					$columnas = " historial_prestamos_sudamericano.id_historial_prestamos_sudamericano, 
								  historial_prestamos_sudamericano.nombres_clientes, 
								  historial_prestamos_sudamericano.lg, 
								  historial_prestamos_sudamericano.gr, 
								  historial_prestamos_sudamericano.operacion, 
								  historial_prestamos_sudamericano.fecha_concede, 
								  historial_prestamos_sudamericano.fecha_vencimiento, 
								  historial_prestamos_sudamericano.valor_prestado, 
								  historial_prestamos_sudamericano.saldo_capital, 
								  historial_prestamos_sudamericano.capital_pagado, 
								  historial_prestamos_sudamericano.dv, 
								  historial_prestamos_sudamericano.saldo_vencido, 
								  historial_prestamos_sudamericano.interes_cobrado, 
								  historial_prestamos_sudamericano.mora_cobrada, 
								  historial_prestamos_sudamericano.cuenta, 
								  historial_prestamos_sudamericano.aa_ddd, 
								  historial_prestamos_sudamericano.s";
	
	
	
					$tablas=" public.historial_prestamos_sudamericano";
								
					$where=" historial_prestamos_sudamericano.id_historial_prestamos_sudamericano > 0";
	
					$id="historial_prestamos_sudamericano.id_historial_prestamos_sudamericano";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
					
				
					
					
					if($operacion!=""){$where_0=" AND historial_prestamos_sudamericano.operacion='$operacion'";}
	
					if($cuenta!=""){$where_1=" AND historial_prestamos_sudamericano.cuenta='$cuenta'";}
					
					if($s!=""){$where_2=" AND historial_prestamos_sudamericano.s='$s'";}
					
					if($aa_ddd!=""){$where_3=" AND historial_prestamos_sudamericano.aa_ddd='$aa_ddd'";}
	
					if($fecha_concede!="" && $fecha_vencimiento!=""){$where_4=" AND  DATE(historial_prestamos_sudamericano.fecha_concede) BETWEEN '$fecha_concede' AND '$fecha_vencimiento'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3 . $where_4;
	
					
					//comienza paginacion
						
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
						
					if($action == 'ajax')
					{
						
						$html="";
						$resultSet=$historial->getCantidad("*", $tablas, $where_to);
						$cantidadResult=(int)$resultSet[0]->total;
							
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
							
						$per_page = 50; //la cantidad de registros que desea mostrar
						$adjacents  = 9; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
							
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
							
							
						$resultSet=$historial->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
							
						$count_query   = $cantidadResult;
							
						$total_pages = ceil($cantidadResult/$per_page);
							
						if ($cantidadResult>0)
						{
								
							
							$html.='<div class="pull-left">';
							$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
							$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
							$html.='</div><br>';
							$html.='<section style="height:425px; overflow-y:scroll;">';
							$html.='<table class="table table-hover">';
							$html.='<thead>';
							$html.='<tr class="info">';
							$html.='<th style="text-align: left;  font-size: 10px;">Nombre Cliente</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">LG.</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">GR.</th>';
							$html.='<th style="text-align: left;  font-size: 10px;"># Operación</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Fecha Concede</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Fecha Vencimiento</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Valor Prestado</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Saldo Capital</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Capital Pagado</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Dv</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Saldo Vencido</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Interes Cobrado</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Mora Cobrada</th>';
							$html.='<th style="text-align: left;  font-size: 10px;"># Cuenta</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">AA_DDD</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">S</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							
				
							
							
							
							
							foreach ($resultSet as $res)
							{
								
								$html.='<tr>';
								$html.='<td style="font-size: 9px;">'.$res->nombres_clientes.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->lg.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->gr.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->operacion.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->fecha_concede.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->fecha_vencimiento.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->valor_prestado.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->saldo_capital.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->capital_pagado.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->dv.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->saldo_vencido.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->interes_cobrado.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->mora_cobrada.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->cuenta.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->aa_ddd.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->s.'</td>';
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
					
					if(isset($_POST["reporte_rpt"]))
					{
						//parametros q van al servidor de reportes
						
						$parametros = array();
						
						$parametros['operacion']=isset($_POST['operacion'])?trim($_POST['operacion']):'';
						$parametros['cuenta']=isset($_POST['cuenta'])?trim($_POST['cuenta']):'';
						$parametros['s']=isset($_POST['s'])?trim($_POST['s']):'';
						$parametros['aa_ddd']=isset($_POST['aa_ddd'])?trim($_POST['aa_ddd']):'';
						$parametros['fecha_concede']=isset($_POST['fecha_concede'])?trim($_POST['fecha_concede']):'';
						$parametros['fecha_vencimiento']=isset($_POST['fecha_vencimiento'])?trim($_POST['fecha_vencimiento']):'';
						
						
						//para local 
						$pagina="conHistorialCreditos.aspx";
												
						$conexion_rpt = array();
						$conexion_rpt['pagina']=$pagina;
						//$conexion_rpt['port']="59584";
						
						$this->view("ReporteRpt", array(
								"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
						));
						
						die();
						
					}
	
	
				}
				
				$this->view("ConsultaHistorialCreditos",array(
						"resultSet"=>$resultSet, "resultS"=>$resultS, "resultAA_DDD"=>$resultAA_DDD
						
							
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consulta Historial Creditos"
	
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
	
	public function paginate($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_historial(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_historial(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_historial(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_historial(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_historial(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_historial($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_historial(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
}
?>