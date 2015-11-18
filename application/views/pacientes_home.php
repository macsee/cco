<!DOCTYPE html>

<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Pacientes</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<script>
	var base_url = "<?php echo base_url() ?>";
	$(document).ready(function() {

		 $( "#busqueda_texto" ).autocomplete({
			minLength: 1,
      		source: base_url+"search.php",
      //focus: function( event, ui ) {
       // $( "#project" ).val( ui.item.label );
       // return false;

      //},
		    select: function( event, ui ) {

         	var x = base_url+"index.php/main/buscar_paciente/"+(ui.item.value);
          	location.href = x;

	        $( "#busqueda_texto" ).val( ui.item.label );
	        //$( "#project-id" ).val( ui.item.value );
	        //$( "#project-description" ).html( ui.item.ficha );

	        return false;
    	  }
    	})
    	.data( "autocomplete" )._renderItem = function( ul, item ) {
      		return $( "<li>" )
        	.data( "item.autocomplete", item )
        	.append( "<a>" + item.label + "<div style = 'float:right'>" + item.ficha + "</div></a>" )
        	.appendTo( ul );
    	};
  	});
	
	</script>
	<style>

		.form_busqueda button {height: 22px; width: 65px; font-size: 14px}

		.ui-menu .ui-menu-item a { font-size: 12px}


		.ui-autocomplete {

	        max-height: 300px;
	        width: 300px;
	        overflow-y: auto;
	        /* prevent horizontal scrollbar */
	        overflow-x: hidden;
	    }

	    /* IE 6 doesn't support max-height
	     * we use height instead, but this forces the menu to always be this tall
	     */
	    * html .ui-autocomplete {
	        height: 100px;

	        font-size: 12px;
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
	</style>
</head>
<body>
<?php 

	if (!isset($nombre)) {
		$nombre = "";
	}

	if (!isset($apellido)) {
		$apellido = "";
	}

	if (!isset($direccion)) {
		$direccion = "";
	}

	if (!isset($localidad)) {
		$localidad = "";
	}

	if (!isset($dni)) {
		$dni = "";
	}

	if (!isset($fecha_ing)) {
		$fecha_ing = "";
	}

	if (!isset($fecha_nac)) {
		$fecha_nac = "";
	}

	if (!isset($ficha)) {
		$ficha = "";
	}

	if (!isset($obra)) {
		$obra = "";
	}

	if (!isset($nro_obra)) {
		$nro_obra = "";
	}

	if (!isset($tel1_1)) {
		$tel1_1 = "0341";
	}
	
	if (!isset($tel1_2)) {
		$tel1_2 = "";
	}

	if (!isset($tel2_1)) {
		$tel2_1 = "";
	}

	if (!isset($tel2_2)) {
		$tel2_2 = "";
	}

	if (!isset($obs)) {
		$obs= "";
	}
		
?>	
<!--
	<div id = "barra_superior">
		Pacientes - Home - Turnos	
	</div>
-->	
	<div id = "busqueda_pacientes">
			<div style = "float:left; color:white; font-family:Oswald; margin-left: 10px; margin-top: 5px">
				Ingreso de Pacientes
			</div>

			<div style = "float:left; margin-left:57%;">
				<?php
				echo '<a href="'.base_url('index.php').'">'; 
					echo '<img src = "'.base_url('css/images/home_24x24.png').'"/>'; 
				echo '</a>';
				?>
			</div>

			<div style = "float:left; margin-left:5px;">
				<?php
				echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date("Y-m-d")).'">';
					echo '<img src = "'.base_url('css/images/book_alt2_24x21.png').'"/>'; 
				echo '</a>';
				?>
			</div>
				
			<div id = "busqueda">
				<form class="form_busqueda" action="<?php echo base_url('busqueda.php')?>" method="post" name="search_form" id="search_form">

  						<input name="posteo" id = "busqueda_texto" autocomplete="off" placeholder="Busqueda de pacientes..." required/>	
					
				</form>	
			
			</div>
	</div>	
	<div id = "parte_der">
<!--
		<div class = "subtitulo">
			<div style = "width: 40%; float: left;padding-left:10px"> Ingreso de pacientes </div>
		</div>
-->
<?php /*
	if (!isset($id))
		if ($this->session->userdata('grupo') == "Medico")
			echo '<form class="contact_form" action="'.base_url("index.php/main/guardar_ingresar").'" method="post" name="contact_form" id="contact_form">';
		else
			echo '<form class="contact_form" action="'.base_url("index.php/main/pro_nuevo_paciente").'" method="post" name="contact_form" id="contact_form">';
	else
		echo '<form class="contact_form" action="'.base_url('index.php/main/pro_edit_paciente').'" method="post" name="contact_form" id="contact_form">';
	*/
