<?php

class CompraAlta{

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
				//Cogemos todos los valores que hay e la bd
        $valor=new Compra();
        $valores = $valor->comprobarValores();

?>

 <?php
 			if ($resultado==FALSE){
 				echo "<script>alert(\"".$idiom["IntroduccionErronea"]."\")</script>";
 			}

			echo "<div class=\"container well\">";
 			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-12\">";
			echo "<form class=\"form-horizontal\" id=formulario method=\"post\" action=\"..\Controlador\Compra_Controller.php?AltaCompra\">";

			echo "<fieldset><legend>".$idiom['AltaCompra']."</legend>";
      ?>

      <div class=form-group><label class="col-sm-2 control-label" for="nombre"><?=$idiom['NombreValor']?></label>
			<div class="input-group col-sm-3">
				<select id="nombre" name="nombre" class="form-control" required="">
											<?php
                          for ($numar=0;$numar<count($valores);$numar++){
                            echo "<option value=".$valores[$numar].">$valores[$numar]</option>";
                          }

											?>
																</select>
			</div>

      <?php
      echo "</div></div>";

			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"cantidad\"id =\"cantidad\">".$idiom['Cantidad'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='number' required id='cantidad' name='cantidad' min='1'>";
			echo "</div></div>";

			echo "<div class=\"form-group\"><label class=\"col-sm-2 control-label\" for=\"maximo\"id =\"maximo\">".$idiom['Maximo'].":</label>";
			echo "<div class=\"input-group col-sm-3\">";
			echo "<"."input"." "."class=\"form-control\""."type='number' required id='maximo' name='maximo' min='1'>";
			echo "</div></div>";

			?>


<?php

			echo "<a href=\"Compra_Controller.php?AltaCompra\"><input type=\"image\" src=\"..\Archivos\anadir.png\" width=\"20\" height=\"20\"></a>";
			echo "</fieldset>";
			echo "</form>";



?>

<?php
	include '../plantilla/pie.php';
	}}


?>
