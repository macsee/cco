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
			//border:none;
			font-size: 12pt;
			font-family: 'Segoe';
			width: 150px;
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

		.ui-widget {
			font-size: 14px;
			text-align: center;
		}
		.ui-dialog {
			//position: relative;
			margin: auto;
		}

		.izq {
			width: 80px;
			font-family: 'OSWALD';
			font-size: 12pt;
			font-weight: bold;
		}

		.der {
			width: 320px;
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
				$("#submit").click(function(event) {

					var msgOD = "";
					var msgOS = "";
					var pod = $("#practica_od").val();
					var pos = $("#practica_os").val();
					var aod = $("#anestesia_od").val();
					var aos = $("#anestesia_os").val();

					if ((pod == "") && (aod == "") & (pos == "") && (aos == "")) {
						msgOD = "Debe completar la información de práctica para el OD";
						msgOS = "Debe completar la información de práctica para el OS";
					}
					
					if 	( ((pod == "") && (aod != "")) || ((pod != "") && (aod == "")) )
						msgOD = "Debe completar la información de práctica para el OD";

					if 	( ((pos == "") && (aos != "")) || ((pos != "") && (aos == "")) )
						msgOS = "Debe completar la información de práctica para el OS";


					if (msgOD != "" && msgOS != "")
						$( "#error" ).html("Debe completar la información de práctica de al menos un ojo");
					else if (msgOD != "")
						$( "#error" ).html(msgOD);
					else
						$( "#error" ).html(msgOS);

					if ((pod == "") && (aod == "") & (pos == "") && (aos == ""))
						$( "#error" ).html("Debe completar la información de práctica de al menos un ojo");


					if ( (msgOD == "" && msgOS != "") || (msgOD != "" && msgOS == "") || (msgOD != "" && msgOS != "") )
					{
					
				        $( "#error" ).dialog({
							autoOpen: true,
				            resizable: false,
							width: 300,
				            height: 150,
				            modal: true,
				            buttons: {
								"Aceptar": function() {
				                    $( this ).dialog( "close" );
								}
				            }
				        });

					}
					else
						$("#myform").submit();

						event.preventDefault();
				});
			});
		</script>
	</head>
	<body>
		<div id = "error" title = "Error" style = "display:none"></div>
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
							echo '<td class = "izq impar" colspan="2">Ficha:</td>';
							echo '<td class = "der impar">'.$paciente->nroficha.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq par" colspan="2">Paciente:</td>';
							echo '<td class = "par" style = "width:200px">'.$paciente->apellido.', '.$paciente->nombre.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq impar" colspan="2">Obra Social:</td>';
							echo '<td class = "der impar" style = "width:200px">'.$paciente->obra_social.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq par" colspan="2">Nro Afiliado:</td>';
							echo '<td class = "der par" style = "width:150px">'.$paciente->nro_obra.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq impar" rowspan="3">OD:</td>';
							echo '<td class ="izq impar font">Práctica:</td>';
							echo '<td class ="der impar font">';
								echo '<select id = "practica_od" name = "practica_od">';
										echo '<option></option>';
									foreach ($tipo_cirugias as $practica)
										echo '<option>'.$practica->nombre.'</option>';
								echo '</select>';
							echo '</td>';	
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq impar font">Anestesia:</td>';
							echo '<td class ="der impar font">';
								echo '<select id = "anestesia_od" name = "anestesia_od">';
									echo '<option></option>';
									foreach ($anestesias as $anestesia)
										echo '<option>'.$anestesia->nombre.'</option>';
								echo '</select>';
							echo '</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq impar font">Detalles:</td>';
							echo '<td class = "der impar"><input type = "text" name = "detalle_od" autocomplete = "off"/></td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq par" rowspan="3">OS:</td>';
							echo '<td class ="izq par">Práctica:</td>';
							echo '<td class ="der par">';
								echo '<select id = "practica_os" name = "practica_os">';
										echo '<option></option>';
									foreach ($tipo_cirugias as $practica)
										echo '<option>'.$practica->nombre.'</option>';
								echo '</select>';
							echo '</td>';	
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq par font">Anestesia:</td>';
							echo '<td class ="der impar font">';
								echo '<select id = "anestesia_os" name = "anestesia_os">';
									echo '<option></option>';
									foreach ($anestesias as $anestesia)
										echo '<option>'.$anestesia->nombre.'</option>';
								echo '</select>';
							echo '</td>';	
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq par font">Detalles:</td>';
							echo '<td class = "der par"><input type = "text" name = "detalle_os" autocomplete = "off"/></td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class = "izq impar" colspan="2">Derivado por:</td>';
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
							echo '<td class = "izq par" colspan="2">Cirujano:</td>';
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
					echo '<div class = "impar" style ="height:120px;width:502px;margin-left:2px">';
						echo '<div class = "izq" style = "float:left;padding-left:5px">Observaciones:</div>';
						echo '<div style = "float:left"><textarea style = "width:300px;height:100px;margin-left:90px;margin-top:5px" name = "obs" id = "obs"> </textarea></div>';
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