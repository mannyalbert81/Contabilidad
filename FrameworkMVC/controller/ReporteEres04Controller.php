<?php

class ReporteEres04Controller extends ControladorBase{

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
		$Eres04 = new Eres04Model(); 
		$usuarios = new UsuariosModel();
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ReporteEres04";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $usuarios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
			
		
					if(isset($_POST['reporte']))
					{
						
						//parametros q van al servidor de reportes
				
						$pagina="conEres04.aspx";
												
						$conexion_rpt = array();
						$conexion_rpt['pagina']=$pagina;
						//$conexion_rpt['port']="59584";
						
						$this->view("ReporteRpt", array(
								"conexion_rpt"=>$conexion_rpt
						));
						
						die();
						
					}
					
	
		
	
				
				$this->view("ReporteEres04",array(
						"resultSet"=>$resultSet, 
						
						
							
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Reporte Eres 04"
	
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
}
?>