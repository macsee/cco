<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Nuevo Turno</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<style>

	.ui-widget {
		font-size: 12pt;
	}
	.ui-dialog {
		position: relative;
		margin: auto;
	}

	.contact_form textarea {width: 500px;}

	</style>
	
	<script>
	
    function chequear(url,data) {
        $( "#dialog-confirm" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 800,
            height:240,
            modal: true,
            buttons: {
                "Si": function() {
					var x = url+"/eliminar_nota/"+data;
					location.href = x;
                },
				"No": function() {
                    $( this ).dialog( "close" );
				}
            }
        });
   };
		
	</script>
</head>
<body>
	
<div id="dialog-confirm" title="¿Eliminar nota?"></div>	
	
<div class = "titulo">	
		<div id = "nuevo_turno">
			Notas del día
		</div>	
		<div id= "fecha1">
			<?php 
				echo $dia." ".$nombre_dia.", ".$mes." ".$ano;
			?>
		</div>
     <!-- <span class="required_notification">* Campos obligatorios</span> -->
	</div>	
	<form class="contact_form" action="<?php echo base_url('index.php/main/pro_edit_notas/')?>" method="post" name="contact_form">
	
	<div id = "ul5">
		<ul>
			<li>
				<textarea name="notas" cols="40" rows="6" required><?php echo $notas?></textarea>
				<input type="hidden" name="fecha" value="<?php echo $fecha ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<?php 
					$data = $fecha.'/'.$id;
				?>
			</li>
		</ul>
	</div>	
	<div id = "ul6">
		<button class="submit" type="submit">Actualizar</button>
		<?php echo '<button class="delete" type = "button" onclick = "return chequear(\''.base_url("/index.php/main/").'\', \''.$data.'\');"> Eliminar </button>'; ?>
		<button class="cancel" type = "button" onclick = "location.href= '<?php echo base_url("/index.php/main/cambiar_dia/$fecha")?>';">Cancelar</button>
	</div>	
	</form>
</body>
</html>
