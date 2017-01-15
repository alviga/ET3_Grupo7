<?php

class Balances{


		function conexionBD()
		{
				$mysqli=mysqli_connect("127.0.0.1","root","iu","ET3Grupo7");
				if(!$mysqli)
				{
					echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    				echo "error de depuraci�n: " . mysqli_connect_errno() . PHP_EOL;
    				echo "error de depuraci�n: " . mysqli_connect_error() . PHP_EOL;
    				exit;
				}

			return $mysqli;
		}



		//inserta un nuevo balance
		function altaBalance($equipo, $tipo,$resultadoPG,$capital,$fecha)
		{
			$mysqli=$this->conexionBD();
			$query="INSERT INTO `balance`(`nombre_eq`,`fecha`,`tipo`,`cuenta_per_gan`,`total`) VALUES
		('$equipo','$fecha','$tipo','$resultadoPG','$capital')";
  			$mysqli->query($query);
  			$mysqli->close();
		}

		//funcion que eliminar un balance
		function bajaBalance($equipo,$tipo,$fecha)
			{

				$mysqli=$this->conexionBD();
				$query="DELETE FROM `balance` WHERE `nombre_eq` = '$equipo' AND `fecha` = '$fecha' AND `tipo` = '$tipo'";
				$mysqli->query($query);
				$mysqli->close();

			}


		//devuelve la lista de equipos
		function listarequipos()
		{

			$mysqli=$this->conexionBD();
			$query="SELECT nombre FROM equipo WHERE nombre != 'admin'";
			$resultado=$mysqli->query($query);
			$toret=array();
			$i=0;
				while ($fila= $resultado->fetch_array()) {
					$toret[$i]=$fila;
					$i++;
				}
            return $toret;

		}

		//devuelve todos los balances de un equipo y tipo determinado
		function listarbalances($equipo, $tipo)
		{

			$mysqli=$this->conexionBD();
			$query="SELECT * FROM balance WHERE nombre_eq = '$equipo' AND tipo='$tipo'";
			$resultado=$mysqli->query($query);
			$toret=array();
			$i=0;
				while ($fila= $resultado->fetch_array()) {
					$toret[$i]=$fila;
					$i++;
				}
            return $toret;

		}

		//comprueba si ya existe el balance
		function comprobarexiste($equipo, $tipo)
		{
			switch ($tipo){
				case "diaria" :
					$fecha = date('Y')."-".date('m')."-".date('d');
					break;
				case "mensual" :
					$fecha = date('Y')."-".date('m')."-";
					break;
				case "anual" :
					$fecha = date('Y')."-";
					break;
				default :
					$fecha = "";
					break;
			}
			$mysqli=$this->conexionBD();
			$query="SELECT * FROM balance WHERE nombre_eq='$equipo' AND tipo='$tipo' AND fecha LIKE '%$fecha%'";
			$resultado=$mysqli->query($query);
			if(mysqli_num_rows($resultado)){
				return TRUE;
			}
			 return FALSE;
		}

		//comprueba si la fecha es posible; que no sea una fecha futura
		function comprobarfecha($dia,$mes,$ano)
		{
			if($ano > date('Y'))
			{
				return FALSE;
			}
			else
				if($ano == date ('Y') && $mes > date('m'))
				{
					return FALSE;
				}
				else
					if($ano == date('Y') && $mes == date('m') && $dia >= date('d'))
					{
						return FALSE;
					}
			return TRUE;
		}

		//calcula los ingresos del periodo
		function totalingresos($equipo,$tipo,$dia,$mes,$ano)
		{
			switch ($tipo){
				case "diaria" :
					$fecha = $ano."-".$mes."-".$dia;
					break;
				case "mensual" :
					$fecha = $ano."-".$mes."-";
					break;
				case "anual" :
					$fecha = $ano."-";
					break;
				default :
					$fecha = "";
					break;
			}
			$mysqli=$this->conexionBD();
			$query="SELECT sum(cantidad*precio) FROM venta WHERE nombre_eq='$equipo' AND dia LIKE '%$fecha%' AND estado = '1'";
			$resultado=$mysqli->query($query);
			$toret=array();
			$i=0;
				while ($fila= $resultado->fetch_array()) {
					$toret[$i]=$fila;
					$i++;
				}
            return $toret;
		}

		//calcula los gastos del periodo
		function totalgastos($equipo,$tipo,$dia,$mes,$ano)
		{
			switch ($tipo){
				case "diaria" :
					$fecha = $ano."-".$mes."-".$dia;
					break;
				case "mensual" :
					$fecha = $ano."-".$mes."-";
					break;
				case "anual" :
					$fecha = $ano."-";
					break;
				default :
					$fecha = "";
					break;
			}
			$mysqli=$this->conexionBD();
			$query="SELECT sum(cantidad*maximo) FROM compra WHERE nombre_eq='$equipo' AND dia LIKE '%$fecha%'";
			$resultado=$mysqli->query($query);
			$toret=array();
			$i=0;
				while ($fila= $resultado->fetch_array()) {
					$toret[$i]=$fila;
					$i++;
				}
            return $toret;
		}

		//devuelve el capital actual del equipo
		function capitalactual($equipo)
		{

			$mysqli=$this->conexionBD();
			$query="SELECT capital FROM equipo WHERE nombre='$equipo'";
			$resultado=$mysqli->query($query);
			$toret=array();
			$i=0;
				while ($fila= $resultado->fetch_array()) {
					$toret[$i]=$fila;
					$i++;
				}
            return $toret;
		}
}

?>
