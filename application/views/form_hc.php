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
				width: 50%;
				margin-left: 20px;
				margin-top: 20px;
			}

			.panel_der {
				float: left;
				//margin-left: 100px;
				width: 40%;
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
				border:none;
			}

			.av_tabla select {
				font-size: 12pt;
				background-color: #F7F7F7;
			}

			.solicitud_tabla td {
				width: 120px;
				border:none;
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
		</style>
	</head>
	<body>
		<div>
			<h3 style = "margin-left:10px"> Motivo de consulta: </h3> <textarea style ="font-size:14pt;width:620px;height:100px;margin-right:20px;margin-top:20px;float:right" name = "registro" required></textarea>
		</div>
		<div class = "separador">
			<div class = "titulo">
				Refractometría
			</div>
			<div class = "panel_izq">
				<div style = "float:left">
					<table>
	  					<tr>
	  						<th style = "border:none"></th>
	    					<th colspan = "3">ARM Sin Dilatación</th> 
	  					</tr>
	  					<tr>
	  						<td style = "border:none"></td>
	    					<td>Esf.</td>
	    					<td>Cil.</td>
	    					<td>Eje</td>
	  					</tr>
	  					<tr>
	  						<td style = "width:40px;text-align:left;border:none"> OD </td>
	    					<td><input pattern = "[0-9.-]"/></td>
	    					<td><input pattern = "[0-9.-]"/></td>
	    					<td><input pattern = "[0-9.-]"/></td>
	  					</tr>
	  					<tr>
	  						<td style = "width:40px;text-align:left;border:none"> OS </td>
	    					<td><input pattern = "[0-9.-]"/></td>
	    					<td><input pattern = "[0-9.-]"/></td>
	    					<td><input pattern = "[0-9.-]"/></td>
	  					</tr>
					</table>
				</div>
				<div style ="float:left">
					<div style = "margin-top: 75px; margin-left:10px;font-family: Oswald">
						<input type = "checkbox"/> No medido
					</div>
					<div style = "margin-top: 5px; margin-left:10px;font-family: Oswald">
						<input type = "checkbox"/> No medido
					</div>	
				</div>	
			</div>
			<div class = "panel_der">
				<div style = "float:left">
					<table>
	  					<tr>
	  						<th style = "border:none"></th>
	    					<th colspan = "4">ARM Con Dilatación</th> 
	  					</tr>
	  					<tr>
	  						<td style = "border:none"></td>
	    					<td>Esf.</td>
	    					<td>Cil.</td>
	    					<td>Eje</td>
	  					</tr>
	  					<tr>
	  						<td style = "width:40px;text-align:left;border:none"> OD </td>
	    					<td><input pattern = "[0-9.]"/></td>
	    					<td><input pattern = "[0-9.]"/></td>
	    					<td><input pattern = "[0-9.]"/></td>
	  					</tr>
	  					<tr>
	  						<td style = "width:40px;text-align:left;border:none"> OS </td>
	    					<td><input pattern = "[0-9.]"/></td>
	    					<td><input pattern = "[0-9.]"/></td>
	    					<td><input pattern = "[0-9.]"/></td>
	  					</tr>
					</table>
				</div>
				<div style ="float:left">
					<div style = "margin-top: 75px; margin-left:10px;font-family: Oswald">
						<input type = "checkbox"/> No medido
					</div>
					<div style = "margin-top: 5px; margin-left:10px;font-family: Oswald">
						<input type = "checkbox"/> No medido
					</div>	
				</div>			
			</div>
			<div class = "panel_izq" style = "margin-left:62px;margin-top:40px">
				<div style = "float:left">
					<table style ="width:180px">
	  					<tr>
	    					<th colspan = "4">KRT OD</th> 
	  					</tr>
	  					<tr>
	    					<td>K1</td>
	    					<td><input pattern = "[0-9.]"/></td>
	    					<td>Eje</td>
	    					<td><input pattern = "[0-9.]"/></td>
	  					</tr>
	  					<tr>
	    					<td>K2</td>
	    					<td><input pattern = "[0-9.]"/></td>
	    					<td>Eje</td>
	    					<td><input pattern = "[0-9.]"/></td>
	  					</tr>
	  					<tr>
	    					<td>Ave.</td>
	    					<td colspan = "4"><input pattern = "[0-9.]"/></td>
	  					</tr>
					</table>
				</div>
				<div style = "float:left;margin-top: 100px; margin-left:10px;font-family: Oswald">
					<input type = "checkbox"/> No medido
				</div>		
			</div>
			<div class = "panel_der" style = "margin-top:40px">
				<div style = "float:left">
					<table style ="width:180px">
	  					<tr>
	    					<th colspan = "4">KRT OS</th> 
	  					</tr>
	  					<tr>
	    					<td>K1</td>
	    					<td><input pattern = "[0-9.]"/></td>
	    					<td>Eje</td>
	    					<td><input pattern = "[0-9.]"/></td>
	  					</tr>
	  					<tr>
	    					<td>K2</td>
	    					<td><input pattern = "[0-9.]"/></td>
	    					<td>Eje</td>
	    					<td><input pattern = "[0-9.]"/></td>
	  					</tr>
	  					<tr>
	    					<td>Ave.</td>
	    					<td colspan = "4"><input pattern = "[0-9.]"/></td>
	  					</tr>
					</table>
				</div>
				<div style = "float:left;margin-top: 100px; margin-left:10px;font-family: Oswald">
					<input type = "checkbox"/> No medido
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
	    						<select>
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
	    						<select>
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
	    						<select>
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
	    						<select>
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
		    						<select>
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
		    						<select>
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
						<table>
		  					<tr style ="background-color: #97d0d9">
		    					<td style ="background-color: #97d0d9">Esf.</td>
		    					<td style = "background-color:#cfe9ed">Cil.</td>
		    					<td style = "background-color:#e2f2f4">Eje</td>
		  					</tr>
		  					<tr>
		    					<td><input style ="background-color: #97d0d9" pattern = "[0-9.]"/></td>
		    					<td><input style = "background-color:#cfe9ed" pattern = "[0-9.]"/></td>
		    					<td><input style = "background-color:#e2f2f4" pattern = "[0-9.]"/></td>
		  					</tr>
		  					<tr>
		    					<td><input style ="background-color: #97d0d9" pattern = "[0-9.]"/></td>
		    					<td><input style = "background-color:#cfe9ed" pattern = "[0-9.]"/></td>
		    					<td><input style = "background-color:#e2f2f4" pattern = "[0-9.]"/></td>
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
		    						<select>
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
		    						<select>
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
						<table>
		  					<tr style ="background-color: #97d0d9">
		    					<td>Esf.</td>
		    					<td>Cil.</td>
		    					<td>Eje</td>
		  					</tr>
		  					<tr style = "background-color:#cfe9ed"> 
		    					<td><input style = "background-color:#cfe9ed" pattern = "[0-9.]"/></td>
		    					<td><input style = "background-color:#cfe9ed" pattern = "[0-9.]"/></td>
		    					<td><input style = "background-color:#cfe9ed" pattern = "[0-9.]"/></td>
		  					</tr>
		  					<tr style = "background-color:#e2f2f4">
		    					<td><input style = "background-color:#e2f2f4" pattern = "[0-9.]"/></td>
		    					<td><input style = "background-color:#e2f2f4" pattern = "[0-9.]"/></td>
		    					<td><input style = "background-color:#e2f2f4" pattern = "[0-9.]"/></td>
		  					</tr>
						</table>
					</div>	
				</div>
			</div>
			<div id = "label" style = "float:left;height: 280px;width:25px;background-color:#97afd9">
				<p style ="transform: rotate(-90deg);margin-left: -4px;margin-top: 140px;text-align: center;font-family:Oswald;font-weight:bold;color:white;font-size:14pt"/>Subjetiva</p>
			</div>
			<div style="height:280px;">
				<div class = "panel_izq" style ="width:48%">
					<div style = "float:left;margin-top:25px;margin-right:10px">
						<table class = "av_tabla">
		  					<tr>
		    					<td style = "width:50px">Lejos:</td>
		    					<td style = "width:30px">OD</td>
		    					<td>
		    						<select>
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
		    						<select>
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
						<table>
		  					<tr>
		    					<td>Esf.</td>
		    					<td>Cil.</td>
		    					<td>Eje</td>
		  					</tr>
		  					<tr>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		  					</tr>
		  					<tr>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		  					</tr>
						</table>
					</div>	
				</div>
				<div class = "panel_der">
					<div style = "float:left;margin-top:25px;margin-right:10px">
						<table class = "av_tabla">
		  					<tr>
		  						<td  style = "border:none"></td>
		    					<td style = "width:50px">Cerca:</td>
		    					<td style = "width:30px">OD</td>
		    					<td>
		    						<select>
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
		  						<td>Add</td>
		  						<td><input style ="border:1px solid" pattern = "[0-9.]"/></td>
		  						<td>OS</td>
		    					<td>
		    						<select>
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
						<table>
		  					<tr>
		    					<td>Esf.</td>
		    					<td>Cil.</td>
		    					<td>Eje</td>
		  					</tr>
		  					<tr>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		  					</tr>
		  					<tr>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		  					</tr>
						</table>
					</div>	
				</div>
				<div class = "panel_izq" style= "margin-top:40px">
					<h3 style = "margin-right:10px;">Observaciones:</h3> <textarea style = "margin-top:25px;width:60%;height:65px;font-size:12pt"></textarea>
				</div>	
				<div class = "panel_der" style = "margin-top:40px;">
					<div style = "float:left;margin-top:25px;margin-right:10px">
						<table class = "av_tabla">
		  					<tr>
		    					<td style = "width:50px">Media:</td>
		    					<td style = "width:30px">OD</td>
		    					<td>
		    						<select>
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
		    						<select>
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
						<table>
		  					<tr>
		    					<td>Esf.</td>
		    					<td>Cil.</td>
		    					<td>Eje</td>
		  					</tr>
		  					<tr>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		  					</tr>
		  					<tr>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
		    					<td><input pattern = "[0-9.]"/></td>
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
    					<td style = "border:none;border-bottom:1px solid"><input pattern = "[0-9.]"/></td>
  					</tr>
				</table>
			</div>
			<div class ="panel_der">
				<table>
  					<tr>
    					<td style = "border:none;width: 30px;">OS</td>
    					<td style = "border:none;border-bottom:1px solid"><input pattern = "[0-9.]"/></td>
  					</tr>
				</table>
			</div>
			<div class = "panel_izq" style = "margin-top:40px;width:100%">
				<h3 style = "margin-right:10px">Observaciones:</h3> <textarea style = "margin-top:25px;width:76%;height:100px;font-size:14pt"></textarea>
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
    					<td style = "border:none"><textarea style = "margin-top:25px;height:100px;width:80%;font-size:14pt"></textarea></td>
  					</tr>
				</table>
			</div>
			<div class ="panel_der">
				<table class="tabla_esp">
  					<tr>
    					<td style = "border:none;width: 30px;">OS</td>
    					<td style = "border:none"><textarea style = "margin-top:25px;height:100px;width:100%;font-size:14pt"></textarea></td>
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
    					<td style = "border:none"><textarea style = "margin-top:25px;height:100px;width:80%;font-size:14pt"></textarea></td>
  					</tr>
				</table>
			</div>
			<div class ="panel_der">
				<table class="tabla_esp">
  					<tr>
    					<td style = "border:none;width: 30px;">OS</td>
    					<td style = "border:none"><textarea style = "margin-top:25px;height:100px;width:100%;font-size:14pt"></textarea></td>
  					</tr>
				</table>
			</div>
		</div>
		<div class = "separador">
			<div class = "titulo">
				Diagnóstico
			</div>
			<div style ="margin-left:20px">
    			<textarea style = "margin-top:25px;width:92%;height:150px;font-size:14pt"></textarea>
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
							<input type = "checkbox"/> CVC 			
						</td>
						<td>
							<input type = "checkbox"/> IOL 			
						</td>
						<td>
							<input type = "checkbox"/> OCT			
						</td>
					</tr>
					<tr>
						<td>
							<input type = "checkbox"/> ME			
						</td>
						<td>
							<input type = "checkbox"/> RFG 			
						</td>
						<td>
							<input type = "checkbox"/> RFG Color 			
						</td>
					</tr>
					<tr>
						<td>
							<input type = "checkbox"/> HRT			
						</td>
						<td>
							<input type = "checkbox"/> OBI			
						</td>
						<td>
							<input type = "checkbox"/> PAQUI 			
						</td>
					</tr>
					<tr>	
						<td>
							<input type = "checkbox"/> Laser			
						</td>
						<td>
							<input type = "checkbox"/> YAG			
						</td>
						<td>
							<input type = "checkbox"/> Ecografía
						</td>
					</tr>
				</table>
			</div>
			<div class ="panel_der">
				<h3 style = "margin-right:10px">Otros:</h3>
    			<textarea style = "margin-top:25px;height:100px;width:75%;font-size:14pt"></textarea>
			</div>	
		</div>
		<div class = "separador">
			<div class = "titulo">
				Indicación
			</div>
			<div style ="margin-left:20px">
    			<textarea style = "margin-top:25px;width:92%;height:150px;font-size:14pt"></textarea>
			</div>
		</div>
		<div class = "separador">
			<div class = "titulo">
				Observaciones
			</div>
			<div style ="margin-left:20px">
    			<textarea style = "margin-top:25px;width:92%;height:150px;font-size:14pt"></textarea>
			</div>
		</div>
	</body>	
</html>		