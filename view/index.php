<?php
session_start();

if (!isset($_SESSION['IdEmpleado'])) {
    echo '<script>location.href = "login.php";</script>';
} else {
?>

<!DOCTYPE html>
<html lang="es">
<!-- background: linear-gradient(to right bottom, rgb(77, 84, 209), rgb(165, 28, 123) 50%, rgb(238, 74, 55) 100%) center center; -->

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
            <div>
                <h1>Dashboard <small>Panel de control</small>
                </h1>
            </div>
        </div>

        <div class="tile mb-4">

            <div class="overlay d-none" id="divOverlayEmpresa">
                <div class="m-loader mr-4">
                    <svg class="m-circular" viewBox="25 25 50 50">
                        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10">
                        </circle>
                    </svg>
                </div>
                <h4 class="l-text" id="lblTextOverlayEmpresa">Cargando información...</h4>
            </div>

            <div class="tile-body">

                <!-- Info boxes -->
                <div class="row">

                    <div class="col-lg-3 col-6">
                        <div class="card mb-3 text-white bg-primary">
                            <div class="card-body">
                                <h3 id="lblTotalVentas" class="text-white">S/ 0.00</h3>
                                <p>VENTAS DEL DÍA</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="card mb-3 text-white bg-danger">
                            <div class="card-body">
                                <h3 id="lblTotalCompras" class="text-white">S/ 0.00</h3>
                                <p>COMPRAS DEL DÍA</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="card mb-3 text-white bg-warning">
                            <div class="card-body">
                                <h3 id="lblTotalCuentasPorCobrar" class="text-white">0</h3>
                                <p>CUENTAS POR COBRAR</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="card mb-3 text-white bg-success">
                            <div class="card-body">
                                <h3 id="lblTotalCuentasPorPagar" class="text-white">0</h3>
                                <p>CUENTAS POR PAGAR</p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

                <!-- Info boxes -->
                <div class="row">

                    <div class="col-lg-3 col-6">
                        <div class="card mb-3 text-white bg-white">
                            <div class="card-body">
                                <h4 class="text-danger">Negativos</h4>
                                <h4 id="lblProductosNegativos" class="text-dark">0</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="card mb-3 text-white bg-white">
                            <div class="card-body">
                                <h4 class="text-warning">Intermedios</h4>
                                <h4 id="lblProductosIntermedios" class="text-dark">0</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="card mb-3 text-white bg-white">
                            <div class="card-body">
                                <h4 class="text-success">Necesarios</h4>
                                <h4 id="lblProductosNecesarios" class="text-dark">0</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="card mb-3 text-white bg-white">
                            <div class="card-body">
                                <h4 class="text-primary">Excedentes</h4>
                                <h4 id="lblProductosExcedentes" class="text-dark">0</h4>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Gráficos de las Ventas Por Mes</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="embed-responsive embed-responsive-16by9" style="height:320px">
                                            <canvas class="embed-responsive-item" id="lineChartDemo" width="444"
                                                height="249"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!--  -->

                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Los 10 Productos Más Vendidos del Mes y Día</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="product-list-in-card pl-2 pr-2" id="tvProductos">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3 card-primary card-tabs">
                            <div class="card-header">
                                <h5 class="card-title">Estado del Inventario</h5>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
                                            href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"
                                            aria-selected="false">Agotados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-two-profile" role="tab"
                                            aria-controls="custom-tabs-two-profile" aria-selected="false">Por
                                            Agotarse</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="custom-tabs-two-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-two-home-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 p-1">
                                                <div id="tvProductoAgotado">

                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <div class="form-group">
                                                    <button class="btn btn-secondary" id="btnPaginaAnteriorAgotados">
                                                        <i class="fa fa fa-arrow-circle-left"></i>
                                                    </button>
                                                    <span class="m-2" id="lblPaginaActualAgotados">0</span>
                                                    <span class="m-2">de</span>
                                                    <span class="m-2" id="lblPaginaSiguienteAgotados">0</span>
                                                    <button class="btn btn-secondary" id="btnPaginaSiguienteAgotados">
                                                        <i class="fa fa fa-arrow-circle-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-two-profile-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 p-1">
                                                <div id="tvProductoPorAgotarse">

                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <div class="form-group">
                                                    <button class="btn btn-secondary" id="btnPaginaAnteriorPorAgotarse">
                                                        <i class="fa fa fa-arrow-circle-left"></i>
                                                    </button>
                                                    <span class="m-2" id="lblPaginaActualPorAgotarse">0</span>
                                                    <span class="m-2">de</span>
                                                    <span class="m-2" id="lblPaginaSiguientePorAgotarse">0</span>
                                                    <button class="btn btn-secondary"
                                                        id="btnPaginaSiguientePorAgotarse">
                                                        <i class="fa fa fa-arrow-circle-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
               
                <hr>

                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <h5 class="card-title">Ventas y Compras - <span class="text-secondary">2022</span></h5>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col" class="th-porcent-5">Mes</th>
                                        <th scope="col" class="th-porcent-15">Venta SUNAT</th>
                                        <th scope="col" class="th-porcent-5">Venta Libre</th>
                                        <th scope="col" class="th-porcent-5">Compras + Gastos</th>
                                    </tr>
                                </thead>
                                <tbody id="tbListTable">
                                    <!-- <tr>
                                        <td class="text-center" colspan="4">No hay datos para mostrar</td>
                                    </tr> -->
                                    <tr>
                                        <td class="text-center text-secondary">Enero</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Febrero</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Marzo</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Abril</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Mayo</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Junio</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Julio</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Agosto</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Setiembre</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Octubre</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Noviembre</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-secondary">Diciembre</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <h5 class="card-title">Ventas de <span class="text-secondary">Enero</span></h5>
                        <div class="card mb-3 text-white bg-success">
                            <div class="card-body">
                                <h3 id="lblTotalVentas" class="text-white">S/ 00.00</h3>
                                <p>Efectivo</p>
                            </div>
                        </div>
                        <div class="card mb-3 text-white bg-warning">
                            <div class="card-body">
                                <h3 id="lblTotalVentas" class="text-white">S/ 00.00</h3>
                                <p>Credito</p>
                            </div>
                        </div>
                        <div class="card mb-3 text-white bg-primary">
                            <div class="card-body">
                                <h3 id="lblTotalVentas" class="text-white">S/ 00.00</h3>
                                <p>Tarjeta(deposito/trasferencia)</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>
    <!-- Essential javascripts for application to work-->
    <?php include "./layout/footer.php"; ?>
    <script src="./js/notificaciones.js"></script>
    <script>
    let tools = new Tools();
    let buttonSelected = false;
    let buttonAgotadosSelected = false;

    let productoVendidos = $("#tvProductos");

    let productoAgotado = $("#tvProductoAgotado");
    let posicionPaginaAgotados = 0;
    let filasPorPaginaAgotados = 7;
    let totalPaginacionAgotadas = 0;

    let productosPorAgotarse = $("#tvProductoPorAgotarse");
    let posicionPaginaPorAgotarse = 0;
    let filasPorPaginaPorAgotarse = 7;
    let totalPaginacionPorAgotarse = 0;

    // var salesChart = $("#sales-chart");
    // var ctxb = salesChart.get(0).getContext("2d");

    $(document).ready(function() {

        $("#lblMesActual").html("Ventas: " + tools.nombreMes(tools.getCurrentMonth()) + ", " + tools
            .getCurrentYear());

        //botones de Productos por agotarse
        $("#btnPaginaAnteriorAgotados").click(function() {
            if (posicionPaginaAgotados > 1) {
                posicionPaginaAgotados--;
                cargarProductosAgotados();
            }
        });

        $("#btnPaginaSiguienteAgotados").click(function() {
            if (posicionPaginaAgotados < totalPaginacionAgotadas) {
                posicionPaginaAgotados++;
                cargarProductosAgotados();
            }
        });

        $("#btnPaginaAnteriorPorAgotarse").click(function() {
            if (posicionPaginaPorAgotarse > 1) {
                posicionPaginaPorAgotarse--;
                cargarProductosPorAgotarse();
            }
        });

        $("#btnPaginaSiguientePorAgotarse").click(function() {
            if (posicionPaginaPorAgotarse < totalPaginacionPorAgotarse) {
                posicionPaginaPorAgotarse++;
                cargarProductosPorAgotarse();
            }
        });

        cargarDashboard();
    });

    async function cargarDashboard() {
        posicionPaginaAgotados = 1;
        posicionPaginaPorAgotarse = 1;
        let totalVentas = $("#lblTotalVentas");
        let totalCompras = $('#lblTotalCompras');
        let totalCuentasPorCobrar = $('#lblTotalCuentasPorCobrar');
        let totalCuentasPorPagar = $('#lblTotalCuentasPorPagar');
        productoVendidos.empty();

        try {
            let result = await tools.promiseFetchGet("../app/controller/VentaController.php", {
                type: "global",
                fechaActual: tools.getCurrentDate(),
                posicionPaginaAgotados: ((posicionPaginaAgotados - 1) * filasPorPaginaAgotados),
                filasPorPaginaAgotados: filasPorPaginaAgotados,

                posicionPaginaPorAgotarse: ((posicionPaginaPorAgotarse - 1) * filasPorPaginaPorAgotarse),
                filasPorPaginaPorAgotarse: filasPorPaginaPorAgotarse,
            });

            console.log(result)

            let data = result.data[0];

            totalVentas.html("S/  " + tools.formatMoney(data.TotalVentas));
            totalCompras.html("S/  " + tools.formatMoney(data.TotalCompras));
            totalCuentasPorCobrar.html(data.TotalCuentasCobrar);
            totalCuentasPorPagar.html(data.TotalCuentasPagar);
            let productosVendidos = data.ProductosMasVendidos;

            for (let value of productosVendidos) {
                let image = "./images/noimage.jpg";
                if (value.Imagen != '') {
                    image = ("data:image/png;base64," + value.Imagen);
                }
                productoVendidos.append('<li class="item">' +
                    '<div class="product-img">' +
                    '    <img src="' + image + '" alt="Product Image" class="img-size-70">' +
                    '</div>' +
                    '<div class="product-info">' +
                    '    <span class="product-title text-primary">' + value.NombreMarca + '' +
                    '    </span>' +
                    '    <span class="product-price badge badge-warning float-right">' + tools.formatMoney(value
                        .Cantidad, 0) + ' ' + value.Medida + '</span>' +
                    '</div>' +
                    '</li>');
            }

            // /*vista donde carga */
            let dataActual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            for (let value of data.VentasMesActual) {
                if (value.Mes == 1) {
                    dataActual[0] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 2) {
                    dataActual[1] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 3) {
                    dataActual[2] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 4) {
                    dataActual[3] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 5) {
                    dataActual[4] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 6) {
                    dataActual[5] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 7) {
                    dataActual[6] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 8) {
                    dataActual[7] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 9) {
                    dataActual[8] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 10) {
                    dataActual[9] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 11) {
                    dataActual[10] = tools.formatMoney(value.Monto)
                } else if (value.Mes == 12) {
                    dataActual[11] = tools.formatMoney(value.Monto)
                }
            }

            $("#lblProductosNegativos").html(data.InventarioNegativo);
            $("#lblProductosIntermedios").html(data.InventarioIntermedio);

            diagramaVentas(dataActual);
            // ProductosAgotados(result.agota);
            // ProductosPorAgotarse(result.porag);
        } catch (error) {

        }

    }

    async function cargarProductosAgotados() {
        try {
            let result = await tools.promiseFetchGet("../app/controller/VentaController.php", {
                type: "productosAgotados",
                posicionPaginaAgotados: ((posicionPaginaAgotados - 1) * filasPorPaginaAgotados),
                filasPorPaginaAgotados: filasPorPaginaAgotados
            });

            ProductosAgotados(result);
        } catch (error) {

        }
    }

    async function cargarProductosPorAgotarse() {
        try {
            productosPorAgotarse.empty();
            let result = await tools.promiseFetchGet("../app/controller/VentaController.php", {
                type: "productosPorAgotarse",
                posicionPaginaPorAgotarse: ((posicionPaginaPorAgotarse - 1) * filasPorPaginaPorAgotarse),
                filasPorPaginaPorAgotarse: filasPorPaginaPorAgotarse,
            });

            ProductosPorAgotarse(result);
        } catch (error) {

        }
    }

    function ProductosAgotados(result) {
        let productosAgotados = result.productosAgotadosLista;
        if (productosAgotados.length == 0) {

            totalPaginacionAgotadas = 0;
            $("#lblPaginaActualAgotados").html(0);
            $("#lblPaginaSiguienteAgotados").html(0);
        } else {
            for (let data of productosAgotados) {
                productoAgotado.append(
                    '<div class="widget-small danger"><i class="icon fa fa-exclamation  fa-2x"></i>' +
                    '<div class="info">' +
                    '<h6 class="text-white">' + data.NombreProducto.substr(0, 35) + '</h6>' +
                    ' <p><b>' + tools.formatMoney(data.Cantidad, 2) + '</b></p>' +
                    ' </div>' +
                    '</div>');
            }
            totalPaginacionAgotadas = parseInt(Math.ceil((parseFloat(result.productosAgotadosTotal) /
                filasPorPaginaAgotados)));
            $("#lblPaginaActualAgotados").html(posicionPaginaAgotados);
            $("#lblPaginaSiguienteAgotados").html(totalPaginacionAgotadas);
        }
    }

    function ProductosPorAgotarse(result) {
        let prodcutosAgotados = result.productoPorAgotarseLista;
        if (prodcutosAgotados.length == 0) {


            totalPaginacionPorAgotarse = 0;
            $("#lblPaginaActualPorAgotarse").html(0);
            $("#lblPaginaSiguientePorAgotarse").html(0);
        } else {
            for (let data of prodcutosAgotados) {
                productosPorAgotarse.append(
                    '<div class="widget-small warning"><i class="icon fa fa-exclamation  fa-2x"></i>' +
                    '<div class="info">' +
                    '<h6>' + data.NombreProducto.substr(0, 35) + '</h6>' +
                    ' <p><b>' + tools.formatMoney(data.Cantidad, 0) + '</b></p>' +
                    ' </div>' +
                    '</div>');
            }
            totalPaginacionPorAgotarse = parseInt(Math.ceil((parseFloat(result.productoPorAgotarseTotal) /
                filasPorPaginaPorAgotarse)));
            $("#lblPaginaActualPorAgotarse").html(posicionPaginaPorAgotarse);
            $("#lblPaginaSiguientePorAgotarse").html(totalPaginacionPorAgotarse);
        }

    }

    function diagramaVentas(dataActual, dataPasada) {
        var data = {
            labels: ["ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SET", "OCT", "NOV", "DIC"],
            datasets: [{
                    label: "Años Actual",
                    fillColor: "#007bff",
                    strokeColor: "#007bff",
                    pointColor: "#007bff",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "#007bff",
                    data: dataActual
                },
                {
                    label: "Año Pasado",
                    fillColor: "#212529",
                    strokeColor: "#212529",
                    pointColor: "#212529",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "#212529",
                    data: dataPasada
                }
            ],
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        };
        var pdata = [{
                value: 300,
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: "Red"
            },
            {
                value: 50,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Green"
            },
            {
                value: 100,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "Yellow"
            }
        ]

        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);
    }
    </script>
</body>

</html>

<?php
}