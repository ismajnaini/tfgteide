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
				<option value="2">Número de convenio</option>
		</select></span>
		<br></br>

		<div id="opcion"></div>


	<?php
		pie(1);

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST["btn_regis"])){
				$seleccion = test_input($_POST["seleccion"]);
				$opcion=$_SESSION["opcion"];
				$_SESSION["seleccion"]=$seleccion;

				tablaConvenio($seleccion,$opcion);
			}elseif (isset($_POST["btn_baja"])) {
				$Numero_Convenio = test_input($_POST["baja"]);

				bajaConvenio($Numero_Convenio);			
			}
		}
	?>
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

</form>