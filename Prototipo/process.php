<?php
session_start();
$servername = "localhost";
$username = $_REQUEST['usuario'];
$password = $_REQUEST['password'];

//ESTO NO SE PA QUE ES
$file = fopen("./config.txt", "w");
fwrite($file, $username."\r\n");
fwrite($file, $password."\r\n");
fclose($file);

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE ET3Grupo7";
if ($conn->query($sql) === TRUE) {
    echo "<h2> Base de datos creada con exito </h2>";
} else {
    echo "Error creating database: " . $conn->error;
}

$mysqli = new mysqli("localhost", $username, $password, "ET3Grupo7");

if ($mysqli->connect_errno) {
	echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$queries = explode(';', file_get_contents("./bd.sql"));
foreach($queries as $query)
{
	if($query != '')
	{
	  $mysqli->query($query); // Asumo un objeto conexión que ejecuta consultas
	}
}

$mysqli->close();
$conn->close();


?>
