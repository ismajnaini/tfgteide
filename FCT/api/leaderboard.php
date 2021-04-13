<?php

    $servername = "130.61.202.129";
    $username = "FCT_user";
    $password = "FCT_database_2020";
    $bbdd = "API";

    $conn = new mysqli($servername, $username, $password, $bbdd);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM leaderboard ORDER BY points DESC LIMIT 10";  //edit your table name here
    $res = $conn->query($sql);
    echo "<table><tr><th>Usuario</th><th>Puntuación</th></tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["username"]."</td><td>".$row["points"]."</td></tr>";
}
echo "</table>";
