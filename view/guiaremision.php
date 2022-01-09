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

        <!-- modal proveedores -->
        <div class="row">
            <div class="modal fade" id="modalProveedores" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-users"></i> Proveedores
                            </h4>
                            <button type="button" class="close" id="btnCloseModalProveedores">
                                <i class="fa fa-window-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="tile">
                                <div class="tile-body">
                                    <ul class="nav nav-tabs mb-2" role="tablist">
                                        <li class="nav-item">
                                            <a id="navListaProveedores" class="nav-link active" href="#listProveedores" role="tab" data-toggle="tab"><i class="fa fa-list"></i> Lista</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="navAgregarProveedor" class="nav-link" href="#addProveedor" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> Agregar</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active show" id="listProveedores">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="search" class="form-control" placeholder="Buscar por nombre o número de documento" aria-controls="sampleTable" id="txtSearchProveedor">
                                                            <!-- <div class="input-group-append ml-1">
                                                                <button class="btn btn-success form-control" type="button" id="btnAddProducto" title="Agregar Producto"><i class="fa fa-plus"></i> Agregar</button>
                                                            </div> -->
                                                            <div class="input-group-append ml-1">
                                                                <button id="btnReloadProveedores" class="btn btn-info form-control" type="button" title="Recargar"><i class="fa fa-refresh"></i> Recargar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th class="sorting" style="width: 10%;">#</th>
                                                                    <th class="sorting" style="width: 25%;">Documento</th>
                                                                    <th class="sorting" style="width: 40%;">Datos personales/Razon social</th>
                                                                    <th class="sorting" style="width: 25%;">Tel./Cel.</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbListaProveedores">
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>12345678901</td>
                                                                    <td>Ferreteria Diamante</td>
                                                                    <td>999999999</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="text-danger">Para elegir un proveedor hacer doble click en él.</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="text-right">
                                                        <div class="form-group">
                                                            <button class="btn btn-info" id="btnAnteriorProveedor">
                                                                <i class="fa fa-arrow-circle-left"></i>
                                                            </button>
                                                            <span class="m-2" id="lblPaginaActualProveedor">0
                                                            </span>
                                                            <span class="m-2">
                                                                de
                                                            </span>
                                                            <span class="m-2" id="lblPaginaSiguienteProveedor">0
                                                            </span>
                                                            <button class="btn btn-info" id="btnSiguienteProveedor">
                                                                <i class="fa fa-arrow-circle-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="addProveedor">

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Tipo documento: <i class="fa fa-info-circle text-danger"></i></label>
                                                        <select id="cbxTipoDocumento" class="form-control">
                                                            <option value="">--selected--</option>
                                                            <option value="1">OPCIÓN 1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>N° de documento: <i class="fa fa-info-circle text-danger"></i></label>
                                                        <div class="d-flex">
                                                            <input id="txtNumeroDocumento" type="text" class="form-control" placeholder="Ingrese el número de documento">
                                                            <!-- <div> -->
                                                            <button class="btn btn-secondary" type="button" title="Reniec"><i class="fa fa-user-circle text-dark"></i></button>
                                                            <button class="btn btn-secondary" type="button" title="Sunat"><i class="fa fa-users text-dark"></i></button>
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Razon social/Datos de la empresa: <i class="fa fa-info-circle text-danger"></i></label>
                                                        <input id="txtNombre" type="text" class="form-control" placeholder="Ingrese el nombre de proveedor">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Representante: </label>
                                                        <input id="txtRepresentante" type="text" class="form-control" placeholder="Ingrese el nombre del representante">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Telefono: </label>
                                                        <input id="txtTelefono" type="text" class="form-control" placeholder="Ingrese el número de telefono">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Celular: </label>
                                                        <input id="txtCelular" type="text" class="form-control" placeholder="Ingrese el número de celular">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>email: </label>
                                                        <input id="txtEmail" type="email" class="form-control" placeholder="Ingrese el email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Pagina web: </label>
                                                        <input id="txtWeb" type="text" class="form-control" placeholder="Ingrese la pagina web">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Direccion: </label>
                                                        <input id="txtDireccion" type="text" class="form-control" placeholder="Ingrese la dirección">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-0 mb-3" />
                                            <div class="row">
                                                <div class="col-md-8 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="text-danger">Todos los campos marcados con <i class="fa fa-info-circle"></i> son necesarios rellenar.</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="text-right">
                                                        <div class="form-group">
                                                            <button  id="btnAddProducto" class="btn btn-success" type="button" title="Registrar Proveedor"><i class="fa fa-save"></i> Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal productos -->
        <div class="row">
            <div class="modal fade" id="modalDatoSuministro" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-bookmark"></i> Agregar/Editar producto
                            </h4>
                            <button type="button" class="close" id="btnCloseModalDatoSuministro">
                                <i class="fa fa-window-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-center">
                                        <h6>1234567890123 - DESCRIPCION DEL PRODUCTO</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Impuesto:</label>
                                        <div class="border border-secondary pt-2 pl-2">
                                            <div class="mb-2">
                                                <input type="radio" name="impuesto" value="unidad" checked><span> Ninguno(0%)</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" name="impuesto" value="unidad"><span> IGV(18%)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>cantidad <i class="text-danger fa fa-info-circle"></i></label>
                                                <div class="d-flex">
                                                    <input id="txtCantidad" type="text" class="form-control" placeholder="Ingrese la cantidad">
                                                    <h6 id="lblUnidadMedida" class="text-primary ml-1">Unid</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Costo <i class="text-danger fa fa-info-circle"></i></label>
                                                <input id="txtCosto" type="text" class="form-control" placeholder="Ingrese el costo">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Descuento </label>
                                                <input id="txtDescuento" type="text" class="form-control" placeholder="Ingrese el descuento">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <hr>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="text-center">
                                        <input id="ckbDatosPrecio" type="checkbox">
                                        <span class="ml-1">Datos de precio para venta</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <hr>
                                </div>
                            </div>
                            <div id="divDatosPrecio" class="row disabled">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Impuesto <i class="text-danger fa fa-info-circle"></i></label>
                                        <select id="cbImpuesto" class="form-control">
                                            <option value="">- Seleccione -</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input id="rbPrecioNormal" type="radio" name="tbTipoPrecio" checked />
                                        <span>Lista de Precio Normal</span>
                                    </div>
                                </div>
                                <div id="divPrecioNormal" class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <label>Precio General <i class="text-danger fa fa-info-circle"></i></label>
                                            <div class="form-group">
                                                <input id="txtPrecioGeneral" type="text" class="form-control" placeholder="Precio General" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <label>Precio 2 </label>
                                            <div class="form-group">
                                                <input id="txtPrecio2" type="text" class="form-control" placeholder="Precio 2" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <label>Precio 3 </label>
                                            <div class="form-group">
                                                <input id="txtPrecio3" type="text" class="form-control" placeholder="Precio 3" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input id="rbPrecioPersonalizado" type="radio" name="tbTipoPrecio" />
                                        <span>Lista de Precios Personalizados</span>
                                    </div>
                                </div>
                                <div id="divPrecioPersonalizado" class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label>Precio General <i class="text-danger fa fa-info-circle"></i></label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Clave del producto" id="txtPrecioGeneralPersonalizado" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <label>Opción </label>
                                            <div class="form-group">
                                                <button class="btn btn-success" id="btnAgregar">
                                                    <i class="fa fa-plus"></i> Agregar
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="width:30%">Nombre</th>
                                                        <th style="width:30%">Precio del Monto</th>
                                                        <th style="width:30%">Cantidad</th>
                                                        <th style="width:10%">Opcion</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbPrecios">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <button id="btnDatosCompra" class="btn btn-info" type="button" title="Aceptar"><i class="fa fa-check"></i> Aceptar</button>
                                            <button id="btnCancelDatosCompra" class="btn btn-danger" type="button" title="Cancelar"><i class="fa fa-close"></i> Cancelar</button>
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
                <h1><i class="fa fa-truck"></i> Guia de Remición <small>Lista</small></h1>
            </div>

            <div class="tile mb-4">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <a href="./guiaremisionproceso.php" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Nuevo
                            </a>
                            <button class="btn btn-secondary" id="btnRecargar">
                                <i class="fa fa-refresh"></i>
                                Recargar
                            </button>
                  
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label><img src="./images/search.png" width="22" height="22"> Buscar por Cliente o Serie/Numeración:</label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" id="txtBuscar" placeholder="Ingrese al cliente o la serie y numeración" />
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" id="btnBuscar">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha Inicial:</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="txtFechaInicial">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha Final:</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="txtFechaFinal">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-header-background">
                                    <tr>
                                        <th scope="col" class="th-porcent-5">N°</th>
                                        <th scope="col" class="th-porcent-5">Vendedor</th>
                                        <th scope="col" class="th-porcent-15">Comprobante</th>
                                        <th scope="col" class="th-porcent-10">Fecha</th>
                                        <th scope="col" class="th-porcent-15">Cliente</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td class="text-center" colspan="5">No hay datos para mostrar</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
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


            // let state = false;
            // let paginacion = 0;
            // let opcion = 0;
            // let totalPaginacion = 0;
            // let filasPorPagina = 10;

            // let txtBuscarProducto = $("#txtBuscarProducto");
            // let tbProductos = $("#tbProductos");
            // let lblPaginaActual = $("#lblPaginaActual");
            // let lblPaginaSiguiente = $("#lblPaginaSiguiente");

            // let tbList = $("#tbList");
            // let rbIncremento = $("#rbIncremento")
            // let rbDecremento = $("#rbDecremento");

            // let arrayProductos = [];
            // let cbTipoMovimiento = $("#cbTipoMovimiento");

            $(document).ready(function() {

                $("#divPrecioPersonalizado").css("display", "none");

                $("#btnProductos").on("click", function(event) {
                    $("#modalDatoSuministro").modal("show");
                    // loadInitProductos();
                });

                $("#btnCloseModalDatoSuministro").on("click", function(event) {
                    $("#modalDatoSuministro").modal("hide");
                });

                $("#btnCloseModalDatoSuministro").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        $("#modalDatoSuministro").modal("hide");
                    }
                    event.preventDefault();
                });


                $('#modalDatoSuministro').on('shown.bs.modal', function(e) {
                    $("#txtCantidad").focus();
                });

                $("#ckbDatosPrecio").change(function(event) {
                    if ($("#ckbDatosPrecio").is(":checked")) {
                        $("#divDatosPrecio").removeClass("disabled");
                    } else {
                        $("#divDatosPrecio").addClass("disabled");
                    }
                })

                $("#rbPrecioNormal").change(function() {
                    $("#divPrecioPersonalizado").css("display", "none");
                    $("#divPrecioNormal").css("display", "block");
                });

                $("#rbPrecioPersonalizado").change(function() {
                    $("#divPrecioNormal").css("display", "none");
                    $("#divPrecioPersonalizado").css("display", "block");
                });

                $("#btnCancelDatosCompra").click(function() {
                    $("#modalDatoSuministro").modal("hide");
                })


                $("#btnProveedor").click(function() {
                    $("#modalProveedores").modal("show");
                })

                $("#btnCloseModalProveedores").click(function() {
                    $("#modalProveedores").modal("hide");
                })

                // $("#btnGuardar").on("click", function(event) {
                //     validateIngreso();
                // });

                // $("#btnGuardar").on("keyup", function(event) {
                //     if (event.keyCode === 13) {
                //         validateIngreso();
                //     }
                //     event.preventDefault();
                // });



                // $("#btnProductos").on("keyup", function(event) {
                //     if (event.keyCode === 13) {
                //         $("#id-modal-productos").modal("show");
                //         loadInitProductos();
                //     }
                //     event.preventDefault();
                // });

                // rbIncremento.click(function() {
                //     loadTipoMovimiento($("#rbIncremento")[0].checked);
                // });

                // rbDecremento.click(function() {
                //     loadTipoMovimiento($("#rbIncremento")[0].checked);
                // });

                // $("#cbEstadoMivimiento").click(function() {
                //     $("#lblEstadoMovimiento").html($("#cbEstadoMivimiento")[0].checked ? "Validado" : "Por Validar");
                // });

                // $("#txtCodigoVerificacion").val(loadCodeRandom());

                // loadComponentsModal();
                // loadTipoMovimiento($("#rbIncremento")[0].checked);
            });

            // function validateIngreso() {
            //     let count = 0;
            //     $("#tbList tr").each(function(row, tr) {
            //         for (let producto of arrayProductos) {
            //             if ($(tr)[0].id === producto.IdSuministro) {
            //                 if (!tools.isNumeric($(tr).find("td:eq(3)").find("input").val())) {
            //                     count++;
            //                 }
            //                 break;
            //             }
            //         }
            //     });


            //     ///BCPLPEPL
            //     if (cbTipoMovimiento.val() === "0" || cbTipoMovimiento.val() === undefined) {
            //         tools.AlertWarning("Movimiento", "Seleccione un tipo de movimiento.");
            //     } else if (arrayProductos.length === 0) {
            //         tools.AlertWarning("Movimiento", "No hay productos en la lista para continuar.");
            //     } else if (count > 0) {
            //         tools.AlertWarning("Movimiento", "Hay valores que no son numéricos o menores que 1 en la columna nueva existencia.");
            //     } else {
            //         let newArrayProductos = [];
            //         $("#tbList tr").each(function(row, tr) {
            //             for (let producto of arrayProductos) {
            //                 if ($(tr)[0].id === producto.IdSuministro) {
            //                     let newProducto = producto;
            //                     newProducto.Movimiento = parseFloat($(tr).find("td:eq(3)").find("input").val());
            //                     newArrayProductos.push(newProducto);
            //                     break;
            //                 }
            //             }
            //             // console.log($(tr)[0]);
            //             // console.log($(tr).find("td:eq(2)").find("input").val());
            //         });
            //         registrarMovimiento(newArrayProductos);
            //     }
            // }

            // function loadComponentsModal() {
            //     txtBuscarProducto.on("keyup", function(event) {
            //         if (txtBuscarProducto.val().trim().length != 0) {
            //             if (!state) {
            //                 paginacion = 1;
            //                 ListarProductos(1, txtBuscarProducto.val().trim());
            //                 opcion = 1;
            //             }
            //         }
            //         event.preventDefault();
            //     });



            // $("#btnAnterior").click(function() {
            //     if (!state) {
            //         if (paginacion > 1) {
            //             paginacion--;
            //             onEventPaginacion();
            //         }
            //     }
            // });

            // $("#btnSiguiente").click(function() {
            //     if (!state) {
            //         if (paginacion < totalPaginacion) {
            //             paginacion++;
            //             onEventPaginacion();
            //         }
            //     }
            // });

            // $("#btnRecargarProductos").click(function() {
            //     loadInitProductos();
            // });



            // $("#btnProductosNegativos").click(function() {
            //     listarProductosNegativos();
            // });

            // $("#btnProductosNegativos").keypress(function(event) {
            //     if (event.keyCode === 13) {
            //         listarProductosNegativos();
            //     }
            //     event.preventDefault();
            // });

            // $("#btnTodosProductos").click(function() {
            //     listarTodosLosProductos();
            // });

            // $("#btnTodosProductos").keypress(function(event) {
            //     if (event.keyCode === 13) {
            //         listarTodosLosProductos();
            //     }
            //     event.preventDefault();
            // });

            // }

            // function onEventPaginacion() {
            //     switch (opcion) {
            //         case 0:
            //             ListarProductos(0, "");
            //             break;
            //         case 1:
            //             ListarProductos(1, txtBuscarProducto.val().trim());
            //             break;
            //     }
            // }

            // function loadInitProductos() {
            //     if (!state) {
            //         paginacion = 1;
            //         ListarProductos(0, "");
            //         opcion = 0;
            //     }
            // }


            // function ListarProductos(tipo, value) {
            //     $.ajax({
            //         url: "../app/controller/suministros/ListarSuministros.php",
            //         method: "GET",
            //         data: {
            //             "type": "modalproductos",
            //             "tipo": tipo,
            //             "value": value,
            //             "posicionPagina": ((paginacion - 1) * filasPorPagina),
            //             "filasPorPagina": filasPorPagina
            //         },
            //         beforeSend: function() {
            //             tbProductos.empty();
            //             tbProductos.append('<tr><td class="text-center" colspan="6"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
            //             state = true;
            //         },
            //         success: function(result) {
            //             let object = result;
            //             if (object.estado === 1) {
            //                 tbProductos.empty();
            //                 let productos = object.data;
            //                 if (productos.length === 0) {
            //                     tbProductos.append('<tr><td class="text-center" colspan="6"><p>No hay datos para mostrar</p></td></tr>');
            //                     totalPaginacion = 0;
            //                     lblPaginaActual.html(0);
            //                     lblPaginaSiguiente.html(0);
            //                     state = false;
            //                 } else {
            //                     for (let producto of productos) {
            //                         tbProductos.append('<tr ondblclick=onSelectProducto(\'' + producto.IdSuministro + '\')>' +
            //                             '<td>' + producto.Id + '</td>' +
            //                             '<td>' + producto.Clave + '</br>' + producto.NombreMarca + '</td>' +
            //                             '<td>' + producto.Categoria + '<br>' + producto.Marca + '</td>' +
            //                             '<td>' + tools.formatMoney(parseFloat(producto.Cantidad)) + '</td>' +
            //                             '<td>' + producto.ImpuestoNombre + '</td>' +
            //                             '<td>' + tools.formatMoney(parseFloat(producto.PrecioVentaGeneral)) + '</td>' +
            //                             '</tr>');
            //                     }
            //                     totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));
            //                     lblPaginaActual.html(paginacion);
            //                     lblPaginaSiguiente.html(totalPaginacion);
            //                     state = false;
            //                 }
            //             } else {
            //                 tbProductos.empty();
            //                 tbProductos.append('<tr><td class="text-center" colspan="6"><p>' + object.message + '</p></td></tr>');
            //                 state = false;
            //             }
            //         },
            //         error: function(error) {
            //             tbProductos.empty();
            //             tbProductos.append('<tr><td class="text-center" colspan="6"><p>' + error.responseText + '</p></td></tr>');
            //             state = false;
            //         }
            //     });
            // }

            // function loadTipoMovimiento(ajuste) {
            //     $.get("../app/controller/tipomovimiento/ListarTipoMovimientos.php", {
            //         "ajuste": ajuste,
            //         "all": "false"
            //     }, function(data, status) {
            //         if (status === "success") {
            //             let result = data;
            //             if (result.estado === 1) {
            //                 cbTipoMovimiento.empty();
            //                 cbTipoMovimiento.append('<option value="0">--TODOS--</option>');
            //                 for (let tipos of result.data) {
            //                     cbTipoMovimiento.append('<option value="' + tipos.IdTipoMovimiento + '">' + tipos.Nombre + '</option>');
            //                 }
            //             } else {
            //                 cbTipoMovimiento.empty();
            //             }
            //         }
            //     });
            // }

            // function onSelectProducto(idSuministro) {
            //     $("#id-modal-productos").modal("hide");
            //     if (!validateDuplicate(idSuministro)) {
            //         $.ajax({
            //             url: "../app/controller/suministros/ObtenerSuministro.php",
            //             method: "GET",
            //             data: {
            //                 "idSuministro": idSuministro
            //             },
            //             beforeSend: function() {
            //                 tools.AlertInfo("Movimiento", "Agregando producto.");
            //                 if (arrayProductos.length === 0) {
            //                     tbList.empty();
            //                 }
            //             },
            //             success: function(result) {
            //                 if (result.estado === 1) {
            //                     let suministro = result.data;
            //                     arrayProductos.push(suministro);
            //                     tbList.append('<tr id="' + suministro.IdSuministro + '">' +
            //                         '<td><button class="btn btn-default" onclick="removeTableTr(\'' + suministro.IdSuministro + '\')"><img src="./images/remove.png" width="24" /></button></td>' +
            //                         '<td>' + suministro.Clave + '</br>' + suministro.NombreMarca + '</td>' +
            //                         '<td>' + suministro.MarcaNombre + '</td>' +
            //                         '<td><input type="number" class="form-control" placeholder="0.00" /></td>' +
            //                         '<td>' + suministro.Cantidad + " " + suministro.UnidadCompraNombre + '</td>' +
            //                         '<td>0.00</td>' +
            //                         '</tr>');
            //                     tools.AlertSuccess("Movimiento", "Se agregó correctamente a la lista.");
            //                 } else {
            //                     tools.AlertWarning("Movimiento", "Problemas en agregar el producto, intente nuevamente.");
            //                 }
            //             },
            //             error: function(error) {
            //                 tools.AlertError("Movimiento", "Error al agregar el producto, comuníquese con su proveedor.");
            //             }
            //         });
            //     } else {
            //         tools.AlertWarning("Movimiento", "Hay producto con las mismas características.");
            //     }
            // }

            // function listarProductosNegativos() {
            //     $.ajax({
            //         url: "../app/controller/suministros/ListarSuministroNegativos.php",
            //         method: "GET",
            //         data: {},
            //         beforeSend: function() {
            //             tbList.empty();
            //             arrayProductos = [];
            //             tools.AlertInfo("Movimiento", "Agregando lista de productos.");
            //         },
            //         success: function(result) {
            //             if (result.estado === 1) {
            //                 for (let suministro of result.suministros) {
            //                     arrayProductos.push(suministro);
            //                     tbList.append('<tr id="' + suministro.IdSuministro + '">' +
            //                         '<td><button class="btn btn-default" onclick="removeTableTr(\'' + suministro.IdSuministro + '\')"><img src="./images/remove.png" width="24" /></button></td>' +
            //                         '<td>' + suministro.Clave + '</br>' + suministro.NombreMarca + '</td>' +
            //                         '<td>' + suministro.MarcaNombre + '</td>' +
            //                         '<td><input type="number" class="form-control" placeholder="0.00" /></td>' +
            //                         '<td>' + suministro.Cantidad + " " + suministro.UnidadCompraNombre + '</td>' +
            //                         '<td>0.00</td>' +
            //                         '</tr>');
            //                 }
            //                 tools.AlertSuccess("Movimiento", "Se agregó correctamente a la lista.");
            //             } else {
            //                 tools.AlertWarning("Movimiento", "Problemas en agregar el producto, intente nuevamente.");
            //             }
            //         },
            //         error: function(error) {
            //             tools.AlertError("Movimiento", "Error al agregar el producto, comuníquese con su proveedor.");
            //         }
            //     });
            // }

            // function listarTodosLosProductos() {
            //     $.ajax({
            //         url: "../app/controller/suministros/ListarTodosSuministros.php",
            //         method: "GET",
            //         data: {},
            //         beforeSend: function() {
            //             tbList.empty();
            //             arrayProductos = [];
            //             tools.AlertInfo("Movimiento", "Agregando lista de productos.");
            //         },
            //         success: function(result) {
            //             if (result.estado === 1) {
            //                 for (let suministro of result.suministros) {
            //                     arrayProductos.push(suministro);
            //                     tbList.append('<tr id="' + suministro.IdSuministro + '">' +
            //                         '<td><button class="btn btn-default" onclick="removeTableTr(\'' + suministro.IdSuministro + '\')"><img src="./images/remove.png" width="24" /></button></td>' +
            //                         '<td>' + suministro.Clave + '</br>' + suministro.NombreMarca + '</td>' +
            //                         '<td>' + suministro.MarcaNombre + '</td>' +
            //                         '<td><input type="number" class="form-control" placeholder="0.00" /></td>' +
            //                         '<td>' + suministro.Cantidad + " " + suministro.UnidadCompraNombre + '</td>' +
            //                         '<td>0.00</td>' +
            //                         '</tr>');
            //                 }
            //                 tools.AlertSuccess("Movimiento", "Se agregó correctamente a la lista.");
            //             } else {
            //                 tools.AlertWarning("Movimiento", "Problemas en agregar el producto, intente nuevamente.");
            //             }
            //         },
            //         error: function(error) {
            //             tools.AlertError("Movimiento", "Error al agregar el producto, comuníquese con su proveedor.");
            //         }
            //     });
            // }

            // function registrarMovimiento(newArrayProductos) {
            //     tools.ModalDialog("Movimiento", '¿Está seguro de continuar?', function(value) {
            //         if (value == true) {
            //             $.ajax({
            //                 url: "../app/controller/tipomovimiento/RegistrarMovimiento.php",
            //                 method: "POST",
            //                 accepts: "application/json",
            //                 contentType: "application/json",
            //                 data: JSON.stringify({
            //                     "fecha": tools.getCurrentDate(),
            //                     "hora": tools.getCurrentTime(),
            //                     "tipoAjuste": rbIncremento[0].checked,
            //                     "tipoMovimiento": cbTipoMovimiento.val(),
            //                     "observacion": $("#txtObservacion").val(),
            //                     "suministro": 1,
            //                     "estado": $("#cbEstadoMivimiento")[0].checked,
            //                     "codigoVerificacion": $("#txtCodigoVerificacion").val().trim(),
            //                     "lista": newArrayProductos
            //                 }),
            //                 beforeSend: function() {
            //                     tools.ModalAlertInfo("Movimiento", "Se está procesando la información.");
            //                 },
            //                 success: function(result) {
            //                     if (result.estado === 1) {
            //                         tools.ModalAlertSuccess("Movimiento", "Se completo correctamente el movimiento de inventario.");
            //                         arrayProductos.splice(0, arrayProductos.length);
            //                         tbList.empty();
            //                         $("#rbIncremento")[0].checked = true;
            //                         loadTipoMovimiento($("#rbIncremento")[0].checked);
            //                         $("#txtObservacion").val("N/D");
            //                         $("#cbEstadoMivimiento")[0].checked = true;
            //                     } else {
            //                         tools.ModalAlertWarning("Movimiento", result.mensaje);
            //                     }
            //                 },
            //                 error: function(error) {
            //                     tools.ModalAlertError("Movimiento", "Se produjo un error: " + error.responseText);
            //                 }
            //             });
            //         }
            //     });
            // }

            // function removeTableTr(idSuministro) {
            //     $("#" + idSuministro).remove();
            //     for (let i = 0; i < arrayProductos.length; i++) {
            //         if (arrayProductos[i].IdSuministro === idSuministro) {
            //             arrayProductos.splice(i, 1);
            //             break;
            //         }
            //     }
            // }

            // function loadCodeRandom() {
            //     let d = new Date();
            //     let rn = Math.floor(Math.random() * (1000 - 100) + 1000);
            //     return "M" + rn + "" + d.getHours();
            // }

            // function validateDuplicate(IdSuministro) {
            //     let ret = false;
            //     for (let i = 0; i < arrayProductos.length; i++) {
            //         if (arrayProductos[i].IdSuministro === IdSuministro) {
            //             ret = true;
            //             break;
            //         }
            //     }
            //     return ret;
            // }
        </script>
    </body>

    </html>

<?php

}
