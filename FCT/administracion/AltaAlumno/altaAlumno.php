<?php
	session_name("fct");
	session_start();
	require_once("../../funciones/config.php");

	cabecera(2);
	menu_arriba_izq();
	$insertarUsu="";
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<div class="recuadros">
		<input type="text" name="nombre" placeholder="Nombre" required class="input_recuadro">	
		</br>	
		<input type="text" name="apellidos" placeholder="Apellidos" required class="input_recuadro">
		</br>	
		<input type="text" name="dni" placeholder="DNI" required class="input_recuadro" pattern="[0-9]{8}[A-Z]{1}">
		</br>
		<input type="text" name="cod_ciclo" placeholder="Código de ciclo" required class="input_recuadro">
		</br>
		<input type="date" name="fecha_mat" placeholder="Fecha matriculación" required class="input_recuadro">
		</br></br>
		<input type="submit" name="btn_regis" value="Registrar" class="btn_recuadro"> 
<?php

	//Hay que hacer un control de errores
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nombre = test_input($_POST["nombre"]);
		$apellidos = test_input($_POST["apellidos"]);
		$dni = test_input($_POST["dni"]);
		$cod_ciclo = test_input($_POST["cod_ciclo"]);
		$fecha_mat = test_input($_POST["fecha_mat"]);
		
		//Para que en la fecha de matriculación salga por ejemplo: 2020/2021
		$fecha_mat = substr($fecha_mat, 0, 4);
		$num=intval($fecha_mat)+1;
		$fecha_mat=$fecha_mat."/".$num;

		$insertarUsu=insertarAlumnos ($nombre, $apellidos, $dni,$cod_ciclo,$fecha_mat);
	}
?>
	<p class="p_baja"><?php echo $insertarUsu;?></p>

	</div>
</form>

<?php
	pie(1);
?>