<?php

class RecalcularTablaAmortizacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
		
		$resultRes="";
		$resultSet="";
		$mensaje="";
		$capital_pagar= "";
		$dias_atrazados = "";
		$interes_normal = "";
		$interes_dia = "";
		$total_dia = "";
		$total_interes = "";
		$numero_cuota= "";
		$saldo_inicial_amortizacion_detalle = "";
		$amortizacion_amortizacion_detalle = "";
		
		
		
        $clientes = new ClientesModel();
        
        
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$_id_usuarios= $_SESSION['id_usuarios'];
			$usuarios = new UsuariosModel();
			$resultEnt = $usuarios->getBy("id_usuarios ='$_id_usuarios'");
			$_id_entidades=$resultEnt[0]->id_entidades;
			$camortizacion = new AmortizacionCabezaModel();
			$damortizacion = new AmortizacionDetalleModel();
			$clientes = new ClientesModel();
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "RecalcularTablaAmortizacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
			
				
				if(isset($_POST["buscar"]))
				{
				  
					$identificacion=$_POST['ruc_clientes'];
					$razon_social=$_POST['razon_social_clientes'];
				    $numero_operacion=$_POST['numero_operacion'];
					
					if ($identificacion!="" || $razon_social!="" || $numero_operacion!=""  ){
					
						$columnas = "fc_clientes.id_clientes, 
									  fc_clientes.ruc_clientes, 
									  fc_clientes.razon_social_clientes, 
									  fc_clientes.direccion_clientes, 
									  fc_clientes.telefono_clientes, 
									  fc_clientes.celular_clientes, 
									  fc_clientes.email_clientes,
								      fc_clientes.numero_operacion,
									  entidades.id_entidades, 
									  entidades.nombre_entidades, 
									  amortizacion_cabeza.id_amortizacion_cabeza, 
									  amortizacion_cabeza.numero_credito_amortizacion_cabeza, 
									  amortizacion_cabeza.numero_pagare_amortizacion_cabeza, 
									  tipo_creditos.id_tipo_creditos, 
									  tipo_creditos.nombre_tipo_creditos, 
									  amortizacion_cabeza.capital_prestado_amortizacion_cabeza, 
									  amortizacion_cabeza.tasa_interes_amortizacion_cabeza, 
									  amortizacion_cabeza.plazo_meses_amortizacion_cabeza, 
									  amortizacion_cabeza.plazo_dias_amortizacion_cabeza, 
									  intereses.id_intereses, 
									  intereses.valor_intereses, 
									  amortizacion_cabeza.fecha_amortizacion_cabeza, 
									  amortizacion_cabeza.cantidad_cuotas_amortizacion_cabeza, 
									  amortizacion_cabeza.interes_normal_mensual_amortizacion_cabeza, 
									  amortizacion_cabeza.interes_mora_mensual_amortizacion_cabeza";
				
						$tablas=" public.amortizacion_cabeza, 
								  public.fc_clientes, 
								  public.entidades, 
								  public.tipo_creditos, 
								  public.intereses";
				
						$where="amortizacion_cabeza.id_intereses = intereses.id_intereses AND
								  amortizacion_cabeza.id_entidades = entidades.id_entidades AND
								  fc_clientes.id_clientes = amortizacion_cabeza.id_fc_clientes AND
								  entidades.id_entidades = fc_clientes.id_entidades AND
								  tipo_creditos.id_tipo_creditos = amortizacion_cabeza.id_tipo_creditos AND entidades.id_entidades= '$_id_entidades'";
				
						$id="fc_clientes.id_clientes";
				
				
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
				
				
						if($identificacion!=""){$where_0=" AND fc_clientes.ruc_clientes='$identificacion'";}
						if($razon_social!=""){$where_1=" AND fc_clientes.razon_social_clientes LIKE '%$razon_social%'";}
						if($numero_operacion!=""){$where_2=" AND fc_clientes.numero_operacion ='$numero_operacion'";}
						
						
							
						$where_to  = $where . $where_0 . $where_1. $where_2;
				
							
						$where_to  = $where . $where_0 . $where_1;
							
						$resultRes = $clientes->getCondiciones($columnas, $tablas, $where_to, $id);
							
					
					}
				}
				
				if(isset($_POST["Recuperar"]))
				{
				
					
					$_array_amortizacion_cabeza = $_POST["id_amortizacion_cabeza"];
				
					foreach($_array_amortizacion_cabeza  as $id  )
					{
					
						if (!empty($id) )
						{
					
							try
							{
									
								$_id_amortizacion_cabeza = $id;
								$resultClientes= $camortizacion->getBy("id_amortizacion_cabeza ='$_id_amortizacion_cabeza' AND id_entidades ='$_id_entidades'");
								$_id_clientes=$resultClientes[0]->id_fc_clientes;
									
								$columnas = "fc_clientes.id_clientes,
								  fc_clientes.ruc_clientes,
								  fc_clientes.razon_social_clientes,
								  fc_clientes.direccion_clientes,
								  fc_clientes.telefono_clientes,
								  fc_clientes.celular_clientes,
								  fc_clientes.email_clientes,
								  amortizacion_cabeza.id_amortizacion_cabeza,
								  amortizacion_cabeza.numero_credito_amortizacion_cabeza,
								  amortizacion_cabeza.numero_pagare_amortizacion_cabeza,
								  tipo_creditos.id_tipo_creditos,
								  tipo_creditos.nombre_tipo_creditos,
								  amortizacion_cabeza.capital_prestado_amortizacion_cabeza,
								  amortizacion_cabeza.tasa_interes_amortizacion_cabeza,
								  amortizacion_cabeza.plazo_meses_amortizacion_cabeza,
								  amortizacion_cabeza.plazo_dias_amortizacion_cabeza,
								  intereses.id_intereses,
								  tipo_intereses.id_tipo_intereses,
								  tipo_intereses.nombre_tipo_intereses,
								  intereses.valor_intereses,
							      amortizacion_detalle.id_amortizacion_detalle,
								  amortizacion_detalle.numero_cuota_amortizacion_detalle,
								  amortizacion_detalle.saldo_inicial_amortizacion_detalle,
								  amortizacion_detalle.interes_amortizacion_detalle,
								  amortizacion_detalle.amortizacion_amortizacion_detalle,
								  amortizacion_detalle.pagos_amortizacion_detalle,
								  amortizacion_detalle.fecha_pagos_amortizacion_detalle,
								  amortizacion_detalle.estado_cancelado_amortizacion_detalle,
								  amortizacion_detalle.interes_dias_amortizacion_detalle";
									
								$tablas="  public.amortizacion_cabeza,
								  public.amortizacion_detalle,
								  public.fc_clientes,
								  public.intereses,
								  public.tipo_creditos,
								  public.tipo_intereses";
									
								$where=" amortizacion_cabeza.id_fc_clientes = fc_clientes.id_clientes AND
								amortizacion_cabeza.id_tipo_creditos = tipo_creditos.id_tipo_creditos AND
								amortizacion_detalle.id_amortizacion_cabeza = amortizacion_cabeza.id_amortizacion_cabeza AND
								intereses.id_intereses = amortizacion_cabeza.id_intereses AND
								tipo_intereses.id_tipo_intereses = intereses.id_tipo_intereses AND fc_clientes.id_clientes='$_id_clientes'  AND amortizacion_cabeza.id_amortizacion_cabeza = '$_id_amortizacion_cabeza' AND amortizacion_detalle.estado_cancelado_amortizacion_detalle = 'FALSE' AND estado_final = 'FALSE'";
								
								$id="amortizacion_detalle.numero_cuota_amortizacion_detalle";
									
								$resultSet = $clientes->getCondiciones($columnas, $tablas, $where, $id);
									
					
							} catch (Exception $e)
							{
								$this->view("Error",array(
										"resultado"=>"Eror al Recalcular ->". $id
								));
							}
								
						}
					
					}
					
						
					
				}
				
				
				
				
				if(isset($_POST["Calcular"]))
				{
					$_fecha_pago_recaudacion= $_POST["fecha_pago_recaudacion"];
					$_capital_pagado_recaudacion= $_POST["capital_pagado_recaudacion"];
					$_array_amortizacion_detalle = $_POST["id_amortizacion_detalle"];
					
					foreach($_array_amortizacion_detalle  as $id  )
					{
							
						if (!empty($id) )
						{
								
							try
							{
							$_id_amortizacion_detalle = $id;
							$resultCabeza = $damortizacion->getBy("id_amortizacion_detalle ='$_id_amortizacion_detalle' AND id_entidades ='$_id_entidades'");
					        $_id_amortizacion_cabeza=$resultCabeza[0]->id_amortizacion_cabeza;
					        $_fecha_pagos_amortizacion_detalle=$resultCabeza[0]->fecha_pagos_amortizacion_detalle;
					        $_pagos_amortizacion_detalle=$resultCabeza[0]->pagos_amortizacion_detalle;
					        $_interes_amortizacion_detalle=$resultCabeza[0]->interes_amortizacion_detalle;
					        $_numero_cuota_amortizacion_detalle=$resultCabeza[0]->numero_cuota_amortizacion_detalle;
					        $_saldo_inicial_amortizacion_detalle=$resultCabeza[0]->saldo_inicial_amortizacion_detalle;
					        $_amortizacion_amortizacion_detalle=$resultCabeza[0]->amortizacion_amortizacion_detalle;
					        
					        
					        if($_capital_pagado_recaudacion < "$_interes_amortizacion_detalle"){
					        	
					        	$mensaje = "true";
					        }
					        
					        if($_capital_pagado_recaudacion < "$_pagos_amortizacion_detalle" && $_fecha_pago_recaudacion <= "$_fecha_pagos_amortizacion_detalle"){
					        
					        	
					        	
					        	
					        	$numero_cuota= $_numero_cuota_amortizacion_detalle;
					        	$saldo_inicial_amortizacion_detalle = $_saldo_inicial_amortizacion_detalle;
					        	$amortizacion_amortizacion_detalle = $_amortizacion_amortizacion_detalle;
					        	
					        	$dias_atrazados	= (strtotime($_fecha_pagos_amortizacion_detalle)-strtotime($_fecha_pago_recaudacion))/86400;
					        	$dias_atrazados 	= abs($dias_atrazados); $dias_atrazados = floor($dias_atrazados);
					        	$interes_normal = $_interes_amortizacion_detalle;
					        	$interes_dia = $_interes_amortizacion_detalle / 30;
					        	$total_dia = $interes_dia * $dias_atrazados;
					        	$capital_pagar= $interes_normal + $total_dia + $amortizacion_amortizacion_detalle;
					        	
					        	
					        	
					        	
					        	
					        	
					        }
					        
					        
					        if($_capital_pagado_recaudacion == "$_pagos_amortizacion_detalle" && $_fecha_pago_recaudacion <= "$_fecha_pagos_amortizacion_detalle"){
					        	
					        	$numero_cuota= $_numero_cuota_amortizacion_detalle;
					        	$saldo_inicial_amortizacion_detalle = $_saldo_inicial_amortizacion_detalle;
					        	$amortizacion_amortizacion_detalle = $_amortizacion_amortizacion_detalle;
					        	
					        	$dias_atrazados	= (strtotime($_fecha_pagos_amortizacion_detalle)-strtotime($_fecha_pago_recaudacion))/86400;
					        	$dias_atrazados 	= abs($dias_atrazados); $dias_atrazados = floor($dias_atrazados);
					        	$interes_normal = $_interes_amortizacion_detalle;
					        	$interes_dia = $_interes_amortizacion_detalle / 30;
					        	$total_dia = $interes_dia * $dias_atrazados;
                                $capital_pagar= $interes_normal + $total_dia + $amortizacion_amortizacion_detalle;
					        	
					        	
					        	
					        	
					        	
					        }elseif ($_capital_pagado_recaudacion == "$_pagos_amortizacion_detalle" && $_fecha_pago_recaudacion > "$_fecha_pagos_amortizacion_detalle"){
					        	
					        	$numero_cuota= $_numero_cuota_amortizacion_detalle;
					        	$saldo_inicial_amortizacion_detalle = $_saldo_inicial_amortizacion_detalle;
					        	$amortizacion_amortizacion_detalle = $_amortizacion_amortizacion_detalle;
					        	
					        	
					        	$dias_atrazados	= (strtotime($_fecha_pagos_amortizacion_detalle)-strtotime($_fecha_pago_recaudacion))/86400;
					        	$dias_atrazados 	= abs($dias_atrazados); $dias_atrazados = floor($dias_atrazados);
					        	$interes_normal = $_interes_amortizacion_detalle;
					        	$interes_dia = $_interes_amortizacion_detalle / 30;
					        	$total_dia = $interes_dia * $dias_atrazados;
					        	$capital_pagar= $interes_normal + $total_dia + $amortizacion_amortizacion_detalle;
					        	
					        		
					        	
					        }elseif ($_capital_pagado_recaudacion > "$_pagos_amortizacion_detalle" && $_fecha_pago_recaudacion <= "$_fecha_pagos_amortizacion_detalle"){
					        	
					        	$numero_cuota= $_numero_cuota_amortizacion_detalle;
					        	$saldo_inicial_amortizacion_detalle = $_saldo_inicial_amortizacion_detalle;
					        	$amortizacion_amortizacion_detalle = $_amortizacion_amortizacion_detalle;
					        	
					        	
					        	$dias_atrazados	= (strtotime($_fecha_pagos_amortizacion_detalle)-strtotime($_fecha_pago_recaudacion))/86400;
					        	$dias_atrazados 	= abs($dias_atrazados); $dias_atrazados = floor($dias_atrazados);
					        	$interes_normal = $_interes_amortizacion_detalle;
					        	$interes_dia = $_interes_amortizacion_detalle / 30;
					        	$total_dia = $interes_dia * $dias_atrazados;
					        	$capital_pagar= $interes_normal + $total_dia + $amortizacion_amortizacion_detalle;
					        
					        	
					        	
					        }elseif ($_capital_pagado_recaudacion > "$_pagos_amortizacion_detalle" && $_fecha_pago_recaudacion > "$_fecha_pagos_amortizacion_detalle"){
					        
					        	
					        	
					        	
					        }
					        
					        $resultClientes= $camortizacion->getBy("id_amortizacion_cabeza ='$_id_amortizacion_cabeza' AND id_entidades ='$_id_entidades'");
					        $_id_clientes=$resultClientes[0]->id_fc_clientes;
					        
					        
					        
									
								$columnas = "fc_clientes.id_clientes,
								  fc_clientes.ruc_clientes,
								  fc_clientes.razon_social_clientes,
								  fc_clientes.direccion_clientes,
								  fc_clientes.telefono_clientes,
								  fc_clientes.celular_clientes,
								  fc_clientes.email_clientes,
								  amortizacion_cabeza.id_amortizacion_cabeza,
								  amortizacion_cabeza.numero_credito_amortizacion_cabeza,
								  amortizacion_cabeza.numero_pagare_amortizacion_cabeza,
								  tipo_creditos.id_tipo_creditos,
								  tipo_creditos.nombre_tipo_creditos,
								  amortizacion_cabeza.capital_prestado_amortizacion_cabeza,
								  amortizacion_cabeza.tasa_interes_amortizacion_cabeza,
								  amortizacion_cabeza.plazo_meses_amortizacion_cabeza,
								  amortizacion_cabeza.plazo_dias_amortizacion_cabeza,
								  intereses.id_intereses,
								  tipo_intereses.id_tipo_intereses,
								  tipo_intereses.nombre_tipo_intereses,
								  intereses.valor_intereses,
							      amortizacion_detalle.id_amortizacion_detalle,
								  amortizacion_detalle.numero_cuota_amortizacion_detalle,
								  amortizacion_detalle.saldo_inicial_amortizacion_detalle,
								  amortizacion_detalle.interes_amortizacion_detalle,
								  amortizacion_detalle.amortizacion_amortizacion_detalle,
								  amortizacion_detalle.pagos_amortizacion_detalle,
								  amortizacion_detalle.fecha_pagos_amortizacion_detalle,
								  amortizacion_detalle.estado_cancelado_amortizacion_detalle,
								  amortizacion_detalle.interes_dias_amortizacion_detalle";
									
								$tablas="  public.amortizacion_cabeza,
								  public.amortizacion_detalle,
								  public.fc_clientes,
								  public.intereses,
								  public.tipo_creditos,
								  public.tipo_intereses";
									
								$where=" amortizacion_cabeza.id_fc_clientes = fc_clientes.id_clientes AND
								amortizacion_cabeza.id_tipo_creditos = tipo_creditos.id_tipo_creditos AND
								amortizacion_detalle.id_amortizacion_cabeza = amortizacion_cabeza.id_amortizacion_cabeza AND
								intereses.id_intereses = amortizacion_cabeza.id_intereses AND
								tipo_intereses.id_tipo_intereses = intereses.id_tipo_intereses AND fc_clientes.id_clientes='$_id_clientes'  AND amortizacion_cabeza.id_amortizacion_cabeza = '$_id_amortizacion_cabeza' AND amortizacion_detalle.estado_cancelado_amortizacion_detalle = 'FALSE' AND estado_final = 'FALSE'";
					
								$id="amortizacion_detalle.numero_cuota_amortizacion_detalle";
									
								$resultSet = $clientes->getCondiciones($columnas, $tablas, $where, $id);
									
									
							} catch (Exception $e)
							{
								$this->view("Error",array(
										"resultado"=>"Eror al Recalcular ->". $id
								));
							}
					
						}
							
					}
					
				}
					
			
				
				$this->view("RecalcularTablaAmortizacion",array(
						'resultRes'=>$resultRes, 'resultSet'=>$resultSet, 'mensaje'=>$mensaje, 'capital_pagar'=>$capital_pagar,
	                    'dias_atrazados'=>$dias_atrazados, 'interes_normal'=>$interes_normal, 'total_dia'=>$total_dia, 
						'numero_cuota'=>$numero_cuota,
						'saldo_inicial_amortizacion_detalle'=>$saldo_inicial_amortizacion_detalle,
						'amortizacion_amortizacion_detalle'=>$amortizacion_amortizacion_detalle
						
					    
				));
		
				
				
			}
			
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Recalcular Tabla Amortización"
				
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
	
	
	public function InsertaRecalculaTablaAmortizacion(){
		session_start();
	
		$resultado = null;
		$capital_pagar= "";
		$dias_atrazados = "";
		$interes_normal = "";
		$interes_dia = "";
		$total_dia = "";
		$total_interes = "";
		$numero_cuota= "";
		$saldo_inicial_amortizacion_detalle = "";
		$amortizacion_amortizacion_detalle = "";
		
		$_id_usuarios= $_SESSION['id_usuarios'];
		$usuarios = new UsuariosModel();
		$resultEnt = $usuarios->getBy("id_usuarios ='$_id_usuarios'");
		$_id_entidades=$resultEnt[0]->id_entidades;

		$intereses = new InteresesModel();
		
		$permisos_rol=new PermisosRolesModel();
		$recaudacion = new RecaudacionModel();
		$camortizacion = new AmortizacionCabezaModel();
		$damortizacion = new AmortizacionDetalleModel();
		$clientes = new ClientesModel();
		$nombre_controladores = "RecalcularTablaAmortizacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $recaudacion->getPermisosEditar("nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
	
		if (!empty($resultPer))
		{
				
			if (isset ($_POST["Guardar"])   )
			{
				
				$_capital_pagado_recaudacion = $_POST["capital_pagado_recaudacion"];
				$_fecha_pago_recaudacion = $_POST["fecha_pago_recaudacion"];
				$_nombre_entidad_financiera_recaudacion = $_POST["nombre_entidad_financiera_recaudacion"];
				$_numero_papeleta_recaudacion = $_POST["numero_papeleta_recaudacion"];
				$_concepto_pago_amortizacion = $_POST["concepto_pago_amortizacion"];
				$_array_amortizacion_detalle = $_POST["id_amortizacion_detalle"];
				
	
	
	
	
				foreach($_array_amortizacion_detalle  as $id  )
				{
						
					if (!empty($id) )
					{
						
						try
						{
							
							$_id_amortizacion_detalle = $id;
							$resultCabeza = $damortizacion->getBy("id_amortizacion_detalle ='$_id_amortizacion_detalle' AND id_entidades ='$_id_entidades'");
					        $_id_amortizacion_cabeza=$resultCabeza[0]->id_amortizacion_cabeza;
					        $_fecha_pagos_amortizacion_detalle=$resultCabeza[0]->fecha_pagos_amortizacion_detalle;
					        $_pagos_amortizacion_detalle=$resultCabeza[0]->pagos_amortizacion_detalle;
					        $_interes_amortizacion_detalle=$resultCabeza[0]->interes_amortizacion_detalle;
					        $_numero_cuota_amortizacion_detalle=$resultCabeza[0]->numero_cuota_amortizacion_detalle;
					        $_saldo_inicial_amortizacion_detalle=$resultCabeza[0]->saldo_inicial_amortizacion_detalle;
					        $_amortizacion_amortizacion_detalle=$resultCabeza[0]->amortizacion_amortizacion_detalle;
					        
					        
					        $resultClientes= $camortizacion->getBy("id_amortizacion_cabeza ='$_id_amortizacion_cabeza' AND id_entidades ='$_id_entidades'");
					        $_id_clientes=$resultClientes[0]->id_fc_clientes;
					        $_tasa_interes_amortizacion_cabeza=$resultClientes[0]->tasa_interes_amortizacion_cabeza;
					        $_plazo_meses_amortizacion_cabeza=$resultClientes[0]->plazo_meses_amortizacion_cabeza;
					        $_interes_normal_mensual_amortizacion_cabeza=$resultClientes[0]->interes_normal_mensual_amortizacion_cabeza;
					        $_total_deuda=$resultClientes[0]->total_deuda;
					        
					        
					        
					        
					        $tasa_mora= $intereses->getBy("id_entidades ='$_id_entidades'");
					        $_valor_intereses=$tasa_mora[0]->valor_intereses;
					        
					        
					       
					        if($_capital_pagado_recaudacion == "$_pagos_amortizacion_detalle" && $_fecha_pago_recaudacion <= "$_fecha_pagos_amortizacion_detalle"){
					        
					        	$numero_cuota= $_numero_cuota_amortizacion_detalle;
					        	$saldo_inicial_amortizacion_detalle = $_saldo_inicial_amortizacion_detalle;
					        	$amortizacion_amortizacion_detalle = $_amortizacion_amortizacion_detalle;
					        
					        	$dias_atrazados	= (strtotime($_fecha_pagos_amortizacion_detalle)-strtotime($_fecha_pago_recaudacion))/86400;
					        	$dias_atrazados 	= abs($dias_atrazados); $dias_atrazados = floor($dias_atrazados);
					        	$interes_normal = $_interes_amortizacion_detalle;
					        	$interes_dia = $_interes_amortizacion_detalle / 30;
					        	$total_dia = $interes_dia * $dias_atrazados;
					        	$capital_pagar= $interes_normal + $total_dia + $amortizacion_amortizacion_detalle;
					        
					            $recalcular=$_total_deuda- $_pagos_amortizacion_detalle;
					        	
					        	
					        	$funcion = "ins_recaudacion";
					        	$parametros = "'$_id_clientes','$_id_entidades', '$_id_amortizacion_cabeza','$_capital_pagado_recaudacion','$_numero_cuota_amortizacion_detalle','$_fecha_pago_recaudacion', '$_id_amortizacion_detalle', '$_nombre_entidad_financiera_recaudacion', '$_numero_papeleta_recaudacion', '$_concepto_pago_amortizacion'";
					        	$recaudacion->setFuncion($funcion);
					        	$recaudacion->setParametros($parametros);
					        	$resultado=$recaudacion->Insert();
					        	
					        	$damortizacion->UpdateBy("estado_cancelado_amortizacion_detalle='TRUE'", "amortizacion_detalle", "id_amortizacion_detalle='$_id_amortizacion_detalle'");
					        		
					        	
					        	$camortizacion->UpdateBy("total_deuda='$recalcular'", "amortizacion_cabeza", "id_amortizacion_cabeza='$_id_amortizacion_cabeza'");
					        	
					        
					        }elseif ($_capital_pagado_recaudacion == "$_pagos_amortizacion_detalle" && $_fecha_pago_recaudacion > "$_fecha_pagos_amortizacion_detalle"){
					        
					        	$numero_cuota= $_numero_cuota_amortizacion_detalle;
					        	$saldo_inicial_amortizacion_detalle = $_saldo_inicial_amortizacion_detalle;
					        	$amortizacion_amortizacion_detalle = $_amortizacion_amortizacion_detalle;
					        	$recalcular=$_total_deuda- $_pagos_amortizacion_detalle;
					        	
					        
					        	$dias_atrazados	= (strtotime($_fecha_pagos_amortizacion_detalle)-strtotime($_fecha_pago_recaudacion))/86400;
					        	$dias_atrazados 	= abs($dias_atrazados); $dias_atrazados = floor($dias_atrazados);
					        	$interes_normal = $_interes_amortizacion_detalle;
					        	$interes_dia = $_interes_amortizacion_detalle / 30;
					        	$total_dia = $interes_dia * $dias_atrazados;
					        	$capital_pagar= $interes_normal + $total_dia + $amortizacion_amortizacion_detalle;
					        	
					        	$funcion = "ins_recaudacion";
					        	$parametros = "'$_id_clientes','$_id_entidades', '$_id_amortizacion_cabeza','$_capital_pagado_recaudacion','$_numero_cuota_amortizacion_detalle','$_fecha_pago_recaudacion', '$_id_amortizacion_detalle', '$_nombre_entidad_financiera_recaudacion', '$_numero_papeleta_recaudacion', '$_concepto_pago_amortizacion'";
					        	$recaudacion->setFuncion($funcion);
					        	$recaudacion->setParametros($parametros);
					        	$resultado=$recaudacion->Insert();
					        
					        	$damortizacion->UpdateBy("estado_cancelado_amortizacion_detalle='TRUE', interes_dias_amortizacion_detalle='$total_dia', pagos_amortizacion_detalle='$capital_pagar'", "amortizacion_detalle", "id_amortizacion_detalle='$_id_amortizacion_detalle'");
					        	$camortizacion->UpdateBy("total_deuda='$recalcular'", "amortizacion_cabeza", "id_amortizacion_cabeza='$_id_amortizacion_cabeza'");
					        	
					        
					       }elseif ($_capital_pagado_recaudacion > "$_pagos_amortizacion_detalle" && $_fecha_pago_recaudacion <= "$_fecha_pagos_amortizacion_detalle"){
					        	
					        	
					        	$capital = $_capital_pagado_recaudacion - $_pagos_amortizacion_detalle ;
					            $saldo_inicial_1= $_saldo_inicial_amortizacion_detalle - $capital;
					            $numero = $_plazo_meses_amortizacion_cabeza - $_numero_cuota_amortizacion_detalle;
					            $interes_mensual = $_tasa_interes_amortizacion_cabeza / 12;
					        	$valor_cuota =  ($saldo_inicial_1 * $interes_mensual) /  (1- pow((1+$interes_mensual), - $numero ))  ;
					        	
					        	$_capital_prestado_amortizacion_cabeza_1= $saldo_inicial_1;
					        	$numero_cuotas= $numero;
					        	$fecha_corte= $_fecha_pagos_amortizacion_detalle;
					        	
					        	$recalcular=$_total_deuda - $_pagos_amortizacion_detalle;
					        	
					        	
					        	
					        	$resultAmortizacion=$this->tablaAmortizacion($_capital_prestado_amortizacion_cabeza_1, $numero_cuotas, $interes_mensual, $valor_cuota, $fecha_corte);
					        	
					        	
					        	
					        		try
					        		{
					        			$damortizacion->UpdateBy("estado_eliminar='TRUE'", "amortizacion_detalle", "id_amortizacion_cabeza ='$_id_amortizacion_cabeza' AND id_entidades ='$_id_entidades' AND numero_cuota_amortizacion_detalle > '$_numero_cuota_amortizacion_detalle'");
					        			$damortizacion->UpdateBy("estado_final='TRUE'", "amortizacion_detalle", "id_amortizacion_cabeza='$_id_amortizacion_cabeza' AND numero_cuota_amortizacion_detalle <= '$_numero_cuota_amortizacion_detalle'");
					        			$damortizacion->UpdateBy("estado_cancelado_amortizacion_detalle='TRUE'", "amortizacion_detalle", "id_amortizacion_cabeza='$_id_amortizacion_cabeza' AND numero_cuota_amortizacion_detalle = 0");
					        			$damortizacion->UpdateBy("estado_cancelado_amortizacion_detalle='TRUE'", "amortizacion_detalle", "id_amortizacion_cabeza='$_id_amortizacion_cabeza' AND numero_cuota_amortizacion_detalle = '$_numero_cuota_amortizacion_detalle'");
					        			
					        		
					        		foreach($resultAmortizacion['tabla'] as $res)
					        		{
					        			
					        			try
					        			{
					        					
					        				$_numero_cuota_amortizacion_detalle_1 = $res[0]['pagos_trimestrales'];
					        				$_saldo_inicial_amortizacion_detalle_1 = $res[0]['saldo_inicial'];
					        				$_interes_amortizacion_detalle_1 = $res[0]['interes'];
					        				$_amortizacion_amortizacion_detalle_1 = $res[0]['amortizacion'];
					        				$_pagos_amortizacion_detalle_1 = $res[0]['pagos'];
					        				$_fecha_pagos_amortizacion_detalle_1 = $res[0]['fecha_pago'];
					        		
					        		
					        				$funcion = "ins_amortizacion_detalle";
					        				$parametros = "'$_id_amortizacion_cabeza','$_id_entidades','$_numero_cuota_amortizacion_detalle_1', '$_saldo_inicial_amortizacion_detalle_1', '$_interes_amortizacion_detalle_1', '$_amortizacion_amortizacion_detalle_1', '$_pagos_amortizacion_detalle_1', '$_fecha_pagos_amortizacion_detalle_1'";
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
					        		
					        		$where_del = "id_amortizacion_cabeza ='$_id_amortizacion_cabeza' AND id_entidades ='$_id_entidades' AND estado_eliminar = 'TRUE'";
					        		$damortizacion->deleteByWhere($where_del);
					        		 
					        		
					        		$funcion = "ins_recaudacion";
					        		$parametros = "'$_id_clientes','$_id_entidades', '$_id_amortizacion_cabeza','$_capital_pagado_recaudacion','$_numero_cuota_amortizacion_detalle','$_fecha_pago_recaudacion', '$_id_amortizacion_detalle', '$_nombre_entidad_financiera_recaudacion', '$_numero_papeleta_recaudacion', '$_concepto_pago_amortizacion'";
					        		$recaudacion->setFuncion($funcion);
					        		$recaudacion->setParametros($parametros);
					        		$resultado=$recaudacion->Insert();
					        		
					        		
					        		
					        		$camortizacion->UpdateBy("plazo_meses_amortizacion_cabeza='$numero'", "amortizacion_cabeza", "id_amortizacion_cabeza='$_id_amortizacion_cabeza'");
					        		$camortizacion->UpdateBy("total_deuda='$recalcular'", "amortizacion_cabeza", "id_amortizacion_cabeza='$_id_amortizacion_cabeza'");
					        		
					        		
					        		
					        		}catch (Exception $e)
						   			{
						   
						   				$this->view("Error",array(
						   						"resultado"=>"Eror al Insertar Tabla de Amortizacion ->". $id
						   				));
						   				exit();
						   
						   			}
											        	
					        	
					        	
					        }elseif($_capital_pagado_recaudacion < "$_pagos_amortizacion_detalle" && $_fecha_pago_recaudacion <= "$_fecha_pagos_amortizacion_detalle"){
					        
					        	
					        	$capital = $_pagos_amortizacion_detalle - $_capital_pagado_recaudacion;
					        	$cuota = $_numero_cuota_amortizacion_detalle + 1;
					        	
					        	$resultSiguiente= $damortizacion->getBy("id_amortizacion_cabeza ='$_id_amortizacion_cabeza' AND id_entidades ='$_id_entidades' AND numero_cuota_amortizacion_detalle='$cuota'");
					        	$_amortizacion_siguiente=$resultSiguiente[0]->amortizacion_amortizacion_detalle;
					        	$_interes_siguiente=$resultSiguiente[0]->interes_amortizacion_detalle;
					        	$amor = $_amortizacion_siguiente + $capital;
					        	
					        	$interes_dia = $_interes_amortizacion_detalle / 30;
					        	$total_dia = $interes_dia * 30;
					        	$saldo_pago = $amor + $total_dia + $_interes_siguiente;
					        	$recalcular=$_total_deuda - $_pagos_amortizacion_detalle;
					        	
					        	
					        	try
					        	{
					        	
					        	$damortizacion->UpdateBy("estado_cancelado_amortizacion_detalle='TRUE'", "amortizacion_detalle", "id_amortizacion_cabeza='$_id_amortizacion_cabeza' AND numero_cuota_amortizacion_detalle = '$_numero_cuota_amortizacion_detalle' AND id_amortizacion_detalle='$_id_amortizacion_detalle'");
					        	
					        	
					        	$funcion = "ins_recaudacion";
					        	$parametros = "'$_id_clientes','$_id_entidades', '$_id_amortizacion_cabeza','$_capital_pagado_recaudacion','$_numero_cuota_amortizacion_detalle','$_fecha_pago_recaudacion', '$_id_amortizacion_detalle', '$_nombre_entidad_financiera_recaudacion', '$_numero_papeleta_recaudacion', '$_concepto_pago_amortizacion'";
					        	$recaudacion->setFuncion($funcion);
					        	$recaudacion->setParametros($parametros);
					        	$resultado=$recaudacion->Insert();
					        	
					        	
					        	$damortizacion->UpdateBy("pagos_amortizacion_detalle='$saldo_pago', interes_dias_amortizacion_detalle='$total_dia', amortizacion_amortizacion_detalle='$amor'", "amortizacion_detalle", "id_amortizacion_cabeza='$_id_amortizacion_cabeza' AND numero_cuota_amortizacion_detalle = '$cuota' AND estado_cancelado_amortizacion_detalle='FALSE' AND estado_final='FALSE'");
					        	$camortizacion->UpdateBy("total_deuda='$recalcular'", "amortizacion_cabeza", "id_amortizacion_cabeza='$_id_amortizacion_cabeza'");
					        	
					        	
					        	} catch (Exception $e)
					        	{
					        		$this->view("Error",array(
					        				"resultado"=>"Eror al Actualizar Tabla de Amortizacion ->".$parametros
					        		));
					        		exit();
					        	}
					        	
					        	
					        	
					        }elseif ($_capital_pagado_recaudacion > "$_pagos_amortizacion_detalle" && $_fecha_pago_recaudacion > "$_fecha_pagos_amortizacion_detalle"){
					        
					        
					        	
					        	
					        	
					        	
					        	
					        }
					        
					      		
	
						} catch (Exception $e)
						{
							$this->view("Error",array(
									"resultado"=>"Eror al Recalcular ->". $id
							));
						}
							
					}
	
				}
	
			}
	
	
			$this->redirect("RecalcularTablaAmortizacion", "index");
				
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Recalcular Tabla de Amortizacion"
	
			));
	
		}
	
	}
	
	
	public function tablaAmortizacion($_capital_prestado_amortizacion_cabeza_1, $numero_cuotas, $interes_mensual, $valor_cuota, $fecha_corte)
	{
		//array donde guardar tabla amortizacion
		$resultAmortizacion=array();
		 
	
		$capital = $_capital_prestado_amortizacion_cabeza_1;
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
			/*elseif ($i == 1){
				
				
				$saldo_inicial_ant = $capital;
				$interes= $saldo_inicial_ant * $inter_ant;
				$amortizacion = $valor_cuota - $interes;
				$saldo_inicial= $capital;
				$fecha=strtotime('+30 day',strtotime($fecha_corte));
				$fecha=date('Y-m-d',$fecha);
				$fecha_corte=$fecha;
				$valor = $valor_cuota;
				
			}*/
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
				
	
			$resultAmortizacion['tabla'][]=array(
					array('pagos_trimestrales'=> $i,
							'saldo_inicial'=>$saldo_inicial,
							'interes'=>$interes,
							'amortizacion'=>$amortizacion,
							'pagos'=>$valor,
							'fecha_pago'=>$fecha
					));
		}
	
		
	
		return $resultAmortizacion;
	
	
	}
	
	
}
?>