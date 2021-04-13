<?php 
	//Variables básicas
	/*$servername = "130.61.202.129";
	$username = "FCT_user";
	$password = "FCT_database_2020";*/
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$bbdd="fct";

	$dbMotor="mysql";

	//Lo que vamos a llamar desde esta página
	require_once("funciones.php");//El config.php está en la misma carpeta que funciones.php (ruta actual-> ./)

	//La variable dbMotor, va a ser la que escoja entre una BBDD u otra(MySQL, QSLite...)
	if($dbMotor==="mysql"){
		require_once("funcionesMySQL.php");
	}else{
		echo "<p>Error en el motor de base de datos.</p>";
	}

?>