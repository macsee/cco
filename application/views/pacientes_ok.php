<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Pacientes admitidos</title>
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<style>
	.ui-widget {
		font-size: 14px;
	}
	.ui-dialog {
		//position: relative;
		margin: auto;
	}
	//body {width: 1630px; }

	#select_medico {
		float:left;
		margin-top: 9px;
		margin-right: 30px;
	}

	select {
		-webkit-appearance: none;
   		-moz-appearance: none;
   		height: 30px;
   		font-size: 12px;
   		padding-left: 5px;
   		border: 1px solid #E5E5E5;
   		width: 150px;
	}

	.hora_turno {
		width:65px;
		float:left;
		margin-left:10px;
		font-size: 12pt;
	}

	.hora_admision {
		width:100px;
		float:left;
		margin-left:10px;
		font-size: 12pt;
	}

	.paciente {
		width:275px;
		float:left;
		margin-left:10px;
		font-size: 12pt;
	}

	.tipo_turno_ {
		width:200px;
		float:left;
		margin-left:10px;
		font-size: 12pt;
	}

	.ficha {
		width:80px;
		float:left;
		margin-left:10px;
		font-size: 12pt;
	}

	.estado_ {
		width:50px;
		float:left;
		margin-left:10px;
		font-size: 12pt;
	}

	.obra_social {
		width:250px;
		float:left;
		margin-left:10px;
		font-size: 12pt;	
	}

	#content {
		width:1100px;
		//float:left;
		margin:auto;
	}

	.valor_ficha {
		font-size: 12pt;
		font-weight: bold;
		color: #316F97
	}

	.clickeable {
		cursor: pointer;
	}

	.titulo_paciente {
		margin-top: 2px;
		margin-bottom: 2px;
		height: 25px;
		background-color: #1e3e53;
		font-family: OSWALD;
		font-size: 14pt;
		font-weight: bold;
		color: white;
		//padding-left: 10px;
		float:left;
		width:100%;
		margin-bottom: 5px;
	}

	.texto_pacientes {
		text-align: center;
		font-style: italic;
		font-size: 12pt;
	}

	</style>

	<script>

	$(document).ready(function()
	{
		$(".clickeable").click(function()
		{ 
			var id = $(this).attr("id");
			var base_url = '<?php echo base_url(); ?>';
      		str = base_url+"index.php/main/historia_clinica/"+id;
      		//alert(str);
      		location.href = str;
      		//window.location = "http://localhost/cco/index.php/main/historia_clinica/653";	
		});

		$(".check").click(function(event)
		{
			var base_url = '<?php echo base_url(); ?>';
			var tipo_user = '<?php echo $tipo_user; ?>';

			var img1 = '<?php echo base_url("css/images/espera.png"); ?>'; //unchecked
			var img2 = '<?php echo base_url("css/images/check_alt_24x24.png"); ?>'; //checked
			
			//event.preventDefault();
			var value = $(this).attr('id');
			var status = "";

			//alert($(this).attr('id'));

            if ($(this).attr('src') === img1) {
             	$(this).attr('src', img2);
             	$(this).attr('title', "Paciente atendido");
             	if (tipo_user == "Medico")
             		status = "ok";
             	else
             		status = "estudios_ok";
             	//var datastring = "posteo="+value+","+"1";
            }	
         	else {
          		$(this).attr('src', img1);
          		$(this).attr('title', "Paciente en espera");
          		if (tipo_user == "Medico")
          			status = "medico";
          		else
          			status = "estudios";
          		//var datastring = "posteo="+value+","+"0";
          	}

          	var values = {
            		'id'		: value,
            		'estado'	: status,
    		};
                  
          	$.ajax({
					type: 'POST',
 					url: base_url+"cambiar_estado.php",
 					data: values,
			});

        });

		$( "select" ).change(function () {
			var base_url = '<?php echo base_url(); ?>';
    		var str = "";
    		var segment = $(location).attr('href').split("/");
    		$( "select option:selected" ).each(function() {
      			str += base_url+"index.php/main/cambiar_medico/"+$(this).val()+"/"+segment[7]+"/admision";
      			
    		});
    		//alert( $(this).val() );
    		location.href = str;
  		});

	});

	function error() {
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
   	};

