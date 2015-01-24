<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Home</title>
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
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

			<form class="contact_form" action="<?php echo base_url('index.php/login/conectar')?>" method="post" name="contact_form" id="contact_form">

				<div style="float:left;margin-bottom:30px;margin-left:50px">
					<label for="usuario">Usuario:</label>
				    	<input style="margin-left:30px" type="text" size = "20" id = "user" name="user" autocomplete="on" value = "" required/>
			    </div>
			    <div style="float:left;margin-bottom:30px;margin-left:50px">
				    <label for="password">Contraseña:</label>
				    	<input style="margin-left:9px" type="password" size = "20" id = "password" name="password" autocomplete="off" value = "" required/>
			    </div>

			    <button style="float:left" class="boton_login" type="submit">Ingresar</button>

			    <!--<div class = "boton_login"><a class = "button_example clase1" href="http://consultoriocco.dyndns.org/cco/index.php/main/cambiar_dia/2015-01-09">Turnos</a>-->
		    </form>
		</div>
		<?php
			if (isset($login_incorrecto) && $login_incorrecto == true) {
				echo "<div style = 'text-align:center;margin-top:10px;color:#ef313b;font-family:Oswald;font-size:20px;'>";
				echo "Usuario y/o Contraseña Incorrectos. Intente Nuevamente.";
				echo "</div>";
			}	
		?>		
	</div>
</body>
</html>
