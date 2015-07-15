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
/*
		.izq {
			width: 150px;
			font-family: 'OSWALD';
			font-size: 12pt;
			font-weight: bold;
		}
*/	
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
			height: 23px;
			font-size:12pt;
			margin-bottom: 2px;
			padding-left: 10px;
		}

		.titulo a {
			text-decoration: none;
			font-size: 14pt;
		}

		.titulo a:visited {
			color:white;
		}
		
		.detalle {
			font-size: 11pt;
		}

		.detalle input{
			font-size: 11pt;
			width: 200px;
			font-family: 'Segoe';
		}

		.detalle select{
			font-size: 11pt;
			width: 200px;
		}

		.paciente {
			font-size:11pt;
			float:left;
		}

		.pagos {
			height:20px;
			font-size: 11pt;
			width:60px;
		}

		.izq {
			width: 120px;
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

		</style>
		<script>
			$(document).ready(function() {

				$(".data").click(function() { 
					var id = $(this).attr("id");

					if ($("#detail_"+id).is(":hidden")) {
						$('[id^="detail_"]').hide(); 
						$("#detail_"+id).show();
						
						//$("#detalles_*").;
					} 
					else {
						$("#detail_"+id).show();
					}		
				});

				$(".save").click(function() {
					var id = $(this).attr("id");
					//alert(id);
					$("#myform_"+id).submit();
				});
			});
		</script>
	</head>
	<body>

		<div class = "titulo">
			<a href = "<?php echo base_url('index.php')?>">Volver</a>
		</div>
		<div style = "border-bottom:1px solid;height:80px;margin-bottom:5px">
			<form id = "form_cirugia" name = "form_cirugia" action="<?php echo base_url('index.php/main/agenda_cirugias')?>" method="post">
				<div style ="float:left;margin-left:10px">
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
				<div style ="float:left;margin-left:20px;margin-right:250px">
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
				<div style ="float:left;margin-left:20px;margin-top:15px">
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
				</div>
				<div style ="float:left;margin-left:30px;margin-top:15px">
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
				<div style ="float:left;margin-left:30px;margin-right:100px;margin-top:15px">
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
					Desde: <input style = "font-size: 11pt;width:150px" id = "fecha_desde" name = "fecha_desde" type = "date" value = "<?php echo $fecha_desde?>" required/>
				</div>
				<div style ="float:left;margin-left:20px;margin-top:15px">
					Hasta: <input style = "font-size: 11pt;width:150px" id = "fecha_hasta" name = "fecha_hasta" type = "date" value = "<?php echo $fecha_hasta?>" required/>
				</div>	
				<div style ="float:left;margin-left:20px;margin-top:15px">
					<button style = "font-size: 12pt" type = "submit"> Buscar </button>
				</div>
			</form>
		</div>
		<?php if (isset($resultado)) 
			if ($resultado == null)
					echo "No hay datos";
			else {	
		?>
			<div style = "float:left">
				<table>
					<th style = "width:60px">
						Ficha
					</th>
					<th style = "width:200px">
						Paciente
					</th>
					<th style = "width:200px">
						Obra Social
					</th>
					<th style = "width:150px">
						Practica
					</th>
					<th style = "width:70px">
						Ojo
					</th>
					<th style = "width:100px">
						Fecha Cirugia
					</th>
					<th style = "width:50px">
						Confirmado
					</th>
					<tr>
					</tr>
				</table>
				<?php foreach ($resultado as $value) { ?>

					<div class = "data" id = "<?php echo $value->id?>" style = "border:1px solid #E5E5E5;background-color:#F7F7F7;height:40px;margin-top:2px;width:99.7%">
						<div style = "width:62px;margin-left:2px" class = "paciente">
							<?php echo $value->id_paciente ?>
						</div>
						<div style = "width:205px;" class = "paciente">
							<?php echo $value->paciente ?>
						</div>
						<div style = "width:202px" class = "paciente">
							<?php echo $value->obra ?>
						</div>
						<div style = "width:153px" class = "paciente">
							<?php echo $value->practica ?>
						</div>
						<div style = "width:75px" class = "paciente">
							<?php echo $value->ojo ?>
						</div>
						<div style = "width:105px" class = "paciente">
							<?php echo $fecha = date('d-m-Y',strtotime($value->fecha_prop)); ?>
						</div>	
						<div class = "paciente">
							<?php echo $value->confirmado; ?>
						</div>
					</div>

				<?php } ?>	
			</div>
			<?php foreach ($resultado as $value) { ?>
			<div class = "detail" id = "<?php echo 'detail_'.$value->id ?>" style = "float:left;margin-left:10px;width:372px">
				<div class = "titulo" style = "text-align:center;">
					Detalles
				</div>
				<div style = "border:1px solid #E5E5E5;background-color:#F7F7F7;float:left">
					<form id = "<?php echo 'myform_'.$value->id?>" action="<?php echo base_url('index.php/main/modificar_cirugia')?>" method="post">
						<table class = "detalle" style = "width:100%">	
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
										<option value = "todos">Todas</option>
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
								<td class = "izq">Práctica:</td>
								<td>
									<select name = "sel_practica" required>
										<?php
											foreach ($tipo_cirugia as $cirugia)
												if ($cirugia->nombre == $value->practica)
													echo '<option selected>'.$cirugia->nombre.'</option>';
												else	
													echo '<option>'.$cirugia->nombre.'</option>';
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td class = "izq">Ojo:</td>
								<td>
									<select id = "ojo" name = "ojo" required>
										<?php
											if ($value->ojo == "AMBOS")
												echo '<option selected>AMBOS</option>';
											else
												echo '<option>AMBOS</option>';

											if ($value->ojo == "OD")
												echo '<option selected>OD</option>';
											else
												echo '<option>OD</option>';

											if ($value->ojo == "OS")
												echo '<option selected>OS</option>';
											else
												echo '<option>OS</option>';
										?>
										<?php 	/*if ($value->selected != "AMBOS")
													echo '<option>AMBOS</option>';
												if ($value->selected != "OD")
													echo '<option>OD</option>';
												if ($value->selected != "OS")
													echo '<option>OS</option>';
												*/	
										?>		
									</select>
								</td>
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
								<td><input id = "presupuesto" name = "presupuesto" value = "<?php echo $value->presupuesto ?>"/></td>
							</tr>
						</table>
							<div style = "float:left;margin-left:5px;margin-top:5px">
								<div style = "float:left">Plus:</div>
								<div style = "float:left;margin-left:106px"><input id = "plus_paciente" name = "plus_paciente" value = "<?php echo $value->plus_paciente ?>" class = "pagos"/></div>
							</div>
							<div style = "margin-left:15px;float:left;margin-top:5px;font-size:11pt">
								<div style = "float:left">Pagado:</div>
								<div style = "float:left;margin-left:8px"><input id = "pagado_paciente" name = "pagado_paciente" value = "<?php echo $value->pagado_paciente ?>" class = "pagos"/></div>
							</div>
							<div style = "float:left;margin-left:5px;margin-top:5px;font-size:11pt">
								<div style = "float:left">Imp. Obra Social:</div>
								<div style = "float:left;margin-left:29px"><input id = "paga_obra" name = "paga_obra" value = "<?php echo $value->paga_obra ?>" class = "pagos"/></div>
							</div>
							<div style = "margin-left:15px;float:left;margin-top:5px;font-size:11pt">
								<div style = "float:left">Copago:</div>
								<div style = "float:left;margin-left:5px"><input id = "coseguro_paciente" name = "coseguro_paciente" value = "<?php echo $value->coseguro_paciente ?>" class = "pagos"/></div>
							</div>
						<table class = "detalle" style = "width:100%;margin-top:5px;float:left">
							<tr>
								<td class = "izq">Fecha cirugía</td>
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
						<div style = "margin-left:5px;margin-top:5px;float:left;font-size:11pt">
							<div style = "float:left">Observaciones:</div>
							<div style = "float:left;margin-left:38px">
								<textarea id = "obs" name = "obs" style = "width:200px;height:100px;margin-top:7px;font-size:12pt"><?php echo $value->obs ?></textarea>
							</div>
						</div>
						<div style = "float:left;width:100%;text-align:center;margin-top:20px;margin-bottom:10px">
							<a id = "<?php echo $value->id ?>" class = "save" href = "#">Guardar Cambios</a>
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
		}
		?>		
	</body>
</html>		