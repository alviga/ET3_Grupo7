<?php
class ParticipanteBajaEquipo{

	function crear($idioma,$resultado,$form,$equipo){

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
			echo "<fieldset><legend>".$idiom['Participante']."</legend>";
			echo "<br>";
			echo $idiom['Dni'].": ".$form;
			echo "<br>";
			echo $idiom['Equipo'].": ".$equipo;
			echo "<br>";
			echo "<a href=\"../Controlador/Participante_Controller.php?BajaParticipanteEquipo2=".$form."\""."><input type=\"image\"  src=\"..\Archivos\\eliminar.png\" width=\"20\" height=\"20\"></a>";
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
