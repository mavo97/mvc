function acceso() {
    var login = document.getElementById("frm_login");
    var user = document.getElementById("usuario").value;
    var passwd = document.getElementById("passwd").value;

    login.action = "model/acceso.php";

    //Uso de las expresiones regulares
    if (user.length == 0 || passwd.length == 0 || /^\s/.test(user)) {
        alert('Ingrese su usuario o contraseña');
    } else {
        login.submit();
    }

}

function validarForm() {
    if ($("#username").val() == "") {
        alert("El nombre no puede estar vacio");
        $("#username").focus();
        return false;
    }

    if ($("#password").val() == "") {
        alert("La contraseña no puede estar vacio");
        $("#password").focus();
        return false;
    }

    if ($("#name").val() == "") {
        alert("El nombre no pude estar vacio");
        $("#name").focus();
        return false;
    }

    if ($("#ape_paterno").val() == "") {
        alert("El apellido paterno no pude estar vacio");
        $("#ape_paterno").focus();
        return false;
    }

    if ($("#ape_materno").val() == "") {
        alert("El apellido paterno no pude estar vacio");
        $("#ape_materno").focus();
        return false;
    }

    if ($("#status").is(":selected")) {
        alert("seleccione una opcion de estado");
        return false;
    }
    return true;
}

$(document).ready(function() {
    $("#registrar").click(function() {
        if (validarForm()) {
            $.post("model/user/registrar.php", $("#reg_user").serialize(), function(res) {
                if (res == 1) {
                    $("#exito").delay(500).fadeIn("slow");
                } else {
                    $("#fracaso").delay(500).fadeIn("slow");
                }
            });
        }
    });
});

function consultaxml() {
    var buscar = document.getElementById("buscar").value;
    if (buscar == "") {
        alert('Ingrese datos');
    } else {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'model/xml/xmlload.php', false);
        let formData = new FormData();
        formData.append("search", buscar);
        try {
            xhr.send(formData);
            if (xhr.status != 200) {
                alert('Error del Sistema');
            } else {
                document.getElementById("contenido_principal").innerHTML = (xhr.response);
            }
        } catch (err) {
            alert('Error del Menu');
        }
    }
}

function menu(opcion) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'controller/controller.php', false);
    let formdata = new FormData();
    formdata.append("opcion", opcion);
    try {
        xhr.send(formdata);
        if (xhr.status != 200) {
            alert('Error del Sistema');
        } else {
            document.getElementById('contenido_principal').innerHTML = (xhr.response);
        }
    } catch (err) {
        alert('Error del Menu');
    }
}

function consultajson() {
    var buscar = document.getElementById("buscar").value;
    if (buscar == "") {
        alert('Ingrese datos');
    } else {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'model/json/jsonload.php', false);
        let formData = new FormData();
        formData.append("search", buscar);
        try {
            xhr.send(formData);
            if (xhr.status != 200) {
                alert('Error del Sistema');
            } else {
                document.getElementById('contenido_principal').innerHTML = (xhr.response);
            }
        } catch (err) {
            alert('Error del Menu');
        }
    }
}

function consultaxsl() {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'model/xml/xmlxsl.php', false);
    let formData = new FormData();
    try {
        xhr.send(formData);
        if (xhr.status != 200) {
            alert('Error del Sistema');
        } else {
            document.getElementById("contenido_principal").innerHTML = (xhr.response);
        }
    } catch (err) {
        alert('Error del Menu');
    }
}

function menujquery(opcion) {
    $.ajax({
        type: "POST",
        url: "controller/controller.php",
        data: { opcion: opcion },
        beforeSend: function() {
            $("#contenido_principal").html("<img src='images/ajax-loader.gif'>");
        },
        success: function(respuesta) {
            $("#contenido_principal").html(respuesta);


        }
    });

}

function consultaxmljquery() {
    $.ajax({
        type: "POST",
        url: "model/xml/xmlload.php",
        data: $("#form_consulta").serialize(),
        beforeSend: function() {
            $("#contenido_principal").html("<img src='images/ajax-loader.gif'>");
        },
        success: function(respuesta) {
            $("#contenido_principal").html(respuesta);
        }
    });
}

function editUser(id_user) {
    var id = $(this).attr('id');
    $('.statusMsg').html('<div></div>')
    $.ajax({
        type: "POST",
        url: "model/usuario/edita_usuario.php",
        data: { id_user: id_user },
        dataType: 'json',
        beforeSend: function(data) {
            console.log(id_user);
        },
        success: function(data) {
            if (data.error) {
                alert(data.error); //Esto lo puedes poner en un elemento HTML si quieres
            } else {
                console.log(data);
                $('#nombre2').val(data[0].nombre);
                $('#apellidop2').val(data[0].apellidop);
                $('#apellidom2').val(data[0].apellidom);
                $('#contrasena2').val(data[0].contrasena);
                $('#id_rol2').val(data[0].id_rol);
                $('#nombre_usuario2').val(data[0].username);
                $('#status2').val(data[0].status);
                $('#id_user2').val(data[0].id_usuario);
                $('#modalForm2').modal('show');
            }
        }

    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown, textStatus, jqXHR);
    });
}

