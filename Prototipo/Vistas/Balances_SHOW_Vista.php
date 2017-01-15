<?php
	class Balances_SHOW{

		function crear($idioma,$listaequipos,$listabalances){

			include('../plantilla/cabecera.php');
        include("../Funciones/comprobaridioma.php");
		include('../Modelos/Cuenta_Model.php');
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
			echo "<form class=\"form-horizontal\" id=formulario method=\"post\" action=\"..\Controlador\Balances_Controller.php?View\">";
			echo "<fieldset><legend>".$idiom['Consultar balance']."</legend>"; ?>

			<?php //Muestra el formulario a rellenar para buscar los balances deseados ?>

			<div class=form-group><label class="col-sm-2 control-label" for="dni"><?=$idiom['Equipos']?></label>
			<div class="input-group col-sm-3">
				<select id="equipos" name="equipos" class="form-control" required="">
					<?php
						for($i=0;$i<count($listaequipos);$i=$i+1){
							echo "<option value='".$listaequipos[$i][0]."'>".$listaequipos[$i][0]."</option>";
						}
					?>
				</select>
			</div>

			<div class=form-group><label class="col-sm-2 control-label" for="dni"><?=$idiom['Tipo']?></label>
			<div class="input-group col-sm-3">
				<select id="tipo" name="tipo" class="form-control" required="">
					<option value='diaria'>Diaria</option>
					<option value='mensual'>Mensual</option>
					<option value='anual'>Anual</option>
				</select>
			</div>

			</br>

<?php
			echo "<a href=\"Balances_Controller.php?View\"><input type=\"image\" src=\"..\Archivos\lupa.jpg\" width=\"20\" height=\"20\"></a>";
			echo "</fieldset>";
			echo "</form>";

				//Muestra los balances que coinciden con la descripción del formulario

			if(count($listabalances)!=0)
			{
				for ($numar =0;$numar<count($listabalances);$numar++){

					echo "<div class=\"container well\">";
					echo "<div class=\"row\">";
					echo "<div class=\"col-xs-12\">"; ?>

					<b><?php echo $idiom['Fecha'];?></b><?php echo ": ".$listabalances[$numar][1];
					echo "<br>"; ?>
					<b><?php echo $idiom['CuentaPG'];?></b><?php echo ": ".$listabalances[$numar][3];
					echo "<br>"; ?>
					<b><?php echo $idiom['Capital'];?></b><?php echo ": ".$listabalances[$numar][4];
					echo "<br>";
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
