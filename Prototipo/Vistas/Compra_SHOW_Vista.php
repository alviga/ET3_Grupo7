<?php
	class Compra_SHOW{

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
			echo "<form action=\"Compra_Controller.php\" method=\"post\">";
?>

			<fieldset>
			<input type="date" aling="right" placeholder=<?php echo $idiom['Dia'] ?> name="buscar" ><input  type="submit" name="buscador" value="Buscar">
			</fieldset>
			</form>

<?php

    echo "<legend>".$idiom['Compras']."</legend>";
    echo "<br>";

    if(count($form)==0){
      echo "No has relizado compras";
      echo "<br>";
    }else{

		for ($numar = 0;$numar<count($form);$numar=$numar+5){

			echo "<div class=\"container well\">";
 			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-12\">";

			echo $idiom['NombreValor'].": ".$form[$numar];
			echo "<br>";
      echo $idiom['Dia'].": ".$form[$numar+1];
			echo "<br>";
      echo $idiom['Hora'].": ".$form[$numar+2];
			echo "<br>";
      echo $idiom['Cantidad'].": ".$form[$numar+3];
			echo "<br>";
      echo $idiom['Precio'].": ".$form[$numar+4];
			echo "<br>";

			echo"</fieldset>";
			echo"</form>";
 			echo "</div>";
			echo "</div>";
			echo "</div>";

		 	}
    }



?>
	</div></div></div>

	</div>
<?php
include '../plantilla/pie.php';
}
}
?>
