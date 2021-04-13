<?php
	session_name("fct");
	session_start();
	require_once("../../funciones/config.php");

	//Si está iniciada la sesión, para ver si el usuario que está registrado es usuario
	if(isset($_SESSION["admin"])){
		cabecera(2);
		//Para que aparezca el menú de la izq
        menu_arriba_izq();
        //Tabla Empresa-Convenio
        mostrarEmpConvAnex();
?>

  
<?php

	//En el caso de que no esté iniciada la sesión
	}else{
		cabecera(1);
?>

		<form method="post" action="../../../../Downloads/Proyecto/administracion/control_sesion.php">
			<div class="recuadros">
				<input type="text" name="nombre" placeholder="Nombre" required class="input_recuadro">	
				</br>	
				<input type="password" name="contra" placeholder="Contraseña" required class="input_recuadro">
				</br></br>
				<input type="submit" name="btn_ini_ses" value="Iniciar Sesión" class="btn_recuadro"> 
			</div>
		</form>

<?php

	} //Corchete del "else"
	pie(1);
?>