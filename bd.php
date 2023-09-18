<?php
    $servidor = "localhost";
    $dbname = "app";
    $user = "root";
    $pass = "";

    try{
        $conexion = new PDO("mysql:host=$servidor;dbname=$dbname", $user, $pass);
    }catch(Exception $ex){
        echo $ex->getMessage();
    }

    /*
        // primero deberiamos comprobar que no existan usuarios, para insertar siempre el admin
        $usuario = "admin";
        $password = "admin";
        $correo = "admin@gmail.com";
        $sentencia = $conexion->prepare("INSERT INTO tbl_usuarios(id,usuario,password,correo) 
            VALUES(null,:usuario,:password,:correo)");
        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":password", $password);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->execute();
    */

?>

