<?php
	session_name("fct");
	session_start();

	require_once("../../funciones/config.php");

	$opcion = intval($_GET['opcion']);
	$_SESSION["opcion"]=$opcion;
?>
			<form method="post" action="bajaAnexo.php">
				<div class="recuadros">
 <?php
	if($opcion==1){
		?>
					<input type="text" name="seleccion" placeholder="Nombre empresa" required class="input_recuadro">	
					</br></br>
					<input type="submit" name="btn_regis" value="Seleccionar empresa" class="btn_recuadro"> 
		<?php	
	}elseif($opcion==2){
		?>
					<input type="text" name="seleccion" placeholder="Número de convenio" required class="input_recuadro">	
					</br></br>
					<input type="submit" name="btn_regis" value="Seleccionar alumno" class="btn_recuadro"> 
		<?php
	}
?>
				</div>
			</form>

 <?php
 	pie(1);

 ?>