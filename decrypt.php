<?php

    require('conexion.php');
    $conn = new mysqli($servername,$username,$password,$dbname);
    $conn->set_charset("utf8");
    if (!$conn){
        die("Conexion fallida");
    } else {
        $select = "SELECT * FROM mensajes ORDER BY id_mensaje DESC LIMIT 1";
        $querySelect = mysqli_query($conn,$select);
        $resultados = mysqli_fetch_row($querySelect);

        echo $resultados[1];
    }

?>