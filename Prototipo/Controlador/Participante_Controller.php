<?php
  include("../Modelos/Participante_Model.php");
  include("../Idiomas/idiomas.php");
  include("../Vistas/Participante_ADD_Vista.php");
  include("../Vistas/Participante_DELETE_Vista.php");
  include("../Vistas/Participante_EDIT_Vista.php");
  include("../Vistas/Participante_SHOW_Sin_Vista.php");
  include("../Vistas/Participante_SHOW_Vista.php");
  include("../Vistas/Participante_ADD_Equipo_Vista.php");
  include("../Vistas/Participante_DELETE_Equipo_Vista.php");
  //include("../Vistas/MenuPrincipal_SHOW_Vista.php");
session_start();

    //viene del menu principal vista-CrearParticipante
    if(isset($_REQUEST['Crear'])and isset($_SESSION['usuario'])){

      $idiom=new idiomas();
      $alta=new ParticipanteAlta();
      $alta->crear($idiom,TRUE,FALSE);

    }
	//da de alta un participante
    if (isset($_REQUEST['AltaParticipante'])and isset($_SESSION['usuario']))
  		{
  			$idiom=new idiomas();
			  $dni=$_POST['dni'];
  			$nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
			  $email=$_POST['email'];
        $telefono=$_POST['telefono'];
	    	$tipo=$_POST['tipo'];
	

  			$model=new Participante();
			//comprueba si existe el participante
  			$resultado=$model->comprobarExisteParticipante($dni);
  			if($resultado==FALSE)
  			{	
                if ($tipo=='admin'){
                  $model->altaParticipante($dni,$nombre,$apellidos,$email,$telefono,1);
                }else{
                  $model->altaParticipante($dni,$nombre,$apellidos,$email,$telefono,0);
                }
                $origen="Alta";
                $origen="Alta";
                header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalInsert");

  			}else
  			{
  			  $alta=new ParticipanteAlta();
  			  $alta->crear($idiom,FALSE,FALSE);
  			}
  		}
		//añadir participante equipo
				if(isset($_REQUEST['AltaParticipanteEquipo'])and isset($_SESSION['usuario'])){

      $idiom=new idiomas();
	  $model = new Participante();
      $alta=new ParticipanteAltaEquipo();
	  $dni=$_REQUEST['AltaParticipanteEquipo'];
	  $tipo= $model->vertipo($dni);
	  
	  if ($tipo[0][0]=='1'){//lista equipos que sean administradores
				$listaequipos = $model->listarequiposconadmin();
                }else{//listaequipos que no sean administradores
                $listaequipos = $model->listarequipossinadmin();
                }
	  
      $alta->crear($idiom,$listaequipos,$dni);
	  

    }
	 //añadir participante equipo
    if (isset($_REQUEST['AltaParticipanteEquipo2'])and isset($_SESSION['usuario']))
  		{
  			$idiom=new idiomas();
			$dni=$_REQUEST['AltaParticipanteEquipo2'];
			$nombreeq=$_POST['equipo'];
			$alta=new ParticipanteAltaEquipo();
			$alta->crear($idiom,$listaequipos,$dni);
			
  			$model=new Participante();

                $model->altaParticipanteEquipo($nombreeq,$dni);
                
				header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalInsert");
  			}
		//modificar
    //viene de la vista view
   if(isset($_REQUEST['Modificar'])and isset($_SESSION['usuario'])){

      $idiom=new idiomas();
      $origen="Modificar";
      $dni=$_REQUEST['Modificar'];
      $vista=new ParticipanteEDIT();
      $vista->crear($idiom,$dni,TRUE);
  }

  if (isset($_REQUEST['ModificarParticipante'])and isset($_SESSION['usuario']))
  {
    $origen="Modificar";
    $idiom=new idiomas();
    $dni=$_POST['dni'];
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $email=$_POST['email'];
    $telefono=$_POST['telefono'];
    $model=new Participante();
    $model->modificarParticipante($dni,$nombre,$apellidos,$email,$telefono);
    header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalEdit");
    /*
    $vista=new panel();
    $vista->constructor($idiom,$origen);
    */
  }


		//dar de baja participante
    if(isset($_REQUEST['Baja'])and isset($_SESSION['usuario'])){

        $idiom=new idiomas();
        $dni=$_REQUEST['Baja'];
        $vista=new ParticipanteDelete();
        $vista->crear($idiom,TRUE,$dni);
    }

    //viene de la vista de baja de participante
     if (isset($_REQUEST['BajaParticipante'])and isset($_SESSION['usuario']))
      {
      
      $idiom=new idiomas();
      $dni=$_REQUEST['BajaParticipante'];
      $model=new Participante();
      $model->BajaParticipante($dni);
      header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalDelete");
      
      }
	  //elimina participante de un equipo
			if(isset($_REQUEST['BajaParticipanteEquipo'])and isset($_SESSION['usuario'])){

				$idiom=new idiomas();
				$model = new Participante();
				 $dni=$_REQUEST['BajaParticipanteEquipo'];
				 $nombre_eq=$_REQUEST['BajaParticipanteEquipo'];
				$baja=new ParticipanteBajaEquipo();
				$baja->crear($idiom,TRUE,$dni,$nombre_eq);

				}

		//viene de elminiar participante de un equipo
  		 if (isset($_REQUEST['BajaParticipanteEquipo2'])and isset($_SESSION['usuario']))
  			{
       
  			$idiom=new idiomas();
  			$dni=$_REQUEST['BajaParticipanteEquipo2'];
			$nombre_eq=$_REQUEST['BajaParticipanteEquipo2'];
  			$model=new Participante();
  			$model->bajaParticipanteEquipo($dni,$nombre_eq);
			 header("Location: ..\Controlador\MenuPrincipal_Controller.php?principalDelete");
  
  			}

		//consultar los participantes sin equipo
		if(isset($_REQUEST['ConsultarSin'])and isset($_SESSION['usuario'])){

				
  			  $idiom=new idiomas();
    			$vistas=new Participante_SHOW_Sin();
          $var=new Participante();
  			  $form=$var->ConsultarParticipantesSin();
    			$vistas->crear($form,$idiom);

				}
				//Consultar participantes con equipo
        if (isset($_REQUEST['Consultar'])and isset($_SESSION['usuario']))
  		{
          $origen="consultar";
  			  $idiom=new idiomas();
    			$vistas=new Participante_SHOW();
          $var=new Participante();
  			  $form=$var->ConsultarParticipantes();
    			$vistas->crear($form,$idiom);

  		}
		//viene de consultar participantes equipo
	 if(isset($_REQUEST['Consultar2'])and isset($_SESSION['usuario'])){

				$idiom=new idiomas();
				$model = new Participante();
				$listaequipos = $model->listarequipos();
				$equipos=$_REQUEST['nombre_eq'];
				$model = new Participante();
				$listaparticipantes = $model->listarcon($equipos);
				$consultarcon=new Participante_SHOW();
				$consultarcon->crear($idiom,$listaequipos,$listaparticipantes);

				}


		
?>
