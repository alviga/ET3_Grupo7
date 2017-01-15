<?php

class VentaAlta{

	function crear($idioma,$resultado,$valores){

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
 			/*if ($resultado==FALSE){
 				echo "<script>alert(\"".$idiom["IntroduccionErronea"]."\")</script>";
 			}*/

			echo "<div class=\"container well\">";
 			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-12\">";
			echo "<form class=\"form-horizontal\" id=formulario method=\"post\" action=\"..\Controlador\Venta_Controller.php?AltaVenta\">";//QUE PONGO AQUI

			echo "<fieldset><legend>".$idiom['AltaVenta']."</legend>";
      ?>

      <div class=form-group><label class="col-sm-2 control-label" for="nombre"><?=$idiom['NombreValor']?></label>
			<div class="input-group col-sm-3">
				<select id="nombre" name="nombre" class="form-control" required="">
											<?php
                          for ($i=0;$i<count($valores);$i++){
                            echo "<option value=".$valores[$i].">$valores[$i]</option>";
                          }

											?>
																</select>
			</div>

      <?php
      echo "</div></div>";
      
			/*echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"cantidad\"id =\"cantidad\">".$idiom['Cantidad'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='number' required id='cantidad' name='cantidad' min='1'>";
			echo "</div></div>";
*/
			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"minimo\"id =\"minimo\">".$idiom['minimo'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='number' required id='minimo' name='minimo' min='1'>";
			echo "</div></div>";

			?>


<?php
/*
			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"tipo\"id =\"tipo\">".$idiom['Tipo'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='text' required id='tipo' name='tipo'>";
			echo "</div></div>";
*/
			//echo "<a href=\"..\Controlador\MenuPrincipal_Controller.php?principal\"><input type=\"image\" src=\"..\Archivos\a�adir.png\" width=\"20\" height=\"20\"></a>";
			echo "<a href=\"Venta_Controller.php?AltaVenta\"><input type=\"image\" src=\"..\Archivos\a�adir.png\" width=\"20\" height=\"20\"></a>";
			echo "</fieldset>";
			echo "</form>";
			


?>

<?php
	include '../plantilla/pie.php';
	}}


?>
