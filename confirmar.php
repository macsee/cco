<?php


	$id = $_POST['id'];

	//echo $id;
	//$datos = explode(",", $cadena);

	$conexion = mysql_connect("localhost","root","power")
	or die ("Fallo en el establecimiento de la conexión");

	#Seleccionamos la base de datos a utilizar
	mysql_select_db("cco")
	or die("Error en la selección de la base de datos");

	$query_turno = sprintf("SELECT * FROM turnos WHERE id = '%d' ", $id);

	$query_facturacion = sprintf("SELECT * FROM facturacion WHERE id_turno = '%d' ", $id);

	/*
	if ($estado == "1")
		$query = sprintf("UPDATE turnos SET estado = 'presente' WHERE id = '%d' ", $id);
	else
		$query = sprintf("UPDATE turnos SET estado = '' WHERE id = '%d' ", $id);
	*/
	// Perform Query

	mysql_set_charset("UTF8");

	$result_turno = mysql_query($query_turno)
	or die("Error en la consulta SQL");

	$result_facturacion = mysql_query($query_facturacion)
	or die("Error en la consulta SQL");

	if (mysql_num_rows($result_facturacion) > 0) {
		$array['facturar'] = "SI";
		$result = mysql_fetch_array ($result_facturacion);
		$paciente = explode(",",$result['paciente']);
		$array['apellido'] = $paciente[0];
		$array['nombre'] = $paciente[1];
		$array['tipo'] = $result['datos'];
		$array['orden'] = $result['ordenes_pendientes'];
		$array['medico'] = $result['medico'];
		$array['ficha'] = $result['ficha'];
		$array['fecha'] = date('Y-m-d', strtotime($result['fecha']));
		$array['estado'] = $result['estado'];
		$array['fact_localidad'] = $result['facturacion_localidad'];
		$array['at_localidad'] = $result['atendido_localidad'];
		$array['obra_social'] = $result['obra_turno'];
	}
	else {
		$array = mysql_fetch_array ($result_turno);
		$array['facturar'] = "NO";
	}

	echo json_encode($array);

	#Mostramos los resultados obtenidos

?>
