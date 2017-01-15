<?php
class EquipoDelete{

	function crear($idioma,$resultado,$form){

       	include('../plantilla/cabecera.php');
        include("../Funciones/comprobaridioma.php");
        include ('../Modelos/Cuenta_Model.php');
        $clase=new cabecera();
        $clases=new comprobacion();
        $idiom=$clases->comprobaridioma($idioma);
        $clase->crear($idiom);
        include('../plantilla/menulateral.php');
        $menus=new menulateral();
        $menus->crear($idiom);

?>

<?php

			echo "<div class=\"container well\">";
 			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-12\">";
			echo "<fieldset><legend>".$idiom['Equipos']."</legend>";
			echo "<br>";
			echo $idiom['Nombre'].": ".$form;
			echo "<br>";
			echo "<a href=\"../Controlador/Equipo_Controller.php?BajaEquipo=".$form."\""."><input type=\"image\"  src=\"..\Archivos\\eliminar.png\" width=\"20\" height=\"20\"></a>";
			echo"</fieldset>";
			echo"</form>";
 			echo "</div>";
			echo "</div>";
			echo "</div>";



?>



<?php
	include '../plantilla/pie.php';
	}}


?>
