<?php
session_start();
if (!isset($_SESSION['IdEmpleado'])) {
    echo '<script>location.href = "login.php";</script>';
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include './layout/head.php'; ?>
    </head>

    <body class="app sidebar-mini">
        <!-- Navbar-->
        <?php include "./layout/header.php"; ?>
        <!-- Sidebar menu-->
        <?php include "./layout/menu.php"; ?>

        <!-- modal proceso almacen -->
        <div class="row">
            <div class="modal fade" id="modalProcesoAlmacen" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-cubes"></i> Nuevo/Editar almacen
                            </h4>
                            <button type="button" class="close" id="btnCloseModalProcesoAlmacen">
                                <i class="fa fa-window-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Nombre <i class="fa fa-info-circle text-danger"></i></label>
                                        <input id="txtNombreAlmacen" type="text" class="form-control" placeholder="Ingrese el nombre del almacen">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Ubigeo <i class="fa fa-info-circle text-danger"></i></label>
                                        <select id="cbxUbigeoAlmacen" class="form-control">
                                            <option value="">--selected--</option>
                                            <option value="1">OPCIÓN 1</option>
                                            <option value="2">OPCIÓN 2</option>
                                            <option value="3">OPCIÓN 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Dirección </label>
                                        <input id="txtDireccionAlmacen" type="text" class="form-control" placeholder="Ingrese la dirección del almacen">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <button id="btnAceptarProcesoAlmacen" class="btn btn-info" type="button" title="Aceptar"><i class="fa fa-save"></i> Aceptar</button>
                                            <button id="btnCancelarProcesoAlmacen" class="btn btn-danger" type="button" title="Cancelar"><i class="fa fa-close"></i> Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-cubes"></i> Almacenes</h1>
            </div>

            <div class="tile mb-4">

                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button id="btnNuevoAlmacen" class="btn btn-success" title="Nuevo almacen">
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                            <button id="btnRecargarAlmacen" class="btn btn-secondary" title="Recargar lista de almacenes">
                                <i class="fa fa-refresh"></i> Recargar
                            </button>
                            <button id="btnEliminarAlmacen" class="btn btn-secondary" title="Eliminar almacen">
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Buscar nombre de almacen </label>
                            <input id="txtSearchAlmacen" type="search" class="form-control" placeholder="Buscar...">
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                <thead style="background-color: #0766cc;color: white;">
                                    <tr>
                                        <th class="sorting" style="width: 10%;">N°</th>
                                        <th class="sorting" style="width: 15%;">Fecha</th>
                                        <th class="sorting" style="width: 20%;">Nombre</th>
                                        <th class="sorting" style="width: 20%;">Ubigeo</th>
                                        <th class="sorting" style="width: 25%;">Dirección</th>
                                        <th class="sorting" style="width: 10%;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbListAlmacenes">
                                    <tr>
                                        <td class="text-center" colspan="6">Tabla sin contenido</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="text-right">
                            <div class="form-group">
                                <button id="btnAnteriorAlmacen" class="btn btn-info" title="Anterior">
                                    <i class="fa fa-arrow-circle-left"></i>
                                </button>
                                <span id="lblPaginaActualAlmacen" class="m-2">0
                                </span>
                                <span class="m-2">
                                    de
                                </span>
                                <span id="lblPaginaSiguienteAlmacen" class="m-2">0
                                </span>
                                <button id="btnSiguienteAlmacen" class="btn btn-info" title="Siguiente">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools()

            let btnNuevoAlmacen = $("#btnNuevoAlmacen")
            let modalProcesoAlmacen = $("#modalProcesoAlmacen")
            let btnCloseModalProcesoAlmacen = $("#btnCloseModalProcesoAlmacen")
            let btnCancelarProcesoAlmacen = $("#btnCancelarProcesoAlmacen")

            let txtNombreAlmacen = $("#txtNombreAlmacen")
            let txtDireccionAlmacen= $("#txtDireccionAlmacen")

            $(document).ready(function() {

                btnNuevoAlmacen.click(function() {
                    modalProcesoAlmacen.modal('show')
                })

                modalProcesoAlmacen.on("shown.bs.modal", function(e) {
                    txtNombreAlmacen.focus()
                })

                btnCloseModalProcesoAlmacen.click(function() {
                    modalProcesoAlmacen.modal('hide')
                    clearModalProcesoAlmacen()
                })

                btnCancelarProcesoAlmacen.click(function() {
                    modalProcesoAlmacen.modal('hide')
                    clearModalProcesoAlmacen()
                })


            })

            function clearModalProcesoAlmacen() {
                document.getElementById('cbxUbigeoAlmacen').selectedIndex = "0"
                txtNombreAlmacen.val('')
                txtDireccionAlmacen.val('')
            }
        </script>
    </body>

    </html>

<?php

}
