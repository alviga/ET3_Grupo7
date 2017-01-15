<?php
	class Inventario_SHOW{

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

    echo "<legend>".$idiom['Inventario']."</legend>";
    echo "<br>";

    if(count($form)==0){
      echo "No tienes valores en propiedad";
      echo "<br>";
    }else{

		for ($numar = 0;$numar<count($form);$numar=$numar+2){

			echo "<div class=\"container well\">";
 			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-12\">";

			echo $idiom['NombreValor'].": ".$form[$numar];
			echo "<br>";
      echo $idiom['Cantidad'].": ".$form[$numar+1];
			echo "<br>";

			echo"</fieldset>";
			echo"</form>";
 			echo "</div>";
			echo "</div>";
			echo "</div>";

		 	}
    }
		 	echo "<a href=\"Inventario_Controller.php?Volver\"><input type=\"image\" src=\"..\Archivos\\volver.png\" width=\"20\" height=\"20\"></a>";


?>
	</div></div></div>

	</div>
<?php
include '../plantilla/pie.php';
}
}
?>
