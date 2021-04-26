<?php
	session_name("fct");
	session_start();
	require_once("../../funciones/config.php");

	cabecera(2);
	menu_arriba_izq();

	$var1 = $_GET['var1'];
	$var2 = $_GET['var2'];
	$var3 = $_GET['var3'];
	echo "<form method='post' action='altaAnex.php?var1=&var2=&var3='>";
		echo "<div class='recuadros'>";

				echo "<input type='text' name='nConv' placeholder='Nº de convenio' required class='input_recuadro' value=$var1>"; 
				echo "<input type='button' name='btn_regis' onclick=\"location='buscarConv.php?var1=$var1&var2=$var2&var3=$var3'\" value='Buscar' class='btn_recuadro'>";
				echo "</br>";
				echo "<input type='text' name='DNI' placeholder='DNI' required class='input_recuadro' value='$var2'>";
				echo "<input type='button' name='btn_regis' onclick=\"location='buscarDNI.php?var1=$var1&var2=$var2&var3=$var3'\" value='Buscar' class='btn_recuadro'>";
				echo "</br>";
				echo "<input type='text' name='tutorCiclo' placeholder='Tutor ciclo' required class='input_recuadro' value='$var3'>";
				echo "<input type='button' name='btn_regis' onclick=\"location='buscarTutor.php?var1=$var1&var2=$var2&var3=$var3'\" value='Buscar' class='btn_recuadro'>";
				echo "</br>";
				echo "<input type='text' name='tutorEmp' placeholder='Tutor empresa' required class='input_recuadro'>";
				echo "</br>";
				echo "<input type='text' name='fechaIni' placeholder='Fecha inicio' required class='input_recuadro'>";
				echo "</br>";
				echo "<input type='text' name='fechaFin' placeholder='Fecha fin' required class='input_recuadro'>";
				echo "</br>";

					global $servername,$username, $password, $bbdd;
						$conn = mysqli_connect($servername, $username, $password, $bbdd);
					
						try{ 
							$temporal=mysqli_query($conn, "SELECT MAX(numero_anexo) FROM anexos");
							$result=mysqli_fetch_array($temporal);

							$anexo=$result['MAX(numero_anexo)']+1;

						}catch(PDOException $e){
							$result= $sql . "<br>" . $e->getMessage();
						}
						$conn = null;

				echo "</br></br>";
				echo "<input type='submit' name='btn_regis' value='Registrar' class='btn_recuadro'>" ;


	//Hay que hacer un control de errores
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nConv = test_input($_POST["nConv"]);
		$DNI = test_input($_POST["DNI"]);
		$tutorCiclo = test_input($_POST["tutorCiclo"]);
		$tutorEmp = test_input($_POST["tutorEmp"]);
		$fechaIni = test_input($_POST["fechaIni"]);
		$fechaFin = test_input($_POST["fechaFin"]);
		
		
		/*
		Para que en la fecha de matriculación salga por ejemplo: 2020/2021

		$fecha_mat = substr($fecha_mat, 0, 4);
		$num=intval($fecha_mat)+1;
		$fecha_mat=$fecha_mat."/".$num;

		*/

		insertarAnexo($nConv, $DNI, $tutorCiclo, $tutorEmp, $fechaIni, $fechaFin, $anexo);
	}


		echo "</div>";
	echo "</form>";
?>