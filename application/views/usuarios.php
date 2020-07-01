<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Administración de Usuarios</title>
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<style type="text/css">

		table {
			font-size: 15px;
		}

		table td {
			width: 0px;
		}

		.usuarios {
			//border: 1px solid;
			//width:1000px;
		}

		.usuarios_th {
			border: 1px solid;
			float: left;
			margin-bottom: 2px;
			//font-weight: bold;
			background-color: #454545;
			color: white;
		}

		.usuarios_tr {
			//border: 1px solid;
			float: left;
			width: 100%;
			margin-bottom:2px;
			cursor:pointer;
		}

		.usuarios_td {
			border: 1px solid;
			float: left;
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

	</style>
	<script type="text/javascript">
	$(document).ready(function() {	

		$(".usuarios_tr").click(function()
		{ 
				$("#chk_med").prop('checked',false);
				$("#chk_pac").prop('checked',false);
				$("#chk_est").prop('checked',false);
				$("#chk_fact").prop('checked',false);
				$("#chk_tur").prop('checked',false);
				$("#chk_cir").prop('checked',false);
				$("#chk_admin").prop('checked',false);

			var id = $(this).attr("id");

			$("#nombre").val($("#"+id+"_nombre").html());
			$("#apellido").val($("#"+id+"_apellido").html());
			$("#user").val($("#"+id+"_usuario").html());
			$("#iduser").val($("#"+id+"_id").html());


			if ($("#"+id+"_funciones").html().indexOf("Medico") >= 0)
				$("#chk_med").prop('checked',true);

			if ($("#"+id+"_funciones").html().indexOf("Pacientes") >= 0)
				$("#chk_pac").prop('checked',true);

			if ($("#"+id+"_funciones").html().indexOf("Estudios") >= 0)
				$("#chk_est").prop('checked',true);

			if ($("#"+id+"_funciones").html().indexOf("Facturacion") >= 0)
				$("#chk_fact").prop('checked',true);

			if ($("#"+id+"_funciones").html().indexOf("Turnos") >= 0)
				$("#chk_tur").prop('checked',true);

			if ($("#"+id+"_funciones").html().indexOf("Cirugias") >= 0)
				$("#chk_cir").prop('checked',true);

			if ($("#"+id+"_funciones").html().indexOf("Admin") >= 0)
				$("#chk_admin").prop('checked',true);

		});
	});
		
	</script>
</head>
<body>
	<div class = "titulo">
		<?php
			echo '<a href = "'.base_url('index.php').'">';
				echo '<img src = "'.base_url('css/images/arrow_left_24x24.png').'" style = "margin-right:10px;margin-top:5px"/>';
				echo "Volver";
			echo '</a>';	
		?>	
	</div>
	<div style = "float:left;width:24%">
		<form method = "post">
			<table>
				<tr>
					<td>Nombre:</td> 
					<td><input type = "text" name = "nombre" id = "nombre" required/></td>
				</tr>		
				<tr>
					<td>Apellido:</td>
					<td><input type = "text" name = "apellido" id = "apellido" required/></td>
				</tr>
				<tr>	
					<td>User:</td>
					<td><input type = "text" name = "user" id = "user" required/></td>
				</tr>
				<tr>	
					<td>ID User:</td>
					<td><input type = "text" name = "iduser" id = "iduser" required/></td>
				</tr>
			</table>
			<div style = "float:left">
				Grupo:
			</div>
			<div style = "float:left;margin-left:10px">
				<table>
					<tr>
						<td>
							<input id = "chk_med" type = "checkbox" name = "funciones[]" value = "Medico" /> Medico 
						</td>
						<td>
							<input id = "chk_pac" type = "checkbox" name = "funciones[]" value = "Pacientes" /> Pacientes 
						</td>
					</tr>
					<tr>	
						<td>
							<input id = "chk_fact" type = "checkbox" name = "funciones[]" value = "Facturacion" /> Facturacion 
						</td>
						<td>
							<input id = "chk_tur" type = "checkbox" name = "funciones[]" value = "Turnos" /> Turnos 
						</td>
					</tr>
					<tr>	
						<td>
							<input id = "chk_cir" type = "checkbox" name = "funciones[]" value = "Cirugias" /> Cirugias 
						</td>
						<td>
							<input id = "chk_admin" type = "checkbox" name = "funciones[]" value = "Admin" /> Admin
						</td>
					</tr>
					<tr>	
						<td>
							<input id = "chk_est" type = "checkbox" name = "funciones[]" value = "Estudios" /> Estudios 
						</td>
					</tr>
				</table>
			</div>
			<div style = "width:100%;float:left;margin-top:10px">
				<div style = "float:left">
					<button type = "submit" formaction = "<?php echo base_url('index.php/main/ingresar_usuario')?>"> Guardar </button>
				</div>
				<div style = "float:left;margin-left:20px">
					<button type = "submit" formaction = "<?php echo base_url('index.php/main/resetear_usuario')?>"> Resetear </button>
				</div>	
			</div>
		</form>
	</div>	
	<div style = "float:left;width:76%">
		<?php
			if(isset($resultado)){
				
				//echo '<div class = "usuarios">';
					echo '<div class = "usuarios_th" style = "width:100px">User</div>';
					echo '<div class = "usuarios_th" style = "width:180px">Nombre</div>';
					echo '<div class = "usuarios_th" style = "width:180px">Apellido</div>';
					echo '<div class = "usuarios_th" style = "width:380px">Funciones</div>';
					echo '<div class = "usuarios_th" style = "width:100px">ID User</div>';
					echo '<div class = "usuarios_th" style = "width:180px">Ultimo Ingreso</div>';
				foreach ($resultado as $res) {
					
					if ($res->last_login) {
						$login = $res->last_login;
					}
					else {
						$login = "Sin Datos";
					}

					echo '<div class = "usuarios_tr" id = "'.$res->id_user.'" >';
						echo '<div id = "'.$res->id_user.'_usuario" class = "usuarios_td" style = "width:100px">'.$res->user.'</div>';
						echo '<div id = "'.$res->id_user.'_nombre" class = "usuarios_td" style = "width:180px">'.$res->nombre.'</div>';
						echo '<div id = "'.$res->id_user.'_apellido" class = "usuarios_td" style = "width:180px">'.$res->apellido.'</div>';
						echo '<div id = "'.$res->id_user.'_funciones" class = "usuarios_td" style = "width:380px">'.$res->funciones.'</div>';
						echo '<div id = "'.$res->id_user.'_id" class = "usuarios_td" style = "width:100px">'.$res->id_user.'</div>';
						echo '<div id = "'.$res->id_user.'_id" class = "usuarios_td" style = "width:180px">'.$login.'</div>';
					echo '</div>';
				}
				//echo '</table>';
			}
		?>
	</div>	

</body>
</html>