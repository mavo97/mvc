<?php
    $dbname = "mvc";
    $user = "root";
    $passwd = "020897";
    $host = "localhost";
    $port = "3306";
    $dsn = "mysql:host=$host;dbname=$dbname";

    try{
        $conn = new PDO($dsn,$user,$passwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>