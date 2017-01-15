



<?php
class ValoresDelete{

	function crear($idioma,$resultado,$datos){

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
 		if ($resultado==FALSE){
 			echo "<script>alert(\"".$idiom["Eliminado"]."\")</script>";
 		}

 ?>
		</br></br>
		<legend><?php echo $idiom['Borrar valor'] ?></legend>

		<?php //Tabla con todos los Valores existentes actualmente y un botón de borrado para cada uno ?>
		<center>
		<div id="content">
		    <table cellspacing="0">
		        <tr>
		            <th><center>Nombre</center></th>
					<th><center>Borrar</center></th>
		        </tr>

				<?php

          if(count($datos) != 0){
            $num = 0;

					for($i=0;$i<count($datos);$i=$i+1){

						?><tr>
						<td><b><?php echo $datos[$i][0];?></b></td>
						<td><?php echo "<a href=\"Valores_Controller.php?BajaValores=".$datos[$i][0]."\""."><input type=\"image\"  onClick=\"return confirm('".$idiom['ConfirmarDelete']." ".$datos[$i][0]."?')\"src=\"..\Archivos\\eliminar.png\" width=\"20\" height=\"20\"></a>"; ?></td>
              </tr><?php
						$num=$num+1;
					}
			}
				?>
		    </table>
		</div>
	</center>


	</br></br>
<?php
	include '../plantilla/pie.php';
	}}


?>
