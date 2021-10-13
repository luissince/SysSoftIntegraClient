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

        <!-- modal proceso comprobante -->
        <div class="row">
            <div class="modal fade" id="modalProcesoComprobante" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-file-archive-o"></i> Nuevo/Editar comprobante
                            </h4>
                            <button type="button" class="close" id="btnCloseModalProcesoComprobante">
                                <i class="fa fa-window-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Nombre del comprobante <i class="fa fa-info-circle text-danger"></i></label>
                                        <input id="txtNombreComprobante" type="text" class="form-control" placeholder="Ingrese el nombre de comprobante">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Codigo alterno </label>
                                        <input id="txtCodigoAlternoComprobante" type="text" class="form-control" placeholder="Ingrese el codigo alterno de comprobante">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Serie <i class="fa fa-info-circle text-danger"></i></label>
                                        <input id="txtSerieComprobante" type="text" class="form-control" placeholder="Ingrese la serie de comprobante">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Numeración <i class="fa fa-info-circle text-danger"></i></label>
                                        <input id="txtNumeracionComprobante" type="text" class="form-control" placeholder="Ingrese la numeración de comprobante">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Comprobante para guía de remisión </label>
                                        <div>
                                            <input id="ckbComprobanteGuia" type="checkbox"><span> No</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Comprobate facturado </label>
                                        <div>
                                            <input id="ckbComprobanteFacturado"  type="checkbox"><span> No</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Comprobante para nota de crédito </label>
                                        <div>
                                            <input id="ckbComprobanteNotaCred" type="checkbox"><span> No</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="text-danger">Nota: La numeración prodra ser actualizada mientras no se realiza una operación. </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <button id="btnAceptarProcesoComprobante" class="btn btn-info" type="button" title="Aceptar"><i class="fa fa-save"></i> Aceptar</button>
                                            <button id="btnCancelarProcesoComprobante" class="btn btn-danger" type="button" title="Cancelar"><i class="fa fa-close"></i> Cancelar</button>
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
                <h1><i class="fa fa-file-archive-o"></i> Comprobantes</h1>
            </div>

            <div class="tile mb-4">

                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button id="btnNuevoComprobante" class="btn btn-success" title="Nuevo comprobante">
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                            <button id="btnRecargarComprobante" class="btn btn-secondary" title="Recargar lista de comprobante">
                                <i class="fa fa-refresh"></i> Recargar
                            </button>
                            <button id="btnEliminarComprobante" class="btn btn-secondary" title="Eliminar comprobante">
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="form-label">Tipo de comprobante predeterminado: <strong>TIKET</strong></label>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                <thead style="background-color: #0766cc;color: white;">
                                    <tr>
                                        <th class="sorting" style="width: 10%;">N°</th>
                                        <th class="sorting" style="width: 40%;">Tipo de comprobante</th>
                                        <th class="sorting" style="width: 10%;">Serie</th>
                                        <th class="sorting" style="width: 10%;">Numeración</th>
                                        <th class="sorting" style="width: 10%;">Destino</th>
                                        <th class="sorting" style="width: 10%;">Predeterminado</th>
                                        <th class="sorting" style="width: 10%;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbListComprobantes">
                                    <tr>
                                        <td class="text-center" colspan="7">Tabla sin contenido</td>
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

            let btnNuevoComprobante = $("#btnNuevoComprobante")
            let modalProcesoComprobante = $("#modalProcesoComprobante")
            let btnCloseModalProcesoComprobante = $("#btnCloseModalProcesoComprobante")
            let btnCancelarProcesoComprobante = $("#btnCancelarProcesoComprobante")

            let txtNombreComprobante = $("#txtNombreComprobante")
            let txtCodigoAlternoComprobante= $("#txtCodigoAlternoComprobante")
            let txtSerieComprobante = $("#txtSerieComprobante")
            let txtNumeracionComprobante = $("#txtNumeracionComprobante")
            let ckbComprobanteGuia =  document.getElementById("ckbComprobanteGuia")
            let ckbComprobanteFacturado = document.getElementById("ckbComprobanteFacturado")
            let ckbComprobanteNotaCred = document.getElementById("ckbComprobanteNotaCred")

            $(document).ready(function() {

                btnNuevoComprobante.click(function() {
                    modalProcesoComprobante.modal('show')
                })

                modalProcesoComprobante.on("shown.bs.modal", function(e) {
                    txtNombreComprobante.focus()
                })

                btnCloseModalProcesoComprobante.click(function() {
                    modalProcesoComprobante.modal('hide')
                    clearModalProcesoComprobante()
                })

                btnCancelarProcesoComprobante.click(function() {
                    modalProcesoComprobante.modal('hide')
                    clearModalProcesoComprobante()
                })


            })

            function clearModalProcesoComprobante() {
                txtNombreComprobante.val('')
                txtCodigoAlternoComprobante.val('')
                txtSerieComprobante.val('')
                txtNumeracionComprobante.val('')
                ckbComprobanteGuia.checked = false
                ckbComprobanteFacturado.checked = false
                ckbComprobanteNotaCred.checked = false

            }
        </script>
    </body>

    </html>

<?php

}