?>		
		<form class="contact_form" method="post" name="contact_form" id="contact_form">
			
		<div id = "ingreso_pacientes_izq">
			
				<ul>
					<li>
						<label for="nombre"><font color = "red">* </font> Nombre:</label>
	            		<input type="text" size = "15" name="nombre" autocomplete="off" style="text-transform:capitalize" value = "<?php echo $nombre ?>" required/>
					</li>
					<li>
						<label for="apellido"><font color = "red">* </font> Apellido:</label>
	            		<input type="text" size = "15" name="apellido" autocomplete="off" style="text-transform:capitalize" value = "<?php echo $apellido ?>" required/>
					</li>
					<li style = "height: 90px">
						<label for="ficha"><font color = "red">* </font> Nro de Ficha:</label>
	            		<input type="text" size = "15" name="ficha" autocomplete="off" style="text-transform:capitalize" value = "<?php echo $ficha ?>" required/>
						<?php if (isset($ultima_ficha)) {

								echo "<p style = 'font-family:Oswald; margin-left: 10px; margin-top:40px; color: #D45252;'> Próxima ficha disponible: ".$ultima_ficha."</p>";

							}
						?>	
					</li>
				</ul>	
		</div>

		<div id = "ingreso_pacientes_cent">
			
				<ul>
					<li>
						<label for="nombre"> DNI:</label>
	            		<input type="text" size = "15" name="dni" value = "<?php echo $dni ?>" autocomplete="off" style="text-transform:capitalize"/>
					</li>
					<li>
						<label for="nombre"><font color = "red">* </font> Fecha de nacimiento:</label>
	            		<input type="date" style = "width:141px" min = "01-01-1900" name="fecha" value = "<?php echo $fecha_nac ?>" autocomplete="off" style="text-transform:capitalize" required/>
					</li>
					<li>
						<label for="apellido"><font color = "red">* </font> Localidad:</label>
	            		<input type="text" size = "15" name="localidad" value = "<?php echo $localidad ?>" autocomplete="off" style="text-transform:capitalize" required/>
					</li>
					<li>
						<label for="ficha"> Dirección:</label>
	            		<input type="text" size = "15" name="direccion" value = "<?php echo $direccion ?>" autocomplete="off" style="text-transform:capitalize"/>
					</li>
				</ul>	
			
		</div>

		<div id = "ingreso_pacientes_der">
			
				<ul>
					<li>	
		            	<label for="tel1_1"><font color = "red">* </font> Teléfono 1:</label>
		            	<input type="text" size="3" maxlength = "5" name="tel1_1" id="tel1_1" value= "<?php echo $tel1_1 ?>" autocomplete="off" onFocus="if (this.value=='0341') this.value='';" pattern="[0-9].{2,}" required/>
				    	<input type="text" size = "8" maxlength = "10" name="tel1_2" id="tel1_2" value = "<?php echo $tel1_2 ?>" autocomplete="off" pattern="[0-9].{5,}" required/>
	        		</li>
					<li>
		            	<label for="tel2_1">Teléfono 2:</label>
		            	<input type="text" size="3" maxlength = "5" name="tel2_1" id ="tel2_1" value= "<?php echo $tel2_1 ?>" autocomplete="off" pattern="[0-9].{2,}"/>
						<input type="text" size = "8" maxlength = "10" name="tel2_2" id ="tel2_2" value= "<?php echo $tel2_2 ?>" autocomplete="off" pattern="[0-9].{5,}"/>
					</li>	
					<li>
						<label for="obra"><font color = "red">* </font> Obra social:</label>
							<select id ="obra" name = "obra" required>
								<option value = ""></option>';
							<?php
								foreach ($obras as $value) {
									if (!strcasecmp($obra,$value->obra))
										echo '<option value ="'.$value->obra.'" selected>'.$value->obra.'</option>';
									else
										echo '<option value ="'.$value->obra.'">'.$value->obra.'</option>';
								}
							?>
							</select>	


						<!--
						<div class="ui-widget">
							<input type="text" size = "18" id="obra" name ="obra" value = "<?php echo $obra ?>" = autocomplete="off">
						</div>-->
					</li>
					<li>
						<label for="apellido"> Nro de afiliado:</label>
	            		<input type="text" size = "15" name="nro_afiliado" value = "<?php echo $nro_obra ?>" autocomplete="off" style="text-transform:capitalize"/>
	            		
					</li>
				</ul>	
		</div>

		<div id = "observaciones">
	            	<label for="obs">Observaciones:</label>
	            	<textarea name="obs" cols="40" rows="6"><?php echo $obs ?></textarea>
		</div>
			
		<?php

			if (!isset($id_turno)) {
				$id_turno = "";
			}

			if (!isset($fecha)) {
				$fecha = "";
			}

			if (!isset($id_paciente)) {
				$id_paciente = "";
			}

			if (!isset($id)) {
				$id = "";
			}

		?>

		<input type="hidden" name="id_turno" value="<?php echo $id_turno?>"/>
		<input type="hidden" name="fecha_turno" value="<?php echo $fecha?>"/>
		<input type="hidden" name="id_paciente" value="<?php echo $id?>"/>

		<?php
			if ($id == "") { // Si no esta seteado el id es porque voy a crear un un paciente.
				
				echo '<div id = "guardar_paciente">';
					echo '<button class="submit" type="submit" formaction="'.base_url("index.php/main/pro_nuevo_paciente").'">Nuevo Paciente</button>';
				echo '</div>';
		
				if (strpos($this->session->userdata('funciones'), "Medico") !== false ) { 
				
					$med = $this->session->userdata('id_user');

					echo '<div style = "margin-top:-24px;float:left;margin-bottom:50px;border: 1px solid #EEE;background-color: #F7F7F7;width:64.5%;padding-left:20px;height:50px;padding-top:10px">';
						
						echo '<label for="medico" style = "width:180px;float:left">Ingresar nuevo paciente para :</label>';
						echo '<select id = "sel_medico" name = "sel_medico" style = "float:left;margin-top:8px;margin-right:50px">';
							foreach ($medicos as $medico) {
								if ($med == $medico->id_medico)
									echo '<option value ="'.$medico->id_medico.'" selected>Dr.'.$medico->nombre.'</option>';
								else
									echo '<option value ="'.$medico->id_medico.'">Dr.'.$medico->nombre.'</option>';
									/*
									if ($medico->nombre == "Otro")
										echo '<option value ="'.$medico->nombre.'" selected>'.$medico->nombre.'</option>';
									else
										echo '<option value ="'.$medico->nombre.'" selected>Dr. '.$medico->nombre.'</option>';
								else
									if ($medico->nombre == "Otro")
										echo '<option value ="'.$medico->nombre.'">'.$medico->nombre.'</option>';
									else
										echo '<option value ="'.$medico->nombre.'">Dr. '.$medico->nombre.'</option>';
									*/	
							}
						echo '</select>';
						echo '<label for="localidad" style = "width:95px">Lugar de atención:</label>';
						echo '<select id = "sel_atendido" name = "sel_atendido" style="margin-left:20px;float:left;margin-top:8px">';

						foreach ($localidades as $loc) {
							if ($loc->id_localidad == "alcorta")
								echo '<option value = "'.$loc->id_localidad.'" selected>'.$loc->nombre.'</option>';
							else
								echo '<option value = "'.$loc->id_localidad.'">'.$loc->nombre.'</option>';
						}	

						echo '</select>';
						echo '<button class="submit_ingresar" type="submit" formaction="'.base_url("index.php/main/nuevo_paciente_sinturno").'" style = "margin-left:50px">Ingresar</button>';

					echo '</div>';	

				}

				if ($fecha != "") { 

					echo '<div id = "guardar_paciente">';
						echo '<button class="cancel" type = "button" onclick = "location.href= \''.base_url("/index.php/main/cambiar_dia/$fecha").'\'">Cancelar</button>';
					echo '</div>';
				}	
			}
			else {		
				echo '<div id = "guardar_paciente">';
					echo '<button class="submit" type="submit" formaction="'.base_url("index.php/main/pro_edit_paciente").'">Actualizar Paciente</button>';
				echo '</div>';

				echo '<div id = "guardar_paciente">';
					echo '<button class="cancel" type = "button" onclick = "location.href= \''.str_replace('_id', '', $_SERVER['HTTP_REFERER']).'\'">Cancelar</button>';
				echo '</div>';
			}	
		?>				

	</form>	
	</div>
	<span class="required_notification" style = "margin-top: 0px;float: left">* Campos obligatorios</span>
	<div id = "msg_repetido">
		<?php
			
			if ($id != "") {

				if (count($repetidos) > 1) {
		?>					
					<p style="color:#d45252">Este numero de ficha está repetido</p>
		<?php			
				}
				else {
		?>			
					<p style="color:#52d452;font">Este numero de ficha no esta repetido</p>
		<?php			
				}
			}		
		?>
	</div>			
</body>
</html>	

