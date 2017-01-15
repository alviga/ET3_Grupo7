<style>
/* reset */
html, body, div, span, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
abbr, address, cite, code,
del, dfn, em, img, ins, kbd, q, samp,
small, strong, sub, sup, var,
b, i,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-size: 100%;
    vertical-align: baseline;
    background: transparent;
}
body {
    margin: 0;
    padding: 0;
    font: 12px/15px "Helvetica Neue",Arial, Helvetica, sans-serif;
    color: #555;
    background: #f5f5f5;
}
a {
    color: #666;
}
#content {
    width: 65%;
    max-width: 690px;
    margin: 6% auto 0;}

table {
    overflow: hidden;
    border: 1px solid #d3d3d3;
    background: #fefefe;
    width: 70%;
    margin: 5% auto 0;
    border-radius:5px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
}
th, td {padding:18px 28px 18px; text-align:center; }
th {padding-top:22px; text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}
td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}
tr.odd-row td {background:#f6f6f6;}
td.first, th.first {text-align:left}
td.last {border-right:none;}

td {
    background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
    background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
}
tr.odd-row td {
    background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
    background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
}
th {
    background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
    background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
}
tr:first-child th.first {
    -moz-border-radius-topleft:5px;
    -webkit-border-top-left-radius:5px; /* Saf3-4 */
}
tr:first-child th.last {
    -moz-border-radius-topright:5px;
    -webkit-border-top-right-radius:5px; /* Saf3-4 */
}
tr:last-child td.first {
    -moz-border-radius-bottomleft:5px;
    -webkit-border-bottom-left-radius:5px; /* Saf3-4 */
}
tr:last-child td.last {
    -moz-border-radius-bottomright:5px;
    -webkit-border-bottom-right-radius:5px; /* Saf3-4 */
}
</style>

<?php



class panel{

	function constructor($idioma,$origen)
    {
        // Definimos nuestra zona horaria
        date_default_timezone_set("Europe/Madrid");
        // incluimos el archivo de funciones
        include '../Funciones/funciones.php';
        include('../plantilla/cabecera.php');
        include("../Funciones/comprobaridioma.php");
        $clase=new cabecera();
        $clases=new comprobacion();
        $idiom=$clases->comprobaridioma($idioma);
        $clase->crear($idiom);
        include('../plantilla/menulateral.php');
        //include ('../Modelos/Cuenta_Model.php');

        $menus=new menulateral();
        $menus->crear($idiom);
        $idiomacalendario="español";
        if(isset($_SESSION['idioma'])){
        $idiomacalendario=$_SESSION['idioma'];
        }
        ?>


            <!-- /.container-fluid -->
        <?php
        include'../plantilla/pie.php';
	?>

	<center>
		<div id="content">
		    <table cellspacing="0">
		        <tr>
		            <th><center>Posición</center></th>
		            <th><center>Equipo</center></th>
		            <th><center>Capital</center></th>
		        </tr>

				<?php

          $cuen = new Cuenta();

					$toret = $cuen->consultarEquipos();


          if(count($toret) != 0){
            $num = 1;

					for($i=0;$i<count($toret);$i=$i+2){

						?><tr>
                <td><?php echo $num; ?></td>
						    <td><?php echo $toret[$i+1]; ?></td>
						    <td><?php echo $toret[$i];
                $num=$num+1;?></td>
              </tr><?php

					}
        }
				?>
		    </table>
		</div>
	</center>

 <?php
        if ($origen=="Baja"){
                echo "<script>alert(\"".$idiom["EliminacionExito"]."\")</script>";
                 }
        if ($origen=="Alta"){
                echo "<script>alert(\"".$idiom["Altarealizada"]."\")</script>";
                 }
        if ($origen=="Modificar"){
                echo "<script>alert(\"".$idiom["Modificacionrealizada"]."\")</script>";
                 }
        if($origen=="AltaFuncionalidad"){
                      echo "<script>alert(\"".$idiom["Altarealizada"]."\")</script>";
         }

 }
  }
?>
