<!DOCTYPE html>

<html>
	<head>
		<title>Historia Clinica</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>

		<script type="text/javascript"  src="<?php echo base_url('js/jquery.popupoverlay.js')?>"></script>
		<!--
		<script type="text/javascript"  src="<?php echo base_url('js/fotorama-3.0.8/fotorama.js')?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/fotorama-3.0.8/fotorama.css')?>" media="screen"/>
		-->
		<!--
		<script type="text/javascript"  src="<?php echo base_url('js/fresco-1.2.2-light/js/fresco/fresco.js')?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/fresco-1.2.2-light/css/fresco/fresco.css')?>" media="screen"/>
		-->
		<script type="text/javascript" src="<?php echo base_url('js/fancybox/source/jquery.fancybox.js?v=2.1.4')?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/fancybox/source/jquery.fancybox.css?v=2.1.4')?>" media="screen"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css')?>"/>

		<!-- Add Thumbnail helper (this is optional)
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7')?>" />
		<script type="text/javascript" src="<?php echo base_url('js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/ddpowerzoomer.js')?>"></script>
		-->

		<script type="text/javascript">

	  		$(document).ready(function()
			{
				
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

			});

			$(function() {
			    $('#my_modal').popup();
			});

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

		#content{
			margin: auto;
			width: 85%;
		}

		#estudios {
			font-size: 15px;
			float: left;
			width: 24%;
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
			width:75.5%;
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
			min-height: 210px;
			border: 1px solid #EEE;
			background-color: #F7F7F7;
		}

		#datos_paciente li{
			list-style-type: none;
			list-style-position: outside;
			margin-bottom: 10px;
			font-size: 15px;
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
			margin-bottom: 50px;
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
			color: #cfe1ed;
		}

		#info2{
			float: right;
			margin-right: 140px;
			text-align: left;
		}

		#hist{
			float: left;
			margin-right: 10px;
		}
  		</style>

	</head>
	<body>
		<div id = "content">
			<div id = "ventana_principal">
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
							<li> Teléfono: <?php echo $datos_paciente[0]->tel1 ?></li>
							<li> Teléfono 2: <?php echo $datos_paciente[0]->tel2 ?></li>
							<li> Obra Social: <?php echo $datos_paciente[0]->obra_social ?></li>
							<li> Nro de Afiliado: <?php echo $datos_paciente[0]->nro_obra ?></li>
						</ul>	
					</div>
					<div id = "panel_inf">
						<ul>
							<li> Observaciones: <?php echo $datos_paciente[0]->observaciones ?></li>
						</ul>	
					</div>	
					
				</div>	
				<div id = "historia_paciente">
					<div id = "datos_historia" class = "texto_oswald">
						<div id = "fecha_historia">
							13-10-2014 @ 10:10:00 Hs
						</div>
						<div id = "medico_historia">
							Dr. Jelusich
						</div>
					</div>
					<div id = "content_historia">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero nisl, scelerisque fringilla ipsum luctus at. Integer vitae neque placerat, venenatis sapien ac, elementum neque. Donec placerat iaculis venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet malesuada nulla. Cras imperdiet pellentesque sapien, ut porttitor erat fermentum vitae. Aliquam risus libero, iaculis in quam quis, condimentum pellentesque turpis. Phasellus ac urna sem. Fusce ultricies lorem sit amet orci malesuada, sed efficitur arcu elementum. Sed accumsan lobortis quam et hendrerit. Curabitur malesuada tortor sapien, eu consequat leo ornare vitae. Donec semper tempus nisi at ornare. Integer fringilla dui velit, vel mollis velit posuere ac. Nunc ac libero id risus tincidunt porta. Ut tincidunt congue ligula et ultrices.

Duis dictum ac erat sed vulputate. Fusce ultricies, tortor aliquet scelerisque facilisis, elit justo vestibulum lacus, in elementum felis magna a justo. Nam sit amet placerat lacus. Cras quis turpis eu nibh accumsan egestas. Quisque tincidunt ornare enim, et posuere purus efficitur at. Curabitur vel est quis nisl porta consequat semper non lorem. Integer feugiat, enim a venenatis feugiat, risus diam hendrerit diam, et pharetra eros metus at lacus. Duis euismod justo ac leo pellentesque, vel porttitor dui interdum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed purus mauris, iaculis eget neque accumsan, malesuada vestibulum erat. Donec tristique turpis a est gravida malesuada. Mauris sit amet tortor ut arcu placerat tincidunt.
					</div>
				</div>	
			</div>	
			<div id = "estudios">
				<div id = "estudios_titulo" class ="texto_oswald">
					Archivos Paciente
				</div>

			<?php 
				if ($resultado == 0) {
					echo "No hay archivos para este paciente";
				}
				else {
					$tipo = "";
					//echo '<div class="fotorama" data-width="1200" data-height="900">';
					foreach ($resultado as $value) {

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