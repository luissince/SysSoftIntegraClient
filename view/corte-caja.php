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

        <!-- modal proceso corte de caja -->
        <div class="row">
            <div class="modal fade" id="modalProcesoCorteCaja" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-fax"></i> Corte de caja
                            </h4>
                            <button type="button" class="close" id="btnCloseModalProcesoCorteCaja">
                                <i class="fa fa-window-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><strong>Cerrar turno</strong></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group text-right">
                                        <label><strong>2021-09-03 09:30 PM</strong></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>VALOR REAL EN CAJA <i class="fa fa-info-circle text-danger"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group text-right">
                                        <input id="txtValorRealCorteCaja" type="text" class="form-control text-right" placeholder="00.00">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>VALOR REAL EN TARJETA </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group text-right">
                                        <label><strong>00.00</strong></label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Realizar movimiento a las siguientes cuentas:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Cuenta efectivo <i class="fa fa-info-circle text-danger"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group text-right">
                                        <select id="cbxCuentaEfectivoCorteCaja" class="form-control">
                                            <option value="">--selected--</option>
                                            <option value="1">OPCIÓN 1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Cuenta bancaria</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group text-right">
                                        <select id="cbxCuentaBancariaCorteCaja" class="form-control">
                                            <option value="">--selected--</option>
                                            <option value="1">OPCIÓN 1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label class="text-danger">Todos los campos marcados con <i class="fa fa-info-circle"></i> son necesarios rellenar.</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="text-right">
                                        <div class="form-group">
                                            <button id="btnAceptarProcesoCorteCaja" class="btn btn-info" type="button" title="Aceptar"><i class="fa fa-save"></i> Aceptar</button>
                                            <!-- <button id="btnCancelarProcesoCorteCaja" class="btn btn-danger" type="button" title="Cancelar"><i class="fa fa-close"></i> Cancelar</button> -->
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
                <h1><i class="fa fa-fax"></i> Corte de Caja</h1>
            </div>

            <div class="tile mb-4">

                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button id="btnRealizarCorte" class="btn btn-primary" title="Realizar Corte">
                                <i class="fa fa-scissors"></i> Realizar Corte
                            </button>
                            <button id="btnTerminarCerrar" class="btn btn-success" title="Terminar turno y cerrar caja" disabled>
                                <i class="fa fa-save"></i> Terminar turno y Cerrar caja
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Inicio de turno </label>
                            <label class="form-control">00/00/000 - 0:00<label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Base </label>
                            <label class="form-control">M 00.00<label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Ventas </label>
                            <label class="form-control">M 00.00<label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label><strong><i class="fa fa-folder-open-o"></i> Dinero recibido:</strong><label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group pl-2">
                                    <label><i class="fa fa-arrow-right"></i> Monto Base<label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group text-right">
                                    <label>M 00.00<label>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group pl-2">
                                    <label><i class="fa fa-arrow-right"></i> Ventas en efectivo<label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group text-right">
                                    <label>M 00.00<label>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group pl-2">
                                    <label><i class="fa fa-arrow-right"></i> Ventas con tarjeta<label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group text-right">
                                    <label>M 00.00<label>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group pl-2">
                                    <label><i class="fa fa-arrow-right"></i> Ingrese de efectivo<label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group text-right">
                                    <label>M 00.00<label>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group pl-2">
                                    <label><i class="fa fa-arrow-right"></i> Salidas de efectivo<label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group text-right">
                                    <label>M 00.00<label>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label><strong><i class="fa fa-money"></i> Total</strong><label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group text-right">
                            <label><strong>M 00.00</strong><label>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools()

            let btnRealizarCorte = $("#btnRealizarCorte")
            let btnTerminarCerrar = $("#btnTerminarCerrar")

            let modalProcesoCorteCaja = $("#modalProcesoCorteCaja")
            let btnCloseModalProcesoCorteCaja = $("#btnCloseModalProcesoCorteCaja")
            let btnCancelarProcesoCorteCaja = $("#btnCancelarProcesoCorteCaja")

            let txtValorRealCorteCaja = $("#txtValorRealCorteCaja")
            let cbxCuentaEfectivoCorteCaja = document.getElementById("cbxCuentaEfectivoCorteCaja")
            let cbxCuentaBancariaCorteCaja = document.getElementById("cbxCuentaBancariaCorteCaja")


            $(document).ready(function() {

                btnRealizarCorte.click(function() {
                    btnTerminarCerrar.attr("disabled", false)
                    // modalProcesoCliente.modal('show')
                })

                btnTerminarCerrar.click(function() {
                    modalProcesoCorteCaja.modal('show')
                })

                modalProcesoCorteCaja.on("shown.bs.modal", function(e) {
                    txtValorRealCorteCaja.focus()
                })

                btnCloseModalProcesoCorteCaja.click(function() {
                    modalProcesoCorteCaja.modal('hide')
                    clearModalProcesoCorteCaja()
                })

                btnCancelarProcesoCorteCaja.click(function() {
                    modalProcesoCorteCaja.modal('hide')
                    clearModalProcesoCorteCaja()
                })


            })

            function clearModalProcesoCorteCaja() {
                
                txtValorRealCorteCaja.val('')
                cbxCuentaEfectivoCorteCaja.selectedIndex = '0'
                cbxCuentaBancariaCorteCaja.selectedIndex = '0'
            }
        </script>
    </body>

    </html>

<?php

}
