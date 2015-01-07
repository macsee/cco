<!DOCTYPE html>

<html>
  <head>
    <title>Historia Clinica</title>
  </head>
  <body>

<div id = "form_estudios" style = "color: white">
			<form action="main/do_upload.php" method="post" enctype="multipart/form-data">

					<input type="file" multiple name="userfile[]" size="20" />
					<input type="hidden" name="paciente" value = <?php //echo $paciente ?> />
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