<?php
function conectar(){

    $conn = null;
    $host = "localhost:3306"; //HOST
    $db = "samsung store"; //NUESTRA BASE DE DATOS
    $user = "root"; // NOM USUARIO
    $pwd = ""; // CONTRASEÑA

    try {
        $conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd);
        //echo ':) Éxito ';
      }catch(PDOException $e){
        echo ':( Error con la base de datos '.$e;
        exit;
      }
    
    return $conn;
}
?>