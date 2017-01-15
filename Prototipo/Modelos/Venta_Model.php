<?php


class Venta
	{
	private $nombre;
	private $cantidad;
    private $min;


	//constructor
	function constructor($usuario,$password,$minimo)
	{
		$this->usuario=$usuario;
		$this->password=$password;
    $this->min=$minimo;
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



	//consulta las ventas vendidas
	function ConsultarVentasVendidas(){
	$mysqli=$this->conexionBD();

		$cuenta=$_SESSION['usuario'];

		$query="SELECT nombre FROM equipo e, cuenta c WHERE c.login='$cuenta' AND c.nombre_eq = e.nombre";

		$resultado = $mysqli->query($query);

		$equipo=array();
		$aux=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($equipo, $aux['nombre']);
		}

		$query="SELECT nombre_val as nombre, dia, hora, cantidad, minimo FROM venta WHERE nombre_eq='$equipo[0]' AND estado='1'";

		$resultado = $mysqli->query($query);

		$toret=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($toret, $aux['nombre']);
			array_push($toret, $aux['dia']);
			array_push($toret, $aux['hora']);
			array_push($toret, $aux['cantidad']);
			array_push($toret, $aux['minimo']);
		}

		return $toret;
	}
	//consulta las ventas pendientes
	function ConsultarVentasPendientes(){
	$mysqli=$this->conexionBD();

		$cuenta=$_SESSION['usuario'];

		$query="SELECT nombre FROM equipo e, cuenta c WHERE c.login='$cuenta' AND c.nombre_eq = e.nombre";

		$resultado = $mysqli->query($query);

		$equipo=array();
		$aux=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($equipo, $aux['nombre']);
		}

		$query="SELECT nombre_val as nombre, dia, hora, cantidad, minimo FROM venta WHERE nombre_eq='$equipo[0]' AND estado='0'";

		$resultado = $mysqli->query($query);

		$toret=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($toret, $aux['nombre']);
			array_push($toret, $aux['dia']);
			array_push($toret, $aux['hora']);
			array_push($toret, $aux['cantidad']);
			array_push($toret, $aux['minimo']);
		}

		return $toret;
	}
		//mira lo que tienes en tu inventario
	function comprobarInventario()

	{
		$mysqli=$this->conexionBD();

		$cuenta=$_SESSION['usuario'];

		$sql="SELECT nombre_val as val FROM inventario where nombre_eq='$cuenta'";

		$resultado = $mysqli->query($sql);
		$fila=array();

		while($fila = $resultado->fetch_array())
			{
				$filas[] = $fila;
			}
			return $filas;
	}
	//coge lo que quieres del inventario
  function altaVenta($nombre,$minimo){

    	$mysqli=$this->conexionBD();

      $cuenta=$_SESSION['usuario'];

			$query="SELECT * FROM inventario WHERE nombre_val='$nombre'";
			$resultado = $mysqli->query($query);
      $mysqli->close();

  }
  //busca las ventas por un dia determinado
  function buscarVentaPorDia($dia){

		$mysqli=$this->conexionBD();

		$cuenta=$_SESSION['usuario'];

		$query="SELECT nombre FROM equipo e, cuenta c WHERE c.login='$cuenta' AND c.nombre_eq = e.nombre";

		$resultado = $mysqli->query($query);

		$equipo=array();
		$aux=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($equipo, $aux['nombre']);
		}

		$query="SELECT nombre_val as nombre, dia, hora, cantidad, minimo FROM venta WHERE nombre_eq='$equipo[0]' AND dia='$dia'";

		$resultado = $mysqli->query($query);

		$toret=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($toret, $aux['nombre']);
			array_push($toret, $aux['dia']);
			array_push($toret, $aux['hora']);
			array_push($toret, $aux['cantidad']);
			array_push($toret, $aux['minimo']);
		}

		return $toret;
	}

}
