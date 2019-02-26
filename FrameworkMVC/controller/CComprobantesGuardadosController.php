<?php

class CComprobantesGuardadosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		
		session_start();
        
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$resultEdit = "";
			$id_usuarios=$_SESSION["id_usuarios"];
			
			
			$ccomprobantes_guardados= new CComprobantesGuardadosModel();
			
			//Conseguimos todos los usuarios//
			$columnas_set="ccomprobantes_guardados.id_ccomprobantes_guardados,
				  ccomprobantes_guardados.identificador_ccomprobantes_guardados,
				  entidades.nombre_entidades";
			$tablas_set="public.ccomprobantes_guardados,
				  public.entidades,
				  public.usuarios";
			$where_set="entidades.id_entidades = ccomprobantes_guardados.id_entidades AND
			usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$id_usuarios'";
			$id_set="entidades.nombre_entidades";
			$resultSet= $ccomprobantes_guardados->getCondiciones($columnas_set, $tablas_set, $where_set, $id_set);
			
			
			
			$ccomprobantes_guardados= new CComprobantesGuardadosModel();
			$entidades=new EntidadesModel();
			
			$columnas="entidades.id_entidades, entidades.nombre_entidades";
			$tablas="public.usuarios, public.entidades";
			$where="usuarios.id_entidades=entidades.id_entidades AND usuarios.id_usuarios='$id_usuarios'";
			$id="id_entidades";
			$resultEnt= $entidades->getCondiciones($columnas, $tablas, $where, $id);
			
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "CComprobantesGuardados";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $ccomprobantes_guardados->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_ccomprobantes_guardados"])   )
				{

					$nombre_controladores = "CComprobantesGuardados";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $ccomprobantes_guardados->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_ccomprobantes_guardados = $_GET["id_ccomprobantes_guardados"];
						$columnas_set1 = "ccomprobantes_guardados.id_ccomprobantes_guardados, ccomprobantes_guardados.identificador_ccomprobantes_guardados, entidades.nombre_entidades, entidades.id_entidades";
						$tablas_set1   = "public.ccomprobantes_guardados, public.entidades";
						$where_set1    = "ccomprobantes_guardados.id_entidades = entidades.id_entidades AND ccomprobantes_guardados.id_ccomprobantes_guardados = '$_id_ccomprobantes_guardados' "; 
						$id_set1       = "identificador_ccomprobantes_guardados";
							
						$resultEdit = $ccomprobantes_guardados->getCondiciones($columnas_set1 ,$tablas_set1 ,$where_set1, $id_set1);

						$traza=new TrazasModel();
						$_nombre_controlador = "CComprobantesGuardados";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_ccomprobantes_guardados;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Comprobantes Guardados"
					
						));
					
					
					}
					
				}
		
				
				$this->view("CComprobantesGuardados",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultEnt"=>$resultEnt
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Comprobantes Guardados"
				
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
	
	public function InsertaCComprobantesGuardados(){
			
		session_start();

		
		$tipo_cierre=new CComprobantesGuardadosModel();
		$nombre_controladores = "CComprobantesGuardados";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $ccomprobantes_guardados->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_cierre=new TipoCierreModel();
		   
		   	if (isset ($_POST["Guardar"]) )
				
							
			{
				$_nombre_tipo_cierre = $_POST["nombre_tipo_cierre"];
				$_id_entidades = $_POST["id_entidades"];
				
				if($_nombre_tipo_cierre==""){
					
					
				}
				else{
					
					
				
				
				
				if(isset($_POST["id_tipo_cierre"])) 
				{
					
					$_id_tipo_cierre = $_POST["id_tipo_cierre"];
					$colval = " nombre_tipo_cierre = '$_nombre_tipo_cierre'   ";
					$tabla = "tipo_cierre";
					$where = "id_tipo_cierre = '$_id_tipo_cierre'    ";
					
					$resultado=$tipo_cierre->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_tipo_cierre";
				
				$parametros = " '$_nombre_tipo_cierre','$_id_entidades'  ";
					
				$tipo_cierre->setFuncion($funcion);
		
				$tipo_cierre->setParametros($parametros);
		
		
				$resultado=$tipo_cierre->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Cierre";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_cierre;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
				}
		
			}
			$this->redirect("TipoCierre", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de Cierre"
		
			));
		
		
		}
	

		$tipo_cierre=new TipoCierreModel();

		$nombre_controladores = "TipoCierre";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_cierre->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_cierre=new TipoCierreModel();
		
			
			
			if (isset ($_POST["nombre_tipo_cierre"]) )
				
			{
				$_nombre_tipo_cierre = $_POST["nombre_tipo_cierre"];
				
				if(isset($_POST["id_tipo_cierre"]))
				{
				$_id_tipo_cierre = $_POST["id_tipo_cierre"];
				$colval = " nombre_tipo_cierre = '$_nombre_tipo_cierre'   ";
				$tabla = "tipo_cierre";
				$where = "id_tipo_cierre = '$_id_tipo_cierre'    ";
					
				$resultado=$tipo_cierre->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_tipo_cierre";
				
				$parametros = " '$_nombre_tipo_cierre'  ";
					
				$tipo_cierre->setFuncion($funcion);
		
				$tipo_cierre->setParametros($parametros);
		
		
				$resultado=$tipo_cierre->Insert();
			 }
		
			}
			$this->redirect("TipoCierre", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de Cierre"
		
			));
		
		
		}
		
	}




	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Roles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_cierre"]))
			{
				$id_tipo_cierre=(int)$_GET["id_tipo_cierre"];
				
				$tipo_cierre=new TipoCierreModel();
				
				$tipo_cierre->deleteBy(" id_tipo_cierre",$id_tipo_cierre);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "TipoCierre";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_cierre;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("TipoCierre", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Cierre"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$tipo_cierre=new TipoCierreModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("TipoCierre",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>