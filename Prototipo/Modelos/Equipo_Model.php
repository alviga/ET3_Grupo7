<?php

class Equipo{

  //Se conecta a la base de datos
  function conexionBD(){
        $mysqli=mysqli_connect("127.0.0.1","root","iu","ET3Grupo7");
        if(!$mysqli){
          //echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            //echo "error de depuración: " . mysqli_connect_errno() . PHP_EOL;
          //	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
            echo "<script> alert(\"No se puede conectar a la Base de Datos\");</script>";
            echo "<script> window.location=\".././index.php\"</script>";
            exit;
        }

      return $mysqli;
  }

		//funcion que inserta el equipo
		function altaEquipo($nombre,$login,$pwd,$tipo)
		{
			$mysqli=$this->conexionBD();

      if($tipo=='admin'){
        $query="INSERT INTO `equipo`(`nombre`, `capital`) VALUES ('$nombre',0)";
  			$mysqli->query($query);
        $query="INSERT INTO `cuenta`(`login`, `pwd`, `tipo`, `nombre_eq`) VALUES ('$login','$pwd',1,'$nombre')";
        $mysqli->query($query);
  			$mysqli->close();
      }else{
        $query="INSERT INTO `equipo`(`nombre`, `capital`) VALUES ('$nombre',100000)";
  			$mysqli->query($query);
        $query="INSERT INTO `cuenta`(`login`, `pwd`, `tipo`, `nombre_eq`) VALUES ('$login','$pwd',0,'$nombre')";
        $mysqli->query($query);
  			$mysqli->close();
      }
		}


		//comprueba si existe el equipo
		function comprobarExisteEquipo($nombre)
		{
			$mysqli=$this->conexionBD();
			$query="SELECT * FROM equipo where `nombre` ='$nombre'";
			$resultado=$mysqli->query($query);
			if(mysqli_num_rows($resultado)){
				$mysqli->close();
				return TRUE;
			}else{
				$mysqli->close();
				return FALSE;
			}
		}
    //comprueba si existe el login
    function comprobarExisteLogin($nombre)
		{
			$mysqli=$this->conexionBD();
			$query="SELECT * FROM cuenta where `login` ='$nombre'";
			$resultado=$mysqli->query($query);
			if(mysqli_num_rows($resultado)){
				$mysqli->close();
				return TRUE;
			}else{
				$mysqli->close();
				return FALSE;
			}
		}
    //Devuelve el nombre de todos los equipos
    function ConsultarEquipos(){

			$mysqli=$this->conexionBD();

			$toret=array();

				$sql = "SELECT nombre from equipo";

				if (!($resultado = $mysqli->query($sql))){
					return 'ERR_CONS_BD';
				}
			  else{
			    if ($resultado->num_rows >= 1){
						while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			    	      array_push($toret, $aux['nombre']);
			    	}
					  return $toret;
			 	  }
				}
		}
    //Consulta un equipo devolviendo sus datos
    function consularEquipo($name){

      $mysqli=$this->conexionBD();

			$toret=array();

				$sql = "SELECT e.nombre as nom, e.capital as capi, c.login as logi, c.pwd as pw, c.tipo as tip from equipo e, cuenta c where c.nombre_eq=e.nombre and e.nombre='$name'";

				if (!($resultado = $mysqli->query($sql))){
					return 'ERR_CONS_BD';
				}
			  else{
			    if ($resultado->num_rows >= 1){
						while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			    	      array_push($toret, $aux['nom']);
                  array_push($toret, $aux['capi']);
                  array_push($toret, $aux['logi']);
                  array_push($toret, $aux['pw']);
                  array_push($toret, $aux['tip']);
			    	}
					  return $toret;
			 	  }
				}
    }
    //Consulta equipos por una cadena pasada
    function buscarEquipoPorNombre($nombre){

      $mysqli=$this->conexionBD();

			$toret=array();

				$sql = "SELECT nombre from equipo where nombre like '%".$nombre."%'";

				if (!($resultado = $mysqli->query($sql))){
					return 'ERR_CONS_BD';
				}
			  else{
			    if ($resultado->num_rows >= 1){
						while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			    	      array_push($toret, $aux['nombre']);
			    	}
					  return $toret;
			 	  }
				}
    }
    //Modifica los datos de un equipo
    function modificarEquipo($nombre,$passw){

      $mysqli=$this->conexionBD();

			$query="UPDATE `cuenta` SET `pwd`='$passw' where `nombre_eq`='$nombre'";

			$mysqli->query($query);
			$mysqli->close();
    }
    //Da de baja un equipo
    function BajaEquipo($name){

				$mysqli=$this->conexionBD();

				$query="DELETE FROM `cuenta` WHERE `nombre_eq`='$name'";
      	$mysqli->query($query);

        $query="DELETE FROM `equipo` WHERE `nombre`='$name'";
      	$mysqli->query($query);

        $query="UPDATE `participante` SET `asignacion`='0', `nombre_eq`=NULL where `nombre_eq`='$name'";
        $mysqli->query($query);

				$mysqli->close();

    }

}

?>
