<?php

  include("../Modelos/Balances_Model.php");
  include("../Idiomas/idiomas.php");
  include("../Vistas/Balances_ADD_Vista.php");
  include("../Vistas/Balances_DELETE_Vista.php");
  include("../Vistas/Balances_SHOW_Vista.php");
  include("../Vistas/MenuPrincipal_SHOW_Vista.php");
session_start();



		//viene de la vista del menu principal
  		if(isset($_REQUEST['Alta'])and isset($_SESSION['usuario'])){

  		$idiom=new idiomas();
        $model=new Balances();
		$listaequipos = $model->listarequipos();
        $alta=new BalancesAlta();
  			$alta->crear($idiom,$listaequipos);

  		}
  		//viene de la vista alta de balances
  		if (isset($_REQUEST['AltaBalances'])and isset($_SESSION['usuario']))
  		{
  			$idiom=new idiomas();
  			$equipo=$_POST['equipos'];
            $tipo=$_POST['tipo'];
			$dia=$_POST['dia'];
			$mes=$_POST['mes'];
			$ano=$_POST['ano'];
			$model=new Balances();
  			$fechaposible=$model->comprobarfecha($dia,$mes,$ano);
  			$model=new Balances();
  			$resultado=$model->comprobarexiste($equipo, $tipo);
  			if($resultado==FALSE && $fechaposible==TRUE)
  			{
			  $model=new Balances();
			  $ingresos = $model->totalingresos($equipo,$tipo,$dia,$mes,$ano);
			  $model=new Balances();
			  $gastos = $model->totalgastos($equipo,$tipo,$dia,$mes,$ano);
			  $model=new Balances();
			  $capital = $model->capitalactual($equipo);
			  $cap = $capital[0][0];
			  $resultadoPG = ($ingresos[0][0] - $gastos[0][0]);
			  $fecha = $ano."-".$mes."-".$dia;
			  $model=new Balances();
			  $model->altaBalance($equipo,$tipo,$resultadoPG,$cap,$fecha);
			$origen="Alta";
  			header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalInsert");
  			}else
  			{
			$model=new Balances();
			$listaequipos = $model->listarequipos();
			$alta=new BalancesAlta();
  			$alta->crear($idiom,$listaequipos);
  			}
  		}

		//Viene del Menu Principal para el Show
  		if (isset($_REQUEST['Consultar'])and isset($_SESSION['usuario']))
		{
			$idiom=new idiomas();
			$model=new Balances();
            $listaequipos=$model->listarequipos();
  			$vista=new Balances_SHOW();
  			$vista->crear($idiom,$listaequipos,null);

		}

		//Viene del Show para mostrar
		if (isset($_REQUEST['View']) and isset($_SESSION['usuario']))
		{
			$idiom=new idiomas();
			$equipo=$_POST['equipos'];
            $tipo=$_POST['tipo'];
			$model=new Balances();
			$listaequipos=$model->listarequipos();
			$model=new Balances();
			$listabalances=$model->listarbalances($equipo,$tipo);
			$vista=new Balances_SHOW();
  			$vista->crear($idiom,$listaequipos,$listabalances);
		}


  		//viene de la vista principal para eliminar
  		if(isset($_REQUEST['Baja'])and isset($_SESSION['usuario'])){

  			$idiom=new idiomas();
            $model=new Balances();
            $listaequipos=$model->listarequipos();
  			$vista=new BalancesDelete();
  			$vista->crear($idiom,$listaequipos);
  		}

  		//viene de la vista de baja de balances
  		 if (isset($_REQUEST['BajaBalances'])and isset($_SESSION['usuario']))
  			{
        $origen="Baja";
  			$idiom=new idiomas();
			$equipo=$_POST['equipos'];
            $tipo=$_POST['tipo'];
  			$fecha=$_POST['fecha'];
  			$model=new Balances();
  			$model->BajaBalance($equipo,$tipo,$fecha);
  			header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalDelete");
  			}


?>
