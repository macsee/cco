<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Turnos</title>
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
   		width: 110px;
	}

	</style>
	<script>

	$(document).ready(function()
	{
		
		$(".clickeable").click(function()
		{ 
			var id = $(this).attr("id");
			if ($("#detalles_"+id).is(":hidden")) {
				$('[id^="detalles_"]').slideUp("slow"); 
				$("#detalles_"+id).slideDown("slow");
				
				//$("#detalles_*").;
			} 
			else {
				$("#detalles_"+id).slideUp("slow");
			}		
		});

		$(".check").click(function(event)
		{
			var base_url = '<?php echo base_url(); ?>';
			var img1 = '<?php echo base_url("css/images/check_16x13.png"); ?>';
			var img2 = '<?php echo base_url("css/images/check_alt_24x24.png"); ?>';
			
			//event.preventDefault();
			var value = $(this).attr('id');
			var status = "";

			//alert($(this).attr('id'));

            if ($(this).attr('src') === img1) {
             	$(this).attr('src', img2);
             	status = "1";
             	//var datastring = "posteo="+value+","+"1";
            }	
         	else {
          		$(this).attr('src', img1);
          		status = "0";
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
      			str += base_url+"index.php/main/cambiar_medico/"+$(this).val()+"/"+segment[7];
      			
    		});
    		//alert( segment[7] );
    		location.href = str;
  		});
	});


	function borrar(url,data) {
        $( "#borrar_turno" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 300,
            height: 80,
            modal: true,
            buttons: {
                "Si": function() {
					var x = url+"/borrar_turno/"+data;
					location.href = x;
                },
				"No": function() {
                    $( this ).dialog( "close" );
				}
            }
        });
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

   function submitform() {
  		document.form_nuevo.submit();
	}
		
	</script>	
</head>
<body>


<div id = "main_header">
<div id = "menu">
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
	
	<div id = "fecha_dia">
		<?php echo $day." ".$daynum.', '.$month." ".$year ?>
	</div>

	<div id = "select_medico">
		<select name="seleccion_medico">
			<?php
				
				if ($medico == "")
					echo '<option value = 0 selected>TODOS</option>';

				foreach ($medicos as $med) {	
					if ($medico_selected == $med->nombre)
						echo '<option value ='.$med->id.' selected>'.$med->nombre.'</option>';
					else
						echo '<option value ='.$med->id.'>'.$med->nombre.'</option>';
				}
			?>
		</select>	
			<!--<option value = 0>TODOS</option>
    		<option value = 1>Dr. Jelusich M</option>
    		<option value = 2>Dr. Jelusich G</option>
    		<option value = 3>Dr. Bosio</option>
    		<option value = 17>OTROS</option>-->
 		
	</div>

	<div class="count">
			<?php 	if ($filas == 0) {
						$cantidad_estudios = 0;
						echo "0";
					}
					else {
						$cantidad = 0;
						$cantidad_estudios = 0;
						
						foreach ($filas as $fila) {

							if (substr_count($fila->tipo, 'CVC') OR substr_count($fila->tipo, 'TOPO') OR substr_count($fila->tipo, 'IOL') OR substr_count($fila->tipo, 'ME') OR substr_count($fila->tipo, 'OCT') OR substr_count($fila->tipo, 'RFG') ) {
								$cantidad_estudios++;
							}
							
							if ($fila->medico == $medico_selected) {
								$cantidad++; 
							}
							else
								$cantidad++;

						}
						echo $cantidad;
					}
			?>
	</div>
	<div class="count" style = "background-color:white; color: #D83C3C; margin-right: 9%">
			<?php 	
				echo $cantidad_estudios;
			?>
	</div>
	<div id = "principal">
		<?php
		echo '<a href="'.base_url('index.php').'">'; 
			echo '<img src = "'.base_url('css/images/home_24x24.png').'"/>';
		echo '</a>';
		?>
	</div>
	<div id = "calendario">
		<?php
		echo '<a target= "_blank" href="'.base_url('index.php/main/buscar_paciente').'">';
			echo '<img src = "'.base_url('css/images/user_18x24.png').'"/>'; 
		echo '</a>';
		?>
	</div>
