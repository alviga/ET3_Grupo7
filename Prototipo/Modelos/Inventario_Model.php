<?php


class Inventario
	{
	private $nombre;
	private $cantidad;


	//constructor
	function constructor($nombre,$cantidad)
	{
		$this->nombre=$nombre;
		$this->cantidad=$cantidad;
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



	function ConsultarInventario()
	{
    $mysqli=$this->conexionBD();

		$cuenta=$_SESSION['usuario'];

		$query="SELECT nombre FROM equipo e, cuenta c WHERE c.login='$cuenta' AND c.nombre_eq = e.nombre";

		$resultado = $mysqli->query($query);

		$equipo=array();
		$aux=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($equipo, $aux['nombre']);
		}

		$query="SELECT nombre_val as nombre, cantidad FROM inventario WHERE nombre_eq='$equipo[0]'";

		$resultado = $mysqli->query($query);

		$toret=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($toret, $aux['nombre']);
			array_push($toret, $aux['cantidad']);
		}

		return $toret;

	}

	}
