<?php
// FUNCION 1
function insertarUsuarios($user, $pass){
    global $servername,$username, $password, $bbdd;

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        $sql="SELECT COUNT(*) FROM `usuarios` WHERE `Usuario`= '$user'";
        $temporal=$conn->query($sql);
        $resultado=$temporal->fetchAll();

        if($resultado[0][0]==1){
            $resultado="Usuario ya registrado";
        }else{

          //  $sql1="INSERT INTO `usuarios` (`Usuario`, `Contraseña`, `admin`) VALUES ('$user','$pass','1')";
          $sql1="INSERT INTO `usuarios` (`Usuario`, `Contraseña`) VALUES ('$user','$pass')";
            $nuevoAdministrador=$conn->exec($sql1);
            $resultado="Nuevo usuario insertado correctamente";
        }
    }catch(PDOException $e){
        $resultado= $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
    return $resultado;
}

// FUNCION 2
function comprobarUsuario($user,$pass){
    global $servername,$username, $password, $bbdd;

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        $sql="SELECT COUNT(*) FROM `usuarios` WHERE `Usuario`= '$user'";
        $temporal=$conn->query($sql);
        $resultado=$temporal->fetchAll();

        if($resultado[0][0]==1){ //Porque sólo se va a tener un resultado [0][0]
            $sql="SELECT COUNT(*) FROM `usuarios` WHERE `Usuario`= '$user' AND `password`='$pass'";
            $temporal=$conn->query($sql);
            $resultado=$temporal->fetchAll();

            if($resultado[0][0]==1){ //Porque sólo se va a tener un resultado [0][0]
                $sql="SELECT `admin` FROM `usuarios` WHERE `Usuario`= '$user'";//No hace falta usar pass porque se llega aquí si todo el correcto
                $temporal=$conn->query($sql);
                $resultado=$temporal->fetchAll();
                $final=$resultado[0]["admin"];
            }elseif($resultado[0][0]==0){
                $final="Usuario correcto y contraseña incorrecta";
            }else{
                $final="Usuario y contraseña incorrectos";
            }
        }elseif($resultado[0][0]==0){
            $final="Usuario incorrecto";
        }else{
            $final="Usuario y contraseña incorrectos";
        }
    }catch(PDOException $e){
        $resultado= $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
    return $final;
}

// FUNCION 3
function insertarAlumnos ($nombre, $apellidos, $dni,$cod_ciclo,$fecha_mat){
    global $servername,$username, $password, $bbdd;

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        $sql="SELECT COUNT(*) FROM `ciclos` WHERE `codigo_ciclo`= '$cod_ciclo'";
        $temporal=$conn->query($sql);
        $resultado=$temporal->fetchAll();

        if($resultado[0][0]==0){
            $resultado="El código de ciclo no existe";
        }else{
            $sql="SELECT COUNT(*) FROM `alumnos` WHERE `DNI`= '$dni'";
            $temporal=$conn->query($sql);
            $resultado=$temporal->fetchAll();

            if($resultado[0][0]==1){
                $resultado="El alumno ya está registrado";
            }else{

                $sql="INSERT INTO `alumnos` (`DNI`, `nombre_alumno`, `apellidos_alumno`) VALUES ('$dni','$nombre','$apellidos')";
                $nuevoAlumno=$conn->exec($sql);
                $resultado="Nuevo alumno insertado correctamente";

                $sql="SELECT * FROM `ciclos` WHERE `codigo_ciclo`= '$cod_ciclo'";
                $temporal=$conn->query($sql);
                $resultado=$temporal->fetchAll();
                $Tutor_Ciclo=$resultado[0]["tutor_ciclo"];

                $sql="INSERT INTO `alumnos_ciclos` (`DNI`, `codigo_ciclo`, `fecha_matriculacion`,`tutor_ciclo`) VALUES ('$dni','$cod_ciclo','$fecha_mat','$Tutor_Ciclo')";
                $nuevoAlumnoCiclo=$conn->exec($sql);
                $resultado="Nuevo alumno insertado correctamente";
            }
        }
    }catch(PDOException $e){
        $resultado= $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
    return $resultado;
}


