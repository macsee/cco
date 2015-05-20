<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Facturación</title>
		<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
		<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
		<style>
			body {
				font-family: 'OSWALD';
			}
			table {
				border-collapse: collapse;
			}

			th {
				width: 90px;
				background-color: #454545;
				color: white;
			}

			tr {
				border-bottom: 1px solid;
			}

			table input {
				width: 50px;
				font-size: 11pt;
				margin-left: 20px;
			}

			.titulo {
				background-color: #454545;
				color: white;
				font-family: 'OSWALD';
				height: 25px;
				margin-bottom: 10px;
				padding-left: 10px;
			}

			.titulo a {
				text-decoration: none;
				font-size: 14pt;
			}

			.titulo a:visited {
				color:white;
			}

			.totales {
				//background-color: #454545;
				background-color: #63C2D8;
				font-size: 12pt;
				margin-top: 10px;
				height: 25px;
				color: white;
			}

			.invisible {
				border:none;
				text-align: center;
				font-family: 'OSWALD';
			}

			.listado th {
				width: 200px;
			}

			.listado table {
				border-collapse: collapse;
			}

			.listado td {
				border-left: 1px solid;
			}

		</style>
		<script type="text/javascript">
			$(document).ready( function() {

					var total = 0;

					$("#valor_cvc").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_cvc").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);	
	        			$("#subtotal_cvc").val(subtotal);

	        		 })

					$("#valor_iol").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_iol").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_iol").val(subtotal);

	        		})

	        		$("#valor_topo").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_topo").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_topo").val(subtotal);
        			
	        		})

	        		$("#valor_oct").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_oct").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_oct").val(subtotal);

	        		})

	        		$("#valor_me").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_me").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_me").val(subtotal);
	        			
	        		})

	        		$("#valor_rfgc").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_rfgc").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_rfgc").val(subtotal);
	        			
	        		})

	        		$("#valor_rfg").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_rfg").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_rfg").val(subtotal);
	        			
	        		})

	        		$("#valor_hrt").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_hrt").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_hrt").val(subtotal);
	        			
	        		})

	        		$("#valor_laser").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_laser").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_laser").val(subtotal);
	        			
	        		})

	        		$("#valor_yag").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_yag").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_yag").val(subtotal);
	        			
	        		})

	        		$("#valor_obi").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_obi").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_obi").val(subtotal);
	        			
	        		})

	        		$("#valor_paqui").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_paqui").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_paqui").val(subtotal);
	        			
	        		})

	        		$("#valor_consulta").keyup(function() {
	        			val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#cant_consulta").val());

	        			if (!$.isNumeric(val1))
	        					val1 = 0;

	        			subtotal = parseFloat(val1*val2);
	        			$("#subtotal_consulta").val(subtotal);
	        		});

	        		$("#subtotal_iol").change(function() {
						val1 = parseFloat($(this).val());
	  					val2 = parseFloat($("#subtotal_cvc").val());

	  					$("#total").val(2);			
	        		});
			});		
		</script>
	</head>

	<body>

	<?php
	
		class objetoTurnos {
			public $cant;
			public $coseg;

			function  __construct($val1,$val2) {
   			 	$this->cant = $val1;
   			 	$this->coseg = $val2;
  			}
		}

		class objetoArrays {
			public $paciente;
			public $practicas;

			function  __construct($val1,$val2) {
   			 	$this->paciente = $val1;
   			 	$this->practicas = $val2;
  			}
		}

		function crear_objeto() {
			
			$array['cvc'] = new objetoTurnos(0,0);
			$array['iol'] = new objetoTurnos(0,0);
			$array['topo'] = new objetoTurnos(0,0);
			$array['me'] = new objetoTurnos(0,0);
			$array['oct'] = new objetoTurnos(0,0);
			$array['hrt'] = new objetoTurnos(0,0);
			$array['rfg'] = new objetoTurnos(0,0);
			$array['rfgc'] = new objetoTurnos(0,0);
			$array['obi'] = new objetoTurnos(0,0);
			$array['paqui'] = new objetoTurnos(0,0);
			$array['consulta'] = new objetoTurnos(0,0);
			$array['laser'] = new objetoTurnos(0,0);
			$array['yag'] = new objetoTurnos(0,0);

			return $array;
			
		}

		function count_turnos_obra($json,$obra,$array) {
			
			$chk_ord = "";

			if (isset($json->chk_ord))
				$chk_ord = $json->chk_ord;

			if ($obra == "todos") {
				if ($json->cvc != "" && strpos($chk_ord, "ord_cvc") === false) {
					$array['cvc']->cant++;
					$array['cvc']->coseg += intval($json->cvc_coseguro);
				}	

				if ($json->iol != "" && strpos($chk_ord, "ord_iol") === false) {
					$array['iol']->cant++;
					$array['iol']->coseg += intval($json->iol_coseguro);
				}	

				if ($json->topo != "" && strpos($chk_ord, "ord_topo") === false) {
					$array['topo']->cant++;
					$array['topo']->coseg += intval($json->topo_coseguro);
				}	

				if ($json->oct != "" && strpos($chk_ord, "ord_oct") === false) {
					$array['oct']->cant++;
					$array['oct']->coseg += intval($json->oct_coseguro);
				}	

				if ($json->hrt != "" && strpos($chk_ord, "ord_hrt") === false) {
					$array['hrt']->cant++;
					$array['hrt']->coseg += intval($json->hrt_coseguro);
				}	

				if ($json->me != "" && strpos($chk_ord, "ord_me") === false) {
					$array['me']->cant++;
					$array['me']->coseg += intval($json->me_coseguro);
				}	

				if ($json->rfg != "" && strpos($chk_ord, "ord_rfg") === false) {
					$array['rfg']->cant++;
					$array['rfg']->coseg += intval($json->rfg_coseguro);
				}	

				if ($json->rfgc != "" && strpos($chk_ord, "ord_rfgc") === false) {
					$array['rfgc']->cant++;
					$array['rfgc']->coseg += intval($json->rfgc_coseguro);
				}	
					
				if ($json->obi != "" && strpos($chk_ord, "ord_obi") === false) {
					$array['obi']->cant++;
					$array['obi']->coseg += intval($json->obi_coseguro);
				}	
					
				if ($json->paqui != "" && strpos($chk_ord, "ord_paqui") === false) {
					$array['paqui']->cant++;
					$array['paqui']->coseg += intval($json->paqui_coseguro);
				}	
					
				if ($json->consulta != "" && strpos($chk_ord, "ord_consulta") === false) {
					$array['consulta']->cant++;
					$array['consulta']->coseg += intval($json->consulta_coseguro);
				}	
				
				if ($json->laser != "" && strpos($chk_ord, "ord_laser") === false) {
					$array['laser']->cant++;
					$array['laser']->coseg += intval($json->laser_coseguro);
				}	
					
				if ($json->yag != "" && strpos($chk_ord, "ord_yag") === false) {
					$array['yag']->cant++;
					$array['yag']->coseg += intval($json->yag_coseguro);
				}	
			}
			else {

				if ($json->cvc == $obra && strpos($chk_ord, "ord_cvc") === false)
					$array['cvc']->cant++;

				if ($json->iol == $obra && strpos($chk_ord, "ord_iol") === false)
					$array['iol']->cant++;
						
				if ($json->topo == $obra && strpos($chk_ord, "ord_topo") === false)
					$array['topo']->cant++;

				if ($json->oct == $obra && strpos($chk_ord, "ord_oct") === false)
					$array['oct']->cant++;

				if ($json->hrt == $obra && strpos($chk_ord, "ord_hrt") === false)
					$array['hrt']->cant++;

				if ($json->me == $obra && strpos($chk_ord, "ord_me") === false)
					$array['me']->cant++;

				if ($json->rfg == $obra && strpos($chk_ord, "ord_rfg") === false)
					$array['rfg']->cant++;

				if ($json->rfgc == $obra && strpos($chk_ord, "ord_rfgc") === false)
					$array['rfgc']->cant++;
					
				if ($json->obi == $obra && strpos($chk_ord, "ord_obi") === false)
					$array['obi']->cant++;
					
				if ($json->paqui == $obra && strpos($chk_ord, "ord_paqui") === false)
					$array['paqui']->cant++;
					
				if ($json->consulta == $obra && strpos($chk_ord, "ord_consulta") === false)
					$array['consulta']->cant++;
				
				if ($json->laser == $obra && strpos($chk_ord, "ord_laser") === false)
					$array['laser']->cant++;
					
				if ($json->yag == $obra && strpos($chk_ord, "ord_yag") === false)
					$array['yag']->cant++;
			}

			return $array;

		}
		
		function pacientes_sin_orden($json,$value,$pacientes) {
			$chk_ord = "";
			$cadena = "";

			if (isset($json->chk_ord))
				$chk_ord = $json->chk_ord;

			if 	( strpos($chk_ord, "ord_cvc") !== false ) {
				$paciente = $value;
				$cadena .= "CVC,";
			}	

			if ( strpos($chk_ord, "ord_iol") !== false ) {
				$paciente = $value;
				$cadena .= "IOL,";
			}

			if ( strpos($chk_ord, "ord_topo") !== false ) {
				$paciente = $value;
				$cadena .= "TOPO,";
			}

			if ( strpos($chk_ord, "ord_oct") !== false ) {
				$paciente = $value;
				$cadena .= "OCT,";
			}

			if ( strpos($chk_ord, "ord_hrt") !== false ) {
				$paciente = $value;
				$cadena .= "HRT,";
			}

			if ( strpos($chk_ord, "ord_me") !== false ) {
				$paciente = $value;
				$cadena .= "ME,";
			}
			
			if ( strpos($chk_ord, "ord_rfg") !== false ) {
				$paciente = $value;
				$cadena .= "RFG,";
			}

			if ( strpos($chk_ord, "ord_rfgc") !== false ) {
				$paciente = $value;
				$cadena .= "RFG Color,";
			}

			if ( strpos($chk_ord, "ord_obi") !== false) {
				$paciente = $value;
				$cadena .= "OBI,";
			}
			
			if ( strpos($chk_ord, "ord_paqui") !== false ) {
				$paciente = $value;
				$cadena .= "PAQUI,";
			}
			
			if ( strpos($chk_ord, "ord_laser") !== false ) {
				$paciente = $value;
				$cadena += "Laser,";
			}
			
			if ( strpos($chk_ord, "ord_yag") !== false ) {
				$paciente = $value;
				$cadena += "YAG,";
			}
			
			if ( strpos($chk_ord, "ord_consulta") !== false ) {
				$paciente = $value;
				$cadena += "Consulta,";
			}

			$cadena = rtrim($cadena, ",");

			if ($cadena != "")
				array_push($pacientes, new objetoArrays($paciente, $cadena));

			return $pacientes;
		}

	?>	
		<div class = "titulo">
			<a href = "<?php echo base_url('index.php')?>">Volver</a>
		</div>
		<div> 
			<form id = "form_facturacion" name = "form_facturacion" action="<?php echo base_url('index.php/main/facturacion')?>" method="post">
				<div style ="float:left;margin-left:20px">
					Obra Social:
					<select style = "font-size: 12pt" = "sel_obra" name="sel_obra">
						<option value = "todos">Todas</option>
						<?php
							if (!isset($obra_selected))
								$obra_selected = "";

							foreach ($obras as $obra)
								if ($obra->obra == $obra_selected)									
									echo '<option value ='.$obra->obra.' selected>'.$obra->obra.'</option>';
								else
									echo '<option value ='.$obra->obra.'>'.$obra->obra.'</option>';
						?>
					</select>
				</div>
				<div style ="float:left;margin-left:20px">
					Medico:
					<select style = "font-size: 12pt" id = "sel_medico" name="sel_medico">
						<option value = "todos">Todos</option>
						<?php
							if (!isset($medico_selected))
									$medico_selected = "";

							foreach ($medicos as $medico)
								if ($medico_selected == $medico->id_medico)
									echo '<option value ='.$medico->id_medico.' selected>'.$medico->nombre.'</option>';
								else
									echo '<option value ='.$medico->id_medico.'>'.$medico->nombre.'</option>';
						?>
					</select>
				</div>
				<div style ="float:left;margin-left:20px">
					Localidad:
					<select style = "font-size: 12pt" id = "sel_localidad" name="sel_localidad">
						<?php 	if (!isset($localidad_selected)) {
									echo '<option value = "Rosario" selected>Rosario</option>';
									echo '<option value = "Villa Constitucion">Villa Constitución</option>';
								}	
								else
									if ($localidad_selected == "Rosario") {
										echo '<option value = "Rosario" selected>Rosario</option>';
										echo '<option value = "Villa Constitucion">Villa Constitución</option>';
									}	
									else {
										echo '<option value = "Rosario">Rosario</option>';
										echo '<option value = "Villa Constitucion" selected>Villa Constitución</option>';
									}	
						?>
					</select>
				</div>
				<div style ="float:left;margin-left:20px">
					<?php 
						if (!isset($fecha_desde))
							$fecha_desde = "";

						if (!isset($fecha_hasta))
							$fecha_hasta = "";
					?>
					Desde: <input style = "font-size: 11pt" id = "fecha_desde" name = "fecha_desde" type = "date" value = "<?php echo $fecha_desde?>"/>
				</div>
				<div style ="float:left;margin-left:20px">
					Hasta: <input style = "font-size: 11pt" id = "fecha_hasta" name = "fecha_hasta" type = "date" value = "<?php echo $fecha_hasta?>"/>
				</div>	
				<div style ="float:left;margin-left:20px">
					<button style = "font-size: 12pt" type = "submit"> Buscar </button>
				</div>
			</form>
		</div>
		<!--RESULTADO DE PACIENTES CON ORDENES-->
		<div style = "border-top:1px solid;float:left;width: 100%;margin-top:10px;">
			<?php
				$pacientes = array();
			
				if (isset($resultado)) {
					if ($resultado == null)
						echo "No hay datos";
					else {
						$array = crear_objeto();
						$total_coseguro = 0;

						echo '<div style = "float:left;width: 61%;border-bottom:1px solid #A9A9A9;margin-top:5px;">';
							echo '<div style = "background-color:#1e3e53;float:left;width:100%;color:white;text-align:center">';
								echo "Pacientes con órdenes";
							echo '</div>';	
							echo '<div style = "float:left;height:394px;overflow-y: scroll;margin-top:2px">';
								echo '<table class = "listado" style = "font-size:11pt;border-bottom:1px solid">';
									echo '<tr>';
			  							echo '<th style = "text-align:left;width:100px">Fecha</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:70px">Ficha</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:250px">Paciente</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:80px">Práctica</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:250px">Obra Social</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid">Médico</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:50px">Coseguro</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:100px">Informe</th>';
									echo '</tr>';

							foreach ($resultado as $value) {
								
								$json = json_decode($value->datos);			
								$array = count_turnos_obra($json,$obra_selected,$array);

								$array_paciente = count_turnos_obra($json,$obra_selected,crear_objeto());
								$flag = 0;

								$ficha = $value->ficha;
								$paciente = $value->paciente;
								$medico = $value->medico;
								$fecha = date('d-m-Y',strtotime($value->fecha));
								$generar = '<a href = "#">Generar</a>';

								$chk_ord = "";

								$pacientes = pacientes_sin_orden($json,$value,$pacientes);

								if ($array_paciente['cvc']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>CVC</td>';
										echo '<td>'.$json->cvc.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['cvc']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['iol']->cant != 0){
									
									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>IOL</td>';
										echo '<td>'.$json->iol.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['iol']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['topo']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>TOPO</td>';
										echo '<td>'.$json->topo.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['topo']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['oct']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>OCT</td>';
										echo '<td>'.$json->oct.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['oct']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['me']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>ME</td>';
										echo '<td>'.$json->me.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['me']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['rfg']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>RFG</td>';
										echo '<td>'.$json->rfg.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['rfg']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['rfgc']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>RFG Color</td>';
										echo '<td>'.$json->rfgc.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['rfgc']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['paqui']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>PAQUI</td>';
										echo '<td>'.$json->paqui.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['paqui']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['obi']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>OBI</td>';
										echo '<td>'.$json->obi.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['obi']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['hrt']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>HRT</td>';
										echo '<td>'.$json->hrt.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['hrt']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['laser']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>Laser</td>';
										echo '<td>'.$json->laser.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['laser']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['yag']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>YAG</td>';
										echo '<td>'.$json->yag.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['yag']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
									
								if ($array_paciente['consulta']->cant != 0){

									if ($flag == 0) {
										$flag = 1;
										echo '<tr style = "border-top:1px solid;border-bottom:none">';
									}	
									else {
										$fecha = "";
										$ficha = "";
										$paciente = "";
										$medico = "";
										$generar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>Consulta</td>';
										echo '<td>'.$json->consulta.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['consulta']->coseg.'</td>';
										echo '<td>'.$generar.'</td>';
									echo '</tr>';
								}
							}
								echo '</table>';
							echo '</div>';
						echo '</div>';
						echo '<div style = "float:left;margin-left:20px;margin-top:5px;width:37%;">';
							echo '<div style = "float:left;width:100%;background-color:#1e3e53;color:white;margin-bottom:2px;text-align:center">';
								echo "Resumen";
							echo '</div>';
							echo '<div style = "float:left">';
								echo '<table style = "font-size:11pt">';
									echo '<tr>';
			  							echo '<th style = "text-align:left">Práctica</th>';
			  							echo '<th style = "border-left:1px solid">Cantidad Total</th>';
			  							echo '<th style = "border-left:1px solid">Importe Práctica</th>';
			  							echo '<th style = "border-left:1px solid">Subtotal</th>';
			  							echo '<th style = "border-left:1px solid">Subtotal Coseg.</th>';
									echo '</tr>';
										echo '<td>CVC</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_cvc" value = "'.$array['cvc']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_cvc" name = "valor_cvc"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_cvc" name = "subtotal_cvc" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['cvc']->coseg.'</td>';
										$total_coseguro += intval($array['cvc']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>IOL</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_iol" value = "'.$array['iol']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_iol" name = "valor_iol"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_iol" name = "subtotal_iol" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['iol']->coseg.'</td>';
										$total_coseguro += intval($array['iol']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>TOPO</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_topo" value = "'.$array['topo']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_topo" name = "valor_topo"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_topo" name = "subtotal_topo" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['topo']->coseg.'</td>';
										$total_coseguro += intval($array['topo']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>OCT</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_oct" value = "'.$array['oct']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_oct" name = "valor_oct"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_oct" name = "subtotal_oct" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['oct']->coseg.'</td>';
										$total_coseguro += intval($array['oct']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>ME</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_me" value = "'.$array['me']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_me" name = "valor_me"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_me" name = "subtotal_me" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['me']->coseg.'</td>';
										$total_coseguro += intval($array['me']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>RFG Color</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_rfgc" value = "'.$array['rfgc']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_rfgc" name = "valor_rfgc"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_rfgc" name = "subtotal_rfgc" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['rfgc']->coseg.'</td>';
										$total_coseguro += intval($array['rfgc']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>RFG</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_rfg" value = "'.$array['rfg']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_rfg" name = "valor_rfg"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_rfg" name = "subtotal_rfg" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['rfg']->coseg.'</td>';
										$total_coseguro += intval($array['rfg']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>HRT</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_hrt" value = "'.$array['hrt']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_hrt" name = "valor_hrt"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_hrt" name = "subtotal_hrt" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['hrt']->coseg.'</td>';
										$total_coseguro += intval($array['hrt']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>Laser</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_laser" value = "'.$array['laser']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_laser" name = "valor_laser"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_laser" name = "subtotal_laser" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['laser']->coseg.'</td>';
										$total_coseguro += intval($array['laser']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>YAG</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_yag" value = "'.$array['yag']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_yag" name = "valor_yag"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_yag" name = "subtotal_yag" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['yag']->coseg.'</td>';
										$total_coseguro += intval($array['yag']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>OBI</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_obi" value = "'.$array['obi']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_obi" name = "valor_obi"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_obi" name = "subtotal_obi" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['obi']->coseg.'</td>';
										$total_coseguro += intval($array['obi']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>PAQUI</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_paqui" value = "'.$array['paqui']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_paqui" name = "valor_paqui"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_paqui" name = "subtotal_paqui" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['paqui']->coseg.'</td>';
										$total_coseguro += intval($array['paqui']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>Consulta</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_consulta" value = "'.$array['consulta']->cant.'" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_consulta" name = "valor_consulta"/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_consulta" name = "subtotal_consulta" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['consulta']->coseg.'</td>';
										$total_coseguro += intval($array['consulta']->coseg);
									echo '</tr>';
								echo '</table>';
								echo '<div class = "totales">';
									echo '<div style = "margin-left:10px;float:left">';
										echo '<div style = "float:left;width:50px">Total: </div><input style = "width:70px;font-size:12pt;background-color: #63C2D8" class = "invisible" id = "total" disabled/>';
									echo '</div>';
									echo '<div style = "float:left">';
										echo "Coseguro Total: $ ".$total_coseguro;
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div style = "float:left;width:61%">';
							echo '<div style = "float:left;background-color:#1e3e53;width:100%;margin-top:10px;margin-bottom:2px;color:white;text-align:center">';
								echo "Pacientes que deben ordenes";
							echo '</div>';
								if (count($pacientes) == 0)
										echo "No hay pacientes que deban ordenes para los datos seleccionados";
									else {
										foreach ($pacientes as $value) {
											echo '<table class = "listado" style = "font-size:11pt;border-bottom:1px solid">';
												echo '<tr>';
						  							echo '<th style = "text-align:left;width:100px">Fecha</th>';
						  							echo '<th style = "text-align:left;border-left:1px solid;width:70px">Ficha</th>';
						  							echo '<th style = "text-align:left;border-left:1px solid;">Paciente</th>';
						  							echo '<th style = "text-align:left;border-left:1px solid;">Práctica</th>';
						  							echo '<th style = "text-align:left;border-left:1px solid">Médico</th>';
												echo '</tr>';
												echo '<tr>';
													echo '<td style = "border-left:none;">'.date('d-m-Y',strtotime($value->paciente->fecha)).'</td>';
													echo '<td>'.$value->paciente->ficha.'</td>';
													echo '<td>'.$value->paciente->paciente.'</td>';
													echo '<td>'.$value->practicas.'</td>';
													echo '<td>'.$value->paciente->medico.'</td>';
												echo '</tr>';
											echo '</table>';
										}	
									}
						echo '</div>';
					}	
				}
			?>
		</div>
	</body>
</html>	