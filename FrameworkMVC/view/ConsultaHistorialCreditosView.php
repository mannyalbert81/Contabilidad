 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Reporte Creditos - contabilidad 2016</title>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  			   
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 		
 		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
		<script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		</script>
		
       <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
         
         	<script>
	$(document).ready(function(){
			$("#fecha_hasta").change(function(){
				 var startDate = new Date($('#fecha_desde').val());

                 var endDate = new Date($('#fecha_hasta').val());

                 if (startDate > endDate){
 
                    $("#mensaje_fecha_hasta").text("Fecha desde no debe ser mayor ");
		    		$("#mensaje_fecha_hasta").fadeIn("slow"); //Muestra mensaje de error  
		    		$("#fecha_hasta").val("");

                        }
				});

			 $( "#fecha_hasta" ).focus(function() {
				  $("#mensaje_fecha_hasta").fadeOut("slow");
			   });
			});
        </script>
        
    <script type="text/javascript">
	$(document).ready(function(){
		//load_juicios(1);

		$("#buscar").click(function(){

			load_historial(1);
			
			});
	});

	
	function load_historial(pagina){
		
		//iniciar variables
		 var con_operacion=$("#operacion").val();
		 var con_cuenta=$("#cuenta").val();
		 var con_s=$("#s").val();
		 var con_aa_ddd=$("#aa_ddd").val();
		 var con_fecha_concede=$("#fecha_concede").val();
		 var con_fecha_vencimiento=$("#fecha_vencimiento").val();


		
		 

		  var con_datos={
				  operacion:con_operacion,
				  cuenta:con_cuenta,
				  s:con_s,
				  aa_ddd:con_aa_ddd,
				  fecha_concede:con_fecha_concede,
				  fecha_vencimiento:con_fecha_vencimiento,
				  action:'ajax',
				  page:pagina
				  };


		$("#historial").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("ConsultaHistorialCreditos","index");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#historial").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".div_historial").html(data).fadeIn('slow');
				$("#historial").html("");
			}
		})
	}
	
	</script>

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       <?php
       
       $sel_operacion = "";
       $sel_cuenta="";
       $sel_s="";
       $sel_aa_ddd="";
       $sel_fecha_concede="";
       $sel_fecha_vencimiento="";
        
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	$sel_operacion = $_POST['operacion'];
        $sel_cuenta=$_POST['cuenta'];
       	$sel_s=$_POST['s'];
        $sel_aa_ddd=$_POST['aa_ddd'];
       	$sel_fecha_concede=$_POST['fecha_concede'];
       	$sel_fecha_vencimiento=$_POST['fecha_vencimiento'];
       
       }
       
    
       
       
       ?>
 
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("ConsultaHistorialCreditos","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" target="_blank">
         
                 <!-- comienxza busqueda  -->
                 
                 <br>         
         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Consulta General de Prestamos</h4>
	         </div>
	         <div class="panel-body">
			
				 	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  					
          <div class="col-lg-2 col-md-2 xs-6">
         		<p class="formulario-subtitulo" ># Operación:</p>
			  	<input type="text"  name="operacion" id="operacion" value="<?php echo $sel_operacion;?>" class="form-control "/> 
			   
		 </div>
		 
		  <div class="col-lg-2 col-md-2 xs-6">
         		<p class="formulario-subtitulo" ># Cuenta:</p>
			  	<input type="text"  name="cuenta" id="cuenta" value="<?php echo $sel_cuenta;?>" class="form-control "/> 
			    
		 </div>
		 
		 <div class="col-lg-2 col-md-2 xs-6">
			  	<p  class="formulario-subtitulo">Tipo:</p>
			  	<select name="s" id="s"  class="form-control" >
			  		<option value=""><?php echo "--TODOS--";  ?> </option>
					<?php foreach($resultS as $res) {?>
						<option value="<?php echo $res->s; ?>"<?php if($sel_s==$res->s){echo "selected";}?> ><?php echo $res->s;  ?> </option>
			            <?php } ?>
				</select>

         </div>
         <div class="col-lg-2 col-md-2 xs-6">
			  	<p  class="formulario-subtitulo">Grupo:</p>
			  	<select name="aa_ddd" id="aa_ddd"  class="form-control" >
			  		<option value=""><?php echo "--TODOS--";  ?> </option>
					<?php foreach($resultAA_DDD as $res) {?>
						<option value="<?php echo $res->aa_ddd; ?>"<?php if($sel_aa_ddd==$res->aa_ddd){echo "selected";}?> ><?php echo $res->aa_ddd;  ?> </option>
			            <?php } ?>
				</select>

         </div>
         
          
         <div class="col-lg-2 col-md-2 xs-6">
         		<p class="formulario-subtitulo" >Desde:</p>
			  	<input type="date"  name="fecha_concede" id="fecha_concede" value="<?php echo $sel_fecha_concede;?>" class="form-control "/> 
			
		 </div>
         
          <div class="col-lg-2 col-md-2 xs-6">
          		<p class="formulario-subtitulo" >Hasta:</p>
			  	<input type="date"  name="fecha_vencimiento" id="fecha_vencimiento" value="<?php echo $sel_fecha_vencimiento;?>" class="form-control "/> 
			   
		</div>
		 
  			</div>
  		 <div class="col-lg-12">
		 <div class="col-lg-12">
	     </div>
	     </div>
  		
  		<div class="col-lg-12" style="text-align: center; margin-top: 10px">
  		    
		 <button type="button" id="buscar" name="buscar" value="Buscar"   class="btn btn-info" style="margin-top: 10px;"><i class="glyphicon glyphicon-search"></i></button>
		 <button type="submit" id="reporte_rpt" name="reporte_rpt" value="Reporte"   class="btn btn-success" style="margin-top: 10px;"><i class="glyphicon glyphicon-print"></i></button>         
	  
	 
	     </div>
		 
		</div>
		    
		    </div>
	        </div>
	        </div>
         
         
         
         
 
        
		 
		 
		 <div class="col-lg-12">
		 
	     <div class="col-lg-12">
	     
	     <div style="height: 200px; display: block;">
		
		 <h4 style="color:#ec971f;"></h4>
			  <div>					
					<div id="historial" style="position: absolute;	text-align: center;	top: 10px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="div_historial" ></div><!-- Datos ajax Final -->
		      </div>
		       <br>
				  
		 </div>
		 
		 </div>
		 
		
		 
		 </div>
		 
	
      
       </form>
     
      </div>
     
  </div>
      <!-- termina
       busqueda  -->
       
 
   </body>  

    </html>   
    
  
    