<?php


class Compra
	{
	private $nombre;
	private $cantidad;
  private $max;


	//constructor
	function constructor($usuario,$password,$maximo)
	{
		$this->usuario=$usuario;
		$this->password=$password;
    $this->max=$maximo;
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

	//Devuelve el nombre de los valores
	function comprobarValores()
	{
		$mysqli=$this->conexionBD();

		$sql="SELECT nombre FROM valor";

		$resultado = $mysqli->query($sql);

		$toret=array();
		$aux=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($toret, $aux['nombre']);
		}

		return $toret;

	}
	//comprueba si existe una venta de ese valor, que venda esa cantidad o mas y que el minimo sea menorque nuestro maximo
  function comprobarExisteVentaCantidadPrecio($nombre,$cantidad,$maximo){

    $mysqli=$this->conexionBD();

		$query="SELECT * FROM venta WHERE nombre_val='$nombre' AND cantidad >= '$cantidad' AND minimo <= '$maximo' AND estado = '0'";

		$resultado=$mysqli->query($query);

		if(mysqli_num_rows($resultado)){
		    return TRUE;
		}else{
			return FALSE;
		}
  }
	//Comprueba que el salo es mayor que la cantidad por el precio
  function comprobarSaldo($cantidad,$maximo){

    $mysqli=$this->conexionBD();

    $cuenta=$_SESSION['usuario'];
    $total=$cantidad*$maximo;

    $query="SELECT * FROM equipo e, cuenta c WHERE c.login='$cuenta' AND c.nombre_eq = e.nombre AND e.capital >= '$total'";

    $resultado=$mysqli->query($query);

		if(mysqli_num_rows($resultado)){
		    return TRUE;
		}else{
			return FALSE;
		}
  }
	//Devuelve las compras de un valor
	function ConsultarCompras(){

		$mysqli=$this->conexionBD();

		$cuenta=$_SESSION['usuario'];

		$query="SELECT nombre FROM equipo e, cuenta c WHERE c.login='$cuenta' AND c.nombre_eq = e.nombre";

		$resultado = $mysqli->query($query);

		$equipo=array();
		$aux=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($equipo, $aux['nombre']);
		}

		$query="SELECT nombre_val as nombre, dia, hora, cantidad, maximo FROM compra WHERE nombre_eq='$equipo[0]'";

		$resultado = $mysqli->query($query);

		$toret=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($toret, $aux['nombre']);
			array_push($toret, $aux['dia']);
			array_push($toret, $aux['hora']);
			array_push($toret, $aux['cantidad']);
			array_push($toret, $aux['maximo']);
		}

		return $toret;
	}
	//Busca compras realizadas en un día determinado
	function buscarCompraPorDia($dia){

		$mysqli=$this->conexionBD();

		$cuenta=$_SESSION['usuario'];

		$query="SELECT nombre FROM equipo e, cuenta c WHERE c.login='$cuenta' AND c.nombre_eq = e.nombre";

		$resultado = $mysqli->query($query);

		$equipo=array();
		$aux=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($equipo, $aux['nombre']);
		}

		$query="SELECT nombre_val as nombre, dia, hora, cantidad, maximo FROM compra WHERE nombre_eq='$equipo[0]' AND dia='$dia'";

		$resultado = $mysqli->query($query);

		$toret=array();
		while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
			array_push($toret, $aux['nombre']);
			array_push($toret, $aux['dia']);
			array_push($toret, $aux['hora']);
			array_push($toret, $aux['cantidad']);
			array_push($toret, $aux['maximo']);
		}

		return $toret;
	}
	//Introduce la compra en la bd
  function altaCompra($nombre,$cantidad,$maximo){

    	$mysqli=$this->conexionBD();

      $cuenta=$_SESSION['usuario'];

			$query="SELECT nombre_eq as nombre, dia, hora, cantidad FROM venta WHERE nombre_val='$nombre' AND cantidad >= '$cantidad' AND minimo <= '$maximo' AND estado = '0'";

			$resultado = $mysqli->query($query);

			$vendedor=array();
			$aux=array();
			while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
				array_push($vendedor, $aux['nombre']);
				array_push($vendedor, $aux['dia']);
				array_push($vendedor, $aux['hora']);
				array_push($vendedor, $aux['cantidad']);
			}

			$query="SELECT capital FROM equipo WHERE nombre='$vendedor[0]'";
			$resultado = $mysqli->query($query);
			while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
				array_push($vendedor, $aux['capital']);
			}

			$query="SELECT e.nombre as nom, e.capital as capi FROM equipo e, cuenta c WHERE c.login='$cuenta' AND c.nombre_eq = e.nombre";
			$resultado = $mysqli->query($query);

			$comprador=array();
			while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
				array_push($comprador, $aux['nom']);
				array_push($comprador, $aux['capi']);
			}
			//Inserto la compra
			$fecha = date('Y')."-".date('m')."-".date('d');
			$hora = date('H').":".date('i');
      $query="INSERT INTO `compra`(`nombre_eq`, `nombre_val`, `dia`, `hora`, `cantidad`, `maximo`)
    	VALUES ('$comprador[0]','$nombre','$fecha','$hora','$cantidad','$maximo')";
      $mysqli->query($query);

			$capiComprador = $comprador[1] - ($cantidad*$maximo);

			//Cambio el capital del comprador
			$sql = "UPDATE equipo SET capital = '$capiComprador' WHERE nombre = '$comprador[0]'";
			$mysqli->query($sql);

			//Cambio el capital del vendedor si no es admin
			if($vendedor[0] != 'admin'){
				$capiVendedor = $vendedor[4] + ($cantidad*$maximo);
				$sql = "UPDATE equipo SET capital = '$capiVendedor' WHERE nombre = '$vendedor[0]'";
				$mysqli->query($sql);
			}

			$cantidadVenta = $vendedor[3] - $cantidad;

			//Si la venta ya no tiene unidades la borro, sino cambio la cantidad de venta
			if($cantidadVenta == 0){
				$sql = "DELETE FROM venta WHERE nombre_eq = '$vendedor[0]' and nombre_val ='$nombre' and dia ='$vendedor[1]' and hora = '$vendedor[2]'";
				$mysqli->query($sql);
			}else{
				$sql = "UPDATE venta SET cantidad = '$cantidadVenta' WHERE nombre_eq = '$vendedor[0]' and nombre_val ='$nombre' and dia ='$vendedor[1]' and hora = '$vendedor[2]'";
				$mysqli->query($sql);
			}

			//Creo la venta realizada
			$sql="INSERT INTO `venta`(`nombre_eq`, `nombre_val`, `dia`, `hora`, `cantidad`, `precio`, `estado`, `minimo`)
    	VALUES ('$vendedor[0]','$nombre','$fecha','$hora','$cantidad','$maximo','1','0')";
      $mysqli->query($sql);

			//Sumo en el inventario del comprador y resto en el del vendedor

			$query="SELECT cantidad FROM inventario WHERE nombre_eq='$comprador[0]' AND nombre_val = '$nombre'";
			$resultado = $mysqli->query($query);

			if(mysqli_num_rows($resultado)){
					//SI EXISTE LE CAMBIO LA CANTIDAD
					$oldInvent=array();
					while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
						array_push($oldInvent, $aux['cantidad']);
					}
					$newInvent = $oldInvent[0] + $cantidad;

					$sql = "UPDATE inventario SET cantidad = '$newInvent' WHERE nombre_eq = '$comprador[0]' and nombre_val ='$nombre'";
					$mysqli->query($sql);

			}else{
					//SI NO EXISTE LO CREO
					$query="INSERT INTO `inventario`(`nombre_eq`, `nombre_val`, `cantidad`)
		    	VALUES ('$comprador[0]','$nombre','$cantidad')";
		      $mysqli->query($query);
			}

				//Resto del inventario del vendedor

				if($vendedor[0] != 'admin'){

					$query="SELECT cantidad FROM inventario WHERE nombre_eq='$vendedor[0]' AND nombre_val = '$nombre'";
					$resultado = $mysqli->query($query);

					$oldInvent=array();
					while($aux = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
						array_push($oldInvent, $aux['cantidad']);
					}

					$newInvent = $oldInvent[0] - $cantidad;

					if($newInvent == 0){
						//SI QUEDA A CERO LA BORRO
						$sql = "DELETE FROM inventario WHERE nombre_eq = '$vendedor[0]' and nombre_val ='$nombre'";
						$mysqli->query($sql);
					}else{
						//SI NO QUEDA A CERO LE RESTO
						$sql = "UPDATE inventario SET cantidad = '$newInvent' WHERE nombre_eq = '$vendedor[0]' and nombre_val ='$nombre'";
						$mysqli->query($sql);
					}

				}

      $mysqli->close();

  }

}
