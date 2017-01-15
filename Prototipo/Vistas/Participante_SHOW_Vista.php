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
	
	if(count($form)!=0)
			{
				for ($numar =0;$numar<count($form);$numar=$numar+6){

					echo "<div class=\"container well\">";
					echo "<div class=\"row\">";
					echo "<div class=\"col-xs-12\">"; ?>

					<b><?php echo $idiom['Dni']; ?></b><?php echo ": ".$form[$numar];
					echo "<br>"; ?>
					<b><?php echo $idiom['Nombre'];?></b><?php echo ": ".$form[$numar+1];
					echo "<br>"; ?>
					<b><?php echo $idiom['Apellidos'];?></b><?php echo ": ".$form[$numar+2];
					echo "<br>"; ?>
					<b><?php echo $idiom['Email'];?></b><?php echo ": ".$form[$numar+3];
					echo "<br>"; ?>
					<b><?php echo $idiom['Telefono'];?></b><?php echo ": ".$form[$numar+4];
					echo "<br>"; ?>
					<b><?php echo $idiom['Nombre Equipo'];?></b><?php echo ": ".$form[$numar+5];
					echo "<br>";
										
      echo "<a href=\"../Controlador/Participante_Controller.php?Modificar=".$form[$numar]."\""."><input type=\"image\" src=\"..\Archivos\\lapiz.png\" width=\"20\" height=\"20\"></a>";
			echo "<a href=\"Participante_Controller.php?Baja=".$form[$numar]."\""."><input type=\"image\" src=\"..\Archivos\\eliminar.png\" width=\"20\" height=\"20\"></a>";
    	echo "<a href=\"Participante_Controller.php?BajaParticipanteEquipo=".$form[$numar]."\""."><input type=\"image\" src=\"..\Archivos\\eliminar.png\" width=\"20\" height=\"20\"></a>";
					echo"</fieldset>";
					echo"</form>";
					echo "</div>";
					echo "</div>";
					echo "</div>";


				}
			}
?>

<?php
include '../plantilla/pie.php';
}
}
?>
