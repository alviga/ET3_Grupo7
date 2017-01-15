<?php
class ParticipanteAltaEquipo{

	function crear($idioma,$listaequipo,$form){

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
			echo "<fieldset><legend>".$idiom['Participante']."</legend>";
			echo "<br>";
			echo $idiom['Dni'].": ".$form;
			echo "<br>";
			?>
			
			<div class=form-group><label class="col-sm-2 control-label" for="dni"><?=$idiom['Equipos']?></label>
			<div class="input-group col-sm-3">
				<select id="equipo" name="equipo" class="form-control" required="">
											<?php
						for($i=0;$i<count($listaequipo);$i=$i+1){
							echo "<option value='".$listaequipo[$i][0]."'>".$listaequipo[$i][0]."</option>";
						}
						
					?>
																</select>
			</div>
			<?php
			echo "<a href=\"../Controlador/Participante_Controller.php?AltaParticipanteEquipo2=".$form."\""."><input type=\"image\"  src=\"..\Archivos\\eliminar.png\" width=\"20\" height=\"20\"></a>";
			echo"</fieldset>";
			echo"</form>";
 			echo "</div>";
			echo "</div>";
			echo "</div>";
			
			

?>

<?php
	include '../plantilla/pie.php';
	}}


?>
