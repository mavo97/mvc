<?php
if(isset($_POST['contactFrmSubmit']) && !empty($_POST['nombre2']) && !empty($_POST['apellidop2']) && !empty($_POST['apellidom2'])  && !empty($_POST['contrasena2']) && !empty($_POST['id_rol2']) && !empty($_POST['status2']) && !empty($_POST['username2']) && !empty($_POST['id_user2'])  ){
    
    // Submitted form data
    $nombre   = $_POST['nombre2'];
    $apellidop  = $_POST['apellidop2'];
    $apellidom = $_POST['apellidom2'];
    $username = $_POST['username2'];
    $contrasena = $_POST['contrasena2'];
    $id_rol = $_POST['id_rol2'];
    $statu = $_POST['status2'];
    $id_user = $_POST['id_user2'];


    include_once '../conexion.php';
    $sql = $conn->prepare("UPDATE usuarios SET username = ?, contrasena = ?, nombre = ?, apellidop = ?,
    apellidom = ?, id_rol = ?, status = ? WHERE id_usuario = ? ");

    $sql->bindParam(1, $username, PDO::PARAM_STR);
    $sql->bindParam(2, $contrasena, PDO::PARAM_STR);
    $sql->bindParam(3, $nombre, PDO::PARAM_STR);
    $sql->bindParam(4, $apellidop, PDO::PARAM_STR);
    $sql->bindParam(5, $apellidom, PDO::PARAM_STR);
    $sql->bindParam(6, $id_rol, PDO::PARAM_INT);
    $sql->bindParam(7, $statu, PDO::PARAM_STR);
    $sql->bindParam(8, $id_user, PDO::PARAM_INT);
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