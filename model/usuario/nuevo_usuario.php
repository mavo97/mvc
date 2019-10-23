<?php
if(isset($_POST['contactFrmSubmit']) && !empty($_POST['nombre']) && !empty($_POST['apellidop']) && !empty($_POST['apellidom'])  && !empty($_POST['contrasena']) && !empty($_POST['id_rol']) && !empty($_POST['status']) && !empty($_POST['username'])  ){
    
    // Submitted form data
    $nombre   = $_POST['nombre'];
    $apellidop  = $_POST['apellidop'];
    $apellidom = $_POST['apellidom'];
    $username = $_POST['username'];
    $contrasena = $_POST['contrasena'];
    $id_rol = $_POST['id_rol'];
    $statu = $_POST['status'];

    include_once '../conexion.php';
    $sql = $conn->prepare("INSERT INTO usuarios(nombre, apellidop, apellidom, username, contrasena, 
    id_rol, status) VALUES (?,?,?,?,?,?,? )");

    $sql->bindParam(1, $nombre, PDO::PARAM_STR);
    $sql->bindParam(2, $apellidop, PDO::PARAM_STR);
    $sql->bindParam(3, $apellidom, PDO::PARAM_STR);
    $sql->bindParam(4, $username, PDO::PARAM_STR);
    $sql->bindParam(5, $contrasena, PDO::PARAM_STR);
    $sql->bindParam(6, $id_rol, PDO::PARAM_INT);
    $sql->bindParam(7, $statu, PDO::PARAM_STR);
    $test = '';
    try{
        $sql->execute();
        

    }catch(PDOException $e){
        echo $e->getMessage();
        $test = 'err';
    }

    
    // Output status
    echo $test;die;
}