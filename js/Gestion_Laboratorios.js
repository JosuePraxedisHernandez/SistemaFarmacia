$(document).ready(function () {
    Loader()
    setTimeout(verificar_sesion, 2000)
    //verificar_sesion()

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
                        obtener_laboratorios()
                        CloseLoader('Laboratorios Cargados', 'success')
                    } else {
                        location.href = "/Sistema_Farmacia/Vistas/"
                    }
                } catch (error) {
                    console.error(error)
                    console.log(Response)
                }
            }
        })
    }

    function menu_superior(usuario) {
        let template = `
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
                        <span>${usuario.nombre + ' ' + usuario.apellido_paterno + ' ' + usuario.apellido_materno}</span>
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

    function menu_lateral(usuario) {
        let template = `
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/Sistema_Farmacia/Pictures/Usuarios/${usuario.avatar}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">${usuario.nombre + ' ' + usuario.apellido_paterno + ' ' + usuario.apellido_materno}</a>
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
                        <a href="/Sistema_Farmacia/Vistas/Clientes.php" class="nav-link">
                            <i class="fa-solid fa-user-tag"></i>
                            <p>Gestion Clientes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/Sistema_Farmacia/Vistas/Laboratorios.php" class="active nav-link">
                            <i class="bi bi-prescription2"></i>
                            <p>Gestion Laboratorios</p>
                        </a>
                    </li>
                </ul>
            </nav>
        `
        $('#menu_lateral').html(template)
    }

    function obtener_laboratorios() {
        let funcion = 'obtener_laboratorios'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/LaboratorioController.php',
            data: { funcion },
            type: 'POST',
            success: function (Response) {
                try {
                    let laboratorios = JSON.parse(Response)
                    $('#laboratorios').DataTable({
                        data: laboratorios,
                        "aaSorting": [],
                        "searching": true,
                        "scrollX": true,
                        "autoWidth": false,
                        "pagingType": "simple_numbers",
                        columns: [{
                            "render": function (data, type, datos, meta) {
                                let template = `
                                    <div class="card card-widget widget-user-2">
                                        <div class="widget-user-header bg-gray">
                                            <div class="widget-user-image">
                                                <img class="img-circle elevation-1" src="/Sistema_Farmacia/Pictures/Laboratorios/${datos.avatar}" alt="User Avatar">
                                            </div>
                                            <h3 class="widget-user-username">${datos.nombre}</h3>`
                                            if(datos.estado == 'A'){
                                                template +=`
                                                    <h5 class="widget-user-desc"><span class="badge badge-success">Activo</span></h5>
                                                    <span class="ml-1 float-right"><button id="${datos.id}" type="submit" class="editar_laboratorio btn btn-warning" data-bs-toggle="modal" data-bs-target="#editar_laboratorio"><i class="bi bi-pencil-square"></i></button></span>
                                                    <span class="float-right"><button id="${datos.id}" type="submit" class="inactivar_laboratorio btn btn-danger"><i class="bi bi-trash"></i></button></span>
                                                `
                                            } else {
                                                template +=`
                                                    <h5 class="widget-user-desc"><span class="badge badge-warning">Inactivo</span></h5>
                                                    <span class="float-right"><button id="${datos.id}" type="submit" class="activar_laboratorio btn btn-success"><i class="bi bi-check-circle"></i></button></span>
                                                `
                                            }
                                        template +=`</div>
                                        <div class="card-footer p-0">
                                        </div>
                                    </div>
                                    `
                                return template;
                            }
                        }],
                        "language": { url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json' },
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

    $('#form_crear_laboratorio').submit(e=>{
        let nombre = $('#nombre').val()
        let funcion='crear_laboratorio'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/LaboratorioController.php',
            data: {funcion, nombre},
            type: 'POST',
            success: function(Response){
                try {
                    let respuesta = JSON.parse(Response)
                    if(respuesta.mensaje == 'success'){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Laboratorio Agredado Correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        obtener_laboratorios()
                        $('#crear_laboratorio').modal('hide')
                        $('#form_crear_laboratorio').triggger('reset')
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

    $(document).on('click', '.editar_laboratorio', (e) => {
        let elemento = $(this)[0].activeElement
        let id = $(elemento).attr('id')
        $('#id_laboratorio').val(id)
        let funcion = 'obtener_laboratorio'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/LaboratorioController.php',
            data: { funcion, id },
            type: 'POST',
            success: function (Response) {
                let laboratorio = JSON.parse(Response)
                $('#nombre_laboratorio').text(laboratorio.nombre)
                $('#avatar_laboratorio').attr('src', '/Sistema_Farmacia/Pictures/Laboratorios/' + laboratorio.avatar)
                $('#nombre_lab').val(laboratorio.nombre)
            }
        })
        e.preventDefault()
    })

    $('#form_editar_laboratorio').submit(e => {
        let datos = new FormData($('#form_editar_laboratorio')[0])
        let funcion = 'editar_laboratorio'
        datos.append('funcion', funcion)
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/LaboratorioController.php',
            data: datos,
            type: 'POST',
            cache: false,
            processData: false,
            contentType: false,
            success: function (Response) {
                try {
                    let respuesta = JSON.parse(Response)
                    if (respuesta.mensaje == 'success') {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Laboratorio editado correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        obtener_laboratorios()
                        $('#editar_laboratorio').modal('hide')
                        $('#form_editar_laboratorio').triggger('reset')
                    } else if (respuesta.mensaje == 'error_sesion') {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Sesion Finalizada",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            location.href = "/Sistema_Farmacia/Vistas/"
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

    $(document).on('click', '.inactivar_laboratorio', (e) => {
        let elemento = $(this)[0].activeElement
        let id = $(elemento).attr('id')
        let funcion = 'inactivar_laboratorio'
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Este laboratorio dejara de estar disponible",
            text: "¿Deseas desactivarlo?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/Sistema_Farmacia/Controlador/LaboratorioController.php',
                    data: { funcion, id },
                    type: 'POST',
                    success: function (Response) {
                        try {
                            let respuesta = JSON.parse(Response)
                            if(respuesta.mensaje == 'success'){
                                swalWithBootstrapButtons.fire({
                                    title: "Desactivado!",
                                    text: "El laboratoio ha sido modificado",
                                    icon: "success"
                                });
                                obtener_laboratorios()
                            } else {
                                swalWithBootstrapButtons.fire({
                                    title: "No se pudo desactivar!",
                                    icon: "error"
                                });
                                obtener_laboratorios()
                            }
                        } catch (error) {
                            console.error(error)
                            console.log(Response)
                        }
                    }
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });
            }
        });
    })

    $(document).on('click', '.activar_laboratorio', (e) => {
        let elemento = $(this)[0].activeElement
        let id = $(elemento).attr('id')
        let funcion = 'activar_laboratorio'
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: "Este laboratorio estara disponible",
            text: "¿Deseas activarlo?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/Sistema_Farmacia/Controlador/LaboratorioController.php',
                    data: { funcion, id },
                    type: 'POST',
                    success: function (Response) {
                        try {
                            let respuesta = JSON.parse(Response)
                            if (respuesta.mensaje == 'success') {
                                swalWithBootstrapButtons.fire({
                                    title: "Activado",
                                    text: "El laboratorio ha sido modificado",
                                    icon: "success"
                                });
                                obtener_laboratorios()
                            } else {
                                swalWithBootstrapButtons.fire({
                                    title: "No se pudo activar",
                                    icon: "error"
                                });
                                obtener_laboratorios()
                            }
                        } catch (error) {
                            console.error(error)
                            console.log(Response)
                        }
                    }
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });
            }
        });
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