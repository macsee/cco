<!DOCTYPE html>

<html>
  <head>
    <title>Historia Clinica</title>
    <link href="<?php echo base_url('js/Shadowbox/shadowbox.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/shadowbox/shadowbox.js')?>"></script>
  </head>
  <body>

<div id = "form_estudios" style = "background-color:white">
			<form action="<?php echo base_url('index.php/main/do_upload')?>" method="post" enctype="multipart/form-data">

					<input type="file" multiple name="userfile[]" size="20" />
					<input type="hidden" name="paciente" value = <?php echo $paciente ?> />
					<select id = "tipo" name = "tipo" required>
						<option value="">Seleccionar</option>
		  				<option value="OCT">OCT</option>
		  				<option value="RFG">RFG</option>
		  				<option value="ME">ME</option>
		  				<option value="IOL">IOL</option>
		  				<option value="CVC">CVC</option>
		  				<option value="TOPO">TOPO</option>
					</select> 
					<br /><br />

					<input type="submit" value="Subir archivo" />

				</form>
		</div>

</body>
</html>		