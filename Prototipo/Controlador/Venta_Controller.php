<?php

  include("../Modelos/Venta_Model.php");
  include("../Idiomas/idiomas.php");
  include("../Vistas/Venta_ADD_Vista.php");
  include("../Vistas/Venta_SHOW_Vista.php");
   include("../Vistas/Ventas_SHOW_Pendientes_Vista.php");
  include("../Vistas/MenuPrincipal_SHOW_Vista.php");
session_start();

    //viene del menu principal vista crear venta
    if(isset($_REQUEST['Crear'])and isset($_SESSION['usuario'])){

      $idiom=new idiomas();
	    $venta=new VentaAlta();
      $venta->crear($idiom,TRUE,FALSE);

    }
	//da de alta la venta
    if (isset($_REQUEST['AltaVenta'])and isset($_SESSION['usuario']))
  		{
  			$idiom=new idiomas();
  			$nombre=$_POST['nombre'];
        $cantidad=$_POST['cantidad'];
			  $minimo=$_POST['minimo'];
  			$model=new Venta();
				//mira lo que hay en tu inventario

        //Comprueba que el saldo le da para pagar la compra que queire realizar
        $resultado=$model->comprobarInventarioCantidad($nombre,$cantidad);

        if($resultado==TRUE){
          //crea la venta y hace el inserte en la bd
          $model->altaVenta($nombre,$cantidad,$minimo);
          $origen="Alta";
          header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalInsert");
        }else{
          $alta=new VentaAlta();
          $alta->crear($idiom,FALSE,FALSE);
        }

		}
		//cancela la venta
    if (isset($_REQUEST['Cancelar'])and isset($_SESSION['usuario']))
   {

       $idiom=new idiomas();
       $name=$_REQUEST['Cancelar'];
       $model = new Venta();
       $model->anularVenta($name);
       header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalDelete");
   }

    //viene del buscador de la vista show
   if (isset($_POST['buscadorVendida']) and !isset($_REQUEST['ModificarView'])and isset($_SESSION['usuario']))
     {
     $origen="consultar";
     $idiom=new idiomas();
     $dia=$_POST['buscar'];
     $model=new Venta();
     $vistas=new Venta_SHOW();
     $form=$model->buscarVentaVendidaPorDia($dia);
     $vistas->crear($form,$idiom);

     }

     //viene del buscador de la vista show
    if (isset($_POST['buscadorPendiente']) and !isset($_REQUEST['ModificarView'])and isset($_SESSION['usuario']))
      {
      $origen="consultar";
      $idiom=new idiomas();
      $dia=$_POST['buscar'];
      $model=new Venta();
      $vistas=new Venta_SHOW();
      $form=$model->buscarVentaPendientePorDia($dia);
      $vistas->crear($form,$idiom);

      }

		//consulta las ventas vendidas
      if (isset($_REQUEST['Consultar1'])and isset($_SESSION['usuario']))
		{

			  $idiom=new idiomas();
			  $vistas=new Venta_SHOW();
			  $var=new Venta();
			  //mira tus ventas vendidas
			  $form=$var->ConsultarVentasVendidas();
  			$vistas->crear($form,$idiom);
		}
		//consulta las ventas pendientes
		  if (isset($_REQUEST['Consultar2'])and isset($_SESSION['usuario']))
		{

			  $idiom=new idiomas();
			  $var=new Venta();
			  $form=$var->ConsultarVentasPendientes();
  			  $vistas=new Venta_SHOW_Pendientes();
  			$vistas->crear($form,$idiom);


		}

    //viene del buscado de la vista show
   if (isset($_POST['buscador']) and !isset($_REQUEST['ModificarView'])and isset($_SESSION['usuario']))
     {
     $idiom=new idiomas();
     $dia=$_POST['buscar'];
     $model=new Venta();
     $vistas=new Venta_SHOW_Pendientes();
     $form=$model->buscarVentaPorDia($dia);
     $vistas->crear($form,$idiom);

     }



?>
