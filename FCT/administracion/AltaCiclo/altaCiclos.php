<?php
    session_name("fct");
    session_start();
    require_once("../../funciones/config.php");

    cabecera(2);
    menu_arriba_izq();
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <div class="recuadros">
        <input type="text" name="codCiclo" placeholder="Código del ciclo" required class="input_recuadro">
        </br>
        <input type="text" name="tutorCiclo" placeholder="Tutor del ciclo" required class="input_recuadro">
        </br>
        <input type="text" name="nomCiclo" placeholder="Nombre del ciclo" required class="input_recuadro">
        </br>
        <input type="text" name="fam_form" placeholder="Familia formativa" required class="input_recuadro">
        </br>
        </br></br>
        <input type="submit" name="btn_regis" value="Registrar" class="btn_recuadro"> 
<?php

    //Hay que hacer un control de errores
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $codCiclo = test_input($_POST["codCiclo"]);
        $tutorCiclo = test_input($_POST["tutorCiclo"]);
        $nomCiclo = test_input($_POST["nomCiclo"]);
        $fam_form = test_input($_POST["fam_form"]);

        $insertarCiclo=insertarCiclo ($codCiclo, $tutorCiclo, $nomCiclo, $fam_form);
    }
?>


    </div>
</form>

<?php
    //pie(2);
?>