</div>

<div id = "busqueda">
	<form class="form_busqueda" action="<?php echo base_url('index.php/main/busqueda')?>" method="post" name="search_form" id="search_form">
		<input type="text" name="busqueda_texto" id = "busqueda_texto" autocomplete="off" placeholder="Busqueda de turnos..." required/>
		<button type="submit"> Buscar </button>
	</form>	
</div>

</div>

<div id="dialog-confirm" title="¿Cambiar turno?" style = "display:none">
<?php
	if (isset($nombre_turno)) {
		echo $apellido_turno.', '.$nombre_turno;
	}
?>

</div>
<div id="borrar_turno" title="¿Borrar turno?"></div>

<div id = "turnos_dia">

	<div id = "titulo_superior">
		<div class = "uno">
			Hora
		</div>	
		<div class = "dos">
			Paciente
		</div>
		<div class = "tres">
			Medico
		</div>
		<div class = "cuatro">
			Turno
		</div>
		<div class = "cinco">
			Ficha
		</div>
		<div class = "seis">
			Estado
		</div>
	</div>

	<div id = "horarios">
	<?php

		if ($filas <> 0) {

			$i = 0;	
			foreach ($filas as $fila) {

				$hora_comp_turno = date('H:i', strtotime($fila->hora));
				$array[$i] = $hora_comp_turno;
				$array_turnos[$i] = $fila;
				$i++;
			}

			foreach ($horario as $esta) {

				$hora_comp = date('H:i', strtotime($esta->hora));
				if (!in_array($hora_comp, $array)) {
					$array[$i] = $hora_comp;
					$i++;	
				}			
			}

			asort($array);

			$h = 0;

			foreach ($array as $hora_turno) {

				for ($j = $h; $j < sizeof($array_turnos); $j++) {

					$turnos_hora = date('H:i', strtotime($array_turnos[$j]->hora));

					if ($hora_turno = $turnos_hora) {
						$array[$j] = $array_turnos[$j];
						$h = $j;
					}

				}

			}		
			
		}

		else {

			$i = 0;
			foreach ($horario as $esta) {

				$hora_comp = date('H:i', strtotime($esta->hora));
					$array[$i] = $hora_comp;
					$i++;				
			}
		}

	/*
	 	foreach ($horario as $esta) {
		
			$hora_completa = date('H:i', strtotime($esta->hora));
			$array[$hora_completa] = $hora_completa;
			
		}
		
		if ($filas <> 0) {

			foreach ($filas as $fila) {
				$hora_completa = date('H:i', strtotime($fila->hora));
				$array[$hora_completa] = $fila;
			}
			
		}
		
		ksort($array);
	*/	
		foreach ($array as $fila) {
			
			if (is_object($fila)) {
				
				$hora = date('H', strtotime($fila->hora));
				$minutos = date('i', strtotime($fila->hora));
				$data = $fecha.'/'.$hora.'/'.$minutos;

				$hora_completa = date('H:i', strtotime($fila->hora));
				$cita = date('H:i', strtotime($fila->citado));
				$config = $this->main_model->get_config_medico($fila->medico);
				if (empty($config))
					$color = "#F5C7CE";//#FFCDCD";
				else
					$color = $config->config;
				
				//echo '<div class = "fila_ocupada" onclick = "location.href=\''.base_url("/index.php/main/vista_turno/".$fila->id).'\';" style="cursor: pointer;">';
				//if ($fila->medico == "Dr. Jelusich") {
					echo '<div class = "fila_ocupada" style = "background-color:'.$color.'">'; 
				//}
				//else {
				//	echo '<div class = "fila_ocupada2">';
				//}
					echo '<div class = "fila_superior">';

					//echo '<div class = "clickeable" id = "'.$fila->id.'" style="cursor: pointer;">';

						echo '<div class = "hora_ocupada">';
							echo '<div class = "horario">';
								echo '<a href="'.base_url("/index.php/main/nuevo_turno/".$fila->fecha.'/'.$hora.'/'.$minutos).'" name="'.$hora_completa.'">'.$hora_completa.'</a>';
							echo '</div>';

							echo '<div class = "hora_cita">';	
								if (($cita <> '00:00') && ($cita <> $hora_completa)) 
								{
									echo '<a>cita: '.$cita.'</a>';
							
								}
							echo '</div>';	
							
						echo '</div>';

						echo '<div class = "clickeable" id = "'.$fila->id.'" style="cursor: pointer;">';

						echo '<div class = "nombre_apellido">'; 	
							echo $nombre = $fila->apellido.', '.$fila->nombre;
						echo '</div>';

						echo '<div class = "medico">';
							$auxi = explode(' - ', $fila->medico);
							$med = $auxi[0];
							if ($med == "Otro") {
								echo $auxi[1];
							}
							else {
								echo $fila->medico;	
							}
						echo '</div>';

						echo '<div class = "tipo_turno">';
							echo $fila->tipo;
						echo '</div>';
					echo '</div>';	
						echo '<div class = "valor_ficha">';
							if ($fila->ficha == -1) {
								//echo anchor('main/nuevo_paciente/'.$fila->nombre.'/'.$fila->apellido, 'Nuevo Paciente');	
							echo '<form action="'.base_url('index.php/main/nuevo_paciente').'" method="post" name="form_nuevo" id="form_nuevo">';

								echo '<input type="hidden" name="nombre" value="'.$fila->nombre.'">';
								echo '<input type="hidden" name="apellido" value="'.$fila->apellido.'">';
								echo '<input type="hidden" name="obra" value="'.$fila->obra_social.'">';
								echo '<input type="hidden" name="tel1" value="'.$fila->tel1.'">';
								echo '<input type="hidden" name="tel2" value="'.$fila->tel2.'">';
								echo '<input type="hidden" name="fecha_turno" value="'.$fecha.'">';
							?>
								<a href="#" onclick="$(this).closest('form').submit(); return false;">Nuevo Paciente</a>
							<?php	
							echo '</form>';
							
							}	
							else if ($fila->ficha == -2) {
								echo anchor('main/buscar_paciente/'.$fila->apellido.'/'.$fila->nombre.'/'.$fila->id, "Buscar..");	
								//echo anchor('main/buscar_paciente', 'Buscar..');
							}
							else {
								if ($this->session->userdata('grupo') == "Medico")
									echo anchor('main/historia_clinica/'.$fila->id_paciente, $fila->ficha);
								else	
									echo anchor('main/buscar_paciente/'.$fila->id_paciente, $fila->ficha);
							}		
						echo '</div>';

						echo '<div class = "estado" id = "'.$fila->id.'" style="cursor: pointer;">';
					
						if ($fila->estado == "")
						{	
							//echo '<a href="'.base_url('index.php/main/cambiar_estado/1/'.$fila->id.'/'.$data).'">'; 
								echo '<img class = "check" id = "'.$fila->id.'" src = "'.base_url('css/images/check_16x13.png').'"/>'; 
							//echo '</a>';
						}
						else	
						{	
							//echo '<a href="'.base_url('index.php/main/cambiar_estado/0/'.$fila->id.'/'.$data).'">'; 
								echo '<img class = "check" id = "'.$fila->id.'" src = "'.base_url('css/images/check_alt_24x24.png').'"/>'; 
							//echo '</a>';
						}	

						echo '</div>';

					echo '</div>';
					
				echo '</div>';
				echo '<div id = "detalles_'.$fila->id.'" class="detalles" style = "display:none;">';

					echo '<div id = "detalle_1">';
						echo "<b>Obra social :</b>  ".$fila->obra_social;
					echo '</div>';
					echo '<div id = "detalle_1">';
						echo "<b>Teléfono :</b>  ".$fila->tel1;
					echo '</div>';
					echo '<div id = "detalle_1">';
							echo "<b>Teléfono 2 :</b>  ".$fila->tel2; 				
					echo '</div>';
					echo '<div id = "detalle_nota">';
						if ($fila->notas == "") {
							echo "<b>Notas :  </b> <i>No hay notas para mostrar</i>"; 
						}
						else {
							echo "<b>Notas: </b>".$fila->notas;
						}
					echo '</div>';
					echo '<div id = "botones">';
						echo '<a href="'.base_url('index.php/main/editar_turno/'.$fila->id).'">';
							echo '<img src = "'.base_url('css/images/pencil_icon&16.png').'"/>';  
						echo '</a>';
						echo '<a style="cursor: pointer;" onclick = "return borrar(\''.base_url("/index.php/main/").'\', \''.$fila->id.'\');">'; 
							echo '<img src = "'.base_url('css/images/delete_icon&16.png').'"/>';  
						echo '</a>';
						echo '<a href="'.base_url('index.php/main/set_cambio/'.$fecha.'/'.$fila->id.'/'.$fila->nombre.'/'.$fila->apellido).'">';
							echo '<img src = "'.base_url('css/images/refresh_icon&16.png').'"/>';  
						echo '</a>';
						echo '<a href="'.base_url('index.php/main/set_turno/'.$fecha.'/'.$fila->id).'">';
							echo '<img src = "'.base_url('css/images/plus_black_16x16.png').'"/>';  
						echo '</a>';
					echo '</div>';
					echo '<div style = "font-style:italic;float:right;font-size:12px;">';
						echo 'Ultima edición: '.date('d-m-Y@H:i', strtotime($fila->last_update)).' por <bold>'.$fila->usuario.'<bold>';
					echo '</div>';	
				echo '</div>';
			}
			else {
				$hora = date('H', strtotime($fila));
				$minutos = date('i', strtotime($fila));
				$data = $fecha.'/'.$hora.'/'.$minutos;
				
					if ($id_turno <> NULL)
					{	
						if ($nuevo_turno == 1) {

							echo '<div class = "fila_vacia" onclick = "location.href=\''.base_url("/index.php/main/asignar_turno/".$fecha.'/'.$hora.'/'.$minutos).'\';" style="cursor: pointer;">';

						}	
						else {	
					//echo '<div class = "fila_vacia" style="cursor: pointer;">';	
							echo '<div class = "fila_vacia" style="cursor: pointer" onclick = "return chequear(\''.base_url("/index.php/main/").'\', \''.$data.'\');">';
						}	
					}	
					else
					{
					//echo '<div class = "fila_vacia" style="cursor: pointer;">';
					echo '<div class = "fila_vacia" onclick = "location.href=\''.base_url("/index.php/main/nuevo_turno/".$fecha.'/'.$hora.'/'.$minutos).'\';" style="cursor: pointer;">';	
					}	
					echo '<div class = "hora">'; 
						echo '<a name="'.$fila.'">'.$fila.'</a>';
					echo '</div>';	 
				echo '</div>';
			}
		}

	?>
	</div>

