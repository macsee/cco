<!DOCTYPE html>

<html>
	<head>
		<title>Historia Clínica</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
		<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css')?>"/>
		<!--
		<script type="text/javascript"  src="<?php echo base_url('js/jsPanel-master/jquery-2.1.3.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/jsPanel-master/jquery-ui-1.11.2.min.js')?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css')?>"/>

		<script type="text/javascript"  src="<?php echo base_url('js/jquery.popupoverlay.js')?>"></script>
		<!--<script type="text/javascript"  src="<?php echo base_url('js/jsPanel-master/source/jquery.jspanel.js')?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/jsPanel-master/source/jquery.jspanel.css')?>"/>-->
		<script type="text/javascript">


			function save_registro() {

				var $iframe = $('#registro_iframe');

				formaction = "<?php echo base_url('index.php/main/guardar_borrador/registro')?>";

				$iframe.contents().find("body #form_registro").attr('action', formaction);
				$iframe.contents().find("body #form_registro").attr('target', '_parent');
				$iframe.contents().find("body #form_registro").submit();

			}

			function enviar_ant(id) {

				if (id == "ant_guardar")
					formaction = "<?php echo base_url('index.php/main/submit_data/antecedente')?>";
				else if (id == "ant_borrador")
					formaction="<?php echo base_url('index.php/main/guardar_borrador/antecedente')?>";
				else
					formaction="<?php echo base_url('index.php/main/eliminar_borrador/antecedente')?>";

				if ($('[name="antecedente"]').val() != "") {

					$.ajax({
				    	url: formaction,
				    	data: {antecedente: $('[name="antecedente"]').val(), paciente: $('[name="paciente"]').val()},
				    	type : "POST",
				      	success: function(){
				      		save_registro();
				      	}
				    });

				    return false;
				}

			}

	  		$(document).ready(function()
			{

				var content = $("<div style= 'margin-top:20px;margin-left:20px'>"+
								"<form action='<?php echo base_url('index.php/main/add_record')?>' method='post'>"+
  								"<input type='text' name='record'><br>"+
  								"<input type='submit' value='Submit'>"+
  								"</form>"+
  								"</div>");

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

				$("#cargar_archivos").click(function()
				{
					$( "#cargar_ventana" ).dialog({
						autoOpen: true,
			            resizable: false,
						width: 450,
			            height: 250,
			            modal: true,
			            buttons: {
			                "Cargar": function() {
			                	if ($("#tipo").val() == "")
			                		$("#error_subida").html("Error! Debe seleccionarse un tipo de archivo!");
			                	else if ($("#seleccionar_archivo").val() == "")
									$("#error_subida").html("Error! Debe seleccionarse algún archivo!");
								else
									$("#cargar_form").submit();
			                },
							"Cancelar": function() {
			                    $( this ).dialog( "close" );
							}
			            }
        			});
				});

			});

			function borrar(id,id_paciente) {
			        $( "#borrar_estudio" ).dialog({
						autoOpen: true,
			            resizable: false,
						width: 300,
			            height: 80,
			            modal: true,
			            buttons: {
			                "Si": function() {
			                	var base_url = '<?php echo base_url("index.php/main"); ?>';
								var x = base_url+"/borrar_estudio/"+id+"/"+id_paciente;
								location.href = x;
			                },
							"No": function() {
			                    $( this ).dialog( "close" );
							}
			            }
			        });
			};

			//$(function() {
			//    $('#my_modal').popup();
			//});
		</script>

		<style>
		.ui-widget {
			font-size: 14px;
		}
		.ui-dialog {
			//position: relative;
			margin: auto;
		}
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
			//margin-left: 60px;
		}

		.browse{
			font-size: 15px;
			margin-top: 10px;
			margin-right: 100px;
			margin-bottom: 10px;
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
			margin: auto;
			width: 1100px;
		}

		#estudios {
			font-size: 15px;
			float: left;
			width: 298px;
		}

		#estudios_titulo{
			height: 35px;
			//background-color: #97BFD9;
			background-color: #454545;
			margin-bottom: 2px;
			color: white;
			padding-left: 10px;
			font-size: 20px;
		}

		#ventana_principal{
			float:left;
			//width:73.8%;
			width:800px;
			margin-right: 2px;
		}

		#barra_titulo{
			//background-color: #97BFD9;
			background-color: #454545;
			height: 35px;
			font-size: 20px;
			color: white;
			padding-left: 10px;
		}

		#datos_paciente {
			margin-top: 2px;
			min-height: 150px;
			border: 1px solid #E0E0E0;
			//background-color: #F7F7F7;
			background-color: #F4F4F4;

		}

		#datos_paciente li{
			list-style-type: none;
			list-style-position: outside;
			margin-bottom: 10px;
			font-size: 12pt;
		}

		#panel_izq{
			float: left;
			width: 54%;
			margin-left: 20px;
			margin-top:	5px;
		}

		#panel_der{
			float: left;
			width: 43%;
			margin-top:	5px;
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
			color: white;
			font-size: 11pt;
		}

		#fecha_historia{
			background-color: #97BFD9;
			float: left;
			padding-left: 5px;
			padding-right: 5px;
			padding-top: 5px;
			margin-right: 2px;
			height: 22px;
		}

		#hora_historia{
			background-color: #97BFD9;
			float: left;
			padding-left: 5px;
			padding-right: 5px;
			padding-top: 5px;
			margin-right: 2px;
			height: 22px;
		}

		#medico_historia{
			float: left;
			background-color: #97BFD9;
			float: left;
			padding-left: 10px;
			padding-right: 10px;
			padding-top: 5px;
			height: 22px;
		}

		#content_historia{
			border: 1px solid #E0E0E0;
			//background-color: #F7F7F7;
			background-color: #F4F4F4;
			float:left;
			margin-top: 2px;
			margin-bottom: 10px;
			width:798px;
		}

		.cargar{
			margin: 0 auto;
		}

		#info{
			//color: #cfe1ed;
			color: #97BFD9;
			float:left;
			width: 500px;
			margin-top: 5px;
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
			margin-top: 5px;
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
			border: 1px solid #E0E0E0;
			//background-color: #F7F7F7;
			background-color: #F4F4F4;
			display: none;
		}

		#nuevo_antecedente {
			margin-bottom: 20px;
			height: 280px;
			border: 1px solid #E0E0E0;
			//background-color: #F7F7F7;
			background-color: #F4F4F4;
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
			margin-bottom: 20px;
			min-height: 60px;
			border: 1px solid #E0E0E0;
			//background-color: #F7F7F7;
			background-color: #F4F4F4;
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

		.hc_titulo {
			float:left;
			font-size: 10pt;
			width: 100%;
			margin-left: 10px;
			margin-right: 10px;
			//font-weight: bold;
			//font-style: italic;
		}

		.hc_contenido {
			float:left;
			margin-right: 10px;
			font-size: 10pt;
			border-left:1px solid;
			text-align: justify;
		}

		.hc_contenido p {
			margin-top: 0px;
			margin-bottom: 0px;
			width: 680px;
		}

		.hc_fila {
			width: 100%;
			float:left;
			margin-top: 5px;
			margin-bottom: 5px;
		}

		.tabla_ref td{
			width: 40px;
			text-align:center;
			background-color:white
		}

		.tabla_ref th {
			font-size: 11pt;
		}

		.tabla_av td {
			width: 40px;
			text-align:center;
			background-color:white
		}

		.hc_contenido_3 {
			float:left;
			width: 40%;
			margin-top: 3px;
			margin-right: -2px;
		}

		.tabla_paciente td{
			width: 15%;
			height: 30px;
		}

		.hc_col_izq {
			float:left;
			margin-left: 120px;
			width: 300px;
		}

		.hc_col_der {
			float:left;
		}

		.hc_subtitulo {
			margin-top:15px;
			font-style:italic;
			margin-right: 10px;
			font-size: 10pt;
			float:left;
			width:90px;
			text-align: right;
		}

		#cargar_archivos {
			background-color: #58ADE5;
			font-family: 'OSWALD';
			font-size: 12pt;
			text-decoration: none;
			padding-left: 20px;
			padding-right: 20px;
			padding-top: 5px;
			padding-bottom: 5px;
			color: white;
			border-radius: 4px;
			float: left;
			margin-top: 20px;
		}

		.myboton {
			background-repeat:no-repeat;
			border:none;
			background-color: transparent;
			width: 40px;
			height: 40px;
			float: right;
		}

		.myboton:hover {
			cursor: pointer;
		}
  		</style>
	</head>
	<body>

	<?php
	function check($esf,$cil,$eje) {

		if (!strstr($esf, "-") && ($esf != "") )
			$esf = "+".$esf;

		if (!strstr($cil, "-") && ($cil != "") )
			$cil = "+".$cil;

		if ( ($cil != "") && ($eje != "") )
			$cil = $cil." x ".$eje."º";

		if ( ($esf == "") && ($cil == "") )
			$res = "-";
		else
			$res = $esf." ".$cil;

		return $res;
	}

	function checkKRT($krt,$eje) {

		if ( ($krt != "") && ($eje != "") )
			$res = $krt." x ".$eje."º";
		else if ($krt == "")
			$res = "-";
		else
			$res = $krt;

		return $res;
	}

	?>
		<div id="borrar_estudio" title="¿Borrar Estudio?"></div>
		<div id = "content">
			<div id = "ventana_principal">
				<div style = "width:800px;position:fixed"> <!-- 72.9%-->
					<div id = "barra_titulo" class = "texto_oswald">
						<div id = "hist"> Historia Clínica Nº </div> <div id = "info"> <?php echo $datos_paciente[0]->nroficha.' - '.$datos_paciente[0]->apellido.', '.$datos_paciente[0]->nombre ?> </div>
						<div style = "float:left">
							<?php
							echo '<a href="'.base_url('index.php').'">';
								echo '<img src = "'.base_url('css/images/home_24x24.png').'"/>';
							echo '</a>';
							?>
						</div>
						<div style = "float:left">
							<?php
							echo '<a target= "_blank" href="'.base_url('index.php/main/buscar_paciente').'">';
								echo '<img src = "'.base_url('css/images/user_18x24.png').'"/>';
							echo '</a>';
							?>
						</div>
						<div style = "float:left">
							<?php
							if (strpos($this->session->userdata('funciones'), "Medico") !== false ) {
								echo '<a target= "_blank" href="'.base_url('index.php/main/pacientes_admitidos/'.date('Y-m-d')).'">';
									echo '<img src = "'.base_url('css/images/admitidos.png').'"/>';
								echo '</a>';
							}
							?>
						</div>
						<div style = "float:left;margin-left:5px">
							<?php
							echo '<a href="'.base_url('index.php/login/desconectar').'">';
								echo '<img src = "'.base_url('css/images/logout.png').'"/>';
							echo '</a>';
							?>
						</div>
					</div>
					<div id = "datos_paciente" class = "texto_oswald">
						<div id = "panel_izq">
							<table class = "tabla_paciente">
								<tr>
									<td>Fecha de Nacimiento:</td>
									<td>
										<?php
											if ($datos_paciente[0]->fecha_nacimiento != "" && $datos_paciente[0]->fecha_nacimiento <> "0000-00-00")
												echo date('d-m-Y',strtotime($datos_paciente[0]->fecha_nacimiento))
										?>
									</td>
									<td>Edad:
										<?php
											if ($datos_paciente[0]->fecha_nacimiento != "" && $datos_paciente[0]->fecha_nacimiento <> "0000-00-00") {
												$dif = strtotime("now") - strtotime($datos_paciente[0]->fecha_nacimiento);
												echo floor($dif / (365*60*60*24));
											}
										?>
									</td>
								</tr>
								<tr>
									<td>DNI:</td>
									<td colspan = "2"><?php echo $datos_paciente[0]->dni ?></td>
								</tr>
								<tr>
									<td>Localidad:</td>
									<td <td colspan = "2"><?php echo $datos_paciente[0]->localidad ?></td>
								</tr>
								<tr>
									<td>Dirección:</td>
									<td <td colspan = "2"><?php echo $datos_paciente[0]->direccion ?></td>
								</tr>
							</table>
						</div>
						<div id = "panel_der">
							<table class = "tabla_paciente">
								<tr>
									<td>Teléfono 1:</td>
									<td><?php echo $datos_paciente[0]->tel1 ?></td>
								</tr>
								<tr>
									<td>Teléfono 2:</td>
									<td><?php echo $datos_paciente[0]->tel2 ?></td>
								</tr>
								<tr>
									<td>Obra Social:</td>
									<td title="<?php echo $datos_paciente[0]->obra_social?>"><?php echo (strlen($datos_paciente[0]->obra_social)>25 ? substr($datos_paciente[0]->obra_social,0,25)."..."  : $datos_paciente[0]->obra_social)?></td>
								</tr>
								<tr>
									<td>Nro de Afiliado:</td>
									<td><?php echo $datos_paciente[0]->nro_obra ?></td>
								</tr>
							</table>
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
						<?php if (strpos($this->session->userdata('funciones'), "Medico") !== false) { ?>
						<div id = "nuevo_antecedente_boton" class = "nuevo_boton">
							Nuevo Antecedente
						</div>
						<div class = "triangulo"></div>
						<?php } ?>
					</div>

					<?php if (strpos($this->session->userdata('funciones'), "Medico") !== false) { ?>
						<div id = "nuevo_antecedente">
							<form method="post" id = "form_antecedentes">
								<input type="hidden" name="paciente" value = <?php echo $paciente_id ?> />
								<textarea style ="font-size:15px;width:95%;height:200px;margin-left:20px;margin-top:20px" id = "txt_antecedente" name = "antecedente" required><?php echo $borrador_antecedente ?></textarea>
								<button style = "background-image: url(<?php echo base_url('css/images/guardar.png')?>)" class = "myboton" type="submit" title = "Guardar Antecedente" id = "ant_guardar" onclick = "return enviar_ant('ant_guardar')"></button>
								<button style = "background-image: url(<?php echo base_url('css/images/guardar_borrador.png')?>);margin-right:20px" class = "myboton" type="submit" type="submit" title = "Guardar Borrador" id = "ant_borrador" onclick = "return enviar_ant('ant_borrador')"></button>
								<button style = "background-image: url(<?php echo base_url('css/images/eliminar_borrador.png')?>)" class = "myboton" type="submit" title = "Eliminar Borrador" id = "ant_eliminar" onclick = "return enviar_ant('ant_eliminar')"></button>
								<!--
									<button style = "background-image: url(<?php echo base_url('css/images/guardar.png')?>)" class = "myboton" type="submit" title = "Guardar Antecedente" formaction="<?php echo base_url('index.php/main/submit_data/antecedente')?>"></button>
									<button style = "background-image: url(<?php echo base_url('css/images/guardar_borrador.png')?>);margin-right:20px" class = "myboton" type="submit" type="submit" title = "Guardar Borrador" formaction="<?php echo base_url('index.php/main/guardar_borrador/antecedente')?>"></button>
									<button style = "background-image: url(<?php echo base_url('css/images/eliminar_borrador.png')?>)" class = "myboton" type="submit" title = "Eliminar Borrador" formaction="<?php echo base_url('index.php/main/eliminar_borrador/antecedente')?>"></button>
								-->
							</form>
						</div>
					<?php } ?>

					<div id = "antecedentes">
						<?php

						if ($antecedentes == 0) {
							echo "<p style ='font-style:italic;margin-left:10px;font-size:11pt'>No hay antecedentes para este paciente.</p>";
						}

						else {
							echo '<ul>';
							foreach ($antecedentes as $value) {
								echo '<li style ="margin-bottom:40px">';
									echo '<p>'.json_decode($value->data)->antecedente.'</p>';
									echo '<p style = "font-weight:bold;font-size:12px;font-style:italic;width:98%;text-align:right;margin-top:20px">Ingresado el '.date('d-m-Y @ H:i',strtotime($value->fecha)).' por Dr. '.$value->medico.'</p>';
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
						<?php if (strpos($this->session->userdata('funciones'), "Medico") !== false ) {
							echo '<div id = "nuevo_registro_boton" class = "nuevo_boton">';
								echo "Nuevo Registro";
							echo '</div>';
							echo '<div class = "triangulo"></div>';
						} ?>
					</div>

					<?php if (strpos($this->session->userdata('funciones'), "Medico") !== false )
					{
						echo '<div id = "nuevo_registro">';
							echo '<iframe id = "registro_iframe" style = "border:none;width: 798px; height: 2450px" src="'.base_url('index.php/main/load_hc_form/'.$paciente_id).'"></iframe>';
						echo '</div>';
					}
						if ($historia == 0) {
							echo "<p style ='font-style:italic;margin-left:10px;font-size:11pt'>No hay registros para este paciente</p>";
						}

						else {
							foreach ($historia as $value) {

								$json = json_decode($value->data);
								//$json = json_decode(json_encode($value->data), true);
								//print_r($json);
					?>
								<div id = "historia_paciente">
									<div id = "datos_historia" class = "texto_oswald">
										<div id = "fecha_historia">
											<?php echo date('d-m-Y @ H:i',strtotime($value->fecha));?>
										</div>

										<div id = "medico_historia">
											<?php echo "Dr. ".$value->medico;?>
										</div>
									</div>
									<div id = "content_historia">
										<?php if ($json->motivo != "") { ?>
										<div class = "hc_fila">
											<div class = "hc_titulo" style = "width:100px;margin-top:2px">MOTIVO:</div>
											<div class = "hc_contenido" style = "width: 600px;border:none">
												<?php echo $json->motivo?>
											</div>
										</div>
										<?php } ?>

										<?php if 	( 	($json->od_esf_arm_sd.$json->od_cil_arm_sd.$json->od_eje_arm_sd.$json->os_esf_arm_sd.$json->os_cil_arm_sd.$json->os_eje_arm_sd != "")	||
														($json->od_esf_arm_cd.$json->od_cil_arm_cd.$json->od_eje_arm_cd.$json->os_esf_arm_cd.$json->os_cil_arm_cd.$json->os_eje_arm_cd != "")	||
														isset($json->od_chk_arm_sd) ||	isset($json->os_chk_arm_sd) || isset($json->od_chk_arm_cd) || isset($json->os_chk_arm_cd)
													) {
										?>
										<div class = "hc_fila">
											<div class = "hc_titulo">
												AUTOREFRACTOMETRÍA:
											</div>

											<div class = "hc_col_izq">
												<div class = "hc_subtitulo">
													Sin Dilatación:
												</div>
												<div class = "hc_contenido">
													<table>
														<tr>
															<td>OD:</td>
															<td>
																<?php
																	if ( isset($json->od_chk_arm_sd) )
																		echo "No mide";
																	else
																		echo check($json->od_esf_arm_sd,$json->od_cil_arm_sd,$json->od_eje_arm_sd);
																?>
															</td>
														</tr>
														<tr>
															<td>OS:</td>
															<td>
																<?php
																	if ( isset($json->os_chk_arm_sd) )
																		echo "No mide";
																	else
																		echo check($json->os_esf_arm_sd,$json->os_cil_arm_sd,$json->os_eje_arm_sd);
																?>
															</td>
														</tr>
													</table>
												</div>
											</div>

											<div class = "hc_col_der">
												<div class = "hc_subtitulo">
													Con Dilatación:
												</div>
												<div class = "hc_contenido">
													<table>
														<tr>
															<td>OD:</td>
															<td>
																<?php
																	if ( isset($json->od_chk_arm_cd) )
																		echo "No mide";
																	else
																		echo check($json->od_esf_arm_cd,$json->od_cil_arm_cd,$json->od_eje_arm_cd);
																?>
															</td>
														</tr>
														<tr>
															<td>OS:</td>
															<td>
																<?php
																	if ( isset($json->os_chk_arm_cd) )
																		echo "No mide";
																	else
																		echo check($json->os_esf_arm_cd,$json->os_cil_arm_cd,$json->os_eje_arm_cd);
																?>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
										<?php }?>

										<?php if 	( 	($json->od_k1_krt.$json->od_k1_eje_krt != "") 	||
														($json->od_k2_krt.$json->od_k2_eje_krt != "")	||
														($json->os_k1_krt.$json->os_k1_eje_krt != "")	||
														($json->os_k2_krt.$json->os_k2_eje_krt != "")	||
														($json->od_ave_krt.$json->os_ave_krt != "")		||
														isset($json->od_chk_krt) || isset($json->od_chk_krt)
													) {
										?>
										<div class = "hc_fila">
											<div class = "hc_titulo">
												KERATOMETRÍA:
											</div>
											<div class = "hc_col_izq">
												<div class = "hc_subtitulo">
													OD:
												</div>
												<div class = "hc_contenido">
													<?php if 	(!isset($json->od_chk_krt)) { ?>
													<table>
														<tr>
															<td>K1:</td>
															<td>
																<?php
																	echo checkKRT($json->od_k1_krt,$json->od_k1_eje_krt);
																?>
															</td>
														</tr>
														<tr>
															<td>K2:</td>
															<td>
																<?php
																	echo checkKRT($json->od_k2_krt,$json->od_k2_eje_krt);
																?>
															</td>
														</tr>
														<tr>
															<td>Ave:</td>
															<td>
																<?php echo $json->od_ave_krt;?>
															</td>
														</tr>
													</table>
													<?php } else
														echo "No mide";
													?>
												</div>
											</div>

											<div class = "hc_col_der">
												<div class = "hc_subtitulo">
													OS:
												</div>
												<div class = "hc_contenido">
													<?php if 	(!isset($json->os_chk_krt)) { ?>
													<table>
														<tr>
															<td>K1:</td>
															<td>
																<?php
																	echo checkKRT($json->os_k1_krt,$json->os_k1_eje_krt);
																?>
															</td>
														</tr>
														<tr>
															<td>K2:</td>
															<td>
																<?php
																	echo checkKRT($json->os_k2_krt,$json->os_k2_eje_krt);
																?>
															</td>
														</tr>
														<tr>
															<td>Ave:</td>
															<td>
																<?php echo $json->os_ave_krt;?>
															</td>
														</tr>
													</table>
													<?php } else
														echo "No mide";
													?>
												</div>
											</div>
										</div>
										<?php }?>

										<?php
											if (	($json->od_select_sc_lejos.$json->os_select_sc_lejos != "") ||
													($json->od_select_sc_cerca.$json->os_select_sc_cerca != "")
												) {
										?>
										<div class = "hc_fila">
											<div class = "hc_titulo">
												A.V. SIN CORRECCIÓN:
											</div>
											<div class = "hc_col_izq">
												<div class = "hc_subtitulo">
													Lejos:
												</div>
												<div class = "hc_contenido">
													<table>
														<tr>
															<td>OD:</td>
															<td>
																<?php
																	if ($json->od_select_sc_lejos != "")
																		echo $json->od_select_sc_lejos;
																	else
																		echo "-";
																?>
															</td>
														</tr>
														<tr>
															<td>OS:</td>
															<td>
																<?php
																	if ($json->os_select_sc_lejos != "")
																		echo $json->os_select_sc_lejos;
																	else
																		echo "-";
																?>
															</td>
														</tr>
													</table>
												</div>
											</div>
											<div class = "hc_col_der">
												<div class = "hc_subtitulo">
													Cerca:
												</div>
												<div class = "hc_contenido">
													<table>
														<tr>
															<td>OD:</td>
															<td>
																<?php
																	if ($json->od_select_sc_cerca != "")
																		echo $json->od_select_sc_cerca;
																	else
																		echo "-";
																?>
															</td>
														</tr>
														<tr>
															<td>OS:</td>
															<td>
																<?php
																	if ($json->os_select_sc_cerca != "")
																		echo $json->os_select_sc_cerca;
																	else
																		echo "-";
																?>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
										<?php }?>

										<?php
											if ( 	($json->od_select_cc_lejos.$json->os_select_cc_lejos != "") ||
													($json->od_esf_cc_lejos.$json->od_cil_cc_lejos.$json->od_eje_cc_lejos != "") ||
													($json->os_select_cc_cerca.$json->os_select_cc_cerca != "") ||
													($json->os_esf_cc_cerca.$json->os_cil_cc_cerca.$json->os_eje_cc_cerca != "")
												) {
										?>
										<div class = "hc_fila">
											<div class = "hc_titulo">
												A.V. CORRECCIÓN PACIENTE:
											</div>
											<div class = "hc_col_izq">
												<div class = "hc_subtitulo">
													Lejos:
												</div>
												<div class = "hc_contenido">
													<table>
														<tr>
															<td>OD:</td>
															<td style = "border-right:1px solid;width:30px">
																<?php
																	if ($json->od_select_cc_lejos != "")
																		echo $json->od_select_cc_lejos;
																	else
																		echo "-";
																?>
															</td>
															<td>
																<?php
																	echo check($json->od_esf_cc_lejos,$json->od_cil_cc_lejos,$json->od_eje_cc_lejos);
																?>
															</td>
														</tr>
														<tr>
															<td>OS:</td>
															<td style = "border-right:1px solid">
																<?php
																	if ($json->os_select_cc_lejos != "")
																		echo $json->os_select_cc_lejos;
																	else
																		echo "-";
																?>
															</td>
															<td>
																<?php
																	echo check($json->os_esf_cc_lejos,$json->os_cil_cc_lejos,$json->os_eje_cc_lejos);
																?>
															</td>
														</tr>
													</table>
												</div>
											</div>
											<div class = "hc_col_der">
												<div class = "hc_subtitulo">
													Cerca:
												</div>
												<div class = "hc_contenido">
													<table>
														<tr>
															<td>OD:</td>
															<td style = "border-right:1px solid;width:30px">
																<?php
																	if ($json->od_select_cc_cerca != "")
																		echo $json->od_select_cc_cerca;
																	else
																		echo "-";
																?>
															</td>
															<td>
																<?php
																	echo check($json->od_esf_cc_cerca,$json->od_cil_cc_cerca,$json->od_eje_cc_cerca);
																?>
															</td>
														</tr>
														<tr>
															<td>OS:</td>
															<td style = "border-right:1px solid">
																<?php
																	if ($json->os_select_cc_cerca != "")
																		echo $json->os_select_cc_cerca;
																	else
																		echo "-";
																?>
															</td>
															<td>
																<?php
																	echo check($json->os_esf_cc_cerca,$json->os_cil_cc_cerca,$json->os_eje_cc_cerca);
																?>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
										<?php }?>

										<?php
											if ( 	($json->od_select_subj_lejos.$json->os_select_subj_lejos != "") ||
													($json->od_esf_subj_lejos.$json->od_cil_subj_lejos.$json->od_eje_subj_lejos != "") ||
													($json->os_esf_subj_lejos.$json->os_cil_subj_lejos.$json->os_eje_subj_lejos != "") ||

													($json->od_select_subj_cerca.$json->os_select_subj_cerca != "") ||
													($json->od_esf_subj_cerca.$json->od_cil_subj_cerca.$json->od_eje_subj_cerca != "") ||
													($json->os_esf_subj_cerca.$json->os_cil_subj_cerca.$json->os_eje_subj_cerca != "") ||

													($json->od_select_subj_media.$json->os_select_subj_media != "") ||
													($json->od_esf_subj_media.$json->od_cil_subj_media.$json->od_eje_subj_media != "") ||
													($json->os_esf_subj_media.$json->os_cil_subj_media.$json->os_eje_subj_media != "")
												) {
										?>
										<div class = "hc_fila">
											<div class = "hc_titulo">
												A.V. CORRECCIÓN SUBJETIVA:
											</div>
											<div class = "hc_col_izq">
											<?php 	if 	( 	($json->od_select_subj_lejos.$json->os_select_subj_lejos != "") ||
															($json->od_esf_subj_lejos.$json->od_cil_subj_lejos.$json->od_eje_subj_lejos != "") ||
															($json->os_esf_subj_lejos.$json->os_cil_subj_lejos.$json->os_eje_subj_lejos != "")
														) {
											?>
												<div class = "hc_subtitulo">
													Lejos:
												</div>
												<div class = "hc_contenido">
													<table>
														<tr>
															<td>OD:</td>
															<td style = "border-right:1px solid;width:30px">
																<?php
																	if ($json->od_select_subj_lejos != "")
																		echo $json->od_select_subj_lejos;
																	else
																		echo "-";
																?>
															</td>
															<td>
																<?php
																	echo check($json->od_esf_subj_lejos,$json->od_cil_subj_lejos,$json->od_eje_subj_lejos);
																?>
															</td>
														</tr>
														<tr>
															<td>OS:</td>
															<td style = "border-right:1px solid;width:30px">
																<?php
																	if ($json->os_select_subj_lejos != "")
																		echo $json->os_select_subj_lejos;
																	else
																		echo "-";
																?>
															</td>
															<td>
																<?php
																	echo check($json->os_esf_subj_lejos,$json->os_cil_subj_lejos,$json->os_eje_subj_lejos);
																?>
															</td>
														</tr>
													</table>
												</div>
											<?php } ?>
											</div>

											<div class = "hc_col_der">
												<?php 	if 	( 	($json->od_select_subj_cerca.$json->os_select_subj_cerca != "") ||
															($json->od_esf_subj_cerca.$json->od_cil_subj_cerca.$json->od_eje_subj_cerca != "") ||
															($json->os_esf_subj_cerca.$json->os_cil_subj_cerca.$json->os_eje_subj_cerca != "")
														) {
												?>
												<div class = "hc_subtitulo">
													Cerca:
												</div>
												<div class = "hc_contenido">
													<table>
														<tr>
															<td>OD:</td>
															<td style = "border-right:1px solid;width:30px">
																<?php
																	if ($json->od_select_subj_cerca != "")
																		echo $json->od_select_subj_cerca;
																	else
																		echo "-";
																?>
															</td>
															<td>
																<?php
																	echo check($json->od_esf_subj_cerca,$json->od_cil_subj_cerca,$json->od_eje_subj_cerca);
																?>
															</td>
														</tr>
														<tr>
															<td>OS:</td>
															<td style = "border-right:1px solid;width:30px">
																<?php
																	if ($json->os_select_subj_cerca != "")
																		echo $json->os_select_subj_cerca;
																	else
																		echo "-";
																?>
															</td>
															<td>
																<?php
																	echo check($json->os_esf_subj_cerca,$json->os_cil_subj_cerca,$json->os_eje_subj_cerca);
																?>
															</td>
														</tr>
													</table>
												</div>
											<?php } ?>
											</div>

											<div class = "hc_col_izq" style = "margin-top:5px">
												<?php 	if 	( 	($json->od_select_subj_media.$json->os_select_subj_media != "") ||
															($json->od_esf_subj_media.$json->od_cil_subj_media.$json->od_eje_subj_media != "") ||
															($json->os_esf_subj_media.$json->os_cil_subj_media.$json->os_eje_subj_media != "")
														) {
												?>
												<div class = "hc_subtitulo">
													Media:
												</div>
												<div class = "hc_contenido">
													<table>
														<tr>
															<td>OD:</td>
															<td style = "border-right:1px solid;width:30px">
																<?php
																	if ($json->od_select_subj_media != "")
																		echo $json->od_select_subj_media;
																	else
																		echo "-";
																?>
															</td>
															<td>
																<?php
																	echo check($json->od_esf_subj_media,$json->od_cil_subj_media,$json->od_eje_subj_media);
																?>
															</td>
														</tr>
														<tr>
															<td>OS:</td>
															<td style = "border-right:1px solid;width:30px">
																<?php
																	if ($json->os_select_subj_media != "")
																		echo $json->os_select_subj_media;
																	else
																		echo "-";
																?>
															</td>
															<td>
																<?php
																	echo check($json->os_esf_subj_media,$json->os_cil_subj_media,$json->os_eje_subj_media);
																?>
															</td>
														</tr>
													</table>
												</div>
											<?php } ?>
											</div>

											<div class = "hc_col_der" style = "margin-top:5px">
											<?php
												if ($json->obs_subj != "") {
											?>
												<div class = "hc_subtitulo">
													Observaciones:
												</div>
												<div class = "hc_contenido" style ="margin-top:15px;width:218px;border:none">
													<?php echo $json->obs_subj?>
												</div>
											<?php } ?>
											</div>

										</div>
										<?php }?>

										<?php if ($json->od_presion.$json->os_presion != "") { ?>
										<div class = "hc_fila">
											<div class = "hc_titulo" style = "width:170px">PRESIÓN INTRAOCULAR:</div>
											<?php if ($json->od_presion != "") { ?>
											<div class = "hc_col_izq" style = "width: 200px;margin-left:0px">

												<div class = "hc_subtitulo" style = "margin-top:0px;width:20px">
													OD:
												</div>
												<div class = "hc_contenido" style ="border:none;">
													<?php echo $json->od_presion?>
												</div>
											</div>
											<?php }?>
											<?php if ($json->os_presion != "") { ?>
											<div class = "hc_col_izq" style = "width: 600px;margin-left:190px;margin-top:5px">
												<div class = "hc_subtitulo" style = "margin-top:0px;width:20px">
													OS:
												</div>
												<div class = "hc_contenido" style ="border:none;">
													<?php echo $json->os_presion?>
												</div>
											</div>
											<?php }?>
											<?php if ($json->obs_presion != "") { ?>
											<div class = "hc_col_izq" style = "width: 600px;margin-left:190px;margin-top:5px">
												<div class = "hc_subtitulo" style ="margin-top:0px;width:89px">
													Observaciones:
												</div>
												<div class = "hc_contenido" style ="border:none;width:450px">
													<?php echo $json->obs_presion?>
												</div>
											</div>
											<?php }?>
										</div>
										<?php }?>

										<?php if ($json->od_bio.$json->os_bio != "") { ?>
										<div class = "hc_fila">
											<div class = "hc_titulo" style = "width:170px">BIOMICROSCOPÍA:</div>
											<?php if ($json->od_bio != "") { ?>
											<div class = "hc_col_izq" style = "width: 600px;margin-left:0px">
												<div class = "hc_subtitulo" style = "margin-top:0px;width:20px">
													OD:
												</div>
												<div class = "hc_contenido" style ="border:none;width:520px">
													<?php echo $json->od_bio?>
												</div>
											</div>
											<?php }?>
											<?php if ($json->os_bio != "") { ?>
											<div class = "hc_col_izq" style = "width: 600px;margin-left:190px;margin-top:5px">
												<div class = "hc_subtitulo" style = "margin-top:0px;width:20px">
													OS:
												</div>
												<div class = "hc_contenido" style ="border:none;width:520px">
													<?php echo $json->os_bio?>
												</div>
											</div>
											<?php }?>
										</div>
										<?php }?>

										<?php if ($json->od_fo.$json->os_fo != "") { ?>
										<div class = "hc_fila">
											<div class = "hc_titulo" style = "width:170px">FONDO DE OJOS:</div>
											<?php if ($json->od_fo != "") { ?>
											<div class = "hc_col_izq" style = "width: 600px;margin-left:0px">
												<div class = "hc_subtitulo" style = "margin-top:0px;width:20px">
													OD:
												</div>
												<div class = "hc_contenido" style ="border:none;width:520px">
													<?php echo $json->od_fo?>
												</div>
											</div>
											<?php }?>
											<?php if ($json->os_fo != "") { ?>
											<div class = "hc_col_izq" style = "width: 600px;margin-left:190px;margin-top:5px">
												<div class = "hc_subtitulo" style = "margin-top:0px;width:20px">
													OS:
												</div>
												<div class = "hc_contenido" style ="border:none;width:520px">
													<?php echo $json->os_fo?>
												</div>
											</div>
											<?php }?>
										</div>
										<?php }?>

										<?php if ( $json->txt_diag != "" ){ ?>
										<div class = "hc_fila">
											<div class = "hc_titulo" style = "width:170px">DIAGNÓSTICO:</div>
											<div class = "hc_contenido" style = "border:none;margin-top:2px;width:550px">
												<?php echo $json->txt_diag; ?>
											</div>
										</div>
										<?php }?>

										<?php if (isset($json->chk_sol)) { ?>
										<div class = "hc_fila">
											<div class = "hc_titulo" style ="width: 170px">ESTUDIOS/ANÁLISIS:</div>
											<div class ="hc_contenido" style = "width: 550px;border:none;margin-top:2px">
												<?php
													$cadena = "";
													foreach ($json->chk_sol as $value) {
															$cadena = $cadena.$value.", ";
													}
															$cadena = $cadena.$json->obs_sol;
															echo trim($cadena, ", ");

												?>
											</div>
										</div>
										<?php }?>

										<?php if ($json->txt_indic != "") { ?>
										<div class = "hc_fila">
											<div class = "hc_titulo" style = "width: 170px">INDICACIONES:</div>
											<div class ="hc_contenido" style = "width: 550px;border:none;margin-top:2px">
												<?php echo $json->txt_indic?>
											</div>
										</div>
										<?php }?>

										<?php if ($json->txt_obs != "") { ?>
										<div class = "hc_fila">
											<div class = "hc_titulo" style = "width: 170px">OBSERVACIONES</div>
											<div class ="hc_contenido" style = "width: 550px;border:none;margin-top:2px">
												<?php echo $json->txt_obs?>
											</div>
										</div>
										<?php }?>
									</div>
								</div>
							<?php
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
							echo '<a target = "_blank" href="'.base_url("/data/".$value->ruta).'">'.$value->imagen.'</a>';
							echo '<a target = "_blank" style="float:right;cursor:pointer" onclick = "return borrar(\''.$value->id.'\', \''.$datos_paciente[0]->id.'\');">';
								echo '<img src = "'.base_url('css/images/delete_icon&16.png').'"/>';
							echo '</a>';
							echo '</br>';
	    				//	echo '<a rel="'.$value->ruta.'" href="'.$value->ruta.'"><img src="'.$value->imagen.'"/></a>';
						//echo '<a class="fancybox-thumbs" data-fancybox-group="thumb" href="'.$value->ruta.'"><img src="'.$value->imagen.'"/></a>';
						//<a href="URL de la imagen" rel="shadowbox[galeria1]" title="Imagen">Imagen 1</a>
						//echo '<a href ="'.$value->ruta.'" rel = "shadowbox[galeria1]">'.$value->imagen.'</a>';

					}
					echo '</div>';
				}
			?>

			<!--<button class="my_modal_open cargar">Cargar Archivos</button>-->
			<!--<button id="sample-jspanel-1" type="button">Execute example above</button>-->
			<a id = "cargar_archivos" href = "#">Cargar Archivos</a>
		</div>

		<div id="cargar_ventana" title="Seleccionar Archivos" style = "display:none">
			<form id = "cargar_form" action="<?php echo base_url('index.php/main/do_upload')?>" method="post" enctype="multipart/form-data">
				<input class = "texto_oswald browse" type="file" multiple id = "seleccionar_archivo" name="userfile[]" size="20" style = "font-size:14px"/>
				<input type="hidden" name="paciente" value = <?php echo $paciente_id ?> />
				<div style = "float:left;margin-top:10px;font-size:14px">
				Tipo archivo:
					<select class = "select" id = "tipo" name = "tipo" required style="font-size:14px;font-family:'Segoe'">
						<option value="">Seleccionar</option>
		  				<option value="OCT">OCT</option>
		  				<option value="RFG">RFG</option>
		  				<option value="ME">ME</option>
		  				<option value="IOL">IOL</option>
		  				<option value="CVC">CVC</option>
		  				<option value="TOPO">TOPO</option>
		  				<option value="HRT">HRT</option>
		  				<option value="PAQUI">PAQUI</option>
						<option value="ARM">ARM</option>
						<option value="EXO">EXO</option>
						<option value="Tonom">Tonom</option>
		  				<option value="HC">HC</option>
		  				<option value="IMAGEN">IMAGEN</option>
		  				<option value="INFORME">INFORME</option>
		  				<option value="PROTOCOLO">PROTOCOLO</option>
					</select>
				</div>
				<div style = "float:left;margin-top:10px;font-size:14px">
					Fecha archivo:
					<input class = "texto_oswald browse" type="date" name="fecha" size="20" />
				</div>
				<div id = "error_subida" style = "color:red;float:left;width:100%"></div>
			</form>
		</div>
	</body>
</html>