/*
	function get_historia(data) {
        	var base_url = '<?php echo base_url(); ?>';
      		str = base_url+"index.php/main/historia_clinica/"+data;
      		alert(str);
      		window.location = "http://localhost/cco/index.php/main/historia_clinica/653";
    		//location.href = "http://localhost/cco/index.php/main/historia_clinica/653";
   	};

   	function chequear(url,data) {
        $( "#dialog-confirm" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 300,
            height: 130,
            modal: true,
            buttons: {
                "Si": function() {
					var x = url+"/cambiar_turno/"+data;
					location.href = x;
                },
				"No": function() {
                    $( this ).dialog( "close" );
				},
                Anular: function() {
					var x = url+"/anular_cambio_turno/"+data;
                    location.href = x;
                }
            }
        });

   };
*/
   function submitform() {
  		document.form_nuevo.submit();
	}
		
	</script>	
</head>
<body>
	<div id="error" title="Atención" style = "display:none"> Este turno no puede modificarse.</div>
	<div id = "content">
		<div id = "main_header">
		<div id = "menu" style = "width:100%">
			<!--
			<div id = "dia_anterior">
				<?php 
					$dia_anterior = strtotime("-1 day", strtotime($fecha));
					echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d',$dia_anterior)).'">';
						echo '<img src = "'.base_url('css/images/arrow_left_24x24.png').'"/>';
					echo '</a>';
				?>
			</div>
			<div id = "hoy">
				<?php 
					echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d')).'">';
						echo '<img src = "'.base_url('css/images/hash_21x24.png').'"/>';
					echo '</a>';
				?>	
			</div>
			<div id = "dia_siguiente">
				<?php 
					$dia_siguiente = strtotime("+1 day", strtotime($fecha));
					echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d',$dia_siguiente)).'">';
						echo '<img src = "'.base_url('css/images/arrow_right_24x24.png').'"/>';
					echo '</a>';
				?>
			</div>
			-->
			<div id = "fecha_dia" style = "margin-left:10px;text-align:left">
				<?php echo $day." ".$daynum.', '.$month." ".$year ?>
			</div>

			<div id = "select_medico">
				<select name="seleccion_medico">
					<?php
						echo '<option value ="todos" selected>TODOS</option>';
						foreach ($medicos as $med) {	
							if ($medico_selected == $med->id_medico)
								echo '<option value ='.$med->id_medico.' selected>'.$med->nombre.'</option>';
							else
								echo '<option value ='.$med->id_medico.'>'.$med->nombre.'</option>';
						}
					?>
				</select>	
					<!--<option value = 0>TODOS</option>
		    		<option value = 1>Dr. Jelusich M</option>
		    		<option value = 2>Dr. Jelusich G</option>
		    		<option value = 3>Dr. Bosio</option>
		    		<option value = 17>OTROS</option>-->
		 		
			</div>

		<?php 

			if ($tipo_user == "Medico")
				echo '<div class="count">';
			else 
				echo '<div class="count" style = "background-color:white; color: #D83C3C; margin-right: 9%">';

				echo ($filas == null)?"0":sizeof($filas);
		?>
			</div>
			<div style = "float:left;margin-left:28%;margin-top:5px">
				<?php
				echo '<a href="'.base_url('index.php').'">'; 
					echo '<img src = "'.base_url('css/images/home_24x24.png').'"/>';
				echo '</a>';
				?>
			</div>
			<div style = "float:left;margin-left:5px;margin-top:5px">
				<?php
				echo '<a target= "_blank" href="'.base_url('index.php/main/buscar_paciente').'">';
					echo '<img src = "'.base_url('css/images/user_18x24.png').'"/>'; 
				echo '</a>';
				?>
			</div>
			<div style = "float:left;margin-left:5px;margin-top:5px">
				<?php
				echo '<a target= "_blank" href="'.base_url('index.php/main/cambiar_dia'."/".$fecha).'">';
					echo '<img src = "'.base_url('css/images/book_alt2_24x21.png').'"/>'; 
				echo '</a>';
				?>
			</div>
			<div style = "float:left;margin-left:5px;margin-top:5px">
				<?php
				echo '<a href="'.base_url('index.php/login/desconectar').'">';
					echo '<img src = "'.base_url('css/images/logout.png').'"/>'; 
				echo '</a>';
				?>
			</div>
		</div>
		<!--
		<div id = "busqueda">
			<form class="form_busqueda" action="<?php echo base_url('index.php/main/busqueda')?>" method="post" name="search_form" id="search_form">
				<input type="text" name="busqueda_texto" id = "busqueda_texto" autocomplete="off" placeholder="Busqueda de turnos..." required/>
				<button type="submit"> Buscar </button>
			</form>	
		</div>
		-->

		</div>

		<div id="dialog-confirm" title="¿Cambiar turno?" style = "display:none">
		<?php
			if (isset($nombre_turno)) {
				echo $apellido_turno.', '.$nombre_turno;
			}
		?>

		</div>
		<div id="borrar_turno" title="¿Borrar turno?"></div>
		<?php
			$array_pacientes_dia = array();
			$array_pacientes_ok = array();

			if ($filas != null)
				foreach ($filas as $turno) {
					if ($turno->estado != "medico" && $turno->estado != "ok" && $turno->estado != "")
						$array_pacientes_dia[] = $turno;

					if ($tipo_user == "Medico"){
						if ($turno->estado == "medico" || $turno->estado == "ok")
							$array_pacientes_ok[] = $turno;
					}	
					else {
						if ($turno->estado == "estudios" || $turno->estado == "estudios_ok")
							$array_pacientes_ok[] = $turno;
					}	
				}
		?>		
		<div id = "turnos_dia" style = "width:100%">
		<?php if ($tipo_user == "Medico") { ?>
			<div class = "titulo_paciente"><div style = "margin-left:10px">Pacientes en tránsito</div></div>
			<?php if ($array_pacientes_dia != null) { ?>
				<div id = "titulo_superior">
					<div class = "hora_turno">
						Hora Turno
					</div>
					<div class = "hora_admision">
						Hora Admisión
					</div>	
					<div class = "paciente">
						Paciente
					</div>
					<div class = "obra_social">
						Obra Social
					</div>
					<div class = "tipo_turno_">
						Turno
					</div>
					<div class = "ficha">
						Ficha
					</div>
					<div class = "estado_">
						Estado
					</div>
				</div>

				<div id = "horarios">
				<?php
					foreach ($array_pacientes_dia as $turno) {
						echo '<div class = "fila_ocupada" id = "'.$turno->id_paciente.'">';
							echo '<div class = "fila_superior">';
									echo '<div class = "hora_turno" style = "margin-top:8px">';
										echo date('H:i', strtotime($turno->hora));
									echo '</div>';	
									echo '<div class = "hora_admision" style = "margin-top:8px">';
										echo date('H:i', strtotime($turno->last_update));
									echo '</div>';	
									echo '<div class = "paciente" style= "font-size:11pt;margin-top:8px">';
										echo $nombre = $turno->apellido.', '.$turno->nombre;
									echo '</div>';
									echo '<div class = "obra_social" style= "font-size:11pt;margin-top:8px">';
										echo $turno->obra_social;
									echo '</div>';
									echo '<div class = "tipo_turno_" style= "font-size:10pt;margin-top:8px">';
										echo $turno->tipo;
									echo '</div>';
									echo '<div class = "valor_ficha" style = "width:80px">';
										echo '<a target = "_blank" href = "'.base_url('index.php/main/historia_clinica/'.$turno->id_paciente).'">'.$turno->ficha.'</a>';
										//echo anchor('main/historia_clinica/'.$turno->id_paciente, $turno->ficha);
										//echo $turno->ficha;
									echo '</div>';

									echo '<div class = "estado" id = "'.$turno->id.'" style="cursor: pointer;margin-left:15px">';
										
									if ($turno->estado == "estudios")	
										echo '<img class = "check" id = "'.$turno->id.'" src = "'.base_url('css/images/estudios.png').'" title = "Paciente realizando estudios"/>'; 
									else if ($turno->estado == "estudios_ok")	
										echo '<img class = "check" id = "'.$turno->id.'" src = "'.base_url('css/images/estudios_ok.png').'" title = "Paciente con estudios finalizados"/>';
									else if ($turno->estado == "medico")	
										echo '<img class = "check" id = "'.$turno->id.'" src = "'.base_url('css/images/medico.png').'" title = "Paciente listo para ser atendido"/>';
									else if ($turno->estado == "dilatacion")	
										echo '<img class = "check" id = "'.$turno->id.'" src = "'.base_url('css/images/dilatacion.png').'" title = "Paciente dilatando"/>';
									else
										echo '<img class = "check" id = "'.$turno->id.'" src = "'.base_url('css/images/check_alt_24x24.png').'" title = "Paciente atendido"/>';

									echo '</div>';
								
							echo '</div>';
						echo '</div>';
					}
				?>
				</div>
			<?php }
			else {
				echo "<p class = 'texto_pacientes'>No se encontraron pacientes</p>";
			}
		}		
		?>

			<div class = "titulo_paciente" style = "margin-top:30px"><div style = "margin-left:10px">Pacientes en espera</div></div>
			<?php if ($array_pacientes_ok != null) { ?>
				<div id = "titulo_superior">
					<div class = "hora_turno">
						Hora Turno
					</div>
					<div class = "hora_admision">
						Hora Admisión
					</div>	
					<div class = "paciente">
						Paciente
					</div>
					<div class = "obra_social">
						Obra Social
					</div>
					<div class = "tipo_turno_">
						Turno
					</div>
					<div class = "ficha">
						Ficha
					</div>
					<div class = "estado_">
						Estado
					</div>
				</div>

				<div id = "horarios">
				<?php
					foreach ($array_pacientes_ok as $turno) {
						echo '<div class = "fila_ocupada" id = "'.$turno->id_paciente.'">';
							echo '<div class = "fila_superior">';
									echo '<div class = "hora_turno" style = "margin-top:8px">';
										echo date('H:i', strtotime($turno->hora));
									echo '</div>';	
									echo '<div class = "hora_admision" style = "margin-top:8px">';
										echo date('H:i', strtotime($turno->last_update));
									echo '</div>';	
									echo '<div class = "paciente" style= "font-size:11pt;margin-top:8px">';
										echo $nombre = $turno->apellido.', '.$turno->nombre;
									echo '</div>';
									echo '<div class = "obra_social" style= "font-size:11pt;margin-top:8px">';
										echo $turno->obra_social;
									echo '</div>';
									echo '<div class = "tipo_turno_" style= "font-size:10pt;margin-top:8px">';
										echo $turno->tipo;
									echo '</div>';
									echo '<div class = "valor_ficha" style = "width:80px">';
										echo '<a target = "_blank" href = "'.base_url('index.php/main/historia_clinica/'.$turno->id_paciente).'">'.$turno->ficha.'</a>';
										//echo anchor('main/historia_clinica/'.$turno->id_paciente, $turno->ficha);
										//echo $turno->ficha;
									echo '</div>';

									echo '<div class = "estado" id = "'.$turno->id.'" style="cursor: pointer;margin-left:15px">';
									
										if ($turno->estado != "ok" && $turno->estado != "estudios_ok") {
											if ($turno->ya_facturado == 0)
												echo '<img class = "check" id = "'.$turno->id.'" src = "'.base_url('css/images/espera.png').'" title = "Paciente en espera"/>';
											else {
												echo '<a onclick = "return error()">';
													echo '<img src = "'.base_url('css/images/espera.png').'" title = "Paciente en espera"/>';
												echo '</a>';
											}	
										}	
										else {
											if ($turno->ya_facturado == 0)
												echo '<img class = "check" id = "'.$turno->id.'" src = "'.base_url('css/images/check_alt_24x24.png').'" title = "Paciente atendido"/>';
											else {
												echo '<a onclick = "return error()">';
													echo '<img src = "'.base_url('css/images/check_alt_24x24.png').'" title = "Paciente atendido"/>';
												echo '</a>';
											}	
										}

									echo '</div>';
								
							echo '</div>';
						echo '</div>';
					}
				?>
				</div>
			<?php }
			else {
				echo "<p class = 'texto_pacientes'>No se encontraron pacientes</p>";
			}	
			?>
		</div>
</body>
</html>
