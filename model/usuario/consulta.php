<?php
      include_once "../model/conexion.php";
      include_once "../model/usuario/funciones.php";
?>
<style>
    .all-scroll {cursor: all-scroll;}
</style>
<div id="edit_user"></div>
<div id="new_user"></div>
<div class="col-md-12 col-sm-12 col-xs-12" id="main">
    <div class="x_panel" id="panel">
        <button class="btn btn-warning" onclick="newUserModal()">Agregar Usuario</button>

        <div class="x_title">
            <h2>Lista de usuarios</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content" id="mavo">
            <?php

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
</div>
<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Crear Usuario</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre"/>
                    </div>
                    <div class="form-group">
                        <label for="apellidop">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellidop" placeholder="Apellido Paterno"/>
                    </div>
                    <div class="form-group">
                        <label for="apellidom">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidom" placeholder="Apellido Materno"/>
                    </div>
                    <div class="form-group">
                        <label for="contrasena">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" placeholder="Contraseña"/>
                    </div>
                    <div class="form-group">
                        <label for="nombre_usuario">Username</label>
                        <input type="text" class="form-control" id="nombre_usuario" placeholder="Username"/>
                    </div>
                    <div class="form-group">
                        <label for="id_rol">ID Rol</label>
                        <input type="number" class="form-control" id="id_rol" placeholder="ID Rol"/>
                    </div>

                    <div class="input-group mb-3 form-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="status">Status</label>
                    </div>
                    <select class="custom-select" id="status">
                        <option value="A">Activo</option>
                        <option value="I">Inactivo</option>
                    </select>
                    </div>

                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="createUser()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalForm2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="nombre2">Nombre</label>
                        <input type="text" class="form-control" id="nombre2" placeholder="Nombre"/>
                    </div>
                    <div class="form-group">
                        <label for="apellidop2">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellidop2" placeholder="Apellido Paterno"/>
                    </div>
                    <div class="form-group">
                        <label for="apellidom2">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidom2" placeholder="Apellido Materno"/>
                    </div>
                    <div class="form-group">
                        <label for="contrasena2">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena2" placeholder="Contraseña"/>
                    </div>
                    <div class="form-group">
                        <label for="nombre_usuario2">Username</label>
                        <input type="text" class="form-control" id="nombre_usuario2" placeholder="Username"/>
                    </div>
                    <div class="form-group">
                        <label for="id_rol2">ID Rol</label>
                        <input type="number" class="form-control" id="id_rol2" placeholder="ID Rol"/>
                    </div>

                    <div class="input-group mb-3 form-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="status2">Status</label>
                    </div>
                    <select class="custom-select" id="status2">
                        <option value="A">Activo</option>
                        <option value="I">Inactivo</option>
                    </select>
                    </div>
                    <input type="hidden" name="id_user2" id="id_user2" />  

                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="editUser2()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>

