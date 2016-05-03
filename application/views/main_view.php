<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Turnos</title>
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/helper.js')?>"></script>
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

	#select_medico select {
		width: 150px;
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

	.detalles_izq {
		width: 150px;
		font-weight: bold;
	}

	.detalles_der {
		width: 200px;
	}

	.row {
		//overflow: auto;
		height: 100px;
		background-color: #F7F7F7;
		margin-bottom: 5px;

	}

	#container {
		height: 273px;
		overflow-y: scroll;
		margin-bottom: 20px;
		border-top: 1px solid #CCC;
		border-bottom: 1px solid #CCC;
	}

	#add {
		font-size: 0.9em;
	}

	.cerrar {
		font-size: 0.7em;
		font-weight: bold;
		cursor: pointer;
	}

	</style>
	<script>
	var base_url = '<?php echo base_url(); ?>';

	var checks = ["cvc", "iol", "topo", "me", "oct", "rfgc", "rfg", "hrt", "obi", "paqui", "consulta", "laser", "yag"];

	var rows = [];
	var count = 0;
	var values_paciente = [];


	$(document).on("change",".get_data",function(){

		var id = $(this).closest('.row').attr("id");
		get_os_pr($("#"+id).find('select[name="obra[]"]'), $("#"+id).find('select[name="practica[]"]'), "", $("#"+id).find('select[name="medico_fact[]"]').val());

	});

	$(document).on("change","#lugar_facturacion",function(){

		$.each(rows,function(key, value) 
		{	
			get_os_pr($("#"+id).find('select[name="obra[]"]'), $("#"+id).find('select[name="practica[]"]'), "", $("#"+id).find('select[name="medico_fact[]"]').val());
			
		});	
	});

	$(document).on("click",".cerrar",function(){
		$(this).closest('.row').remove();

		removeItem = $(this).closest('.row').attr('id');
		rows.splice( $.inArray(removeItem,rows) ,1 );

	});


	$(document).on("click",".orden",function(){
		if ($(this).prop("checked") == true)
			$(this).closest('.row').find('input[name="debe_ord[]"]').val("SI");
		else
			$(this).closest('.row').find('input[name="debe_ord[]"]').val("NO");
	});

	$(document).on("click",".factura",function(){
		if ($(this).prop("checked") == true)
			$(this).closest('.row').find('input[name="factura[]"]').val("SI");
		else
			$(this).closest('.row').find('input[name="factura[]"]').val("NO");
	});

	function make_row(id,data) {

		rows.push(id);

		var medicos = '<?php echo json_encode($medicos); ?>';

		var medicos = JSON.parse(medicos);

		var html = "";

		$.each( medicos, function( key, value ) {
		    html += '<option value = "'+value['id_medico']+'">'+value['nombre']+'</option>';
		});

		$("#container").append(

			'<div class = "row" id = "'+id+'">'+
				'<input type = "hidden" name = "nombre_obra[]">'+
				'<input type = "hidden" name = "nombre_practica[]">'+
				'<div style = "float:left;margin-top:10px;margin-left:20px">'+
					'<div style = "float:left;margin-right:50px">'+
						'Datos: '+
						'<select class = "get_data" name= "medico_fact[]" style = "width:140px">'+
						html+
						'</select>'+
					'</div>'+
					'<div style = "float:left;margin-right:20px">'+
						'Práctica: '+
						'<select name= "practica[]" style = "width:200px">'+
						'</select>'+
					'</div>'+
					'<div style = "float:left;margin-right:20px">'+
						'Obra Social: '+
						'<select name= "obra[]" style = "width:200px">'+
						'</select>'+
					'</div>'+
					'<div style = "float:left">'+
						'<a href="#" class="cerrar" role="button">'+
							'<span class="ui-icon ui-icon-closethick">close</span>'+
						'</a>'+
					'</div>'+
				'</div>'+
				'<div style = "float:left;margin-left:20px;margin-top:20px;margin-bottom:10px">'+
					'<div style = "float:left;margin-right:50px">'+
						'Nro Afiliado: <input name = "nro_afiliado[]" style = "width:120px" autocomplete="off">'+
					'</div>'+
					'<div style = "float:left;margin-right:20px">'+
						'Paga Plus: <input name = "plus[]" style = "width:50px;margin-left:2px" autocomplete="off">'+
					'</div>'+
					'<div style = "float:left;margin-right:50px">'+
						'Debe Plus: <input name="debe_plus[]" style="width:50px" autocomplete="off">'+
					'</div>'+
					'<div style = "float:left;margin-right:20px">'+
						'Debe Orden <input type = "checkbox" class = "orden">'+
						'<input type = "hidden" name = "debe_ord[]" value = "NO">'+
					'</div>'+
					'<div style = "float:left;">'+
						'Factura <input type = "checkbox" class = "factura">'+
						'<input type = "hidden" name = "factura[]" value = "NO">'+
					'</div>'+
				'</div>'+
			'</div>');
		

		//data = values_turno[id];
		//console.log(data['practica']);

		if (data != null) {
			get_os_pr($("#"+id).find('select[name="obra[]"]'), $("#"+id).find('select[name="practica[]"]'), "", $("#"+id).find('select[name="medico_fact[]"]').val(), function() {
				$("#"+id).find('select[name="practica[]"]').val(data['practica']);
				$("#"+id).find('select[name="obra[]"]').val(data['obra']);
				$("#"+id).find('select[name="medico_fact[]"]').val(data['medico_fact']);
				$("#"+id).find('input[name="nro_afiliado[]"]').val(data['nro_afiliado']);
				$("#"+id).find('input[name="plus[]"]').val(data['plus']);
				$("#"+id).find('input[name="debe_plus[]"]').val(data['debe_plus']);
				$("#"+id).find('input[name="debe_ord[]"]').val(data['debe_ord']);
				$("#"+id).find('input[name="factura[]"]').val(data['factura']);

				if (data['debe_ord'] === "SI")
					$("#"+id).find(".orden").prop('checked', true);

				if (data['factura'] === "SI")
					$("#"+id).find(".factura").prop('checked', true);
			});
		}
		else {
			get_os_pr($("#"+id).find('select[name="obra[]"]'), $("#"+id).find('select[name="practica[]"]'), "", values_paciente['medico'], function() {
				$("#"+id).find('select[name="medico_fact[]"]').val(values_paciente['medico']);
				$("#"+id).find('select[name="obra[]"]').val(values_paciente['obra_social']);	
			});
		}	

		count = count + 1;
	}

	$(document).ready(function()
	{	

		$("#cita_hora").keyup(function() {
			
   			if($(this).val().length == $(this).attr('maxlength')) {
        		$("#cita_minutos").focus();
    		}
			
		});
		
		
		$(".clickeable").click(function()
		{ 
			var id = $(this).attr("id");
			if ($("#detalles_"+id).is(":hidden")) {

				$('[id^="detalles_"]').slideUp("slow"); 
				$("#detalles_"+id).slideDown("slow");
				
			} 
			else {
				$("#detalles_"+id).slideUp("slow");
			}		
		});

		$("#add").click(function(event) {

			event.preventDefault();
			make_row(count,null);
		
		});
		
		// $('input[name="chk_turno[]"]').change(function(event) {
  //     		// State has changed to checked/unchecked.
  //     		var id = $(this).attr("id");
  //     		var tipo = id.substring(0, id.indexOf("_"));

  //     		if ($(this).prop("checked") == false) {
		// 		$("#sel_"+tipo).prop('disabled', true);
		// 		$("#coseguro_"+tipo).prop('disabled', true);
		// 		$("#"+tipo+"_ord_chk").prop('disabled', true);	
		// 	}
		// 	else {
		// 		$("#sel_"+tipo).removeAttr('disabled');
		// 		$("#coseguro_"+tipo).removeAttr('disabled');
		// 		$("#"+tipo+"_ord_chk").removeAttr('disabled');
		// 	}
		// });

		$( "#seleccion_medico" ).change(function () {
			var base_url = '<?php echo base_url(); ?>';
    		var str = "";
    		var segment = $(location).attr('href').split("/");
    		$( "#seleccion_medico option:selected" ).each(function() {
    			str += base_url+"index.php/main/cambiar_medico/"+$(this).val()+"/"+segment[7].replace("#","")+"/turnos";
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

   	function bloquear() {
        $( "#bloquear_dia" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 350,
            height: 220,
            modal: true,
            buttons: {
                "Si": function() {
                	if ($("#motivo").val() == "")
                		$("#error_motivo").html("Debe escribir un motivo.");	
                	else
						$("#form_bloquear").submit();
                },
				"No": function() {
                    $( this ).dialog( "close" );
				}
            }
        });
   	};

   	function desbloquear() {
        $( "#desbloquear_dia" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 300,
            height: 150,
            modal: true,
            buttons: {
                "Si": function() {
					$("#form_desbloquear").submit();
                },
				"No": function() {
                    $( this ).dialog( "close" );
				}
            }
        });
   	};

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

   	function error_ficha() {
        $( "#error_ficha" ).dialog({
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

   	function clear_all() {

  //  		$.each( checks, function( i, val ) {
							
		// 	$("#"+val+"_chk").prop('checked',false);
		// 	$("#sel_"+val).val("");
		// 	$("#coseguro_"+val).val("");
		// 	$("#"+val+"_ord_chk").prop('checked', false);

		// 	$("#sel_"+val).removeAttr('disabled');
		// 	$("#coseguro_"+val).removeAttr('disabled');
		// 	$("#"+val+"_ord_chk").removeAttr('disabled');
			
		// 	$("#sel_estado").removeAttr('disabled');
		// });

		// $("#sincargo_chk").prop('checked',false);

		$.each( rows, function( i, val ) {
			$("#"+val).remove();
			rows = [];
		});

		// $("#datos_paciente").html("");
		// $("#datos_ficha").html("");	
   	};

   	function openForm(id) {

   		clear_all();
   		
        $.ajax({
			//type: 'POST',
			url: base_url+"/index.php/main/get_info/"+id,
			//data: values,
			dataType: 'json',
			success:function(response)
			{	
				values_turno = response['data_turno'];
				values_paciente = response['data_paciente'];

				$.each( values_turno, function(key,val) {
					make_row(key, values_turno[key]);
				});

				if (values_paciente["medico"].indexOf("Otro") >= 0) {
					$('select[name="medico_sol"] option[value="otro"]').remove();
					$('select[name="medico_sol"]').append($("<option></option>").attr("value",values_paciente["medico"]).text(values_paciente["medico"])); 
				}	
				else {
					$('select[name="medico_sol"]').val(values_paciente["medico"]);
				}

				$("#datos_paciente").html(values_paciente["paciente"]);
				$("input[name='datos_paciente'").val(values_paciente["paciente"]);

				$("#datos_ficha").html(values_paciente["ficha"]);
				$("input[name='datos_ficha'").val(values_paciente["ficha"]);

				$("input[name='datos_id_paciente'").val(values_paciente["id_paciente"]);
				$("input[name='datos_id_turno'").val(values_paciente["id_turno"]);
				$("input[name='datos_fecha_turno'").val(values_paciente["fecha_turno"]);

				$("select[name='lugar_atencion']").val(values_paciente['lugar_atencion']);
				$("select[name='lugar_facturacion']").val(values_paciente['lugar_facturacion']);

				$("input[name='nro_factura']").val(values_paciente['nro_factura']);
				$("input[name='importe_factura']").val(values_paciente['importe_factura']);
				$("select[name='tipo_factura']").val(values_paciente['tipo_factura']);
						
				$( "#confirmar_datos" ).dialog({
					autoOpen: true,
		            resizable: false,
					width: 930,
		            height: 580,
				    modal: true,
		            buttons: {
		                "Confirmar": function() {
							//var x = url+"/borrar_turno/"+data;
							//location.href = x;
							$("#form_facturacion").submit();
		                },
						"Cancelar": function() {
		                    $( this ).dialog( "close" );
						}
		            }
		        }); 

			},
		});
   	};

   	function chequear(fecha,hora,minutos) {

   		$("#cita_hora").val("");
   		$("#cita_minutos").val("");

   		$("#form_fecha").val(fecha);
   		$("#form_hora").val(hora);
   		$("#form_minutos").val(minutos);

        $( "#dialog-confirm" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 300,
            height: 160,
            modal: true,
            buttons: {
                "Si": function() {
                	$("#form_cambiar").submit();
					//var x = url+"/cambiar_turno/"+data;
					//location.href = x;
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
		<select id = "seleccion_medico" name="seleccion_medico">
			<?php
			
				echo '<option value = "todos" selected>TODOS</option>';
				foreach ($medicos as $med) {	
					if ($medico_selected == $med->id_medico)
						if ($med->nombre == "Otro")
							echo '<option value ='.$med->id_medico.' selected>'.$med->nombre.'</option>';
						else
							echo '<option value ='.$med->id_medico.' selected>Dr. '.$med->nombre.'</option>';
					else
						if ($med->nombre == "Otro")
							echo '<option value ='.$med->id_medico.'>'.$med->nombre.'</option>';
						else
							echo '<option value ='.$med->id_medico.'>Dr. '.$med->nombre.'</option>';
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

							// if (substr_count($fila->tipo, 'CVC') OR substr_count($fila->tipo, 'TOPO') OR substr_count($fila->tipo, 'IOL') OR substr_count($fila->tipo, 'ME') OR substr_count($fila->tipo, 'OCT') OR substr_count($fila->tipo, 'RFG') ) {
							// 	$cantidad_estudios++;
							// }
							
							if ($fila->medico == $medico_selected)
								$cantidad++;

							if ($medico_selected == "otro")
								$cantidad++;

						}
						echo $cantidad;
					}
			?>
	</div>
	<div class="count" style = "background-color:white; color: #D83C3C;">
			<?php 	
				echo $cantidad_estudios;
			?>
	</div>
	<div style = "float:left;margin-top:8px;margin-left:50px;">
		<?php
		echo '<a href="'.base_url('index.php').'">'; 
			echo '<img src = "'.base_url('css/images/home_24x24.png').'"/>';
		echo '</a>';
		?>
	</div>
	<div style = "float:left;margin-top:8px;margin-left:5px">
		<?php
		echo '<a target= "_blank" href="'.base_url('index.php/main/buscar_paciente').'">';
			echo '<img src = "'.base_url('css/images/user_18x24.png').'"/>'; 
		echo '</a>';
		?>
	</div>
	<?php if (strpos($this->session->userdata('funciones'), "Turnos") !== false ) {
		echo '<div id = "bloquear" style="float:left;margin-top:11px;margin-left:5px">';
			if ($bloqueado != null) {
				echo '<a href="#" onclick = "return desbloquear()">';
					echo '<img src = "'.base_url('css/images/lock.png').'"/>'; 
				echo '</a>';	
			}
			else {
				echo '<a href="#" onclick = "return bloquear()">';
					echo '<img src = "'.base_url('css/images/unlock.png').'"/>'; 
				echo '</a>';	
			}
		echo '</div>';	
		}			
	?>
	<div style = "float:left;margin-left:5px;margin-top:8px">
	<?php
		echo '<a href="'.base_url('index.php/login/desconectar').'">';
			echo '<img src = "'.base_url('css/images/logout.png').'"/>'; 
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
	<form action="<?php echo base_url('index.php/main/cambiar_turno')?>" method="post" name="form_cambiar" id="form_cambiar">
		<?php
			if (isset($nombre_turno)) {
				echo str_replace('%20', ' ', $apellido_turno.', '.$nombre_turno);
			}
		?>
		<div style = "margin-top:10px">
			<b>Citado:</b>
			<input type="text" size="2" id = "cita_hora" name="cita_hora" pattern="[0-9].{1,}" autocomplete="off" maxlength="2" required=""> :
			<input type="text" size="2" id = "cita_minutos" name="cita_minutos" pattern="[0-9].{1,}" autocomplete="off" maxlength="2" required="">
			<input type="hidden" name="form_fecha" id ="form_fecha">
			<input type="hidden" name="form_hora" id ="form_hora">
			<input type="hidden" name="form_minutos" id ="form_minutos">
			<b> hs</b>
		</div>
	</form>
</div>
<div id="borrar_turno" title="¿Borrar turno?"></div>
<div id="desbloquear_dia" title="¿Desbloquear agenda?" style = "display:none">
	<form id = "form_desbloquear" action="<?php echo base_url('index.php/main/desbloquear_dia/')?>" method="post">
		<?php if ($medico_selected_name == "") {?>
			<div style = "margin-bottom:15px;margin-top:5px">Desbloquear agenda para <b>Todos</b>?</div>
		<?php }
			else {?>
			<div style = "margin-bottom:15px;margin-top:5px">Desbloquear agenda para <b>Dr. <?php echo $medico_selected_name?></b>?</div>
		<?php }?>
		<input name = "fecha" type = "hidden" value = "<?php echo $fecha?>"/>
		<input name = "medico" type = "hidden" value = "<?php echo $medico_selected?>"/>
	</form>
</div>	
<div id="bloquear_dia" title="¿Bloquear agenda?" style = "display:none">
	<form id = "form_bloquear" action="<?php echo base_url('index.php/main/bloquear_dia/')?>" method="post">
		<input name = "fecha" type = "hidden" value = "<?php echo $fecha?>"/>
		<input name = "medico" type = "hidden" value = "<?php echo $medico_selected?>"/>
		<?php if ($medico_selected_name == "") {?>
			<div style = "margin-bottom:15px;margin-top:5px">Bloquear agenda para <b>Todos</b>?</div>
		<?php }
			else {?>
			<div style = "margin-bottom:15px;margin-top:5px">Bloquear agenda para <b>Dr. <?php echo $medico_selected_name?></b>?</div>
		<?php }?>	
		Motivo: <textarea id = "motivo" name = "motivo" style = "width:250px;height:50px;float:right" required/></textarea>
		<div id = "error_motivo" style ="color:red;float:left;width:100%"></div>
	</form>
</div>
<div id="error" title="Atención" style = "display:none"> Este turno ya no puede modificarse.</div>
<div id="error_ficha" title="Atención" style = "display:none"> Debe especificarse un número de ficha primero.</div>
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

	class datosPaciente {
		public $nombre;
		public $apellido;
		public $id;
		public $dni;
		public $nroficha;
		public $fecha_nacimiento;
		public $direccion;
		public $localidad;
		public $tel1;
		public $tel2;
		public $obra_social;
		public $nro_obra;


		function  __construct() {
			$this->nombre="";
			$this->apellido="";
			$this->id="";
			$this->dni="";
			$this->nroficha="";
			$this->fecha_nacimiento="";
			$this->direccion="";
			$this->localidad="";
			$this->tel1="";
			$this->tel2="";
			$this->obra_social="";
			$this->nro_obra="";
		}
	}

	if ($bloqueado == null) {

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
					$color = "#FFD9B5";//#FFCDCD";
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
								if (strpos($this->session->userdata('funciones'), "Turnos") !== false )
									echo '<a href="'.base_url("/index.php/main/nuevo_turno/".$fila->fecha.'/'.$hora.'/'.$minutos).'" name="'.$hora_completa.'">'.$hora_completa.'</a>';
								else
									echo '<a href="#" name="'.$hora_completa.'">'.$hora_completa.'</a>';
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
									if (sizeof($auxi) > 1)
										echo "Dr. ".$auxi[1];
									else
										echo "Otro";
								}
								else {
									echo "Dr. ".$fila->medico;	
								}
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
								echo '<input type="hidden" name="id_turno" value="'.$fila->id.'">';

								echo '<a href="#" onclick="$(this).closest(\'form\').submit(); return false;">Nuevo Paciente</a>';
							
								//<a href="#" onclick="$(this).closest('form').submit(); return false;">Nuevo Paciente</a>
							echo '</form>';
							
							}	
							else if ($fila->ficha == -2) {
								echo anchor('main/buscar_paciente/'.$fila->apellido.'/'.$fila->nombre.'/'.$fila->id, "Buscar..");	
								//echo anchor('main/buscar_paciente', 'Buscar..');
							}
							else {
								if (strpos($this->session->userdata('funciones'), "Medico") !== false )
									echo anchor('main/historia_clinica/'.$fila->id_paciente, $fila->ficha);
								else {
									echo '<form action="'.base_url('index.php/main/buscar_paciente/'.$fila->id_paciente).'" method="post" name="form_editar" id="form_editar">';
										echo '<input type="hidden" name="fecha_turno" value="'.$fecha.'">';
									echo '<a href="#" onclick="$(this).closest(\'form\').submit(); return false;">'.$fila->ficha.'</a>';
									echo '</form>';
								}	

									//echo anchor('main/editar_paciente/'.$fila->id_paciente, $fila->ficha);
							}		
						echo '</div>';

						echo '<div class = "estado" id = "'.$fila->id.'" style="cursor: pointer;">';
							if (strpos($this->session->userdata('funciones'), "Turnos") !== false ) {

								if ($fila->ficha < 0)
									echo '<a onclick = "return error_ficha()">';
								else {

									if ($fila->ya_facturado == 0)
										echo '<a onclick = "return openForm(\''.$fila->id.'\')">';
									else
										echo '<a onclick = "return error()">';
								}	

							}
							else
								echo '<a>';

							if ($fila->estado == "")
								echo '<img class = "check" id = "'.$fila->id.'" src = "'.base_url('css/images/check_16x13.png').'" title = "Paciente Ausente"/></a>';
							else if ($fila->estado == "estudios")	
								echo '<img class = "check" id = "'.$fila->id.'" src = "'.base_url('css/images/estudios.png').'" title = "Paciente realizando estudios"/></a>'; 
							else if ($fila->estado == "estudios_ok")	
								echo '<img class = "check" id = "'.$fila->id.'" src = "'.base_url('css/images/estudios_ok.png').'" title = "Paciente con estudios finalizados"/></a>';
							else if ($fila->estado == "medico")	
								echo '<img class = "check" id = "'.$fila->id.'" src = "'.base_url('css/images/medico.png').'" title = "Paciente listo para ser atendido"/></a>';
							else if ($fila->estado == "dilatacion")	
								echo '<img class = "check" id = "'.$fila->id.'" src = "'.base_url('css/images/dilatacion.png').'" title = "Paciente dilatando"/></a>';
							else
								echo '<img class = "check" id = "'.$fila->id.'" src = "'.base_url('css/images/check_alt_24x24.png').'" title = "Paciente atendido"/></a>';								
									
						echo '</div>';

					echo '</div>';
					echo '<div class = "fila_inferior">';
						// echo '<div style = "float:left;margin-left:10px;margin-right:32px;font-weight:bold">';
						// 	echo "Practicas:";
						// echo '</div>';
						$practicas = json_decode($fila->tipo);
						echo '<div class = "tipo_turno" style = "margin-left:105px">';
							foreach ($practicas as $key => $value) {
								echo "<li>".$value->nombre_practica."</li>";
								//echo "<br>";
							}
						echo '</div>';
					echo '</div>';
					
				echo '</div>';

				// Genero un objeto vacio para los pacientes que todavía no tienen ficha.
				if ($fila->id_paciente > 0)
					$paciente = $datos_paciente[$fila->id_paciente][0];
				else
					$paciente = new datosPaciente();
				
				echo '<div id = "detalles_'.$fila->id.'" class="detalles" style = "display:none;">';
					echo '<div style = "float:left;width:40%">';
						echo '<table class = "detalle_1">';
							echo '<tr>';
								echo '<td class = "detalles_izq">Fecha de Nacimiento:</td>';
								if ($paciente->fecha_nacimiento != "" && $paciente->fecha_nacimiento <> "0000-00-00")
									echo '<td class = "detalles_der">'.date('d-m-Y', strtotime($paciente->fecha_nacimiento)).'</td>';
								else
									echo '<td class = "detalles_der"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class = "detalles_izq">Dirección</td>';
								echo '<td class = "detalles_der">'.$paciente->direccion.'</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class = "detalles_izq">Localidad:</td>';
								echo '<td class = "detalles_der">'.$paciente->localidad.'</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class = "detalles_izq">DNI:</td>';
								echo '<td class = "detalles_der">'.$paciente->dni.'</td>';
							echo '</tr>';
						echo '</table>';
					echo '</div>';
					echo '<div style = "float:left;width:40%">';	
						echo '<table class = "detalle_1">';	
							echo '<tr>';
								echo '<td class = "detalles_izq">Teléfono 1:</td>';
								echo '<td class = "detalles_der">'.$fila->tel1.'</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class = "detalles_izq">Teléfono 2:</td>';
								echo '<td class = "detalles_der">'.$fila->tel2.'</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class = "detalles_izq">Obra Social:</td>';
								echo '<td class = "detalles_der">'.$fila->obra_social.'</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class = "detalles_izq">Nro. Afiliado:</td>';
								echo '<td class = "detalles_der">'.$paciente->nro_obra.'</td>';
							echo '</tr>';
						echo '</table>';
					echo '</div>';
					/*
					echo '<div id = "detalle_1">';
						echo "<b>Obra social :</b>  ".$fila->obra_social;
					echo '</div>';
					echo '<div id = "detalle_1">';
						echo "<b>Teléfono :</b>  ".$fila->tel1;
					echo '</div>';
					echo '<div id = "detalle_1">';
							echo "<b>Teléfono 2 :</b>  ".$fila->tel2; 				
					echo '</div>';
					*/
					echo '<div id = "detalle_nota">';
						if ($fila->notas == "") {
							echo "<b>Notas :  </b> <i>No hay notas para mostrar</i>"; 
						}
						else {
							echo "<b>Notas: </b>".$fila->notas;
						}
					echo '</div>';

					if (strpos($this->session->userdata('funciones'), "Turnos") !== false ) {
						echo '<div id = "botones">';
							if ($fila->estado == "") {
								echo '<a href="'.base_url('index.php/main/editar_turno/'.$fila->id).'">';
									echo '<img src = "'.base_url('css/images/pencil_icon&16.png').'"/>';  	
								echo '</a>';
								echo '<a style="cursor: pointer;" onclick = "return borrar(\''.base_url("/index.php/main/").'\', \''.$fila->id.'\');">'; 
									echo '<img src = "'.base_url('css/images/delete_icon&16.png').'"/>';  
								echo '</a>';	
								echo '<a href="'.base_url('index.php/main/set_cambio/'.$fecha.'/'.$fila->id.'/'.$fila->nombre.'/'.$fila->apellido).'">';
									echo '<img src = "'.base_url('css/images/refresh_icon&16.png').'"/>';  
								echo '</a>';
							}	
							echo '<a href="'.base_url('index.php/main/set_turno/'.$fecha.'/'.$fila->id).'">';
								echo '<img src = "'.base_url('css/images/plus_black_16x16.png').'"/>';  
							echo '</a>';	
						echo '</div>';
					}
					echo '<div style = "font-style:italic;float:right;font-size:12px;margin-right:10px">';
						echo 'Ultima edición: '.date('d-m-Y@H:i', strtotime($fila->last_update)).' por <bold>'.$fila->usuario.'<bold>';
					echo '</div>';	
				echo '</div>';
			}
			else {
				$hora = date('H', strtotime($fila));
				$minutos = date('i', strtotime($fila));
				$data = $fecha.'/'.$hora.'/'.$minutos;
				if (strpos($this->session->userdata('funciones'), "Turnos") !== false ) {
				
					if ($id_turno <> NULL)
					{	
						if ($nuevo_turno == 1)
							echo '<div class = "fila_vacia" onclick = "location.href=\''.base_url("/index.php/main/asignar_turno/".$fecha.'/'.$hora.'/'.$minutos).'\';" style="cursor: pointer;">';
						else
							echo '<div class = "fila_vacia" style="cursor: pointer" onclick = "return chequear(\''.$fecha.'\', \''.$hora.'\', \''.$minutos.'\');">';

					}	
					else
						echo '<div class = "fila_vacia" onclick = "location.href=\''.base_url("/index.php/main/nuevo_turno/".$fecha.'/'.$hora.'/'.$minutos).'\';" style="cursor: pointer;">';
				}
				else 
					echo '<div class = "fila_vacia">';
						echo '<div class = "hora">'; 
							echo '<a name="'.$fila.'">'.$fila.'</a>';
						echo '</div>';	 
				echo '</div>';
			}
		}
	}
	else {
		if ($bloqueado->motivo != "")
			$motivo = $bloqueado->motivo;
		else
			$motivo = "Sin Especificar";

		echo '<div style = "height:486px">';
			if ($medico_selected_name == "")
				echo "<p style = 'text-align:center;font-size:25px;font-family:Oswald'>Agenda bloqueada para <b style = 'margin-left:5px;margin-right:5px;font-size:30px'>Todos</b> en esta fecha.</p>";
			else
				echo "<p style = 'text-align:center;font-size:25px;font-family:Oswald'>Agenda de  <b style = 'margin-left:5px;margin-right:5px;font-size:30px'>Dr. ".$medico_selected_name."</b>  bloqueada para esta fecha.</p>";
			echo "<p style = 'text-align:center;font-size:25px;font-family:Oswald'>Motivo: <i>".$motivo."</i></p>";
			echo "<p style = 'text-align:center;font-size:15px;font-family:Oswald'>Última edición: <i>".date('d-m-Y',strtotime($bloqueado->last_update))." - ".$bloqueado->usuario."</i></p>";
		echo '</div>';
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


<div id="confirmar_datos" title="Actualizar datos turno" style = "display:none">
	<div style = "overflow: auto">
		<!--<form id = "add_to_facturacion">-->
		<!-- 	<form id = "form_facturacion" action="<?php echo base_url('index.php/main/update_facturacion_turno/0')?>" method="post">-->
		<form id = "form_facturacion"  action="<?php echo base_url('index.php/main/process')?>" method="post">
			<input type = "hidden" name = "datos_paciente">
			<input type = "hidden" name = "datos_ficha">
			<input type = "hidden" name = "datos_id_paciente">
			<input type = "hidden" name = "datos_id_turno">
			<input type = "hidden" name = "datos_fecha_turno">

			<div style = "float:left;margin-bottom:10px;margin-left:20px">
				<b style = "float:left">Paciente:</b>
				<div id = "datos_paciente" style = "float:left;margin-right: 200px;margin-left:10px"></div>
				<b style = "float:left">Ficha:</b>
				<div <div id = "datos_ficha" style = "float:left;margin-left:10px"></div>
			</div>	
			<div style = "float:left;margin-bottom:20px;margin-top:10px">
				<div style = "float:left;margin-bottom:20px;margin-left:20px;margin-top:10px">
					<div style = "float:left">
						Medico Solicitante:
						<select name="medico_sol" style = "width:140px">
						<?php 
							foreach ($medicos as $med) {	
								echo '<option value = "'.$med->id_medico.'">'.$med->nombre.'</option>';
							}
						?>
						</select>
					</div>
					<div style = "float:left;margin-left:20px">
						Atención:
						<select name="lugar_atencion" style = "width:120px">
						<?php 
							foreach ($localidades as $loc) {	
								echo '<option value = "'.$loc->id_localidad.'">'.$loc->nombre.'</option>';
							}
						?>
						</select>
					</div>
					<div style = "float:left;margin-left:20px;">
						Facturación:
						<select id = "lugar_facturacion" name="lugar_facturacion" style = "width:100px">
						<?php 
							foreach ($localidades as $loc) {	
								echo '<option value = "'.$loc->id_localidad.'">'.$loc->departamento.'</option>';
							}
						?>
						</select>
					</div>
					<div style = "float:left;margin-left:20px;">
						<button id = "add">Agregar Práctica</button>
					</div>
				</div>
				<div style = "float:left;width:100%">
					<div id = "container">
						<!-- A llenar mediante confirmar() -->
					</div>
					<div style = "margin-left:20px;float:left;">
						<div style = "float:left;margin-right:20px">
							Nro Factura: <input name = "nro_factura" style = "width:100px" autocomplete="off">
						</div>	
						<div style = "float:left;margin-right:20px">
							Importe Total: <input name = "importe_factura" style = "width:80px;margin-left:27px" autocomplete="off">
						</div>
						<div style = "float:left;margin-right:20px">
							Tipo Factura :
							<select name = "tipo_factura" style = "width:50px">
								<option></option>
								<option>A</option>
								<option>B</option>
							</select>
						</div>	
					</div>
				</div>
			</div>
		</form>
	</div>

	<!-- 	<form id = "form_facturacion" action="<?php echo base_url('index.php/main/update_facturacion_turno/0')?>" method="post">
			<div style = "float:left;font-weight:bold;margin-right:10px">Paciente:</div><div id = "nombreApellido" style = "float:left"></div>
			<div style = "float:left;font-weight:bold;margin-right:10px;margin-left: 50px">Ficha: </div><div id = "ficha" style = "float:left"></div>
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
			<div style = "width:100%;float:left">
				<div style = "width:100%;float:left">
					<div style = "float:left;margin-top:20px;width:40%">
						Estado Actual:
						<select id = "sel_estado" name="sel_estado" style = "width:180px">
							<option></option>
							<option value = "estudios"> Espera para estudios </option>
							<option value = "estudios_ok"> Estudios terminados</option>
							<option value = "dilatacion"> En dilatación </option>
							<option value = "medico"> Espera para médico </option>
						</select>
					</div>
					<div style = "float:left;margin-top:20px;margin-left:20px">
						<div style = "float:left">
							Medico solicitante:
							<select id = "sel_medico" name="sel_medico" style = "width:180px">
							<?php 
								foreach ($medicos as $med) {	
									echo '<option value = "'.$med->id_medico.'">'.$med->nombre.'</option>';
								}
							?>
							</select>
						</div>
					</div>
				</div>
				<div style = "width:100%;float:left">	
					<div style = "float:left;margin-top:20px;width:40%">
						Lugar de atención:
						<select id = "sel_atendido" name="sel_atendido" style = "width:180px">
							<?php 
								foreach ($localidades as $loc) {	
									echo '<option value = "'.$loc->id_localidad.'">'.$loc->nombre.'</option>';
								}
							?>
						</select>
					</div>
					<div style = "float:left;margin-top:20px;margin-left:20px">
						Lugar de facturación:
						<select id = "sel_facturacion" name="sel_facturacion" style = "width:180px">
							<?php 
								foreach ($localidades as $loc) {	
									echo '<option value = "'.$loc->id_localidad.'">'.$loc->nombre.'</option>';
								}
							?>
						</select>
					</div>
				</div>	
				<input id = "id_turno" name = "id_turno" type = "hidden"/>
				<input id = "ficha_fact" name = "ficha_fact" type = "hidden"/>
				<input id = "fecha_fact" name = "fecha_fact" type = "hidden"/>
				<input id = "apellido_fact" name = "apellido_fact" type = "hidden"/>
				<input id = "nombre_fact" name = "nombre_fact" type = "hidden"/>
				<input id = "obra_turno" name = "obra_turno" type = "hidden"/>
			</div>	
		</form> -->
	</div>
</body>
</html>
