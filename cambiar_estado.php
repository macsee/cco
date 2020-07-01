<?php
	
	include "database_config.php";
	
	$id = $_POST['id'];
	$estado = $_POST['estado'];
	
	//$datos = explode(",", $cadena);

	$link = mysqli_connect ($host, $user, $password, $db) or die ("<center>No se puede conectar con la base de datos\n</center>\n");

	$query = sprintf("UPDATE turnos SET estado = '%s' WHERE id = '%d' ", $estado, $id);

	/*
	if ($estado == "1")
		$query = sprintf("UPDATE turnos SET estado = 'presente' WHERE id = '%d' ", $id);
	else
		$query = sprintf("UPDATE turnos SET estado = '' WHERE id = '%d' ", $id);
	*/	
	// Perform Query
	$result = mysqli_query($query, $link)

	$query = sprintf("UPDATE facturacion SET estado = '%s' WHERE id_turno = '%d' ", $estado, $id);

	$result = mysqli_query($query, $link)

	#Mostramos los resultados obtenidos

?>