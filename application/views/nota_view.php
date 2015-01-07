<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Nueva Nota</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<style>

		.contact_form textarea {width: 500px;}
		
	</style>
</head>
<body>
	<div class = "titulo">	
		<div id = "nuevo_turno">
			Notas del día
		</div>	
		<div id= "fecha1">
			<?php 
				echo $dia." ".$nombre_dia.", ".$mes." ".$ano;
			?>
		</div>
     <!-- <span class="required_notification">* Campos obligatorios</span> -->
	</div>	
	<form class="contact_form" action="<?php echo base_url('index.php/main/pro_add_notas#'.$fecha)?>" method="post" name="contact_form" onsubmit = "return validar(this)">
	
	<div id = "ul5">
		<ul>
			<li>
				<textarea name="notas" cols="40" rows="6" required></textarea>		
				<input type="hidden" name="fecha" value="<?php echo $fecha ?>">
			</li>
		</ul>
	</div>
	<div id = "ul6">			
			<button class="submit" type="submit">Guardar</button>
			<button class="cancel" type = "button" onclick = "location.href= '<?php echo base_url("/index.php/main/cambiar_dia/$fecha")?>';">Cancelar</button>
	</div>
	</form>
</body>
</html>
