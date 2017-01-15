<?php

  include("../Modelos/Venta_Model.php");
  include("../Idiomas/idiomas.php");
  include("../Vistas/Venta_ADD_Vista.php");
  include("../Vistas/Venta_SHOW_Vista.php");
  include("../Vistas/Venta_SHOW_Cancelar_Vista.php");
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
			$minimo=$_POST['minimo'];
  			$model=new Venta();
				//mira lo que hayen tu inventario
  			$resultado=$model->comprobarInventario();

  			 $model->altaVenta($nombre,$minimo);
                  $alta=new VentaAlta();
                  $alta->crear($idiom,FALSE,$resultado);
              
		}
		//cancela la venta
		 if (isset($_REQUEST['Cancelar'])and isset($_SESSION['usuario']))
		{
        
			  $idiom=new idiomas();
			  $vistas=new Venta_SHOW_Cancelar();
			  $var=new Venta();
			  //mira tus ventas pendientes
			  $form=$var->ConsultarVentasPendientes();
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