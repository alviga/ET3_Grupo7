<?php
	class Participante_SHOW{

		function crear($form,$idioma){

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

			<fieldset>
			<input type="text" aling="right" placeholder=<?php echo $idiom['Nombre'] ?> name="buscar" ><input  type="submit" name="buscador" value="Buscar">
			</fieldset>
			</form>

<?php

    echo "<legend>".$idiom['Participante']."</legend>";
    echo "<br>";

    if(count($form)==0){
      echo "No hay participantes";
      echo "<br>";
    }else{

		for ($numar = 0;$numar<count($form);$numar=$numar+6){

			echo "<div class=\"container well\">";
 			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-12\">";

			echo $idiom['Dni'].": ".$form[$numar];
			echo "<br>";
      echo $idiom['Nombre'].": ".$form[$numar+1];
			echo "<br>";
      echo $idiom['Apellidos'].": ".$form[$numar+2];
			echo "<br>";
      echo $idiom['Email'].": ".$form[$numar+3];
			echo "<br>";
      echo $idiom['Telefono'].": ".$form[$numar+4];
			echo "<br>";
      echo $idiom['Nombre Equipo'].": ".$form[$numar+5];
			echo "<br>";

      echo "<a href=\"../Controlador/Participante_Controller.php?Modificar=".$form[$numar]."\""."><input type=\"image\" src=\"..\Archivos\\lapiz.png\" width=\"20\" height=\"20\"></a>";
			echo "<a href=\"Participante_Controller.php?Baja=".$form[$numar]."\""."><input type=\"image\" src=\"..\Archivos\\lapiz.png\" width=\"20\" height=\"20\"></a>";
    	echo "<a href=\"Participante_Controller.php?BajaParticipanteEquipo=".$form[$numar]."\""."><input type=\"image\" src=\"..\Archivos\\lapiz.png\" width=\"20\" height=\"20\"></a>";


		

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
