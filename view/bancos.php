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
        <!-- modal banco -->
        <div class="row">
            <div class="modal fade" id="modalCrudBanco" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="lblTitleCrud">
                                <i class="fa fa-user"></i> Registrar Banco
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="tile">
                                <div class="overlay p-5" id="divOverlayCliente">
                                    <div class="m-loader mr-4">
                                        <svg class="m-circular" viewBox="25 25 50 50">
                                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                        </svg>
                                    </div>
                                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayCliente">Cargando información...</h4>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Nombre de la cuenta <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <div class="input-group">
                                                <input id="txtNombre" class="form-control" type="text" placeholder="Ingrese el nombre de la cuenta" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Número de la cuenta</label>
                                            <div class="input-group">
                                                <input id="txtNumero" class="form-control" type="text" placeholder="Ingrese el número de cuenta" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Moneda <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <div class="input-group">
                                                <select class="form-control" id="cbMoneda">
                                                    <option value="">- Seleccione -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Saldo inicial <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <div class="input-group">
                                                <input id="txtSaldo" class="form-control" type="text" placeholder="Ingrese el saldo inicial" value="0" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <div class="input-group">
                                                <input id="txtDescripcion" class="form-control" type="text" placeholder="Ingrese alguna descripción" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label>Cuenta en Efectivo <input type="radio" id="rbEfectivo" name="forma" checked /></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label>Cuenta Bancaria <input type="radio" id="rbBancaria" name="forma" /></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label><input type="checkbox" id="cbMostrar" /> Mostrar cuenta en los reportes de comprobantes</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" modal-footer">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label class="form-text text-left text-danger">Los campos marcados con * son obligatorios</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-right">
                                    <button class="btn btn-success" type="button" id="btnSaveBanco"><i class="fa fa-save"></i> Guardar</button>
                                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Bancos <small>Lista</small></h1>
            </div>

            <div class="tile">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnAgregar">
                                <i class="fa fa-plus"></i>
                                Agregar
                            </button>
                            <button class="btn btn-secondary" id="btnReload">
                                <i class="fa fa-refresh"></i>
                                Recargar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <label>Buscar por el nombre del banco:</label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Ingrese los datos requeridos" class="input-primary" id="txtBuscar">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" id="btnBuscar">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-responsive">
                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                <thead class="table-header-background">
                                    <tr>
                                        <th style="width:5%">N°</th>
                                        <th style="width:15%">Nombre de la Cuenta</th>
                                        <th style="width:15%">Número de la Cuenta</th>
                                        <th style="width:10%">Descripción</th>
                                        <th style="width:10%">Tipo de Cuenta</th>
                                        <th style="width:10%">Mostrar Cuenta</th>
                                        <th style="width:10%">Saldo</th>
                                        <th style="width:5%">Editar</th>
                                        <th style="width:5%">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td colspan="8" class="text-center">!Aún no has registrado ningún banco¡</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12 text-center">
                        <label>Paginación</label>
                        <div class="form-group" id="ulPagination">
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();
            let state = false;
            let paginacion = 0;
            let opcion = 0;
            let totalPaginacion = 0;
            let filasPorPagina = 10;
            let tbody = $("#tbList");
            let ulPagination = $("#ulPagination");

            let idBanco = 0;
            let idUsuario = "<?= $_SESSION['IdEmpleado'] ?>";

            $(document).ready(function() {

                $("#btnAgregar").click(function() {
                    agregarBanco();
                });

                $("#btnAgregar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        agregarBanco();
                        event.preventDefault();
                    }
                });

                $("#btnReload").click(function() {
                    loadInitBancos();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode == 13) {
                        loadInitBancos();
                        event.preventDefault();
                    }
                });


                modalComponents();
                loadInitBancos();
            });

            function modalComponents() {
                $('#modalCrudBanco').on('shown.bs.modal', function() {
                    $("#txtNombre").focus();
                });

                $('#modalCrudBanco').on('hide.bs.modal', function() {
                    clearComponents();
                });

                $("#btnSaveBanco").click(function() {
                    modalCrudBanco();
                });

                tools.keyEnter($("#btnSaveBanco"), function() {
                    modalCrudBanco();
                });

                tools.keyNumberFloat($("#txtSaldo"));
            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillTableBancos("");
                        break;
                }
            }

            function loadInitBancos() {
                if (!state) {
                    paginacion = 1;
                    fillTableBancos("");
                    opcion = 0;
                }
            }

            async function fillTableBancos(buscar) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/BancoController.php", {
                        "type": "all",
                        "buscar": buscar,
                    }, function() {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="9"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        totalPaginacion = 0;
                        state = true;
                    });

                    tbody.empty();
                    if (result.length == 0) {
                        tbody.append('<tr><td class="text-center" colspan="9"><p>No hay bancos para mostrar.</p></td></tr>');
                        ulPagination.html(`
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-right"></i>
                            </button>`);
                        state = false;
                    } else {
                        for (let value of result) {
                            tbody.append(`<tr>
                                <td class="text-center">${value.Id}</td>
                                <td class="text-left">${value.NombreCuenta}</td>
                                <td class="text-left">${value.NumeroCuenta}</td>
                                <td class="text-left">${value.Descripcion}</td>
                                <td class="text-left">${value.FormaPago=="1"?"CUENTA EFECTIVO":"CUENTA BANCARIA"}</td>
                                <td class="text-left">${value.Mostrar=="1"?"EN REPORTES":"NO"}</td>
                                <td class="text-right">${value.Simbolo+" "+tools.formatMoney(value.SaldoInicial)}</td>
                                <td class="text-center"><button class="btn btn-warning" onclick="editarBanco('${value.IdBanco}')"><i class="fa fa-edit"></i></button></td>
                                <td class="text-center"><button class="btn btn-danger" onclick="removerBanco('${value.IdBanco}')"><i class="fa fa-trash"></i></button></td>
                                </tr>                                
                                `);
                        }
                        state = false;
                    }
                } catch (error) {
                    tbody.empty();
                    ulPagination.html(`
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-right"></i>
                            </button>`);
                    tbody.append('<tr><td class="text-center" colspan="9"><p>' + error.responseText + '</p></td></tr>');
                    state = false;
                }
            }

            function modalCrudBanco() {
                if ($("#txtNombre").val() == "") {
                    tools.AlertWarning("", "Ingrese el nombre de la cuenta.");
                    $("#txtNombre").focus();
                } else if (tools.validateComboBox($("#cbMoneda"))) {
                    tools.AlertWarning("", "Seleccione la moneda.");
                    $("#cbMoneda").focus();
                } else if (!tools.isNumeric($("#txtSaldo").val())) {
                    tools.AlertWarning("", "Ingrese el monto inicial.");
                    $("#txtSaldo").focus();
                } else {
                    tools.ModalDialog("Banco", '¿Está seguro de continuar?', async function(value) {
                        if (value == true) {
                            try {
                                let result = await tools.promiseFetchPost("../app/controller/BancoController.php", {
                                    "type": "crud",
                                    "IdBanco": idBanco,
                                    "IdUsuario": idUsuario,
                                    "NombreCuenta": $("#txtNombre").val().trim(),
                                    "NumeroCuenta": $("#txtNumero").val().trim(),
                                    "IdMoneda": $("#cbMoneda").val(),
                                    "SaldoInicial": $("#txtSaldo").val(),
                                    "Descripcion": $("#txtDescripcion").val().trim(),
                                    "FormaPago": $("#rbEfectivo").is(":checked") ? 1 : 2,
                                    "Mostrar": $("#cbMostrar").is(":checked")
                                }, function() {
                                    $("#modalCrudBanco").modal('hide');
                                    clearComponents();
                                    tools.ModalAlertInfo("Banco", "Procesando petición..");
                                });
                                tools.ModalAlertSuccess("Banco", result);
                                onEventPaginacion();
                            } catch (error) {
                                tools.ErrorMessageServer("Banco", error);
                            }
                        }
                    });
                }
            }

            async function agregarBanco(id) {
                try {
                    $("#modalCrudBanco").modal('show');
                    $("#lblTitleCrud").html('<i class="fa fa-user"></i> Agregar Banco');
                    let moneda = await tools.promiseFetchGet("../app/controller/MonedaController.php", {
                        "type": "getmonedacombobox"
                    }, function() {
                        $("#cbMoneda").empty();
                    });

                    $("#cbMoneda").append('<option value="">- Seleccione -</option>');
                    for (let value of moneda) {
                        $("#cbMoneda").append('<option value="' + value.IdMoneda + '">' + value.Nombre + '</option>');
                    }

                    $("#divOverlayCliente").addClass('d-none');
                } catch (error) {
                    $("#cbMoneda").append('<option value="">- Seleccione -</option>');
                    $("#lblTextOverlayCliente").html("Se produjo un error interno, intente nuevamente por favor.");
                }
            }

            async function editarBanco(id) {
                try {
                    $("#modalCrudBanco").modal('show');
                    $("#lblTitleCrud").html('<i class="fa fa-user"></i> Editar Banco');
                    let moneda = await tools.promiseFetchGet("../app/controller/MonedaController.php", {
                        "type": "getmonedacombobox"
                    }, function() {
                        $("#cbMoneda").empty();
                    });

                    let banco = await tools.promiseFetchGet("../app/controller/BancoController.php", {
                        "type": "getid",
                        "idBanco": id
                    });

                    $("#cbMoneda").append('<option value="">- Seleccione -</option>');
                    for (let value of moneda) {
                        $("#cbMoneda").append('<option value="' + value.IdMoneda + '">' + value.Nombre + '</option>');
                    }

                    idBanco = id;
                    $("#txtNombre").val(banco.NombreCuenta);
                    $("#txtNumero").val(banco.NumeroCuenta);
                    $("#cbMoneda").val(banco.IdMoneda);
                    $("#txtSaldo").val(banco.SaldoInicial);
                    $("#txtDescripcion").val(banco.Descripcion);
                    if (banco.FormaPago == "1") {
                        $("#rbEfectivo").prop("checked", true);
                    } else {
                        $("#rbBancaria").prop("checked", true);
                    }
                    $("#cbMostrar").prop("checked", banco.Mostrar == "1" ? true : false);

                    if (parseFloat(banco.SaldoInicial) > 0) {
                        $("#cbMoneda").prop("disabled", true);
                        $("#txtSaldo").prop("disabled", true);
                        $("#rbEfectivo").prop("disabled", true);
                        $("#rbBancaria").prop("disabled", true);
                    }

                    $("#divOverlayCliente").addClass('d-none');
                } catch (error) {
                    $("#cbMoneda").append('<option value="">- Seleccione -</option>');
                    $("#lblTextOverlayCliente").html("Se produjo un error interno, intente nuevamente por favor.");
                }
            }

            function removerBanco(id) {
                tools.ModalDialog("Banco", '¿Está seguro de eliminar la cuenta?', async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchPost("../app/controller/BancoController.php", {
                                "type": "delete",
                                "IdBanco": id
                            }, function() {
                                tools.ModalAlertInfo("Banco", "Procesando petición..");
                            });
                            tools.ModalAlertSuccess("Banco", result);
                            onEventPaginacion();
                        } catch (error) {
                            tools.ErrorMessageServer("Banco", error);
                        }
                    }
                });
            }

            function clearComponents() {
                $("#lblTitleCrud").empty();
                $("#txtNombre").val('');
                $("#txtNumero").val('');
                $("#cbMoneda").empty();
                $("#txtSaldo").val('0');
                $("#txtDescripcion").val('');
                $("#rbEfectivo").prop("checked", true);
                $("#cbMostrar").prop("checked", false);

                $("#cbMoneda").prop("disabled", false);
                $("#txtSaldo").prop("disabled", false);
                $("#rbEfectivo").prop("disabled", false);
                $("#rbBancaria").prop("disabled", false);
                idBanco = 0;
            }
        </script>
    </body>

    </html>

<?php

}
