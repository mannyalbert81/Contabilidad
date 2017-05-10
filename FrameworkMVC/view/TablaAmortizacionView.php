	
 
    <?php include("view/modulos/head.php"); ?>
    <?php include("view/modulos/menu.php"); ?>
    <?php include("view/CARTERA/modal/modal_clientes.php");?>
  
      
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Tipo de Identificacion - Contabilidad 2016</title>
        <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		   <script type="text/javascript" src="view/CARTERA/js/VentanaCentrada.js"></script>
          <script type="text/javascript" src="view/CARTERA/js/procesos-fc_clientes.js"></script>
		  <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		   <script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		</script>
			
			
			<script>
		$(document).ready(function(){

			$("#buscar").click(function(){

			
				var numero_operacion = $("#numero_operacion").val();
				
				

				if (numero_operacion == "")
				{
					$("#mensaje_razon_social_clientes").text("Ingrese un # Operación");
		    		$("#mensaje_razon_social_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
				}
				

				});

			
				
				 $( "#numero_operacion" ).focus(function() {
					 $("#mensaje_razon_social_clientes").fadeOut("slow");
					 
					  return true;
				    });
			 
        });
		</script>
			
				
		<script>
		$(document).ready(function(){

			$("#Generar").click(function(){

				var numero_credito_amortizacion_cabeza = $("#numero_credito_amortizacion_cabeza").val();
				var numero_pagare_amortizacion_cabeza = $("#numero_pagare_amortizacion_cabeza").val();
				var id_tipo_creditos = $("#id_tipo_creditos").val();
				var capital_prestado_amortizacion_cabeza = $("#capital_prestado_amortizacion_cabeza").val();
				var tasa_interes_amortizacion_cabeza = $("#tasa_interes_amortizacion_cabeza").val();
				var plazo_meses_amortizacion_cabeza = $("#plazo_meses_amortizacion_cabeza").val();
				var fecha_amortizacion_cabeza = $("#fecha_amortizacion_cabeza").val();


				   
				
				if (numero_credito_amortizacion_cabeza == "" )
		    	{
					$("#mensaje_numero_credito_amortizacion_cabeza").text("Ingrese un número de crédito");
		    		$("#mensaje_numero_credito_amortizacion_cabeza").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
				if (numero_pagare_amortizacion_cabeza == "" )
				{
					$("#mensaje_numero_pagare_amortizacion_cabeza").text("Ingrese un número de pagaré");
		    		$("#mensaje_numero_pagare_amortizacion_cabeza").fadeIn("slow"); //Muestra mensaje de error
		            return false;
				}
				if (id_tipo_creditos == "" )
		    	{
					$("#mensaje_id_tipo_creditos").text("Ingrese un tipo de crédito");
		    		$("#mensaje_id_tipo_creditos").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
				if (capital_prestado_amortizacion_cabeza == "" )
		    	{
					$("#mensaje_capital_prestado_amortizacion_cabeza").text("Ingrese un capital");
		    		$("#mensaje_capital_prestado_amortizacion_cabeza").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
				if (tasa_interes_amortizacion_cabeza == "")
		    	{
					$("#mensaje_tasa_interes_amortizacion_cabeza").text("Ingrese taza y plazo");
		    		$("#mensaje_tasa_interes_amortizacion_cabeza").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }

				if (plazo_meses_amortizacion_cabeza == "")
		    	{
					$("#mensaje_tasa_interes_amortizacion_cabeza").text("Ingrese taza y plazo");
		    		$("#mensaje_tasa_interes_amortizacion_cabeza").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
				
				if (fecha_amortizacion_cabeza == "" )
		    	{
					$("#mensaje_fecha_amortizacion_cabeza").text("Ingrese Fecha");
		    		$("#mensaje_fecha_amortizacion_cabeza").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }

				});

			 $( "#numero_credito_amortizacion_cabeza" ).focus(function() {
				 
				  $("#mensaje_numero_credito_amortizacion_cabeza").fadeOut("slow");
				  return true;
			    });
				 $( "#numero_pagare_amortizacion_cabeza" ).focus(function() {
				 
				  $("#mensaje_numero_pagare_amortizacion_cabeza").fadeOut("slow");
				  return true;
			    });
			 $( "#id_tipo_creditos" ).focus(function() {
				 
				  $("#mensaje_id_tipo_creditos").fadeOut("slow");
				  return true;
			    });
			 $( "#capital_prestado_amortizacion_cabeza" ).focus(function() {
				 
				  $("#mensaje_capital_prestado_amortizacion_cabeza").fadeOut("slow");
				  return true;
			    });
			    
			 $( "#tasa_interes_amortizacion_cabeza" ).focus(function() {
				 
				  $("#mensaje_tasa_interes_amortizacion_cabeza").fadeOut("slow");
				  
				  return true;
			    });


			 $( "#plazo_meses_amortizacion_cabeza" ).focus(function() {
				 
				  $("#mensaje_tasa_interes_amortizacion_cabeza").fadeOut("slow");
				  return true;
			    });

			 $( "#fecha_amortizacion_cabeza" ).focus(function() {
				 
				  $("#mensaje_fecha_amortizacion_cabeza").fadeOut("slow");
				  return true;
			    });
			 
        });
		</script>
		
		
		
      <script >   
    function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
    if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
     }
    </script > 
  
    </head>
   <body class="cuerpo">
   
       
   
       
       
 <?php

 $sel_ruc_clientes="";
 $sel_razon_social_clientes="";
 $sel_numero_credito_amortizacion_cabeza="";
 $sel_numero_pagare_amortizacion_cabeza="";
 $sel_id_tipo_creditos="";
 $sel_capital_prestado_amortizacion_cabeza="";
 $sel_tasa_interes_amortizacion_cabeza="";
 $sel_plazo_meses_amortizacion_cabeza="";
 $sel_interes_normal_mensual_amortizacion_cabeza="";
 $sel_plazo_dias_amortizacion_cabeza="";
 $sel_cantidad_cuotas_amortizacion_cabeza="";
 $sel_valor_cuotas_amortizacion_cabeza="";
 $sel_interes_mora_mensual_amortizacion_cabeza="";
 $sel_fecha_amortizacion_cabeza="";
 $sel_id_fc_clientes="";
 $sel_numero_operacion="";
 
 if($_SERVER['REQUEST_METHOD']=='POST' )
 {
 	$sel_numero_operacion=$_POST['numero_operacion'];
 	$sel_ruc_clientes=$_POST['ruc_clientes'];
 	$sel_id_fc_clientes=$_POST['id_fc_clientes'];
 	$sel_razon_social_clientes=$_POST['razon_social_clientes'];
	$sel_numero_credito_amortizacion_cabeza=$_POST['numero_credito_amortizacion_cabeza'];
 	$sel_numero_pagare_amortizacion_cabeza=$_POST['numero_pagare_amortizacion_cabeza'];
 	$sel_id_tipo_creditos=$_POST['id_tipo_creditos'];
 	$sel_capital_prestado_amortizacion_cabeza=$_POST['capital_prestado_amortizacion_cabeza'];
 	$sel_tasa_interes_amortizacion_cabeza=$_POST['tasa_interes_amortizacion_cabeza'];
 	$sel_plazo_meses_amortizacion_cabeza=$_POST['plazo_meses_amortizacion_cabeza'];
 	$sel_interes_normal_mensual_amortizacion_cabeza=$_POST['interes_normal_mensual_amortizacion_cabeza'];
 	$sel_plazo_dias_amortizacion_cabeza=$_POST['plazo_dias_amortizacion_cabeza'];
 	$sel_cantidad_cuotas_amortizacion_cabeza=$_POST['cantidad_cuotas_amortizacion_cabeza'];
 	$sel_valor_cuotas_amortizacion_cabeza=$_POST['valor_cuotas_amortizacion_cabeza'];
 	$sel_interes_mora_mensual_amortizacion_cabeza=$_POST['interes_mora_mensual_amortizacion_cabeza'];
 	$sel_fecha_amortizacion_cabeza=$_POST['fecha_amortizacion_cabeza'];
 }

 		$interes=null;
       $total=null;
       $porcentaje_capital=null;
       $total_capital=0;
       
       if(!empty($resultDatos)){
       	foreach ($resultDatos as $res){
       		$interes=0;
       		$total=$res['total'];
       		$porcentaje_capital=$res['porcentaje_capital'];
       		$total_capital=$res['total_capital'];
       	}
       }
       
  
       
       $fecha_actual=strtotime(Date("Y-m-d"));
       $hoy=Date("y-m-d");
       ?>
 
  
 
  
  <div class="container" >
  
  <div class="row" style="background-color: #FAFAFA;">	
  
       <!-- empieza el form --> 
       
      <form  action="<?php echo $helper->url("TablaAmortizacion","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" style=" padding-bottom:300px;">
            <br>
   
	         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Tabla de Amortización</h4>
	         </div>
	         <div class="panel-body">
  			 <div class="row">
  			 <div class="form-group" style="margin-top: 25px;">
		    	<div class="col-xs-3 col-md-3" style="text-align: center;">
			  	 <label for="numero_operacion" class="control-label">Nro. Operación:</label>
			  	<input type="text"  name="numero_operacion" id="numero_operacion" value="<?php if ($sel_numero_operacion!="")  {echo $sel_numero_operacion;} else { if (!empty($resultRes)) {  foreach($resultRes as $resEdit) {echo $resEdit->numero_operacion;} }  }?>"  class="form-control"/> 
			    <div id="mensaje_razon_social_clientes" class="errores"></div>
			    </div>
            	</div>
  			   <div class="form-group">
		    	<div class="col-xs-2 col-md-2" style="text-align: center;">
			  	 <label for="ruc_clientes" class="control-label">Nro. Identificación:</label>
			  	<input type="text"  name="ruc_clientes" id="ruc_clientes" value="<?php if (!empty($resultRes)) {  foreach($resultRes as $resEdit) {echo $resEdit->ruc_clientes;} }else {echo $sel_ruc_clientes; }?>" onkeypress="return numeros(event)" class="form-control" readonly/> 
			   <input type="hidden"  name="id_fc_clientes" id="id_fc_clientes" value="<?php if (!empty($resultRes)) {  foreach($resultRes as $resEdit) {echo $resEdit->id_clientes;} } else  {echo $sel_id_fc_clientes;} ?>" class="form-control"/> 
			   
            	</div>
            	</div>
		   		<div class="form-group">
		   		<div class="col-xs-4 col-md-4" style="text-align: center;">
			  	<label for="razon_social_clientes" class="control-label">Razón Social:</label>
			  	<input type="text"  name="razon_social_clientes" id="razon_social_clientes" value="<?php if (!empty($resultRes)) {  foreach($resultRes as $resEdit) {echo $resEdit->razon_social_clientes;} }  else {echo $sel_razon_social_clientes;} ?>" class="form-control" readonly/> 
			   	
            	</div>
              </div>
		   	
		   <div class="col-xs-3 col-md-3">
			 <input type="submit" id="buscar" name="buscar"  value="Buscar" class="btn btn-info " style="margin-top: 23px;"/> 	
		     <button  type="button" class="btn btn-warning glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal" style="margin-top: 20px;"></button>
		
		  </div>
		  
		
		  </div>
         
           <br>
           <div class="row">
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="numero_credito_amortizacion_cabeza" class="control-label">Nro. Crédito:</label>
                                  <input type="text" class="form-control" id="numero_credito_amortizacion_cabeza" name="numero_credito_amortizacion_cabeza" value="<?php echo $sel_numero_credito_amortizacion_cabeza	; ?>" onkeypress="return numeros(event)"  placeholder="#">
                                  <span class="help-block"></span>
                                  <div id="mensaje_numero_credito_amortizacion_cabeza" class="errores"></div>	
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="numero_pagare_amortizacion_cabeza" class="control-label">Nro. Pagare:</label>
                                  <input type="text" class="form-control" id="numero_pagare_amortizacion_cabeza" name="numero_pagare_amortizacion_cabeza" value="<?php echo $sel_numero_pagare_amortizacion_cabeza; ?>"  onkeypress="return numeros(event)" placeholder="#">
                                  <span class="help-block"></span>
                                  <div id="mensaje_numero_pagare_amortizacion_cabeza" class="errores"></div>
		    </div>
		    </div>
			  <div class="col-xs-2 col-md-2">
		    <div class="form-group">
					            <label for="id_tipo_creditos" class="control-label">Tipo Crédito:</label>
					           <select name="id_tipo_creditos" id="id_tipo_creditos"  class="form-control" >
                                  
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultCre as $res) {?>
									
										<option value="<?php echo $res->id_tipo_creditos; ?>" <?php if($sel_id_tipo_creditos==$res->id_tipo_creditos){echo "selected";}?>   ><?php echo $res->nombre_tipo_creditos; ?> </option>
							        	
							        <?php } ?>
								   </select> 
                                  <div id="mensaje_id_tipo_creditos" class="errores"></div>
					           
		     </div>
		     </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="capital_prestado_amortizacion_cabeza" class="control-label">Cap. Prestado:</label>
                                  <input type="text" class="form-control" id="capital_prestado_amortizacion_cabeza" name="capital_prestado_amortizacion_cabeza" value="<?php echo $sel_capital_prestado_amortizacion_cabeza;?>" onkeypress="return numeros(event)" placeholder="$">
                                  <span class="help-block"></span>
                                  <div id="mensaje_capital_prestado_amortizacion_cabeza" class="errores"></div>
		    </div>	
		    </div>
			<div class="col-xs-1 col-md-1">
		    <div class="form-group">
		    
		     					  <label for="tasa_interes_amortizacion_cabeza" class="control-label">Tasa:</label>
                                  <input type="text" class="form-control" id="tasa_interes_amortizacion_cabeza" name="tasa_interes_amortizacion_cabeza" value="<?php echo $sel_tasa_interes_amortizacion_cabeza;?>" onkeypress="return numeros(event)" placeholder="%">
                                  
                                  <div id="mensaje_tasa_interes_amortizacion_cabeza" class="errores"></div>
		    </div>
		    </div>
		    
		   
		    
		    <div class="col-xs-1 col-md-1">
		    <div class="form-group">
		    
		     					  <label for="plazo_meses_amortizacion_cabeza" class="control-label">Plazo:</label>
                                  <input type="text" class="form-control" id="plazo_meses_amortizacion_cabeza" name="plazo_meses_amortizacion_cabeza" value="<?php echo $sel_plazo_meses_amortizacion_cabeza;?>" onkeypress="return numeros(event)" placeholder="#">
                                 
                                  <div id="mensaje_plazo_meses_amortizacion_cabeza" class="errores"></div>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="fecha_amortizacion_cabeza" class="control-label">Fecha: </label>
                                  <input type="date" class="form-control" id="fecha_amortizacion_cabeza" name="fecha_amortizacion_cabeza" value="<?php echo $sel_fecha_amortizacion_cabeza; ?>" >
                                 
                                  <div id="mensaje_fecha_amortizacion_cabeza" class="errores"></div>
		    </div>
		    </div>
			</div>
			
			
			
			
			</div>
			
            <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
             					  <button type="submit" id="GenerarAutomatico" name="GenerarAutomatico" onclick="this.form.action='<?php echo $helper->url("TablaAmortizacion","InsertaTablaAmortizacionAutomatica"); ?>'" class="btn btn-info" >Guardar Automatico</button>
                                   <?php if(!empty($resultRes)){?>
            					   <input type="submit" id="Generar" name="Generar"  value="Generar" class="btn btn-warning " />
            					   <?php } ?>
            					   <?php if(!empty($resultDatos)){?>
                                   <button type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php echo $helper->url("TablaAmortizacion","InsertaTablaAmortizacion"); ?>'" class="btn btn-success" >Guardar</button>
                                   <?php } ?>
            </div>
            </div>
            </div>
            </div>
	        </div>
	        
	        
	        
	        <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-body">
	        <div class="row">
		 	<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="interes_normal_mensual_amortizacion_cabeza" class="control-label">Interes Mensual:</label>
                                  <input type="text" class="form-control" id="interes_normal_mensual_amortizacion_cabeza" name="interes_normal_mensual_amortizacion_cabeza" value="<?php if (!empty($interes_mensual)) { echo number_format($interes_mensual,4); } else { }?>"  placeholder="0.00" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="plazo_dias_amortizacion_cabeza" class="control-label">Plazo Dias:</label>
                                  <input type="text" class="form-control" id="plazo_dias_amortizacion_cabeza" name="plazo_dias_amortizacion_cabeza" value="<?php if (!empty($plazo_dias)) {  echo $plazo_dias; }  else { }?>"  placeholder="#" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="cantidad_cuotas_amortizacion_cabeza" class="control-label">Can. Cuotas:</label>
                                  <input type="text" class="form-control" id="cantidad_cuotas_amortizacion_cabeza" name="cantidad_cuotas_amortizacion_cabeza" value="<?php if (!empty($cant_cuotas)) { echo $cant_cuotas; }  else { }?>"  placeholder="#" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="interes_mora_mensual_amortizacion_cabeza" class="control-label">Mora:</label>
                                  <input type="text" class="form-control" id="interes_mora_mensual_amortizacion_cabeza" name="interes_mora_mensual_amortizacion_cabeza" value="<?php if (!empty($tasa_mora)) {  foreach($tasa_mora as $res) {echo number_format($res->valor_intereses,2);} }else { }  ?>"  placeholder="0.00" readonly>
                                  <span class="help-bloc$resultDatos2k"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="interes_normal_mensual_amortizacion_cabeza" class="control-label">Mora. Mensual</label>
                                  <input type="text" class="form-control" id="interes_normal_mensual_amortizacion_cabeza" name="interes_normal_mensual_amortizacion_cabeza" value="<?php if (!empty($mora_mensual)) { echo $mora_mensual; } else{  }?>"  placeholder="0.00" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
		     <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="valor_cuotas_amortizacion_cabeza" class="control-label">Valor Cuota:</label>
                                  <input type="text" class="form-control" id="valor_cuotas_amortizacion_cabeza" name="valor_cuotas_amortizacion_cabeza" value="<?php if (!empty($valor_cuota)) { echo number_format($valor_cuota,2);}  else{ }?>"  placeholder="$" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			</div>
	        </div>
		    </div>
			</div>
	        
	        
	        
	         <?php if(!empty($resultDatos)){?>
        
        <div class="col-lg-12 col-xs-6">
		
		<section class="col-lg-12 usuario" style=" min-height: 100px; 	max-height: 700px; overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Cuota</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Saldo Inicial</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Interes Normal</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Amortización</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Pagos</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Fecha Pago</b></th>
	    		</tr>
	    	
	      <?php if (!empty($resultAmortizacion)) {
	      	?>
	      	                  
	      <?php	foreach ($resultAmortizacion['tabla'] as $res)	{
	      		
	       ?>
	               
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['pagos_trimestrales']; ?></td>
	            	   <td style="color:#000000;font-size:80%;"> <?php echo number_format($res[0]['saldo_inicial'],2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo number_format($res[0]['interes'],2); ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo number_format($res[0]['amortizacion'],2); ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo number_format($res[0]['pagos'],2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['fecha_pago']; ?></td>
	                   
		    </tr>
		    
		
		  		    
		  		  <?php }}} ?>
            
            
       	</table>  
       	
		 
       	
       	
       	  
      </section>
		
		</div>  
                
       </form>
       
       <!-- termina el form --> 
       
     
          
          
          
       
      </div>
      </div>
      
   </body>  

</html>   