<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Turnos</title>
	<link href="./css/template.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="./js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="./js/jquery-ui-1.8.24.custom.min.js"></script>
	<link href="./css/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<style>
	.ui-widget {
		font-size: 30pt;
	}
	.ui-dialog {
		position: relative;
		margin: auto;
	}

	.search_form input[type="text"] {
    	background: url(search-white.png) no-repeat 10px 6px #fcfcfc;
    	border: 1px solid #d1d1d1;
    	font: bold 40px 'Segoe';
    	width: 350px;
    	height: 50px;
    	padding: 6px 15px 6px 35px;
    	-webkit-border-radius: 15px;
    	-moz-border-radius: 15px;
    	border-radius: 15px;
    	text-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
    	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    	-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    }

	</style>
	<script>

	$(document).ready(function()
	{	
		
		$(".fila_ocupada").click(function(event)
		{
			event.preventDefault();

			var id = $(this).attr("id");

			var datastring = "posteo="+id;
			$.ajax({

					type: 'POST',
 					url: "./cosa.php",
 					data: datastring,
					success:function(response)
					{
						$("#detalles").html(response);
					},
			});

		});
	});



    function chequear(url,data) {
        $( "#dialog-confirm" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 800,
            height:240,
            modal: true,
            buttons: {
                "Si": function() {
					var x = url+"/cambiar_turno/"+data;
					location.href = x;
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
		
	</script>	
</head>
<body>

<?php

	if (!isset($_GET['dia'])) {
		$fecha = date('Y-m-d');
	}
	else { 

		$fecha= $_GET['dia'];
	}
	

	$conexion = mysql_connect("localhost","root","root")
	or die ("Fallo en el establecimiento de la conexión");

	#Seleccionamos la base de datos a utilizar
	mysql_select_db("cco")
	or die("Error en la selección de la base de datos");

	$query = sprintf("SELECT * FROM turnos 
    WHERE fecha LIKE '%s' ", $fecha);

    $result = mysql_query($query)
	or die("Error en la consulta SQL");

	#Mostramos los resultados obtenidos
	
	$fila = mysql_fetch_object( $result );

		//switch ($row[]);
?>

<div id = "menu">
	<div id = "dia_anterior">
		<?php 
			$dia_anterior = strtotime("-1 day", strtotime($fecha));
			echo '<a href="main.php?dia='.date('Y-m-d',$dia_anterior).'">';	
				echo '<img src = "./css/images/atras.png"/>';
			echo '</a>';
		?>
	</div>
	<div id = "hoy">
		<?php 
			echo '<a href="main.php?dia='.date('Y-m-d').'">';	
				echo '<img src = "./css/images/hoy.png"/>';
			echo '</a>';
		?>	
	</div>
	<div id = "dia_siguiente">
		<?php 
			$dia_siguiente = strtotime("+1 day", strtotime($fecha));
			echo '<a href="main.php?dia='.date('Y-m-d',$dia_siguiente).'">';	
				echo '<img src = "./css/images/adelante.png"/>';
			echo '</a>';
		?>
	</div>
	
	<div id = "fecha_dia">
		<?php echo $fecha ?>
	</div>
	<div class="count">
			<?php 	
			/*		if ($fila == 0) {
						echo "0";
					}
					else {
						echo count($fila);
					}
*/			?>
	</div>
	<div id = "agregar_notas">
		<?php
		echo '<a href="#">'; 
			echo "Agregar Notas";//'<img src = "'.base_url('css/images/notas.png').'"/>';  
		echo '</a>';
		?>
	</div>
	<div id = "principal">
		<?php
		echo '<a href="#">'; 
			echo "Home";//'<img src = "'.base_url('css/images/home.png').'"/>'; 
		echo '</a>';
		?>
	</div>
	<div id = "calendario">
		<?php
		echo '<a href="#">';
			echo "Calendario"; //'<img src = "'.base_url('css/images/calendar.png').'"/>'; 
		echo '</a>';
		?>
	</div>
</div>

<div id = "horarios">
<?php
	
	//foreach ($filas as $fila) {
	while($fila = mysql_fetch_object( $result )) {

			$hora_completa = date('H:i', strtotime($fila->hora));
			
			//echo '<div class = "fila_ocupada" onclick = "location.href=\''.base_url("/index.php/main/vista_turno/".$fila->id).'\';" style="cursor: pointer;">';
			echo '<div class = "fila_ocupada" id = "'.$fila->id.'" style="cursor: pointer;">';
				echo '<div class = "fila_superior">';
					echo '<div class = "nombre_apellido">'; 	
						echo $fila->nombre.' '.$fila->apellido;
					echo '</div>';
					
					echo '<div class = "hora_ocupada">';
						echo '<a name="'.$hora_completa.'">'.$hora_completa.'</a>';
					echo '</div>';
				echo '</div>';	
				echo '<div class = "datos">';
					
					echo '<div class = "campos">';
						echo "Médico: ";
					echo '</div>';
					echo '<div class = "valores">';
						$auxi = explode(' - ', $fila->medico);
						$med = $auxi[0];
						if ($med == "Otro") {
							echo $auxi[1];
						}
						else {
							echo $fila->medico;	
						}
					echo '</div>';
					echo '<div class = "campos">';
						echo "Tipo de Turno: ";
					echo '</div>';
					echo '<div class = "valores tipo">';
						echo $fila->tipo;
					echo '</div>';
					echo '<div class = "campos">';
						echo "Nro de ficha: ";
					echo '</div>';
					echo '<div class = "valor_ficha">';
						if ($fila->ficha == -1) {
					?>		
							<a href="#" id = "submit">Nuevo paciente</a>
							<!-- echo anchor('main/nuevo_paciente', 'Nuevo Paciente'); -->
					<?php	
						}	
						else if ($fila->ficha == -2) {	
							echo anchor('main/buscar_paciente', 'Buscar..');
						}
						else {
							echo anchor('main/buscar_ficha/'.$fila->ficha, $fila->ficha);
						}		
					echo '</div>';
					echo '<div id = "estado">';
					/*
					$hora = date('H', strtotime($fila->hora));
					$minutos = date('i', strtotime($fila->hora));
					$data = $fecha.'/'.$hora.'/'.$minutos;
					
					if ($fila->estado == "")
					{
						echo '<a href="'.base_url('index.php/main/cambiar_estado/1/'.$fila->id.'/'.$data).'">'; 
							//echo '<img src = "'.base_url('css/images/ausente.png').'"/>'; 
						echo '</a>';
					}
					else	
					{	
						echo '<a href="'.base_url('index.php/main/cambiar_estado/0/'.$fila->id.'/'.$data).'">'; 
							//echo '<img src = "'.base_url('css/images/presente.png').'"/>'; 
						echo '</a>';
					}
					*/
					echo '</div>';
				echo '</div>';
			echo '</div>';		
	}

?>
</div>
<div id = "detalles"></div>
</body>
</html>
