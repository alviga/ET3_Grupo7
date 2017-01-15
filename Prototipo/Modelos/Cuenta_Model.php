<?php


class Cuenta
	{
	private $usuario;
	private $password;


	//constructor
	function constructor($usuario,$password)
	{
		$this->usuario=$usuario;
		$this->password=$password;
	}
	//funcion para conectar a la base de datos
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

		//funcion que comprueba el usuario y la constraseña en la base de datos
	function comprobarCuenta($user,$pass)
	{
		$mysqli=$this->conexionBD();
		$query="SELECT * FROM cuenta WHERE login='$user' AND pwd='$pass'";
		$resultado=$mysqli->query($query);
		if(mysqli_num_rows($resultado)){
		return true;
		}else{
			return false;
		}
	}

	function comprobarTipoCuenta($user)
	{
		$mysqli=$this->conexionBD();

		$sql="SELECT tipo FROM cuenta WHERE login='$user'";

		$resultado = $mysqli->query($sql);

		$toret=array();
		$aux=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($toret, $aux['tipo']);
		}

		return $toret;

	}


		//funcion que te comprueba que el usuario esta en la base de datos
		function comprobarLogin($user){

			$mysqli=$this->conexionBD();
			$query="SELECT * FROM cuenta where login ='$user'";
			$resultado=$mysqli->query($query);
			if(mysqli_num_rows($resultado)){
				$mysqli->close();
				return TRUE;
			}else{

				$mysqli->close();
				return FALSE;
			}
		}

		function consultarEquipos()
		{
			$mysqli=$this->conexionBD();

			$sql="SELECT nombre, capital FROM equipo e,cuenta c WHERE e.nombre=c.nombre_eq AND c.tipo='0'";

			$resultado = $mysqli->query($sql);

			$toret=array();

			if($resultado->num_rows != 0){

				$aux=array();
				while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
					array_push($toret, $aux['capital']);
					array_push($toret, $aux['nombre']);

				}

				$auxc = array();
				$auxm = array();

				for($i=0;$i<count($toret)-2;$i=$i+2)
				{
					for($j=$i;$j<count($toret)-2;$j=$j+2)
					{
						if($toret[$j]<$toret[$j+2]){

							$auxc = $toret[$j];
							$auxn = $toret[$j+1];

							$toret[$j] = $toret[$j+2];
							$toret[$j+1] = $toret[$j+3];

							$toret[$j+2] = $auxc;
							$toret[$j+3] = $auxn;
						}
					}
				}
			}

				return $toret;
			}

	}
