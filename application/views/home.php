<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Home</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
	<meta name="author" content="Macsee">
	<style type="text/css">


	.button_example:active {
		background-color: #dae3f0;
	}
	
	.button_example:hover {
		background-color: #dae3f0;
	}	
	
	.button_example:visited {color: none}
	
	.clase1{
			padding-left: 42px;
			padding-right: 42px;
			padding-top: 10px;
			padding-bottom: 10px;
	}
	
	.clase2{
			padding-left: 31px;
			padding-right: 31px;
			padding-top: 10px;
			padding-bottom: 10px;
	}
	.clase3{
			padding-left: 25px;
			padding-right: 25px;
			padding-top: 10px;
			padding-bottom: 10px;
	}
	.clase4{
			padding-left: 35px;
			padding-right: 35px;
			padding-top: 10px;
			padding-bottom: 10px;
	}
	.clase5{
			padding-left: 28px;
			padding-right: 28px;
			padding-top: 10px;
			padding-bottom: 10px;
	}
	.boton_home{
			//float: left;
			margin: 10px;
			display: inline-block;
	}
	
	#portada_inf{
		float: left;
		//position: absolute;
		//left: 50%;
		//margin-left: -390px;
		//margin-top: 545px;
		//margin-left: 50%;
		width: 100%;
		margin-top: 20px;
		//display: inline-block;
		text-align: center;
	}

	#portada_sup{
		float: left;
		height: 500px;
		border-bottom: 2px solid #EEE;
		margin-bottom: 20px;
		width: 100%
	}

	#logo 	{	
				left: 50%;
				position: absolute;
				margin-left: -481px;
			}

	#login_info {
		float:right;
		font-family: Oswald;
		font-size: 20px;
	}		

	#login_info a {
		font-size: 18px;
		font-weight: bold;
		letter-spacing: -1px;
	}
	</style>
	</head>	
<body>
	<div id = "home">
	<div id = "portada_sup">
		<div id = "login_info">
			<div style="float:left;margin-right:3px">
				<?php echo "Hola ";?>
			</div>
			<div style="float:left;margin-right:3px;color:#97BFD9;">
				<?php echo $this->session->userdata('nombre').".";?>
			</div>
			<div style="float:left">
				<?php echo anchor("login/desconectar","Desconectar");?>
			</div>
		</div>	
		<div id = "logo">
			<img src="<?php echo base_url('css/images/logo.png')?>" alt="logo">
		</div>
	</div>	
	<div id = "portada_inf">

<?php 	
		$grupo = $this->session->userdata('grupo');

		echo '<div class = "boton_home">';
			echo '<a class = "button_example clase1" href="'.base_url('index.php/main/cambiar_dia/'.date("Y-m-d")).'">Turnos</a>';
		echo '</div>';
		echo '<div class = "boton_home">';
			echo '<a class = "button_example clase2" href="'.base_url('index.php/main/pacientes/').'">Pacientes</a>';
		echo '</div>';
		//if (strpos($this->session->userdata('grupo'),"Secretaria") === false)
		if ($grupo == "Medico" || $grupo == "Tecnico") {
			echo '<div class = "boton_home">';
				echo '<a class = "button_example clase3" href="'.base_url('index.php/main/pacientes_admitidos/'.date("Y-m-d")).'">Pacientes Admitidos</a>';
			echo '</div>';
		}

		if ($grupo == "Secretaria_1") {
			echo '<div class = "boton_home">';
				echo '<a class = "button_example clase3" href="'.base_url('index.php/main/facturacion/').'">Facturación</a>';
			echo '</div>';
			echo '<div class = "boton_home">';
				echo '<a class = "button_example clase5" href="'.base_url('index.php/main/agenda_cirugias/').'">Cirugías</a>';
			echo '</div>';
		}	
		/*
		echo '<div class = "boton_home">';
			echo '<a class = "button_example clase4" href="'.base_url('index.php/main/agendas/').'">Agendas</a>';
		echo '</div>';
		*/

?>		
	</div>
	</div>
</body>
</html>
