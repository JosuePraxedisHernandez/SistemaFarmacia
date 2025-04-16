<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Vistas/Templates/Header.php';
?>
<title>Mi Perfil | Sistema Farmacia</title>
<div class="content-wrapper" style="min-height: 1604.44px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mi Pefil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Mi Perfil</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card border-success">
                        <div id="card-datos" class="card-body box-profile">

                        </div>
                    </div>
                    <br>
                    <div id="card-datos-personales" class="card">

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-headers text-white bg-success">
                            <h2>Sistema Farmacia</h2>
                        </div>
                        <div class="card-body">
                            <div class="card">

                            </div>
                        </div>
                        <div class="card-footer text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Editar Datos -->
<div class="modal fade" id="editar_datos_usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Datos Personales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_editar_usuario" action="" method="post">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="ussser" id="ussser" aria-describedby="helpId" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Correo Electronico</label>
                        <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Telefono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" aria-describedby="helpId" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Direccion</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" />
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i></button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Modal Cambiar Contraseña -->
<div class="modal fade" id="cambiar_pass">
    <div class="modal-dialog">
        <div class="modal-content card-success">
            <div class="modal-header card-header bg-success">
                <h5 class="modal-title" id="staticBackdropLabel">Cambiar Contraseña</h5>
            </div>
            <div class="modal-body p-0">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header text-center bg-success">
                        <h3 id="nombre_pass" class="widget-user-usename"></h3>
                        <h3 id="apellidos_pass" class="widget-user-desc"></h3>
                    </div>
                    <div class="widget-user-image text-center">
                        <img id="avatar_pass" class="img-circle" src="" alt="" width="150px">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="form_editar_contraseña" action="" method="post">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-unlock-fill"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="oldpass" id="oldpass" aria-describedby="helpId" placeholder="Ingrese su contraseña" />
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-unlock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="newpass" id="newpass" aria-describedby="helpId" placeholder="Ingrese su contraseña" />
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Cambiar Avatar -->
<div class="modal fade" id="cambiar_avatar">
    <div class="modal-dialog">
        <div class="modal-content card-success">
            <div class="modal-header card-header bg-success">
                <h5 class="modal-title" id="staticBackdropLabel">Cambiar Avatar</h5>
            </div>
            <div class="modal-body p-0">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header text-center bg-success">
                        <h3 id="nombre_avatar" class="widget-user-usename"></h3>
                        <h3 id="apellidos_avatar" class="widget-user-desc"></h3>
                    </div>
                    <div class="widget-user-image text-center">
                        <img id="avatar_avatar" class="rounded-circle me-3 m-2"  width="180" src="" alt="">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="form_cambiar_avatar" action="" method="post" enctype="multipart/form-data">
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="avatar_usuario" id="avatar_usuario">
                                        <input type="hidden" class="form-control" name="funcion" id="funcion">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Vistas/Templates/Footer.php';
?>
<script src="/Sistema_Farmacia/js/Gestion_Perfil.js"></script>