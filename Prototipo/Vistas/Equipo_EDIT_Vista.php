<?php
class EquipoEDIT{

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
			echo "<form class=\"form-horizontal\" name=\"formulario\" id=\"formulario\" method=\"post\" action=\"..\Controlador\Equipo_Controller.php?ModificarEquipo\">";
			echo "<fieldset><legend>".$idiom['Equipos']."</legend>";

			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"nombre\"> ".$idiom['Nombre'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" required value=\"".$name[0]."\" name=\"Nombre\" readonly>";
			echo "</div></div>";

      echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"capital\"> ".$idiom['Capital'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" required value=\"".$name[1]."\" name=\"Capital\" readonly>";
			echo "</div></div>";

      echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"login\"> ".$idiom['Login'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" required value=\"".$name[2]."\" name=\"Login\" readonly>";
			echo "</div></div>";

      if ( $name[4] == '1'){
        echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"tipo\"> ".$idiom['Tipo'].":</label>";
  			echo "<div class=\"input-group col-sm-3\">";
  			echo "<"."input"." "."class=\"form-control\""."type=\"text\" required value=\"Administrador\" name=\"Tipo\" readonly>";
  			echo "</div></div>";
      }else{
        echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"tipo\"> ".$idiom['Tipo'].":</label>";
  			echo "<div class=\"input-group col-sm-3\">";
  			echo "<"."input"." "."class=\"form-control\""."type=\"text\" required value=\"Usuario\" name=\"Tipo\" readonly>";
  			echo "</div></div>";
      }

      echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"pwd\">".$idiom['Pwd']."</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" name=\"pwd\">";
			echo "</div></div>";


			echo "<a href=\"Equipo_Controller.php?ModificarEquipo\"><input type=\"image\" onClick=\"return confirm('".$idiom['confirmeEditName'].":".$name[0]."?')\" src=\"..\Archivos\\lapiz.png\" width=\"20\" height=\"20\"></a>";
			echo "</fieldset>";
			echo "</form>";



?>

<?php
	include '../plantilla/pie.php';
	}}


?>
