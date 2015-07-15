<?php
	
	
	$id = $_POST['id'];
	$estado = $_POST['estado'];
	
	//$datos = explode(",", $cadena);

	$conexion = mysql_connect("localhost","root","power")
	or die ("Fallo en el establecimiento de la conexión");

	#Seleccionamos la base de datos a utilizar
	mysql_select_db("cco")
	or die("Error en la selección de la base de datos");

	$query = sprintf("UPDATE turnos SET estado = '%s', ya_facturado = '1' WHERE id = '%d' ", $estado, $id);

	/*
	if ($estado == "1")
		$query = sprintf("UPDATE turnos SET estado = 'presente' WHERE id = '%d' ", $id);
	else
		$query = sprintf("UPDATE turnos SET estado = '' WHERE id = '%d' ", $id);
	*/	
	// Perform Query
	$result = mysql_query($query)
	or die("Error en la consulta SQL");

	#Mostramos los resultados obtenidos

?>