<?php

class Valores{

		//Conexion a la BD
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

		//funcion que elimina un valor
		function bajaValores($name)
			{
				$mysqli=$this->conexionBD();
				$query="DELETE FROM `valor` WHERE `nombre`='$name'";
				$mysqli->query($query);
				$mysqli->close();
			}


		//funcion que crea un array con todos los valores
		function consultarValores()
		{
			$mysqli=$this->conexionBD();
			$query="SELECT * FROM valor ";
			$resultado=$mysqli->query($query);
			 if (!$resultado){
				return 'Error en la consulta sobre la base de datos';
			}
			else{
				$toret=array();
				$i=0;
				while ($fila= $resultado->fetch_array()) {
					$toret[$i]=$fila;
					$i++;
				}
            return $toret;
			}
		}
}

?>
