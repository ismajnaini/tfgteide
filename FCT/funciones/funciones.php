<?php

/////////////////////////////////////////////CABECERA-PIE-LIMPIEZA DATOS///////////////////////////////////////


//1.Crear cabecera 
function cabecera($pagina){
    echo "<!DOCTYPE HTML>\n";
    echo "<html>\n";
    echo "<head>\n";
    echo "<title>TEIDE. Centros de formación.</title>\n";
    echo "<meta charset=\"utf-8\">\n";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    echo "<link rel=\"stylesheet\" href=\"../../css/estilos1.css\" type=\"text/css\" media=\"screen\">\n";
    echo "<link rel=\"shortcut icon\" href=\"../../img/icononav.ico\" />\n";
    echo "</head>\n";
    echo "<body>\n";
    echo "<header>\n";

    if ($pagina==1){ //La cabecera acceder y login
        echo "<img src=\"../../img/teide_grande.jpg\" class=\"logo\" onclick=\"location='vent_ppal.php'\">\n";
        echo "<input type=\"button\" class=\"btn_vent_ppal btn_img_vent_ppal\" onclick=\"location='registro.php'\" name=\"registrarse\" value=\"Registrarse\">\n";//-
        echo "<img src=\"../../img/registrarse.png\" class=\"btn_img_vent_ppal\" onclick=\"location='registro.php'\">\n";//-
        echo "<input type=\"button\" class=\"btn_vent_ppal btn_img_vent_ppal\" onclick=\"location='login.php'\" name=\"acceder\" value=\"Acceder\">\n";
        echo "<img src=\"../../img/acceder.png\" class=\"btn_img_vent_ppal\" onclick=\"location='login.php'\">\n";
    }elseif ($pagina==2){ //La cabecera cuando hemos iniciado la sesión
        echo "<img src=\"../../img/teide_grande.jpg\" class=\"logo\" onclick=\"location='../../index.php'\">\n";
        echo "<form  method=\"post\" action=\"login.php\">\n";
        echo "<nav>";
        echo"<ul>";
        echo "<li class=\"color_fondo btn_administrador btn_img_vent_ppal ancho\">Administración\n";
        echo "<ul><li><a href=\"../AltaAlumno/altaAlumno.php\">Alta alumno</a></li>";
        echo"<li><a href=\"../AltaEmpresa/altaEmpresa.php\">Alta empresa</a></li>";
        echo"<li><a href=\"../AltaConvenio/altaConv.php\">Alta convenio</a></li>";
        echo"<li><a href=\"../AltaCiclo/altaCiclos.php\">Alta ciclo</a></li>";
        echo"<li><a href=\"../AltaAnexo/altaAnex.php?var1=&var2=&var3=\">Creación anexo</a></li>";
        echo"<li><a href=\"../BajaAnexo/bajaAnexo.php\">Baja anexo</a></li>";
        echo"<li><a href=\"../BajaConvenio/bajaConvenio.php\">Baja convenio</a></li>";
        echo"<li><a href=\"../control_sesion.php\">Cerrar Sesión</a></li><ul>";
        echo"</li>";
        echo"</ul>";
        echo"</nav>";
        echo "</form>\n";
    }

    echo "</header>\n";
//    echo "<section>\n";
}


//2.Función que cierra las diferentes ventanas
function pie($pagina){
    //   echo "</section>\n";
    echo "<footer>\n";
    if ($pagina==1){

    }

    echo "</footer>\n";
    echo "</body>\n";
    echo "</html>\n";
}

//3.Función para limpiar lo que se meta en el formulario
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//4.Función intermedia con los botones de arriba a la izquierda
function menu_arriba_izq(){
    echo "<aside>\n";
    echo "<button class=\"btn_menu_izq\" onclick=\"location='../../index.php'\">Página principal</button>\n";
    echo "<button class=\"btn_menu_izq\" onclick=\"location='../Tablas/tablaEmpConv.php'\">Empresas y convenios</button>\n";
    echo "<button class=\"btn_menu_izq\" onclick=\"location='../Tablas/tablaAnexAlum.php'\">Anexos y alumnos</button>\n";
    echo "</aside>\n";
}

