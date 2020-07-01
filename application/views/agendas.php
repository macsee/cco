<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Agendas</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php
	if ($agendas == 0) {
		echo "No hay agendas previas para mostrar";
	}
	else {
		foreach ($agendas as $agenda) {
			$fecha = date('d/m/Y', strtotime($agenda->fecha));
			echo anchor('main/ver_agenda/'.$fecha.'/'.$agenda->tipo, $fecha.' - '.$agenda->tipo);
			echo '<br>';
		}
		
	}

?>
	<form class="contact_form" action="<?php echo base_url('index.php/main/pro_nueva_agenda')?>" method="post" name="contact_form" id="contact_form">
		<input type="date" size = "20" name="fecha" id = "fecha" autocomplete="off" required/>
		<select id = "tipo" name = "tipo">
			<option>  </option>
			<option> HRT </option>
			<option> OCT </option>
			<option> RFG </option>
			<option> IOL </option>
			<option> ME </option>						
		</select>
		<button class="submit" type="submit">Crear Nueva Agenda</button>
	</form>	
</body>
</html>
