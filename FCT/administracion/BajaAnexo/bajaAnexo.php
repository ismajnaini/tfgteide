<?php
	session_name("fct");
	session_start();
	require_once("../../funciones/config.php");

	cabecera(2);
	menu_arriba_izq();
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<span  class="centrarSel">&#128269;<select name="opcion_busqueda" onchange="verOpciones(this.value)">
				<option value="0">Tipo de búsqueda</option>
				<option value="1">Empresas</option>
				<option value="2">Alumnos</option>
		</select></span>
		<br></br>

		<div id="opcion"></div>


	<?php
		pie(1);

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST["btn_regis"])){
				$nombre = test_input($_POST["nombre"]);
				$opcion=$_SESSION["opcion"];
				$_SESSION["nombre"]=$nombre;

				tablaAnexo($nombre,$opcion);
			}elseif (isset($_POST["btn_baja"])) {
				$PK = test_input($_POST["baja"]);

				//Sacamos lo que hay entre los "/" se convierte en un array
				$partesPK=explode("/",$PK);

				//Recorremos el array $partesPK			
				$Numero_Convenio =$partesPK[0];
				$Numero_Anexo =$partesPK[1];

				bajaAnexo($Numero_Convenio,$Numero_Anexo);
				tablaAnexo($_SESSION["nombre"],$_SESSION["opcion"]);				
			}
		}
	?>
	<!--/div-->
</form>
<script>
	function verOpciones(opcion) {
		if (opcion=="") {
		    document.getElementById("opcion").innerHTML="";
		    return;
		}else{
			if (window.XMLHttpRequest) {
			    // code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp=new XMLHttpRequest();
			}else{ // code for IE6, IE5
			    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			//En cuanto se cambie el estado se ejecuta esta función
			xmlhttp.onreadystatechange=function() {
			    if (this.readyState==4 && this.status==200) {
			        document.getElementById("opcion").innerHTML=this.responseText;
			    }else{
			    	document.getElementById("opcion").innerHTML=this.responseText;
			    }	
			}
			 xmlhttp.open("GET","verOpcionAJAX.php?opcion="+opcion,true);
			 xmlhttp.send();
		}
	}
</script>


