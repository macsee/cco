<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Nuevo Turno</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
  	<style>
	    .ui-autocomplete {
	        max-height: 300px;
	        width: 455px;
	        overflow-y: auto;
	        /* prevent horizontal scrollbar */
	        overflow-x: hidden;
	    }
	    /* IE 6 doesn't support max-height
	     * we use height instead, but this forces the menu to always be this tall
	     */
	    * html .ui-autocomplete {
	        height: 100px;
	    }

		.ui-widget {
			font-size: 14px;
		}

		.ui-dialog {
			//position: relative;
			margin: auto;
			font-size: 14px;
			text-align: center;
		}

		.ui-dialog .ui-dialog-buttonpane {
		    text-align: center;
		}
		.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset {
		    float: none;
		}

	</style>
	<script>

	var base_url = "<?php echo base_url() ?>";

	$(document).ready(function(){

			$( "#apellido" ).autocomplete({
				minLength: 1,
	      		source: base_url+"search.php",
	     		 //focus: function( event, ui ) {
	       		// $( "#project" ).val( ui.item.label );
	      		 // return false;

	     		 //},
			    select: function( event, ui ) {

	         	//var x = base_url+"index.php/main/buscar_paciente/"+(ui.item.value);
	          	//location.href = x;

		        $( "#apellido" ).val( ui.item.apellido );
		        $( "#nombre" ).val( ui.item.nombre );
		        $( "#obra" ).val( ui.item.obra_social );
		        $( "#ficha" ).val( ui.item.ficha );

		        var tel1 = ui.item.tel1.split("-");

		       $( "#tel1_1" ).val( tel1[0] );
		       $( "#tel1_2" ).val( tel1[1] );

		        var tel2 = ui.item.tel2.split("-");

		        $( "#tel2_1" ).val( tel2[0] );
		        $( "#tel2_2" ).val( tel2[1] );

		        $( "#id_paciente" ).val( ui.item.value );
		        //$( "#project-description" ).html( ui.item.ficha );

		        return false;
	    	  	}
	    	})
	    	.data( "autocomplete" )._renderItem = function( ul, item ) {
	      		return $( "<li>" )
	        	.data( "item.autocomplete", item )
	        	.append( "<a>" + item.label + "<div style = 'float:right'>" + item.ficha + "</div></a>" )
	        	.appendTo( ul );
	    	};

	   		$('#medico').change(function(){

	 			var valorSeleccionado = $(this).val();
	 			if(valorSeleccionado == "Otro"){
	 				$('#test').fadeIn();
	 			}
	 			else{
	 				$('#test').fadeOut();
	 				return false;
	 			}
			});


			$("#contact_form").submit(function () {

	    		var tel1 = $("#tel1_1").val();
				var tel2 = $("#tel1_2").val();

				tel = tel1.length + tel2.length;

				var tel11 = $("#tel2_1").val();
				var tel21 = $("#tel2_2").val();

				tel3 = tel11.length + tel21.length;

				var medico = $("#medico").val();
				var otro = $("#otro").val();

	    		var check = $("input[type='checkbox']:checked").length;

				if (check == 0) {
					mensaje_casillas();
					return false;
				}

				if (!( (tel == 11) || (tel == 13) )) {
					mensaje_tel();
					return false;
				}

				if (tel3 != 0)
				{
					if (!( (tel3 == 11) || (tel3 == 13) )) {
						mensaje_tel();
					  	return false;
					}
				}

				if (medico == "Otro" && otro == "")
				{
					mensaje_medico();
				  	return false;
				}

			});


	});

	function mensaje_casillas() {
        $( "#mensaje_casillas" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 300,
            height: 140,
            modal: true,
            buttons: {
				"Aceptar": function() {
                    $( this ).dialog( "close" );
				}
            }
        });
	};

	function mensaje_tel() {
        $( "#mensaje_tel" ).dialog({
			autoOpen: true,
           	resizable: false,
			width: 300,
        	height: 140,
	       	modal: true,
	        buttons: {
				"Aceptar": function() {
	               $( this ).dialog( "close" );
				}
          	}
	     });
	};

	function mensaje_medico() {
	    $( "#mensaje_medico" ).dialog({
			autoOpen: true,
	      	resizable: false,
			width: 300,
	        height: 140,
            modal: true,
        	buttons: {
				"Aceptar": function() {
               	$( this ).dialog( "close" );
				}
			}
		});
	};



