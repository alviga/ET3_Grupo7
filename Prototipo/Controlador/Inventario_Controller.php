<?php

  include("../Modelos/Inventario_Model.php");
  include("../Idiomas/idiomas.php");
  include("../Vistas/Inventario_SHOW_Vista.php");

session_start();



      if (isset($_REQUEST['Consultar'])and isset($_SESSION['usuario']))
		{
        $origen="consultar";
			  $idiom=new idiomas();
  			$vistas=new Inventario_SHOW();
        $var=new Inventario();
			  $form=$var->ConsultarInventario();
  			$vistas->crear($form,$idiom,$origen);

		}


  			if (isset($_REQUEST['Volver'])and isset($_SESSION['usuario']))
  			{
        $origen="volver";
  			$idiom=new idiomas();
  			$vista=new panel();
        $vista->constructor($idiom,$origen);
  			}
        if(!isset($_SESSION['usuario'])){
          session_destroy();
          echo"<script>window.location=\"../index.php\"</script>";
        }


?>
