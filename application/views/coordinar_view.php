<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Coordinación Quirúrgica</title>
		<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
		<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
		<style>

		body {
			font-size: 12pt;
		}

		input {
			border:none;
			font-size: 12pt;
			font-family: 'Segoe';
			width: 330px;
		}

		table {
			border-collapse: separate;
			border-spacing: 2px;
			font-size: 12pt;
		}
		table td {
			//border: 1px solid;
			height:30px;
			padding-left: 5px;
		}
		table th {
			border-right: 1px solid;
			font-family: 'OSWALD';
			font-size: 12pt;
			height: 10px;
			background-color: #454545;
			color: white;
		}

		.izq {
			width: 150px;
			font-family: 'OSWALD';
			font-size: 12pt;
			font-weight: bold;
		}

		.der {
			width: 340px;
		}

		.impar {
			background-color: #F2F1F1;
		}

		.par {
			background-color: #E5E5E5;
		}

		.boton {
			background-color: #1E91A3;
			font-family: 'OSWALD';
			font-size: 12pt;
			text-decoration: none;
			padding-left: 20px;
			padding-right: 20px;
			padding-top: 5px;
			padding-bottom: 5px;
			color:white;
			border-radius: 4px;
		}
		.boton a:visited {
			background-color: none;	
		}

		.boton:hover {
			background-color: #29C9E2;		
		}

		.boton:active {
			background-color: #1E91A3;
		}
		
		</style>
		<script>
			$(document).ready(function() {
				$("#submit").click(function() {
					$("#myform").submit();
				});
			});
		</script>
	</head>
	<body>
		<?php 
			
			if (isset($ok)) {
				echo '<div style = "font-style:italic;text-align:center;font-size:14pt;margin-top:100px">';
					echo 'Paciente enviado correctamente para coordinación quirúrgica.<br><br> Esta ventana se cerrará automáticamente luego de 2 segundos';
					echo '<script type="text/javascript">setTimeout("window.close();", 2000);</script>';
				//echo "<script>window.close();</script>";
				echo '</div>';	
			}	
			else {
				$paciente = $paciente[0];
				echo '<form id = "myform" method = "post" action = "'.base_url('index.php/main/proc_coordinacion').'">';
					echo '<table>';
						echo '<tr>';
							echo '<td class = "izq impar">Ficha:</td>';
							echo '<td class = "der impar">'.$paciente->nroficha.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq par">Paciente:</td>';
							echo '<td class = "par" style = "width:250px">'.$paciente->apellido.', '.$paciente->nombre.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq impar">Obra Social:</td>';
							echo '<td class = "der impar" style = "width:200px">'.$paciente->obra_social.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq par">Nro Afiliado:</td>';
							echo '<td class = "der par" style = "width:150px">'.$paciente->nro_obra.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq impar">Práctica:</td>';
							echo '<td class ="der impar">';
								echo '<select name = "practica">';
									foreach ($tipo_cirugias as $practica)
										echo '<option>'.$practica->nombre.'</option>';
								echo '</select>';
							echo '</td>';	
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq par">Ojo:</td>';
							echo '<td class = "der par">';
								echo '<select name = "ojo">';
									echo '<option>AMBOS</option>';
									echo '<option>OD</option>';
									echo '<option>OS</option>';
								echo '</select>';
							echo '</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq impar">Derivado por:</td>';
							echo '<td class = "der impar">';
								echo '<select name = "medico" required>';
									foreach ($medicos as $medico) {
										if ($medico->id_medico == $medico_seleccionado)
											echo '<option selected>'.$medico->nombre.'</option>';
										else
											echo '<option>'.$medico->nombre.'</option>';
									}
								echo '</select>';
							echo '</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq par">Cirujano:</td>';
							echo '<td class = "der par">';
								echo '<select required name = "cirujano">';
									foreach ($medicos as $medico) {
										if ($medico->cirujano == 1)
											echo '<option>'.$medico->nombre.'</option>';
									}
								echo '</select>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';					
					echo '<div class = "impar" style ="height:120px;width:504px;margin-left:2px">';
						echo '<div class = "izq" style = "float:left;padding-left:5px">Observaciones:</div>';
						echo '<div style = "float:left"><textarea style = "width:300px;height:100px;margin-left:4px;margin-top:5px" name = "obs" id = "obs"> </textarea></div>';
					echo '</div>';
					echo '<div style ="width:500px;margin-top:10px">';	
						echo '<a id = "submit" style = "float:right;margin-right:2px" class = "boton" href = "#">Pasar a coordinación</a>';
					echo '</div>';	

					echo '<input type = "hidden" name = "ficha" value ="'.$paciente->nroficha.'"/>';
					echo '<input type = "hidden" name = "paciente" value ="'.$paciente->apellido.', '.$paciente->nombre.'"/>';
					echo '<input type = "hidden" name = "obra" value ="'.$paciente->obra_social.'"/>';
					echo '<input type = "hidden" name = "nro_obra" value ="'.$paciente->nro_obra.'"/>';
				echo '<form>';
			}		
		?>
	</body>
</html>		