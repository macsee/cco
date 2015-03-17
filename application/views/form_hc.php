<!DOCTYPE html>

<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<script type="text/javascript"  src="<?php echo base_url('js/jsPanel-master/jquery-2.1.3.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/jsPanel-master/jquery-ui-1.11.2.min.js')?>"></script>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css')?>"/>

		<style type="text/css">
			body {
				//width: 790px;
				//height: 1500px;
				//border: 1px solid;
				font-size: 13pt;
				background-color: #F7F7F7;
			}

			h3 {
				font-family: Oswald;
				font-size: 13pt;
				font-weight: normal;
				float: left;
			}

			.separador {
				float:left;
				width: 99%;
				margin-top: 10px;
				margin-bottom: 20px;
			}

			.panel_izq {
				float: left;
				width: 45%;
				margin-left: 20px;
				margin-top: 20px;
			}

			.panel_der {
				float: left;
				//margin-left: 100px;
				width: 45%;
				margin-top: 20px;
			}

			table {
				border-collapse: collapse;
				font-family: Oswald;
				margin-top: 20px;
			}

			table input {
				width: 55px;
				border: none;
				font-size: 13pt;
				background-color: #F7F7F7;
			}

			th, td {
				//border: 1px solid;
				border: none;
			}

			.av_tabla td {
				//border:none;
				padding-top: 4px;
			}

			.av_tabla select {
				font-size: 12pt;
				background-color: #F7F7F7;
			}

			.solicitud_tabla td {
				width: 120px;
				//border:none;
			}

			.solicitud_tabla input {
				width: 20px;
				background-color: #F7F7F7;
			}

			.tabla_esp td {
				width: 100%
			}

			.titulo{
				font-size: 14pt;
				height: 25px;
				padding-left: 5px;
			}

			.tabla_ref input{
				border: 2px solid #4289b8;
			}

			.con_correc input {
				border: 2px solid #97d0d9;
			}

			.subjetiva input {
				border: 2px solid #97afd9;
			}	
		</style>
		<script type="text/javascript">
			$(document).ready( function() {
    			$("#adding").keyup(function() {
        			val = parseFloat($(this).val());
        			if (!$.isNumeric(val))
            			val = 0;

          				if ($("#od_esf_lejos").val()) {
	        				$("#od_esf_cerca").val((parseFloat($("#od_esf_lejos").val()) + val).toFixed(2));
	        				$("#od_cil_cerca").val($("#od_cil_lejos").val());
	        				$("#od_eje_cerca").val($("#od_eje_lejos").val());
        				}

        				if ($("#os_esf_lejos").val()) {
        					$("#os_esf_cerca").val((parseFloat($("#os_esf_lejos").val()) + val).toFixed(2));
        					$("#os_cil_cerca").val($("#os_cil_lejos").val());
        					$("#os_eje_cerca").val($("#os_eje_lejos").val());
        			}	
    			});
			});

		</script>
	</head>
	<body>
		<form id = "myform" method = "post" action = "<?php echo base_url('/index.php/main/submit_data/')?>" target = "_parent">
			<div>
				<h3 style = "margin-left:10px"> Motivo de consulta: </h3> <textarea style ="font-size:14pt;width:620px;height:100px;margin-right:20px;margin-top:20px;float:right" name = "motivo" required></textarea>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Refractometría
				</div>
				<div class = "panel_izq">
					<div style = "float:left">
						<table class ="tabla_ref">
		  					<tr>
		  						<th style = "border:none"></th>
		    					<th colspan = "3">ARM Sin Dilatación</th> 
		  					</tr>
		  					<tr>
		  						<td></td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Esf.</td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Cil.</td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Eje</td>
		  					</tr>
		  					<tr>
		  						<td style = "width:40px;text-align:left;border:none"> OD </td>
		    					<td><input name = "od_esf_arm_sd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td><input name = "od_cil_arm_sd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td><input name = "od_eje_arm_sd" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		  					</tr>
		  					<tr>
		  						<td style = "width:40px;text-align:left;border:none"> OS </td>
		    					<td><input name = "os_esf_arm_sd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td><input name = "os_cil_arm_sd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td><input name = "os_eje_arm_sd" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		  					</tr>
						</table>
					</div>
					<div style ="float:left">
						<div style = "margin-top: 75px; margin-left:10px;font-family: Oswald">
							<input name = "od_chk_arm_sd" type = "checkbox"/> No medido
						</div>
						<div style = "margin-top: 5px; margin-left:10px;font-family: Oswald">
							<input name = "os_chk_arm_sd" type = "checkbox"/> No medido
						</div>	
					</div>	
				</div>
				<div class = "panel_der">
					<div style = "float:left">
						<table class ="tabla_ref">
		  					<tr>
		  						<th style = "border:none"></th>
		    					<th colspan = "3">ARM Con Dilatación</th> 
		  					</tr>
		  					<tr>
		  						<td></td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Esf.</td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Cil.</td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Eje</td>
		  					</tr>
		  					<tr>
		  						<td style = "width:40px;text-align:left;border:none"> OD </td>
		    					<td><input name = "od_esf_arm_cd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td><input name = "od_cil_arm_cd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td><input name = "od_eje_arm_cd" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		  					</tr>
		  					<tr>
		  						<td style = "width:40px;text-align:left;border:none"> OS </td>
		    					<td><input name = "os_esf_arm_cd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td><input name = "os_cil_arm_cd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td><input name = "os_eje_arm_cd" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		  					</tr>
						</table>
					</div>
					<div style ="float:left">
						<div style = "margin-top: 75px; margin-left:10px;font-family: Oswald">
							<input name = "od_chk_arm_cd" type = "checkbox"/> No medido
						</div>
						<div style = "margin-top: 5px; margin-left:10px;font-family: Oswald">
							<input name = "os_chk_arm_cd" type = "checkbox"/> No medido
						</div>	
					</div>			
				</div>
				<div class = "panel_izq" style = "margin-left:62px;margin-top:40px">
					<div style = "float:left">
						<table class = "tabla_ref" style ="width:190px">
		  					<tr>
		    					<th colspan = "4">KRT OD</th> 
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">K1</td>
		    					<td><input name = "od_k1_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7;width:50%">Eje</td>
		    					<td><input name = "od_k1_eje_krt" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">K2</td>
		    					<td><input name = "od_k2_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7;width:50%">Eje</td>
		    					<td><input name = "od_k2_eje_krt" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">Ave.</td>
		    					<td><input name = "od_ave_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		  					</tr>
						</table>
					</div>
					<div style = "float:left;margin-top: 100px; margin-left:10px;font-family: Oswald">
						<input name = "od_chk_krt" type = "checkbox"/> No medido
					</div>		
				</div>
				<div class = "panel_der" style = "margin-top:40px">
					<div style = "float:left">
						<table class = "tabla_ref" style ="width:190px">
		  					<tr>
		    					<th colspan = "4">KRT OS</th> 
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">K1</td>
		    					<td><input name = "os_k1_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7;width:50%">Eje</td>
		    					<td><input name = "os_k1_eje_krt" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">K2</td>
		    					<td><input name = "os_k2_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7;width:50%">Eje</td>
		    					<td><input name = "os_k2_eje_krt" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">Ave.</td>
		    					<td><input name = "os_ave_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
		  					</tr>
						</table>
					</div>
					<div style = "float:left;margin-top: 100px; margin-left:10px;font-family: Oswald">
						<input name = "os_chk_krt" type = "checkbox"/> No medido
					</div>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Agudeza Visual
				</div>
				<div id = "labe" style = "float:left;height:180px;width:25px;background-color:#97d9c1">
					<p style ="width: 150px;transform: rotate(-90deg);margin-left: -65px;margin-top: 60px;text-align: center;font-family:Oswald;font-weight:bold;color:white;font-size:14pt"/>Sin Corrección</p>
				</div>
				<div style ="height:180px;margin-bottom:2px">
					<div class = "panel_izq">
						<table class = "av_tabla">
		  					<tr>
		    					<td style = "width:50px">Lejos:</td>
		    					<td style = "width:30px">OD</td>
		    					<td>
		    						<select name = "od_select_sc_lejos">
		    							<option>1/10</option>
		    							<option>2/10</option>
		    							<option>3/10</option>
		    							<option>4/10</option>
		    							<option>5/10</option>
		    							<option>6/10</option>
		    							<option>7/10</option>
		    							<option>8/10</option>
		    							<option>9/10</option>
		    							<option>10/10</option>
		    						</select>
		    					</td>
		  					</tr>
		  					<tr>
		  						<td  style = "border:none"></td>
		  						<td>OS</td>
		    					<td>
		    						<select name = "os_select_sc_lejos">
		    							<option>1/10</option>
		    							<option>2/10</option>
		    							<option>3/10</option>
		    							<option>4/10</option>
		    							<option>5/10</option>
		    							<option>6/10</option>
		    							<option>7/10</option>
		    							<option>8/10</option>
		    							<option>9/10</option>
		    							<option>10/10</option>
		    						</select>
		    					</td>
		  					</tr>
						</table>
					</div>
					<div class = "panel_der">
						<table class = "av_tabla">
		  					<tr>
		    					<td style = "width:50px">Cerca:</td>
		    					<td style = "width:30px">OD</td>
		    					<td>
		    						<select name = "od_select_sc_cerca">
		    							<option>1/10</option>
		    							<option>2/10</option>
		    							<option>3/10</option>
		    							<option>4/10</option>
		    							<option>5/10</option>
		    							<option>6/10</option>
		    							<option>7/10</option>
		    							<option>8/10</option>
		    							<option>9/10</option>
		    							<option>10/10</option>
		    						</select>
		    					</td>
		  					</tr>
		  					<tr>
		  						<td  style = "border:none"></td>
		  						<td>OS</td>
		    					<td>
		    						<select name = "os_select_sc_cerca">
		    							<option>1/10</option>
		    							<option>2/10</option>
		    							<option>3/10</option>
		    							<option>4/10</option>
		    							<option>5/10</option>
		    							<option>6/10</option>
		    							<option>7/10</option>
		    							<option>8/10</option>
		    							<option>9/10</option>
		    							<option>10/10</option>
		    						</select>
		    					</td>
		  					</tr>
						</table>
					</div>
				</div>
				<div id = "label" style = "float:left;height: 180px;width:25px;background-color:#97d0d9">
					<p style ="width: 150px;transform: rotate(-90deg);margin-left: -65px;margin-top: 60px;text-align: center;font-family:Oswald;font-weight:bold;color:white;font-size:14pt"/>Con Corrección</p>
				</div>
				<div style ="height:180px;margin-bottom:2px">	
					<div class = "panel_izq">
						<div style = "float:left;margin-top:25px;margin-right:10px">
							<table class = "av_tabla">
			  					<tr>
			    					<td style = "width:50px">Lejos:</td>
			    					<td style = "width:30px">OD</td>
			    					<td>
			    						<select name = "od_select_cc_lejos">
			    							<option>1/10</option>
			    							<option>2/10</option>
			    							<option>3/10</option>
			    							<option>4/10</option>
			    							<option>5/10</option>
			    							<option>6/10</option>
			    							<option>7/10</option>
			    							<option>8/10</option>
			    							<option>9/10</option>
			    							<option>10/10</option>
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td  style = "border:none"></td>
			  						<td>OS</td>
			    					<td>
			    						<select name = "os_select_cc_lejos">
			    							<option>1/10</option>
			    							<option>2/10</option>
			    							<option>3/10</option>
			    							<option>4/10</option>
			    							<option>5/10</option>
			    							<option>6/10</option>
			    							<option>7/10</option>
			    							<option>8/10</option>
			    							<option>9/10</option>
			    							<option>10/10</option>
			    						</select>
			    					</td>
			  					</tr>
							</table>
						</div>
						<div style = "float:left">
							<table class = "con_correc">
			  					<tr style ="background-color: #97d0d9">
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Esf.</td>
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Cil.</td>
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Eje</td>
			  					</tr>
			  					<tr>
			    					<td><input name = "od_esf_cc_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "od_cil_cc_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "od_eje_cc_lejos" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>
			  					<tr>
			    					<td><input name = "os_esf_cc_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "os_cil_cc_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "os_eje_cc_lejos" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>
							</table>
						</div>	
					</div>
					<div class = "panel_der">
						<div style = "float:left;margin-top:25px;margin-right:10px">
							<table class = "av_tabla">
			  					<tr>
			    					<td style = "width:50px">Cerca:</td>
			    					<td style = "width:30px">OD</td>
			    					<td>
			    						<select name = "od_select_cc_cerca">
			    							<option>1/10</option>
			    							<option>2/10</option>
			    							<option>3/10</option>
			    							<option>4/10</option>
			    							<option>5/10</option>
			    							<option>6/10</option>
			    							<option>7/10</option>
			    							<option>8/10</option>
			    							<option>9/10</option>
			    							<option>10/10</option>
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td  style = "border:none"></td>
			  						<td>OS</td>
			    					<td>
			    						<select name = "os_select_cc_cerca">
			    							<option>1/10</option>
			    							<option>2/10</option>
			    							<option>3/10</option>
			    							<option>4/10</option>
			    							<option>5/10</option>
			    							<option>6/10</option>
			    							<option>7/10</option>
			    							<option>8/10</option>
			    							<option>9/10</option>
			    							<option>10/10</option>
			    						</select>
			    					</td>
			  					</tr>
							</table>
						</div>
						<div style ="float:left">
							<table class = "con_correc">
			  					<tr style ="background-color: #97d0d9">
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Esf.</td>
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Cil.</td>
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Eje</td>
			  					</tr>
			  					<tr>
			    					<td><input name = "od_esf_cc_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "od_cil_cc_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "od_eje_cc_cerca" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>
			  					<tr>
			    					<td><input name = "os_esf_cc_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "os_cil_cc_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "os_eje_cc_cerca" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>
							</table>
						</div>	
					</div>
				</div>
				<div id = "label" style = "float:left;height: 320px;width:25px;background-color:#97afd9">
					<p style ="transform: rotate(-90deg);margin-left: -4px;margin-top: 140px;text-align: center;font-family:Oswald;font-weight:bold;color:white;font-size:14pt"/>Subjetiva</p>
				</div>
				<div style="height:320px;">
					<div class = "panel_izq">
						<div style = "float:left;margin-top:25px;margin-right:10px">
							<table class = "av_tabla">
			  					<tr>
			    					<td style = "width:50px">Lejos:</td>
			    					<td style = "width:30px">OD</td>
			    					<td>
			    						<select name = "od_select_subj_lejos">
			    							<option>1/10</option>
			    							<option>2/10</option>
			    							<option>3/10</option>
			    							<option>4/10</option>
			    							<option>5/10</option>
			    							<option>6/10</option>
			    							<option>7/10</option>
			    							<option>8/10</option>
			    							<option>9/10</option>
			    							<option>10/10</option>
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td  style = "border:none"></td>
			  						<td>OS</td>
			    					<td>
			    						<select name = "os_select_subj_lejos">
			    							<option>1/10</option>
			    							<option>2/10</option>
			    							<option>3/10</option>
			    							<option>4/10</option>
			    							<option>5/10</option>
			    							<option>6/10</option>
			    							<option>7/10</option>
			    							<option>8/10</option>
			    							<option>9/10</option>
			    							<option>10/10</option>
			    						</select>
			    					</td>
			  					</tr>
							</table>
						</div>
						<div style = "float:left">
							<table class = "subjetiva">
			  					<tr style ="background-color: #97afd9">
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Esf.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Cil.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Eje</td>
			  					</tr>
			  					<tr>
			    					<td><input name = "od_esf_subj_lejos" id = "od_esf_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "od_cil_subj_lejos" id = "od_cil_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "od_eje_subj_lejos" id = "od_eje_lejos" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>
			  					<tr>
			    					<td><input name = "os_esf_subj_lejos" id = "os_esf_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "os_cil_subj_lejos" id = "os_cil_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "os_eje_subj_lejos" id = "os_eje_lejos" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>
							</table>
						</div>	
					</div>
					<div class = "panel_der" style = "width:45%">
						<div style = "float:left;margin-top:25px;margin-right:10px">
							<table class = "av_tabla">
			  					<tr>
			  						<td  style = "border:none"></td>
			    					<td style = "width:50px">Cerca:</td>
			    					<td style = "width:30px">OD</td>
			    					<td>
			    						<select name = "od_select_subj_cerca">
			    							<option>1/10</option>
			    							<option>2/10</option>
			    							<option>3/10</option>
			    							<option>4/10</option>
			    							<option>5/10</option>
			    							<option>6/10</option>
			    							<option>7/10</option>
			    							<option>8/10</option>
			    							<option>9/10</option>
			    							<option>10/10</option>
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td></td>
			  						<td></td>
			  						<td>OS</td>
			    					<td>
			    						<select name = "os_select_subj_cerca">
			    							<option>1/10</option>
			    							<option>2/10</option>
			    							<option>3/10</option>
			    							<option>4/10</option>
			    							<option>5/10</option>
			    							<option>6/10</option>
			    							<option>7/10</option>
			    							<option>8/10</option>
			    							<option>9/10</option>
			    							<option>10/10</option>
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td></td>
			  						<td></td>
			  						<td>Add:</td>
			  						<td><input id = "adding" style ="border:3px solid #e0a8bc" pattern ="[0-9-]+.[0-9]{2}"title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>	
							</table>
						</div>
						<div style ="float:left">
							<table class = "subjetiva">
			  					<tr style ="background-color: #97afd9">
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Esf.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Cil.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Eje</td>
			  					</tr>
			  					<tr>
			    					<td><input name = "od_esf_subj_cerca" id = "od_esf_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "od_cil_subj_cerca" id = "od_cil_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "od_eje_subj_cerca" id = "od_eje_cerca" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>
			  					<tr>
			    					<td><input name = "os_esf_subj_cerca" id = "os_esf_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "os_cil_subj_cerca" id = "os_cil_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "os_eje_subj_cerca" id = "os_eje_cerca" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>
							</table>
						</div>	
					</div>
					<div class = "panel_izq" style= "margin-top:40px">
						<h3 style = "margin-right:10px;">Observaciones:</h3> <textarea name = "obs_subj" style = "margin-top:25px;width:60%;height:65px;font-size:12pt"></textarea>
					</div>	
					<div class = "panel_der" style = "margin-top:40px;">
						<div style = "float:left;margin-top:25px;margin-right:10px">
							<table class = "av_tabla">
			  					<tr>
			    					<td style = "width:50px">Media:</td>
			    					<td style = "width:30px">OD</td>
			    					<td>
			    						<select name = "od_select_subj_media">
			    							<option>1/10</option>
			    							<option>2/10</option>
			    							<option>3/10</option>
			    							<option>4/10</option>
			    							<option>5/10</option>
			    							<option>6/10</option>
			    							<option>7/10</option>
			    							<option>8/10</option>
			    							<option>9/10</option>
			    							<option>10/10</option>
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td  style = "border:none"></td>
			  						<td>OS</td>
			    					<td>
			    						<select name = "os_select_subj_media">
			    							<option>1/10</option>
			    							<option>2/10</option>
			    							<option>3/10</option>
			    							<option>4/10</option>
			    							<option>5/10</option>
			    							<option>6/10</option>
			    							<option>7/10</option>
			    							<option>8/10</option>
			    							<option>9/10</option>
			    							<option>10/10</option>
			    						</select>
			    					</td>
			  					</tr>
							</table>
						</div>
						<div style ="float:left">
							<table class = "subjetiva">
			  					<tr style ="background-color: #97afd9">
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Esf.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Cil.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Eje</td>
			  					</tr>
			  					<tr>
			    					<td><input name = "od_esf_subj_media" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "od_cil_subj_media" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "od_eje_subj_media" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>
			  					<tr>
			    					<td><input name = "os_esf_subj_media" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "os_cil_subj_media" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			    					<td><input name = "os_eje_subj_media" pattern ="[0-9-]{1,3}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00"/></td>
			  					</tr>
							</table>
						</div>	
					</div>
				</div>			
			</div>
			<div class = "separador">
				<div class = "titulo" style ="margin-top:-25px">
					Presión Intraocular
				</div>
				<div class = "panel_izq" style ="margin-left:20px">
					<table>
	  					<tr>
	    					<td style = "border:none;width: 30px;">OD</td>
	    					<td style = "border:none;border-bottom:1px solid"><input name = "od_presion" pattern ="[0-9.]{1,}"/></td>
	  					</tr>
					</table>
				</div>
				<div class ="panel_der">
					<table>
	  					<tr>
	    					<td style = "border:none;width: 30px;">OS</td>
	    					<td style = "border:none;border-bottom:1px solid"><input name = "os_presion"pattern ="[0-9.]{1,}"/></td>
	  					</tr>
					</table>
				</div>
				<div class = "panel_izq" style = "margin-top:40px;width:100%">
					<h3 style = "margin-right:10px">Observaciones:</h3> <textarea name = "obs_presion" style = "margin-top:25px;width:76%;height:100px;font-size:14pt"></textarea>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Biomicroscopía
				</div>
				<div class = "panel_izq" style= "margin-left:20px">
					<table class="tabla_esp">
	  					<tr>
	    					<td style = "border:none;width: 30px;">OD</td>
	    					<td style = "border:none"><textarea name = "od_bio" style = "margin-top:25px;height:100px;width:90%;font-size:14pt"></textarea></td>
	  					</tr>
					</table>
				</div>
				<div class ="panel_der">
					<table class="tabla_esp">
	  					<tr>
	    					<td style = "border:none;width: 30px;">OS</td>
	    					<td style = "border:none"><textarea name = "os_bio" style = "margin-top:25px;height:100px;width:90%;font-size:14pt"></textarea></td>
	  					</tr>
					</table>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Fondo de Ojos
				</div>
				<div class = "panel_izq" style ="margin-left:20px">
					<table class="tabla_esp">
	  					<tr>
	    					<td style = "border:none;width: 30px;">OD</td>
	    					<td style = "border:none"><textarea name = "od_fo" style = "margin-top:25px;height:100px;width:90%;font-size:14pt"></textarea></td>
	  					</tr>
					</table>
				</div>
				<div class ="panel_der">
					<table class="tabla_esp">
	  					<tr>
	    					<td style = "border:none;width: 30px;">OS</td>
	    					<td style = "border:none"><textarea name = "os_fo" style = "margin-top:25px;height:100px;width:90%;font-size:14pt"></textarea></td>
	  					</tr>
					</table>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Diagnóstico
				</div>
				<div style ="margin-left:20px">
	    			<textarea name = "txt_diag" style = "margin-top:25px;width:92%;height:150px;font-size:14pt"></textarea>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Solicitud de Estudios/Análisis
				</div>
				<div class ="panel_izq" style ="margin-left:20px">
					<table class = "solicitud_tabla">
						<tr>
							<td>
								<input name = "chk_sol[]" value = "CVC" type = "checkbox"/> CVC 			
							</td>
							<td>
								<input name = "chk_sol[]" value = "IOL" type = "checkbox"/> IOL 			
							</td>
							<td>
								<input name = "chk_sol[]" value = "OCT" type = "checkbox"/> OCT			
							</td>
						</tr>
						<tr>
							<td>
								<input name = "chk_sol[]" value = "ME" type = "checkbox"/> ME			
							</td>
							<td>
								<input name = "chk_sol[]" value = "RFG" type = "checkbox"/> RFG 			
							</td>
							<td>
								<input name = "chk_sol[]" value = "RFG Color" type = "checkbox"/> RFG Color 			
							</td>
						</tr>
						<tr>
							<td>
								<input name = "chk_sol[]" value = "HRT" type = "checkbox"/> HRT			
							</td>
							<td>
								<input name = "chk_sol[]" value = "OBI" type = "checkbox"/> OBI			
							</td>
							<td>
								<input name = "chk_sol[]" value = "PAQUI" type = "checkbox"/> PAQUI 			
							</td>
						</tr>
						<tr>	
							<td>
								<input name = "chk_sol[]" value = "Laser" type = "checkbox"/> Laser			
							</td>
							<td>
								<input name = "chk_sol[]" value = "YAG" type = "checkbox"/> YAG
							</td>
							<td>
								<input name = "chk_sol[]" value = "Ecografía" type = "checkbox"/> Ecografía
							</td>
						</tr>
					</table>
				</div>
				<div class ="panel_der">
					<h3 style = "margin-right:10px">Otros:</h3>
	    			<textarea name = "obs_sol" style = "margin-top:25px;height:100px;width:75%;font-size:14pt"></textarea>
				</div>	
			</div>
			<div class = "separador">
				<div class = "titulo">
					Indicación
				</div>
				<div style ="margin-left:20px">
	    			<textarea name = "txt_indic" style = "margin-top:25px;width:92%;height:150px;font-size:14pt"></textarea>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Observaciones
				</div>
				<div style ="margin-left:20px">
	    			<textarea name = "txt_obs" style = "margin-top:25px;width:92%;height:150px;font-size:14pt"></textarea>
				</div>
			</div>
			<div>
				<button type = "submit">Enviar</button>
			</div>
			<input type="hidden" name="paciente" value = <?php echo $paciente ?> />
			
		</form>	
	</body>	
</html>		