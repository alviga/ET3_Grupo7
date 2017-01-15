<?php
class ParticipanteEDIT{

	function crear($idioma,$name,$mensaje){

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
			echo "<form class=\"form-horizontal\" name=\"formulario\" id=\"formulario\" method=\"post\" action=\"..\Controlador\Participante_Controller.php?ModificarParticipante\">";
			echo "<fieldset><legend>".$idiom['Participante']."</legend>";

			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"dni\"> ".$idiom['Dni'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" required value=\"".$name."\" name=\"dni\" readonly>";
			echo "</div></div>";


      echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"nombre\">".$idiom['Nombre']."</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" name=\"nombre\">";
			echo "</div></div>";

      echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"apellidos\">".$idiom['Apellidos']."</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" name=\"apellidos\">";
			echo "</div></div>";

      echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"email\">".$idiom['Email']."</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"email\" name=\"email\">";
			echo "</div></div>";

      echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"telefono\">".$idiom['Telefono']."</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" name=\"telefono\">";
			echo "</div></div>";


			echo "<a href=\"Participante_Controller.php?ModificarParticipante\"><input type=\"image\" onClick=\"return confirm('".$idiom['confirmeEditName'].":".$name."?')\" src=\"..\Archivos\\lapiz.png\" width=\"20\" height=\"20\"></a>";
			echo "</fieldset>";
			echo "</form>";


			

?>

<?php
	include '../plantilla/pie.php';
	}}


?>
