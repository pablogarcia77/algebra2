<?php

    require('conexion.php');
    $conn = new mysqli($servername,$username,$password,$dbname);
    $conn->set_charset("utf8");
    if (!$conn){
        die("Conexion fallida");
    } else {

        $mensaje = $_POST['mensaje'];
        
        $action = ($_POST['encdec']=='D') ? true : false;

        if($action){
            $clave = $_POST['clave'];   
            $decrypt = "SELECT id_mensaje, aes_decrypt(unhex(mensaje),'$clave') FROM mensajes ORDER BY id_mensaje DESC LIMIT 1";
            $queryDecrypt = mysqli_query($conn,$decrypt);
            $deResultados = mysqli_fetch_row($queryDecrypt);
    
            echo '
                    <h6><b>Mensaje desencriptado:</b></h6>
                    <p>Mensaje: '.$deResultados[1].'</p>
                    
                ';
        }else{
            $clave = $_POST['primo1'] * $_POST['primo2'];
            $insert = "INSERT INTO mensajes (mensaje) VALUES (hex(aes_encrypt('$mensaje','$clave')))";
            $queryInsert = mysqli_query($conn,$insert);
    
            $select = "SELECT * FROM mensajes ORDER BY id_mensaje DESC LIMIT 1";
            $querySelect = mysqli_query($conn,$select);
            $resultados = mysqli_fetch_row($querySelect);
    
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