// FUNCION 4
function insertarEmp($nif,$nomEmp,$dir,$loc,$codPost,$telf,$tMovil,$correo,$fax,$persRep,$persCont){
    global $servername,$username, $password, $bbdd;

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="INSERT INTO `empresas` (`NIF`, `Nombre_empresa`, `Direccion`, `Localidad`, `Codigo_postal`, `Telefono`, `FAX`, `Movil`, `Email`, `Representante`,
			`Persona_contacto`) VALUES ('$nif','$nomEmp','$dir','$loc','$codPost','$telf','$fax','$tMovil','$correo','$persRep','$persCont')";
        $nuevaConv=$conn->exec($sql);
        $resultado="Nueva empresa insertada correctamente";

    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
    return $resultado;
}

// FUNCION 5
function insertarConvenio($nConv, $nif, $fecha_conv){
    global $servername,$username, $password, $bbdd;

    $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{
        $sql="INSERT INTO `convenios` (`numero_convenio`, `NIF`, `fecha_convenio`) VALUES ('$nConv', '$nif', '$fecha_conv')";
        $nuevoConv=$conn->exec($sql);
        $result="Nuevo convenio insertado correctamente";


    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
    return $result;
}


// FUNCION 6
function insertarCiclo($codCiclo, $tutorCiclo, $nomCiclo,$fam_form){
    global $servername,$username, $password, $bbdd;

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="INSERT INTO `ciclos`(`cod_ciclo`, `tutor_ciclo`, `nombre_ciclo`, `familia_formativa`) VALUES ('$codCiclo', '$tutorCiclo', '$nomCiclo','$fam_form')";
        $nuevaConv=$conn->exec($sql);

        $resultado="Nuevo ciclo insertado correctamente";

    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
    return $resultado;
}


// FUNCION 7
function datosEmpConv($empresa){
    global $servername,$username, $password, $bbdd;
    $conn = mysqli_connect($servername, $username, $password, $bbdd);

    try{
        $temporal=mysqli_query($conn, "SELECT `nombre_empresa`, empresas.`NIF`, `numero_convenio`, `fecha_convenio` FROM `empresas` , `convenios` WHERE empresas.NIF=convenios.NIF AND `nombre_empresa`= '$empresa'");
        $result=mysqli_fetch_array($temporal);
        $contador = mysqli_num_rows($temporal);
        if ($contador==0){
            echo "<p style=\"color: red; font-size: 20px;margin-left: 25%\">Esa empresa no tiene convenio.</p>";
        }
    }catch(PDOException $e){
        $result= $sql . "<br>" . $e->getMessage();
    }
    $conn = null;

    return $result;
}


// FUNCION 8
function datosAnexAlum2($alum){
    global $servername,$username, $password, $bbdd;
    $conn = mysqli_connect($servername, $username, $password, $bbdd);

    try{
        $temporal=mysqli_query($conn, "SELECT * FROM `alumnos` WHERE `nombre_alumno`='$alum'");
        $result=mysqli_fetch_array($temporal);
        $contador = mysqli_num_rows($temporal);
        if ($contador==0){
            echo "<p style=\"color: red; font-size: 20px;margin-left: 25%\">No hay ningun alumno con ese nombre</p>";
        }
    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;

    return $result;
}

// FUNCION 9
function datosAnexAlum($alum){
    global $servername,$username, $password, $bbdd;
    $conn = mysqli_connect($servername, $username, $password, $bbdd);

    try{
        $temporal=mysqli_query($conn, "SELECT *
FROM `alumnos`, `empresas`, `convenios`, `anexos`, `anexos_alumnos`
WHERE alumnos.nombre_alumno='$alum'
  AND empresas.NIF = convenios.NIF
  AND convenios.numero_convenio = anexos.numero_convenio
  AND anexos_alumnos.numero_anexo = anexos.numero_anexo
  AND anexos_alumnos.DNI = alumnos.DNI");
        $result=mysqli_fetch_array($temporal);
        $contador = mysqli_num_rows($temporal);
        if ($contador==0){
            echo "<p style=\"color: red; font-size: 20px;margin-left: 25%\">No hay ningun alumno con ese nombre</p>";
        }
    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;

    return $result;
}


// FUNCION 10
function insertarAnexo ($nConv, $DNI, $tutorCiclo, $tutorEmp, $fechaIni, $fechaFin, $nAnexo){
    global $servername,$username, $password, $bbdd;
    $fechaactual =  date("Y-m-d");
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="INSERT INTO `anexos`(`numero_convenio`, `numero_anexo`, `fecha_inicio`, `fecha_fin`, `tutor_ciclo`, `tutor_empresa`, `fecha_anexo`) 
					VALUES ('$nConv', '$nAnexo', '$fechaIni', '$fechaFin', '$tutorCiclo', '$tutorEmp', '$fechaactual')";
        $nuevaConv=$conn->exec($sql);
        $sql="INSERT INTO `anexos_alumnos`(`numero_convenio`, `numero_anexo`, `DNI`) VALUES  ('$nConv', '$nAnexo', '$DNI')";
        $nuevaConv=$conn->exec($sql);
        $resultado="Nuevo anexo insertado correctamente";

    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();

    }
    $conn = null;
    return $resultado;
}


// FUNCION 11
function buscarCiclo($ciclo){
    global $servername,$username, $password, $bbdd;
    $conn = mysqli_connect($servername, $username, $password, $bbdd);
    try{
        $temporal=mysqli_query($conn,"SELECT `tutor_ciclo`, `nombre_ciclo` FROM `ciclos` WHERE `nombre_ciclo`='$ciclo'");
        $result=mysqli_fetch_array($temporal);
        $contador = mysqli_num_rows($temporal);
        if ($contador==0){
            echo "<p style=\"color: red; font-size: 20px;margin-left:25%;\">No hay ningun CICLO con ese nombre</p>";
        }


    }catch(PDOException $e){
        $result= $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
    return $result;
}


// FUNCION 12
function tablaAnexo($nombre,$opcion){
    global $servername,$username, $password, $bbdd;

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        echo"<div class=\"recuadroBaja\">";
        if($opcion==1){
            $sql0="SELECT COUNT(*) FROM `empresas` WHERE `nombre_empresa`= '$nombre'";
            $temporal0=$conn->query($sql0);
            $resultado0=$temporal0->fetchAll();

            if($resultado0[0][0]==0){
                echo "<p class=\"p_baja\">Empresa no encontrada</p>";
            }else{
                $sql00="SELECT * FROM `empresas` WHERE `nombre_empresa`= '$nombre'";
                $temporal00=$conn->query($sql00);
                $resultado00=$temporal00->fetchAll();
                $NIF=$resultado00[0]["NIF"];


                $sql01="SELECT COUNT(*) FROM `convenios` WHERE `NIF`= '$NIF'";
                $temporal01=$conn->query($sql01);
                $resultado01=$temporal01->fetchAll();

                if($resultado01[0][0]==0){
                    echo "<p class=\"p_baja\">La empresa está dada de alta pero no tiene número de convenio</p>";
                }else{
                    echo "<table cellspacing=\"0\" class=\"tAjax\">
							<tr>
								<th> </th>
								<th>DNI</th>		
						 		<th>Nombre y Apellidos</th>		
								<th>Nombre empresa</th>		
								<th>Número de convenio</th>		
								<th>Tutor de ciclo</th>		
								<th>Tutor de empresa</th>		
								<th>Fecha inicio</th>		
								<th>Fecha fin&nbsp;&nbsp;&nbsp;&nbsp;</th>
							</tr>";
                    $sql="SELECT * FROM `empresas` WHERE `nombre_empresa`= '$nombre'";
                    $temporal=$conn->query($sql);
                    $resultado=$temporal->fetchAll();
                    $NIF=$resultado[0]["NIF"];

                    $sql2="SELECT * FROM `convenios` WHERE `NIF`= '$NIF'";
                    $temporal2=$conn->query($sql2);
                    $resultado2=$temporal2->fetchAll();
                    $Numero_Convenio=$resultado2[0]["numero_convenio"];

                    $sql31="SELECT COUNT(*) FROM `anexos` WHERE `numero_convenio`= '$Numero_Convenio'";
                    $temporal31=$conn->query($sql31);
                    $resultado31=$temporal31->fetchAll();

                    if($resultado31[0][0]==0){
                        echo "<p class=\"p_baja\">La empresa está dada de alta pero no tiene anexo asociado</p>";
                    }else{
                        $sql3="SELECT * FROM `anexos` WHERE `numero_convenio`= '$Numero_Convenio'";
                        $temporal3=$conn->query($sql3);
                        $resultado3=$temporal3->fetchAll();
                        for($x=0; $x<count($resultado3); $x++){
                            $Fecha_Inicio=$resultado3[$x]["fecha_inicio"];
                            $Fecha_Fin=$resultado3[$x]["fecha_fin"];
                            $Tutor_Empresa=$resultado3[$x]["tutor_empresa"];
                            $Tutor_Ciclo=$resultado3[$x]["tutor_ciclo"];
                            $Numero_Anexo=$resultado3[$x]["numero_anexo"];

                            $sql4="SELECT * FROM `anexos_alumnos` WHERE `numero_convenio`= '$Numero_Convenio' AND `numero_anexo`= '$Numero_Anexo'";
                            $temporal4=$conn->query($sql4);
                            $resultado4=$temporal4->fetchAll();
                            for($y=0; $y<count($resultado4); $y++){
                                $DNI=$resultado4[$y]["DNI"];

                                $sql5="SELECT * FROM `alumnos` WHERE `DNI`= '$DNI'";
                                $temporal5=$conn->query($sql5);
                                $resultado5=$temporal5->fetchAll();
                                for($z=0; $z<count($resultado5); $z++){
                                    $Nombre=$resultado5[$z]["nombre_alumno"];
                                    $Apellidos=$resultado5[$z]["apellidos_alumno"];

                                    //Para eliminar vamos a juntar las PK en un string con una /
                                    $PK=$Numero_Convenio."/".$Numero_Anexo;
                                    echo "<tr>";
                                    echo "<td><input class=\"\" type='radio' name='baja' value='".$PK."'/> </td>";
                                    echo "<td>".$DNI."</td>";
                                    echo "<td>".$Nombre." ".$Apellidos."</td>";
                                    echo "<td>".$nombre."</td>";
                                    echo "<td>".$Numero_Convenio."</td>";
                                    echo "<td>".$Tutor_Ciclo."</td>";
                                    echo "<td>".$Tutor_Empresa."</td>";
                                    echo "<td>".$Fecha_Inicio."</td>";
                                    echo "<td>".$Fecha_Fin."</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    }
                    echo "</table>";
                    echo "<input type=\"submit\" name=\"btn_baja\" value=\"Baja de anexo\" class=\"btn_recuadro_baja\">";
                }
            }
        }elseif($opcion==2){
            $sql0="SELECT COUNT(*) FROM `alumnos` WHERE `nombre_alumno`= '$nombre'";
            $temporal0=$conn->query($sql0);
            $resultado0=$temporal0->fetchAll();

            if($resultado0[0][0]==0){
                echo "<p class=\"p_baja\">Alumno no encontrado</p>";
            }else{
                echo "<table cellspacing=\"0\" class=\"tAjax\">
						<tr>
							<th> </th>
							<th>DNI</th>		
					 		<th>Nombre y Apellidos</th>		
							<th>Nombre empresa</th>		
							<th>Número de convenio</th>		
							<th>Tutor de ciclo</th>		
							<th>Tutor de empresa</th>		
							<th>Fecha inicio</th>		
							<th>Fecha fin&nbsp;&nbsp;&nbsp;&nbsp;</th>
						</tr>";
                $sql="SELECT * FROM `alumnos` WHERE `nombre_alumno`= '$nombre'";
                $temporal=$conn->query($sql);
                $resultado=$temporal->fetchAll();
                for($x=0; $x<count($resultado); $x++){
                    $DNI=$resultado[$x]["DNI"];
                    $Apellidos=$resultado[$x]["apellidos_alumno"];

                    $sql31="SELECT COUNT(*) FROM `anexos_alumnos` WHERE `DNI`= '$DNI'";
                    $temporal31=$conn->query($sql31);
                    $resultado31=$temporal31->fetchAll();

                    if($resultado31[0][0]==0){
                        echo "<p class=\"p_baja\">El alumno está dado de alta pero no tiene anexo asociado</p>";
                    }else{
                        $sql1="SELECT * FROM `anexos_alumnos` WHERE `DNI`= '$DNI'";
                        $temporal1=$conn->query($sql1);
                        $resultado1=$temporal1->fetchAll();
                        for($y=0; $y<count($resultado1); $y++){
                            $Numero_Convenio=$resultado1[$y]["numero_convenio"];
                            $Numero_Anexo=$resultado1[$y]["numero_anexo"];

                            $sql3="SELECT * FROM `anexos` WHERE `numero_convenio`= '$Numero_Convenio' AND `numero_anexo`= '$Numero_Anexo'";
                            $temporal3=$conn->query($sql3);
                            $resultado3=$temporal3->fetchAll();
                            $Fecha_Inicio=$resultado3[0]["fecha_inicio"];
                            $Fecha_Fin=$resultado3[0]["fecha_fin"];
                            $Tutor_Empresa=$resultado3[0]["tutor_empresa"];
                            $Tutor_Ciclo=$resultado3[0]["tutor_ciclo"];

                            $sql4="SELECT * FROM `convenios` WHERE `numero_convenio`= '$Numero_Convenio'";
                            $temporal4=$conn->query($sql4);
                            $resultado4=$temporal4->fetchAll();
                            $NIF=$resultado4[0]["NIF"];

                            $sql5="SELECT * FROM `empresas` WHERE `NIF`= '$NIF'";
                            $temporal5=$conn->query($sql5);
                            $resultado5=$temporal5->fetchAll();
                            $Nombre_Empresa=$resultado5[0]["nombre_empresa"];

                            //Para eliminar vamos a juntar las PK en un string con una /
                            $PK=$Numero_Convenio."/".$Numero_Anexo;
                            echo "<tr>";
                            echo "<td><input class=\"\" type='radio' name='baja' value='".$PK."'/> </td>";
                            echo "<td>".$DNI."</td>";
                            echo "<td>".$nombre." ".$Apellidos."</td>";
                            echo "<td>".$Nombre_Empresa."</td>";
                            echo "<td>".$Numero_Convenio."</td>";
                            echo "<td>".$Tutor_Ciclo."</td>";
                            echo "<td>".$Tutor_Empresa."</td>";
                            echo "<td>".$Fecha_Inicio."</td>";
                            echo "<td>".$Fecha_Fin."</td>";
                            echo "</tr>";
                        }
                    }
                }
                echo "</table>";
                echo "<input type=\"submit\" name=\"btn_baja\" value=\"Baja de anexo\" class=\"btn_recuadro_baja\">";
            }
        }


        echo "</div>";
    }catch(PDOException $e){
        $resultado= $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}
// FUNCION 13

function bajaAnexo($Numero_Convenio,$Numero_Anexo){
    global $servername,$username, $password, $bbdd;

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        $sql = "DELETE FROM `anexos_alumnos` WHERE `numero_convenio`=$Numero_Convenio AND `numero_anexo`=$Numero_Anexo";
        $conn->exec($sql);

        $sql = "DELETE FROM `anexos` WHERE `numero_convenio`=$Numero_Convenio AND `numero_anexo`=$Numero_Anexo";
        $conn->exec($sql);
        $resultado="Se ha dado de baja el anexo seleccionado";
    }catch(PDOException $e){
        $resultado= $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}


// FUNCION 14

function tablaConvenio($seleccion,$opcion){
    global $servername,$username, $password, $bbdd;

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        echo"<div class=\"recuadroBaja\">";
        if($opcion==1){
            $sql0="SELECT COUNT(*) FROM `empresas` WHERE `nombre_empresa`= '$seleccion'";
            $temporal0=$conn->query($sql0);
            $resultado0=$temporal0->fetchAll();

            if($resultado0[0][0]==0){
                echo "<p class=\"p_baja\">Empresa no encontrada</p>";
            }else{
                $sql="SELECT * FROM `empresas` WHERE `nombre_empresa`= '$seleccion'";
                $temporal=$conn->query($sql);
                $resultado=$temporal->fetchAll();
                $NIF=$resultado[0]["NIF"];

                $sql2="SELECT COUNT(*) FROM `convenios` WHERE `NIF`= '$NIF'";
                $temporal2=$conn->query($sql2);
                $resultado2=$temporal2->fetchAll();

                if($resultado2[0][0]==0){
                    echo "<p class=\"p_baja\">La empresa está dada de alta pero no tiene número de convenio</p>";
                }else{
                    echo "<table cellspacing=\"0\" class=\"tAjax\">
							<tr>
								<th> </th>
								<th>Nombre empresa</th>		
						 		<th>NIF</th>				
								<th>Número de convenio</th>
								<th>Número de anexo</th>
							</tr>";
                    $sql="SELECT * FROM `empresas` WHERE `nombre_empresa`= '$seleccion'";
                    $temporal=$conn->query($sql);
                    $resultado=$temporal->fetchAll();
                    $NIF=$resultado[0]["NIF"];

                    $sql2="SELECT * FROM `convenios` WHERE `NIF`= '$NIF'";
                    $temporal2=$conn->query($sql2);
                    $resultado2=$temporal2->fetchAll();
                    $Numero_Convenio=$resultado2[0]["numero_convenio"];

                    $sql31="SELECT COUNT(*) FROM `anexos` WHERE `numero_convenio`= '$Numero_Convenio'";
                    $temporal31=$conn->query($sql31);
                    $resultado31=$temporal31->fetchAll();

                    if($resultado31[0][0]==0){
                        echo "<tr>";
                        echo "<td><input class=\"\" type='radio' name='baja' value='".$Numero_Convenio."'/> </td>";
                        echo "<td>".$seleccion."</td>";
                        echo "<td>".$NIF."</td>";
                        echo "<td>".$Numero_Convenio."</td>";
                        echo "<td>-</td>";
                        echo "</tr>";
                        echo "<p class=\"p_baja\">La empresa está dada de alta pero no tiene anexo asociado</p>";
                    }else{
                        $sql3="SELECT * FROM `anexos` WHERE `numero_convenio`= '$Numero_Convenio'";
                        $temporal3=$conn->query($sql3);
                        $resultado3=$temporal3->fetchAll();
                        for($x=0; $x<count($resultado3); $x++){
                            $Numero_Anexo=$resultado3[$x]["numero_anexo"];

                            echo "<tr>";
                            echo "<td><input class=\"\" type='radio' name='baja' value='".$Numero_Convenio."'/> </td>";
                            echo "<td>".$seleccion."</td>";
                            echo "<td>".$NIF."</td>";
                            echo "<td>".$Numero_Convenio."</td>";
                            echo "<td>".$Numero_Anexo."</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                    echo "<input type=\"submit\" name=\"btn_baja\" value=\"Baja de convenio\" class=\"btn_recuadro_baja\">";
                }
            }
        }elseif($opcion==2){
            $sql0="SELECT COUNT(*) FROM `convenios` WHERE `numero_convenio`= '$seleccion'";
            $temporal0=$conn->query($sql0);
            $resultado0=$temporal0->fetchAll();

            if($resultado0[0][0]==0){
                echo "<p class=\"p_baja\">Número de convenio no encontrado</p>";
            }else{
                echo "<table cellspacing=\"0\" class=\"tAjax\">
						<tr>
							<th> </th>
							<th>Nombre empresa</th>		
					 		<th>NIF</th>				
							<th>Número de convenio</th>
							<th>Número de anexo</th>
						</tr>";
                $sql="SELECT * FROM `convenios` WHERE `numero_convenio`= '$seleccion'";
                $temporal=$conn->query($sql);
                $resultado=$temporal->fetchAll();
                $NIF=$resultado[0]["NIF"];

                $sql="SELECT * FROM `empresas` WHERE `NIF`= '$NIF'";
                $temporal=$conn->query($sql);
                $resultado=$temporal->fetchAll();
                $Nombre_Empresa=$resultado[0]["nombre_empresa"];

                $sql31="SELECT COUNT(*) FROM `anexos` WHERE `numero_convenio`= '$Numero_Convenio'";
                $temporal31=$conn->query($sql31);
                $resultado31=$temporal31->fetchAll();

                if($resultado31[0][0]==0){
                    echo "<tr>";
                    echo "<td><input class=\"\" type='radio' name='baja' value='".$Numero_Convenio."'/> </td>";
                    echo "<td>".$Nombre_Empresa."</td>";
                    echo "<td>".$NIF."</td>";
                    echo "<td>".$seleccion."</td>";
                    echo "<td>-</td>";
                    echo "</tr>";
                    echo "<p class=\"p_baja\">La empresa está dada de alta pero no tiene anexo asociado</p>";
                }else{
                    $sql="SELECT * FROM `anexos` WHERE `numero_convenio`= '$seleccion'";
                    $temporal=$conn->query($sql);
                    $resultado=$temporal->fetchAll();
                    for($x=0; $x<count($resultado); $x++){
                        $Numero_Anexo=$resultado[$x]["numero_anexo"];

                        echo "<tr>";
                        echo "<td><input class=\"\" type='radio' name='baja' value='".$seleccion."'/> </td>";
                        echo "<td>".$Nombre_Empresa."</td>";
                        echo "<td>".$NIF."</td>";
                        echo "<td>".$seleccion."</td>";
                        echo "<td>".$Numero_Anexo."</td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
                echo "<input type=\"submit\" name=\"btn_baja\" value=\"Baja de convenio\" class=\"btn_recuadro_baja\">";
            }
        }



        echo "</div>";
    }catch(PDOException $e){
        $resultado= $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}
// FUNCION 15
function bajaConvenio($Numero_Convenio){
    global $servername,$username, $password, $bbdd;

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$bbdd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        $sql0="SELECT * FROM `convenios` WHERE `numero_convenio`= '$Numero_Convenio'";
        $temporal0=$conn->query($sql0);
        $resultado0=$temporal0->fetchAll();
        $NIF=$resultado0[0]["NIF"];

        $sql = "DELETE FROM `anexos_alumnos` WHERE `numero_convenio`=$Numero_Convenio ";
        $conn->exec($sql);

        $sql = "DELETE FROM `anexos` WHERE `numero_convenio`=$Numero_Convenio ";
        $conn->exec($sql);

        $sql = "DELETE FROM `convenios` WHERE `numero_convenio`=$Numero_Convenio";
        $conn->exec($sql);

        $sql = "DELETE FROM `empresas` WHERE `NIF`='$NIF'";
        $conn->exec($sql);

        $resultado="Se ha dado de baja el convenio seleccionado";
    }catch(PDOException $e){
        $resultado= $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
    return $resultado;
}

?>