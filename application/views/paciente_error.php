<!DOCTYPE html>

<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Error</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<style> 
		button.submit {margin-left: 285px }
		#botones p {font-size: 20px; font-family: 'Oswald' }
	</style>
</head>

<body>

<?php

echo '<div id = "mensaje">';

if ($value == 'error paciente') {

	$nombre = ucwords($paciente[0]->nombre);
	$nombre = ucwords(strtolower($nombre));

	$apellido = ucwords($paciente[0]->apellido);
	$apellido = ucwords(strtolower($apellido));

		echo '<div id = "titulo_mensaje">';
			echo "<div class = 'texto1'> El paciente </div> <div class = 'texto'>".$apellido.', '.$nombre. "</div> <div class = 'texto2'> ya se encuentra ingresado con los siguientes nros de ficha :</div>";
		echo '</div>';

		echo '<div id = "datos_mensaje">';

		foreach ($paciente as $key) {

			echo '<div id = "fila_mensaje">';
				echo $key->nroficha;
			echo '</div>';
		}

		echo '</div>';

?>		

		<form class="contact_form" action="<?php echo base_url('index.php/main/pro_ingresar_paciente')?>" method="post" name="contact_form" id="contact_form">

			<input type="hidden" name="nombre" value="<?php echo $nombre?>"/>	
			<input type="hidden" name="apellido" value="<?php echo $apellido?>"/>
			<input type="hidden" name="ficha" value="<?php echo $nroficha?>"/>

			<div id = "botones" style = "width:100%">
				<p style = "text-align: center"> ¿Ingresar de todas formas? </p>
	        		<button class="submit" type="submit">Guardar</button>
					<button class="cancel" type = "button" onclick = "location.href= '<?php echo base_url("/index.php/main/pacientes")?>';">Cancelar</button>
			</div>
		</form>
<?php	
}

else {

	$nroficha = $ficha[0]->nroficha;

	echo '<div id = "titulo_mensaje">';
		echo "<div class = 'texto1'> El nro de ficha </div> <div class = 'texto'>".$nroficha."</div> <div class = 'texto2'> está asociado a los siguientes registros :</div>";
	echo '</div>';

	echo '<div id = "datos_mensaje">';

	foreach ($ficha as $key) {

		$nombre = ucwords($key->nombre);
		$nombre = ucwords(strtolower($nombre));

		$apellido = ucwords($key->apellido);
		$apellido = ucwords(strtolower($apellido));

		echo '<div id = "fila_mensaje">';
			echo $apellido.', '.$nombre;
		echo '</div>';
	}

	echo '</div>';

echo '<div id = "volver" style = "float: left" onclick = "location.href=\''.base_url("/index.php/main/pacientes/").'\';" style="cursor: pointer;">';
	echo '<img src = "'.base_url('css/images/arrow_left_16x16.png').'"/>';
	echo '<div id = "volver_txt">';
		echo "Volver";
	echo '</div>';	
echo '</div>';

}

echo '</div>';
?>

</body>

</html>
