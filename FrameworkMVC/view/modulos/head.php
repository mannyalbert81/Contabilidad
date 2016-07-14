<!DOCTYPE html>
<html lang="en">
<head>

<?php require_once 'config/global.php';?> 

  <title>AllCoercive</title>
  <link rel="shortcut icon" href="view/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
   		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>   
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<link rel="stylesheet" href="view/css/estilos.css">
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
		
 
 <script type=text/javascript>
//setTimeout("document.location=document.location",2000);
$(document).ready(function(){

	var $divcontenedor = $("#div_head");

	$divcontenedor.empty();

    var datos=1;


	 var result=  $.post("<?php echo $helper->url("VerNotificaciones","iniciaNotificaciones"); ?>",  "json");

	 result.done(function( result_notificaciones ) {
		 
		 cantidad_notificaciones = JSON.parse(result_notificaciones);
		var notificaciones ='<button type="button" id="boton_notificacion" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="badge">'+cantidad_notificaciones.length+'</span></button>';
         
		
		 notificaciones=notificaciones+'<ul class="dropdown-menu" id="ul_notificacion">'+'</ul>';

		  $divcontenedor.append(notificaciones);

		  var $ul=$("#ul_notificacion");

		  $.post("<?php echo $helper->url("VerNotificaciones","iniciaNotificaciones"); ?>", datos, function(resultNotificaciones) {

               
			  $.each(resultNotificaciones, function(index, value) {
				  $ul.append('<li  ><a href="index.php?controller=VerNotificaciones&action=actualizaNotificaciones&id_notificaciones='+value.id_notificaciones+'&controlador='+value.controlador_tipo_notificacion+'&acciones='+value.accion_tipo_notificacion+'">'+ value.descripcion_notificaciones+'</a></li>');	
                  
			 
                		if (value.controlador_tipo_notificacion == 0){

                			   	
                				alert('entro');
                        }

                		else{

                			
    			 	    }

			  });
          	      		 
                	
                	
              
		 		

		 		 	 		   
		  }, 'json');
		  
	 });

});
	

</script>  

<script>
$(document).ready(function(){
	$("46").click(function(){
		alert("hola");

		});
});

</script>

<!-- para hacer que refresque pag -->
	
	<script>
    $(document).ready(function(){
        
    	setTimeout( '$("#noti_btn").load();' , 1000);
    });
	</script>
 
	
</head>
<body>

<div class="container"  style=" -webkit-box-shadow: 0px 2px 2px 2px rgba(0,0,0,0.49);-moz-box-shadow: 0px 2px 2px 4px rgba(0,0,0,0.49); box-shadow: 0px 2px 2px 4px rgba(0,0,0,0.49);">
  
  
  <div class="row" style=" background-color:#d93e1b;">
  
  <div style=" margin-top: 10px; "   class="col-xs-6 col-md-8"  >
  <img src="view/images/logo-coctiva.png" class="img-responsive" alt="Responsive image">
  </div>
  
 	 
  <!-- aqui va la class pull-right.... -->
  
  
  <div  style="margin-top: 20px;" class="col-xs-6 col-md-4">
 		<div class="">
 		
 		<p> <strong> <?php //echo CLIENTE?>  </strong>  </p>
 		</div>	
		<?php  
		$status = session_status();
		
			 if  (isset( $_SESSION['nombre_usuarios'] ))  {  
		?>
		  <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $_SESSION['id_usuarios']; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="<?php echo $_SESSION['id_usuarios'];?>" width="70" height="60"  style="float:left;" >
 		
		  <div class="col-xs-7 col-md-5">
			
			<div class="dropdown">
			
				  <button id="noti_btn" class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-user" ><FONT  SIZE=1><?php echo " ".$_SESSION['nombre_usuarios'];?></FONT></span>
				  
				  <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				    <li><a href="index.php?controller=Usuarios&action=cerrar_sesion">Cerrar Sesión</a></li>
				    <li><a href="index.php?controller=Usuarios&action=Actualiza">Actualizar Datos de Usuario</a></li>
				    <li><a href="#">Conectado desde: <?php echo $_SESSION['ip_usuarios']?></a></li>
				  </ul>
								  
			</div>
		</div>
			<!-- empieza notificacion -->
		<div class="col-xs-7 col-md-3" style="float: left; margin-left: 5px;">

            <form action="<?php echo $helper->url("",""); ?>" method="post" >
            <?php 
            
            $resultNotificaciones=$_SESSION['resultNotificaciones'];
            $cantidad=count($resultNotificaciones);
            ?>
            
			<div class="dropdown" id="">
			<button type="button" id="boton_notificacion" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="badge"><?php echo $cantidad; ?></span></button>
			<?php if($cantidad>0){ ?>
			
			<ul class="dropdown-menu" id="ul_notificacion" style="min-width: 400px; overflow: auto; margin: 2px 0 0 -150px;" >
			<?php foreach ($resultNotificaciones as $res){?>
			<?php $fecha= new DateTime($res->creado);?>
			
			<li class="list-group-item" >
			<div   >
			
			<input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $res->usuario_origen_notificaciones; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="<?php echo $res->usuario_origen_notificaciones;?>" width="50" height="40"  style="float:left;" >
 		
			</div>
			<a href="index.php?controller=Notificaciones&action=actualizaNotificaciones&id_notificaciones=<?php echo $res->id_notificaciones;?>" style="display: inline-block; padding: 3px 5px;">
			<?php echo '<b>'.$res->descripcion_notificaciones.'</b>'; echo ' '.$res->usuario_usuarios;  echo '<br>'.'('.$res->cantidad_cartones_notificaciones.')'; echo '   '; echo 'Fecha '; echo $fecha->format('Y-m-d');?>
			</a>
			</li>			
			<?php }?>
			</ul>
			<?php }?>
			</div>
			</form>
		</div>
		
		

			
		 	 <?php  ?> 
		<?php 
			 }
			 else 
			 {     ?>
		
		
			<div class="dropdown">
					  <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-lock" > Iniciar Sesión </span>
					  
					  </button>
					  
		    </div>
		<?php }
				
		 ?>
		 
		 
   </div>  
  

<!-- aqui termina la class pull-right -->



 
  </div>
        
</div>

   
</body>
</html>