<?php
	include "database_config.php";

	$id = $_POST['id'];

	//echo $id;
	//$datos = explode(",", $cadena);

	$link = mysqli_connect ($host, $user, $password, $db) or die ("<center>No se puede conectar con la base de datos\n</center>\n");


	$query_turno = sprintf("SELECT * FROM turnos WHERE id = '%d' ", $id);

	$query_facturacion = sprintf("SELECT * FROM facturacion WHERE id_turno = '%d' ", $id);

	/*
	if ($estado == "1")
		$query = sprintf("UPDATE turnos SET estado = 'presente' WHERE id = '%d' ", $id);
	else
		$query = sprintf("UPDATE turnos SET estado = '' WHERE id = '%d' ", $id);
	*/
	// Perform Query

	mysqli_set_charset("UTF8");

	$result_turno = mysqli_query($query_turno, $link)

	$result_facturacion = mysqli_query($query_facturacion, $link)

	if (mysqli_num_rows($result_facturacion) > 0) {
		$array['facturar'] = "SI";
		$result = mysqli_fetch_array($result_facturacion, MYSQLI_ASSOC));
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
		$array = mysqli_fetch_array ($result_turno, MYSQLI_ASSOC);
		$array['facturar'] = "NO";
	}

	echo json_encode($array);

	#Mostramos los resultados obtenidos

?>
