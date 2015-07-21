<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Editar Turno</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<!-- <link href="<?php echo base_url('css/jquery-ui-1.8.24.custom.css')?>" rel="stylesheet" type="text/css"/> -->
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<style>
	    .ui-autocomplete {
	        max-height: 300px;
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
			font-size: 12pt;
		}
		
		.ui-dialog {
			//position: relative;
			margin: auto;
			font-size: 20pt;
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

	$(document).ready(function(){
		
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
			width: 700,
            height:350,
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
			width: 700,
        	height:350,
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
			width: 700,
	        height:350,
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
	
	<div id="mensaje_casillas" style="display:none"> Se debe marcar al menos una casilla </div>
	<div id="mensaje_tel" style="display:none"> El nro de teléfono no es correcto </div>
	<div id="mensaje_medico" style="display:none"> Se debe ingresar médico</div>
		
	<div class = "titulo">	
		<div id = "nuevo_turno">
			Editar Turno
		</div>

		<div style = "float:left; margin-left:61%;">
				<?php
				echo '<a href="'.base_url('index.php').'">'; 
					echo '<img src = "'.base_url('css/images/home_24x24.png').'"/>'; 
				echo '</a>';
				?>
			</div>

			<div style = "float:left; margin-left:2%;">
				<?php
				echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d', strtotime($filas[0]->fecha))).'">';
					echo '<img src = "'.base_url('css/images/book_alt2_24x21.png').'"/>'; 
				echo '</a>';
				?>
		</div>
		
		<div id = "fecha2">
			<?php
				echo $hora."hs";
			?>	
		</div>

		<div id= "fecha1">
			<?php 
				echo $day." ".$daynum.", ".$month." ".$year." — ";
			?>
		</div>
			
	</div>	
	<form class="contact_form" action="<?php echo base_url('index.php/main/pro_edit_turno')?>" method="post" name="contact_form" id= "contact_form">
<!--	<div id = "ul0"> -->
		<div id = "ul1">
	    	<ul>
	    		<?php
	    			$var = explode(':', $filas[0]->citado);
					$hora_cita = $var[0];
					$minuto_cita = $var[1];
					$cita = $hora_cita.':'.$minuto_cita;
		    	?>	
							<!--<li>
	            				<label for="citado"> Citado: </label> -->
	            				<input type="hidden" size = "1" name="hora_citado" id = "hora_citado" value= "<?php echo $hora_cita ?>" ><input type="hidden" size = "1" name="minutos_citado" id = "minutos_citado" value="<?php echo $minuto_cita?>">
	        				<!--</li>-->
				
	        	<li>
	            	<label for="apellido"><font color = "red">* </font> Apellido: </label>
	            	<input type="text" size = "20" name="apellido" autocomplete="off" value = "<?php echo $filas[0]->apellido ?>" style="text-transform:capitalize"required/>
	        	</li>
	        	<li>
	            	<label for="nombre"><font color = "red">* </font> Nombre: </label>
	            	<input type="text" size = "20" name="nombre" autocomplete="off" value = "<?php echo $filas[0]->nombre ?>" style="text-transform:capitalize" required />
	        	</li>
	        	<li>
					<?php
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
					
					?>
	            	<label for="tel1_1"><font color = "red">* </font> Teléfono 1:</label>
	            	<input type="text" size="3" maxlength = "5" name="tel1_1" id="tel1_1" value="<?php echo $tel1_1?>" autocomplete="off" required pattern=".{3,}"/>
			    	<input type="text" size = "8" maxlength = "10" name="tel1_2" id="tel1_2" value="<?php echo $tel1_2?>" autocomplete="off" required pattern=".{6,}"/>
	        	</li>
				<li>
	            	<label for="tel2_1">Teléfono 2:</label>
	            	<input type="text" size="3" maxlength = "5" name="tel2_1" id="tel2_1" value="<?php echo $tel2_1?>" autocomplete="off" pattern=".{3,}"/>
					<input type="text" size = "8" maxlength = "10" name="tel2_2" id="tel2_2" value="<?php echo $tel2_2?>" autocomplete="off" pattern=".{6,}"/>
					<input type="hidden" name="id" value="<?php echo $id?>"/>
	        		<input type="hidden" name="fecha" value="<?php echo $filas[0]->fecha?>"/>
	        		<input type="hidden" name="ficha" value="<?php echo $filas[0]->ficha?>"/>
	        		<input type="hidden" name="hora" value="<?php echo $hora?>"/>
	        	</li>

	        	<li>
	            	<label for="notas">Notas:</label>
	            	<textarea name="notas" cols="40" rows="5"><?php echo $filas[0]->notas ?></textarea>
	        	</li>
		</div> 
	    
		<div id = "ul2">	
			<ul>
								
				<li style = "min-height: 27px">
					<?php 
						$aux = explode(' - ', $filas[0]->medico);
						$med = $aux[0];
					?>
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
						<?php if ($med == "Otro") {
							echo '<div id = "test">';
								//$var = explode($aux[1]);
								echo 'Dr. <input type="text" value = "'.$aux[1].'" size = "14" name="otro" id="otro" style="text-transform:capitalize" autocomplete="off"/>';
							echo '</div>'; 
						} 
						else { ?>	
							<div id = "test" style = "display: none">
								Dr. <input type="text" size = "14" name="otro" id = "otro" style="text-transform:capitalize" autocomplete="off"/>
							</div>
						<?php }

						?>	
				</li>
				<li>
					<label for="obra"><font color = "red">* </font> Obra social:</label>
						<select id ="obra" name = "obra" required>
								<option value = ""></option>';
							<?php
								foreach ($obras as $value) {
									if (!strcasecmp($filas[0]->obra_social,$value->obra))
										echo '<option value ="'.$value->obra.'" selected>'.$value->obra.'</option>';
									else
										echo '<option value ="'.$value->obra.'">'.$value->obra.'</option>';
								}
							?>
						</select>

						<!--<div class="ui-widget">
							<input type = "text" id="obra" size = "20" name = "obra" value = "<?php echo $filas[0]->obra_social?>" autocomplete="off" required>
						</div>-->
				</li>
	        </ul>

	        <div id = "ul3">
		        <div id="tipo_turno"><font color = "red">* </font> Tipo de turno:</div>
				<div id = "tabla">
				<?php 
					$cadena = $filas[0]->tipo;
				?>
					<div class = "fila">
						<div class = "celda">
							<?php if ( strstr($cadena, "CVC") <> "") {?>
								<input type="checkbox" name="tipo[]" value = "CVC" id = "CVC" checked/> CVC 		
							<?php }
							else { ?>
								<input type="checkbox" name="tipo[]" value = "CVC" id = "CVC"/> CVC
							<?php }?> 		
						</div>
						<div class = "celda_2">
							<?php if ( strstr($cadena, "TOPO") <> "") {?>
								<input type="checkbox" name="tipo[]" value = "TOPO" id = "TOPO" checked/> TOPO
							<?php }
							else { ?>
								<input type="checkbox" name="tipo[]" value = "TOPO" id = "TOPO"/> TOPO
							<?php }?>	
						</div>
						<div class = "celda">
							<?php if ( strstr($cadena, "IOL") <> "") {?>
								<input type="checkbox" name="tipo[]" value = "IOL"id = "IOL" checked/> IOL
							<?php }
							else { ?>
								<input type="checkbox" name="tipo[]" value = "IOL"id = "IOL"/> IOL
							<?php }?>	
						</div>
						<div class = "celda">
							<?php if ( strstr($cadena, "ME") <> "") {?>
								<input type="checkbox" name="tipo[]" value = "ME" id = "ME" checked/> ME
							<?php }
							else { ?>
								<input type="checkbox" name="tipo[]" value = "ME" id = "ME"/> ME
							<?php }?>
						</div>	
					</div>
					<div class = "fila">
						<div class = "celda">
							<?php if ( strstr($cadena, "RFG") <> "") {?>
								<input type="checkbox" name="tipo[]" value = "RFG"id = "RFG" checked/> RFG
							<?php }
							else { ?>
								<input type="checkbox" name="tipo[]" value = "RFG"id = "RFG"/> RFG
							<?php }?>	
						</div>
						<div class = "celda_2">
							<?php if ( strstr($cadena, "RFG-Color") <> "") {?>
								<input type="checkbox" name="tipo[]" value = "RFG-Color"id = "RFG-Color" checked/> RFG-Color
							<?php }
							else { ?>
								<input type="checkbox" name="tipo[]" value = "RFG-Color"id = "RFG-Color"/> RFG-Color
							<?php }?>	
						</div>
						<div class = "celda">
							<?php if ( strstr($cadena, "OCT") <> "") {?>
								<input type="checkbox" name="tipo[]" value = "OCT" id = "OCT" checked/> OCT
							<?php }
							else { ?>
								<input type="checkbox" name="tipo[]" value = "OCT" id = "OCT"/> OCT	
							<?php }?>	
						</div>
						<div class = "celda">
							<?php if ( strstr($cadena, "PAQUI") <> "") {?>
								<input type="checkbox" name="tipo[]" value = "PAQUI"id = "PAQUI" checked/> PAQUI
							<?php }
							else { ?>
								<input type="checkbox" name="tipo[]" value = "PAQUI"id = "PAQUI"/> PAQUI
							<?php }?>	
						</div>
					</div>
					<div class = "fila">
						<div class = "celda">
							<?php if ( strstr($cadena, "OBI") <> "") {?>
								<input type="checkbox" name="tipo[]" value = "OBI" id = "OBI" checked/> OBI
							<?php }
							else { ?>
								<input type="checkbox" name="tipo[]" value = "OBI" id = "OBI"/> OBI
							<?php }?>		 
						</div>			
						<div class = "celda_2">
						<?php if ( strstr($cadena, "YAG") <> "") {?>	
							<input type="checkbox" name="tipo[]" value = "YAG" id = "YAG" checked/> YAG
						<?php }
							else { ?>
							<input type="checkbox" name="tipo[]" value = "YAG" id = "YAG"/> YAG
						<?php }?>		 
						</div>
						<div class = "celda">
						<?php if ( strstr($cadena, "Laser") <> "") {?>	
							<input type="checkbox" name="tipo[]" value = "Laser" id = "LASER" checked/> LASER 
						<?php }
							else { ?>
							<input type="checkbox" name="tipo[]" value = "Laser" id = "LASER"/> LASER 
						<?php }?>		
						</div>
						<div class = "celda">
						<?php if ( strstr($cadena, "Consulta") <> "") {?>
							<input type="checkbox" name="tipo[]" value = "Consulta" id = "CONSULTA" checked/> Consulta 
						<?php }
							else { ?>
							<input type="checkbox" name="tipo[]" value = "Consulta" id = "CONSULTA"/> Consulta 
						<?php }?>		
						</div>			
					</div>
					<div class = "fila">
						<div class = "celda">
						<?php if ( strstr($cadena, "HRT") <> "") {?>
							<input type="checkbox" name="tipo[]" value = "HRT" id = "HRT" checked/> HRT  
						<?php }
							else { ?>
							<input type="checkbox" name="tipo[]" value = "HRT" id = "HRT"/> HRT  
						<?php }?>		
						</div>
						<div class = "celda">
						<?php if ( strstr($cadena, "S/Cargo") <> "") {?>
							<input type="checkbox" name="tipo[]" value = "S/Cargo" id = "S/Cargo" checked/> Sin Cargo 
						<?php }
							else { ?>
							<input type="checkbox" name="tipo[]" value = "S/Cargo" id = "S/Cargo"/> Sin Cargo  
						<?php }?>		
						</div>			
					</div>			
				</div>
			</div>
		</div>
	<!-- </div> -->
	
	<div id = "botones">
		<button class="submit" type="submit">Actualizar</button>
		<button class="cancel" type = "button" onclick = "location.href= '<?php echo base_url("/index.php/main/cambiar_dia/".$filas[0]->fecha)?>';">Cancelar</button>
	</div>
	</form>
	<span class="required_notification">* Campos obligatorios</span>
</body>
</html>