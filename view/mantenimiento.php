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

        <!-- modal items -->
        <div class="row">
            <div class="modal fade" id="modalDetalle" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-cube"></i> Agregar detalles del item
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="fa fa-window-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Código: </label>
                                        <input id="txtCodigo" type="text" class="form-control" placeholder="Ingrese el código" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Código Auxiliar: </label>
                                        <input id="txtCodAuxiliar" type="text" class="form-control" placeholder="Ingrese el código auxiliar">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Nombre: <i class="fa fa-info-circle text-danger"></i></label>
                                        <input id="txtNombre" type="text" class="form-control" placeholder="Ingrese el nombre">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Descripción: </label>
                                        <textarea id="txtDescripcion" class="form-control" placeholder="Ingrese una descripción"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Estado: </label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input type="radio" id="rbActivo" name="tbEstado" checked="">
                                                <label for="rbActivo">
                                                    Activo
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input type="radio" id="tbDesactivo" name="tbEstado">
                                                <label for="tbDesactivo" class="radio-custom-label">
                                                    Inactivo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btnCrudDetalle">
                                <i class="fa fa-save"></i> Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-close"></i> Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-fa-window-maximize"></i> Mantenimiento de los detalles basicos</h1>
            </div>

            <div class="tile mb-4">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnAgregar">
                                <i class="fa fa-plus"></i>
                                Agregar
                            </button>
                            <button class="btn btn-secondary" id="btnRecargar">
                                <i class="fa fa-refresh"></i>
                                Recargar
                            </button>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <label> Items <span id="lblMantenimiento"></span></label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" id="txtBuscarTable" placeholder="Buscar..." />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col" class="th-porcent-5">N°</th>
                                        <th scope="col" class="th-porcent-15">Nombre</th>
                                        <th scope="col" class="th-porcent-5">Opción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbListMantenimiento">
                                    <tr>
                                        <td class="text-center" colspan="3">No hay datos para mostrar</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <label> Ingrese el nombre del detalle <span id="lblDetalle"></span></label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" id="txtBuscarDetalle" placeholder="Buscar..." />
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-header-background">
                                    <tr>
                                        <th scope="col" width="5%">N°</th>
                                        <th scope="col" width="10%">Codigo Aux.</th>
                                        <th scope="col" width="15%">Nombre</th>
                                        <th scope="col" width="15%">Descripción</th>
                                        <th scope="col" width="5%">Estado</th>
                                        <th scope="col" width="5%">Editar</th>
                                        <th scope="col" width="5%">Quitar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbListDetalle">
                                    <tr>
                                        <td class="text-center" colspan="7">No hay datos para mostrar</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <label> Las opciones del detalle están en el panel de los botones.</label>
                    </div>
                </div>

            </div>
        </main>

        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();

            let btnSelect = undefined;
            let idMantenimiento = "";
            let idDetalle = "";

            let idEmpleado = "<?= $_SESSION['IdEmpleado'] ?>";

            // let state = false;
            // let paginacion = 0;
            // let opcion = 0;
            // let totalPaginacion = 0;
            // let filasPorPagina = 10;

            $(document).ready(function() {
                $("#btnAgregar").click(function() {
                    addDetalleModal();
                });

                tools.keyEnter($("#btnAgregar"), function() {
                    addDetalleModal();
                });

                $("#btnRecargar").click(function() {
                    recargarVista();
                });

                tools.keyEnter($("#btnRecargar"), function() {
                    recargarVista();
                });

                $("#txtBuscarDetalle").keyup(function(event) {
                    let value = $("#txtBuscarDetalle").val();
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (value.trim().length != 0) {
                            detalleBuscar(value);
                        }
                    }
                });

                modalComponents();
                loadListaMantenimiento();
            });

            function modalComponents() {
                $("#modalDetalle").on("shown.bs.modal", function() {
                    $("#txtNombre").focus();
                });

                $("#modalDetalle").on("hide.bs.modal", function() {
                    clearComponents();
                });

                $("#btnCrudDetalle").click(function() {
                    crudDetalle();
                });

                tools.keyEnter($("#btnCrudDetalle"), function() {
                    crudDetalle();
                });
            }

            async function loadListaMantenimiento() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "listmantenimiento",
                        "value": ""
                    }, function() {
                        tools.loadTable($("#tbListMantenimiento"), 3);
                    });

                    $("#tbListMantenimiento").empty();
                    if (result.length == 0) {
                        tools.loadTableMessage($("#tbListMantenimiento"), "No hay datos para mostrar.", 3);
                    } else {
                        let count = 0;
                        for (let mantenimiento of result) {
                            count++;
                            $("#tbListMantenimiento").append(`<tr>
                            <td>${count}</td>
                            <td>${mantenimiento.Nombre}</td>
                            <td><button class="btn btn-info" id="btn${mantenimiento.IdMantenimiento}" onclick="loadListaDetalle('${mantenimiento.IdMantenimiento}','','${'('+mantenimiento.Nombre+')'}')"><i class="fa fa-external-link-square "></i></button></td>
                            </tr>`);
                        }
                    }
                } catch (error) {
                    $("#tbListMantenimiento").empty();
                    tools.loadTableMessage($("#tbListMantenimiento"), tools.messageError(error), 3);
                }
            }

            async function loadListaDetalle(id, search, nombre) {
                idMantenimiento = id;
                if (btnSelect !== undefined) {
                    btnSelect.removeClass().addClass("btn btn-info");
                }
                btnSelect = $("#btn" + idMantenimiento);

                $("#lblMantenimiento").html(nombre);
                $("#lblMantenimiento").addClass("text-danger");

                $("#lblDetalle").html(nombre);
                $("#lblDetalle").addClass("text-danger");

                $("#btn" + idMantenimiento).removeClass("btn-info").addClass("btn-danger");
                $("#txtCodigo").val(idMantenimiento);

                detalleBuscar(search);
            }

            async function detalleBuscar(search) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "listdetalle",
                        "idMantenimiento": idMantenimiento,
                        "search": search
                    }, function() {
                        tools.loadTable($("#tbListDetalle"), 7);
                    });

                    $("#tbListDetalle").empty();
                    if (result.length == 0) {
                        tools.loadTableMessage($("#tbListDetalle"), "No hay datos para mostrar.", 7);
                    } else {
                        let count = 0;
                        for (let detalle of result) {
                            count++;
                            $("#tbListDetalle").append(`<tr>
                            <td class="text-center">${count}</td>
                            <td>${detalle.IdAuxiliar}</td>
                            <td>${detalle.Nombre}</td>
                            <td>${detalle.Descripcion}</td>
                            <td class="text-center">${detalle.Estado=="1"?"ACTIVO":"INACTIVO"}</td>
                            <td class="text-center"><button class="btn btn-warning" onclick="editDetalleModal('${detalle.IdDetalle}','${detalle.IdAuxiliar}','${detalle.Nombre}','${detalle.Descripcion}','${detalle.Estado}')"><i class="fa fa-edit"></i></button></td>
                            <td class="text-center"><button class="btn btn-danger" onclick="removeDetalleModal('${detalle.IdDetalle}')"><i class="fa fa-trash"></i></button></td>
                            </tr>`);

                        }
                    }
                } catch (error) {
                    $("#tbListDetalle").empty();
                    tools.loadTableMessage($("#tbListDetalle"), tools.messageError(error), 7);
                }
            }

            function addDetalleModal() {
                if (idMantenimiento == "") {
                    tools.AlertWarning("", "Selecciona un item para agregar un detalle.");
                } else {
                    $("#modalDetalle").modal("show");
                }
            }

            function editDetalleModal(id, idAuxiliar, nombre, description, estado) {
                $("#modalDetalle").modal("show");
                idDetalle = id;
                $("#txtCodAuxiliar").val(idAuxiliar);
                $("#txtNombre").val(nombre);
                $("#txtDescripcion").val(description);
                $("#rbActivo").prop('checked', estado == "1" ? true : false);
            }

            function removeDetalleModal(id) {
                if (idMantenimiento == "") {
                    tools.AlertWarning("", "Selecciona un item para agregar un detalle.");
                } else {
                    tools.ModalDialog("Detalle", "¿Está seguro de quitar el detalle?", async function(value) {
                        if (value == true) {
                            try {
                                let result = await tools.promiseFetchPost("../app/controller/DetalleController.php", {
                                    "type": "delete",
                                    "IdDetalle": id,
                                    "IdMantenimiento": idMantenimiento,
                                }, function() {
                                    $("#modalDetalle").modal("hide");
                                    clearComponents();
                                    tools.ModalAlertInfo("Detalle", "Se está procesando la información.");
                                });

                                tools.ModalAlertSuccess("Detalle", result, function() {
                                    detalleBuscar("");
                                });
                            } catch (error) {
                                tools.ErrorMessageServer("Detalle", error);
                            }
                        }
                    });
                }
            }

            function crudDetalle() {
                if ($("#txtNombre").val() == "") {
                    tools.AlertWarning("", "Ingrese el nombre del detalle.");
                    $("#txtNombre").focus();
                } else {
                    tools.ModalDialog("Detalle", "¿Está seguro de continuar?", async function(value) {
                        if (value == true) {
                            try {
                                let result = await tools.promiseFetchPost("../app/controller/DetalleController.php", {
                                    "type": "crud",
                                    "IdDetalle": idDetalle,
                                    "IdMantenimiento": idMantenimiento,
                                    "IdAuxiliar": $("#txtCodAuxiliar").val().trim().toUpperCase(),
                                    "Nombre": $("#txtNombre").val().trim().toUpperCase(),
                                    "Descripcion": $("#txtDescripcion").val().trim().toUpperCase(),
                                    "Estado": $("#rbActivo").is(":checked") ? "1" : "0",
                                    "UsuarioRegistro": idEmpleado,
                                }, function() {
                                    $("#modalDetalle").modal("hide");
                                    clearComponents();
                                    tools.ModalAlertInfo("Detalle", "Se está procesando la información.");
                                });

                                tools.ModalAlertSuccess("Detalle", result, function() {
                                    detalleBuscar("");
                                });
                            } catch (error) {
                                tools.ErrorMessageServer("Detalle", error);
                            }
                        }
                    });
                }
            }

            function recargarVista() {
                loadListaMantenimiento();
                idMantenimiento = "";
                $("#lblMantenimiento").empty();
                $("#lblDetalle").empty();
                $("#tbListDetalle").empty();
                tools.loadTableMessage($("#tbListDetalle"), "No hay datos para mostrar.", 6);
                clearComponents();
            }

            function clearComponents() {
                $("#txtCodAuxiliar").val('');
                $("#txtNombre").val('');
                $("#txtDescripcion").val('');
                $("#rbActivo").prop('checked', true);
                idDetalle = "";
            }
        </script>
    </body>

    </html>

<?php

}
