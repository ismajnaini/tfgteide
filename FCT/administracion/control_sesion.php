<?php
	session_name("fct");
	session_start();
	require_once("../funciones/config.php");

	if(isset($_SESSION["admin"])){
		//En caso de que la sesión esté iniciada
		//Destruimos la sessión, y que nos lleve al formulario, esto es en caso de que se entre en eta página de forma maliciosa
		session_destroy();
		$error="Vuelve a iniciar sesión";
		header("location:PpalLoginRegistro/login.php?estadito=$error"); //Nos lleva al login, y nos saca un mensaje de error por la URL

	}else{
		//Ver si el método post está iniciado, para coger las variables y hacer el logueo
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn_ini_ses"])) {
			//En este caso venimos del logueo bien hecho
			echo "Todo bien";
			//Recogemos las dos variables que  nos interesa que viene del formulario
			$user=test_input($_POST["nombre"]);
			$pass=test_input($_POST["contra"]);
			$resultado=comprobarUsuario($user,$pass);
			if($resultado==1){
				$_SESSION["admin"]=TRUE;			
				header("location:PpalLoginRegistro/login.php");
			}elseif($resultado==0){
				header("location:PpalLoginRegistro/login.php?estado=No eres administrador");
			}else{
				header("location:PpalLoginRegistro/login.php?estado=$resultado");
			}
		}else{
			$error="ERROR, no hagas eso!!!";
			session_destroy(); //Siempre por si acaso
			header("location:../?estado=$error"); //Volvemos al index de toda la aplicación el primero de todos
		}
	}
?>