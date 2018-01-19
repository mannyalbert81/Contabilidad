<?php

class FC_ProveedoresController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function index(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{	
			
			//maycol 
			$fc_catalogos = new FC_CatalogosModel();
			$fc_foto_productos = new FC_FotoProductosModel();
			$fc_productos = new FC_ProductosModel();
			
			$usuarios = new UsuariosModel();
			$resultEnt = $usuarios->getBy("id_usuarios='$_id_usuarios'");
			$_id_entidades=$resultEnt[0]->id_entidades;
			
			
			$tipo_cliente_proveedor = new TipoClienteProveedorModel();
			$result_Tip_Cli_Prov=$tipo_cliente_proveedor->getAll("nombre_tipo_cliente_proveedor");
			
			$ciudad = new CiudadModel();
			$result_ciudad=$ciudad->getAll("nombre_ciudad");
				
			
			$tipo_contribuyente = new Tipo_ContribuyenteModel();
			$result_tipo_contrib=$tipo_contribuyente->getAll("nombre_tipo_contribuyente");
				
			$tipo_persona = new Tipo_PersonaModel();
			$resultTipPer= $tipo_persona->getAll("nombre_tipo_persona");
			
			$tipo_identificacion = new Tipo_IdentificacionModel();
			$resultTipIdent = $tipo_identificacion->getAll("nombre_tipo_identificacion");
			
			$entidades = new EntidadesModel();
			$columnas_enc = "entidades.id_entidades,
  							entidades.nombre_entidades,
				usuarios.id_usuarios,
				usuarios.nombre_usuarios";
			$tablas_enc ="public.usuarios,
						  public.entidades";
			$where_enc ="entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
			$id_enc="entidades.nombre_entidades";
			$resultEnt=$entidades->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
			
			
		    $permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "FC_Proveedores";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $fc_productos->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol'");
				
			if (!empty($resultPer))
			{
				
				
					$this->facturacion_compras("FC_Proveedores",array(
							
							"result_ciudad"=>$result_ciudad, "result_Tip_Cli_Prov"=>$result_Tip_Cli_Prov, "resultEnt"=>$resultEnt, 
							"result_tipo_contrib"=>$result_tipo_contrib, "resultTipPer"=>$resultTipPer, "resultTipIdent"=>$resultTipIdent
					));
			
			}else{
				
				
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Registrar FC Proveedores"
				
					
				));
				die();
			}
		}
		else
		{
	
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
					   ));
		}
	
	}
	
	
	
	
	
	
   public function InsertaFC_Proveedores(){
   
   	session_start();
   	$permisos_rol=new PermisosRolesModel();
   	$fc_proveedores = new FC_ProveedoresModel();
   	
   	$nombre_controladores = "FC_Proveedores";
   	$id_rol= $_SESSION['id_rol'];
   	$resultPer = $fc_proveedores->getPermisosEditar("nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol'");
   
   	if (!empty($resultPer))
   	{
   		$_id_usuarios= $_SESSION['id_usuarios'];
   		$resultado = null;
   		
   		if (isset ($_POST["ruc_proveedores"]))
   		{
   			
   			$_ruc_proveedores  		         = $_POST["ruc_proveedores"];
   			$_razon_social_proveedores 		 = $_POST["razon_social_proveedores"];
   			$_id_tipo_cliente_proveedor 	 = $_POST["id_tipo_cliente_proveedor"];
   			$_id_ciudad 					 = $_POST["id_ciudad"];
   			$_id_entidades		             = $_POST["id_entidades"];
   			$_id_tipo_contribuyente 		 = $_POST["id_tipo_contribuyente"];
   			$_id_tipo_persona 		         = $_POST["id_tipo_persona"];
   			$_id_tipo_identificacion 		         = $_POST["id_tipo_identificacion"];
   			$_direccion_proveedores 		         = $_POST["direccion_proveedores"];
   			$_telefono_proveedores		         = $_POST["telefono_proveedores"];
   			$_celular_proveedores 		         = $_POST["celular_proveedores"];
   			$_email_proveedores		         = $_POST["email_proveedores"];
   			$_web_proveedores	             = $_POST["web_proveedores"];
   			$_retencion_fuente		         = $_POST["retencion_fuente"];
   			$_retencion_iva	                 = $_POST["retencion_iva"];
   			$_id_cuenta_pagar		         = $_POST["id_cuenta_pagar"];
   			$_id_cuenta_cobrar		         = $_POST["id_cuenta_cobrar"];
   			$_id_cuenta_anticipo_entregado		         = $_POST["id_cuenta_anticipo_entregado"];
   			$_id_cuenta_anticipo_recibido		         = $_POST["id_cuenta_anticipo_recibido"];
   			$_dias_credito_cliente_proveedor		         = $_POST["dias_credito_cliente_proveedor"];
   			
   			
   			// contactos
   			$_ci_contacto_proveedores		         = $_POST["ci_contacto_proveedores"];
   			$_contacto_razon_social_proveedores		         = $_POST["contacto_razon_social_proveedores"];
   			$_telefono_contacto_proveedores		         = $_POST["telefono_contacto_proveedores"];
   			$_celular_contacto_proveedores	         = $_POST["celular_contacto_proveedores"];
   			$_email_contacto_proveedores		         = $_POST["email_contacto_proveedores"];
   			
   			
   			
   			
   			
   			$funcion = "ins_fc_proveedores";
   			$parametros = "'$_ruc_proveedores',
   			'$_razon_social_proveedores',
   			'$_id_ciudad',
   			'$_direccion_proveedores',
   			'$_telefono_proveedores',
   			'$_celular_proveedores',
   			'$_email_proveedores',
   			'$_web_proveedores',
   			'$_retencion_fuente',
   			'$_retencion_iva',
   			'$_ci_contacto_proveedores',
   			'$_contacto_razon_social_proveedores',
   			'$_telefono_contacto_proveedores',
   			'$_celular_contacto_proveedores',
   			'$_email_contacto_proveedores',
   			'$_id_usuarios',
   			'$_id_entidades',
   			'$_id_tipo_contribuyente',
   			'$_id_tipo_persona',
   			'$_id_tipo_identificacion',
   			'$_id_cuenta_pagar',
   			'$_id_cuenta_cobrar',
   			'$_id_cuenta_anticipo_entregado',
   			'$_id_cuenta_anticipo_recibido',
   			'$_dias_credito_cliente_proveedor',
   			'$_id_tipo_cliente_proveedor'";
   			
   			$fc_proveedores->setFuncion($funcion);
   			$fc_proveedores->setParametros($parametros);
   			$resultado=$fc_proveedores->Insert();
   			
   			
   			$html="";
   			if ($resultado)  {
   				$html .= "<div class='col-lg-6 col-xs-12' id='ocultar'>";
   				$html .= "<div class='alert alert-success' role='alert'><strong>Cliente Registrado Correctamente..</strong></div>";
   				$html .= "</div>";
   			
   			
   				echo $html;
   			}else{
   			
   				$html .= "<div class='col-lg-6 col-xs-12' id='ocultar'>";
   				$html .= "<div class='alert alert-danger' role='alert'><strong>No pudimos registrar el Cliente..</strong></div>";
   				$html .= "</div>";
   				echo $html;
   			}
   			
   		}
   		
   		
   	}
   	else
   	{
   		$this->view("Error",array(
   				"resultado"=>"No tiene Permisos de Insertar FC Proveedores"
   
   		));
   	}
   
   }
   
   
   
   
   
   public function EliminarProveedor()
   {
   	session_start();
   	$resultado = null;
   	$provedores=new FC_ProveedoresModel();
   	
   
   	if(isset($_GET["id_proveedor"]))
   	{
   		
   		$id_proveedor=(int)$_GET["id_proveedor"];
   		$usuarios=new UsuariosModel();
   		$resultado = $provedores->deleteBy("id_proveedores",$id_proveedor);
   
   		$html="";
   		if ($resultado)  {
   			$html .= "<div class='col-lg-6 col-xs-12' id='ocultar'>";
   			$html .= "<div class='alert alert-success' role='alert'><strong>Cliente Eliminado Correctamente..</strong></div>";
   			$html .= "</div>";
   			
   			
   			echo $html;
   		}else{
   			
   			$html .= "<div class='col-lg-6 col-xs-12' id='ocultar'>";
   			$html .= "<div class='alert alert-danger' role='alert'><strong>No pudimos eliminar el Cliente..</strong></div>";
   			$html .= "</div>";
   			echo $html;
   		}
   		
   	}
   	
   }
   
   


   public function AutocompleteComprobantesCodigo(){
   
   	session_start();
   	$_id_usuarios= $_SESSION['id_usuarios'];
   	$plan_cuentas = new PlanCuentasModel();
   	$codigo_plan_cuentas = $_GET['term'];
   
   	//$resultSet=$plan_cuentas->getBy("codigo_plan_cuentas LIKE '$codigo_plan_cuentas%'");
   	 
   	 
   	 
   	$columnas ="plan_cuentas.codigo_plan_cuentas,
				  plan_cuentas.nombre_plan_cuentas,
				  plan_cuentas.id_plan_cuentas";
   	$tablas =" public.usuarios,
				  public.entidades,
				  public.plan_cuentas";
   	$where ="plan_cuentas.codigo_plan_cuentas LIKE '$codigo_plan_cuentas%' AND entidades.id_entidades = usuarios.id_entidades AND
   	plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='5'";
   	$id ="plan_cuentas.codigo_plan_cuentas";
   
   
   	$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
   
   
   	if(!empty($resultSet)){
   
   		foreach ($resultSet as $res){
   
   			$_codigo_plan_cuentas[] = $res->codigo_plan_cuentas;
   		}
   		echo json_encode($_codigo_plan_cuentas);
   	}
   
   }
   
   
   
   
   public function AutocompleteComprobantesDevuelveNombre(){
   	session_start();
   	$_id_usuarios= $_SESSION['id_usuarios'];
   
   
   	$plan_cuentas = new PlanCuentasModel();
   	$codigo_plan_cuentas = $_POST['codigo_plan_cuentas'];
   
   
   	$columnas ="plan_cuentas.codigo_plan_cuentas,
				  plan_cuentas.nombre_plan_cuentas,
				  plan_cuentas.id_plan_cuentas";
   	$tablas =" public.usuarios,
				  public.entidades,
				  public.plan_cuentas";
   	$where ="plan_cuentas.codigo_plan_cuentas = '$codigo_plan_cuentas' AND entidades.id_entidades = usuarios.id_entidades AND
   	plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='5'";
   	$id ="plan_cuentas.codigo_plan_cuentas";
   
   
   	$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
   
   
   	$respuesta = new stdClass();
   
   	if(!empty($resultSet)){
   
   		$respuesta->nombre_plan_cuentas = $resultSet[0]->nombre_plan_cuentas;
   		$respuesta->id_plan_cuentas = $resultSet[0]->id_plan_cuentas;
   
   		echo json_encode($respuesta);
   	}
   
   }
   
   
   
   
   public function AutocompleteComprobantesNombre(){
   
   	session_start();
   	$_id_usuarios= $_SESSION['id_usuarios'];
   	$plan_cuentas = new PlanCuentasModel();
   	$nombre_plan_cuentas = strtoupper($_GET['term']);
   
   	//$resultSet=$plan_cuentas->getBy("codigo_plan_cuentas LIKE '$codigo_plan_cuentas%'");
   		
   		
   		
   	$columnas ="plan_cuentas.codigo_plan_cuentas,
				  plan_cuentas.nombre_plan_cuentas,
				  plan_cuentas.id_plan_cuentas";
   	$tablas =" public.usuarios,
				  public.entidades,
				  public.plan_cuentas";
   	$where ="plan_cuentas.nombre_plan_cuentas LIKE '$nombre_plan_cuentas%' AND entidades.id_entidades = usuarios.id_entidades AND
   	plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='5'";
   	$id ="plan_cuentas.codigo_plan_cuentas";
   
   
   	$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
   
   
   	if(!empty($resultSet)){
   
   		foreach ($resultSet as $res){
   
   			$_nombre_plan_cuentas[] = $res->nombre_plan_cuentas;
   		}
   		echo json_encode($_nombre_plan_cuentas);
   	}
   
   }
   
   
   
   
   public function AutocompleteComprobantesDevuelveCodigo(){
   
   	session_start();
   	$_id_usuarios= $_SESSION['id_usuarios'];
   
   	$plan_cuentas = new PlanCuentasModel();
   
   	$nombre_plan_cuentas = $_POST['nombre_plan_cuentas'];
   
   
   	$columnas ="plan_cuentas.codigo_plan_cuentas,
				  plan_cuentas.nombre_plan_cuentas,
				  plan_cuentas.id_plan_cuentas";
   	$tablas =" public.usuarios,
				  public.entidades,
				  public.plan_cuentas";
   	$where ="plan_cuentas.nombre_plan_cuentas = '$nombre_plan_cuentas' AND entidades.id_entidades = usuarios.id_entidades AND
   	plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='5'";
   	$id ="plan_cuentas.codigo_plan_cuentas";
   
   
   	$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
   
   
   	$respuesta = new stdClass();
   
   	if(!empty($resultSet)){
   
   		$respuesta->codigo_plan_cuentas = $resultSet[0]->codigo_plan_cuentas;
   		$respuesta->id_plan_cuentas = $resultSet[0]->id_plan_cuentas;
   
   		echo json_encode($respuesta);
   	}
   
   }
   

   
   
   
   
   
   ///// consulta si existe el cliente registrado
   
   
   
   



   public function AutocompleteComprobantesCedulaCliente(){
   	 
   	session_start();
   	$_id_usuarios= $_SESSION['id_usuarios'];
   	$proveedores = new FC_ProveedoresModel();
   	$ruc_proveedores = $_GET['term'];
   	$tipo_cliente_proveedor = new TipoClienteProveedorModel();
   	
   	 
   	 
   	 
   	$columnas ="fc_proveedores.id_proveedores, 
			  fc_proveedores.ruc_proveedores, 
			  fc_proveedores.razon_social_proveedores, 
			  fc_proveedores.id_ciudad, 
			  fc_proveedores.direccion_proveedores, 
			  fc_proveedores.telefono_proveedores, 
			  fc_proveedores.celular_proveedores, 
			  fc_proveedores.email_proveedores, 
			  fc_proveedores.web_proveedores, 
			  fc_proveedores.retencion_fuente, 
			  fc_proveedores.retencion_iva, 
			  fc_proveedores.ci_contacto_proveedores, 
			  fc_proveedores.nombres_contacto_proveedores, 
			  fc_proveedores.telefono_contacto_proveedores, 
			  fc_proveedores.celular_contacto_proveedores, 
			  fc_proveedores.email_contacto_proveedores, 
			  fc_proveedores.id_entidades, 
			  fc_proveedores.id_tipo_contribuyente, 
			  fc_proveedores.id_tipo_persona, 
			  fc_proveedores.id_tipo_identificacion, 
			  fc_proveedores.id_cuenta_pagar, 
			  fc_proveedores.id_cuenta_cobrar, 
			  fc_proveedores.id_cuenta_anticipo_entregado, 
			  fc_proveedores.id_cuenta_anticipo_recibido, 
			  fc_proveedores.dias_credito_cliente_proveedor, 
			  fc_proveedores.id_tipo_cliente_proveedor,
   			  fc_proveedores.id_usuario";
   	
   	$tablas ="public.fc_proveedores";
   	$where ="fc_proveedores.ruc_proveedores like '$ruc_proveedores%' AND fc_proveedores.id_usuario='$_id_usuarios'";
   	$id ="fc_proveedores.id_proveedores";
   	 
   	 
   	$resultSet=$proveedores->getCondiciones($columnas, $tablas, $where, $id);
   	 
   	 
   	if(!empty($resultSet)){
   		 
   		foreach ($resultSet as $res){
   			
   			$_ruc_proveedores[] = $res->ruc_proveedores;
   		}
   		echo json_encode($_ruc_proveedores);
   	}
   	 
   }
    
    
    
    
   public function AutocompleteComprobantesDevuelveDatosCliente(){
   	session_start();
   	$_id_usuarios= $_SESSION['id_usuarios'];
   	 
   	$plan_cuentas = new PlanCuentasModel();
   	$proveedores = new FC_ProveedoresModel();
   	
  	$ruc_proveedores = $_POST['ruc_proveedores'];
    $id_tipo_cliente_proveedor  = $_POST['id_tipo_cliente_proveedor'];
    
    
    
    
    
   	$columnas ="fc_proveedores.id_proveedores,
			  fc_proveedores.ruc_proveedores,
			  fc_proveedores.razon_social_proveedores,
			  fc_proveedores.id_ciudad,
			  fc_proveedores.direccion_proveedores,
			  fc_proveedores.telefono_proveedores,
			  fc_proveedores.celular_proveedores,
			  fc_proveedores.email_proveedores,
			  fc_proveedores.web_proveedores,
			  fc_proveedores.retencion_fuente,
			  fc_proveedores.retencion_iva,
			  fc_proveedores.ci_contacto_proveedores,
			  fc_proveedores.nombres_contacto_proveedores,
			  fc_proveedores.telefono_contacto_proveedores,
			  fc_proveedores.celular_contacto_proveedores,
			  fc_proveedores.email_contacto_proveedores,
			  fc_proveedores.id_entidades,
			  fc_proveedores.id_tipo_contribuyente,
			  fc_proveedores.id_tipo_persona,
			  fc_proveedores.id_tipo_identificacion,
			  fc_proveedores.id_cuenta_pagar,
			  fc_proveedores.id_cuenta_cobrar,
			  fc_proveedores.id_cuenta_anticipo_entregado,
			  fc_proveedores.id_cuenta_anticipo_recibido,
			  fc_proveedores.dias_credito_cliente_proveedor,
			  fc_proveedores.id_tipo_cliente_proveedor,
   			  fc_proveedores.id_usuario";
   	
   	$tablas ="public.fc_proveedores";
   	
   	if($id_tipo_cliente_proveedor > 0){
   		
   		$where ="fc_proveedores.ruc_proveedores ='$ruc_proveedores' AND   fc_proveedores.id_tipo_cliente_proveedor='$id_tipo_cliente_proveedor' AND fc_proveedores.id_usuario='$_id_usuarios'";
   		 
   	} if($ruc_proveedores !=""){
   		
   		$where ="fc_proveedores.ruc_proveedores ='$ruc_proveedores' AND fc_proveedores.id_usuario='$_id_usuarios'";
   		 
   	}
   	
   	
   	
   	
   	$id ="fc_proveedores.id_proveedores";
   	 
   	 
    
   	$resultSet=$proveedores->getCondiciones($columnas, $tablas, $where, $id);
   	 
   	 
   	$respuesta = new stdClass();
   	 
   	if(!empty($resultSet)){
   		 
   		$respuesta->id_proveedores = $resultSet[0]->id_proveedores;
   		$respuesta->ruc_proveedores = $resultSet[0]->ruc_proveedores;
   		$respuesta->razon_social_proveedores = $resultSet[0]->razon_social_proveedores;
   		$respuesta->id_ciudad = $resultSet[0]->id_ciudad;
   		$respuesta->direccion_proveedores = $resultSet[0]->direccion_proveedores;
   		$respuesta->telefono_proveedores = $resultSet[0]->telefono_proveedores;
   		$respuesta->celular_proveedores = $resultSet[0]->celular_proveedores;
   		$respuesta->email_proveedores = $resultSet[0]->email_proveedores;
   		$respuesta->web_proveedores = $resultSet[0]->web_proveedores;
   		$respuesta->retencion_fuente = $resultSet[0]->retencion_fuente;
   		$respuesta->retencion_iva = $resultSet[0]->retencion_iva;
   		$respuesta->ci_contacto_proveedores = $resultSet[0]->ci_contacto_proveedores;
   		$respuesta->nombres_contacto_proveedores = $resultSet[0]->nombres_contacto_proveedores;
   		$respuesta->telefono_contacto_proveedores = $resultSet[0]->telefono_contacto_proveedores;
   		$respuesta->celular_contacto_proveedores = $resultSet[0]->celular_contacto_proveedores;
   		$respuesta->email_contacto_proveedores = $resultSet[0]->email_contacto_proveedores;
   		$respuesta->id_entidades = $resultSet[0]->id_entidades;
   		$respuesta->id_tipo_contribuyente = $resultSet[0]->id_tipo_contribuyente;
   		$respuesta->id_tipo_persona = $resultSet[0]->id_tipo_persona;
   		$respuesta->id_tipo_identificacion = $resultSet[0]->id_tipo_identificacion;
   		
   		$respuesta->id_cuenta_pagar = $resultSet[0]->id_cuenta_pagar;
   		$id_cuenta_pagar= $resultSet[0]->id_cuenta_pagar;
   		$resultCuenta_Pagar= $plan_cuentas->getBy("id_plan_cuentas='$id_cuenta_pagar'");
   		$respuesta->codigo_plan_cuentas_pagar = $resultCuenta_Pagar[0]->codigo_plan_cuentas;
   		$respuesta->nombre_plan_cuentas_pagar = $resultCuenta_Pagar[0]->nombre_plan_cuentas;
   		
   		
   		 
   		$respuesta->id_cuenta_cobrar = $resultSet[0]->id_cuenta_cobrar;
   		$id_cuenta_cobrar= $resultSet[0]->id_cuenta_cobrar;
   		$resultCuenta_Cobrar= $plan_cuentas->getBy("id_plan_cuentas='$id_cuenta_cobrar'");
   		$respuesta->codigo_plan_cuentas_cobrar = $resultCuenta_Cobrar[0]->codigo_plan_cuentas;
   		$respuesta->nombre_plan_cuentas_cobrar = $resultCuenta_Cobrar[0]->nombre_plan_cuentas;
   		 
   		$respuesta->id_cuenta_anticipo_entregado = $resultSet[0]->id_cuenta_anticipo_entregado;
   		$id_cuenta_anticipo_entregado= $resultSet[0]->id_cuenta_anticipo_entregado;
   		$resultCuenta_anticipo_entregado= $plan_cuentas->getBy("id_plan_cuentas='$id_cuenta_anticipo_entregado'");
   		$respuesta->codigo_plan_cuentas_anticipo_entregado = $resultCuenta_anticipo_entregado[0]->codigo_plan_cuentas;
   		$respuesta->nombre_plan_cuentas_anticipo_entregado = $resultCuenta_anticipo_entregado[0]->nombre_plan_cuentas;
   		
   		
   		$respuesta->id_cuenta_anticipo_recibido = $resultSet[0]->id_cuenta_anticipo_recibido;
   		$id_cuenta_anticipo_recibido= $resultSet[0]->id_cuenta_anticipo_recibido;
   		$resultCuenta_anticipo_recibido= $plan_cuentas->getBy("id_plan_cuentas='$id_cuenta_anticipo_recibido'");
   		$respuesta->codigo_plan_cuentas_anticipo_recibido = $resultCuenta_anticipo_recibido[0]->codigo_plan_cuentas;
   		$respuesta->nombre_plan_cuentas_anticipo_recibido = $resultCuenta_anticipo_recibido[0]->nombre_plan_cuentas;
   		 
   		
   		
   		$respuesta->dias_credito_cliente_proveedor = $resultSet[0]->dias_credito_cliente_proveedor;
   		$respuesta->id_tipo_cliente_proveedor = $resultSet[0]->id_tipo_cliente_proveedor;
   		 
   		
   		
   		echo json_encode($respuesta);
   	}
   	 
   }
   
   
   
   
   
}
?>