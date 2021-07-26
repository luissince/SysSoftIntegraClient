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

            <!-- modal lista cliente -->
            <?php include('./layout/puntoventa/modalListaCliente.php'); ?>
            <!-- modal proceso venta -->
            <?php include('./layout/puntoventa/modalProcesoVenta.php'); ?>

            <!-- <div class="app-title">
                <h1><i class="fa fa-folder"></i> Nota de Crédito <small>Lista</small></h1>
            </div> -->

            <div class="tile mb-4">

                <!-- <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <h4> Punto de Venta</h4>
                            </div>
                        </div>
                    </div> -->

                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-7">

                        <div class="form-group d-flex">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" id="btnCodigo" title="Codigo de Barras"><i class="fa fa-barcode"></i></button>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="button" id="btnProductos" title="Nombre de producto"><i class="fa fa-search"></i></button>
                                </div>
                                <input type="search" class="form-control" placeholder="Código de barras" id="txtBuscarProducto">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="button" id="btnNuevo" title="Nuevo producto"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="border text-center p-1" style="height: 24em;">

                                        <button type="button" class="btn btn-outline-info m-1" title="Descripción del producto">
                                            <img src="./images/noimage.jpg" class="img-fluid" width="120">
                                            <h6>Descripcion...</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span>S/10.00</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="float-right">
                                                        <span>50 Unid</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>

                                        <button type="button" class="btn btn-outline-info m-1" title="Descripción del producto">
                                            <img src="./images/noimage.jpg" class="img-fluid" width="120">
                                            <h6>Descripcion...</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span>S/10.00</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="float-right">
                                                        <span>50 Unid</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>

                                        <button type="button" class="btn btn-outline-info m-1" title="Descripción del producto">
                                            <img src="./images/noimage.jpg" class="img-fluid" width="120">
                                            <h6>Descripcion...</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span>S/10.00</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="float-right">
                                                        <span>50 Unid</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>

                                        <button type="button" class="btn btn-outline-info m-1" title="Descripción del producto">
                                            <img src="./images/noimage.jpg" class="img-fluid" width="120">
                                            <h6>Descripcion...</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span>S/10.00</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="float-right">
                                                        <span>50 Unid</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="form-control">
                                                <i class="fa fa-file  text-primary"></i>
                                            </span>
                                        </div>

                                        <select id="comprobante" class="form-control" title="Tipo de documento">
                                            <option>Sin documento</option>
                                            <option>DNI</option>
                                            <option>RUC</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="00000000" id="txtNumDocumento" title="Número de documento">
                                        <div class="input-group-append">
                                            <button class="btn btn-info" type="button" id="btnOpenModalListaClientes" title="Cliente"><i class="fa fa-user-plus"></i></button>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="button" id="btnReniec" title="Reniec"><i class="fa fa-user-circle"></i></button>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" type="button" id="btnSunat" title="Sunat"><i class="fa fa-users"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="form-control">
                                                <i class="fa fa-user text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Cliente" id="txtNombreCliente" title="Nombre de cliente">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Dirección" id="txtDireccionCliente" title="Dirección de cliente">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- columna 2 -->

                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group d-flex">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="form-control">
                                                <i class="fa fa-ticket text-primary"></i>
                                            </span>
                                        </div>

                                        <select id="comprobante" class="form-control" title="Comprobante de venta">
                                            <option>Tiket</option>
                                            <option>Boleta</option>
                                            <option>Factura</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="bg-dark text-light">
                                        <div class="row justify-content-center p-2">
                                            <div class="col-md-6 text-left">
                                                Serie: <span>T001</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                N°: <span>1</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <div class="border" style="height: 24em;">

                                        <div class="border border-dark p-1" title="Descripción del producto">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <div class="form-group mb-0">
                                                        <div><span>Descripcion del producto</span></div>
                                                        <div><span>S/10.00</span></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 align-self-center">
                                                    <div class="form-group mb-0">
                                                        <input type="text" class="form-control p-0 text-center" value="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 align-self-center">
                                                    <div class="form-group mb-0">
                                                        <div class="d-flex float-right">
                                                            <h6 class="pr-1 ">S/100.00</h6>
                                                            <button class="btn btn-dark rounded">
                                                                <i class="fa fa-trash text-primary"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border border-dark p-1" title="Descripción del producto">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <div class="form-group mb-0">
                                                        <div><span>Descripcion del producto</span></div>
                                                        <div><span>S/10.00</span></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 align-self-center">
                                                    <div class="form-group mb-0">
                                                        <input type="text" class="form-control p-0 text-center" value="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 align-self-center">
                                                    <div class="form-group mb-0">
                                                        <div class="d-flex float-right">
                                                            <h6 class="pr-1 ">S/100.00</h6>
                                                            <button class="btn btn-dark rounded">
                                                                <i class="fa fa-trash text-primary"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button id="btnOpenModalProcesoVenta" class="btn btn-success btn-block rounded">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 text-left">
                                                <h5>COBRAR</h5>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <h5 id="lblTotal">S/ 10.00</h5>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-append pr-2">
                                        <button class="btn btn-info" type="button" id="btnAddVenta" title="Agregar nueva venta"><i class="fa fa-shopping-bag"></i> Nueva venta</button>
                                    </div>
                                    <div class="input-group-append pr-2">
                                        <button class="btn btn-info" type="button" id="btnLimpiar" title="Limpiar Venta"><i class="fa fa-trash"></i> Limpiar</button>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="button" id="btnMovCaja" title="Movimiento de caja"><i class="fa fa-money"></i> Movimiento de caja</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="js/puntoventa/modalListaCliente.js"></script>
        <script src="js/puntoventa/modalProcesoVenta.js"></script>
        <script src="./js/notificaciones.js"></script>
        <script>
            let isCodBarras = true;

            let tools = new Tools();
            let modalListaCliente = new ModalListaCliente();
            let modalProcesoVenta = new ModalProcesoVenta();

            $(document).ready(function() {
                modalListaCliente.init();
                modalProcesoVenta.init();

                $("#txtBuscarProducto").focus();

                $("#btnCodigo").click(function(event) {
                    $("#btnProductos").removeClass("btn-warning");
                    $("#btnProductos").addClass("btn-info");

                    $("#btnCodigo").removeClass("btn-info");
                    $("#btnCodigo").addClass("btn-warning");

                    $("#txtBuscarProducto").attr('placeholder', "Código de barras")
                    $("#txtBuscarProducto").focus();
                    let isCodBarras = true;

                })

                $("#btnProductos").click(function(event) {
                    $("#btnProductos").removeClass("btn-info");
                    $("#btnProductos").addClass("btn-warning");

                    $("#btnCodigo").removeClass("btn-warning");
                    $("#btnCodigo").addClass("btn-info");

                    $("#txtBuscarProducto").attr('placeholder', "Buscar productos")
                    $("#txtBuscarProducto").focus();
                    isCodBarras = false;
                })




            })
        </script>
    </body>

    </html>

<?php

}
