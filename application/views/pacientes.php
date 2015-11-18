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
		.fila_mensaje {float: left; width: 600px; height: 35px; margin-bottom: 2px; padding-top: 10px; background-color: #F7F7F7; border: 1px solid #EEE;}
		.fila_mensaje_obs {float: left; width: 600px; height: 80px; padding-top: 10px; background-color: #F7F7F7; border: 1px solid #EEE;}
		.lbl_mensaje {float: left; margin-left: 10px; margin-right: 10px; font-family: Oswald; width: 150px;}
		.datos_mensaje {float: left}
		.fila_corta {width: 40%;}
		.tabla_mensaje {min-height: 500px;}
		.head_mensaje {background-color: #8FAFCD; width: 600px; border: 1px solid #8FAFCD; height: 23px; color: white; text-align: right; font-family: Oswald; padding-top: 2px; margin-bottom: 5px}
		.head_mensaje_izq {margin-left: 20px; float: left;}
		.head_mensaje_der {margin-left: 150px; float: left;}
		.head_botones {margin-right: 20px; float: right;}
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
	</style>
	<script type="text/javascript">

		function borrar(data) {
	        $( "#borrar_paciente" ).dialog({
				autoOpen: true,
	            resizable: false,
				width: 300,
	            height: 80,
	            modal: true,
	            buttons: {
	                "Si": function() {
	                	var url = '<?php echo base_url("/index.php/main/")?>';
						var x = url+"/borrar_paciente/"+data;
						location.href = x;
	                },
					"No": function() {
	                    $( this ).dialog( "close" );
					}
	            }
	        });
	   };

	   function admitir(id) {
	        $( "#admitir_paciente" ).dialog({
				autoOpen: true,
	            resizable: false,
				width: 360,
	            height: 190,
	            modal: true,
	            buttons: {
	                "Si": function() {
	                	var url = '<?php echo base_url("/index.php/main/")?>';
	                	var x = url+"/historia_clinica/"+id;
						$('#form_admitir_'+id).submit();
						parent.location.href = x;
	                },
					"No": function() {
	                    $( this ).dialog( "close" );
					}
	            }
	        });
	   };  

	</script>
</head>
<body>	
<div id="borrar_paciente" title="¿Borrar Paciente?"></div>
<?php

		foreach ($resultado as $key) {

			$nombre = ucwords($key->nombre);
			$nombre = ucwords(strtolower($nombre));

			$apellido = ucwords($key->apellido);
			$apellido = ucwords(strtolower($apellido));

		echo '<div id = "admitir_paciente" title= "Admitir Paciente?" style = "display:none">';
			echo '<form action="'.base_url('index.php/main/paciente_sinturno').'" method="post" name="form" id="form_admitir_'.$key->id.'">';
				echo '<input name = "nombre" value = "'.$nombre.'"  type = "hidden"/>';
				echo '<input name = "apellido" value = "'.$apellido.'"  type = "hidden"/>';
				echo '<input name = "ficha" value = "'.$key->nroficha.'"  type = "hidden"/>';
				echo '<input name = "id_paciente" value = "'.$key->id.'"  type = "hidden"/>';
				echo '<input name = "tel1_1" value = "'.explode('-',$key->tel1)[0].'"  type = "hidden"/>';
				echo '<input name = "tel1_2" value = "'.explode('-',$key->tel1)[1].'"  type = "hidden"/>';
				echo '<input name = "tel2_1" value = ""  type = "hidden"/>';
				echo '<input name = "obra" value = "'.$key->obra_social.'"  type = "hidden"/>';

				$med = $this->session->userdata('id_user');
				echo '<div style = "float:left;width:135px;text-align:left;margin-top:10px">Medico:</div>';
				echo '<select id = "sel_medico" name = "sel_medico" style="margin-left:20px;float:left;margin-right:30px;margin-bottom:20px;margin-top:10px">';
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

				echo '<div style = "float:left;width:135px;text-align:left;margin-top:5px">Lugar de atención:</div>';
				echo '<select id = "sel_atendido" name = "sel_atendido" style="margin-left:20px;float:left;margin-right:30px;margin-top:5px">';
					foreach ($localidades as $loc) {
						if ($loc->id_localidad == "alcorta")
							echo '<option value = "'.$loc->id_localidad.'" selected>'.$loc->nombre.'</option>';
						else
							echo '<option value = "'.$loc->id_localidad.'">'.$loc->nombre.'</option>';
					}	
				echo '</select>';
			echo '</form>';
		echo '</div>';		
		
?>
			<div class = "tabla_mensaje">
				<div class = "head_mensaje">
					<div class = "head_mensaje_izq">
						<?php echo $apellido.', '.$nombre;?>
					</div>	
					<div class = "head_mensaje_der">
						<?php echo 'Nro de Ficha : '.$key->nroficha;?>
					</div>
					<div class = "head_botones">
					<?php
						echo '<div style = "float: left; cursor: pointer; margin-right:15px">';
							echo '<a onclick = "return borrar(\''.$key->id.'\');">'; 
								echo '<img src = "'.base_url('css/images/xw_14x14.png').'" title = "Borrar Paciente"/>'; 
							echo '</a>';
						echo '</div>';
						echo '<div style = "float: left; cursor: pointer">';

							echo '<a onclick = "parent.location.href=\''.base_url("/index.php/main/editar_paciente/").'/'.$key->id.'\';">';
								echo '<img src = "'.base_url('css/images/pen_alt_fill_16x16_w.png').'" title = "Editar Paciente"/>';
							echo '</a>';

						echo '</div>';

						echo '<div style = "float: left; margin-left: 15px; cursor: pointer">';

							echo '<a onclick = "parent.location.href=\''.base_url("/index.php/main/historia_clinica/").'/'.$key->id.'\';">';
							//echo '<a onclick = "parent.location.href="'.base_url('index.php/main/nuevo_turno/').'">';
								echo '<img src = "'.base_url('css/images/info_8x16.png').'" title = "Ver Historia Clínica"/>';  
							echo '</a>';

						echo '</div>';

						if (strpos($this->session->userdata('funciones'), "Medico") !== false ) {
							echo '<div style = "float: left; margin-left: 15px; cursor: pointer">';
									echo '<a onclick = "return admitir(\''.$key->id.'\');">'; 
									echo '<img title = "Admitir Paciente" src = "'.base_url('css/images/admitir.png').'" title = "Admitir Paciente"/>';  
								echo '</a>';
							echo '</div>';
						}						
					?>	
						
					</div>
				</div>	
				
				<div class = "fila_mensaje">
					<div class = "lbl_mensaje">
						DNI : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key->dni; ?> 
					</div>	
				</div>
				<div class = "fila_mensaje">
					<div class = "lbl_mensaje">
						Fecha de Nacimiento : 
					</div>
					<div class = "datos_mensaje">
					<?php

						if ( ($key->fecha_nacimiento <> '0000-00-00') AND ($key->fecha_nacimiento <> NULL) ) {
							echo date('d-m-Y', strtotime($key->fecha_nacimiento)); 
						}

					?> 
					</div>	
				</div>
				<div class = "fila_mensaje">
					<div class = "lbl_mensaje">
						Domicilio : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key->direccion; ?> 
					</div>	
				</div>
				<div class = "fila_mensaje">
					<div class = "lbl_mensaje">
						Localidad : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key->localidad; ?> 
					</div>	
				</div>
				<div class = "fila_mensaje">
					<div class = "lbl_mensaje">
						Teléfono : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key->tel1; ?> 
					</div>	
				</div>								
				<div class = "fila_mensaje">
					<div class = "lbl_mensaje">
						Teléfono 2 : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key->tel2; ?> 
					</div>	
				</div>
				<div class = "fila_mensaje">
					<div class = "lbl_mensaje">
						Obra Social : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key->obra_social; ?> 
					</div>	
				</div>
				<div class = "fila_mensaje">
					<div class = "lbl_mensaje">
						Nro de Afiliado : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key->nro_obra; ?> 
					</div>	
				</div>
				<div class = "fila_mensaje">
					<div class = "lbl_mensaje">
						Paciente Desde : 
					</div>
					<div class = "datos_mensaje">
					<?php	
						if ( ($key->fecha_ingreso <> '0000-00-00') AND ($key->fecha_ingreso <> NULL) ) {
							echo date('d-m-Y', strtotime($key->fecha_ingreso));
						}	 
					?> 
					</div>	
				</div>
				<div class = "fila_mensaje_obs">
					<div class = "lbl_mensaje">
						Observaciones : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key->observaciones; ?> 
					</div>	
				</div>
			</div>
<?php			
		}
?>
</body>
</html>