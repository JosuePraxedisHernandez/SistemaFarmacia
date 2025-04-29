<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/Sistema_Farmacia/Vistas/Templates/Header.php';
?>
<title>Gestión Laboratorios | Sistema Farmacia</title>
<div class="content-wrapper" style="min-height: 1604.44px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión Laboratorios <button class="crear_laboratorio btn btn-primary" data-bs-toggle="modal" data-bs-target="#crear_laboratorio">Crear Laboratorio</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Gestión Laboratorios</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gestión Laboratorios</h3>
            </div>
            <div class="card-body">
                <table id="laboratorios" class="table table-hover" style="width:100%">
                    <thead class="bg-primary">
                        <tr>
                            <th widtg="100%">Laboratorios</th>
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
<!-- Modal Crear Laboratorio -->
<div class="modal fade" id="crear_laboratorio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Crear Laboratorio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-footer">
                    <form id="form_crear_laboratorio" action="" method="post">
                        <div class="form-group">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese el nombre del laboratorio" />
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
<div class="modal fade" id="editar_laboratorio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Laboratorio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header text-center bg-success">
                        <h3 id="nombre_laboratorio" class="widget-user-usename"></h3>
                    </div>
                    <div class="widget-user-image text-center">
						<img id="avatar-laboratorio" class="img-circle" src="" alt="" width="150px">
					</div>
                    <div class="card-footer">
                        <form id="form_editar_laboratorio" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_laboratorio" id="id_laboratorio">
                            <div class="form-group">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre_lab" id="nombre_lab" aria-describedby="helpId"/>
                            </div>
                            <div class="mb-3">
								<input type="file" class="form-control" name="avatar" id="avatar">
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
<script src="/Sistema_Farmacia/js/Gestion_Laboratorios.js"></script>