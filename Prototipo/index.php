
<?php

include ("Idiomas/idiomas.php");
include("Vistas/MenuPrincipal_SHOW_Vista.php");
session_start();

if(isset($_SESSION['equipo']))
{
	header("location:Controlador\MenuPrincipal_Controller.php?acceso=acceso");

}else
{


?>
<html>
<head>
	<style>

		body{

			padding-top:40px;
			padding.bottom: 40px;
		}
		.login{
			max-width: 330px;
			padding: 15px;
			margin:0 auto;
		}
		#caja{
			max-width: 500px;
			-webkit-box-shadow: 	0px 0px 18px 0px rgba(48,50,50,0.48);
			-moz-box-shadow: 	 	0px 0px 18px 0px rgba(48,50,50,0.48);
			box-shadow: 			0px 0px 18px 0px rgba(48,50,50,0.48);
			border-radius:50%;
		}


	</style>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body style="background-color: #white">>
				<center>
					<img src="Archivos\BAM.png" class="img-responsive" id="logo" WIDTH=400 HEIGHT=400>
					</br>	</br>	
				</center>

	<div class="container well" id="caja">
		</br>
		<form class="login" method="post" action="Controlador/MenuPrincipal_Controller.php">
			<div class="form-group">
				<label for="usuario">Equipo:</label>
				<input type="text" class="form-control" id="usuario"name="usuario" placeholder="Introduzca su Equipo" required autofocus>
			</div>

			<div class="form-group">
				<label for="password">Contraseña:</label>
				<input type="password" class="form-control" name="password" placeholder="Introduzca su Contraseña" id="password" required>
			</div>

			<div class="checkbox">
				<input type="submit" class="btn btn-primary" name="login"  value="Entrar"></input>
			</div>
		</form>

	</br>
	</div>
<?php
	/*</br></br>
	<center>
		<form class="login" method="post"  action="Controlador/MenuPrincipal_Controller.php?lanzar">
			<div id="checkbox">
				<input type="submit" class="btn btn-danger btn-lg" aling="right" name="lanzar" value="[CLICK AQUÍ] Activar Base de Datos">
			</div>
		</form>
	</center>*/ ?>

	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
</body>
<?php
}

?>
