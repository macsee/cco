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
	</style>
	<script type="text/javascript">

		function borrar(url,data) {
	        $( "#borrar_paciente" ).dialog({
				autoOpen: true,
	            resizable: false,
				width: 300,
	            height: 80,
	            modal: true,
	            buttons: {
	                "Si": function() {
						var x = url+"/borrar_paciente/"+data;
						location.href = x;
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
							echo '<a onclick = "return borrar(\''.base_url("/index.php/main/").'\', \''.$key->id.'\');">'; 
								echo '<img src = "'.base_url('css/images/xw_14x14.png').'"/>';  
							echo '</a>';
						echo '</div>';
						echo '<div style = "float: left; cursor: pointer">';

							echo '<a onclick = "parent.location.href=\''.base_url("/index.php/main/editar_paciente/").'/'.$key->id.'\';">';
								echo '<img src = "'.base_url('css/images/pen_alt_fill_16x16_w.png').'"/>';  
							echo '</a>';

						echo '</div>';

						echo '<div style = "float: left; margin-left: 15px; cursor: pointer">';

							echo '<a onclick = "parent.location.href=\''.base_url("/index.php/main/historia_clinica/").'/'.$key->id.'\';">';
							//echo '<a onclick = "parent.location.href="'.base_url('index.php/main/nuevo_turno/').'">';
								echo '<img src = "'.base_url('css/images/info_8x16.png').'"/>';  
							echo '</a>';

						echo '</div>';	
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