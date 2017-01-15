<?php

  include("../Modelos/Compra_Model.php");
  include("../Idiomas/idiomas.php");
  include("../Vistas/Compra_ADD_Vista.php");
  include("../Vistas/Compra_SHOW_Vista.php");

session_start();

    //viene de la barra lateral crear comrpa
    if(isset($_REQUEST['Crear'])and isset($_SESSION['usuario'])){

      $idiom=new idiomas();
      $alta=new CompraAlta();
      $alta->crear($idiom,TRUE,FALSE);

    }
    //Viene de la vista de crear compra
    if (isset($_REQUEST['AltaCompra'])and isset($_SESSION['usuario']))
  		{
  			$idiom=new idiomas();
  			$nombre=$_POST['nombre'];
        $cantidad=$_POST['cantidad'];
			  $maximo=$_POST['maximo'];
  			$model=new Compra();

        //Comprueba que existe una venta con esa cantidad y a ese precio
  			$resultado=$model->comprobarExisteVentaCantidadPrecio($nombre,$cantidad,$maximo);

  			if($resultado==TRUE)
  			{
                //Comprueba que el saldo le da para pagar la compra que queire realizar
                $resul2=$model->comprobarSaldo($cantidad,$maximo);

                if($resul2==TRUE){
                  //crea la coompra y insert en la bd
                  $model->altaCompra($nombre,$cantidad,$maximo);
                  $origen="Alta";
                  header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalInsert");
                }else{
                  $alta=new CompraAlta();
                  $alta->crear($idiom,FALSE,FALSE);
                }

  			}else
  			{
          //si algo no se cumple te muestra que la introduccio es incorrecta
  			  $alta=new CompraAlta();
  			  $alta->crear($idiom,FALSE,FALSE);
  			}
  		}
      //Viene de la barra lateral
      if (isset($_REQUEST['Consultar'])and isset($_SESSION['usuario']))
		{
        $origen="consultar";
			  $idiom=new idiomas();
  			$vistas=new Compra_SHOW();
        $var=new Compra();
			  $form=$var->ConsultarCompras();
  			$vistas->crear($form,$idiom,$origen);

		}

    //viene del buscado de la vista show
   if (isset($_POST['buscador']) and !isset($_REQUEST['ModificarView'])and isset($_SESSION['usuario']))
     {
     $origen="consultar";
     $idiom=new idiomas();
     $dia=$_POST['buscar'];
     $model=new Compra();
     $vistas=new Compra_SHOW();
     $form=$model->buscarCompraPorDia($dia);
     $vistas->crear($form,$idiom,$origen);

     }

        if(!isset($_SESSION['usuario'])){
          session_destroy();
          echo"<script>window.location=\"../index.php\"</script>";
        }


?>
