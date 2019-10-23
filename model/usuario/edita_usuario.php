
<?php  
 //fetch.php  
    include_once '../conexion.php';
    $mUser=!empty($_POST["id_user"]) ? $_POST["id_user"] : NULL;
    $datos=array();
    if($mUser)
    {
        $Query = "SELECT * FROM usuarios WHERE id_usuario = ?";
        if ( $sql = $conn->prepare($Query) ) {
            $mArgs=array($mUser);
            $sql->execute($mArgs);
            if ($sql->rowCount() > 0) {
                while ($rows = $sql ->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $rows;
                }
            } else {
                $datos['error']= 'No hay filas encontradas';
            }
        } else {
            $datos['error']= 'No se preparó la consulta. Error: '.$conn->errorInfo()[2];
        }
    } else {
        $datos['error']= 'No se posteó un id_user';

    }

    echo json_encode($datos);
 ?>