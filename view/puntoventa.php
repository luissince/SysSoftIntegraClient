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

        <!-- modal lista cliente -->
        <?php include('./layout/puntoventa/modalCliente.php'); ?>

        <main class="app-content">
            <!-- <div class="app-title">
                <h1><i class="fa fa-folder"></i> Nota de Crédito <small>Lista</small></h1>
            </div> -->

            <div class="tile">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group d-flex">
                            <h4 class="mr-3"> Punto de Venta</h4>
                            <button type="button" class="btn btn-warning rounded"><i class="fa fa-plus"></i> Agregar Venta</button>
                        </div>
                    </div>
                </div>

                <div class="bs-component">
                    <ul class="nav nav-tabs" id="ulNavTabs">
                        <li class="nav-item" id="liVenta1"><a class="nav-link active" data-toggle="tab" href="#Venta1">Venta 1 <i class="fa fa-close" onclick="closeTab('Venta1')"></i></a></li>
                    </ul>
                    <div class="tab-content" id="divTabContent">

                        <div class="tab-pane fade active show pt-1" id="Venta1">
                            <div class="row">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                    <div class="card">

                                        <div class="card-header">
                                            <div class="row mb-2">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="button" title="Agregar nueva venta">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <i class="fa fa-shopping-bag"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        Productos(F1)
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="button" title="Limpiar Venta">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <i class="fa fa-shopping-bag"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        Precios(F2)
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="button" title="Movimiento de caja">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <i class="fa fa-shopping-bag"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        Productos(F3)
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="button" title="Movimiento de caja">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <i class="fa fa-shopping-bag"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        Mov. Caja(F4)
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="button" title="Movimiento de caja">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <i class="fa fa-shopping-bag"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        Limpiar(F5)
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="button" title="Movimiento de caja">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <i class="fa fa-shopping-bag"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        Ventas(F6)
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="button" title="Movimiento de caja">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <i class="fa fa-shopping-bag"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        Cotización(F7)
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="form-control" id="btnCodigo" title="Codigo de Barras"><i class="fa fa-barcode"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Código de barras">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-bordered table-sm">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th width="5%">#</th>
                                                                    <th width="10%">Quitar</th>
                                                                    <th width="15%">Cantidad</th>
                                                                    <th width="30%">Descripción</th>
                                                                    <th width="15%">Impuesto</th>
                                                                    <th width="15%">Precio</th>
                                                                    <th width="15%">Descuento</th>
                                                                    <th width="20%">Importe</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbLista">
                                                                <tr role="row" class="odd">
                                                                    <td class="text-center">1</td>
                                                                    <td class="text-center"><button class="btn btn-danger rounded"><i class="fa fa-trash"></i></button></td>
                                                                    <td><input type="text" class="form-control" placeholder="0" /></td>
                                                                    <td>description del producto</td>
                                                                    <td class="text-center">igv(18%)</td>
                                                                    <td><input type="text" class="form-control" placeholder="0" /></td>
                                                                    <td class="text-center">0</td>
                                                                    <td class="text-center">100.00</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- columna 2 -->
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="card">

                                        <div class="card-header p-0">
                                            <button id="btnCobrar" class="btn btn-success btn-block">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-6 text-left">
                                                        <h5>COBRAR</h5>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-6 text-right">
                                                        <h5 id="lblTotal">S/ 10.00</h5>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-12">

                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="form-control">
                                                                    <i class="fa fa-ticket text-info"></i>
                                                                </span>
                                                            </div>
                                                            <select id="comprobante" class="form-control" title="Comprobante de venta">
                                                                <option>Tipo de comprobante</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6 text-left">
                                                                <h6>Serie: <span>T001</span></h6>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                                <h6> N°: <span>1</span></h6>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group d-flex">
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="form-control">
                                                                    <i class="fa fa-bars text-info"></i>
                                                                </span>
                                                            </div>
                                                            <select id="comprobante" class="form-control" title="Comprobante de venta">
                                                                <option>Tipo de documento</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group d-flex">
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="form-control">
                                                                    <i class="fa fa-search text-info"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="00000000" title="Número de documento">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-secondary" type="button" title="Cliente"><i class="fa fa-user-plus text-dark"></i></button>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-secondary" type="button" title="Reniec"><i class="fa fa-user-circle text-dark"></i></button>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-secondary" type="button" title="Sunat"><i class="fa fa-users text-dark"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group d-flex">
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="form-control">
                                                                    <i class="fa fa-user text-info"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Cliente" title="Número de documento">
                                                        </div>
                                                    </div>

                                                    <div class="form-group d-flex">
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="form-control">
                                                                    <i class="fa fa-phone text-info"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="N° de Celular" title="Número de documento">
                                                        </div>
                                                    </div>

                                                    <div class="form-group d-flex">
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="form-control">
                                                                    <i class="fa fa-envelope text-info"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Correo Electrónico" title="Número de documento">
                                                        </div>
                                                    </div>

                                                    <div class="form-group d-flex">
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="form-control">
                                                                    <i class="fa fa-map-marker text-info"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Dirección de Vivienda o Local" title="Número de documento">
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
        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="js/puntoventa/modalCliente.js"></script>
        <script src="./js/notificaciones.js"></script>
        <script>
            let isCodBarras = true;

            let tools = new Tools();
            let modalCliente = new ModalCliente();

            $(document).ready(function() {
                modalCliente.init();
                $("#txtBuscarProducto").focus();
            });

            function closeTab(idTab) {
                if ($("#ulNavTabs li").length > 1) {
                    let isSelected = $($("#li" + idTab + " a")[0]).hasClass("active");
                    $("#li" + idTab).remove();
                    $("#" + idTab).remove();
                    if (isSelected) {
                        $("#ulNavTabs li").each(function() {
                            $("#" + $(this)[0].id + " a").removeClass("active")
                        });

                        $("#divTabContent > div").each(function() {
                            $("#" + $(this)[0].id + "").removeClass("active show");
                        });

                        $("#" + $("#ulNavTabs li")[0].id + " a").addClass("active");
                        $("#" + $("#divTabContent > div")[0].id + "").addClass("active show");
                    } else {

                    }
                } else {
                    // $("#ulNavTabs li a i")[0].remove();
                }
            }
        </script>
    </body>

    </html>

<?php

}
