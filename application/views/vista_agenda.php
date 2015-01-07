<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Agendas</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>

	<style type="text/css">
		#pacientes {width: 800px; margin-bottom: 50px; float: left; font-size: 14px}
		.paciente_fila_impar {float: left; width: 100%; height: 30px;}
		.paciente_fila_par {float: left; width: 100%; height: 30px; background-color: #eaeaea;}
		.paciente_nombre, .paciente_ficha, .paciente_tipo {float: left; width: 30%;}
		.paciente_nombre {width: 35%; margin-right: 25px; margin-left: 10px; padding-top: 5px}
		.paciente_tipo {font-size: 12px; margin-right: 50px; width: 25%}
		.paciente_ficha {text-align: center; width: 10%; margin-right: 25px; padding-top: 5px}
		#info_pacientes {float:left; margin-left: 25px; width: 400px;}
		.paciente_cant {float: left; width: 11%; }
		.paciente_estado {float: left; margin-right: 2px}
		#busqueda_pacientes {width: 800px;}
		#titulo_superior {width: 100%; float: left; background-color: #454545; margin-bottom: 5px; color: white; height: 25px; font-family: Oswald; font-size: 16px;}
		.uno {float: left; width: 41%; margin-left: 10px}
		.dos {float: left; width: 10%}
		.tres {float: left; width: 31%;}
		.cuatro {float: left; width: 10%;}
		#titulo_info {text-align: right;width: 100%; float: left; background-color: #454545; margin-bottom: 5px; color: white; height: 25px; font-family: Oswald; font-size: 16px;}
	</style>
</head>

<body>



	<div id = "pacientes">

	<div id = "titulo_superior">
		<div class = "uno">
			Paciente
		</div>	
		<div class = "dos">
			Ficha
		</div>
		<div class = "tres">
			Turno
		</div>
		<div class = "cuatro">
			Cantidad
		</div>
		<div class = "cinco">
			Estado
		</div>
	</div>	

<?php

	$pacientes = 0;
	if ($resultado == 0) {
		echo "No hay pacientes cargado a esta agenda";
	}
	else {
		
		foreach ($resultado as $res) {

			if ($pacientes % 2) {
				echo '<div class = "paciente_fila_par">';	
			}
			else {
				echo '<div class = "paciente_fila_impar">';	
			}
			
				echo '<div class = "paciente_nombre">';
					echo $res->apellido.', '.$res->nombre;;
				echo '</div>';
				echo '<div class = "paciente_ficha">';
					if ( $res->ficha == -1 ) { echo "-"; }
					else {echo $res->ficha;}
				echo '</div>';
				echo '<div class = "paciente_tipo">';
					echo $res->tipo;
				echo '</div>';
				echo '<div class = "paciente_cant">'; ?>
				<select>
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
				<?php		
				echo '</div>';
				echo '<div class = "paciente_estado">';
					echo '<input type="checkbox" name="listo" value="listo">';
					//echo '<img src = "'.base_url('css/images/check_16x13.png').'"/>';
					//echo $res->estado;
				echo '</div>';
			echo '</div>';
			$pacientes++;	

		}
		
	}
	echo '</div>';
	echo '<div id = "info_pacientes">';
		echo '<div id = "titulo_info">';
			echo "Volver";
		echo '</div>';
		echo "Pacientes para ".$this->uri->segment(6)." : ".$pacientes;
		echo '<br>';
		echo "Cantidad de estudios realizados  : ";
	echo '</div>';
?>	
</body>
</html>