function newUserModal() {
    $('#nombre').val('');
    $('#apellidop').val('');
    $('#apellidom').val('');
    $('#contrasena').val('');
    $('#id_rol').val('');
    $('#nombre_usuario').val('');
    $('#status').val('');
    $('#id_user').val('');
    $('.statusMsg').html('<div></div>');
    $('#modalForm').modal('show');

}


function createUser() {
    var nombre = $('#nombre').val();
    var apellidop = $('#apellidop').val();
    var apellidom = $('#apellidom').val();
    var contrasena = $('#contrasena').val();
    var id_rol = $('#id_rol').val();
    var status = $('#status').val();
    var username = $('#nombre_usuario').val();
    if (nombre.trim() == '') {
        alert('Porfavor escriba su nombre..');
        $('#nombre').focus();
        return false;
    } else if (apellidop.trim() == '') {
        alert('Porfavor escriba su Apellido Paterno..');
        $('#apellidop').focus();
        return false;
    } else if (apellidom.trim() == '') {
        alert('Porfavor escriba su Apellido Materno..');
        $('#apellidom').focus();
        return false;
    } else if (contrasena.trim() == '') {
        alert('Porfavor escriba su Contraseña..');
        $('#contrasena').focus();
        return false;
    } else if (username.trim() == '') {
        alert('Porfavor escriba su Nombre de usuario..');
        $('#contrasena').focus();
        return false;
    } else if (id_rol.trim() == '') {
        alert('Porfavor escriba su ID..');
        $('#id_rol').focus();
        return false;
    } else if (status.trim() == '') {
        alert('Porfavor seleccione su status..');
        $('#status').focus();
        return false;
    } else {
        $.ajax({
            type: 'POST',
            url: 'model/usuario/nuevo_usuario.php',
            data: 'contactFrmSubmit=1&nombre=' + nombre + '&apellidop=' + apellidop + '&apellidom=' + apellidom + '&contrasena=' + contrasena + '&id_rol=' + id_rol + '&status=' + status + '&username=' + username,
            beforeSend: function() {
                $('.submitBtn').attr("disabled", "disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success: function(msg) {
                if (msg !== 'err') {
                    $('#nombre').val('');
                    $('#apellidop').val('');
                    $('#apellidom').val('');
                    $('#contrasena').val('');
                    $('#nombre_usuario').val('');
                    $('#id_rol').val('');
                    $('.statusMsg').html('<div class="alert alert-success" role="alert">Registro Exitoso!</div>');
                    $('#main').load('model/usuario/reload.php #panel2')
                } else {
                    $('.statusMsg').html('<div class="alert alert-danger" role="alert">Registro Incorrecto!</div>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');



            }
        });
    }
}

function editUser2() {
    var nombre2 = $('#nombre2').val();
    var apellidop2 = $('#apellidop2').val();
    var apellidom2 = $('#apellidom2').val();
    var contrasena2 = $('#contrasena2').val();
    var id_rol2 = $('#id_rol2').val();
    var status2 = $('#status2').val();
    var username2 = $('#nombre_usuario2').val();
    var id_user2 = $('#id_user2').val();
    if (nombre2.trim() == '') {
        alert('Porfavor escriba su nombre..');
        $('#nombre').focus();
        return false;
    } else if (apellidop2.trim() == '') {
        alert('Porfavor escriba su Apellido Paterno..');
        $('#apellidop').focus();
        return false;
    } else if (apellidom2.trim() == '') {
        alert('Porfavor escriba su Apellido Materno..');
        $('#apellidom').focus();
        return false;
    } else if (contrasena2.trim() == '') {
        alert('Porfavor escriba su Contraseña..');
        $('#contrasena').focus();
        return false;
    } else if (username2.trim() == '') {
        alert('Porfavor escriba su Nombre de usuario..');
        $('#contrasena').focus();
        return false;
    } else if (id_rol2.trim() == '') {
        alert('Porfavor escriba su ID..');
        $('#id_rol').focus();
        return false;
    } else if (status2.trim() == '') {
        alert('Porfavor seleccione su status..');
        $('#status').focus();
        return false;
    } else {
        $.ajax({
            type: 'POST',
            url: 'model/usuario/editarusuario.php',
            data: 'contactFrmSubmit=1&nombre2=' + nombre2 + '&apellidop2=' + apellidop2 + '&apellidom2=' + apellidom2 + '&contrasena2=' + contrasena2 + '&id_rol2=' + id_rol2 + '&status2=' + status2 + '&username2=' + username2 + '&id_user2=' + id_user2,
            beforeSend: function() {
                $('.submitBtn').attr("disabled", "disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success: function(msg) {
                if (msg !== 'err') {
                    console.log(nombre2 + '' + apellidop2 + '' + apellidom2 + '' + username2 + '' + contrasena2 + '' + id_rol2 + '' + status2 + '' + id_user2)
                    $('#nombre2').val('');
                    $('#apellidop2').val('');
                    $('#apellidom2').val('');
                    $('#contrasena2').val('');
                    $('#nombre_usuario2').val('');
                    $('#id_rol2').val('');
                    $('#id_user2').val('');
                    $('.statusMsg').html('<div class="alert alert-success" role="alert">Registro Exitoso!</div>');
                    $('#main').load('model/usuario/reload.php #panel2')
                } else {
                    $('.statusMsg').html('<div class="alert alert-danger" role="alert">Registro Incorrecto!</div>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');



            }
        });
    }
}