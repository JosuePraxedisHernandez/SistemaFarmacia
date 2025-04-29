$(document).ready(function () {
    Loader()
    //setTimeout(verificar_sesion, 2000)
    verificar_sesion()

    function verificar_sesion() {
        let funcion = 'verificar_sesion'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/LoginController.php',
            data: { funcion },
            type: 'POST',
            success: function (Response) {
                try {
                    let respuesta = JSON.parse(Response)
                    if (respuesta.length != 0) {
                        console.log(respuesta)
                        menu_superior(respuesta)
                        menu_lateral(respuesta)
                        obtener_clientes()
                        CloseLoader('Clientes Cargados', 'success')
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
                        <a href="/Sistema_Farmacia/Vistas/Perfil.php" class="nav-link">
                            <i class="fa-solid fa-user"></i>
                            <p>Mi Perfil</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/Sistema_Farmacia/Vistas/Clientes.php" class="active nav-link">
                            <i class="fa-solid fa-user-tag"></i>
                            <p>Gestion Clientes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/Sistema_Farmacia/Vistas/Laboratorios.php" class="nav-link">
                            <i class="bi bi-prescription2"></i>
                            <p>Gestion Laboratorios</p>
                        </a>
                    </li>
                </ul>
            </nav>
        `
        $('#menu_lateral').html(template)
    }

    function obtener_clientes() {
        let funcion = 'obtener_clientes'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/ClienteController.php',
            data: { funcion },
            type: 'POST',
            success: function (Response) {
                try {
                    let clientes = JSON.parse(Response)
                    $('#clientes').DataTable({
                        data: clientes,
                        "aaSorting":[],
                        "searching": true,
                        "scrollX": true,
                        "autoWidth": false,
                        columns:[{
                            "render": function(data, type, datos, meta){
                                let template=''
                                template+=`
                                    <div class="card bg-light">
                                        <div class="card-header">`
                                        if(datos.estatus == 1){
                                            template+= `<h1 class="badge bg-success rounded-pill">Activo</h1>`
                                        }
                                        else{
                                            template+= `<h1 class="badge bg-secondary rounded-pill">Inactivo</h1>`
                                        }
                                        template+=`</div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h2 class="lead"><b>${datos.nombre} ${datos.apellido_paterno} ${datos.apellido_materno}</b></h2>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i class="bi bi-chevron-double-right"></i></span> No. Cliente: ${datos.no_cliente}</li>
                                                        <li class="small"><span class="fa-li"><i class="bi bi-chevron-double-right"></i></span> Telefono: ${datos.telefono}</li>
                                                        <li class="small"><span class="fa-li"><i class="bi bi-chevron-double-right"></i></span> Direccion: ${datos.direccion}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i class="bi bi-chevron-double-right"></i></span> Sexo: ${datos.sexo}</li>
                                                        <li class="small"><span class="fa-li"><i class="bi bi-chevron-double-right"></i></span> Email: ${datos.email}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4 text-center">
                                                    <img src="/Sistema_Farmacia/Pictures/Clientes/${datos.avatar}" width="150px" alt="" class="img-fluid img-circle">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <button id="${datos.id}" class="inactivar_cliente btn btn-danger ml-1"><i class="bi bi-trash"></i></button>
                                                <button id="${datos.id}" class="editar_cliente btn btn-warning ml-1" data-bs-toggle="modal" data-bs-target="#editar_cliente"><i class="bi bi-pencil-square"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                `
                                return template
                            }
                        }],
                        "language": { url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json'},
                        "destroy": true
                    })
                } catch (error) {
                    console.error(error)
                    console.log(Response)
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo conflicto en el sistema'
                    })
                }
            }
        })

    }

    $(document).on('click', '.generar_codigo', (e)=>{
        let funcion='rellenar_codigo'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/ClienteController.php',
            data: {funcion},
            type: 'POST',
            success: function(Response){
                let cliente = JSON.parse(Response)
                $('#no_cliente').val(cliente.code)
            }
        })
        e.preventDefault()
    })

    $('#form_crear_cliente').submit(e=>{
        let no_cliente = $('#no_cliente').val()
        let nombre = $('#nombre').val()
        let apellido_paterno = $('#apellido_paterno').val()
        let apellido_materno = $('#apellido_materno').val()
        let email = $('#email').val()
        let telefono = $('#telefono').val()
        let direccion = $('#direccion').val()
        let sexo = $('#sexo').val()
        let funcion='crear_cliente'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/ClienteController.php',
            data: {funcion, no_cliente, nombre, apellido_paterno, apellido_materno, sexo, direccion, email, telefono},
            type: 'POST',
            success: function(Response){
                try {
                    let respuesta = JSON.parse(Response)
                    if(respuesta.mensaje == 'success'){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Cliente Agredado Correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        obtener_clientes()
                        $('#crear_cliente').modal('hide')
                        $('#form_crear_cliente').triggger('reset')
                    } 
                    else if(respuesta.mensaje == 'error_cliente'){
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "No. Cliente no Disponible",
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#form_crear_cliente').triggger('reset')
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

    $(document).on('click', '.editar_cliente', (e)=>{
        let elemento = $(this)[0].activeElement
        let id = $(elemento).attr('id')
        $('#id_cliente_edit').val(id)
        let funcion='obtener_cliente'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/ClienteController.php',
            data: {funcion, id},
            type: 'POST',
            success: function(Response){
                let cliente = JSON.parse(Response)
                $('#nombre_cliente').text(cliente.nombre)
                $('#nombre_cliente').text(cliente.apellido_paterno+ ' '+cliente.apellido_materno)
                $('#no_edit').val(cliente.no_cliente)
                $('#email_edit').val(cliente.email)
                $('#telefono_edit').val(cliente.telefono)
                $('#direccion_edit').val(cliente.direccion)
                $('#sexo_edit').val(cliente.sexo)
            }
        })
        e.preventDefault()
    })

    $('#form_editar_cliente').submit(e=>{
        let id = $('#id_cliente_edit').val()
        let email = $('#email_edit').val()
        let telefono = $('#telefono_edit').val()
        let direccion = $('#direccion_edit').val()
        let sexo = $('#sexo_edit').val()
        let funcion = 'editar_cliente'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/ClienteController.php',
            data: {funcion, id, email, telefono, direccion, sexo},
            type: 'POST',
            success: function(Response){
                try {
                    let respuesta = JSON.parse(Response)
                    if(respuesta.mensaje == 'success'){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Cliente Editado Correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        obtener_clientes()
                        $('#editar_cliente').modal('hide')
                        $('#form_editar_cliente').triggger('reset')
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