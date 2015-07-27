<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div style = "float:left;width:100%">
		<form method = "post" action = "<?php echo base_url('index.php/main/ingresar_usuario')?>">
			<table>
				<tr>
					<td>Nombre:</td> 
					<td><input type = "text" name = "nombre" id = "nombre"/></td>
				</tr>		
				<tr>
					<td>Apellido:</td>
					<td><input type = "text" name = "apellido" id = "apellido"/></td>
				</tr>
				<tr>	
					<td>User:</td>
					<td><input type = "text" name = "user" id = "user"/></td>
				</tr>
				<tr>	
					<td>ID User:</td>
					<td><input type = "text" name = "iduser" id = "iduser"/></td>
				</tr>
				<tr>	
				<td>Grupo:</td> 
				<td><select name = "grupo" id = "grupo">
						<option>Medico</option>
						<option>Secretaria_1</option>
						<option>Secretaria_2</option>
						<option>Tecnico</option>
					</select></td>
				</tr>
				<tr>
					<td><button type = "submit"> Guardar </button></td>
				</tr>	
			</table>
		</form>
	</div>	
	<div style = "float:left;width:100%">
		<?php
			if(isset($resultado)){
				
				echo '<table>';
				foreach ($resultado as $res) {
					echo '<tr>';
						echo '<td>'.$res->user.'</td>';
						echo '<td>'.$res->nombre.'</td>';
						echo '<td>'.$res->apellido.'</td>';
						echo '<td>'.$res->grupo.'</td>';
						echo '<td>'.$res->id_user.'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
		?>
	</div>	

</body>
</html>