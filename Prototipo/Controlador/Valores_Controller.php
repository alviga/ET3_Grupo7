<?php

  include("../Modelos/Valores_Model.php");
  include("../Idiomas/idiomas.php");
  include("../Vistas/Valores_DELETE_Vista.php");
  include("../Vistas/MenuPrincipal_SHOW_Vista.php");
session_start();


  		//llega desde el menu principal
  		if(isset($_REQUEST['Baja'])and isset($_SESSION['usuario'])){

  			$idiom=new idiomas();
            $model=new Valores();
            $datos = $model->ConsultarValores();
  			$vista=new ValoresDelete();
  			$vista->crear($idiom,TRUE,$datos);
  		}
  		//llega desde el botón de borrar
  		 if (isset($_REQUEST['BajaValores'])and isset($_SESSION['usuario']))
  			{
        $origen="Baja";
  			$idiom=new idiomas();
  			$name=$_REQUEST['BajaValores'];
  			$model=new Valores();
			$model2=new Valores();
  			$model->BajaValores($name);
  			header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalDelete");
  			}

        //llega desde el recuadro de busqueda
          if(isset($_REQUEST['BajaShow'])and isset($_SESSION['usuario']))
        {
          $origen="Baja";
          $idiom=new idiomas();
          $name=$_POST['buscar'];
          $model=new Valores();
          $datos = $model->buscarValores($name);
          $vistas=new ValoresDelete();
          $vistas->crear($idiom,TRUE,$datos);
        }

		//llega desde el formulario
          if(isset($_REQUEST['BajaShow1'])and isset($_SESSION['usuario']))
         {

          $origen="Baja";
          $idiom=new idiomas();
          $name=$_REQUEST['BajaShow1'];
          $model=new Valores();
          $datos = $model->buscarValores($name);
		  $vistas=new ValoresDelete();
          $vistas->crear($idiom,TRUE,$datos);
         }


?>
