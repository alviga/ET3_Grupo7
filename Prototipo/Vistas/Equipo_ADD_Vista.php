<?php

class EquipoAlta{

	function crear($idioma,$resultado,$mensaje){

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
 			if ($resultado==FALSE){
 				echo "<script>alert(\"".$idiom["IntroduccionErronea"]."\")</script>";
 			}

			echo "<div class=\"container well\">";
 			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-12\">";
			echo "<form class=\"form-horizontal\" id=formulario method=\"post\" action=\"..\Controlador\Equipo_Controller.php?AltaEquipo\">";//QUE PONGO AQUI

			echo "<fieldset><legend>".$idiom['AltaEquipo']."</legend>";
			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"nombre\"> ".$idiom['Nombre'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" required  name=\"nombre\">";
			echo "</div></div>";

			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"login\"id =\"login\">".$idiom['Login'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='text' required id='login' name='login'>";
			echo "</div></div>";

			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"passwd\"id =\"passwd\">".$idiom['Pwd'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='text' required id='passwd' name='passwd'>";
			echo "</div></div>";

			?>

			<div class=form-group><label class="col-sm-2 control-label" for="tipo"><?=$idiom['Tipo']?></label>
			<div class="input-group col-sm-3">
				<select id="tipo" name="tipo" class="form-control" required="">
											<?php

													echo "<option value='admin'>admin</option>";
													echo "<option value='user'>user</option>";

											?>
																</select>
			</div>

<?php

			echo "<a href=\"Equipo_Controller.php?AltaEquipo\"><input type=\"image\" src=\"..\Archivos\anadir.png\" width=\"20\" height=\"20\"></a>";
			echo "</fieldset>";
			echo "</form>";



?>

<?php
	include '../plantilla/pie.php';
	}}


?>
