    <?php include("view/modulos/head.php");?> 
    <?php include("view/modulos/menu.php");?>  
    <?php include("view/modulos/modal.php");?>
    <?php include("view/FACTURACION_COMPRAS/modal/buscar_proveedores.php");?>

   
   
    
<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
         <title>FC Proveedores - Contabilidad 2016</title>
         
         
         
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/js/jquery.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
       
       <script src="view/js/jquery.inputmask.bundle.js"></script>
		 <script src="view/js/jquery.noty.packaged.min.js"></script> 

	      
   
  
   
   
       <script>
      $(document).ready(function(){
      $(".cantidades").inputmask();
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
 
	   
	        <script>
		    var loadFileimg = function(event) {
		        var reader = new FileReader();
		        reader.onload = function(){
		          var outputimg = document.getElementById('outputimg');
		          outputimg.src = reader.result;
		        };

		        reader.readAsDataURL(event.target.files[0]);
		      };
            </script>
            
           
           
           <script>
	       	$(document).ready(function(){ 	
				$( "#id_cuenta_pagar_ver" ).autocomplete({
      				source: "<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesCodigo"); ?>",
      				minLength: 1
    			});

				$("#id_cuenta_pagar_ver").focusout(function(){
    				$.ajax({
    					url:'<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesDevuelveNombre"); ?>',
    					type:'POST',
    					dataType:'json',
    					data:{codigo_plan_cuentas:$('#id_cuenta_pagar_ver').val()}
    				}).done(function(respuesta){

    					$('#nombre_cuenta_pagar_ver').val(respuesta.nombre_plan_cuentas);
    					$('#id_cuenta_pagar').val(respuesta.id_plan_cuentas);
    				
        			});
    				 
    				
    			});   
				
    		});

			
     </script>


		<script>
			       	$(document).ready(function(){ 	
						$( "#nombre_cuenta_pagar_ver" ).autocomplete({
		      				source: "<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesNombre"); ?>",
		      				minLength: 1
		    			});
		
						$("#nombre_cuenta_pagar_ver").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesDevuelveCodigo"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{nombre_plan_cuentas:$('#nombre_cuenta_pagar_ver').val()}
		    				}).done(function(respuesta){
		
		    					$('#id_cuenta_pagar_ver').val(respuesta.codigo_plan_cuentas);
		    					$('#id_cuenta_pagar').val(respuesta.id_plan_cuentas);
		    				
		        			});
		    				 
		    				
		    			});   
						
		    		});
		
					
		     </script>
           
           
           
           
           
           
           
            
           <script>
	       	$(document).ready(function(){ 	
				$( "#id_cuenta_cobrar_ver" ).autocomplete({
      				source: "<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesCodigo"); ?>",
      				minLength: 1
    			});

				$("#id_cuenta_cobrar_ver").focusout(function(){
    				$.ajax({
    					url:'<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesDevuelveNombre"); ?>',
    					type:'POST',
    					dataType:'json',
    					data:{codigo_plan_cuentas:$('#id_cuenta_cobrar_ver').val()}
    				}).done(function(respuesta){

    					$('#nombre_cuenta_cobrar_ver').val(respuesta.nombre_plan_cuentas);
    					$('#id_cuenta_cobrar').val(respuesta.id_plan_cuentas);
    				
        			});
    				 
    				
    			});   
				
    		});

			
     </script>


		<script>
			       	$(document).ready(function(){ 	
						$( "#nombre_cuenta_cobrar_ver" ).autocomplete({
		      				source: "<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesNombre"); ?>",
		      				minLength: 1
		    			});
		
						$("#nombre_cuenta_cobrar_ver").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesDevuelveCodigo"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{nombre_plan_cuentas:$('#nombre_cuenta_cobrar_ver').val()}
		    				}).done(function(respuesta){
		
		    					$('#id_cuenta_cobrar_ver').val(respuesta.codigo_plan_cuentas);
		    					$('#id_cuenta_cobrar').val(respuesta.id_plan_cuentas);
		    				
		        			});
		    				 
		    				
		    			});   
						
		    		});
		
					
		     </script>
           
           
           
           
           
           
           
           
           
           
            
           <script>
	       	$(document).ready(function(){ 	
				$( "#id_cuenta_anticipo_entregado_ver" ).autocomplete({
      				source: "<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesCodigo"); ?>",
      				minLength: 1
    			});

				$("#id_cuenta_anticipo_entregado_ver").focusout(function(){
    				$.ajax({
    					url:'<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesDevuelveNombre"); ?>',
    					type:'POST',
    					dataType:'json',
    					data:{codigo_plan_cuentas:$('#id_cuenta_anticipo_entregado_ver').val()}
    				}).done(function(respuesta){

    					$('#nombre_cuenta_anticipo_entregado_ver').val(respuesta.nombre_plan_cuentas);
    					$('#id_cuenta_anticipo_entregado').val(respuesta.id_plan_cuentas);
    				
        			});
    				 
    				
    			});   
				
    		});

			
     </script>


		<script>
			       	$(document).ready(function(){ 	
						$( "#nombre_cuenta_anticipo_entregado_ver" ).autocomplete({
		      				source: "<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesNombre"); ?>",
		      				minLength: 1
		    			});
		
						$("#nombre_cuenta_anticipo_entregado_ver").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesDevuelveCodigo"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{nombre_plan_cuentas:$('#nombre_cuenta_anticipo_entregado_ver').val()}
		    				}).done(function(respuesta){
		
		    					$('#id_cuenta_anticipo_entregado_ver').val(respuesta.codigo_plan_cuentas);
		    					$('#id_cuenta_anticipo_entregado').val(respuesta.id_plan_cuentas);
		    				
		        			});
		    				 
		    				
		    			});   
						
		    		});
		
					
		     </script>
           
           
           
           
           
           
           
           
           
           
           
           <script>
	       	$(document).ready(function(){ 	
				$( "#id_cuenta_anticipo_recibido_ver" ).autocomplete({
      				source: "<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesCodigo"); ?>",
      				minLength: 1
    			});

				$("#id_cuenta_anticipo_recibido_ver").focusout(function(){
    				$.ajax({
    					url:'<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesDevuelveNombre"); ?>',
    					type:'POST',
    					dataType:'json',
    					data:{codigo_plan_cuentas:$('#id_cuenta_anticipo_recibido_ver').val()}
    				}).done(function(respuesta){

    					$('#nombre_cuenta_anticipo_recibido_ver').val(respuesta.nombre_plan_cuentas);
    					$('#id_cuenta_anticipo_recibido').val(respuesta.id_plan_cuentas);
    				
        			});
    				 
    				
    			});   
				
    		});

			
     </script>


		<script>
			       	$(document).ready(function(){ 	
						$( "#nombre_cuenta_anticipo_recibido_ver" ).autocomplete({
		      				source: "<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesNombre"); ?>",
		      				minLength: 1
		    			});
		
						$("#nombre_cuenta_anticipo_recibido_ver").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesDevuelveCodigo"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{nombre_plan_cuentas:$('#nombre_cuenta_anticipo_recibido_ver').val()}
		    				}).done(function(respuesta){
		
		    					$('#id_cuenta_anticipo_recibido_ver').val(respuesta.codigo_plan_cuentas);
		    					$('#id_cuenta_anticipo_recibido').val(respuesta.id_plan_cuentas);
		    				
		        			});
		    				 
		    				
		    			});   
						
		    		});
		
					
		     </script>
           
           
           
           
           
           
           <script>
			       	$(document).ready(function(){ 	
						$( "#ruc_proveedores").autocomplete({
		      				source: "<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesCedulaCliente");?>",
		      				minLength: 1
		    			});
		
						$("#ruc_proveedores").focusout(function(){
							
							$.ajax({
		    					url:'<?php echo $helper->url("FC_Proveedores","AutocompleteComprobantesDevuelveDatosCliente"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					
		    					data:{
									 id_tipo_cliente_proveedor:$('#id_tipo_cliente_proveedor').val(),
			    					ruc_proveedores:$('#ruc_proveedores').val()
							    }
		    				}).done(function(respuesta){

		    					
		
		    					$('#razon_social_proveedores').val(respuesta.razon_social_proveedores);
		    					$('#direccion_proveedores').val(respuesta.direccion_proveedores);
		    					$('#telefono_proveedores').val(respuesta.telefono_proveedores);
		    					$('#celular_proveedores').val(respuesta.celular_proveedores);
		    					$('#email_proveedores').val(respuesta.email_proveedores);
		    					$('#web_proveedores').val(respuesta.web_proveedores);
		    					$('#retencion_fuente').val(respuesta.retencion_fuente);
		    					$('#retencion_iva').val(respuesta.retencion_iva);

		    					$('#ci_contacto_proveedores').val(respuesta.ci_contacto_proveedores);
		    					$('#contacto_razon_social_proveedores').val(respuesta.nombres_contacto_proveedores);
		    					$('#telefono_contacto_proveedores').val(respuesta.telefono_contacto_proveedores);
		    					$('#celular_contacto_proveedores').val(respuesta.celular_contacto_proveedores);
		    					$('#email_contacto_proveedores').val(respuesta.email_contacto_proveedores);

		    					$('#id_ciudad').val(respuesta.id_ciudad);
		    					$('#id_entidades').val(respuesta.id_entidades);
		    					$('#id_tipo_contribuyente').val(respuesta.id_tipo_contribuyente);
		    					$('#id_tipo_persona').val(respuesta.id_tipo_persona);
		    					$('#id_tipo_identificacion').val(respuesta.id_tipo_identificacion);
		    					$('#dias_credito_cliente_proveedor').val(respuesta.dias_credito_cliente_proveedor);
		    					$('#id_tipo_cliente_proveedor').val(respuesta.id_tipo_cliente_proveedor);

		    					$('#id_cuenta_pagar_ver').val(respuesta.codigo_plan_cuentas_pagar);
		    					$('#id_cuenta_pagar').val(respuesta.id_cuenta_pagar);
		    					$('#nombre_cuenta_pagar_ver').val(respuesta.nombre_plan_cuentas_pagar);

		    					$('#id_cuenta_cobrar_ver').val(respuesta.codigo_plan_cuentas_cobrar);
		    					$('#id_cuenta_cobrar').val(respuesta.id_cuenta_cobrar);
		    					$('#nombre_cuenta_cobrar_ver').val(respuesta.nombre_plan_cuentas_cobrar);

		    					$('#id_cuenta_anticipo_entregado_ver').val(respuesta.codigo_plan_cuentas_anticipo_entregado);
		    					$('#id_cuenta_anticipo_entregado').val(respuesta.id_cuenta_anticipo_entregado);
		    					$('#nombre_cuenta_anticipo_entregado_ver').val(respuesta.nombre_plan_cuentas_anticipo_entregado);

		    					$('#id_cuenta_anticipo_recibido_ver').val(respuesta.codigo_plan_cuentas_anticipo_recibido);
		    					$('#id_cuenta_anticipo_recibido').val(respuesta.id_cuenta_anticipo_recibido);
		    					$('#nombre_cuenta_anticipo_recibido_ver').val(respuesta.nombre_plan_cuentas_anticipo_recibido);
		    				
		        			});
		    				 
							
		    			});   
						
		    		});
		
					
		     </script>
           
           
           
           <script type="text/javascript">

           function CancelaNuevoCliente(){
        	    
        	    $("#ruc_proveedores").val("");
        	    $("#razon_social_proveedores").val("");
        	    $("#id_tipo_cliente_proveedor").val("");
        	    $("#id_ciudad").val("");
        	    $("#id_tipo_contribuyente").val("");
        	    $("#id_tipo_persona").val("");
        	    $("#id_tipo_identificacion").val("");
        	    $("#direccion_proveedores").val("");
        	    $("#telefono_proveedores").val("");
        	    $("#celular_proveedores").val("");
        	    $("#email_proveedores").val("");
        	    $("#web_proveedores").val("");
        	    $("#retencion_fuente").val("0.00");
        	    $("#retencion_iva").val("0.00");
        	    $("#id_cuenta_pagar").val("0");
        	    $("#id_cuenta_cobrar").val("0");
        	    $("#id_cuenta_anticipo_entregado").val("0");
        	    $("#id_cuenta_anticipo_recibido").val("0");
        	    $("#id_cuenta_pagar_ver").val("");
        	    $("#nombre_cuenta_pagar_ver").val("");
        	    $("#id_cuenta_cobrar_ver").val("");
        	    $("#nombre_cuenta_cobrar_ver").val("");
        	    $("#id_cuenta_anticipo_entregado_ver").val("");
        	    $("#nombre_cuenta_anticipo_entregado_ver").val("");
        	    $("#id_cuenta_anticipo_recibido_ver").val("");
        	    $("#nombre_cuenta_anticipo_recibido_ver").val("");
        	    $("#dias_credito_cliente_proveedor").val("");
        	    $("#ci_contacto_proveedores").val("");
        	    $("#contacto_razon_social_proveedores").val("");
        	    $("#telefono_contacto_proveedores").val("");
        	    $("#celular_contacto_proveedores").val("");
        	    $("#email_contacto_proveedores").val("");
        	   
        	}
       	
           </script>
           
           
             
	   
	   <script type="text/javascript">
	   $(document).ready(function(){
			lista_clientes(1);
			});
			
			
			function lista_clientes(page){
				var c= $("#c").val();
				$("#clientes").fadeIn('slow');
				$.ajax({
					url:'view/FACTURACION_COMPRAS/ajax/cargar_proveedores.php?action=ajax&page='+page+'&c='+c,
					 beforeSend: function(objeto){
					$("#clientes").html('<img src="view/images/ajax-loader.gif"> Cargando...');
					},
					success:function(data){
						$(".div_clientes").html(data).fadeIn('slow');
						$("#clientes").html("");
					}
				})
			}
	   </script>
           
           
           
           <script type="text/javascript">

           function InsertaCliente(){
           
           $(document).ready(function(){


        		  
        			 var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        	    	  var errores='';
        	    	  
        	    	  if($("#id_tipo_cliente_proveedor").val()==""){
        	    		  
        	    		  var n = noty({
        	                  text: "Seleccione un Tipo Cliente!..",
        	                  theme: 'relax',
        	                  layout: 'center',
        	                  type: 'error',
        	                  timeout: 2000,
        	                 });
        	    		  
        	    		  errores = 'true';
        	    		  return false;
        	    	  }else{
        	    		  
        	    		  errores = 'false';
        	    		  
        	    	  }
        	    	  
        	         if($("#id_tipo_identificacion").val()==""){
        	    		  
        	    		  var n = noty({
        	                  text: "Seleccione un Tipo Identificación!..",
        	                  theme: 'relax',
        	                  layout: 'center',
        	                  type: 'error',
        	                  timeout: 2000,
        	                 });
        	    		  
        	    		  errores = 'true';
        	    		  return false;
        	    	  }else{
        	    		  
        	    		  errores = 'false';
        	    		  
        	    	  }
        	    	  
        	         if($("#ruc_proveedores").val()==""){
        	   		  
        	   		  var n = noty({
        	                 text: "Ingrese una Identificacíon!..",
        	                 theme: 'relax',
        	                 layout: 'center',
        	                 type: 'error',
        	                 timeout: 2000,
        	                });
        	   		  
        	   		  errores = 'true';
        	   		  return false;
        	   	  }else{
        	   		  
        	   		  errores = 'false';
        	   		  
        	   	  }





        	         if($("#razon_social_proveedores").val()==""){
           	   		  
           	   		  var n = noty({
           	                 text: "Ingrese una Razón Social!..",
           	                 theme: 'relax',
           	                 layout: 'center',
           	                 type: 'error',
           	                 timeout: 2000,
           	                });
           	   		  
           	   		  errores = 'true';
           	   		  return false;
           	   	  }else{
           	   		  
           	   		  errores = 'false';
           	   		  
           	   	  }
        	         

        	         if($("#id_tipo_persona").val()==""){
              	   		  
              	   		  var n = noty({
              	                 text: "Seleccione un Tipo Persona!..",
              	                 theme: 'relax',
              	                 layout: 'center',
              	                 type: 'error',
              	                 timeout: 2000,
              	                });
              	   		  
              	   		  errores = 'true';
              	   		  return false;
              	   	  }else{
              	   		  
              	   		  errores = 'false';
              	   		  
              	   	  }


        	         if($("#id_tipo_contribuyente").val()==""){
             	   		  
             	   		  var n = noty({
             	                 text: "Seleccione un Tipo Contribuyente!..",
             	                 theme: 'relax',
             	                 layout: 'center',
             	                 type: 'error',
             	                 timeout: 2000,
             	                });
             	   		  
             	   		  errores = 'true';
             	   		  return false;
             	   	  }else{
             	   		  
             	   		  errores = 'false';
             	   		  
             	   	  }





        	         if($("#id_ciudad").val()==""){
             	   		  
             	   		  var n = noty({
             	                 text: "Seleccione una Ciudad!..",
             	                 theme: 'relax',
             	                 layout: 'center',
             	                 type: 'error',
             	                 timeout: 2000,
             	                });
             	   		  
             	   		  errores = 'true';
             	   		  return false;
             	   	  }else{
             	   		  
             	   		  errores = 'false';
             	   		  
             	   	  }
       	         

        	         if($("#direccion_proveedores").val()==""){
            	   		  
            	   		  var n = noty({
            	                 text: "Ingrese una Dirección!..",
            	                 theme: 'relax',
            	                 layout: 'center',
            	                 type: 'error',
            	                 timeout: 2000,
            	                });
            	   		  
            	   		  errores = 'true';
            	   		  return false;
            	   	  }else{
            	   		  
            	   		  errores = 'false';
            	   		  
            	   	  }




        	    	   
        	 		
        		    	if ($("#email_proveedores").val() == "")
        		    	{
        			    	
        		    		 var n = noty({
        		                 text: "Ingrese correo Electrónico!..",
        		                 theme: 'relax',
        		                 layout: 'center',
        		                 type: 'error',
        		                 timeout: 2000,
        		                });
        		   		  
        		   		  errores = 'true';
        		          return false;
        			    }
        		    	else if (regex.test($('#email_proveedores').val().trim()))
        		    	{
        		    		 errores = 'false';
        		            
        				}
        		    	else 
        		    	{
        		    		 var n = noty({
        		                 text: "Ingrese un correo valido!..",
        		                 theme: 'relax',
        		                 layout: 'center',
        		                 type: 'error',
        		                 timeout: 2000,
        		                });
        		   		  
        		   		  errores = 'true';
        		          return false;
        			    }




        		    	
        		    	
        		    	
        		        if($("#id_cuenta_pagar").val() == "" ||  $("#id_cuenta_pagar").val() == "0"){
        		        	 
        		        	 var n = noty({
        		                 text: "Seleccione una cuenta a pagar!..",
        		                 theme: 'relax',
        		                 layout: 'center',
        		                 type: 'error',
        		                 timeout: 2000,
        		                });
        		   		  
        		   		  errores = 'true';
        		   		  return false;
        		   		  
        		         }else{
        		     		  
        		     		  errores = 'false';
        		     		  
        		     	  } 




        		        if($("#id_cuenta_cobrar").val() == "" ||  $("#id_cuenta_cobrar").val() == "0"){
        		        	 
        		        	 var n = noty({
        		                 text: "Seleccione una cuenta a cobrar!..",
        		                 theme: 'relax',
        		                 layout: 'center',
        		                 type: 'error',
        		                 timeout: 2000,
        		                });
        		   		  
        		   		  errores = 'true';
        		   		  return false;
        		   		  
        		         }else{
        		     		  
        		     		  errores = 'false';
        		     		  
        		     	  } 



        		        if($("#id_cuenta_anticipo_entregado").val() == "" ||  $("#id_cuenta_anticipo_entregado").val() == "0"){
        		        	 
        		        	 var n = noty({
        		                 text: "Seleccione una cuenta de anticipo entregado!..",
        		                 theme: 'relax',
        		                 layout: 'center',
        		                 type: 'error',
        		                 timeout: 2000,
        		                });
        		   		  
        		   		  errores = 'true';
        		   		  return false;
        		   		  
        		         }else{
        		     		  
        		     		  errores = 'false';
        		     		  
        		     	  } 




        		        if($("#id_cuenta_anticipo_recibido").val() == "" ||  $("#id_cuenta_anticipo_recibido").val() == "0"){
       		        	 
       		        	 var n = noty({
       		                 text: "Seleccione una cuenta de anticipo recibido!..",
       		                 theme: 'relax',
       		                 layout: 'center',
       		                 type: 'error',
       		                 timeout: 2000,
       		                });
       		   		  
       		   		  errores = 'true';
       		   		  return false;
       		   		  
       		         }else{
       		     		  
       		     		  errores = 'false';
       		     		  
       		     	  } 

       		     	  
      		     	  
        		        
        		        if($("#dias_credito_cliente_proveedor").val() == "" || $("#dias_credito_cliente_proveedor").val() == "0" ){
        		        	 
        		        	 var n = noty({
        		                 text: "Ingrese # Dias!..",
        		                 theme: 'relax',
        		                 layout: 'center',
        		                 type: 'error',
        		                 timeout: 2000,
        		                });
        		   		  
        		   		  errores = 'true';
        		   		  return false;
        		   		  
        		         }else{
        		     		  
        		     		  errores = 'false';
        		     		  
        		     	  } 
        	         
        	         
        	    	  if(errores =='false'){

        	    		  var n = noty({
	         	               text: "Estamos guardando su nuevo registro.....",
	         	               theme: 'relax',
	         	               layout: 'center',
	         	               type: 'information',
	         	               timeout: 3000,
	         	               });
        	     	    
        	     		    var con_datos={
        	     		    	  ruc_proveedores:$("#ruc_proveedores").val(),
        	     		    	  razon_social_proveedores:$("#razon_social_proveedores").val(),
        	     		    	  id_tipo_cliente_proveedor:$("#id_tipo_cliente_proveedor").val(),
        	     		    	  id_ciudad:$("#id_ciudad").val(),
        	     		    	  id_entidades:$("#id_entidades").val(),
        	     		    	 id_tipo_contribuyente:$("#id_tipo_contribuyente").val(),
        	     		    	 id_tipo_persona:$("#id_tipo_persona").val(),
        	     		    	 id_tipo_identificacion:$("#id_tipo_identificacion").val(),
        	     		    	direccion_proveedores:$("#direccion_proveedores").val(),
        	     		    	telefono_proveedores:$("#telefono_proveedores").val(),
        	     		    	celular_proveedores:$("#celular_proveedores").val(),
        	     		    	email_proveedores:$("#email_proveedores").val(),
        	     		    	web_proveedores:$("#web_proveedores").val(),
        	     		    	retencion_fuente:$("#retencion_fuente").val(),
        	     		    	retencion_iva:$("#retencion_iva").val(),
        	     		    	id_cuenta_pagar:$("#id_cuenta_pagar").val(),
        	     		    	id_cuenta_cobrar:$("#id_cuenta_cobrar").val(),
        	     		    	id_cuenta_anticipo_entregado:$("#id_cuenta_anticipo_entregado").val(),
        	     		    	id_cuenta_anticipo_recibido:$("#id_cuenta_anticipo_recibido").val(),

        	     		    	dias_credito_cliente_proveedor:$("#dias_credito_cliente_proveedor").val(),
        	     		    	ci_contacto_proveedores:$("#ci_contacto_proveedores").val(),
        	     		    	contacto_razon_social_proveedores:$("#contacto_razon_social_proveedores").val(),
        	     		    	telefono_contacto_proveedores:$("#telefono_contacto_proveedores").val(),
        	     		    	celular_contacto_proveedores:$("#celular_contacto_proveedores").val(),
        	     		    	email_contacto_proveedores:$("#email_contacto_proveedores").val()
        	     				  };

        	     		   $.ajax({
        	       	        beforeSend: function(objeto){
        	       	        	$("#users_registrados").html('<img src="view/images/ajax-loader.gif"> Cargando...');
        						
            	       	    },
        	       	        url: 'index.php?controller=FC_Proveedores&action=InsertaFC_Proveedores',
        	       	        type: 'POST',
        	       	        data: con_datos,
        	       	        success: function(x){
        	       	        		
        	         	            $("#users_registrados").html(x);
          	       	                CancelaNuevoCliente();
          	       	                lista_clientes(1);
        	       	          }
        	       	          ,
        	       	          /**************************/
        	       	        error: function(jqXHR,estado,error){
        	       	           var n = noty({
          	       	           text: "No se registro el Cliente, verifique los campos...!",
          	       	           theme: 'relax',
          	       	           layout: 'center',
          	       	           type: 'information',
          	       	           timeout: 3000,
          	       	           });
          	       	          $("#users_registrados").html(x);
        	       	          }
        	       	       });


            	    		 
        	    	  }
        	    	  
        	    	  
        	    
        		  
        	   });
           }
           </script>
             
	 
	   
	   
	   
	   <script>
	   function eliminar(id)
		{
		   if (confirm("Realmente deseas eliminar el cliente")){	
			$.ajax({
       type: "GET",
       url: 'index.php?controller=FC_Proveedores&action=EliminarProveedor',
       data: "id_proveedor="+id,
		 beforeSend: function(objeto){
			$("#users_registrados").html('<img src="view/images/ajax-loader.gif"> Cargando...');
		  },
		  success: function(x){
			  lista_clientes(1);
			  $("#users_registrados").html(x);
	          },
              error: function(jqXHR,estado,error){
                  $("#users_registrados").html("Ocurrio un error al eliminar...");
                }
			});

		}

			}
	</script>
	   
	         
	         <script type="text/javascript"> 
			var strCmd = "document.getElementById('ocultar').style.display = 'none'"; 
			var waitseconds = 10; 
			var timeOutPeriod = waitseconds * 1000; 
			var hideTimer = setTimeout(strCmd, timeOutPeriod); 
			</script> 
	         
	         
	         
     </head>
      <body class="cuerpo">
                  
                  
              
                  
    	<div class="container">
        <div class="row" style="background-color: #FAFAFA;">
  		<form id="" action="<?php echo $helper->url("FC_Proveedores","InsertaFC_Proveedores"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12">
            
            <br>	
            
             <div id='users_registrados'></div>
             <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <div class="row">
	         <div class="form-group" style="margin-left: 20px">
			      <label for="nuevo_comprobante" class="control-label"><h4><i class='glyphicon glyphicon-edit'></i> Nuevo Proveedor</h4></label>
			 </div>
		     </div>
		     
	         </div>
	         </div>
	         </div>
	         
	         
  			 
  			 <div class="col-lg-12">
  			 <div class="col-lg-12">
  			 <div class="panel panel-info">
  			 <div class="panel-body">
	         <div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#Cliente">
						 <span class="glyphicon glyphicon-search"></span> Buscar Proveedor
						</button>
					</div>	
			 </div> 
            <div class="row"> 
            
            
            <div class="form-group"  style="margin-top:15px">
            <div class="col-xs-12 col-md-3">
		                          <label for="id_entidades" class="control-label">Entidad:</label>
                                  <select name="id_entidades" id="id_entidades"  class="form-control" readonly>
                                  	<?php foreach($resultEnt as $res) {?>
										<option value="<?php echo $res->id_entidades; ?>"  ><?php echo $res->nombre_entidades; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
            
            
            <div class="form-group">
            <div class="col-xs-12 col-md-3">
		                          <label for="id_tipo_cliente_proveedor" class="control-label">Tipo Cliente:</label>
                                  <select name="id_tipo_cliente_proveedor" id="id_tipo_cliente_proveedor"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($result_Tip_Cli_Prov as $res) {?>
										<option value="<?php echo $res->id_tipo_cliente_proveedor; ?>"  ><?php echo $res->nombre_tipo_cliente_proveedor; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
            
            <div class="form-group">
            <div class="col-xs-12 col-md-3">
		                          <label for="id_tipo_identificacion" class="control-label">Tipo Identificación:</label>
                                  <select name="id_tipo_identificacion" id="id_tipo_identificacion"  class="form-control">
                                  <option value="" selected="selected">--Seleccione--</option>
                                  	<?php foreach($resultTipIdent as $res) {?>
										<option value="<?php echo $res->id_tipo_identificacion; ?>"  ><?php echo $res->nombre_tipo_identificacion; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
            
            
             <div class="form-group" style="margin-top:15px">
             <div class="col-xs-12 col-md-3">
             
                                  <label for="ruc_proveedores" class="control-label">CI / Ruc:</label>
                                  <input type="number" class="form-control" id="ruc_proveedores" name="ruc_proveedores" value=""   placeholder="Ruc" >
                                  <span class="help-block"></span>
             </div>
             </div>
             
             <div class="form-group">
             <div class="col-xs-12 col-md-6">
             
                                  <label for="razon_social_proveedores" class="control-label">Razón Social:</label>
                                  <input type="text" class="form-control" id="razon_social_proveedores" name="razon_social_proveedores" value=""  placeholder="Razón Social">
                                  <span class="help-block"></span>
             </div>
             </div>
            
           
			<div class="form-group">
            <div class="col-xs-12 col-md-2">
		                          <label for="id_tipo_persona" class="control-label">Tipo Persona:</label>
                                  <select name="id_tipo_persona" id="id_tipo_persona"  class="form-control">
                                  <option value="" selected="selected">--Seleccione--</option>
                                  	<?php foreach($resultTipPer as $res) {?>
										<option value="<?php echo $res->id_tipo_persona; ?>"  ><?php echo $res->nombre_tipo_persona; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
  			
  			<div class="form-group">
            <div class="col-xs-12 col-md-2">
		                          <label for="id_tipo_contribuyente" class="control-label">Tipo Contribuyente:</label>
                                  <select name="id_tipo_contribuyente" id="id_tipo_contribuyente"  class="form-control">
                                  <option value="" selected="selected">--Seleccione--</option>
                                  	<?php foreach($result_tipo_contrib as $res) {?>
										<option value="<?php echo $res->id_tipo_contribuyente; ?>"  ><?php echo $res->nombre_tipo_contribuyente; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
  			
  			
  			  
	        <div class="form-group">
            <div class="col-xs-12 col-md-2">
		                          <label for="id_ciudad" class="control-label">Ciudad:</label>
                                  <select name="id_ciudad" id="id_ciudad"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($result_ciudad as $res) {?>
										<option value="<?php echo $res->id_ciudad; ?>"  ><?php echo $res->nombre_ciudad; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
  			
  			
		     <div class="form-group">
             <div class="col-xs-12 col-md-12">
		                          <label for="direccion_proveedores" class="control-label">Dirección:</label>
                                  <textarea type="text"  class="form-control" id="direccion_proveedores" name="direccion_proveedores" value=""  placeholder="Dirección Proveedores"></textarea>
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		    
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
		                          <label for="telefono_proveedores" class="control-label">Teléfono:</label>
                                  <input type="number" class="form-control" id="telefono_proveedores" name="telefono_proveedores" value=""  onkeypress="return numeros(event)" placeholder="#">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
		                          <label for="celular_proveedores" class="control-label">Celular:</label>
                                  <input type="number" class="form-control" id="celular_proveedores" name="celular_proveedores" value=""  onkeypress="return numeros(event)" placeholder="#">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
		                          <label for="email_proveedores" class="control-label">Email:</label>
                                  <input type="email" class="form-control" id="email_proveedores" name="email_proveedores" value=""   placeholder="Correo Electrónico">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
		                          <label for="web_proveedores" class="control-label">Web:</label>
                                  <input type="text" class="form-control" id="web_proveedores" name="web_proveedores" value=""  placeholder="Sitio Web">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
		                          <label for="retencion_fuente" class="control-label">Retención Fuente:</label>
                                  <input type="text" class="form-control cantidades" id="retencion_fuente" name="retencion_fuente" value="0.00"
                                   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     
		    
		     
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
		                          <label for="retencion_iva" class="control-label">Retención Iva:</label>
                                  <input type="text" class="form-control cantidades" id="retencion_iva" name="retencion_iva" value="0.00"
                                  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
             
                                  <label for="id_cuenta_pagar_ver" class="control-label" >#Cuenta por Pagar: </label>
                                  <input type="text" class="form-control" id="id_cuenta_pagar_ver" name="id_cuenta_pagar_ver" value=""  placeholder="Search">
                                  <input type="hidden" class="form-control" id="id_cuenta_pagar" name="id_cuenta_pagar" value="0"  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
		     <div class="col-xs-12 col-md-3">                     
                                  <label for="nombre_cuenta_pagar_ver" class="control-label">Nombre Cuenta por Pagar: </label>
                                  <input type="text" class="form-control" id="nombre_cuenta_pagar_ver" name="nombre_cuenta_pagar_ver" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
             
                                  <label for="id_cuenta_cobrar_ver" class="control-label" >#Cuenta por Cobrar: </label>
                                  <input type="text" class="form-control" id="id_cuenta_cobrar_ver" name="id_cuenta_cobrar_ver" value=""  placeholder="Search">
                                  <input type="hidden" class="form-control" id="id_cuenta_cobrar" name="id_cuenta_cobrar" value="0"  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
		     <div class="col-xs-12 col-md-3">                     
                                  <label for="nombre_cuenta_cobrar_ver" class="control-label">Nombre Cuenta por Cobrar: </label>
                                  <input type="text" class="form-control" id="nombre_cuenta_cobrar_ver" name="nombre_cuenta_cobrar_ver" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
             
                                  <label for="id_cuenta_anticipo_entregado_ver" class="control-label" >#Cuenta Anticipo Entregado: </label>
                                  <input type="text" class="form-control" id="id_cuenta_anticipo_entregado_ver" name="id_cuenta_anticipo_entregado_ver" value=""  placeholder="Search">
                                  <input type="hidden" class="form-control" id="id_cuenta_anticipo_entregado" name="id_cuenta_anticipo_entregado" value="0"  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
		     <div class="col-xs-12 col-md-3">                     
                                  <label for="nombre_cuenta_anticipo_entregado_ver" class="control-label">Nombre Cuenta Anticipo Entregado: </label>
                                  <input type="text" class="form-control" id="nombre_cuenta_anticipo_entregado_ver" name="nombre_cuenta_anticipo_entregado_ver" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
             
                                  <label for="id_cuenta_anticipo_recibido_ver" class="control-label" >#Cuenta Anticipo Recibido: </label>
                                  <input type="text" class="form-control" id="id_cuenta_anticipo_recibido_ver" name="id_cuenta_anticipo_recibido_ver" value=""  placeholder="Search">
                                  <input type="hidden" class="form-control" id="id_cuenta_anticipo_recibido" name="id_cuenta_anticipo_recibido" value="0"  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
		     <div class="col-xs-12 col-md-3">                     
                                  <label for="nombre_cuenta_anticipo_recibido_ver" class="control-label">Nombre Cuenta Anticipo Recibido: </label>
                                  <input type="text" class="form-control" id="nombre_cuenta_anticipo_recibido_ver" name="nombre_cuenta_anticipo_recibido_ver" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
		     <div class="col-xs-12 col-md-3">                     
                                  <label for="dias_credito_cliente_proveedor" class="control-label">Número Dias Crédito: </label>
                                  <input type="number" class="form-control" id="dias_credito_cliente_proveedor" name="dias_credito_cliente_proveedor" onkeypress="return numeros(event)" value=""  placeholder="#">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		      </div>
		     
		     
		     
		     
		     <!-- COMIENZA DATOS DEL CONTACTO -->
		     
		     
  		     </div>                    
			 </div>
  		     	
		     </div>
			
			
			 <div class="col-lg-12">
			 	
			 <div class="panel panel-info">
	         <div class="panel-body">
	          <div class="row">
	          <div class="col-xs-12 col-md-12" style="text-align: center";>
	           <h4 style="color:#ec971f;">DATOS DE CONTACTO</h4>
	           </div>
	           </div>
	         
	         <div class="row"> 
		     
            <div class="form-group" style="margin-top:15px">
             <div class="col-xs-12 col-md-3">
             
                                  <label for="ci_contacto_proveedores" class="control-label">CI Contacto:</label>
                                  <input type="number" class="form-control" id="ci_contacto_proveedores" name="ci_contacto_proveedores" value=""   placeholder="Cedula" >
                                  <span class="help-block"></span>
             </div>
             </div>
             
             <div class="form-group">
             <div class="col-xs-12 col-md-3">
             
                                  <label for="contacto_razon_social_proveedores" class="control-label">Nombres Contacto:</label>
                                  <input type="text" class="form-control" id="contacto_razon_social_proveedores" name="contacto_razon_social_proveedores" value=""  placeholder="Nombres">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
		                          <label for="telefono_contacto_proveedores" class="control-label">Teléfono:</label>
                                  <input type="number" class="form-control" id="telefono_contacto_proveedores" name="telefono_contacto_proveedores" value=""  onkeypress="return numeros(event)" placeholder="#">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
		                          <label for="celular_contacto_proveedores" class="control-label">Celular:</label>
                                  <input type="number" class="form-control" id="celular_contacto_proveedores" name="celular_contacto_proveedores" value=""  onkeypress="return numeros(event)" placeholder="#">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     
		     <div class="form-group">
             <div class="col-xs-12 col-md-3">
		                          <label for="email_contacto_proveedores" class="control-label">Email:</label>
                                  <input type="email" class="form-control" id="email_contacto_proveedores" name="email_contacto_proveedores" value=""   placeholder="Correo Electrónico">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     </div>
		    
	         </div>
	         </div> 
	         </div> 
	         </div>
         	
  			 							
	       <div class="row">
		   <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px" > 
           <div class="form-group">
            					  <button type="button"  class="btn btn-success  btn-raised btn-lg" onclick='InsertaCliente();' id='btn-nuevo' ><i class='fa fa-times'></i> Guardar</button>
            					   <button type='button' class='btn btn-danger btn-raised btn-lg' onclick='CancelaNuevoCliente();' id='btn-nuevo-cancela'><i class='fa fa-times'></i> Cancelar</button>
                   
           </div>
           </div>
           </div>
		  
		   </form>
            
         
        </div>
        </div>
        <div class="footer" style="margin-top:50px">
        <?php include("view/modulos/footer.php"); ?>
        </div>
        
        
        
	    
  
   
        
     </body>  
    </html>  
    
            