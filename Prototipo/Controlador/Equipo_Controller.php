<?php

  include("../Modelos/Equipo_Model.php");
  include("../Idiomas/idiomas.php");
  include("../Vistas/Equipo_ADD_Vista.php");
  include("../Vistas/Equipo_SHOW_Vista.php");
  include("../Vistas/Equipo_VIEW_Vista.php");
  include("../Vistas/Equipo_EDIT_Vista.php");
  include("../Vistas/Equipo_DELETE_Vista.php");
  include("../Vistas/MenuPrincipal_SHOW_Vista.php");
session_start();

    //viene de la barra lateral de crer equipo
    if(isset($_REQUEST['Crear'])and isset($_SESSION['usuario'])){

      $idiom=new idiomas();
      $alta=new EquipoAlta();
      $alta->crear($idiom,TRUE,FALSE);

    }
    //Viene de la vista de crear equipo
    if (isset($_REQUEST['AltaEquipo'])and isset($_SESSION['usuario']))
  		{
  			$idiom=new idiomas();
  			$nombre=$_POST['nombre'];
        $login=$_POST['login'];
			  $pwd=$_POST['passwd'];
        $tipo=$_POST['tipo'];
  			$model=new Equipo();
        //Comprueba si ese nombre de equipo ya existe
  			$resultado=$model->comprobarExisteEquipo($nombre);
  			if($resultado==FALSE)
  			{
              //Comprueba si ese login ya existe
              $resul1=$model->comprobarExisteLogin($login);

              if($resul1==FALSE){
                //Crea el eequipo ena bd
                $model->altaEquipo($nombre,$login,$pwd,$tipo);
                $origen="Alta";
                header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalInsert");

              }else{
                //si algo no se cumple muestra introduccion incorrecta
                $alta=new EquipoAlta();
        			  $alta->crear($idiom,FALSE,FALSE);

              }

  			}else
  			{
  			  $alta=new EquipoAlta();
  			  $alta->crear($idiom,FALSE,FALSE);
  			}
  		}
      //Viene del menu lateral buscar equipo
      if (isset($_REQUEST['Consultar'])and isset($_SESSION['usuario']))
		{
        $origen="consultar";
			  $idiom=new idiomas();
  			$vistas=new Equipo_SHOW();
        $var=new Equipo();
			  $form=$var->ConsultarEquipos();
  			$vistas->crear($form,$idiom,$origen);

		}
    //Viene del consultar equipos, muestra uno en detalle
    if(isset($_REQUEST['View'])and isset($_SESSION['usuario']))
       {
         $origen="consultar";
         $idiom=new idiomas();
         $name=$_REQUEST['View'];
         $model=new Equipo();
         $var=$model->consularEquipo($name);
         $vistas=new Equipo_VIEW();
         $vistas->crear($var,$idiom,$origen);
       }

       //viene del buscado de la vista show
  		if (isset($_POST['buscador']) and !isset($_REQUEST['ModificarView'])and isset($_SESSION['usuario']))
  			{
        $origen="consultar";
  			$idiom=new idiomas();
  			$name=$_POST['buscar'];
  			$model=new Equipo();
  			$vistas=new Equipo_SHOW();
        $form=$model->buscarEquipoPorNombre($name);
  			$vistas->crear($form,$idiom,$origen);

	  		}


        //viene de la vista view
       if(isset($_REQUEST['Modificar'])and isset($_SESSION['usuario'])){
          $idiom=new idiomas();
          $origen="Modificar";
          $name=$_REQUEST['Modificar'];
          $model=new Equipo();
          $var=$model->consularEquipo($name);
          $vista=new EquipoEDIT();
          $vista->crear($idiom,$var,TRUE);
      }
      //Viene de la vista modificar equipo
      if (isset($_REQUEST['ModificarEquipo'])and isset($_SESSION['usuario']))
  		{
       	$origen="Modificar";
  			$idiom=new idiomas();
  			$name=$_POST['Nombre'];
  			$pwd=$_POST['pwd'];
  			$model=new Equipo();
  			$model->modificarEquipo($name,$pwd);
        header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalEdit");

  		}

      //viene de la vista show
  		if(isset($_REQUEST['Baja'])and isset($_SESSION['usuario'])){

  				$idiom=new idiomas();
          $name=$_REQUEST['Baja'];
  				$vista=new EquipoDelete();
  				$vista->crear($idiom,TRUE,$name);
  		}

      //viene de la vista baja de equipo
  		 if (isset($_REQUEST['BajaEquipo'])and isset($_SESSION['usuario']))
  			{
        $origen="Baja";
  			$idiom=new idiomas();
  			$name=$_REQUEST['BajaEquipo'];
  			$model=new Equipo();
  			$model->BajaEquipo($name);
        header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalDelete");

  			}

        if(!isset($_SESSION['usuario'])){
          session_destroy();
          echo"<script>window.location=\"../index.php\"</script>";
        }


?>
