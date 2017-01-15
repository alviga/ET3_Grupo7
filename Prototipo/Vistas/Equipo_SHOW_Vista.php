<?php
	class Equipo_SHOW{

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
			echo "<form action=\"Equipo_Controller.php\" method=\"post\">";
?>

			<fieldset>
			<input type="text" aling="right" placeholder=<?php echo $idiom['Nombre'] ?> name="buscar" ><input  type="submit" name="buscador" value="Buscar">
			</fieldset>
			</form>

<?php

    echo "<legend>".$idiom['Equipos']."</legend>";
    echo "<br>";

		for ($numar =0;$numar<count($form);$numar++){

			echo "<div class=\"container well\">";
 			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-12\">";

			echo "<form class=\"form-horizontal\" method=\"post\" action=\"..\Controlador\Equipo_Controller.php?View=".$form[$numar]."\">";

			echo $idiom['Nombre'].": ".$form[$numar];
			echo "<br>";

			echo "<a href=\"Equipo_Controller.php?View=".$form[$numar]."\""."><input type=\"image\" src=\"..\Archivos\\lupa.jpg\" width=\"20\" height=\"20\"></a>";

			echo"</fieldset>";
			echo"</form>";
 			echo "</div>";
			echo "</div>";
			echo "</div>";

		 	}



?>
	</div></div></div>

	</div>
<?php
include '../plantilla/pie.php';
}
}
?>
