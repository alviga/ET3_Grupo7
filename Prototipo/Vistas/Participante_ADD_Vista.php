<?php

class ParticipanteAlta{

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
			echo "<form class=\"form-horizontal\" id=formulario method=\"post\" action=\"..\Controlador\Participante_Controller.php?AltaParticipante\">";//QUE PONGO AQUI

			echo "<fieldset><legend>".$idiom['AltaParticipante']."</legend>";
			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"dni\"> ".$idiom['Dni'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" required  name=\"dni\">";
			echo "</div></div>";

			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"nombre\"> ".$idiom['Nombre'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" required  name=\"nombre\">";
			echo "</div></div>";

			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"apellidos\"> ".$idiom['Apellidos'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type=\"text\" required  name=\"apellidos\">";
			echo "</div></div>";

			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"email\"id =\"email\">".$idiom['Email'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='email' required id='email' name='email'>";
			echo "</div></div>";

			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"telefono\"id =\"telefono\">".$idiom['Telefono'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='text' required id='telefono' name='telefono'>";
			echo "</div></div>";

			/*echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"asignacion\"id =\"asignacion\">".$idiom['Asignacion'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='text' required id='asignacion' name='asignacion'>";
			echo "</div></div>";*/

			/*echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"tipo\"id =\"tipo\">".$idiom['Tipo'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='text' required id='tipo' name='tipo'>";
			echo "</div></div>";*/

			?>

			<br>
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

			echo "<a href=\"Participante_Controller.php?AltaParticipante\"><input type=\"image\" src=\"..\Archivos\anadir.png\" width=\"20\" height=\"20\"></a>";
			echo "</fieldset>";
			echo "</form>";
			


?>

<?php
	include '../plantilla/pie.php';
	}}


?>
