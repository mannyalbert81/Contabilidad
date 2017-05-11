<?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/menu.php"); ?>

<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Reporte Eres04 - contabilidad 2016</title>
        
       <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/js/jquery.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
          
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
         
 
 </head>
    <body style="background-color: #d9e3e4;">
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("ReporteEres04","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" target="_blank">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Reporte Eres 04</h4>
       
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
  		 
		 <button type="submit" id="reporte" name="reporte" value="reporte"   class="btn btn-success" style="margin-top: 10px;"><i class="glyphicon glyphicon-print"></i></button>         
	  
	  <?php if(!empty($resultSet))  {?>
	  <a href="<?php echo IP_REPORTE; ?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" style="margin-top: 10px;" class="btn btn-success"><i class="glyphicon glyphicon-download-alt"></i></a>
	
	  <!-- 
		 <a href="/contabilidad/FrameworkMVC/view/ireports/ContReporteComprobantesReport.php?id_entidades=<?php  echo $sel_id_entidades ?>&id_tipo_comprobantes=<?php  echo $sel_id_tipo_comprobantes?>&numero_ccomprobantes=<?php  echo $sel_numero_ccomprobantes?>&referencia_doc_ccomprobantes=<?php  echo $sel_referencia_doc_ccomprobantes?>&fecha_desde=<?php  echo $sel_fecha_desde?>&fecha_hasta=<?php  echo $sel_fecha_hasta?>&id_usuarios=<?php echo $_SESSION['id_usuarios'];?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" style="margin-top: 10px;" class="btn btn-success"><i class="glyphicon glyphicon-download-alt"></i></a>
	   -->
       <?php } else {?>
		  <?php } ?>
	
		  </div>
		 
		</div>
        	
		 </div>
		 
		 
		 <div class="col-lg-12">
		 
		 <div class="col-lg-12">
		 
		 <div style="height: 200px; display: block;">
		
		 <h4 style="color:#ec971f;"></h4>
		
		       <br>
				  
		 </div>
		
		 		 
		 </div>
		 
		 
		 </div>
		 
	
      
       </form>
     
      </div>
     
  </div>
      <!-- termina
       busqueda  -->
       
 <br>
 <br>
 <br>
   </body>  

    </html>   
    
  
    