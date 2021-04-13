<?php

    $servername = "130.61.202.129";
    $username = "FCT_user";
    $password = "FCT_database_2020";
    $bbdd = "API";
    $usuario = $_GET['username'];
    $puntos = $_GET['puntuacion'];

    $conn = new mysqli($servername, $username, $password, $bbdd);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO `leaderboard` (`username`, `points`, `mod_juego`) VALUES ('$usuario','$puntos','0')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
