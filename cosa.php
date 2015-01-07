<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style>
		.fila_mensaje {float: left; width: 100%; height: 30px; margin-bottom: 4px; padding-top: 10px; background-color: #F7F7F7; border: 1px solid #EEE;}
		.fila_nombre {float: left; margin-left: 20px }
		.fila_ficha {float: right; margin-right: 20px;}
		.fila {float:left; width:100%; height: 35px}
		.lbl_mensaje {float: left; margin-left: 10px; margin-right: 10px; width: 150px; font-size: 14px;}
		.datos_mensaje {float: left; font-size: 14px}
		.fila_corta {width: 40%;}
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
	//echo $data;


	$conexion = mysql_connect("localhost","root","power")
	or die ("Fallo en el establecimiento de la conexión");

	#Seleccionamos la base de datos a utilizar
	mysql_select_db("cco")
	or die("Error en la selección de la base de datos");

	$query = sprintf("SELECT * FROM pacientes WHERE apellido LIKE '%s' ", "%".$apellido."%");

	// Perform Query
	$result = mysql_query($query)
	or die("Error en la consulta SQL");

	#Mostramos los resultados obtenidos

	?>
		<div id="result">
			<div id="result_buscar">	
	<?php
	$base_url = "http://".$_SERVER['HTTP_HOST']."/cco/";
			
				while( $key = mysql_fetch_array ( $result )) {
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
	?>	
						
		</div>

		<iframe id = "iframe"></iframe>

	</div>

</body>
</html>