</div>

<div id = "notas_dia"> 
	Notas del día
	<div id = "add_notas">
		<?php
		echo '<a href="'.base_url('index.php/main/add_notas/'.$fecha).'">'; 
			echo '<img src = "'.base_url('css/images/plus_alt_16x16.png').'"/>';  
		echo '</a>';
		?>
	</div>	
</div>
<div id = "notas">
	<ul>
	<?php
		if ($notas <> NULL) {
			foreach ($notas as $nota) {
				echo '<li>';
				echo anchor('main/edit_notas/'.$nota->id, $nota->nota);
				echo '<p style = "font-size:12px;font-style:italic;float:right;margin-top:20px">'.date('d-m-Y@H:i', strtotime($nota->last_update)).' - '.$nota->usuario.'</p>';
				echo '</li>';		
			}
		}
		else {
			echo "<i> No hay notas para este día </i>";
		}	
	?>
	</ul>
</div>
<div id = "calendario_turno">
	<?php
	 $algo = explode('-',$fecha);
	 $algo_anio = $algo[0];
	 $algo_mes = $algo[1];
	echo '<iframe src="'.base_url('index.php/main/show_calendar/'.$algo_anio.'/'.$algo_mes).'"></iframe>';
	//echo $calendario
	?>
</div>	 


</body>
</html>
