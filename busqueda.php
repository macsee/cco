<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/template.css" rel="stylesheet" type="text/css"/>
	<link href="css/styles.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
	<link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<style>
		.fila_mensaje {float: left; width: 100%; height: 30px; margin-bottom: 4px; padding-top: 10px; background-color: #F7F7F7; border: 1px solid #EEE;}
		.fila_nombre {float: left; margin-left: 20px }
		.fila_ficha {float: right; margin-right: 20px;}
		.fila {float:left; width:100%; height: 35px}
		.lbl_mensaje {float: left; margin-left: 10px; margin-right: 10px; width: 150px; font-size: 14px;}
		.datos_mensaje {float: left; font-size: 14px}
		.fila_corta {width: 40%;}
		#buscar_paciente {margin-top: 30px}
		#buscar_paciente a{text-decoration: none}
		#result {margin-left: -4px}

		.clickeable {height: 30px; float:left; width: 95%;}
		.oculto {display:none; background-color: #F7F7F7; border: 1px solid #EEE; height: 400px; margin-top: 2px; width: 600px; margin-top: -3px; float:left; padding-top: 10px; margin-bottom: 5px;}
	</style>
	<script>
		$(document).ready(function()
		{
		
			$(".clickeable").click(function()
			{ 
				var id = $(this).attr("id");
				if ($("#oculto_"+id).is(":hidden")) {
					$('[id^="oculto_"]').slideUp("slow"); 
					$("#oculto_"+id).slideDown("slow");
					
					//$("#detalles_*").;
				} 
				else {
					$("#oculto_"+id).slideUp("slow");
				}		
			});

		});
	</script>
</head>

<body>	
<?php
	
	$apellido = $_POST['posteo'];

	$link = mysqli_connect ("localhost", "root", "power", "cco") 
	or die ("<center>No se puede conectar con la base de datos\n</center>\n");

	//$conexion = mysql_connect("localhost","root","power")
	//or die ("Fallo en el establecimiento de la conexión");

	#Seleccionamos la base de datos a utilizar
	//mysql_select_db("cco")
	//or die("Error en la selección de la base de datos");

	$query = sprintf("SELECT * FROM pacientes WHERE apellido LIKE '%s' ", "%".$apellido."%");
	//$query = "SELECT * FROM pacientes WHERE apellido LIKE 'Bessone'";

	$result = mysqli_query ($link, $query)
	or die("Error en la consulta SQL");
	// Perform Query
	//$result = mysql_query($query)
	//or die("Error en la consulta SQL");

	#Mostramos los resultados obtenidos
	?>

	<?php $base_url = "http://".$_SERVER['HTTP_HOST']."/cco/"; ?>

	<div id = "busqueda_pacientes">
			<div style = "float:left; color:white; font-family:Oswald; margin-left: 10px; margin-top: 5px;">
			<?php
				echo '<a href="'.$base_url.'index.php/main/pacientes/">'; 
					echo '<img src = "'.$base_url.'css/images/arrow_left_16x16.png"/>';
				echo '</a>';
			?>
				Volver
			</div>

			<div style = "float:left; margin-left:82%; margin-top:5px">
				<?php
				echo '<a href="'.$base_url.'index.php">'; 
					echo '<img src = "'.$base_url.'css/images/home_24x24.png"/>'; 
				echo '</a>';
				?>
			</div>

			<div style = "float:left; margin-left:2%; margin-top:8px">
				<?php
				echo '<a href="'.$base_url.'index.php/main/cambiar_dia/'.date("Y-m-d").'">';
					echo '<img src = "'.$base_url.'css/images/book_alt2_24x21.png"/>'; 
				echo '</a>';
				?>
			</div>
	</div>

	<div id="buscar_paciente">
		<div id="result">
			<div id="result_buscar">	
	<?php
				if ($result->num_rows == 0) {
					echo  "<i>No se econtraron pacientes</i>";
				}
				else {

				while( $key = mysqli_fetch_array ( $result, MYSQL_ASSOC)) {
						echo '<div class = "fila_mensaje">';
							echo '<div class = "clickeable" id = "'.$key['id'].'" style="cursor: pointer;">';
								echo '<div class = "fila_nombre">';	
									echo utf8_encode(stripslashes($key['apellido'].', '.$key['nombre']));
								echo '</div>';
								echo '<div class = "fila_ficha">';	
									echo $key['nroficha'];
								echo '</div>';
							echo '</div>';
							echo '<div style = "float: left; cursor: pointer">';	
									echo '<a href = "'.$base_url.'index.php/main/editar_paciente/'.$key['id'].'">';
										echo '<img src = "'.$base_url.'css/images/pen_alt_fill_16x16.png"/>';  
									echo '</a>';	
								echo '</div>';			
						echo '</div>';
						echo '<div id = "oculto_'.$key['id'].'" class = "oculto" >';
	?>					
				<div class = "fila">
					<div class = "lbl_mensaje">
						DNI : 
					</div>
				<div class = "datos_mensaje">
						<?php echo $key['dni']; ?> 
				</div>	
				</div>
				<div class = "fila">
					<div class = "lbl_mensaje">
						Fecha de Nacimiento : 
					</div>
					<div class = "datos_mensaje">
						<?php 
						 
						if ( ($key['fecha_nacimiento'] <> '0000-00-00') AND ($key['fecha_nacimiento'] <> NULL) ) {
							echo date('d-m-Y',strtotime($key['fecha_nacimiento']));
						}
						?> 
					</div>	
				</div>
				<div class = "fila">
					<div class = "lbl_mensaje">
						Domicilio : 
					</div>
					<div class = "datos_mensaje">
						<?php echo utf8_encode(stripslashes($key['direccion'])); ?> 
					</div>	
				</div>
				<div class = "fila">
					<div class = "lbl_mensaje">
						Localidad : 
					</div>
					<div class = "datos_mensaje">
						<?php echo utf8_encode(stripslashes($key['localidad'])); ?> 
					</div>	
				</div>
				<div class = "fila">
					<div class = "lbl_mensaje">
						Teléfono : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key['tel1']; ?> 
					</div>	
				</div>								
				<div class = "fila">
					<div class = "lbl_mensaje">
						Teléfono 2 : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key['tel2']; ?> 
					</div>	
				</div>
				<div class = "fila">
					<div class = "lbl_mensaje">
						Obra Social : 
					</div>
					<div class = "datos_mensaje">
						<?php echo utf8_encode(stripslashes($key['obra_social'])); ?> 
					</div>	
				</div>
				<div class = "fila">
					<div class = "lbl_mensaje">
						Nro de Afiliado : 
					</div>
					<div class = "datos_mensaje">
						<?php echo $key['nro_obra']; ?> 
					</div>	
				</div>
				<div class = "fila">
					<div class = "lbl_mensaje">
						Paciente Desde : 
					</div>
					<div class = "datos_mensaje">
						<?php 
						
						if ( ($key['fecha_ingreso'] <> '0000-00-00') AND ($key['fecha_ingreso'] <> NULL) ) {
							echo date('d-m-Y',strtotime($key['fecha_ingreso']));
						}

						?> 
					</div>	
				</div>
				<div class = "fila_obs">
					<div class = "lbl_mensaje">
						Observaciones : 
					</div>
					<div class = "datos_mensaje">
						<?php echo utf8_encode(stripslashes($key['observaciones'])); ?> 
					</div>	
				</div>
	<?php	echo '</div>';	
				}
			 }				
	?>	
						
		</div>

		<iframe id = "iframe"></iframe>

	</div>
</div>

</body>
</html>