$(document).ready(function () {
    Loader(" Datos")
    //setTimeout(verificar_sesion, 2000)
    verificar_sesion()

    function verificar_sesion() {
        let funcion = 'verificar_sesion'
        $.ajax({
            url: '../Controlador/LoginController.php',
            data: { funcion },
            type: 'POST',
            success: function (Response) {
                try {
                    let respuesta = JSON.parse(Response)
                    console.log(respuesta)
                    if (respuesta.length != 0) {
                        menu_superior(respuesta)
                        menu_lateral(respuesta)
                        obtener_datos()
                        CloseLoader()
                    } else {
                        location.href = "../Vistas/"
                    }
                } catch (error) {
                    console.error(error)
                    console.log(Response)
                }
            }
        })
    }

    function menu_superior(usuario){
        let template=`
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="/Sistema_Farmacia/Pictures/Usuarios/${usuario.avatar}" width="30" heugth="30"></img>
                        <span>${usuario.nombre+' '+usuario.apellido_paterno+' '+usuario.apellido_materno}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/Sistema_Farmacia/Controlador/Logout.php"><i class="fa-solid fa-right-to-bracket"></i> Cerrar Sesion </a>
                        </li>
                    </ul>
                </li>
            </ul>
        `
        $('#menu_superior').html(template)
    }

    function menu_lateral(usuario){
        let template=`
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/Sistema_Farmacia/Pictures/Usuarios/${usuario.avatar}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">${usuario.nombre+' '+usuario.apellido_paterno+' '+usuario.apellido_materno}</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">Usuario</li>
                    <li class="nav-item">
                        <a href="/Sistema_Farmacia/Vistas/Perfil.php" class="active nav-link">
                            <i class="fa-solid fa-user"></i>
                            <p>Mi Perfil</p>
                        </a>
                    </li>
                </ul>
            </nav>
        `
    $('#menu_lateral').html(template)
    }

    function obtener_datos() {
        let funcion = 'obtener_datos'
        $.ajax({
            url: '../Controlador/UsuarioController.php',
            data: { funcion },
            type: 'POST',
            success: function (Response) {
                try {
                    let usuario = JSON.parse(Response)
                    let template = `
                        <div class="text-center">
                            <img role="button" src="/Sistema_Farmacia/Pictures/${usuario.avatar}" class="editar_avatar rounded-circle" width="180" data-bs-toggle="modal" data-bs-target="#cambiar_avatar">
                        </div>
                        <h3 class="profile-username text-center text-success">${usuario.nombre}</h3>
                        <h5 id="apelllidos_usuario" class="text-muted text-center">${usuario.apellido_paterno} ${usuario.apellido_materno}</h5>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b style="color: #0B7300;">Tipo de Usuario</b>`
                                if (usuario.id_perfil == '1') {
                                    template += `<h1 class="badge rounded-pill bg-danger">${usuario.perfil}</h1>`
                                }
                                if (usuario.id_perfil == '2') {
                                    template += `<h1 class="badge rounded-pill bg-warning">${usuario.perfil}</h1>`
                                }
                                if (usuario.id_perfil == '3') {
                                    template += `<h1 class="badge rounded-pill bg-info">${usuario.perfil}</h1>`
                                }
                            template += `</li>
                        </ul>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b style="color: #0B7300;">Estatus del Usuario</b>`
                                if (usuario.estatus == '1') {
                                    template += `<span id="estatus_ususario" class="badge rounded-pill bg-warning $badge-color:$white;">Activo</span>`
                                } else if (usuario.estatus == '2') {
                                    template += `<h1 class="badge rounded-pill bg-warning">${usuario.perfil}</h1>`
                                }
                            template += `</li>
                        </ul>
                        <button type="submit" class="editar_pass btn btn-danger col-md-12" data-bs-toggle="modal" data-bs-target="#cambiar_pass">Cambiar Contraseña</button>
                    `
                    $('#card-datos').html(template)
                    let template_1 = `
                        <div class="card-header bg-success" style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="card-title">Sobre mi</div>
                            <div class="card-tools">
                                <button class="editar_datos btn btn-tool" data-bs-toggle="modal" data-bs-target="#editar_datos_usuario">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <strong style="color: #0B7300"><i class="bi bi-person-circle"></i> Usuario</strong>
                            <p class="text-muted">${usuario.usuario}</p>
                            <strong style="color: #0B7300"><i class="bi bi-envelope-fill"></i> Correo Electronico</strong>
                            <p class="text-muted">${usuario.email}</p>
                            <strong style="color: #0B7300"><i class="bi bi-telephone-fill"></i> Teléfono</strong>
                            <p class="text-muted">${usuario.telefono}</p>
                            <strong style="color: #0B7300"> Direccion</strong>
                            <p class="text-muted">${usuario.direccion}</p>
                        </div>
                    `
                    $('#card-datos-personales').html(template_1)
                } catch (error) {
                    console.error(error)
                    console.log(Response)
                }
            }
        })

    }

    $(document).on('click', '.editar_datos', (e)=>{
        let funcion='obtener_datos'
        $.ajax({
            url: '../Controlador/UsuarioController.php',
            data: {funcion},
            type: 'POST',
            success: function(Response){
                let usuario = JSON.parse(Response)
                $('#ussser').val(usuario.usuario)
                $('#email').val(usuario.email)
                $('#telefono').val(usuario.telefono)
                $('#direccion').val(usuario.direccion)
            }
        })
        e.preventDefault()
    })

    $('#form_editar_usuario').submit(e=>{
        let usuario = $('#ussser').val()
        let email = $('#email').val()
        let telefono = $('#telefono').val()
        let direccion = $('#direccion').val()
        let funcion='editar_datos'
        $.ajax({
            url: '../Controlador/UsuarioController.php',
            data: {funcion, usuario, email, telefono, direccion},
            type: 'POST',
            success: function(Response){
                try {
                    let respuesta = JSON.parse(Response)
                    if(respuesta.mensaje == 'success'){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Datos Actualizados Correctamente",
                            showConfirmButton: false,
                            timer: 1500
                          });
                        $('#editar_datos_usuario').modal('hide')
                        obtener_datos()
    
                    } else if(respuesta.mensaje == 'error_sesion'){
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Sesion Finalizada",
                            showConfirmButton: false,
                            timer: 1500
                          }).then(function(){
                            location.href="/Sistema_Farmacia/Vistas/"
                          })
                    }
                } catch (error) {
                    console.error(error)
                    console.log(Response)
                }
            }
        })
        e.preventDefault()
    })

    $(document).on('click', '.editar_pass', (e)=>{
        let funcion='obtener_datos'
        $.ajax({
            url: '../Controlador/UsuarioController.php',
            data: {funcion},
            type: 'POST',
            success: function(Response){
                let usuario = JSON.parse(Response)
                $('#nombre_pass').text(usuario.nombre)
                $('#apellidos_pass').text(usuario.apellido_paterno+ ' '+usuario.apellido_materno)
                $('#avatar_pass').attr('src', usuario.avatar)
            }
        })
        e.preventDefault()
    })

    $('#form_editar_contraseña').submit(e=>{
        let oldpass = $('#oldpass').val()
        let newpass = $('#newpass').val()
        let funcion='editar_contraseña'
        $.ajax({
            url: '../Controlador/UsuarioController.php',
            data: {funcion, oldpass, newpass},
            type: 'POST',
            success: function(Response){
                try {
                    let respuesta = JSON.parse(Response)
                    if(respuesta.mensaje == 'success'){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Constraseña Actualizada Correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#cambiar_pass').modal('hide')
                        $('#form_editar_contraseña').trigger('reset')
                    } 
                    else if(respuesta.mensaje == 'error_pass'){
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Contraseña no Coincide con Registros",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } 
                    else if(respuesta.mensaje == 'error_sesion'){
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Sesion Finalizada",
                            showConfirmButton: false,
                            timer: 1500
                          }).then(function(){
                            location.href="/Sistema_Farmacia/Vistas/"
                          })
                    }
                } catch (error) {
                    console.error(error)
                    console.log(Response)
                }
            }
        })
        e.preventDefault()
    })

    $(document).on('click', '.editar_avatar', (e)=>{
        let funcion='obtener_datos'
        $.ajax({
            url: '../Controlador/UsuarioController.php',
            data: {funcion},
            type: 'POST',
            success: function(Response){
                let usuario = JSON.parse(Response)
                let funcion='editar_avatar'
                $('#funcion').val(funcion)
                $('#nombre_avatar').text(usuario.nombre)
                $('#apellidos_avatar').text(usuario.apellido_paterno+ ' '+usuario.apellido_materno)
                $('#avatar_avatar').attr('src', usuario.avatar)
            }
        })
        e.preventDefault()
    })

    $('#form_cambiar_avatar').submit(e=>{
        let formData = new FormData($('#form_cambiar_avatar')[0])
        $.ajax({
            url: '../Controlador/UsuarioController.php',
            data: formData,
            type: 'POST',
            Cache: false,
            processData: false,
            contentType: false,
            success: function(Response){
                try {
                    let respuesta = JSON.parse(Response)
                    if(respuesta.mensaje == 'success'){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Avatar Actualizado Correctamente",
                            showConfirmButton: false,
                            timer: 1500
                          });
                        $('#cambiar_pass').modal('hide')
                        $('#form_editar_contraseña').trigger('reset')
                    } 
                    else if(respuesta.mensaje == 'error_sesion'){
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Sesion Finalizada",
                            showConfirmButton: false,
                            timer: 1500
                          }).then(function(){
                            location.href="/Sistema_Farmacia/Vistas/"
                          })
                    }
                } catch (error) {
                    console.error(error)
                    console.log(Response)
                }
            }
        })
        e.preventDefault()
    })

    function Loader(mensaje) {
        if (mensaje == '' || mensaje == null) {
            mensaje = "Cargando Datos...."
        }
        Swal.fire({
            position: 'center',
            html: '<i class="fas fa-2x fa-sync-alt fa-spin"></i>',
            title: mensaje,
            showConfirmButton: false
        })
    }

    function CloseLoader(mensaje, tipo) {
        if (mensaje == '' || mensaje == null) {
            Swal.close()
        }
        Swal.fire({
            position: 'center',
            icon: tipo,
            title: mensaje,
            showConfirmButton: false,
        })
    }
})