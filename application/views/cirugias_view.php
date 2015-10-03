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

		table {
			border-collapse: collapse;
			//border-spacing: 2px;
			font-size: 12pt;
		}
		table td {
			//border: 1px solid;
			height:30px;
			padding-left: 5px;
		}
		table th {
			text-align: left;
			border-right: 1px solid;
			font-family: 'OSWALD';
			font-size: 12pt;
			height: 10px;
			background-color: #454545;
			color: white;
		}

		.print table{
			font-size: 15px;
			border: 2px solid;
			border-collapse: collapse;
		}

		.print table td {
			border: 2px solid;
			text-align: center;
		}

		.print table th {
			border: 2px solid;
			font-weight: bold;
			font-size: 18px;
		}
/*
		.izq {
			width: 150px;
			font-family: 'OSWALD';
			font-size: 12pt;
			font-weight: bold;
		}
*/		
		.ui-widget {
			font-size: 14px;
		}
		.ui-dialog {
			//position: relative;
			margin: auto;
		}

		.detail {
			display: none;
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

		.titulo {
			background-color: #454545;
			color: white;
			font-family: 'OSWALD';
			height: 35px;
			font-size:12pt;
			margin-bottom: 2px;
			padding-left: 10px;
		}

		.titulo a {
			text-decoration: none;
			font-size: 17pt;
		}

		.titulo a:visited {
			color:white;
		}
		
		.detalle {
			font-size: 11pt;
		}

		.detalle input{
			font-size: 12pt;
			width: 261px;
			font-family: 'Segoe';
		}

		.detalle select{
			font-size: 12pt;
			width: 266px;
		}

		.paciente {
			font-size:11pt;
			float:left;
			margin-top: 4px;
		}

		.pagos {
			height:20px;
			font-size: 11pt;
			width:60px;
		}

		.izq {
			width: 120px;
		}

		.izq_ {
			width: 50px;
			border-right:1px solid;
		}

		.data {
			cursor: pointer;
		}

		.save {
				background-color: #97d0d9;
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

		.save:hover {
			background-color: #1E91A3;
		}

		.cuadro {
			border: 1px solid #E5E5E5;
    		background-color: #F7F7F7;
    		height:480px;
		}

		.fila_inf {
			margin-top: 10px;
		}
		</style>
		<script>
			$(document).ready(function() {

				$("#print").click(function() { 
					var w = window.open("", "_self");
					var html = $("#html").val();
					w.window.document.write(html);
		        	w.window.print();
				});

				$(".save").click(function() {
					var id = $(this).attr("id");
					//alert(id);
					$("#myform_"+id).submit();
				});

				$(".data").click(function() {
					var id = $(this).attr("id");

			        $("#detail_"+id).dialog({
						autoOpen: true,
			            resizable: false,
						width: 1000,
			            height: 600,
			            modal: true,
			            buttons: {
			                "Guardar": function() {
								//var x = url+"/borrar_turno/"+data;
								//location.href = x;
								$("#myform_"+id).submit();
			                },
							"Cancelar": function() {
			                    $( this ).dialog( "close" );
							}
			            }
			        });
			   	});
			});
		</script>
	</head>
	<body>

		<div class = "titulo">
			<?php
				echo '<a href = "'.base_url('index.php').'">';
					echo '<img src = "'.base_url('css/images/arrow_left_24x24.png').'" style = "margin-right:10px;margin-top:5px"/>';
					echo "Volver";
				echo '</a>';	
			?>
		</div>
		<div style = "border-bottom:1px solid;height:80px;margin-bottom:5px">
			<form id = "form_cirugia" name = "form_cirugia" method="post">
				<div style = "float:left">
					<div style ="float:left;margin-left:10px">
						<?php if (!isset($busqueda_paciente))
									$busqueda_paciente = "";
						?>			
						Paciente
						<input style = "font-size:15px" type = "text" name = "busqueda_paciente" value = "<?php echo $busqueda_paciente?>" size = "30" autocomplete="off"/>
					</div>	
					<div style ="float:left;margin-left:20px">
						Práctica
						<select style = "font-size: 12pt" id = "sel_practica_" name = "sel_practica_">
								<option value = "todas" selected>Todas</option>
								<?php
								if (!isset($sel_practica_))
									$sel_practica_ = "";

									foreach ($tipo_cirugia as $cirugia)
										if ($cirugia->nombre == $sel_practica_)
											echo '<option selected>'.$cirugia->nombre.'</option>';
										else
											echo '<option>'.$cirugia->nombre.'</option>';
								?>
						</select>
					</div>
					<div style ="float:left;margin-left:20px">
						Obra Social:
						<select style = "font-size: 12pt" id = "sel_obra_" name="sel_obra_">
							<option value = "todos">Todas</option>
							<?php
								if (!isset($sel_obra_))
									$sel_obra_ = "";

								foreach ($obras as $obra)
									if ($obra->obra == $sel_obra_)									
										echo '<option selected>'.$obra->obra.'</option>';
									else
										echo '<option>'.$obra->obra.'</option>';
							?>
						</select>
					</div>
					<div style ="float:left;margin-left:20px;margin-right:30px">
						Derivado por:
						<select style = "font-size: 12pt" id = "sel_medico_" name="sel_medico_">
							<option value = "todos">Todos</option>
							<?php
								if (!isset($sel_medico_))
										$sel_medico_ = "";

								foreach ($medicos as $medico)
									if ($medico->id_medico == $sel_medico_)
										echo '<option value ='.$medico->id_medico.' selected>'.$medico->nombre.'</option>';
									else
										echo '<option value ='.$medico->id_medico.'>'.$medico->nombre.'</option>';
							?>
						</select>
					</div>
					<!--<div style ="float:left;margin-left:20px;margin-top:15px">
						Confirmadas:
						<?php 	if (isset($check_conf))
									if ($check_conf != "")
										$check_conf = "checked";
									else
										$check_conf = "";
								else
									$check_conf = "";	
						?>
						<input name = "check_conf" type = "checkbox" <?php echo $check_conf?>/>
					</div>-->
				</div>
				<div style = "float:left">
					<div style ="float:left;margin-left:10px;margin-top:15px">
						Debe orden:
						<?php 	if (isset($check_orden))
									if ($check_orden != "")
										$check_orden = "checked";
									else
										$check_orden = "";
								else
									$check_orden = "";	
						?>
						<input name = "check_orden" type = "checkbox" <?php echo $check_orden?>/>
					</div>
					<div style ="float:left;margin-left:30px;margin-right:115px;margin-top:15px">
						Deuda:
						<?php 	if (isset($check_deuda))
									if ($check_deuda != "")
										$check_deuda = "checked";
									else
										$check_deuda = "";
								else
									$check_deuda = "";	
						?>
						<input name = "check_deuda" type = "checkbox" <?php echo $check_deuda?>/>
					</div>
					<div style ="float:left;margin-left:10px;margin-top:15px">
						<?php 
							if (!isset($fecha_desde))
								$fecha_desde = "";

							if (!isset($fecha_hasta))
								$fecha_hasta = "";
						?>
						Desde: <input style = "font-size: 11pt;width:150px" id = "fecha_desde" name = "fecha_desde" type = "date" value = "<?php echo $fecha_desde?>" />
					</div>
					<div style ="float:left;margin-left:20px;margin-top:15px">
						Hasta: <input style = "font-size: 11pt;width:150px" id = "fecha_hasta" name = "fecha_hasta" type = "date" value = "<?php echo $fecha_hasta?>" />
					</div>	
					<div style ="float:left;margin-left:20px;margin-top:15px">
						<button style = "font-size: 12pt" type = "submit" formaction = "<?php echo base_url('index.php/main/agenda_cirugias')?>"> Buscar </button>
						<?php 
							if (!isset($print))
								$print = "";
							
							if ($print != "") {?>
								<button id = "print" style = "font-size: 12pt"> Imprimir </button>
						<?php }?>	
					</div>
				</div>	
				<input id = "html" type = "hidden" value = "<?php echo $print ?>" />
			</form>
		</div>
		<?php 
		$resultado_conf = array();
		$resultado_noconf = array();

		if (!isset($resultado))
			$resultado = null;

			if ($resultado == null) {
					echo "No hay datos";
					return;
			}		
			else {
				foreach ($resultado as $value) {
					if ($value->confirmado == "Si")
						array_push($resultado_conf,$value);
					else
						array_push($resultado_noconf,$value);
				}
			}
		?>
			<div style = "float:left;width:100%;margin-bottom:10px">
				<div style = "background-color:#1e3e53;float:left;width:100%;color:white;text-align:center;margin-bottom:3px;font-family:'OSWALD'">
					Pacientes con cirugías confirmadas
				</div>
				<?php 
				if (sizeof($resultado_conf) == 0)
					echo "No hay cirugías confirmadas.";
				else { ?>
					<table>
						<th style = "width:60px">
							Ficha
						</th>
						<th style = "width:220px">
							Paciente
						</th>
						<th style = "width:190px">
							Obra Social
						</th>
						<th style = "width:30px">
							Ojo
						</th>
						<th style = "width:290px">
							Practica
						</th>
						<th style = "width:150px">
							Detalle
						</th>
						<th style = "width:200px">
							Anestesia
						</th>
						<th style = "width:100px">
							Fecha Cirugia
						</th>
					</table>
					<?php 
					foreach ($resultado_conf as $value) {
						//if (strpos($this->session->userdata('funciones'), "Medico") !== false) { ?>
						<!--<div style = "border:1px solid #E5E5E5;background-color:#F7F7F7;height:60px;margin-top:2px;width:99.7%">-->
					<?php 	//}
				//else {	?>	
					<div class = "data" id = "<?php echo $value->id?>" style = "border:1px solid #E5E5E5;background-color:#F7F7F7;height:60px;margin-top:2px;width:99.7%">
					<?php //} ?>			
						<div style = "width:62px;margin-left:2px" class = "paciente">
							<?php echo $value->id_paciente ?>
						</div>
						<div style = "width:225px;" class = "paciente">
							<?php echo $value->paciente ?>
						</div>
						<div style = "width:190px" class = "paciente">
							<?php echo $value->obra ?>
						</div>
						<div style = "width:35px" class = "paciente">
						<?php 
							if ($value->practica_od != "") {
								echo "<div>";
									echo "OD";
								echo "</div>";
							}	
							if ($value->practica_os != "") {
								echo "<div class = 'fila_inf'>";
									echo "OS";
								echo "</div>";
							}	
						?>
						</div>
						<div style = "width:295px" class = "paciente">
							<?php
								echo "<div>";
									echo $value->practica_od;
								echo "</div>";	
								echo "<div class = 'fila_inf'>";
									echo $value->practica_os;
								echo "</div>";
							?>
						</div>
						<div style = "width:155px" class = "paciente">
							<?php
								echo "<div>";
									echo $value->detalle_od;
								echo "</div>";	
								echo "<div class = 'fila_inf'>";
									echo $value->detalle_os;
								echo "</div>";
							?>
						</div>	
						<div style = "width:200px" class = "paciente">
							<?php
								echo "<div>";
									echo $value->anestesia_od;
								echo "</div>";	
								echo "<div class = 'fila_inf'>";
									echo $value->anestesia_os;
								echo "</div>";
							?>
						</div>	
						<div class = "paciente">
							<?php echo $fecha = date('d-m-Y',strtotime($value->fecha_prop)); ?>
						</div>	
					</div>

				<?php }
				}
			?>	
			</div>
			<div style = "float:left;width:100%">
				<div style = "background-color:#1e3e53;float:left;width:100%;color:white;text-align:center;margin-bottom:3px;font-family:'OSWALD'">
					Pacientes con cirugías sin confirmar
				</div>
				<?php
				if (sizeof($resultado_noconf) == 0)
					echo "No hay cirugías sin confirmar.";
				else { ?>
					<table>
						<th style = "width:60px">
							Ficha
						</th>
						<th style = "width:220px">
							Paciente
						</th>
						<th style = "width:190px">
							Obra Social
						</th>
						<th style = "width:30px">
							Ojo
						</th>
						<th style = "width:290px">
							Practica
						</th>
						<th style = "width:150px">
							Detalle
						</th>
						<th style = "width:200px">
							Anestesia
						</th>
						<th style = "width:100px">
							Fecha Cirugia
						</th>
					</table>
				<?php 
					foreach ($resultado_noconf as $value) {
						//if (strpos($this->session->userdata('funciones'), "Medico") !== false) { ?>
						<!--<div style = "border:1px solid #E5E5E5;background-color:#F7F7F7;height:60px;margin-top:2px;width:99.7%">-->
					<?php 	//}
				//else {	?>
					<div class = "data" id = "<?php echo $value->id?>" style = "border:1px solid #E5E5E5;background-color:#F7F7F7;height:60px;margin-top:2px;width:99.7%">
					<?php //} ?>			
						<div style = "width:62px;margin-left:2px" class = "paciente">
							<?php echo $value->id_paciente ?>
						</div>
						<div style = "width:225px;" class = "paciente">
							<?php echo $value->paciente ?>
						</div>
						<div style = "width:190px" class = "paciente">
							<?php echo $value->obra ?>
						</div>
						<div style = "width:35px" class = "paciente">
						<?php 
							if ($value->practica_od != "") {
								echo "<div>";
									echo "OD";
								echo "</div>";
							}	
							if ($value->practica_os != "") {
								echo "<div class = 'fila_inf'>";
									echo "OS";
								echo "</div>";
							}	
						?>
						</div>
						<div style = "width:295px" class = "paciente">
							<?php
								echo "<div>";
									echo $value->practica_od;
								echo "</div>";	
								echo "<div class = 'fila_inf'>";
									echo $value->practica_os;
								echo "</div>";
							?>
						</div>
						<div style = "width:155px" class = "paciente">
							<?php
								echo "<div>";
									echo $value->detalle_od;
								echo "</div>";	
								echo "<div class = 'fila_inf'>";
									echo $value->detalle_os;
								echo "</div>";
							?>
						</div>	
						<div style = "width:200px" class = "paciente">
							<?php
								echo "<div>";
									echo $value->anestesia_od;
								echo "</div>";	
								echo "<div class = 'fila_inf'>";
									echo $value->anestesia_os;
								echo "</div>";
							?>
						</div>	
						<div class = "paciente">
							<?php echo $fecha = date('d-m-Y',strtotime($value->fecha_prop)); ?>
						</div>	
					</div>

				<?php } 
				}
			?>	
			</div>
			<?php foreach ($resultado as $value) { ?>
			<div class = "detail" title = "Detalles" id = "<?php echo 'detail_'.$value->id ?>" style = "float:left;margin-left:10px;display:none;">
				<div>
					<form id = "<?php echo 'myform_'.$value->id?>" action="<?php echo base_url('index.php/main/modificar_cirugia')?>" method="post">
						<div style = "float:left;width:45%;margin-top:10px" class = "cuadro">
							<div>
								<table class = "detalle">	
									<tr>
										<td class = "izq">Ficha:</td>
										<td><?php echo $value->id_paciente?></td>
									</tr>
									<tr>
										<td class = "izq">Paciente:</td>
										<td><?php echo $value->paciente?></td>
									</tr>
									<tr>
										<td class = "izq">Obra Social:</td>
										<td>
											<select style = "font-size: 12pt" id = "sel_obra" name="sel_obra" required>
												<?php
													if (!isset($obra_selected))
														$obra_selected = "";

													foreach ($obras as $obra)
														if ($obra->obra == $value->obra)									
															echo '<option selected>'.$obra->obra.'</option>';
														else
															echo '<option>'.$obra->obra.'</option>';
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class = "izq">Nro. Afiliado:</td>
										<td><input id = "nro_afiliado" name = "nro_afiliado" value = "<?php echo $value->id_obra ?>"/></td>
									</tr>
									<tr>
										<td class = "izq">Derivado por:</td>
										<td>
											<select style = "font-size: 12pt" id = "sel_medico" name="sel_medico">
												<?php
													foreach ($medicos as $medico)
														if ($medico->nombre == $value->medico)
															echo '<option selected>'.$medico->nombre.'</option>';
														else
															echo '<option>'.$medico->nombre.'</option>';
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class = "izq">Cirujano:</td>
										<td>
											<select style = "font-size: 12pt" id = "sel_cirujano" name="sel_cirujano">
												<?php
													foreach ($medicos as $medico)
														if ($medico->cirujano == 1)
															if ($medico->nombre == $value->cirujano)
																echo '<option selected>'.$medico->nombre.'</option>';
															else
																echo '<option>'.$medico->nombre.'</option>';
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class = "izq">Presupuesto:</td>
										<td><input id = "presupuesto" name = "presupuesto" value = "<?php echo $value->presupuesto ?>" autocomplete = "off"/></td>
									</tr>
								</table>
							</div>
							<div>	
								<div style = "float:left;margin-left:5px;margin-top:5px">
									<div style = "float:left">Plus:</div>
									<div style = "float:left;margin-left:144px"><input id = "plus_paciente" name = "plus_paciente" value = "<?php echo $value->plus_paciente ?>" class = "pagos" autocomplete = "off"/></div>
								</div>
								<div style = "margin-left:15px;float:left;margin-top:5px;font-size:11pt">
									<div style = "float:left">Pagado:</div>
									<div style = "float:left;margin-left:8px"><input id = "pagado_paciente" name = "pagado_paciente" value = "<?php echo $value->pagado_paciente ?>" class = "pagos" autocomplete = "off"/></div>
								</div>
								<div style = "float:left;margin-left:5px;margin-top:5px;font-size:11pt">
									<div style = "float:left">Imp. Obra Social:</div>
									<div style = "float:left;margin-left:48px"><input id = "paga_obra" name = "paga_obra" value = "<?php echo $value->paga_obra ?>" class = "pagos" autocomplete = "off"/></div>
								</div>
								<div style = "margin-left:16px;float:left;margin-top:5px;font-size:11pt">
									<div style = "float:left">Copago:</div>
									<div style = "float:left;margin-left:5px"><input id = "coseguro_paciente" name = "coseguro_paciente" value = "<?php echo $value->coseguro_paciente ?>" class = "pagos" autocomplete = "off"/></div>
								</div>
							</div>
							<div>	
								<table class = "detalle" style = "margin-top:5px;float:left">
									<tr>
										<td class = "izq">Fecha cirugía:</td>
										<td><input id = "fecha" name = "fecha" type = "date" value = "<?php echo $value->fecha_prop?>" required/></td>
									</tr>
									<tr>
										<td class = "izq">Debe orden:</td>
										<?php 	if($value->debe_orden == "Si")
													$checked = "checked";
												else
													$checked = "";
										?>
											<td><input id = "orden" name = "orden" type = "checkbox" <?php echo $checked ?>/></td>
									</tr>
									<tr>
										<td class = "izq">Confirmada:</td>
										<?php 	if($value->confirmado == "Si")
													$checked = "checked";
												else
													$checked = "";
										?>
										<td><input id = "confirmado" name = "confirmado" <?php echo $checked ?> type = "checkbox"/></td>
									</tr>
								</table>
							</div>
						</div>	
						<div style = "float:left;margin-top:10px;margin-left:10px;width:53%" class = "cuadro">
							<div>
								<table>
									<tr>
										<td class = "izq_" rowspan = "3">OD</td>
										<td class = "izq">Práctica:</td>
										<td>
											<select name = "sel_practica_od" required>
												<option></option>
												<?php
													foreach ($tipo_cirugia as $cirugia)
														if ($cirugia->nombre == $value->practica_od)
															echo '<option selected>'.$cirugia->nombre.'</option>';
														else	
															echo '<option>'.$cirugia->nombre.'</option>';
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class = "izq">Anestesia:</td>
										<td>
											<select name = "sel_anestesia_od" required>
												<option></option>
												<?php
													foreach ($anestesias as $anestesia)
														if ($anestesia->nombre == $value->anestesia_od)
															echo '<option selected>'.$anestesia->nombre.'</option>';
														else	
															echo '<option>'.$anestesia->nombre.'</option>';
												?>
											</select>
										</td>
									</tr>	
									<tr>
										<td class = "izq">Detalle:</td>
										<td><input id = "detalle_od" name = "detalle_od" value = "<?php echo $value->detalle_od ?>" autocomplete = "off"/></td>
									</tr>
								</table>
							</div>
							<div style = "margin-top:20px"> 
								<table>

									<tr>
										<td class = "izq_" rowspan = "3">OS</td>
										<td class = "izq">Práctica:</td>
										<td>
											<select name = "sel_practica_os" required>
												<option></option>
												<?php
													foreach ($tipo_cirugia as $cirugia)
														if ($cirugia->nombre == $value->practica_os)
															echo '<option selected>'.$cirugia->nombre.'</option>';
														else	
															echo '<option>'.$cirugia->nombre.'</option>';
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class = "izq">Anestesia:</td>
										<td>
											<select name = "sel_anestesia_os" required>
												<option></option>
												<?php
													foreach ($anestesias as $anestesia)
														if ($anestesia->nombre == $value->anestesia_os)
															echo '<option selected>'.$anestesia->nombre.'</option>';
														else	
															echo '<option>'.$anestesia->nombre.'</option>';
												?>
											</select>
										</td>
									</tr>	
									<tr>
										<td class = "izq">Detalle:</td>
										<td><input id = "detalle_os" name = "detalle_os" value = "<?php echo $value->detalle_os ?>" autocomplete = "off"/></td>
									</tr>
								</table>
							</div>
							<div style = "margin-left:5px;margin-top:70px;float:left;font-size:11pt;width:100%">
								<div style = "float:left">Observaciones:</div>
								<div style = "float:left;margin-left:38px">
									<textarea id = "obs" name = "obs" style = "width:315px;height:80px;margin-top:7px;font-size:12pt"><?php echo $value->obs ?></textarea>
								</div>
							</div>
						</div>

						<input type = "hidden" name = "id" id = "id" value = "<?php echo $value->id?>" />
						<input type = "hidden" name = "sel_obra_panel" id = "sel_obra_panel" value = "<?php echo $sel_obra_?>" />
						<input type = "hidden" name = "sel_practica_panel" id = "sel_practica_panel" value = "<?php echo $sel_practica_?>" />
						<input type = "hidden" name = "sel_medico_panel" id = "sel_medico_panel" value = "<?php echo $sel_medico_?>" />
						<input type = "hidden" name = "fecha_desde" id = "fecha_desde" value = "<?php echo $fecha_desde?>" />
						<input type = "hidden" name = "fecha_hasta" id = "fecha_hasta" value = "<?php echo $fecha_hasta?>" />
						<input type = "hidden" name = "check_conf" value = "<?php echo $check_conf?>"/>
						<input type = "hidden" name = "check_orden" value = "<?php echo $check_orden?>"/>
						<input type = "hidden" name = "check_deuda" value = "<?php echo $check_deuda?>"/>
					</form>
				</div>
			</div>
		<?php 
			}
		?>		
	</body>
</html>		