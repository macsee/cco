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
				height: 35px;
				margin-bottom: 10px;
				padding-left: 10px;
			}

			.titulo a {
				text-decoration: none;
				font-size: 17pt;
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

			.confirm_tabla {
				font-size: 10pt;
			}

			.confirm_tabla td {
				width: 100px;
			}

			#confirmar_datos select {
				width: 120px;
				font-size: 10pt;
			}

			#confirmar_datos tr {
				border: none;
			}

			#confirmar_datos input {
				width: 10px;
				margin-left: 0px
			}


		</style>
		<script type="text/javascript">
			$(document).ready( function() {

					$('input[name="chk_turno[]"]').change(function(event) {
			      		// State has changed to checked/unchecked.
			      		var id = $(this).attr("id");
			      		var tipo = id.substring(0, id.indexOf("_"));

			      		if ($(this).prop("checked") == false) {
							$("#sel_"+tipo).prop('disabled', true);
							$("#coseguro_"+tipo).prop('disabled', true);
							$("#"+tipo+"_ord_chk").prop('disabled', true);	
						}
						else {
							$("#sel_"+tipo).removeAttr('disabled');
							$("#coseguro_"+tipo).removeAttr('disabled');
							$("#"+tipo+"_ord_chk").removeAttr('disabled');
						}
					});

					$("#print").click(function() {
						var w = window.open("", "_self");
						var html = $("#html").val();
						w.window.document.write(html);
		        		w.window.print();
					});

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

			var checks = ["cvc", "iol", "topo", "me", "oct", "rfgc", "rfg", "hrt", "obi", "paqui", "consulta", "laser", "yag"];        
	
			function clear_all() {

		   		$.each( checks, function( i, val ) {
									
					$("#"+val+"_chk").prop('checked',false);
					$("#sel_"+val).val("");
					$("#coseguro_"+val).val("");
					$("#"+val+"_ord_chk").prop('checked', false);

					$("#sel_"+val).removeAttr('disabled');
					$("#coseguro_"+val).removeAttr('disabled');
					$("#"+val+"_ord_chk").removeAttr('disabled');
				});

				$("#sincargo_chk").prop('checked',false);
		   	};

			function confirmar(id) {

					clear_all();

					var base_url = '<?php echo base_url(); ?>';
					
					var values = {
			        		'id': id,
					};

			    $.ajax({
						type: 'POST',
						url: base_url+"confirmar.php",
						data: values,
						dataType: 'json',
						success:function(response)
						{	

							$("#id_turno").val(id);
							$("#ficha_fact").val(response["ficha"]);
							$("#fecha_fact").val(response["fecha"]);
							$("#apellido_fact").val(response["apellido"]);
							$("#nombre_fact").val(response["nombre"]);
							$("#obra_turno").val(response["obra_social"]);
							//$("#nombreApellido").html(response["apellido"]+", "+response["nombre"]);

							//$("#nombreApellido").html(id);

							//$("#ficha").html(response["ficha"]);
							$("#sel_estado").val(response["estado"]);

							$("#sel_facturacion").val(response["fact_localidad"]);
							$("#sel_atendido").val(response["at_localidad"]);
							//$("#sel_localidad").val(response["localidad"]);

							$("#medico_fact").html(response["medico"]);
							$("#sel_medico_").val(response["medico"]);

							$("#obra_sel").val($("#sel_obra").val());							
							/*
							$("#sel_medico option").filter(function() {
							    return this.text == response["medico"]; 
							}).attr('selected', true);
							*/
						
							var json = JSON.parse(response['tipo']);
							var orden = JSON.parse(response['orden']);

							$.each( checks, function( i, val ) {
								
								if (json[val] != "") {
									$("#"+val+"_chk").prop('checked',true);
									$("#sel_"+val).val(json[val]);
									$("#coseguro_"+val).val(json[val+"_coseguro"]);
									if (orden != null)
										$("#"+val+"_ord_chk").prop('checked', orden[val+"_orden"] == "SI");
								}	
								else {
									$("#sel_"+val).prop('disabled', true);
									$("#coseguro_"+val).prop('disabled', true);
									$("#"+val+"_ord_chk").prop('disabled', true);
								}
								
							});
							
							$("#sincargo_chk").prop('checked',json.sin_cargo != "");

						},
				});
					
			    $( "#confirmar_datos" ).dialog({
					autoOpen: true,
			        resizable: false,
					width: 1200,
			        height: 500,
			        modal: true,
			        buttons: {
			        	"Eliminar": function() {
			        		var url = '<?php echo base_url("index.php/main"); ?>';
			        		var id = $("#id_turno").val();
			        		var x = url+"/borrar_facturacion/"+id;
			        		location.href = x;
			                //$( this ).dialog( "close" );
						},
			            "Confirmar": function() {
							$("#form_facturacion_edit").submit();
			            },
						"Cancelar": function() {
			                $( this ).dialog( "close" );
						}
			        }
			    });
			    
			};

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

		function count_turnos_obra($json,$json_obra,$obra,$array) {
			

			$json_obra = json_decode(json_encode($json_obra), true);

			if ($obra == "todos") {

				if ($json->cvc != "" && $json_obra['cvc_orden'] != "SI") {
					$array['cvc']->cant++;
					$array['cvc']->coseg += intval($json->cvc_coseguro);
				}

				if ($json->iol != "" && $json_obra['iol_orden'] != "SI") {
					$array['iol']->cant++;
					$array['iol']->coseg += intval($json->iol_coseguro);
				}

				if ($json->topo != "" && $json_obra['topo_orden'] != "SI") {
					$array['topo']->cant++;
					$array['topo']->coseg += intval($json->topo_coseguro);
				}

				if ($json->oct != "" && $json_obra['oct_orden'] != "SI") {
					$array['oct']->cant++;
					$array['oct']->coseg += intval($json->oct_coseguro);
				}	

				if ($json->hrt != "" && $json_obra['hrt_orden'] != "SI") {
					$array['hrt']->cant++;
					$array['hrt']->coseg += intval($json->hrt_coseguro);
				}	

				if ($json->me != "" && $json_obra['me_orden'] != "SI") {
					$array['me']->cant++;
					$array['me']->coseg += intval($json->me_coseguro);
				}	

				if ($json->rfg != "" && $json_obra['rfg_orden'] != "SI") {
					$array['rfg']->cant++;
					$array['rfg']->coseg += intval($json->rfg_coseguro);
				}	

				if ($json->rfgc != "" && $json_obra['rfgc_orden'] != "SI") {
					$array['rfgc']->cant++;
					$array['rfgc']->coseg += intval($json->rfgc_coseguro);
				}	
					
				if ($json->obi != "" && $json_obra['obi_orden'] != "SI") {
					$array['obi']->cant++;
					$array['obi']->coseg += intval($json->obi_coseguro);
				}	
					
				if ($json->paqui != "" && $json_obra['paqui_orden'] != "SI") {
					$array['paqui']->cant++;
					$array['paqui']->coseg += intval($json->paqui_coseguro);
				}	
					
				if ($json->consulta != "" && $json_obra['consulta_orden'] != "SI") {
					$array['consulta']->cant++;
					$array['consulta']->coseg += intval($json->consulta_coseguro);
				}	
				
				if ($json->laser != "" && $json_obra['laser_orden'] != "SI") {
					$array['laser']->cant++;
					$array['laser']->coseg += intval($json->laser_coseguro);
				}	
					
				if ($json->yag != "" && $json_obra['yag_orden'] != "SI") {
					$array['yag']->cant++;
					$array['yag']->coseg += intval($json->yag_coseguro);
				}
						
			}
			else {

				if ($json->cvc == $obra && $json_obra['cvc_orden'] != "SI")
					$array['cvc']->cant++;

				if ($json->iol == $obra && $json_obra['iol_orden'] != "SI")
					$array['iol']->cant++;
						
				if ($json->topo == $obra && $json_obra['topo_orden'] != "SI")
					$array['topo']->cant++;

				if ($json->oct == $obra && $json_obra['oct_orden'] != "SI")
					$array['oct']->cant++;

				if ($json->hrt == $obra && $json_obra['hrt_orden'] != "SI")
					$array['hrt']->cant++;

				if ($json->me == $obra && $json_obra['me_orden'] != "SI")
					$array['me']->cant++;

				if ($json->rfg == $obra && $json_obra['rfg_orden'] != "SI")
					$array['rfg']->cant++;

				if ($json->rfgc == $obra && $json_obra['rfgc_orden'] != "SI")
					$array['rfgc']->cant++;
					
				if ($json->obi == $obra && $json_obra['obi_orden'] != "SI")
					$array['obi']->cant++;
					
				if ($json->paqui == $obra && $json_obra['paqui_orden'] != "SI")
					$array['paqui']->cant++;
					
				if ($json->consulta == $obra && $json_obra['consulta_orden'] != "SI")
					$array['consulta']->cant++;
				
				if ($json->laser == $obra && $json_obra['laser_orden'] != "SI")
					$array['laser']->cant++;
					
				if ($json->yag == $obra && $json_obra['yag_orden'] != "SI")
					$array['yag']->cant++;
			}
			
			return $array;

		}
		
		function pacientes_sin_orden($json,$value,$pacientes) {
			//$chk_ord = "";
			$cadena = "";

			$json = json_decode(json_encode($json), true);

			if ($json['cvc_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "CVC,";
			}

			if ($json['iol_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "IOL,";
			}

			if ($json['topo_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "TOPO,";
			}

			if ($json['rfg_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "RFG,";
			}

			if ($json['rfgc_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "RFG Color,";
			}

			if ($json['hrt_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "HRT,";
			}

			if ($json['oct_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "OCT,";
			}

			if ($json['obi_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "OBI,";
			}

			if ($json['paqui_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "PAQUI,";
			}

			if ($json['laser_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "Laser,";
			}

			if ($json['yag_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "YAG,";
			}

			if ($json['consulta_orden'] == "SI") {
				$paciente = $value;
				$cadena .= "Consulta,";
			}

			$cadena = rtrim($cadena, ",");
			

			if ($cadena != "")
				array_push($pacientes, new objetoArrays($paciente, $cadena));

			return $pacientes;
		}

	?>	
		<div class = "titulo">
			<?php
				echo '<a href = "'.base_url('index.php').'">';
					echo '<img src = "'.base_url('css/images/arrow_left_24x24.png').'" style = "margin-right:10px;margin-top:5px"/>';
					echo "Volver";
				echo '</a>';	
			?>	
		</div>
		<div> 
			<form id = "form_facturacion" name = "form_facturacion" action="<?php echo base_url('index.php/main/facturacion')?>" method="post">
				<div style = "width:100%;float:left">
					<div style ="float:left;margin-left:20px">
						Obra Social:
						<select style = "font-size: 12pt" id = "sel_obra" name="sel_obra">
							<option value = "todos">Todas</option>
							<?php
								if (!isset($sel_obra))
									$sel_obra = "";

								foreach ($obras as $obra)
									if ($obra->obra == $sel_obra)									
										echo '<option value ="'.$obra->obra.'" selected>'.$obra->obra.'</option>';
									else
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
							?>
						</select>
					</div>
					<div style ="float:left;margin-left:50px">
						Medico:
						<select style = "font-size: 12pt" id = "sel_medico" name="sel_medico">
							<option value = "todos">Todos</option>
							<?php
								if (!isset($sel_medico))
										$sel_medico = "";

								foreach ($medicos as $medico)
									if ($sel_medico == $medico->id_medico)
										echo '<option value ='.$medico->id_medico.' selected>'.$medico->nombre.'</option>';
									else
										echo '<option value ='.$medico->id_medico.'>'.$medico->nombre.'</option>';
							?>
						</select>
					</div>
					<div style ="float:left;margin-left:50px">
						Lugar de Facturación:
						<select style = "font-size: 12pt" id = "sel_facturacion_barra" name="sel_facturacion_barra">
							<?php 	
									if (!isset($sel_facturacion_barra))
										$sel_facturacion_barra = "";

									echo "<option>Todas</option>";
									foreach ($localidades as $loc) {
										if ($loc->id_localidad == $sel_facturacion_barra)
											echo '<option value = "'.$loc->id_localidad.'" selected>'.$loc->nombre.'</option>';
										else
											echo '<option value = "'.$loc->id_localidad.'">'.$loc->nombre.'</option>';
									}

							?>
						</select>
					</div>
					<div style ="float:left;margin-left:50px">
						Lugar de Atención:
						<select style = "font-size: 12pt" id = "sel_atendido_barra" name="sel_atendido_barra">
							<?php 	
									if (!isset($sel_atendido_barra))
										$sel_atendido_barra = "";

									echo "<option>Todas</option>";
									foreach ($localidades as $loc) {
										if ($loc->id_localidad == $sel_atendido_barra)
											echo '<option value = "'.$loc->id_localidad.'" selected>'.$loc->nombre.'</option>';
										else
											echo '<option value = "'.$loc->id_localidad.'">'.$loc->nombre.'</option>';
									}

							?>
						</select>
					</div>
				</div>
				<div style = "width:100%;float:left;margin-top:10px">	
					<div style ="float:left;margin-left:20px">
						<?php 
							if (!isset($fecha_desde))
								$fecha_desde = "";

							if (!isset($fecha_hasta))
								$fecha_hasta = "";
						?>
						Desde: <input style = "font-size: 11pt" id = "fecha_desde" name = "fecha_desde" type = "date" value = "<?php echo $fecha_desde?>" required/>
					</div>
					<div style ="float:left;margin-left:20px">
						Hasta: <input style = "font-size: 11pt" id = "fecha_hasta" name = "fecha_hasta" type = "date" value = "<?php echo $fecha_hasta?>" required/>
					</div>	
					<div style ="float:left;margin-left:20px">
						<button style = "font-size: 12pt" type = "submit"> Buscar </button>
						<?php 
							if (!isset($print))
								$print = "";

							if ($print != "") {?>
								<button id = "print" style = "font-size: 12pt"> Imprimir </button>
						<?php }?>
					</div>
					<input id = "html" type = "hidden" value = "<?php echo $print ?>" />
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

						echo '<div style = "float:left;width: 78%;border-bottom:1px solid #A9A9A9;margin-top:5px;">';
							echo '<div style = "background-color:#1e3e53;float:left;width:100%;color:white;text-align:center">';
								echo "Pacientes con órdenes";
							echo '</div>';	
							echo '<div style = "float:left;height:394px;overflow-y: scroll;margin-top:2px">';
								echo '<table class = "listado" style = "font-size:11pt;border-bottom:1px solid">';
									echo '<tr>';
			  							echo '<th style = "text-align:left;width:80px">Fecha</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:70px">Ficha</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:250px">Paciente</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:80px">Práctica</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:250px">Obra Social</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid">Médico</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:50px">Coseguro</th>';
			  							echo '<th style = "text-align:left;border-left:1px solid;width:120px">Acción</th>';
									echo '</tr>';

							foreach ($resultado as $value) {
								
								$json = json_decode($value->datos);
								$json_orden = json_decode($value->ordenes_pendientes);

								$array = count_turnos_obra($json,$json_orden,$sel_obra,$array);

								$array_paciente = count_turnos_obra($json,$json_orden,$sel_obra,crear_objeto());
								$flag = 0;

								$ficha = $value->ficha;
								$paciente = $value->paciente;
								$medico = $value->medico;
								$fecha = date('d-m-Y',strtotime($value->fecha));
								$generar = '<a href = "#">Generar</a>';
								$modificar = '<a href = "#" onclick = "return confirmar(\''.$value->id_turno.'\')">Editar</a>';

								$chk_ord = "";

								$pacientes = pacientes_sin_orden($json_orden,$value,$pacientes);

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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>CVC</td>';
										echo '<td>'.$json->cvc.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['cvc']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>IOL</td>';
										echo '<td>'.$json->iol.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['iol']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										$modificar = "";
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>TOPO</td>';
										echo '<td>'.$json->topo.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['topo']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>OCT</td>';
										echo '<td>'.$json->oct.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['oct']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>ME</td>';
										echo '<td>'.$json->me.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['me']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>RFG</td>';
										echo '<td>'.$json->rfg.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['rfg']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>RFG Color</td>';
										echo '<td>'.$json->rfgc.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['rfgc']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>PAQUI</td>';
										echo '<td>'.$json->paqui.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['paqui']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>OBI</td>';
										echo '<td>'.$json->obi.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['obi']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>HRT</td>';
										echo '<td>'.$json->hrt.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['hrt']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>Laser</td>';
										echo '<td>'.$json->laser.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['laser']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>YAG</td>';
										echo '<td>'.$json->yag.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['yag']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
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
										$modificar = "";
										echo '<tr style = "border:none">';
									}
										echo '<td style = "border-left:none">'.$fecha.'</td>';
										echo '<td>'.$ficha.'</td>';
										echo '<td>'.$paciente.'</td>';
										echo '<td>Consulta</td>';
										echo '<td>'.$json->consulta.'</td>';
										echo '<td>'.$medico.'</td>';
										echo '<td>'.$array_paciente['consulta']->coseg.'</td>';
										echo '<td><div style = "float:left;margin-right:10px">'.$generar.'</div><div style = "float:left">'.$modificar.'</div></td>';
									echo '</tr>';
								}
							}
								echo '</table>';
							echo '</div>';
						echo '</div>';
						echo '<div style = "float:left;margin-left:20px;margin-top:5px;width:20%;">';
							echo '<div style = "float:left;width:100%;background-color:#1e3e53;color:white;margin-bottom:2px;text-align:center">';
								echo "Resumen";
							echo '</div>';
							echo '<div style = "float:left">';
								echo '<table style = "font-size:11pt">';
									echo '<tr>';
			  							echo '<th style = "text-align:left">Práctica</th>';
			  							echo '<th style = "border-left:1px solid">Cantidad Total</th>';
			  							//echo '<th style = "border-left:1px solid">Importe Práctica</th>';
			  							//echo '<th style = "border-left:1px solid">Subtotal</th>';
			  							echo '<th style = "border-left:1px solid">Coseguro</th>';
									echo '</tr>';
										echo '<td>CVC</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_cvc" value = "'.$array['cvc']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_cvc" name = "valor_cvc"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_cvc" name = "subtotal_cvc" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['cvc']->coseg.'</td>';
										$total_coseguro += intval($array['cvc']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>IOL</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_iol" value = "'.$array['iol']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_iol" name = "valor_iol"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_iol" name = "subtotal_iol" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['iol']->coseg.'</td>';
										$total_coseguro += intval($array['iol']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>TOPO</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_topo" value = "'.$array['topo']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_topo" name = "valor_topo"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_topo" name = "subtotal_topo" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['topo']->coseg.'</td>';
										$total_coseguro += intval($array['topo']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>OCT</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_oct" value = "'.$array['oct']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_oct" name = "valor_oct"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_oct" name = "subtotal_oct" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['oct']->coseg.'</td>';
										$total_coseguro += intval($array['oct']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>ME</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_me" value = "'.$array['me']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_me" name = "valor_me"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_me" name = "subtotal_me" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['me']->coseg.'</td>';
										$total_coseguro += intval($array['me']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>RFG Color</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_rfgc" value = "'.$array['rfgc']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_rfgc" name = "valor_rfgc"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_rfgc" name = "subtotal_rfgc" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['rfgc']->coseg.'</td>';
										$total_coseguro += intval($array['rfgc']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>RFG</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_rfg" value = "'.$array['rfg']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_rfg" name = "valor_rfg"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_rfg" name = "subtotal_rfg" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['rfg']->coseg.'</td>';
										$total_coseguro += intval($array['rfg']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>HRT</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_hrt" value = "'.$array['hrt']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_hrt" name = "valor_hrt"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_hrt" name = "subtotal_hrt" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['hrt']->coseg.'</td>';
										$total_coseguro += intval($array['hrt']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>Laser</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_laser" value = "'.$array['laser']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_laser" name = "valor_laser"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_laser" name = "subtotal_laser" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['laser']->coseg.'</td>';
										$total_coseguro += intval($array['laser']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>YAG</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_yag" value = "'.$array['yag']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_yag" name = "valor_yag"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_yag" name = "subtotal_yag" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['yag']->coseg.'</td>';
										$total_coseguro += intval($array['yag']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>OBI</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_obi" value = "'.$array['obi']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_obi" name = "valor_obi"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_obi" name = "subtotal_obi" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['obi']->coseg.'</td>';
										$total_coseguro += intval($array['obi']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>PAQUI</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_paqui" value = "'.$array['paqui']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_paqui" name = "valor_paqui"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_paqui" name = "subtotal_paqui" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['paqui']->coseg.'</td>';
										$total_coseguro += intval($array['paqui']->coseg);
									echo '</tr>';
									echo '<tr>';
										echo '<td>Consulta</td>';
										echo '<td style = "border-left:1px solid;text-align:center"><input class = "invisible" id = "cant_consulta" value = "'.$array['consulta']->cant.'" disabled/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "valor_consulta" name = "valor_consulta"/></td>';
										//echo '<td style = "border-left:1px solid;text-align:center">$<input id = "subtotal_consulta" name = "subtotal_consulta" disabled/></td>';
										echo '<td style = "border-left:1px solid;text-align:center">'.$array['consulta']->coseg.'</td>';
										$total_coseguro += intval($array['consulta']->coseg);
									echo '</tr>';
								echo '</table>';
								echo '<div class = "totales">';
									//echo '<div style = "margin-left:10px;float:left">';
									//	echo '<div style = "float:left;width:50px">Total: </div><input style = "width:70px;font-size:12pt;background-color: #63C2D8" class = "invisible" id = "total" disabled/>';
									//echo '</div>';
									echo '<div style = "float:left;margin-left:110px">';
										echo "Coseguro Total: $ ".$total_coseguro;
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div style = "float:left;width:78%">';
							echo '<div style = "float:left;background-color:#1e3e53;width:100%;margin-top:10px;margin-bottom:2px;color:white;text-align:center">';
								echo "Pacientes que deben órdenes";
							echo '</div>';
								if (count($pacientes) == 0)
										echo "No hay pacientes que deban órdenes para los datos seleccionados";
									else {
										echo '<table class = "listado" style = "font-size:11pt;border-bottom:1px solid;width:100%">';
											echo '<tr>';
					  							echo '<th style = "text-align:left;width:100px">Fecha</th>';
					  							echo '<th style = "text-align:left;border-left:1px solid;width:70px">Ficha</th>';
					  							echo '<th style = "text-align:left;border-left:1px solid;">Paciente</th>';
					  							echo '<th style = "text-align:left;border-left:1px solid;">Práctica</th>';
					  							echo '<th style = "text-align:left;border-left:1px solid">Médico</th>';
					  							echo '<th style = "text-align:left;border-left:1px solid">Acción</th>';
											echo '</tr>';
										foreach ($pacientes as $value) {
											echo '<tr>';
												echo '<td style = "border-left:none;">'.date('d-m-Y',strtotime($value->paciente->fecha)).'</td>';
												echo '<td>'.$value->paciente->ficha.'</td>';
												echo '<td>'.$value->paciente->paciente.'</td>';
												echo '<td>'.$value->practicas.'</td>';
												echo '<td>'.$value->paciente->medico.'</td>';
												echo '<td><a href = "#" onclick = "return confirmar(\''.$value->paciente->id_turno.'\')">Editar</a>';
											echo '</tr>';
										}
										echo '</table>';	
									}
						echo '</div>';
					}	
				}
			?>
		</div>



	<div id="confirmar_datos" title="Actualizar datos turno" style = "display:none">
		<form id = "form_facturacion_edit" action="<?php echo base_url('index.php/main/update_facturacion_turno/1')?>" method="post">
			<div style = "float:left;font-weight:bold;margin-right:10px">Paciente:</div><input id = "apellido_fact" name = "apellido_fact" style = "width:150px;float:left;margin-right:20px" required autocomplete="off"/><input id = "nombre_fact" name = "nombre_fact" style = "width:150px;float:left" required autocomplete="off"/>
			<div style = "float:left;font-weight:bold;margin-right:10px;margin-left: 50px">Ficha: </div><input id = "ficha_fact" name = "ficha_fact" style = "width:100px;float:left" required autocomplete="off"/>
			<div style = "float:left;font-weight:bold;margin-right:10px;margin-left: 50px">Fecha: </div><input type = "date" id = "fecha_fact" name = "fecha_fact" style = "width:150px;float:left" required autocomplete="off"/>
			<div style = "float:left;width:100%">
				<div style = "float:left;width:50%">
					<table class= "confirm_tabla" style = "margin-top:40px">
						<tr>
							<td>
								<input id = "cvc_chk" name = "chk_turno[]" value = "CVC" type = "checkbox"/> CVC 			
							</td>
							<td>
								<select id = "sel_cvc" name="sel_cvc">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "cvc_ord_chk" name = "chk_ord[]" value = "ord_cvc" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_cvc" name = "coseguro_cvc" style = "width:40px" autocomplete="off"/>
							</td>
						<tr>
						</tr>	
							<td>
								<input id = "iol_chk" name = "chk_turno[]" value = "IOL" type = "checkbox"/> IOL 			
							</td>
							<td>
								<select id = "sel_iol" name="sel_iol">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "iol_ord_chk" name = "chk_ord[]" value = "ord_iol" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_iol" name = "coseguro_iol" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>	
							<td>
								<input id = "oct_chk" name = "chk_turno[]" value = "OCT" type = "checkbox"/> OCT			
							</td>
							<td>
								<select id = "sel_oct" name="sel_oct">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "oct_ord_chk" name = "chk_ord[]" value = "ord_oct" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_oct" name = "coseguro_oct" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>	
							<td>
								<input id = "me_chk" name = "chk_turno[]" value = "ME" type = "checkbox"/> ME			
							</td>
							<td>
								<select id = "sel_me" name="sel_me">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "me_ord_chk" name = "chk_ord[]" value = "ord_me" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_me" name = "coseguro_me" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>	
							<td>
								<input id = "rfg_chk" name = "chk_turno[]" value = "RFG" type = "checkbox"/> RFG 			
							</td>
							<td>
								<select id = "sel_rfg" name="sel_rfg">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "rfg_ord_chk" name = "chk_ord[]" value = "ord_rfg" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_rfg" name = "coseguro_rfg" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>	
							<td>
								<input id = "rfgc_chk" name = "chk_turno[]" value = "RFG Color" type = "checkbox"/> RFG Color 			
							</td>
							<td>
								<select id = "sel_rfgc" name="sel_rfgc">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "rfgc_ord_chk" name = "chk_ord[]" value = "ord_rfgc" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_rfgc" name = "coseguro_rfgc" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>	
							<td>
								<input id = "consulta_chk" name = "chk_turno[]" value = "Consulta" type = "checkbox"/> Consulta
							</td>
							<td>
								<select id = "sel_consulta" name="sel_consulta">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "consulta_ord_chk" name = "chk_ord[]" value = "ord_consulta" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_consulta" name = "coseguro_consulta" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
					</table>
				</div>
				<div style = "float:left;">	
					<table class= "confirm_tabla" style = "margin-top:40px">
						<tr>
							<td>
								<input id = "hrt_chk" name = "chk_turno[]" value = "HRT" type = "checkbox"/> HRT			
							</td>
							<td>
								<select id = "sel_hrt" name="sel_hrt">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "hrt_ord_chk" name = "chk_ord[]" value = "ord_hrt" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_hrt" name = "coseguro_hrt" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>	
							<td>
								<input id = "obi_chk" name = "chk_turno[]" value = "OBI" type = "checkbox"/> OBI			
							</td>
							<td>
								<select id = "sel_obi" name="sel_obi">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "obi_ord_chk" name = "chk_ord[]" value = "ord_obi" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_obi" name = "coseguro_obi" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>	
							<td>
								<input id = "paqui_chk" name = "chk_turno[]" value = "PAQUI" type = "checkbox"/> PAQUI 			
							</td>
							<td>
								<select id = "sel_paqui" name="sel_paqui">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "paqui_ord_chk" name = "chk_ord[]" value = "ord_paqui" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_paqui" name = "coseguro_paqui" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>	
							<td>
								<input id = "laser_chk" name = "chk_turno[]" value = "Laser" type = "checkbox"/> Laser			
							</td>
							<td>
								<select id = "sel_laser" name="sel_laser">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "laser_ord_chk" name = "chk_ord[]" value = "ord_laser" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_laser" name = "coseguro_laser" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>	
							<td>
								<input id = "yag_chk" name = "chk_turno[]" value = "YAG" type = "checkbox"/> YAG
							</td>
							<td>
								<select id = "sel_yag" name="sel_yag">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "yag_ord_chk" name = "chk_ord[]" value = "ord_yag" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_yag" name = "coseguro_yag" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>	
							<td>
								<input id = "topo_chk" name = "chk_turno[]" value = "TOPO" type = "checkbox"/> TOPO
							</td>
							<td>
								<select id = "sel_topo" name="sel_topo">
									<option></option>
								<?php
									foreach ($obras as $obra)
										echo '<option value ="'.$obra->obra.'">'.$obra->obra.'</option>';
								?>
								</select>
							</td>
							<td style = "width: 110px;padding-left:10px">
								<input id = "topo_ord_chk" name = "chk_ord[]" value = "ord_topo" type = "checkbox"/> Orden Pend.			
							</td>
							<td style = "text-align:right">
								Coseguro:
							</td>
							<td>
								<input id = "coseguro_topo" name = "coseguro_topo" style = "width:40px" autocomplete="off"/>
							</td>
						</tr>
						<tr>
							<td>
								<input id = "sincargo_chk" name = "chk_turno[]" value = "S/Cargo" type = "checkbox"/> Sin Cargo
							</td>	
						</tr>	
					</table>
				</div>
			</div>
			<div style = "float:left;margin-top:27px;margin-left:20px">
				<div style = "float:left">
					Medico solicitante:
				</div>
				<div id = "medico_fact" style = "font-weight:bold;float:left;margin-left:10px"></div>
			</div>
			<div style = "float:left;margin-top:20px;margin-left:150px">
				Lugar de atención:
				<select id = "sel_atendido" name="sel_atendido" style = "width:180px">
					<?php
					foreach ($localidades as $loc) {	
						echo '<option value = "'.$loc->id_localidad.'">'.$loc->nombre.'</option>';
					}
					?>
				</select>
			</div>
			<div style = "float:left;margin-top:20px;margin-left:50px">
				Lugar de facturación:
				<select id = "sel_facturacion" name="sel_facturacion" style = "width:180px">
					<?php
					foreach ($localidades as $loc) {	
						echo '<option value = "'.$loc->id_localidad.'">'.$loc->nombre.'</option>';
					}
					?>
				</select>
			</div>
			<input id = "id_turno" name = "id_turno" type = "hidden"/>
			<input id = "sel_estado" name = "sel_estado" type = "hidden"/>
			<input id = "obra_turno" name = "obra_turno" type = "hidden"/>
			<input id = "facturado" name = "facturado" value = 1 type = "hidden"/>
			<input id = "sel_medico_" name = "sel_medico" type = "hidden"/>
			<!--<input id = "sel_atendido" name = "sel_atendido" type = "hidden"/>-->
		</form>
	</div>
</body>
</html>	