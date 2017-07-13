<?php

class TablaAmortizacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		
		
		session_start();
		$arrayGet=array();
		$resultRes="";
        $clientes = new ClientesModel();
        
        
        $interes_mensual = 0;
        $plazo_dias = 0;
        $cant_cuotas = 0;
        $tasa_mora = 0;
        $mora_mensual = 0;
        $valor_cuota = 0;
        
        $_id_usuarios= $_SESSION['id_usuarios'];
        $usuarios = new UsuariosModel();
        $resultEnt = $usuarios->getBy("id_usuarios ='$_id_usuarios'");
        $_id_entidades=$resultEnt[0]->id_entidades;
        
        $tipo_creditos = new TipoCreditosModel();
        $resultCre = $tipo_creditos->getAll("nombre_tipo_creditos");
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TablaAmortizacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				$resultAmortizacion=array();
				$resultDatos=array();
				$resultRubros=array();
				$resultDatos2=array();
				if(isset($_POST["buscar"]))
				{
				  
					$identificacion=$_POST['ruc_clientes'];
					$razon_social=$_POST['razon_social_clientes'];
					$numero_operacion=$_POST['numero_operacion'];
						
						if ($identificacion!="" || $razon_social!="" || $numero_operacion!=""  ){
					
						$columnas = "fc_clientes.id_clientes,
								  fc_clientes.ruc_clientes,
								  fc_clientes.razon_social_clientes,
								fc_clientes.numero_operacion,
								  entidades.nombre_entidades";
				
						$tablas=" public.fc_clientes,
  							public.entidades";
				
						$where="entidades.id_entidades = fc_clientes.id_entidades AND entidades.id_entidades= '$_id_entidades'";
				
						$id="fc_clientes.id_clientes";
				
				
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
				
				
						if($identificacion!=""){$where_0=" AND fc_clientes.ruc_clientes='$identificacion'";}
						if($razon_social!=""){$where_1=" AND fc_clientes.razon_social_clientes LIKE '%$razon_social%'";}
						if($numero_operacion!=""){$where_2=" AND fc_clientes.numero_operacion ='$numero_operacion'";}
						
				
							
						$where_to  = $where . $where_0 . $where_1. $where_2;
							
						$resultRes = $clientes->getCondiciones($columnas, $tablas, $where_to, $id);
							
					
					}
				}
					
					
		     	if(isset($_POST["Generar"]))
				{
								
						$interes=0;
						$total= isset($_POST['capital_prestado_amortizacion_cabeza'])?(double)$_POST['capital_prestado_amortizacion_cabeza']:2; 
						$porcentaje_capital=isset($_POST['tasa_interes_amortizacion_cabeza'])?(double)$_POST['tasa_interes_amortizacion_cabeza']:2;
						$total_capital=$total-($total*($porcentaje_capital/100));
						$fecha_corte=$_POST['fecha_amortizacion_cabeza'];
						$fecha_emision='';
							
							
						array_push($resultDatos,array('total'=> $total,'porcentaje_capital'=>$porcentaje_capital,'total_capital'=>$total_capital));
		
						
						//valores
						$_tasa_interes_amortizacion_cabeza = $_POST['tasa_interes_amortizacion_cabeza']; 
						$tasa= $_tasa_interes_amortizacion_cabeza / 100;
						$_capital_prestado_amortizacion_cabeza = $_POST['capital_prestado_amortizacion_cabeza'];
						$_plazo_meses_amortizacion_cabeza = $_POST['plazo_meses_amortizacion_cabeza'];
						
						
						////resultados
						$interes_mensual = $tasa / 12;
						$plazo_dias = $_plazo_meses_amortizacion_cabeza * 30;
						$cant_cuotas = $_plazo_meses_amortizacion_cabeza;
						
						$_id_usuarios= $_SESSION['id_usuarios'];
						$usuarios = new UsuariosModel();
						$resultEnt = $usuarios->getBy("id_usuarios ='$_id_usuarios'");
						$_id_entidades=$resultEnt[0]->id_entidades;
						
						$intereses = new InteresesModel();
						$columnas ="intereses.id_intereses, 
									  tipo_intereses.nombre_tipo_intereses, 
									  intereses.valor_intereses, 
									  entidades.id_entidades";
						$tablas="public.intereses, 
								  public.tipo_intereses, 
								  public.entidades";
						$where="tipo_intereses.id_tipo_intereses = intereses.id_tipo_intereses AND
  								entidades.id_entidades = intereses.id_entidades AND intereses.id_entidades='$_id_entidades' AND tipo_intereses.nombre_tipo_intereses='MORA'";
						$id="intereses.id_intereses";
						$tasa_mora = $intereses->getCondiciones($columnas, $tablas, $where, $id);
						
						$_valor_intereses=$tasa_mora[0]->valor_intereses;
						
						
						$mora_mensual = $_valor_intereses/360; 
						$valor_cuota =  ($_capital_prestado_amortizacion_cabeza * $interes_mensual) /  (1- pow((1+$interes_mensual), -$_plazo_meses_amortizacion_cabeza ))  ;
						
						
						$numero_cuotas=$_POST['plazo_meses_amortizacion_cabeza'];
						
						//$resultAmortizacion=$this->tablaAmortizacion($saldo_capital, $numero_cuotas, $fecha_corte, $total );
						$resultAmortizacion=$this->tablaAmortizacion($_capital_prestado_amortizacion_cabeza, $numero_cuotas, $interes_mensual, $valor_cuota, $fecha_corte, $_tasa_interes_amortizacion_cabeza);
						
				}
				
				$this->view("TablaAmortizacion",array(
						'resultRes'=>$resultRes,'resultDatos'=>$resultDatos,'resultAmortizacion'=>$resultAmortizacion,'resultRubros'=>$resultRubros,'resultCre'=>$resultCre,
						'valor_cuota'=>$valor_cuota,'interes_mensual'=> $interes_mensual,'plazo_dias'=>$plazo_dias,'cant_cuotas'=>$cant_cuotas,'tasa_mora'=>$tasa_mora ,'mora_mensual'=>$mora_mensual
				));
		
				
			}
			
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Cierre"
				
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
	
	public function tablaAmortizacion($_capital_prestado_amortizacion_cabeza, $numero_cuotas, $interes_mensual, $valor_cuota, $fecha_corte, $_tasa_interes_amortizacion_cabeza )
	{
		//array donde guardar tabla amortizacion
		$resultAmortizacion=array();
	    
		
		$capital = $_capital_prestado_amortizacion_cabeza;
	    $inter_ant= $interes_mensual;
		$interes=  $capital * $inter_ant;
		$amortizacion = $valor_cuota - $interes;
		$saldo_inicial= $capital - $amortizacion;
		
		
		
		for( $i = 0; $i <= $numero_cuotas; $i++) {
			
			if ($i == 0)
			{
				$interes= 0;
				$amortizacion = 0;
				$saldo_inicial= $capital;
				$fecha=strtotime('+0 day',strtotime($fecha_corte));
				$fecha=date('Y-m-d',$fecha);
				$fecha_corte=$fecha;
				$valor = 0;
				$saldo_inicial_ant = $capital; 
			}
			else 
			{
				
				
				$saldo_inicial_ant = $saldo_inicial_ant - $amortizacion;
				$interes= $saldo_inicial_ant * $inter_ant;
				$amortizacion = $valor_cuota - $interes;
				
				$saldo_inicial= $saldo_inicial_ant  - $amortizacion;
				
				
				$fecha=strtotime('+30 day',strtotime($fecha_corte));
				$fecha=date('Y-m-d',$fecha);
				$fecha_corte=$fecha;
				$valor = $valor_cuota;
			
			
			
			}
		/*	$total_interes = $total_interes + $interes;
			
			$total_amortizacion = $total_amortizacion + $amortizacion;
	    */
					
				
			$resultAmortizacion['tabla'][]=array(
					array('pagos_trimestrales'=> $i,
							'saldo_inicial'=>$saldo_inicial,
							'interes'=>$interes,
							'amortizacion'=>$amortizacion,
							'pagos'=>$valor,
							'fecha_pago'=>$fecha
					));
		}
	
		/*$resultAmortizacion['totales']=array(
				array('total_interes'=> $total_interes,
						'total_amortizacion'=> $total_amortizacion
						
	
				));*/
	
		return $resultAmortizacion;
	
	
	}
	
	
	

	public function InsertaTablaAmortizacion(){
		 
	session_start();
	$camortizacion = new AmortizacionCabezaModel();
	$damortizacion = new AmortizacionDetalleModel();
	
	
	if(isset($_POST["id_fc_clientes"]))
	{
		
		
		$numero_credito_amortizacion_cabeza=$_POST['numero_credito_amortizacion_cabeza'];
		$id_fc_clientes= $_POST['id_fc_clientes'];
		$numero_pagare_amortizacion_cabeza=$_POST['numero_pagare_amortizacion_cabeza'];
		$id_tipo_creditos=$_POST['id_tipo_creditos'];
		$fecha_corte=$_POST['fecha_amortizacion_cabeza'];
		$_tasa_interes_amortizacion_cabeza = $_POST['tasa_interes_amortizacion_cabeza'];
		$tasa= $_tasa_interes_amortizacion_cabeza / 100;
		$_capital_prestado_amortizacion_cabeza = $_POST['capital_prestado_amortizacion_cabeza'];
		$_plazo_meses_amortizacion_cabeza = $_POST['plazo_meses_amortizacion_cabeza'];
	
	
		////resultados
		$interes_mensual = $tasa / 12;
		$plazo_dias = $_plazo_meses_amortizacion_cabeza * 30;
		$cant_cuotas = $_plazo_meses_amortizacion_cabeza;
	
		$_id_usuarios= $_SESSION['id_usuarios'];
		$usuarios = new UsuariosModel();
		$resultEnt = $usuarios->getBy("id_usuarios ='$_id_usuarios'");
		$_id_entidades=$resultEnt[0]->id_entidades;
	
		$intereses = new InteresesModel();
		$columnas ="intereses.id_intereses,
									  tipo_intereses.nombre_tipo_intereses,
									  intereses.valor_intereses,
									  entidades.id_entidades";
		$tablas="public.intereses,
								  public.tipo_intereses,
								  public.entidades";
		$where="tipo_intereses.id_tipo_intereses = intereses.id_tipo_intereses AND
		entidades.id_entidades = intereses.id_entidades AND intereses.id_entidades='$_id_entidades' AND tipo_intereses.nombre_tipo_intereses='MORA'";
		$id="intereses.id_intereses";
		$tasa_mora = $intereses->getCondiciones($columnas, $tablas, $where, $id);
	
		$_valor_intereses=$tasa_mora[0]->valor_intereses;
		$_id_intereses=$tasa_mora[0]->id_intereses;
		
		
		
		$mora_mensual = $_valor_intereses/360;
		$valor_cuota =  ($_capital_prestado_amortizacion_cabeza * $interes_mensual) /  (1- pow((1+$interes_mensual), -$_plazo_meses_amortizacion_cabeza ))  ;
	
	
		$numero_cuotas=$_POST['plazo_meses_amortizacion_cabeza'];
	
		
		
		$resultAmortizacion=array();
		$capital = $_capital_prestado_amortizacion_cabeza;
		$inter_ant= $interes_mensual;
		$interes=  $capital * $inter_ant;
		$amortizacion = $valor_cuota - $interes;
		$saldo_inicial= $capital - $amortizacion;
		
		
		
		for( $i = 0; $i <= $numero_cuotas; $i++) {
				
			if ($i == 0)
			{
				$interes= 0;
				$amortizacion = 0;
				$saldo_inicial= $capital;
				$fecha=strtotime('+0 day',strtotime($fecha_corte));
				$fecha=date('Y-m-d',$fecha);
				$fecha_corte=$fecha;
				$valor = 0;
				$saldo_inicial_ant = $capital;
			}
			else
			{
		
		
				$saldo_inicial_ant = $saldo_inicial_ant - $amortizacion;
				$interes= $saldo_inicial_ant * $inter_ant;
				$amortizacion = $valor_cuota - $interes;
		
				$saldo_inicial= $saldo_inicial_ant  - $amortizacion;
		
		
				$fecha=strtotime('+30 day',strtotime($fecha_corte));
				$fecha=date('Y-m-d',$fecha);
				$fecha_corte=$fecha;
				$valor = $valor_cuota;
					
					
					
			}
			/*	$total_interes = $total_interes + $interes;
			 	
			$total_amortizacion = $total_amortizacion + $amortizacion;
			*/
				
		
			$resultAmortizacion['tabla'][]=array(
					array('pagos_trimestrales'=> $i,
							'saldo_inicial'=>$saldo_inicial,
							'interes'=>$interes,
							'amortizacion'=>$amortizacion,
							'pagos'=>$valor,
							'fecha_pago'=>$fecha
					));
		}
		
		
		//return $resultAmortizacion;
		
		
		
		try
		{
		    $numero_credito_amortizacion_cabeza=$_POST['numero_credito_amortizacion_cabeza'];
			$id_fc_clientes= $_POST['id_fc_clientes'];
			$numero_pagare_amortizacion_cabeza=$_POST['numero_pagare_amortizacion_cabeza'];
			$id_tipo_creditos=$_POST['id_tipo_creditos'];
			$fecha_corte=$_POST['fecha_amortizacion_cabeza'];
			$_tasa_interes_amortizacion_cabeza = $_POST['tasa_interes_amortizacion_cabeza'];
			$tasa= $_tasa_interes_amortizacion_cabeza / 100;
			$_capital_prestado_amortizacion_cabeza = $_POST['capital_prestado_amortizacion_cabeza'];
			$_plazo_meses_amortizacion_cabeza = $_POST['plazo_meses_amortizacion_cabeza'];
			
			
			$funcion = "ins_amortizacion_cabeza";
			$parametros = "'$numero_credito_amortizacion_cabeza','$numero_pagare_amortizacion_cabeza', '$id_fc_clientes','$id_tipo_creditos','$_capital_prestado_amortizacion_cabeza' ,'$tasa' ,'$_plazo_meses_amortizacion_cabeza' ,'$plazo_dias', '$_id_intereses', '$fecha_corte', '$valor_cuota', '$mora_mensual', '$_valor_intereses', '$_id_entidades'";
			$camortizacion->setFuncion($funcion);
			$camortizacion->setParametros($parametros);
			$resultado=$camortizacion->Insert();
			
			
			
			foreach($resultAmortizacion['tabla'] as $res)
			{
				 
				
				try
				{
					
					$resultCabeza = $camortizacion->getBy("numero_credito_amortizacion_cabeza ='$numero_credito_amortizacion_cabeza' AND id_entidades ='$_id_entidades' AND numero_pagare_amortizacion_cabeza = '$numero_pagare_amortizacion_cabeza' AND id_fc_clientes='$id_fc_clientes'");
					$_id_amortizacion_cabeza=$resultCabeza[0]->id_amortizacion_cabeza;
					
					$_numero_cuota_amortizacion_detalle = $res[0]['pagos_trimestrales'];
					$_saldo_inicial_amortizacion_detalle = $res[0]['saldo_inicial'];
					$_interes_amortizacion_detalle = $res[0]['interes'];
					$_amortizacion_amortizacion_detalle = $res[0]['amortizacion'];
					$_pagos_amortizacion_detalle = $res[0]['pagos'];
					$_fecha_pagos_amortizacion_detalle = $res[0]['fecha_pago'];
					 
						
					$funcion = "ins_amortizacion_detalle";
					$parametros = "'$_id_amortizacion_cabeza','$_id_entidades','$_numero_cuota_amortizacion_detalle', '$_saldo_inicial_amortizacion_detalle', '$_interes_amortizacion_detalle', '$_amortizacion_amortizacion_detalle', '$_pagos_amortizacion_detalle', '$_fecha_pagos_amortizacion_detalle'";
					$damortizacion->setFuncion($funcion);
					$damortizacion->setParametros($parametros);
					$resultado=$damortizacion->Insert();
						
					
					
					} catch (Exception $e)
					{
						$this->view("Error",array(
								"resultado"=>"Eror al Insertar Tabla de Amortizacion ->". $id
						));
						exit();
					}	
					
				}
				
				$camortizacion->UpdateBy("total_deuda='$_capital_prestado_amortizacion_cabeza'", "amortizacion_cabeza", "id_amortizacion_cabeza='$_id_amortizacion_cabeza'");
				
			
		}
   			catch (Exception $e)
   			{
   
   					
   
   			}
		
	}
	$this->redirect("TablaAmortizacion","index")	;

	}
	
	
	
	/*
	public function InsertaTablaAmortizacionAutomatica(){


		session_start();
		$resultResAutomatica="";
		$camortizacion = new AmortizacionCabezaModel();
		$damortizacion = new AmortizacionDetalleModel();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$usuarios = new UsuariosModel();
		$resultEnt = $usuarios->getBy("id_usuarios ='$_id_usuarios'");
		$_id_entidades=$resultEnt[0]->id_entidades;
		
		if(isset($_POST["GenerarAutomatico"]))
		{
		
			
			$clientes = new ClientesModel();
			$columnas="fc_clientes.id_clientes, 
					   fc_clientes.numero_operacion, 
					   fc_clientes.id_entidades,
						fc_clientes.taza_normal,
						fc_clientes.plazo_meses,
						fc_clientes.fecha_inicio,
					    fc_clientes.fecha_final,
						fc_clientes.capital_prestado";
			
			$tablas="public.fc_clientes, 
  					 public.entidades";
			$where="entidades.id_entidades = fc_clientes.id_entidades AND entidades.id_entidades= '$_id_entidades' AND fc_clientes.taza_normal > 0  AND fc_clientes.capital_prestado > 0 ";
			$id="fc_clientes.id_clientes";
			$resultResAutomatica = $clientes->getCondiciones($columnas, $tablas, $where, $id);
			
			
		
			
			
			
			$intereses = new InteresesModel();
			$columnas ="intereses.id_intereses,
									  tipo_intereses.nombre_tipo_intereses,
									  intereses.valor_intereses,
									  entidades.id_entidades";
			$tablas="public.intereses,
								  public.tipo_intereses,
								  public.entidades";
			$where="tipo_intereses.id_tipo_intereses = intereses.id_tipo_intereses AND
			entidades.id_entidades = intereses.id_entidades AND intereses.id_entidades='$_id_entidades' AND tipo_intereses.nombre_tipo_intereses='MORA'";
			$id="intereses.id_intereses";
			$tasa_mora = $intereses->getCondiciones($columnas, $tablas, $where, $id);
			
			$_valor_intereses=$tasa_mora[0]->valor_intereses;
			$_id_intereses=$tasa_mora[0]->id_intereses;
			
			
			
				
				
			
			foreach($resultResAutomatica as $res)
			{
					
				$_id_clientes = $res->id_clientes;
				$_id_entidades = $res->id_entidades;
				$_numero_operacion = $res->numero_operacion;
				$_taza_normal = $res->taza_normal;
				//$_plazo_meses = $res->plazo_meses;
				$_fecha_inicio = $res->fecha_inicio;
				$_fecha_final = $res->fecha_final;
				
				$_capital_prestado = $res->capital_prestado;
				$numero_credito_amortizacion_cabeza=$_numero_operacion;
				$numero_pagare_amortizacion_cabeza="";
				$id_tipo_creditos='31';
				
				$_fecha_ini = new DateTime($_fecha_inicio);
				$_fecha_fin = new DateTime($_fecha_final);
				$diferencia = $_fecha_fin->diff($_fecha_ini);
				$_meses = $diferencia->format("%m");
				$_años = $diferencia->format("%y")*12;
				$_plazo_meses=$_meses + $_años + 1;
				
				$tasa=$_taza_normal/100;
				$interes_mensual = $tasa / 12;
				$plazo_dias = $_plazo_meses * 30;
				
				
				
				$mora_mensual = $_valor_intereses/360;
				$valor_cuota =  ($_capital_prestado * $interes_mensual) /  (1- pow((1+$interes_mensual), - $_plazo_meses ))  ;
					
				
				
				try
				{	
				//INSERTO LA CABEZA
			    $funcion = "ins_amortizacion_cabeza";
				$parametros = "'$numero_credito_amortizacion_cabeza','$numero_pagare_amortizacion_cabeza', '$_id_clientes','$id_tipo_creditos','$_capital_prestado' ,'$tasa' ,'$_plazo_meses' ,'$plazo_dias', '$_id_intereses', '$_fecha_inicio', '$valor_cuota', '$mora_mensual', '$_valor_intereses', '$_id_entidades'";
				$camortizacion->setFuncion($funcion);
				$camortizacion->setParametros($parametros);
				$resultado=$camortizacion->Insert();
					
				$clientes->UpdateBy("plazo_meses='$_plazo_meses'", "fc_clientes", "id_clientes='$_id_clientes'");
				
					
					try
					{
						//INSERTO EL DETALLE
						$resultAmortizacion=array();
						$capital = $_capital_prestado;
						$inter_ant= $interes_mensual;
						$interes=  $capital * $inter_ant;
						$amortizacion = $valor_cuota - $interes;
						$saldo_inicial= $capital - $amortizacion;
						
						
						
						for( $i = 0; $i <= $_plazo_meses; $i++) {
						
							if ($i == 0)
							{
								$interes= 0;
								$amortizacion = 0;
								$saldo_inicial= $capital;
								$fecha=strtotime('+0 day',strtotime($_fecha_inicio));
								$fecha=date('Y-m-d',$fecha);
								$_fecha_inicio=$fecha;
								$valor = 0;
								$saldo_inicial_ant = $capital;
							}
							else
							{
						
						
								$saldo_inicial_ant = $saldo_inicial_ant - $amortizacion;
								$interes= $saldo_inicial_ant * $inter_ant;
								$amortizacion = $valor_cuota - $interes;
						
								$saldo_inicial= $saldo_inicial_ant  - $amortizacion;
						
						
								$fecha=strtotime('+30 day',strtotime($_fecha_inicio));
								$fecha=date('Y-m-d',$fecha);
								$_fecha_inicio=$fecha;
								$valor = $valor_cuota;
						
						
						
							}
							
							$resultAmortizacion['tabla'][]=array(
									array('pagos_trimestrales'=> $i,
											'saldo_inicial'=>$saldo_inicial,
											'interes'=>$interes,
											'amortizacion'=>$amortizacion,
											'pagos'=>$valor,
											'fecha_pago'=>$fecha
									));
						}
				
			
						
						foreach($resultAmortizacion['tabla'] as $res)
						{
						
						
							try
							{
									
								$resultCabeza = $camortizacion->getBy("numero_credito_amortizacion_cabeza ='$numero_credito_amortizacion_cabeza' AND id_entidades ='$_id_entidades' AND numero_pagare_amortizacion_cabeza = '$numero_pagare_amortizacion_cabeza' AND id_fc_clientes='$_id_clientes'");
								$_id_amortizacion_cabeza=$resultCabeza[0]->id_amortizacion_cabeza;
									
								$_numero_cuota_amortizacion_detalle = $res[0]['pagos_trimestrales'];
								$_saldo_inicial_amortizacion_detalle = $res[0]['saldo_inicial'];
								$_interes_amortizacion_detalle = $res[0]['interes'];
								$_amortizacion_amortizacion_detalle = $res[0]['amortizacion'];
								$_pagos_amortizacion_detalle = $res[0]['pagos'];
								$_fecha_pagos_amortizacion_detalle = $res[0]['fecha_pago'];
						
						
								$funcion = "ins_amortizacion_detalle";
								$parametros = "'$_id_amortizacion_cabeza','$_id_entidades','$_numero_cuota_amortizacion_detalle', '$_saldo_inicial_amortizacion_detalle', '$_interes_amortizacion_detalle', '$_amortizacion_amortizacion_detalle', '$_pagos_amortizacion_detalle', '$_fecha_pagos_amortizacion_detalle'";
								$damortizacion->setFuncion($funcion);
								$damortizacion->setParametros($parametros);
								$resultado=$damortizacion->Insert();
						
									
									
							} catch (Exception $e)
							{
								$this->view("Error",array(
										"resultado"=>"Eror al Insertar Tabla de Amortizacion ->". $id
								));
								exit();
							}
						
						}
						
						$camortizacion->UpdateBy("total_deuda='$_capital_prestado'", "amortizacion_cabeza", "id_amortizacion_cabeza='$_id_amortizacion_cabeza'");
						
							
						 
					} catch (Exception $e)
					{
						$this->view("Error",array(
								"resultado"=>"Eror al Insertar Detalle->". $e
						));
						exit();
					}
						
				}catch (Exception $e)
				{
				$this->view("Error",array(
						"resultado"=>"Eror al Insertar Cabeza->". $e
				));
				exit();
				
				 
			
				 
			}
			
			
			}
			
				
		
		}
		$this->redirect("TablaAmortizacion","index")	;
		
		
		
		
	}
	
	*/
	
}
?>