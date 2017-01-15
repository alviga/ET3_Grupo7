<?php
	class Equipo_VIEW{

		function crear($form,$idioma,$origen){

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
			echo $idiom['Nombre'].": ".$form[0];
			echo "<br>";
			echo $idiom['Capital'].": ".$form[1];
			echo "<br>";
			echo $idiom['Login'].": ".$form[2];
			echo "<br>";
      echo $idiom['Pwd'].": ".$form[3];
			echo "<br>";
      if($form[4] == '1'){
        echo $idiom['Tipo'].": administrador";
  			echo "<br>";
      }else{
        echo $idiom['Tipo'].": usuario";
  			echo "<br>";
      }

			if($form[4] != '1'){
				echo "<a href=\"../Controlador/Equipo_Controller.php?Modificar=".$form[0]."\""."><input type=\"image\" src=\"..\Archivos\\lapiz.png\" width=\"20\" height=\"20\"></a>";
				echo "<a href=\"Equipo_Controller.php?Baja=".$form[0]."\""."><input type=\"image\" src=\"..\Archivos\\eliminar.png\" width=\"20\" height=\"20\"></a>";
			}else{
								echo "<a href=\"../Controlador/Equipo_Controller.php?Modificar=".$form[0]."\""."><input type=\"image\" src=\"..\Archivos\\lapiz.png\" width=\"20\" height=\"20\"></a>";
			}



			echo"</fieldset>";
			echo"</form>";
 			echo "</div>";
			echo "</div>";
			echo "</div>";




?>
	</div></div></div>

	</div>
<?php
include '../plantilla/pie.php';
}
}
?>
