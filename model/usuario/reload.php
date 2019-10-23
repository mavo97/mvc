<div class="x_panel" id="panel2">
        <button class="btn btn-warning" onclick="newUserModal()">Agregar Usuario</button>

        <div class="x_title">
            <h2>Lista de usuarios</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content" id="mavo">
            <?php
                include_once "../conexion.php";
                include_once "./funciones.php";
                $sql = $conn->prepare("select * from usuarios");
                $sql->execute();

                if($sql->rowCount()>0){
            ?>
             
                <table id="dataTable" class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Rol</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($rows = $sql->fetch(PDO::FETCH_ASSOC)){
                                echo '<tr>';
                                    echo '<td>'.$rows['nombre'].'</td>';
                                    echo '<td>'.$rows['apellidop'].'</td>';
                                    echo '<td>'.$rows['apellidom'].'</td>';
                                    echo '<td>'.$rows['username'].'</td>';
                                    echo '<td>'.roles($rows['id_rol']).'</td>';
                                    echo '<td>'.statusLabel($rows['status']).'</td>';
                                    $s = $rows['id_usuario'];
                                    echo '<td><a class="all-scroll" onclick="editUser('.$s.');"> <i class="fa fa-edit"></i> </a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            <?php } ?> 
        </div>
    </div>