<?php
	session_name("fct");
	session_start();
	require_once("../../funciones/config.php");
	cabecera(2);
	menu_arriba_izq();
?>

<form method="post" action="altaConv.php"> 
	<div class="recuadros" style="text-align: center;">
		<label for="empresas">Nombre de la empresa:</label>
			<select name="nif" style="text-align: center;">
				<option selected="true" disabled value="">Listado de empresas sin convenio</option>
				<?php
					global $servername,$username, $password, $bbdd;
					$conn = mysqli_connect($servername, $username, $password, $bbdd);
					try{ 	
						$temporal=mysqli_query($conn,"SELECT `nombre_empresa` FROM `empresas` WHERE `NIF` not in (SELECT `NIF` from `convenios`)");
						while($row = mysqli_fetch_array($temporal)){
							echo "<option>". $row['nombre_empresa'] ."</option>";
						}
					}catch(PDOException $e){
						$result= $sql . "<br>" . $e->getMessage();
					}
					$conn = null;
					
				?>
			</select>
		<input type="submit" name="btn_add" value="Add" class="btn_recuadro"> 

	<?php
		global $variablenormal;
		$variablesupernormal = 0;
			if (isset($_POST['btn_add'])) {
				$nEmpresa=$_POST['nif'];
				global $servername,$username, $password, $bbdd;
				
				$conn = mysqli_connect($servername, $username, $password, $bbdd);
				try{ 
					$temporal=mysqli_query($conn, "SELECT `NIF` FROM `empresas` WHERE `Nombre_empresa`='$nEmpresa' and `NIF` not in (SELECT `NIF` from `convenios`)");
					$resultNif=mysqli_fetch_array($temporal);
					$variablenormal = $resultNif['NIF'];
					$variablesupernormal = 1;
				}catch(PDOException $e){
					$result= $sql . "<br>" . $e->getMessage();
				}

				$conn = null;
			}

echo "</form>";

echo "<form method='post' action='altaConv.php'>";

			$conn = mysqli_connect($servername, $username, $password, $bbdd);		
			try{ 
				$temporal=mysqli_query($conn, "SELECT MAX(numero_convenio) FROM `convenios`");
				$result=mysqli_fetch_array($temporal);

				$nConvenio=$result['MAX(numero_convenio)']+1;
				echo "<input type='number' name='nConv' value='$nConvenio' required class='input_recuadro'>";
			}catch(PDOException $e){
				$result= $sql . "<br>" . $e->getMessage();
			}
			$conn = null;
		
			echo "</br>";
			echo "<input type='text' name='nif' placeholder='NIF' value='$variablenormal' required class='input_recuadro'>";
			echo "</br>";
			echo "<input type=\"date\" name=\"fecha_conv\" placeholder=\"Fecha del convenio\" required class=\"input_recuadro\">";
			echo "</br></br>";
			echo "<input type=\"submit\" name='btn_regis' value=\"Registrar\" class=\"btn_recuadro\">";
		
			//Hay que hacer un control de errores
			if (isset($_POST['btn_regis'])) {
				
				$fecha_conv = test_input($_POST["fecha_conv"]);
				$nif = test_input($_POST["nif"]);
				

				insertarConvenio($nConvenio, $nif, $fecha_conv);
			}
	?>

	</div>
</form>

<?php
	//pie(2);
?>