<?php

include "database_config.php";

$link = mysqli_connect ($host, $user, $password, $db) or die ("<center>No se puede conectar con la base de datos\n</center>\n");
//mysql_select_db("CCO") or die("Error en la selección de la base de datos");

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends


if (ctype_alpha($term)) { 
    $query = "SELECT id, nombre, apellido, nroficha, obra_social, tel1, tel2 FROM pacientes WHERE apellido LIKE '".$term."%' ORDER BY id DESC LIMIT 10"; 
} 
else { 
    $query = "SELECT id, nombre, apellido, nroficha, obra_social, tel1, tel2 FROM pacientes WHERE nroficha LIKE '".$term."%' ORDER BY id DESC LIMIT 10"; 
} 

//$query = "SELECT id, nombre, apellido, nroficha FROM pacientes WHERE apellido ORDER BY id DESC LIMIT 10"; 

$result = mysqli_query ($link, $query);

while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))//loop through the retrieved values
{
	$row['label']= utf8_encode(stripslashes($row['apellido'])).', '.utf8_encode(stripslashes($row['nombre']));
	$row['value']=utf8_encode(stripslashes($row['id']));
	$row['ficha']=utf8_encode(stripslashes($row['nroficha']));
	$row['nombre']=utf8_encode(stripslashes($row['nombre']));
	$row['apellido']=utf8_encode(stripslashes($row['apellido']));
	$row['obra_social']=utf8_encode(stripslashes($row['obra_social']));
	//print stripos($row['apellido'], $term);	

	//if (stripos($row['apellido'], $term) === 0) {
		
		/*
		$row['domicilio']=utf8_encode(stripslashes($row['domicilio']));
		$row['localidad']=utf8_encode(stripslashes($row['localidad']));
		$row['fecha_nacimiento']=utf8_encode(stripslashes($row['fecha_nacimiento']));
		$row['fecha_ingreso']=utf8_encode(stripslashes($row['fecha_ingreso']));
		$row['tel1']=utf8_encode(stripslashes($row['tel1']));
		$row['tel2']=utf8_encode(stripslashes($row['tel2']));
		$row['obra_social']=utf8_encode(stripslashes($row['obra_social']));
		$row['nro_obra']=utf8_encode(stripslashes($row['nro_obra']));
		$row['obs']=utf8_encode(stripslashes($row['observaciones']));*/
		$row_set[] = $row;//build an array
	//}
}	
echo json_encode($row_set);//format the array into json data

/*
while ($row = mysql_fetch_array($result))//loop through the retrieved values
{
		$row['value']= htmlentities($row['apellido']);
		$row_set[] = $row;//build an array
}

//echo json_encode($row_set);//format the array into json data
$resultados = json_encode($row_set); 
$resultados = str_replace("\/","/",$resultados); 
$resultados = str_replace('"','\\"',$resultados); 
$resultados = json_decode('"'.$resultados.'"'); 
print_r($resultados);
*/
mysqli_close($link);

?>
