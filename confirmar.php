<?php
	
	
	$id = $_POST['id'];
	//echo $id;
	//$datos = explode(",", $cadena);

	$conexion = mysql_connect("localhost","root","power")
	or die ("Fallo en el establecimiento de la conexión");

	#Seleccionamos la base de datos a utilizar
	mysql_select_db("cco")
	or die("Error en la selección de la base de datos");

	$query = sprintf("SELECT * FROM turnos WHERE id = '%d' ", $id);

	/*
	if ($estado == "1")
		$query = sprintf("UPDATE turnos SET estado = 'presente' WHERE id = '%d' ", $id);
	else
		$query = sprintf("UPDATE turnos SET estado = '' WHERE id = '%d' ", $id);
	*/	
	// Perform Query
	
	$result = mysql_query($query)
	or die("Error en la consulta SQL");

	echo json_encode(mysql_fetch_array ($result));

	#Mostramos los resultados obtenidos

?>