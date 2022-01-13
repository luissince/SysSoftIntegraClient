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

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Consultar Estado <small>Consulta</small></h1>
            </div>

            <div class="tile">

                <div class="overlay" id="divOverlayInformacion">
                    <div class="m-loader mr-4">
                        <svg class="m-circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                        </svg>
                    </div>
                    <h4 class="l-text text-white" id="lblTextOverlayInformacion">Cargando información...</h4>
                </div>

                <div class="tile-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4>Credenciales </h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4>Datos del Comprobante </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Ruc: </label>
                            <div class="form-group">
                                <input id="txtRuc" class="form-control" type="text" placeholder="Ingrese su RUC">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Ruc Emisor: </label>
                            <div class="form-group">
                                <input id="txtRucEmision" class="form-control" type="text" placeholder="Ingrese RUC">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>usuario: </label>
                            <div class="form-group">
                                <input id="txtUsuario" class="form-control" type="text" placeholder="Ingrese su Usuario">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Tipo: </label>
                            <div class="form-group">
                                <select id="txtTipo" class="form-control">
                                    <option value=""> -- Seleccione -- </option>
                                    <option value="01">01 - Factura</option>
                                    <option value="03">03 - Boleta De Venta</option>
                                    <option value="07">07 - Nota de Crédito</option>
                                    <option value="08">08 - Nota de Débito</option>
                                    <option value="R1">R1 - Recibo por Honorarios</option>
                                    <option value="R7">R7 - Nota Crédito Recibo por Honorarios </option>
                                    <option value="04">04 - Liquidación de Compra</option>
                                    <option value="23">23 - Póliza de Adjudicación Electrónica</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Contraseña: </label>
                            <div class="form-group">
                                <input id="txtClave" class="form-control" type="password" placeholder="Ingrese Contraseña">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Serie: </label>
                            <div class="form-group">
                                <input id="txtSerie" class="form-control" type="text" placeholder="F001 / B001 / etc" maxlength="4">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <label>Correlativo: </label>
                            <div class="form-group">
                                <input id="txtCorrelativo" class="form-control" type="number" placeholder="ingrese correlativo (1,2,3...)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button class="btn btn-success" id="consultarEstado"> Consultar Estado </button>
                                <!-- <button class="btn btn-primary" id="consultarCdr"> Consultar CDR </button> -->
                                <button class="btn btn-danger" id="limpiarConsulta"> Limpiar </button>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h4>Resultado</h4>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label>Codigo:</label>
                            <label class="badge badge-light" id="lblCodigo"></label>
                        </div>

                        <div class="col-md-12">
                            <label>Respuesta:</label>
                            <label class="badge badge-light" id="lblRespuesta"></label>

                        </div>
                    </div>
                </div>

            </div>
        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();

            $(document).ready(function() {
                loadInitConsultaAvanzada();

                $("#limpiarConsulta").click(function() {
                    limpiarResponse();
                });

                $("#limpiarConsulta").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        limpiarResponse();
                    }
                });

                $("#consultarEstado").click(function() {
                    validateFields("");
                });

                $("#consultarEstado").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        validateFields("");
                    }
                });

                $("#consultarCdr").click(function() {
                    validateFields("cdr");
                });

                $("#consultarCdr").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        validateFields("cdr");
                    }
                });
            });

            async function loadInitConsultaAvanzada() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/EmpresaController.php", {
                        "type": "getempresa"
                    });

                    $("#txtRuc").val(result.NumeroDocumento);
                    $("#txtUsuario").val(result.UsuarioSol);
                    $("#txtClave").val(result.ClaveSol);
                    $("#txtRucEmision").val(result.NumeroDocumento);
                    $("#divOverlayInformacion").addClass("d-none");
                } catch (error) {
                    console.log(error);
                    $("#lblTextOverlayInformacion").html("Se produjo un error interno, recargue la pagina por favor.");
                }
            }

            function validateFields(cdr) {
                if ($("#txtRuc").val() == '' || $("#txtRuc").val().length != 11) {
                    tools.AlertWarning("Advertencia", "ingrese un RUC válido.");
                    $("#txtRuc").focus();
                } else if ($("#txtUsuario").val() == '' || $("#txtUsuario").val().length == 0) {
                    tools.AlertWarning("Advertencia", "El campo usuario es requerido.");
                    $("#txtUsuario").focus();
                } else if ($("#txtClave").val() == '' || $("#txtClave").val().length == 0) {
                    tools.AlertWarning("Advertencia", "El campo contraseña es requerido.");
                    $("#txtClave").focus();
                } else if ($("#txtRucEmision").val() == '' || $("#txtRucEmision").val().length != 11) {
                    tools.AlertWarning("Advertencia", "Ingrese un RUC de Emision Válido.");
                    $("#txtRucEmision").focus();
                } else if ($("#txtTipo").val() == '') {
                    tools.AlertWarning("Advertencia", "Seleccione tipo de documento.");
                    $("#txtTipo").focus();
                } else if ($('#txtSerie').val() == '' || $("#txtSerie").val().length == 0) {
                    tools.AlertWarning("Advertencia", "Ingrese una serie correcta.");
                    $("#txtSerie").focus();
                } else if ($('#txtCorrelativo').val() == '' || $("#txtCorrelativo").val().length == 0) {
                    tools.AlertWarning("Advertencia", "Ingrese un correlativo.");
                    $("#txtCorrelativo").focus();
                } else {
                    consultarCdr(cdr);
                }
            }

            function consultarCdr(cdr) {
                $.ajax({
                    url: "../app/examples/pages/cdrStatus.php",
                    method: "GET",
                    data: {
                        rucSol: $("#txtRuc").val(),
                        userSol: $("#txtUsuario").val(),
                        passSol: $("#txtClave").val(),
                        ruc: $("#txtRucEmision").val(),
                        tipo: $("#txtTipo").val(),
                        serie: $('#txtSerie').val().toUpperCase(),
                        numero: $('#txtCorrelativo').val(),
                        cdr: cdr
                    },
                    beforeSend: function() {
                        tools.ModalAlertInfo("Consultar Comprobante", "Procesando petición..");
                    },
                    success: function(result) {
                        if (result.state === true) {
                            if (result.accepted === true) {
                                tools.ModalAlertSuccess("Consultar Comprobante", "Resultado: Código " + result.code + " " + result.message);
                            } else {
                                tools.ModalAlertWarning("Consultar Comprobante", "Resultado: Código " + result.code + " " + result.message);
                            }
                        } else {
                            tools.ModalAlertWarning("Consultar Comprobante", "Resultado: Código " + result.code + " " + result.message);
                        }
                        $("#lblCodigo").html(result.code);
                        $("#lblRespuesta").html(result.message);
                    },
                    error: function(error) {
                        tools.ModalAlertError("Consultar Comprobante", "Error en el momento de obtener el xml: " + error.responseText);
                    }
                });
            }

            function limpiarResponse() {
                $("#txtTipo").val('');
                $('#txtSerie').val('');
                $('#txtCorrelativo').val('');
                $("#txtTipo").focus();
                $("#lblCodigo").html('');
                $("#lblRespuesta").html('');
            }
        </script>
    </body>

    </html>

<?php

}
