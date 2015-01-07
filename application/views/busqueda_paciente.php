<!DOCTYPE html>

<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Buscar Paciente</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<style>
	.form_busqueda input {height: 10px; width: 315px;}
	</style> 
	<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
	$(document).ready(function() {
			
		 $( "#busqueda_texto" ).autocomplete({
			minLength: 1,
			source : base_url+"search.php",
      		//source: "http://192.168.1.12/cco/search.php",
      //focus: function( event, ui ) {
       // $( "#project" ).val( ui.item.label );
       // return false;

      //},
		    select: function( event, ui ) {

		    $("#result_buscar").hide();	
		    $( "#busqueda_texto" ).val( ui.item.label );	
		    var url = base_url+"index.php/main/buscar_id_paciente/"+(ui.item.value);

		    //var url = "http://192.168.1.12/cco/index.php/main/buscar_id_paciente/"+(ui.item.value);
		    
        	$('#iframe').attr('src', url);
        	//$('#iframe').reload();
         	//var x = 
         	//$("#result").load(x);
          	//location.href = x;

	        $( "#busqueda_texto" ).val( ui.item.label );
	        //$( "#result" ).html( ui.item.nombre );
	        //$( "#project-id" ).val( ui.item.value );
	        //$( "#project-description" ).html( ui.item.ficha );

	        return false;
    	  }
    	})
    	.data( "autocomplete" )._renderItem = function( ul, item ) {
      		return $( "<li>" )
        	.data( "item.autocomplete", item )
        	.append( "<a>" + item.label + "<div style = 'float:right; cursor:pointer'>" + item.ficha + "</div></a>" )
        	.appendTo( ul );
    	};

    	$("#submit").click(function(event)
		{
			event.preventDefault();
			var value = $("#busqueda_texto").val();
			var datastring = "posteo="+value;
			$.ajax({

					type: 'POST',
 					url: base_url+"cosa.php",
 					//url: "http://192.168.1.12/cco/cosa.php",
 					data: datastring,
					success:function(response)
					{
						$("#result").html(response);
						$(".ui-autocomplete").hide();
					},
			});

		});

  	});

	function asignar(url,data,ficha,nom,ape) {

		var apellido = '<?php echo $this->uri->segment(3);?>';
		var nombre = '<?php echo $this->uri->segment(4);?>';

		$( "#asignar_ficha" ).html( "Asignar ficha "+ficha+" al paciente "+apellido+", "+nombre );
		
        $( "#asignar_ficha" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 300,
            height: 150,
            modal: true,
            buttons: {
                "Si": function() {
					var x = url+'/'+data+'/'+ficha+'/'+nom+'/'+ape;
					//alert(x);
					location.href = x;
                },
				"No": function() {
                    $( this ).dialog( "close" );
				}
            }
        });
   };

	
	</script>
	<style>

		.ui-menu .ui-menu-item a { font-size: 14px}


		.ui-autocomplete {
	        max-height: 300px;
	        overflow-y: auto;
	        /* prevent horizontal scrollbar */
	        overflow-x: hidden;
	    }
	    /* IE 6 doesn't support max-height
	     * we use height instead, but this forces the menu to always be this tall
	     */
	    * html .ui-autocomplete {
	        height: 100px;
	        font-size: 15px;
	    }
		
		.ui-widget {
		font-size: 14px;
	}
		
		.ui-dialog {
			//position: relative;
			margin: auto;
			font-size: 14px;
			text-align: center;
		}
		
		.ui-dialog .ui-dialog-buttonpane { 
		    text-align: center;
		}
		.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset { 
		    float: none;
		}

		.contact_form textarea {
			width: 563px;
		}

		.fila_mensaje {float: left; width: 100%; height: 30px; margin-bottom: 4px; padding-top: 10px; background-color: #F7F7F7; border: 1px solid #EEE;}
		.fila_nombre {float: left; margin-left: 20px }
		.fila_ficha {float: right; margin-right: 20px;}
	</style>

</head>

<body>

<div style = "display:none" id="asignar_ficha" title="¿Asignar Ficha?"> Asignar ficha </div>

<div class = "titulo">
	<div id = "titulo_izq">
		Busqueda de Pacientes
	</div>

	<div style = "float:left; margin-left:80%; margin-top:5px">
				<?php
				echo '<a href="'.base_url('index.php').'">'; 
					echo '<img src = "'.base_url('css/images/home_24x24.png').'"/>'; 
				echo '</a>';
				?>
			</div>

			<div style = "float:left; margin-left:2%; margin-top:8px">
				<?php
				echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d')).'">';
					echo '<img src = "'.base_url('css/images/book_alt2_24x21.png').'"/>'; 
				echo '</a>';
				?>
	</div>

</div>	

<div id = "buscar_paciente">

<div id = "buscar">
	<div id = "buscar_input">
			<form class="form_busqueda" action="<?php echo base_url('index.php/main/busqueda')?>" method="post" name="search_form" id="search_form">

	  			<input name="busqueda_texto" id = "busqueda_texto" autocomplete="off" autofocus= "autofocus" placeholder="Busqueda de pacientes..." required/>
				<button type="submit" id = "submit"> Buscar </button>	
						
			</form>				
	</div>
</div>	


	<div id="result">
		<div id="result_buscar">
			<?php
			
				if (is_array($resultado)) {
					if ( (sizeof($resultado) > 0) && ($id_turno <> "") ) {

						foreach ($resultado as $key) {
						echo '<div class = "fila_mensaje">';
							echo '<div class = "fila_nombre">';	
								echo $key->apellido.', '.$key->nombre;
							echo '</div>';
						//if ($id_turno <> "") {
							
							echo '<div style = "float:right; margin-right:10px">';
								echo '<a style="cursor: pointer;" onclick = "return asignar(\''.base_url("/index.php/main/asignar_ficha").'\', \''.$id_turno.'\', \''.$key->nroficha.'\', \''.$key->nombre.'\', \''.$key->apellido.'\');">'; 
									echo '<img src = "'.base_url('css/images/transfer_24x18.png').'"/>'; 
								echo '</a>';
							echo '</div>';
						//}	 
							echo '<div class = "fila_ficha">';	
								echo $key->nroficha;
							echo '</div>';	
						echo '</div>';

						}
	
					}

					else if ( (sizeof($resultado) == 1) && ($id_turno == "") ) {

					?>	
						<script>
							$( function(){ 
								var id = '<?php echo $resultado[0]->id; ?>';
								var base_url = "<?php echo base_url() ?>";	
								var url = base_url+"index.php/main/buscar_id_paciente/"+id;
        						$('#iframe').attr('src', url);
							} );
						</script>

					<?php		
					}	
				}	
			?>
		</div>

		<iframe id = "iframe"></iframe>

	</div>

</div>

<div style = "float:right; margin-right: 200px"> 

<?php
if ($id_turno <> "") {
	echo anchor('main/nuevo_paciente_/'.$id_turno, "Nuevo Paciente");
} 
?>
	 
</div>

</body>

</html>
