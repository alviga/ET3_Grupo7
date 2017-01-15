<?php

class BalancesAlta{

	function crear($idioma,$listaequipos){

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
			echo "<form class=\"form-horizontal\" id=formulario method=\"post\" action=\"..\Controlador\Balances_Controller.php?AltaBalances\">";
			echo "<fieldset><legend>Alta Balances</legend>"; ?>

			<?php //Muestra el formulario a rellenar para insertar el balance ?>

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

			<div class=form-group><label class="col-sm-2 control-label" for="dni"><?=$idiom['Dia']?></label>
			<div class="input-group col-sm-3">
				<select id="dia" name="dia" class="form-control" required="">
					<?php
						for($i=1;$i<32;$i=$i+1){
							echo "<option value='".$i."'>".$i."</option>";
						}
					?>
				</select>
			</div>
			<div class=form-group><label class="col-sm-2 control-label" for="dni"><?=$idiom['Mes']?></label>
			<div class="input-group col-sm-3">
				<select id="mes" name="mes" class="form-control" required="">
					<?php
						for($i=1;$i<13;$i=$i+1){
							echo "<option value='".$i."'>".$i."</option>";
						}
					?>
				</select>
			</div>
			<div class=form-group><label class="col-sm-2 control-label" for="dni"><?=$idiom['Ano']?></label>
			<div class="input-group col-sm-3">
				<select id="ano" name="ano" class="form-control" required="">
					<?php
						for($i=2017;$i<2066;$i=$i+1){
							echo "<option value='".$i."'>".$i."</option>";
						}
					?>
				</select>
			</div>
			</br>


<?php
			echo "<a href=\"Balances_Controller.php?AltaBalances\"><input type=\"image\" src=\"..\Archivos\anadir.png\" width=\"20\" height=\"20\"></a>";
			echo "</fieldset>";
			echo "</form>";
?>

<?php
	include '../plantilla/pie.php';
	}}


?>
