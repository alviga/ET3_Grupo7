<?php

class Participante{


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

		//funcion que inserta el partcipante
		function altaParticipante($dni,$nombre,$apellidos,$email,$telefono,$tipo)
		{
			$mysqli=$this->conexionBD();

        $query="INSERT INTO `participante`(`dni`,`nombre`,`apellidos`,`email`,`telefono`,`asignacion`,`tipo`) VALUES
		('$dni','$nombre','$apellidos','$email','$telefono','0','$tipo')";
  			$mysqli->query($query);

  			$mysqli->close();

		}
		//inserta el participante en un equipo
		function altaParticipanteEquipo($nombreeq,$dni){
			$mysqli=$this->conexionBD();

			$query="UPDATE `participante` SET `nombre_eq`='$nombreeq' ,`asignacion`='1' where `dni`='$dni'";
  			$mysqli->query($query);

  			$mysqli->close();

		}
		//da de baja el participante
    function BajaParticipante($dni){
      $mysqli=$this->conexionBD();

      $query="DELETE FROM `participante` WHERE `dni`='$dni'";
      $mysqli->query($query);

      $mysqli->close();
    }

		//da de baja el participante de un equipo
		function bajaParticipanteEquipo($dni,$nombre_eq)
		{
			$mysqli=$this->conexionBD();
			$query="UPDATE `participante` SET `asignacion`='0', `nombre_eq`= NULL where `dni`='$dni'";
  			$mysqli->query($query);

  			$mysqli->close();

		}


		//MODIFICAR Participante
		function modificarParticipante($dni,$nombre,$apellidos,$email,$telefono)
		{
      $mysqli=$this->conexionBD();

      $query="UPDATE `participante` SET `nombre`='$nombre' , `apellidos`='$apellidos' , `email`='$email' , `telefono`='$telefono' where `dni`='$dni'";

      $mysqli->query($query);
      $mysqli->close();
		}

		//listar participantes con ese equipo
		function listarcon($name)
		{

			$mysqli=$this->conexionBD();
			$query="SELECT * FROM participante WHERE nombre_eq='$name' AND nombre_eq IS NOT NULL";
			$resultado=$mysqli->query($query);
			while($fila = $resultado->fetch_array())
			{
				$filas[] = $fila;
			}
			return $filas;
		}

    //lista todos los participantes que tienen equipo
    function ConsultarParticipantes(){

  		$mysqli=$this->conexionBD();

  		$query="SELECT dni, nombre, apellidos, email, telefono, nombre_eq as nom FROM participante WHERE asignacion='1'";

  		$resultado = $mysqli->query($query);

  		$toret=array();
  		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
  			array_push($toret, $aux['dni']);
  			array_push($toret, $aux['nombre']);
  			array_push($toret, $aux['apellidos']);
  			array_push($toret, $aux['email']);
  			array_push($toret, $aux['telefono']);
        array_push($toret, $aux['nom']);
  		}

  		return $toret;
  	}

	//lista todos los participantes sin equipo
	function ConsultarParticipantesSin(){

  		$mysqli=$this->conexionBD();

  		$query="SELECT dni, nombre, apellidos, email, telefono, nombre_eq as nom FROM participante WHERE asignacion='0'";

  		$resultado = $mysqli->query($query);

  		$toret=array();
  		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
  			array_push($toret, $aux['dni']);
  			array_push($toret, $aux['nombre']);
  			array_push($toret, $aux['apellidos']);
  			array_push($toret, $aux['email']);
			array_push($toret, $aux['telefono']);
  		}

  		return $toret;
  	}

	//lista los equipos
		function listarequipos()
		{

			$mysqli=$this->conexionBD();
			$query="SELECT nombre FROM equipo";
			$resultado=$mysqli->query($query);
			while($fila = $resultado->fetch_array())
			{
				$filas[] = $fila;
			}
			return $filas;

		}
		//listalos equipo que no son admin
		function listarequipossinadmin()
		{

			$mysqli=$this->conexionBD();
			$query="SELECT nombre FROM equipo where nombre <> 'admin'";
			$resultado=$mysqli->query($query);
			while($fila = $resultado->fetch_array())
			{
				$filas[] = $fila;
			}
			return $filas;

		}
		//listar los equipos con el admin
		function listarequiposconadmin()
		{

			$mysqli=$this->conexionBD();
			$query="SELECT nombre FROM equipo where nombre = 'admin'";
			$resultado=$mysqli->query($query);
			while($fila = $resultado->fetch_array())
			{
				$filas[] = $fila;
			}
			return $filas;

		}
		//miramos el tipo que es participante
		function vertipo($dni)
		{

			$mysqli=$this->conexionBD();
			$query="SELECT tipo FROM participante where dni = '$dni'";
			$resultado=$mysqli->query($query);
			while($fila = $resultado->fetch_array())
			{
				$filas[] = $fila;
			}
			return $filas;

		}
		//comprueba que existe el participante
		function comprobarExisteParticipante($dni)
		{
			$mysqli=$this->conexionBD();
			$query="SELECT * FROM participante where `dni` ='$dni'";
			$resultado=$mysqli->query($query);
			if(mysqli_num_rows($resultado)){
				$mysqli->close();
				return TRUE;
			}else{
				$mysqli->close();
				return FALSE;
			}
		}

		//comprobar si tiene equipo
		function comprobarParticipanteEquipo($dni)
		{
			$mysqli=$this->conexionBD();
			$query="SELECT * FROM participante where `dni` ='$dni' AND asignacion='1'";
			$resultado=$mysqli->query($query);
			if(mysqli_num_rows($resultado)){
				$mysqli->close();
				return TRUE;
			}else{
				$mysqli->close();
				return FALSE;
			}
		}

}

?>