/*	$(function() {

        $( "#obra" ).autocomplete({
            source: "/clinica/scripts/search.php",
            minLength: 1,
        });
    });
*/
	</script>
</head>
<body>
<?php
$apellido = "";
$nombre = "";
$tel1_1 = "0341";
$tel1_2 = "";
$tel2_1 = "";
$tel2_2 = "";
$ficha = "";
$id_paciente = "";
$obra = "";



	if (isset($filas)) {
		$apellido = $filas[0]->apellido;
		$nombre = $filas[0]->nombre;
		$obra = $filas[0]->obra_social;
		$ficha = $filas[0]->ficha;
		$id_paciente = $filas[0]->id_paciente;

		$aux = explode('-',$filas[0]->tel1);
		$tel1_1 = $aux[0];
		$tel1_2 = $aux[1];

		$aux2 = explode('-',$filas[0]->tel2);
		$tel2_1 = $aux2[0];
		if ($tel2_1 == "")
		{
			$tel2_2 = "";
		}
		else
		{
			$tel2_2 = $aux2[1];
		}
	}

?>

<div id="mensaje_casillas" style="display:none"> Se debe marcar al menos una casilla </div>
<div id="mensaje_tel" style="display:none"> El nro de teléfono no es correcto </div>
<div id="mensaje_medico" style="display:none"> Se debe ingresar médico</div>

	<div class = "titulo">
		<div id = "nuevo_turno">
			Nuevo Turno
		</div>

		<div id= "fecha1">
			<?php
				echo $day." ".$daynum.", ".$month." ".$year;
				$var = explode(':', $horario);
				$hora = $var[0];
				$minuto = $var[1];
			?>
		</div>

     <!-- <span class="required_notification">* Campos obligatorios</span> -->
	</div>

	<form class="contact_form" action="<?php echo base_url('index.php/main/pro_nuevo_turno')?>" method="post" name="contact_form" id="contact_form">

		<div id = "ul1">
	    	<ul>
				<li style = "height:32px">
					<div style = "float: left; width:380px">
						<label for="hora"><font color = "red">* </font> Hora: </label>
						<?php
		            		echo '<input type="text" size = "1" name="hora" pattern="[0-9].{1,}" autocomplete="off" maxlength = "2" required value='. $hora.'> : <input type="text" size = "1" name="minutos" required pattern="[0-9].{1,}" autocomplete="off" maxlength = "2" autofocus value='. $minuto.'>';
						?>
					</div>
					<div style = "float: left">
						<label for="hora_citado" style = "width:50px"> Citado: </label>
						<?php
		            		echo '<input type="text" size = "1" name="hora_citado" pattern="[0-9].{1,}" autocomplete="off" maxlength = "2" value='. $hora.'> : <input type="text" size = "1" name="minutos_citado" pattern="[0-9].{1,}" autocomplete="off" maxlength = "2" value='. $minuto.'>';
						?>
					</div>
	        	</li>
	        	<li>
	            	<label for="apellido"><font color = "red">* </font> Apellido:</label>
	            	<input type="text" size = "20" id = "apellido"name="apellido" autocomplete="off" value = "<?php echo $apellido ?>" style="text-transform:capitalize" required/>
	        	</li>
	        	<li>
	            	<label for="nombre"><font color = "red">* </font> Nombre:</label>
	            	<input type="text" size = "20" id = "nombre" name="nombre" autocomplete="off" value = "<?php echo $nombre ?>" style="text-transform:capitalize" required />
	        	</li>
	        	<li>
	            	<label for="tel1_1"><font color = "red">* </font> Teléfono 1:</label>
	            	<input type="text" size="3" maxlength = "5" name="tel1_1" id="tel1_1" autocomplete="off" value = "<?php echo $tel1_1 ?>" required pattern="[0-9].{2,}"/>
			    	<input type="text" size = "8" maxlength = "10" name="tel1_2" id="tel1_2" autocomplete="off" value = "<?php echo $tel1_2 ?>" required pattern="[0-9].{5,}"/>
	        	</li>
				<li>
	            	<label for="tel2_1">Teléfono 2:</label>
	            	<input type="text" size="3" maxlength = "5" name="tel2_1" id ="tel2_1" autocomplete="off" value = "<?php echo $tel2_1 ?>" pattern="[0-9].{2,}"/>
					<input type="text" size = "8" maxlength = "10" name="tel2_2" id ="tel2_2" autocomplete="off" value = "<?php echo $tel2_2 ?>" pattern="[0-9].{5,}"/>
					<input type="hidden" name="fecha" value="<?php echo $fecha ?>">
					<input type="hidden" id = "ficha" name="ficha" value = "<?php echo $ficha ?>">
					<input type="hidden" id = "id_paciente" name="id_paciente" value = "<?php echo $id_paciente ?>">
	        	</li>
	        	 <li>
	            	<label for="notas">Notas:</label>
	            	<textarea name="notas" cols="40" rows="5"></textarea>
	            </li>
		 	</ul>
		</div>

		<div id = "ul2">
			<ul>

				<li style = "min-height: 32px">
					<label for="medico"><font color = "red">* </font> Médico:</label>
						<select id = "medico" name = "medico">
							<?php
								foreach ($medicos as $medico) {
									if ($med == $medico->nombre)
										if ($medico->nombre == "Otro")
											echo '<option value ="'.$medico->nombre.'" selected>'.$medico->nombre.'</option>';
										else
											echo '<option value ="'.$medico->nombre.'" selected>Dr. '.$medico->nombre.'</option>';
									else
										if ($medico->nombre == "Otro")
											echo '<option value ="'.$medico->nombre.'">'.$medico->nombre.'</option>';
										else
											echo '<option value ="'.$medico->nombre.'">Dr. '.$medico->nombre.'</option>';
								}
							?>
						</select>
						<div id = "test" style = "margin-bottom: 22px; display: none">
							Dr. <input type="text" size = "14" name="otro" id = "otro" style="text-transform:capitalize" autocomplete="off"/>
						</div>
				</li>
				<li>
					<label for="obra"><font color = "red">* </font> Obra social:</label>
						<div>
							<select id ="obra" name = "obra" required>
								<option value = ""></option>';
							<?php
								foreach ($obras as $value) {
									if (!strcasecmp($obra,$value->obra))
										echo '<option value ="'.$value->obra.'" selected>'.$value->obra.'</option>';
									else
										echo '<option value ="'.$value->obra.'">'.$value->obra.'</option>';
								}
							?>
							</select>
						</div>
						<!--<div class="ui-widget">
							<input type="text" size = "20" id="obra" name ="obra" required autocomplete="off" value = "<?php echo $obra ?>" >
						</div>-->
				</li>
			</ul>

			<div id = "ul3">

				<div id="tipo_turno"><font color = "red">* </font> Tipo de turno:</div>

				<div id = "tabla">
					<div class = "fila">
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "CVC" id = "CVC"/> CVC
						</div>
						<div class = "celda_2">
							<input type="checkbox" name="tipo[]" value = "TOPO" id = "TOPO"/> TOPO
						</div>
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "IOL"id = "IOL"/> IOL
						</div>
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "ME" id = "ME"/> ME
						</div>
					</div>
					<div class = "fila">
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "RFG"id = "RFG"/> RFG
						</div>
						<div class = "celda_2">
							<input type="checkbox" name="tipo[]" value = "RFG-Color" id = "RFG-Color"/> RFG-Color
						</div>
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "OCT" id = "OCT"/> OCT
						</div>
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "PAQUI"id = "PAQUI"/> PAQUI
						</div>
					</div>
					<div class = "fila">
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "OBI" id = "OBI"/> OBI
						</div>
						<div class = "celda_2">
							<input type="checkbox" name="tipo[]" value = "YAG" id = "YAG"/> YAG
						</div>
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "Laser" id = "LASER"/> LASER
						</div>
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "Consulta" id = "CONSULTA"/> Consulta
						</div>
					</div>
					<div class = "fila">
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "HRT" id = "HRT"/> HRT
						</div>
						<div class = "celda_2">
							<input type="checkbox" name="tipo[]" value = "ARM" id = "ARM"/> ARM
						</div>
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "Tonom" id = "Tonom"/> Tonom.
						</div>
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "EXO" id = "EXO"/> EXO
						</div>
					</div>
					<div class = "fila">
						<div class = "celda">
							<input type="checkbox" name="tipo[]" value = "S/Cargo" id = "S/Cargo"/> Sin Cargo
						</div>
					</div>
				</div>
			</div>
		</div>
	    <div id = "botones">
	        		<button class="submit" type="submit">Guardar</button>
					<button class="cancel" type = "button" onclick = "location.href= '<?php echo base_url("/index.php/main/cambiar_dia/$fecha")?>';">Cancelar</button>
		</div>
	</form>
	<span class="required_notification" style = "float:left">* Campos obligatorios</span>
</body>
</html>
