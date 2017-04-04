	
 
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
 $sel_interes_mora_mensual_amortizacion_cabeza="";
 $sel_fecha_amortizacion_cabeza="";
 
 if($_SERVER['REQUEST_METHOD']=='POST' )
 {
 	$sel_ruc_clientes=$_POST['ruc_clientes'];
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
       
      <form action="<?php echo $helper->url("TablaAmortizacion","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" style=" padding-bottom:300px;">
            <br>
          
           <?php if (!empty($resultRes)) {  foreach($resultRes as $resEdit) {?> 
   
	         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Tabla de Amortización</h4>
	         </div>
	         <div class="panel-body">
  			 <div class="row">
  			 <div class="form-group" style="margin-top: 25px;">
		    	<div class="col-xs-2 col-md-2" style="text-align: center;">
			  	 <label for="ruc_clientes" class="control-label">Nro. Identificación:</label>
			  	<input type="text"  name="ruc_clientes" id="ruc_clientes" value="<?php if ($sel_ruc_clientes!=""){echo $sel_ruc_clientes;} else {echo $resEdit->ruc_clientes;} ?>" class="form-control"/> 
			   
            	</div>
            	</div>
		   		<div class="form-group">
		   		<div class="col-xs-4 col-md-4" style="text-align: center;">
			  	<label for="razon_social_clientes" class="control-label">Razón Social:</label>
			  	<input type="text"  name="razon_social_clientes" id="razon_social_clientes" value="<?php if ($sel_razon_social_clientes!=""){echo $sel_razon_social_clientes;} else {echo $resEdit->razon_social_clientes;} ?>" class="form-control"/> 
			   	
            	</div>
              </div>
		   
		   <div class="col-xs-3 col-md-3">
			 <input type="submit" id="buscar" name="buscar"  value="Buscar" class="btn btn-info " style="margin-top: 23px;"/> 	
		     <button type="button" class="btn btn-warning glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal" style="margin-top: 20px;"></button>
		
		  </div>
		  
		
		  </div>
         
           <br>
           <div class="row">
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="numero_credito_amortizacion_cabeza" class="control-label">Nro. Crédito:</label>
                                  <input type="text" class="form-control" id="numero_credito_amortizacion_cabeza" name="numero_credito_amortizacion_cabeza" value="<?php echo $sel_numero_credito_amortizacion_cabeza	; ?>"  placeholder="#">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="numero_pagare_amortizacion_cabeza" class="control-label">Nro. Pagare:</label>
                                  <input type="text" class="form-control" id="numero_pagare_amortizacion_cabeza" name="numero_pagare_amortizacion_cabeza" value="<?php echo $sel_numero_pagare_amortizacion_cabeza; ?>"  placeholder="#">
                                  <span class="help-block"></span>
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
                                  <span class="help-block"></span>	
		     </div>
		     </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="capital_prestado_amortizacion_cabeza" class="control-label">Cap. Prestado:</label>
                                  <input type="text" class="form-control" id="capital_prestado_amortizacion_cabeza" name="capital_prestado_amortizacion_cabeza" value="<?php echo $sel_capital_prestado_amortizacion_cabeza;?>"  placeholder="$">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-1 col-md-1">
		    <div class="form-group">
		    
		     					  <label for="tasa_interes_amortizacion_cabeza" class="control-label">Tasa:</label>
                                  <input type="text" class="form-control" id="tasa_interes_amortizacion_cabeza" name="tasa_interes_amortizacion_cabeza" value="<?php echo $sel_tasa_interes_amortizacion_cabeza;?>"  placeholder="%">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-1 col-md-1">
		    <div class="form-group">
		    
		     					  <label for="plazo_meses_amortizacion_cabeza" class="control-label">Plazo:</label>
                                  <input type="text" class="form-control" id="plazo_meses_amortizacion_cabeza" name="plazo_meses_amortizacion_cabeza" value="<?php echo $sel_plazo_meses_amortizacion_cabeza;?>"  placeholder="#">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="fecha_amortizacion_cabeza" class="control-label">Fecha: </label>
                                  <input type="date" class="form-control" id="fecha_amortizacion_cabeza" name="fecha_amortizacion_cabeza" value="<?php echo $sel_fecha_amortizacion_cabeza; ?>" >
                                  <span class="help-block"></span>
		    </div>
		    </div>
			</div>
			
			
			
			
			</div>
			
            <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					
            					   <input type="submit" id="Generar" name="Generar"  value="Generar" class="btn btn-success " />
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
		    
		     					  <label for="interes_normal_mensual_amortizacion_cabeza" class="control-label">Int. Mensual:</label>
                                  <input type="text" class="form-control" id="interes_normal_mensual_amortizacion_cabeza" name="interes_normal_mensual_amortizacion_cabeza" value="<?php echo $sel_interes_normal_mensual_amortizacion_cabeza; ?>"  placeholder="0.00" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="plazo_dias_amortizacion_cabeza" class="control-label">Plazo Dias:</label>
                                  <input type="text" class="form-control" id="plazo_dias_amortizacion_cabeza" name="plazo_dias_amortizacion_cabeza" value="<?php echo $sel_plazo_dias_amortizacion_cabeza; ?>"  placeholder="#" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="cantidad_cuotas_amortizacion_cabeza" class="control-label">Can. Cuotas:</label>
                                  <input type="text" class="form-control" id="cantidad_cuotas_amortizacion_cabeza" name="cantidad_cuotas_amortizacion_cabeza" value="<?php echo $sel_cantidad_cuotas_amortizacion_cabeza; ?>"  placeholder="#" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="interes_mora_mensual_amortizacion_cabeza" class="control-label">Mora:</label>
                                  <input type="text" class="form-control" id="interes_mora_mensual_amortizacion_cabeza" name="interes_mora_mensual_amortizacion_cabeza" value="<?php echo $sel_interes_mora_mensual_amortizacion_cabeza; ?>"  placeholder="0.00" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="interes_normal_mensual_amortizacion_cabeza" class="control-label">Mora. Mensual</label>
                                  <input type="text" class="form-control" id="interes_normal_mensual_amortizacion_cabeza" name="interes_normal_mensual_amortizacion_cabeza" value="<?php echo $sel_interes_normal_mensual_amortizacion_cabeza; ?>"  placeholder="0.00" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
		     <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="cantidad_cuotas_amortizacion_cabeza" class="control-label">Valor Cuota:</label>
                                  <input type="text" class="form-control" id="cantidad_cuotas_amortizacion_cabeza" name="cantidad_cuotas_amortizacion_cabeza" value="<?php echo $sel_cantidad_cuotas_amortizacion_cabeza; ?>"  placeholder="$" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			</div>
	         </div>
		    </div>
			</div>
	        
	        
	        
	  
          <?php } } else {?>
           
	         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Tabla de Amortizacion</h4>
	         </div>
	         <div class="panel-body">
  			 
		     <div class="row">
             <div class="form-group" style="margin-top: 25px;">
		     <div class="col-xs-2 col-md-2" style="text-align: center;">
			  	 <label for="ruc_clientes" class="control-label">Nro. Identificación:</label>
			  	<input type="text"  name="ruc_clientes" id="ruc_clientes" value="<?php echo $sel_ruc_clientes ?>" class="form-control"/> 
			   
             </div>
             </div>
		     <div class="form-group">
		     <div class="col-xs-4 col-md-4" style="text-align: center;">
			  	<label for="razon_social_clientes" class="control-label">Razón Social:</label>
			  	<input type="text"  name="razon_social_clientes" id="razon_social_clientes" value="<?php echo $sel_razon_social_clientes ?>" class="form-control"/> 
			   	
              </div>
              </div>
              
		   
		     <div class="col-xs-3 col-md-3">
			    <input type="submit" id="buscar" name="buscar"  value="Buscar" class="btn btn-info " style="margin-top: 23px;"/> 	
			     <button type="button" class="btn btn-warning glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal" style="margin-top: 20px;"></button>
		
		     </div>
		     
            
		     </div>
		     <br>
		    <div class="row">
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="numero_credito_amortizacion_cabeza" class="control-label">Nro. Crédito:</label>
                                  <input type="text" class="form-control" id="numero_credito_amortizacion_cabeza" name="numero_credito_amortizacion_cabeza" value="<?php echo $sel_numero_credito_amortizacion_cabeza	; ?>"  placeholder="#">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="numero_pagare_amortizacion_cabeza" class="control-label">Nro. Pagare:</label>
                                  <input type="text" class="form-control" id="numero_pagare_amortizacion_cabeza" name="numero_pagare_amortizacion_cabeza" value="<?php echo $sel_numero_pagare_amortizacion_cabeza; ?>"  placeholder="#">
                                  <span class="help-block"></span>
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
                                  <span class="help-block"></span>	
		     </div>
		     </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="capital_prestado_amortizacion_cabeza" class="control-label">Cap. Prestado:</label>
                                  <input type="text" class="form-control" id="capital_prestado_amortizacion_cabeza" name="capital_prestado_amortizacion_cabeza" value="<?php echo $sel_capital_prestado_amortizacion_cabeza;?>"  placeholder="$">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-1 col-md-1">
		    <div class="form-group">
		    
		     					  <label for="tasa_interes_amortizacion_cabeza" class="control-label">Tasa:</label>
                                  <input type="text" class="form-control" id="tasa_interes_amortizacion_cabeza" name="tasa_interes_amortizacion_cabeza" value="<?php echo $sel_tasa_interes_amortizacion_cabeza;?>"  placeholder="%">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-1 col-md-1">
		    <div class="form-group">
		    
		     					  <label for="plazo_meses_amortizacion_cabeza" class="control-label">Plazo:</label>
                                  <input type="text" class="form-control" id="plazo_meses_amortizacion_cabeza" name="plazo_meses_amortizacion_cabeza" value="<?php echo $sel_plazo_meses_amortizacion_cabeza;?>"  placeholder="#">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="fecha_amortizacion_cabeza" class="control-label">Fecha: </label>
                                  <input type="date" class="form-control" id="fecha_amortizacion_cabeza" name="fecha_amortizacion_cabeza" value="<?php echo $sel_fecha_amortizacion_cabeza; ?>" >
                                  <span class="help-block"></span>
		    </div>
		    </div>
			</div>
			
			
			
			
			</div>
			
            <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					
            					   <input type="submit" id="Generar" name="Generar"  value="Generar" class="btn btn-success " />
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
		    
		     					  <label for="interes_normal_mensual_amortizacion_cabeza" class="control-label">Int. Mensual:</label>
                                  <input type="text" class="form-control" id="interes_normal_mensual_amortizacion_cabeza" name="interes_normal_mensual_amortizacion_cabeza" value="<?php echo $sel_interes_normal_mensual_amortizacion_cabeza; ?>"  placeholder="0.00" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="plazo_dias_amortizacion_cabeza" class="control-label">Plazo Dias:</label>
                                  <input type="text" class="form-control" id="plazo_dias_amortizacion_cabeza" name="plazo_dias_amortizacion_cabeza" value="<?php echo $sel_plazo_dias_amortizacion_cabeza; ?>"  placeholder="#" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="cantidad_cuotas_amortizacion_cabeza" class="control-label">Can. Cuotas:</label>
                                  <input type="text" class="form-control" id="cantidad_cuotas_amortizacion_cabeza" name="cantidad_cuotas_amortizacion_cabeza" value="<?php echo $sel_cantidad_cuotas_amortizacion_cabeza; ?>"  placeholder="#" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="interes_mora_mensual_amortizacion_cabeza" class="control-label">Mora:</label>
                                  <input type="text" class="form-control" id="interes_mora_mensual_amortizacion_cabeza" name="interes_mora_mensual_amortizacion_cabeza" value="<?php echo $sel_interes_mora_mensual_amortizacion_cabeza; ?>"  placeholder="0.00" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="interes_normal_mensual_amortizacion_cabeza" class="control-label">Mora. Mensual</label>
                                  <input type="text" class="form-control" id="interes_normal_mensual_amortizacion_cabeza" name="interes_normal_mensual_amortizacion_cabeza" value="<?php echo $sel_interes_normal_mensual_amortizacion_cabeza; ?>"  placeholder="0.00" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
		     <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="cantidad_cuotas_amortizacion_cabeza" class="control-label">Valor Cuota:</label>
                                  <input type="text" class="form-control" id="cantidad_cuotas_amortizacion_cabeza" name="cantidad_cuotas_amortizacion_cabeza" value="<?php echo $sel_cantidad_cuotas_amortizacion_cabeza; ?>"  placeholder="$" readonly>
                                  <span class="help-block"></span>
		    </div>
		    </div>
			</div>
	         </div>
		    </div>
			</div>
	     
         <?php } ?>
         <?php if(!empty($resultDatos)){?>
        
        <div class="col-lg-12 col-xs-6">
		
		<section class="col-lg-12 usuario" style=" min-height: 100px; 	max-height: 400px; overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Periodo</b></th>
	    		<th style="color:#456789;font-size:80%;">Fecha Vencimiento</th>
	    		<th style="color:#456789;font-size:80%;">Abono Capital</th>
	    		<th style="color:#456789;font-size:80%;">Interes</th>
	    		<th style="color:#456789;font-size:80%;">Capital+Interes</th>
	    		<th style="color:#456789;font-size:80%;">Saldo Capital</th>
	    		<th style="color:#456789;font-size:80%;">Saldo Honorarios</th>
	    		<th style="color:#456789;font-size:80%;">Otros Rubros</th>
	    		<th style="color:#456789;font-size:80%;">Cuota a Cancelar</th>
	    	</tr>
	    	
	      <?php if (!empty($resultAmortizacion)) {
	      	
	      	foreach ($resultAmortizacion['tabla'] as $res)	{
	      		
	       ?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['periodo']; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['fecha_vencimiento']; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['abono_capital'],2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['interes'],2); ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['capital_interes'],2); ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo abs(round($res[0]['saldo_capital'],2)); ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['saldo_honorarios'],2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['otros'],2); ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['cuota']; ?>     </td>  
		               
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