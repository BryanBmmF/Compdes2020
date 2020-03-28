
<?php

	/* Conexion a Base de Datos*/
	/* Credenciales */
	$Server = "localhost";
	$User = "root";
	$Password = "bryan1234";
	$Schema = "BD_COMPDES_4_V3";

	
	/*
		Conexion a partir del Objeto PDO de php
	*/

	try {
		$dsn = "mysql:host=$Server;dbname=$Schema";
		$conexion = new PDO($dsn, $User, $Password);
		$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	} catch (PDOException $e){
		//echo $e->getMessage();
		echo "<script>alert('No se Completo la solicitud por fallos de conexión...'); </script>";
		header("Refresh: 1; url=index.php");
	}
	
	
?>