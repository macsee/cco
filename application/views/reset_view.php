<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Resetear Contraseña</title>
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
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
			float: left;
			margin-left: 20px;
	}
	
	#portada_inf{
			float: left;
			position: absolute;
			left: 50%;
			margin-left: -390px;
			margin-top: 545px
	}

	#box{
			height: 400px;
			width: 400px;
			border: 2px solid #EEE;
			margin: auto;
			margin-top: 100px;
			background-color: #F7F7F7;
			font-family: Oswald;
			font-size: 18px;
			
	}

	#box input {
		height: 30px;
		width: 200px;
		font-size: 20px;
	}

	#logo {
			width:100%;
			height: 200px;
		}

	.boton_login {
			font-family: Oswald; 
			background-color: #97BFD9;
			text-decoration: none;
			border-radius: 4px;
			font-size: 20px;
			color: white;
			text-shadow: 0 2px 0 #b3b3b3;
			width: 293px;
			height: 40px;
			margin-left: 50px;
			border:none;
	}		

	</style>
	</head>	
<body>
	<div id = "home">
		<div id = "box">
			<div id = "logo">
				<img style="max-width:100%;" src="<?php echo base_url('css/images/logo.png')?>" alt="logo">
			</div>

			<form class="contact_form" action="<?php echo base_url('index.php/login/reset_password')?>" method="post" name="reset_form" id="reset_form">

				<div style="float:left;margin-bottom:30px;margin-left:30px">
					<label for="usuario">Nueva Contraseña:</label>
				    	<input style="margin-left:16px" type="password" size = "20" id = "pass" name="pass" autocomplete="off" value = "" required/>
			    </div>
			    <div style="float:left;margin-bottom:30px;margin-left:30px">
				    <label for="password">Repetir Contraseña:</label>
				    	<input style="margin-left:9px" type="password" size = "20" id = "confirmar_pass" name="repetir_pass" autocomplete="off" value = "" required/>
				    	<input style="margin-left:9px" type="hidden" size = "20" id = "user" name="user" value = "<?php echo $user?>"/>
			    </div>

			    <button style="float:left" class="boton_login" id = "boton_cambiar" onclick = "return validar();">Cambiar</button>
			    <!--<a href= "#" style="float:left" class="boton_login" id = "boton_cambiar" onclick = "return validar();">Cambiar</a>-->

			    <!--<div class = "boton_login"><a class = "button_example clase1" href="http://consultoriocco.dyndns.org/cco/index.php/main/cambiar_dia/2015-01-09">Turnos</a>-->
		    </form>
		</div>	
	</div>
	<script>
	$("#confirmar_pass").keyup(function( event ) {
		$("#confirmar_pass").get(0).setCustomValidity("");
	});

	function validar() {

		if ($("#pass").val() != $("#confirmar_pass").val())
			$("#confirmar_pass").get(0).setCustomValidity("Las contraseñas no coinciden");
		else {
			$("#confirmar_pass").get(0).setCustomValidity("");
			$("#reset_form").submit();
		}		
	}	

	</script>
</body>
</html>