//5. Funcion para printar la tabla de Empresas / Convenios
function mostrarEmpConv(){
    echo "<form action=\"../Tablas/tablaEmpConv.php\" method=\"post\">";
    echo "<span class=\"centrarSel\">";
    echo "<input class=\"input_empConv\" name=\"empresa\" placeholder=\"Nombre de la empresa\" type=\"text\">";
    echo "<button class=\"btn_empConv\" onclick=\"location='../Tablas/tablaEmpConv.php'\">Seleccionar empresa</button>\n";
    echo "</span>";
    echo "</form>";
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['empresa'])){
        $emp= $_REQUEST['empresa'];
        echo "<table style=\"border-collapse: collapse; background-color:#F6F6F6;margin-left: auto;margin-right: auto;margin-top:100px \">";
        echo "<tr>";
        echo "<th style=\"border: 1px solid black\">Nombre empresa</th>";
        echo "<th style=\"border: 1px solid black\">NIF</th>";
        echo "<th style=\"border: 1px solid black\">Nº de convenio</th>";
        echo "<th style=\"border: 1px solid black\">Fecha del convenio</th>";
        echo "</tr>";

        $row = datosEmpConv($emp);
        echo "<tr>";
        echo "<td style=\"border: 1px solid black\">" . $row['nombre_empresa'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['NIF'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['numero_convenio'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['fecha_convenio'] . "</td>";
        echo "</tr>";
    }

    echo '</table>';

}

//6. Funcion para printar la tabla de Empresas / Convenios
function mostrarAnexAlum(){
    echo "<form action=\"../Tablas/tablaAnexAlum.php\" method=\"post\">";
    echo "<span class=\"centrarSel\">";
    echo "<input class=\"input_empConv\" name=\"alumno\" placeholder=\"Nombre del alumno\" type=\"text\">";
    echo "<button class=\"btn_empConv\" onclick=\"location='../Tablas/tablaAnexAlum.php'\">Seleccionar alumno</button>\n";
    echo "</span>";
    echo "</form>";
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['alumno'])){
        $emp= $_REQUEST['alumno'];
        echo "<table style=\"border-collapse: collapse; background-color:#F6F6F6;margin-left: auto;margin-right: auto;margin-top:100px \">";
        echo "<tr>";
        echo "<th style=\"border: 1px solid black\">DNI</th>";
        echo "<th style=\"border: 1px solid black\">Nombre y apellidos</th>";
        echo "<th style=\"border: 1px solid black\">Nombre empresa</th>";
        echo "<th style=\"border: 1px solid black\">Nº anexo</th>";
        echo "<th style=\"border: 1px solid black\">Nº convenio</th>";
        echo "<th style=\"border: 1px solid black\">Tutor ciclo</th>";
        echo "<th style=\"border: 1px solid black\">Tutor empresa</th>";
        echo "<th style=\"border: 1px solid black\">Fecha incio</th>";
        echo "<th style=\"border: 1px solid black\">Fecha fin</th>";
        echo "</tr>";

        $row = datosAnexAlum($emp);
        echo "<tr>";
        echo "<td style=\"border: 1px solid black\">" . $row['DNI'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['nombre_alumno'] ." ". $row['apellidos_alumno'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['nombre_empresa'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['numero_anexo'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['numero_convenio'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['tutor_ciclo'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['tutor_empresa'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['fecha_inicio'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['fecha_fin'] . "</td>";
        echo "</tr>";
    }

    echo '</table>';

}

//7. Funcion para buscar Empresas / Convenios
function mostrarEmpConvAnex(){
    $var1 = $_GET["var1"];
    $var2 = $_GET["var2"];
    $var3 = $_GET["var3"];
    echo "<form action=\"buscarConv.php?var1=$var1&var2=$var2&var3=$var3\" method=\"post\">";
    echo "<span class=\"centrarSel\">";
    echo "&#128269;<input class=\"input_empConv\" name=\"empresa\" placeholder=\"Nombre de la empresa\" type=\"text\">";
    echo "<button class=\"btn_empConv\" onclick=\"location='buscarConv.php'\">Buscar empresa</button>";
    echo "</span>";
    echo "</br>";
    echo "</form>";
    
    echo "<table style=\"border-collapse: collapse; background-color:#F6F6F6;margin-left: auto;margin-right: auto;margin-top: 100px \">";
    echo "<tr>";
    echo "<th style=\"border: 1px solid black\"></th>";
    echo "<th style=\"border: 1px solid black\">Nombre empresa</th>";
    echo "<th style=\"border: 1px solid black\">Nº de convenio</th>";
    echo "</tr>";

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['empresa'])){
        $emp= $_REQUEST['empresa'];

        $row = datosEmpConv($emp);

        echo "<tr>";
        echo "<td style=\"border: 1px solid black\">" . "<input type=\"radio\" name=\"box\" checked>" . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['nombre_empresa'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['numero_convenio'] . "</td>";
        echo "</tr>";

        $var1 =  $row['numero_convenio'];
        echo "<button class=\"btn_empConv\" onclick=\"location='altaAnex.php?var1=" . $var1 . "&var2=" . $var2 . "&var3=" . $var3 . "'\"style=\"
    margin-left: 35%;
    margin-right: auto;
margin-top: 5%;\">Seleccionar empresa</button>";
     // $var1-=1;
    }
}while($row>0);

    echo '</table>';


}

//8. Funcion para buscar Alumno - DNI
function mostrarAlumnoDni(){
    $var1 = $_GET["var1"];
    $var2 = $_GET["var2"];
    $var3 = $_GET["var3"];
    echo "<form action=\"buscarDNI.php?var1=$var1&var2=$var2&var3=$var3\" method=\"post\">";
    echo "<span class=\"centrarSel\">";
    echo "&#128269;<input class=\"input_empConv\" name=\"alumnos\" placeholder=\"Nombre del alumno\" type=\"text\">";
    echo "<button class=\"btn_empConv\" onclick=\"location='buscarDNI.php'\">Buscar alumno</button>\n";
    echo "</span>";
    echo "</br>";
    echo "</form>";
  
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['alumnos'])){
        $emp= $_REQUEST['alumnos'];
        echo "<table style=\"border-collapse: collapse; background-color:#F6F6F6;margin-left: auto;margin-right: auto;margin-top: 100px  \">";
        echo "<tr>";
        echo "<th style=\"border: 1px solid black\"></th>";
        echo "<th style=\"border: 1px solid black\">Nombre y apellidos</th>";
        echo "<th style=\"border: 1px solid black\">DNI</th>";
        echo "</tr>";

        $row = datosAnexAlum2($emp);
        echo "<tr>";
        echo "<td style=\"border: 1px solid black\">" . "<input type=\"radio\" name=\"box\" checked>" . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['nombre_alumno'] ." ". $row['apellidos_alumno'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['DNI'] . "</td>";
        echo "</tr>";

        $var2 = $row['DNI'];
        echo "<button class=\"btn_empConv\" onclick=\"location='altaAnex.php?var1=" . $var1 . "&var2=" . $var2 . "&var3=" . $var3 . "'\"style=\"
    margin-left: 35%;
    margin-right: auto;
margin-top: 5%;\">Seleccionar alumno</button>";
    }


    echo '</table>';



}

//9. Funcion para buscar Ciclo - tutor
function mostrarCicloTutor(){
    $var1 = $_GET["var1"];
    $var2 = $_GET["var2"];
    $var3 = $_GET["var3"];
    echo "<form action=\"buscarTutor.php?var1=$var1&var2=$var2&var3=$var3\" method=\"post\">";
    echo "<span class=\"centrarSel\">";
    echo "&#128269;<input class=\"input_empConv\" name=\"ciclos\" placeholder=\"Nombre del ciclo\" type=\"text\">";
    echo "<button class=\"btn_empConv\" onclick=\"location='buscarTutor.php'\">Buscar ciclo</button>";
    echo "</span>";
    echo "</br>";
    echo "</form>";
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['ciclos'])){
        $emp= $_REQUEST['ciclos'];
        echo "<table style=\"border-collapse: collapse; background-color:#F6F6F6;margin-left: auto;margin-right: auto;margin-top: 100px  \">";
        echo "<tr>";
        echo "<th style=\"border: 1px solid black\"></th>";
        echo "<th style=\"border: 1px solid black\">Nombre del ciclo</th>";
        echo "<th style=\"border: 1px solid black\">Tutor de ciclo</th>";
        echo "</tr>";

        $row = buscarCiclo($emp);
        echo "<tr>";
        echo "<td style=\"border: 1px solid black\">" . "<input type=\"radio\" name=\"box\" checked>" . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['nombre_ciclo'] . "</td>";
        echo "<td style=\"border: 1px solid black\">" . $row['tutor_ciclo'] . "</td>";
        echo "</tr>";

        $var3 = $row['tutor_ciclo'];
        //if(isset($_POST['checked'])){

        echo "<button class=\"btn_empConv\" onclick=\"location='altaAnex.php?var1=" . $var1 . "&var2=" . $var2 . "&var3=" . $var3 . "'\"style=\"
    margin-left: 35%;
    margin-right: auto;
margin-top: 5%;
\">Seleccionar tutor</button>";
        //}

    }

    echo '</table>';
}


?>