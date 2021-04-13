<?php
	session_name("fct");
	session_start();
	require_once("../../funciones/config.php");

	cabecera(2);
	menu_arriba_izq();
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<div class="recuadros">
		<input type="text" name="nif" placeholder="NIF" required class="input_recuadro">	
		</br>	
		<input type="text" name="nomEmp" placeholder="Nombre de la empresa" required class="input_recuadro">
		</br>	
		<input type="text" name="dir" placeholder="Dirección" required class="input_recuadro">
		</br>
		<input type="text" name="loc" placeholder="Localidad" required class="input_recuadro">
		</br>
		<input type="number" name="codPost" placeholder="Código postal" required class="input_recuadro">
		</br>
		<input type="tel" name="telf" placeholder="Número de telefono" required class="input_recuadro">
		</br>
		<input type="tel" name="tMovil" placeholder="Número de telefono móvil" required class="input_recuadro">
		</br>
		<input type="email" name="correo" placeholder="Dirección de correo electrónico" required class="input_recuadro">
		</br>
		<input type="tel" name="fax" placeholder="Número de fax" required class="input_recuadro">
		</br>
		<input type="text" name="persRep" placeholder="Nombre del representante" required class="input_recuadro">
		</br>
		<input type="text" name="persCont" placeholder="Persona de contacto" required class="input_recuadro">
		</br></br>
		<input type="submit" name="btn_regis" value="Registrar" class="btn_recuadro"> 

		<?php
			//Hay que hacer un control de errores
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$nif = test_input($_POST["nif"]);
				$nomEmp = test_input($_POST["nomEmp"]);
				$dir = test_input($_POST["dir"]);
				$loc = test_input($_POST["loc"]);
				$codPost = test_input($_POST["codPost"]);
				$telf = test_input($_POST["telf"]);
				$tMovil = test_input($_POST["tMovil"]);
				$correo = test_input($_POST["correo"]);
				$fax = test_input($_POST["fax"]);
				$persRep = test_input($_POST["persRep"]);
				$persCont = test_input($_POST["persCont"]);

				$insertarEmp=insertarEmp($nif,$nomEmp,$dir,$loc,$codPost,$telf,$tMovil,$correo,$fax,$persRep,$persCont);
			}
		?>
	</div>
</form>

<?php
	//pie(2);
?>