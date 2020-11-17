<?php

    // Realizo conexion a la bd
    require('conexion.php');
    $conn = new mysqli($servername,$username,$password,$dbname);
    $conn->set_charset("utf8");
    // Si no se conecta muestra fallo sino continua
    if (!$conn){
        die("Conexion fallida");
    } else {
        // Traigo datos por post mensaje y accion del switch
        $mensaje = $_POST['mensaje'];
        $action = ($_POST['encdec']=='D') ? true : false;

        // Si el switch está activo entra en true y decodifica, sino codifica
        if($action){
            // Traigo el campo de clave
            $clave = $_POST['clave'];  
            // Query 
            $decrypt = "SELECT id_mensaje, aes_decrypt(unhex(mensaje),'$clave') FROM mensajes ORDER BY id_mensaje DESC LIMIT 1";
            // Se hace la query
            $queryDecrypt = mysqli_query($conn,$decrypt);
            // Obtengo el resultado de la query en array con indices
            $deResultados = mysqli_fetch_row($queryDecrypt);
            // Muestro resultados
            echo '
                    <h6><b>Mensaje desencriptado:</b></h6>
                    <p>Mensaje: '.$deResultados[1].'</p>
                    
                ';
        }else{
            // Traigo los campos primo1 y primo2 y realizo el producto
            $clave = $_POST['primo1'] * $_POST['primo2'];
            // Query insert
            $insert = "INSERT INTO mensajes (mensaje) VALUES (hex(aes_encrypt('$mensaje','$clave')))";
            // Se hace la query
            $queryInsert = mysqli_query($conn,$insert);
    
            // Query select
            $select = "SELECT * FROM mensajes ORDER BY id_mensaje DESC LIMIT 1";
            // Se hace la query
            $querySelect = mysqli_query($conn,$select);
            // Traigo los resultados en un array de indices
            $resultados = mysqli_fetch_row($querySelect);
            // Muestro resultados
            echo '
                    <h6><b>Datos a encriptar</b></h6>
                    <p>Mensaje: '.$mensaje.'</p>
                    <p>Clave publica: '.$clave.'</p>
                    <h6><b>Datos encriptados</b></h6>
                    <p>Mensaje: '.$resultados[1].'</p>
                    
                ';
        }
    }

?>