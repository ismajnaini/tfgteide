<?php
	session_name("fct");
	session_start();
	require_once("../../funciones/config.php");
	cabecera(1);

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<div class="recuadros">
		<input type="text" name="nombre" placeholder="Nombre" required class="input_recuadro">	
		</br>	
		<input type="password" name="contra1" placeholder="Contraseña" required class="input_recuadro">
		</br>	
		<input type="password" name="contra2" placeholder="Repita contraseña" required class="input_recuadro">
		</br></br>
		<input type="submit" name="btn_regis" value="Registrar" class="btn_recuadro"> 

<?php

	//Hay que hacer un control de errores
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nombre = test_input($_POST["nombre"]);
		$contra1 = test_input($_POST["contra1"]);
		$contra2 = test_input($_POST["contra2"]);
		if($contra1==$contra2){
			$insertarUsu=insertarUsuarios ($nombre, $contra1);
			echo "<p class=\"centrar\">$insertarUsu</p>";
		}else{
?>
			<p class="centrar">Las contraseñas no coinciden.</p>
<?php
			$contra1="";
			$contra2="";
		}
		
	}
?>
	</div>
</form>

<?php
	pie(1);
?>