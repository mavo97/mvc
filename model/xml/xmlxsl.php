<?php
    include_once '../conexion.php';   
    $search = '';
    if (isset($_GET['search'])) {
       $search=$_GET['search'];
    }
    if($search==""){
        $where="";
    }else{
        $where= "where username=?";
    }
    $Query = "select*from usuarios ".$where;

    $sql = $conn->prepare($Query);
    $sql->bindParam(1, $search, PDO::PARAM_STR);
    $sql->execute();
    header("Content-Type: text/xml");
    if ($sql->rowCount()>0) {
        echo "<?xml version='1.0' encoding='UTF-8'?>";
        echo "<?xml-stylesheet  href='plantilla.xsl' type='text/xsl'?>";
        echo "<usuarios>";
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                echo "<usuario>";
                    echo "<nombre>".$row['nombre']."</nombre>";
                    echo "<apellidop>".$row['apellidop']."</apellidop>";
                    echo "<apellidom>".$row['apellidom']."</apellidom>";
                    echo "<username>".$row['username']."</username>";
                echo "</usuario>";
            } 
        echo "</usuarios>";
    }else{
        echo "<?xml version='1.0' encoding='UTF-8' ?>";
        echo "<?xml-stylesheet   href='plantilla.xsl' type='text/xsl'?>";
        echo "<usuarios>";
        echo "</usuarios>";
    }
    
?>