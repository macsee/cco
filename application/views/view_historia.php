<!DOCTYPE html>

<html>
	<head>
		<title>Historia Clinica</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<script type="text/javascript"  src="<?php echo base_url('js/jsPanel-master/jquery-2.1.3.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/jsPanel-master/jquery-ui-1.11.2.min.js')?>"></script>

		<script type="text/javascript"  src="<?php echo base_url('js/jquery.popupoverlay.js')?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css')?>"/>

		<!--<script type="text/javascript"  src="<?php echo base_url('js/jsPanel-master/source/jquery.jspanel.js')?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/jsPanel-master/source/jquery.jspanel.css')?>"/>-->

		<script type="text/javascript">

	  		$(document).ready(function()
			{
				var content = $("<div style= 'margin-top:20px;margin-left:20px'>"+
								"<form action='<?php echo base_url('index.php/main/add_record')?>' method='post'>"+
  								"<input type='text' name='record'><br>"+
  								"<input type='submit' value='Submit'>"+
  								"</form>"+
  								"</div>");

				$('#sample-jspanel-1').click(function () {
        			$.jsPanel({
        					content: function(){ 
    							$(this).load("../../../../cco/record_form.php"); 
    						},
        					size:     {width: 800, height: 600},
        					//overflow: {vertical: 'scroll'},
        				   	selector: "#container-1",
    						position: "center",
    						title:    "Nuevo registro",
    						//content: window.location.pathname,
    						//content:  content
        			});
    			});

				$(".clickeable").click(function()
				{ 
					var id = $(this).attr("id");
					if ($("#detalles_"+id).is(":hidden")) {
						$('[id^="detalles_"]').slideUp("fast"); 
						$("#detalles_"+id).slideDown("fast");
						
						//$("#detalles_*").;
					} 
					else {
						$("#detalles_"+id).slideUp("fast");
					}		
				});

				$("#nuevo_registro_boton").click(function()
				{ 
					//var id = $(this).attr("id");
					if ($("#nuevo_registro").is(":hidden")) {
						//$('[id^="nuevo_registro"]').slideUp("fast"); 
						$("#nuevo_registro").slideDown("fast");
						
						//$("#detalles_*").;
					} 
					else {
						$("#nuevo_registro").slideUp("fast");
					}		
				});

				$("#nuevo_antecedente_boton").click(function()
				{ 
					//var id = $(this).attr("id");
					if ($("#nuevo_antecedente").is(":hidden")) {
						//$('[id^="nuevo_registro"]').slideUp("fast"); 
						$("#nuevo_antecedente").slideDown("fast");
						
						//$("#detalles_*").;
					} 
					else {
						$("#nuevo_antecedente").slideUp("fast");
					}		
				});
			});	

			$(function() {
			    $('#my_modal').popup();
			});

			function resizeIframe(iframe) {
   					iframe.height = iframe.contentWindow.document.body.scrollHeight + 1500 + "px";
   					//alert(iframe.height);
  			};

		</script>

		<style>
		  /* Add these styles once per website */
		 .popup_background {
		    z-index: 2000; /* any number */
		 }
		 .popup_wrapper {
		    z-index: 2001; /* any number + 1 */
		 }
		  /* Add inline-block support for IE7 */
		 .popup_align,
		 .popup_content {
		    *display: inline;
		    *zoom: 1;
		 }
		  
		.buttonSubmit{
			margin-left: 160px;
			background-color: #97BFD9;
			text-decoration: none;
			border-radius: 4px;
			font-size: 20px;
			color: white;
		}

		.select {
			margin-left: 60px;
		}

		.browse{
			font-size: 15px;
			margin-top: 10px;
			margin-left: 10px;
		}

		#form_load_file {
			border: 2px solid #D1D1D1;
			background-color: #F2F2F2;
  			width: 450px;
  			height: 100px;
		}

		.clickeable{
			background-color: #F7F7F7;
			height: 25px;
			margin-bottom: 5px;
			border: 1px solid #E5E5E5;
			padding-left: 10px;
		}

		body {
			overflow-y: scroll;
		}

		#content{
			//margin: auto;
			//width: 95%;
		}

		#estudios {
			font-size: 15px;
			float: left;
			width: 26%;
		}

		#estudios_titulo{
			height: 30px;
			//background-color: #97BFD9;
			background-color: #454545;
			margin-bottom: 2px;
			color: white;
			padding-left: 10px;
			font-size: 20px;
		}

		#ventana_principal{
			float:left;
			width:73.8%;
			margin-right: 2px;
		}

		#barra_titulo{
			//background-color: #97BFD9;
			background-color: #454545;
			height: 30px;
			font-size: 20px;
			color: white;
			padding-left: 10px;
		}

		#datos_paciente {
			margin-top: 2px;
			min-height: 150px;
			border: 1px solid #EEE;
			background-color: #F7F7F7;

		}

		#datos_paciente li{
			list-style-type: none;
			list-style-position: outside;
			margin-bottom: 10px;
			font-size: 13pt;
		}

		#panel_izq{
			float: left;
			width: 50%;

		}

		#panel_der{
			float: left;
			width: 50%;
		}

		#panel_inf{
			float: left;
			width: 100%;
			margin-top: 5px;
		}
		
		#historia_paciente{
			margin-top: 10px;
			margin-bottom: 20px;
		}

		#datos_historia{
			height: 35px;
			color: white;
			font-size: 17px;
		}

		#fecha_historia{
			background-color: #97BFD9;
			float: left;
			padding-left: 10px;
			padding-right: 15px;
			padding-top: 5px;
			margin-right: 2px;
			height: 27px;
		}

		#hora_historia{
			background-color: #97BFD9;
			float: left;
			padding-left: 10px;
			padding-right: 15px;
			padding-top: 5px;
			margin-right: 2px;
			height: 27px;
		}

		#medico_historia{
			float: left;
			background-color: #97BFD9;
			float: left;
			padding-left: 10px;
			padding-right: 10px;
			padding-top: 5px;
			height: 27px;
		}

		#content_historia{
			border: 1px solid #EEE;
			background-color: #F7F7F7;
			padding: 20px 30px 30px 30px;
		}

		.cargar{
			margin: 0 auto;
		}

		#info{
			//color: #cfe1ed;
			color: #97BFD9;
		}

		#info2{
			float: right;
			margin-right: 140px;
			text-align: left;
		}

		#info3{
			float: right;
			margin-right: 100px;
			text-align: left;
		}

		#hist{
			float: left;
			margin-right: 10px;
		}

		.jsPanel-hdr.jsPanel-theme-default{
 		   font-family: OSWALD;
		}

		.jsPanel-hdr *{
		    font-size: 18px;
		}

		.nuevo_boton {
			float:right;
			width: 120px;
			height: 25px;
			background-color: #97d0d9;
			font-family: OSWALD;
			font-size: 17px;
			font-weight: bold;
			color: white;
			padding-left: 10px;
			cursor: pointer;
		}	

		#nuevo_registro {
			margin-bottom: 20px;
			//height: 1600px;
			border: 1px solid #EEE;
			background-color: #F7F7F7;
			display: none;
		}

		#nuevo_antecedente {
			margin-bottom: 20px;
			height: 380px;
			border: 1px solid #EEE;
			background-color: #F7F7F7;
			display: none;
		}

		.class_titulo {
			margin-top:2px;
			margin-bottom: 2px;
			height: 25px;
			background-color: #1e3e53;
			font-family: OSWALD;
			font-size: 14pt;
			font-weight: bold;
			color: white;
			padding-left: 10px;
		}	

		#antecedentes {
			margin-bottom: 30px;
			min-height: 150px;
			border: 1px solid #EEE;
			background-color: #F7F7F7;
			padding-right: 10px;
		}

		#antecedentes_list {
			margin-left: 20px;
			margin-top: 10px;
		}

		#nuevo_antecedente_boton {

		}

		.triangulo {
			float:right;
			width: 0px;
			height: 0px;
			border-top: 12px solid transparent;
			border-right: 12px solid #97d0d9;
			border-bottom: 12px solid transparent;
		}

		button.mod {
			font-size: 14px;
			padding: 5px 10px;
		}

  		</style>
	</head>
	<body>
		<div id = "content">
			<div id = "ventana_principal">
				<div style = "width:72.9%;position:fixed">
					<div id = "barra_titulo" class = "texto_oswald">
						<div id = "hist"> Historia Clínica Nº </div> <div id = "info"> <?php echo $datos_paciente[0]->nroficha.' - '.$datos_paciente[0]->apellido.', '.$datos_paciente[0]->nombre ?> </div>
					</div>
					<div id = "datos_paciente" class = "texto_oswald">
						<div id = "panel_izq">
							<ul>
								<li> Fecha de Nacimiento: <div id = "info2"> <?php echo $datos_paciente[0]->fecha_nacimiento ?> </div></li>
								<li> DNI: <div id = "info2"> <?php echo $datos_paciente[0]->dni ?> </div></li>
								<li> Localidad: <div id = "info2"> <?php echo $datos_paciente[0]->localidad ?> </div></li>
								<li> Dirección: <div id = "info2"> <?php echo $datos_paciente[0]->direccion ?> </div></li>
							</ul>
						</div>
						<div id = "panel_der">
							<ul>
								<li> Teléfono: <div id = "info3"> <?php echo $datos_paciente[0]->tel1 ?></li>
								<li> Celular: <div id = "info3"> <?php echo $datos_paciente[0]->tel2 ?></li>
								<li> Obra Social: <div id = "info3"> <?php echo $datos_paciente[0]->obra_social ?></li>
								<li> Nro de Afiliado: <div id = "info3"> <?php echo $datos_paciente[0]->nro_obra ?></li>
							</ul>	
						</div>
					<!--<div id = "panel_inf">
						<ul>
							<li> Observaciones: <?php echo $datos_paciente[0]->observaciones ?></li>
						</ul>	
					</div>	-->	
					</div>
				</div>	
				<div style = "margin-top:190px;width:100%">
					<div class = "class_titulo">
						Antecedentes
						<?php if ($this->session->userdata('grupo') == "Medico") { ?>
						<div id = "nuevo_antecedente_boton" class = "nuevo_boton">
							Nuevo Antecedente
						</div>
						<div class = "triangulo"></div>
						<?php } ?>
					</div>
					
					<?php if ($this->session->userdata('grupo') == "Medico") { ?>
						<div id = "nuevo_antecedente">
								<form method="post">
									<input type="hidden" name="paciente" value = <?php echo $paciente_id ?> />
									<textarea style ="font-size:15px;width:755px;height:300px;margin-left:20px;margin-top:20px" name = "antecedente" required><?php echo $borrador_antecedente ?></textarea>
									<button style = "float:right;margin-right:28px;margin-top:5px" class="submit mod" type="submit" formaction="<?php echo base_url('index.php/main/add_antecedente')?>">Guardar</button>
									<button style = "float:right;margin-right:20px;margin-top:5px" class="submit_borrador mod" type="submit" formaction="<?php echo base_url('index.php/main/guardar_borrador/antecedente')?>">Guardar Borrador</button>
									<button style = "float:right;margin-right:20px;margin-top:5px" class="submit_borrador mod" type="submit" formaction="<?php echo base_url('index.php/main/eliminar_borrador/antecedente')?>">Eliminar</button>
								</form>
						</div>
					<?php } ?>

					<div id = "antecedentes">
						<?php
						
						if ($antecedentes == 0) {
							echo "No hay antecedentes para este paciente.";
						}
						
						else {
							echo '<ul>';
							foreach ($antecedentes as $value) {
								echo '<li style ="margin-bottom:40px">';
									echo '<p>'.$this->encrypt->decode($value->text).'</p>';
									echo '<p style = "font-weight:bold;font-size:12px;font-style:italic;width:98%;text-align:right;margin-top:20px">Ingresado el '.date('d-m-Y @ H:i',strtotime($this->encrypt->decode($value->fecha))).' por Dr. '.$this->encrypt->decode($value->medico).'</p>';
								echo '</li>';
							}
							echo '</ul>';
						}

					?>
					</div>
				</div>
				<div style = "width:100%">	
					<div class = "class_titulo">
						Registros
						<?php if ($this->session->userdata('grupo') == "Medico") {
							echo '<div id = "nuevo_registro_boton" class = "nuevo_boton">';
								echo "Nuevo Registro";
							echo '</div>';
							echo '<div class = "triangulo"></div>';
						} ?>
					</div>

					<?php if ($this->session->userdata('grupo') == "Medico") {
						echo '<div id = "nuevo_registro">';
							echo '<iframe id = "myiframe" style = "border:none;width: 100%;margin-left:5px" src="'.base_url('index.php/main/load_hc_form/').'" onload="resizeIframe(this)"></iframe>';
						echo '</div>';
					/*<!--		<form method="post">
								<input type="hidden" name="paciente" value = <?php echo $paciente_id ?> />
								<textarea style ="font-size:15px;width:755px;height:300px;margin-left:20px;margin-top:20px" name = "registro" required><?php echo $borrador_registro ?></textarea>
								<button style = "float:right;margin-right:28px;margin-top:5px" class="submit mod" type="submit" formaction="<?php echo base_url('index.php/main/add_registro')?>">Guardar</button>
								<button style = "float:right;margin-right:20px;margin-top:5px" class="submit_borrador mod" type="submit" formaction="<?php echo base_url('index.php/main/guardar_borrador/registro')?>">Guardar Borrador</button>
								<button style = "float:right;margin-right:20px;margin-top:5px" class="submit_borrador mod" type="submit" formaction="<?php echo base_url('index.php/main/eliminar_borrador/registro')?>">Eliminar</button>
							</form>
						</div>-->*/
					}	
						if ($historia == 0) {
							echo "No hay registros para este paciente.\n";
						}
						
						else {
							foreach ($historia as $value) {
									
								echo '<div id = "historia_paciente">';
									echo '<div id = "datos_historia" class = "texto_oswald">';
										echo '<div id = "fecha_historia">';
											echo date('d-m-Y @ H:i',strtotime($this->encrypt->decode($value->fecha)));				
										echo '</div>';

										echo '<div id = "medico_historia">';
											echo "Dr. ".$this->encrypt->decode($value->medico);
										echo '</div>';
									echo '</div>';

									echo '<div id = "content_historia">';
										echo $this->encrypt->decode($value->text);				
									echo '</div>';
								echo '</div>';
							}
						}

					?>
				</div>	
			</div>
			<div id = "estudios">
				<div id = "estudios_titulo" class ="texto_oswald">
					Archivos Paciente
				</div>

			<?php 
				if ($estudios == 0) {
					echo "No hay archivos para este paciente";
				}
				else {
					$tipo = "";
					//echo '<div class="fotorama" data-width="1200" data-height="900">';
					foreach ($estudios as $value) {

						if ($value->tipo <> $tipo) {

							if ($tipo <> "")
								echo '</div>';

							$tipo = $value->tipo;

							echo '<div class = "clickeable texto_oswald" id = "'.$value->tipo.'" style="cursor: pointer;">';
								echo $value->tipo;
							echo '</div>';
							echo '<div id = "detalles_'.$value->tipo.'" class="detalles" style = "display:none;">';
							
						}
							echo '<a href="'.$value->ruta.'">'.$value->imagen.'</a>';
							echo '</br>';	
	    				//	echo '<a rel="'.$value->ruta.'" href="'.$value->ruta.'"><img src="'.$value->imagen.'"/></a>';
						//echo '<a class="fancybox-thumbs" data-fancybox-group="thumb" href="'.$value->ruta.'"><img src="'.$value->imagen.'"/></a>';
						//<a href="URL de la imagen" rel="shadowbox[galeria1]" title="Imagen">Imagen 1</a>
						//echo '<a href ="'.$value->ruta.'" rel = "shadowbox[galeria1]">'.$value->imagen.'</a>';
		
					}
					echo '</div>';
				}	
			?>
			
			<br>
			<button class="my_modal_open cargar">Cargar Archivos</button>
			<!--<button id="sample-jspanel-1" type="button">Execute example above</button>-->
		</div>
		
		<!-- INICIO VENTANA EMERGENTE PARA CARGA DE ARCHIVOS -->

		<div id="my_modal">
			<div id = "form_load_file">
				<form action="<?php echo base_url('index.php/main/do_upload')?>" method="post" enctype="multipart/form-data">

						<input class = "texto_oswald browse" type="file" multiple name="userfile[]" size="20" />
						<input type="hidden" name="paciente" value = <?php echo $paciente_id ?> />
						<select class = "select" id = "tipo" name = "tipo" required>
							<option value="">Seleccionar</option>
			  				<option value="OCT">OCT</option>
			  				<option value="RFG">RFG</option>
			  				<option value="ME">ME</option>
			  				<option value="IOL">IOL</option>
			  				<option value="CVC">CVC</option>
			  				<option value="TOPO">TOPO</option>
			  				<option value="HRT">HRT</option>
			  				<option value="PAQUI">PAQUI</option>
			  				<option value="HC">HC</option>
			  				<option value="IMAGEN">IMAGEN</option>
						</select> 
						<br /><br />

						<button class="buttonSubmit texto_oswald" type="submit"> Subir Archivo </button>

				</form>
			</div>
		</div>

	</body>
</html>