<?php
    // Conexio a la bd
    require('conexion.php');
    $conn = new mysqli($servername,$username,$password,$dbname);
    $conn->set_charset("utf8");
    // En caso de falla muestro falla
    if (!$conn){
        die("Conexion fallida");
    } else {
        // Query
        $select = "SELECT * FROM mensajes ORDER BY id_mensaje DESC LIMIT 1";
        // Do query
        $querySelect = mysqli_query($conn,$select);
        // Result array
        $resultados = mysqli_fetch_row($querySelect);
        // Show result
        echo $resultados[1];
    }

?>