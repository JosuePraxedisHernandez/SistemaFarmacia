<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Vistas/Templates/Header.php';
?>
<title>Gestión Clientes | Sistema Farmacia</title>
<div class="content-wrapper" style="min-height: 1604.44px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión Clientes <button class="crear_cliente btn btn-primary" data-bs-toggle="modal" data-bs-target="#crear_cliente">Crear Cliente</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Gestión Clientes</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gestión Clientes</h3>
            </div>
            <div class="card-body">
                <table id="clientes" class="table table-hover" style="width:100%">
                    <thead class="bg-primary">
                        <tr>
                            <th widtg="100%">Clientes</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
</div>
<!-- Modal Crear Cliente -->
<div class="modal fade" id="crear_cliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Crear Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-footer">
                    <form id="form_crear_cliente" action="" method="post">
                        <label for="" class="form-label">No. Cliente</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="no_cliente" id="no_cliente" aria-describedby="helpId" placeholder="Ingrese su numero de cliente" />
                            <div class="input-group-prepend">
                                <button class="generar_codigo btn btn-secondary">Generar Codigo</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese el nombre del cliente" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" aria-describedby="helpId" placeholder="Ingrese el apellido paterno del cliente" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" aria-describedby="helpId" placeholder="Ingrese el apellido materno del cliente" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Correo Electronico</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Ingrese el coreo electronico del cliente" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Ingrese el telefono del cliente" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Ingrese la direccion del cliente" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Sexo</label>
                            <input type="text" class="form-control" name="sexo" id="sexo" aria-describedby="helpId" placeholder="Ingrese el sexo del cliente" />
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
<!-- Modal Editar Cliente -->
<div class="modal fade" id="editar_cliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Datos Personales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header text-center bg-success">
                        <h3 id="nombre_cliente" class="widget-user-usename"></h3>
                        <h3 id="apellidos_cliente" class="widget-user-desc"></h3>
                    </div>
                    <div class="card-footer">
                        <form id="form_editar_cliente" action="" method="post">
                            <input type="hidden" name="id_cliente_edit" id="id_cliente_edit">
                            <div class="form-group">
                                <label for="" class="form-label">No. Cliente</label>
                                <input type="email" class="form-control" name="no_edit" id="no_edit" aria-describedby="helpId" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Correo Electronico</label>
                                <input type="email" class="form-control" name="email_edit" id="email_edit" aria-describedby="helpId"/>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono_edit" id="telefono_edit" aria-describedby="helpId" placeholder="Ingrese el telefono del cliente" />
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="direccion_edit" id="direccion_edit" aria-describedby="helpId" placeholder="Ingrese la direccion del cliente" />
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Sexo</label>
                                <input type="text" class="form-control" name="sexo_edit" id="sexo_edit" aria-describedby="helpId" placeholder="Ingrese el sexo del cliente" />
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

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Vistas/Templates/Footer.php';
?>
<script src="/Sistema_Farmacia/js/Gestion_Clientes.js"></script>