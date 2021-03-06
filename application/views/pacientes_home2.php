<!DOCTYPE html>

<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Pacientes</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<script>
	$(document).ready(function() {

		 $( "#busqueda_texto" ).autocomplete({
			minLength: 2,
      		source: "http://consultoriocco.dyndns.org/cco/search.php",
      //focus: function( event, ui ) {
       // $( "#project" ).val( ui.item.label );
       // return false;

      //},
		    select: function( event, ui ) {

         	var x = "test.html/"+(ui.item.value);
          	location.href = x;

	        $( "#busqueda_texto" ).val( ui.item.label );
	        //$( "#project-id" ).val( ui.item.value );
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
  	});
	

		$(function() {
        var availableTags = [
            "AAPM - Propag. Med.",
			"ACA Salud",
			"ACINDAR",
			"Agua y Energía",
			"AMR",
			"AMUR",
			"APSOT",
			"Asoc. Española",
			"Caja Forense",
			"Caja Ingenieros",
			"Camioneros - Mutual",
			"Ciencias Económicas",
			"Docthos",
			"Emedic",
			"EPE-SMAI",
			"Federación Médica",
			"Femedic",
			"Fuerza Aérea",
			"Galeno",
			"Grupo Oroño",
			"IAPOS",
			"IOSE",
			"IPAM",
			"Jerárquico Salud",
			"Luis Pasteur",
			"Luz y Fuerza",
			"Luz y Fuerza - Mutual",
			"Medicus",
			"Medife",
			"Mutual Federada",
			"OMINT",
			"OSDEA",
			"OSDOP",
			"OSPAC",
			"OSPAGA",
			"OSPESGA",
			"OSPI Maderera",
			"OSSIMRA",
			"Particular",
			"Patrones de Cabotaje",
			"Poder Judicial",
			"Prensa - OSPRO",
			"Publicidad",
			"SADAIC",
			"San Pedro",
			"SAT Televisión",
			"SERVE Salud",
			"Sind. Camioneros",
			"Swiss Medical",
			"Teleg. y Radioteleg.",
			"Universidad"
        ];
        $( "#obra" ).autocomplete({
            source: availableTags
        });
    });
	</script>
	<style>

		.form_busqueda button {height: 22px; width: 65px; font-size: 14px}

		.form_busqueda input {padding-left: 20px; height: 0px; width: 230px; font-size: 15px; background: white url("http://consultoriocco.dyndns.org/cco/css/images/magnifying_glass_16x16.png") no-repeat 0% center;}

		.form_busqueda input:focus {background: white url("http://consultoriocco.dyndns.org/cco/css/images/magnifying_glass_16x16.png") no-repeat 0% center;}

		.ui-menu .ui-menu-item a { font-size: 12px}


		.ui-autocomplete {

	        max-height: 300px;
	        width: 300px;
	        overflow-y: auto;
	        /* prevent horizontal scrollbar */
	        overflow-x: hidden;
	    }

	    /* IE 6 doesn't support max-height
	     * we use height instead, but this forces the menu to always be this tall
	     */
	    * html .ui-autocomplete {
	        height: 100px;

	        font-size: 12px;
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

		.contact_form textarea {
			width: 563px;
		}
	</style>
</head>
<body>
<?php 
	if (!isset($nombre)) {
		$nombre = "";
	}

	if (!isset($apellido)) {
		$apellido = "";
	}

	if (!isset($ficha)) {
		$ficha = "";
	}

	if (!isset($obra)) {
		$obra = "";
	}

	if (!isset($tel1_1)) {
		$tel1_1 = "0341";
	}
	
	if (!isset($tel1_2)) {
		$tel1_2 = "";
	}

	if (!isset($tel2_1)) {
		$tel2_1 = "";
	}

	if (!isset($tel2_2)) {
		$tel2_2 = "";
	}
		
?>	
<!--
	<div id = "barra_superior">
		Pacientes - Home - Turnos	
	</div>
-->	
	<div id = "busqueda_pacientes">
			<div style = "float:left; color:white; font-family:Oswald; margin-left: 10px; margin-top: 5px">
				Ingreso de Pacientes
			</div>

			<div style = "float:left; margin-left:57%; margin-top:5px">
				<?php
				echo '<a href="'.base_url('index.php').'">'; 
					echo '<img src = "'.base_url('css/images/home_24x24.png').'"/>'; 
				echo '</a>';
				?>
			</div>

			<div style = "float:left; margin-left:2%; margin-top:8px">
				<?php
				echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date("Y-m-d")).'">';
					echo '<img src = "'.base_url('css/images/book_alt2_24x21.png').'"/>'; 
				echo '</a>';
				?>
			</div>
				
			<div id = "busqueda">
				<form class="form_busqueda" action="<?php echo base_url('index.php/main/busqueda')?>" method="post" name="search_form" id="search_form">

  						<input name="busqueda_texto" id = "busqueda_texto" autocomplete="off" placeholder="Busqueda de pacientes..." required/>	
					
				</form>	
			
			</div>
	</div>	
	<div id = "parte_der">
<!--
		<div class = "subtitulo">
			<div style = "width: 40%; float: left;padding-left:10px"> Ingreso de pacientes </div>
		</div>
-->
		<form class="contact_form" action="<?php echo base_url('index.php/main/pro_nuevo_paciente')?>" method="post" name="contact_form" id="contact_form">

		<div id = "ingreso_pacientes_izq">
			
				<ul>
					<li>
						<label for="nombre"><font color = "red">* </font> Nombre:</label>
	            		<input type="text" size = "15" name="nombre" autocomplete="off" style="text-transform:capitalize" value = "<?php echo $nombre ?>" required/>
					</li>
					<li>
						<label for="apellido"><font color = "red">* </font> Apellido:</label>
	            		<input type="text" size = "15" name="apellido" autocomplete="off" style="text-transform:capitalize" value = "<?php echo $apellido ?>" required/>
					</li>
					<li style = "height: 90px">
						<label for="ficha"><font color = "red">* </font> Nro de Ficha:</label>
	            		<input type="text" size = "15" name="ficha" autocomplete="off" style="text-transform:capitalize" value = "<?php echo $ficha ?>" required/>
					</li>
				</ul>	
		</div>

		<div id = "ingreso_pacientes_cent">
			
				<ul>
					<li>
						<label for="nombre"> DNI:</label>
	            		<input type="text" size = "15" name="dni" autocomplete="off" style="text-transform:capitalize"/>
					</li>
					<li>
						<label for="nombre"> Fecha de nacimiento:</label>
	            		<input type="date" style = "width:141px" min = "01-01-1900" name="fecha" autocomplete="off" style="text-transform:capitalize"/>
					</li>
					<li>
						<label for="apellido"> Localidad:</label>
	            		<input type="text" size = "15" name="localidad" autocomplete="off" style="text-transform:capitalize"/>
					</li>
					<li>
						<label for="ficha"> Dirección:</label>
	            		<input type="text" size = "15" name="direccion" autocomplete="off" style="text-transform:capitalize"/>
					</li>
				</ul>	
			
		</div>

		<div id = "ingreso_pacientes_der">
			
				<ul>
					<li>	
		            	<label for="tel1_1"> Teléfono 1:</label>
		            	<input type="text" size="3" maxlength = "5" name="tel1_1" id="tel1_1" value= "<?php echo $tel1_1 ?>" autocomplete="off" onFocus="if (this.value=='0341') this.value='';" pattern="[0-9].{2,}"/>
				    	<input type="text" size = "8" maxlength = "10" name="tel1_2" id="tel1_2" value = "<?php echo $tel1_2 ?>" autocomplete="off" pattern="[0-9].{5,}"/>
	        		</li>
					<li>
		            	<label for="tel2_1">Teléfono 2:</label>
		            	<input type="text" size="3" maxlength = "5" name="tel2_1" id ="tel2_1" value= "<?php echo $tel2_1 ?>" autocomplete="off" pattern="[0-9].{2,}"/>
						<input type="text" size = "8" maxlength = "10" name="tel2_2" id ="tel2_2" value= "<?php echo $tel2_2 ?>" autocomplete="off" pattern="[0-9].{5,}"/>
					</li>	
					<li>
						<label for="obra"> Obra social:</label>
						<div class="ui-widget">
							<input type="text" size = "18" id="obra" name ="obra" value = "<?php echo $obra ?>" = autocomplete="off">
						</div>
					</li>
					<li>
						<label for="apellido"> Nro de afiliado:</label>
	            		<input type="text" size = "15" name="nro_afiliado" autocomplete="off" style="text-transform:capitalize"/>
					</li>
				</ul>	
			
		</div>

		<div id = "observaciones">
	            	<label for="obs">Observaciones:</label>
	            	<textarea name="obs" cols="40" rows="6"></textarea>
		</div>				
			<div id = "guardar_paciente">
				<button class="submit" type="submit">Ingresar Paciente</button>
			</div>	
	</form>	
	</div>
	<span class="required_notification" style = "margin-top: 0px;float: left">* Campos obligatorios</span>	
</body>
</html>	

