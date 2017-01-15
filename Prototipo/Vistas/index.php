<?php if(isset($_SESSION['usuario']))
{
	/*$idiom=new idiomas();
	$panelprincipal=new panel();
	$panelprincipal->constructor($idiom);*/
	header("location:Controlador/MenuPrincipal_Controller.php?acceso=acceso");

}else 
{ header("location:../index.php");
}
	?>
