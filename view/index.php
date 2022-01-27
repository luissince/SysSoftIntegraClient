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

            <div class="tile mb-4">

                <div class="overlay" id="divOverlayIndex">
                    <div class="m-loader mr-4">
                        <svg class="m-circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10">
                            </circle>
                        </svg>
                    </div>
                    <h4 class="l-text text-white" id="lblTextOverlayIndex">Cargando información...</h4>
                </div>

                <div class="tile-body">

                    <div class="row">

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card mb-3 text-white bg-primary">
                                <div class="card-body">
                                    <h3 id="lblTotalVentas" class="text-white">S/ 0.00</h3>
                                    <p class="m-0">VENTAS DEL DÍA</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card mb-3 text-white bg-danger">
                                <div class="card-body">
                                    <h3 id="lblTotalCompras" class="text-white">S/ 0.00</h3>
                                    <p class="m-0">COMPRAS DEL DÍA</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card mb-3 text-white bg-warning">
                                <div class="card-body">
                                    <h3 id="lblTotalCuentasPorCobrar" class="text-white">0</h3>
                                    <p class="m-0">CUENTAS POR COBRAR</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card mb-3 text-white bg-success">
                                <div class="card-body">
                                    <h3 id="lblTotalCuentasPorPagar" class="text-white">0</h3>
                                    <p class="m-0">CUENTAS POR PAGAR</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card mb-3 text-white bg-secondary">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="">
                                            <img src="./images/producto.png" width="32" />
                                        </div>
                                        <div class="ml-2">
                                            <p class="m-0"> Productos</p>
                                            <h3 class="text-white" id="lblProductos"> 0</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card mb-3 text-white bg-secondary">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="">
                                            <img src="./images/clients.png" width="32" />
                                        </div>
                                        <div class="ml-2">
                                            <p class="m-0"> Clientes</p>
                                            <h3 class="text-white" id="lblClientes"> 0</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card mb-3 text-white bg-secondary">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="">
                                            <img src="./images/providers.png" width=" 32" />
                                        </div>
                                        <div class="ml-2">
                                            <p class="m-0"> Proveedores</p>
                                            <h3 class="text-white" id="lblProveedores"> 0</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card mb-3 text-white bg-secondary">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="">
                                            <img src="./images/employees.png" width=" 32" />
                                        </div>
                                        <div class="ml-2">
                                            <p class="m-0"> Trabajadores</p>
                                            <h3 class="text-white" id="lblTrabajadores"> 0</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class=" form-group">
                                <div class="card">
                                    <div class="card-body">

                                        <canvas id="myChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-12">
                            <div class=" form-group">
                                <div class="card">
                                    <div class="card-body">
                                        <canvas id="myPie" style="min-height: 300px;  height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped border-0">
                                                <thead class="bg-white">
                                                    <tr>
                                                        <th scope="col" width="5%">Mes</th>
                                                        <th scope="col" width="5%">Venta Sunat</th>
                                                        <th scope="col" width="5%">Venta Libre</th>
                                                        <th scope="col" width="5%">Venta Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbListTable">
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
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="card">
                                    <div class="card-body">
                                        <canvas id="myDonut" style="min-height: 300px;  height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                                        <div class="d-flex flex-row justify-content-end">
                                            <span class="mr-2" id="lblTipoMes">
                                                <i class="fa fa-stop text-primary"></i>MES - 0
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6  col-12">
                                                <div class="description-block border-right text-center">
                                                    <span class="description-percentage text-success" id="lblPorcentajeEfectivo"><i class="fa fa-caret-up"></i> 0%</span>
                                                    <h5 class="description-header" id="lblTotalEfectivo">S/ 0.00</h5>
                                                    <p class="description-text">TOTAL EFECTIVO</p>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6  col-12">
                                                <div class="description-block border-right text-center">
                                                    <span class="description-percentage text-warning" id="lblPorcentajeCredito"><i class="fa fa-caret-left"></i> 0%</span>
                                                    <h5 class="description-header" id="lblTotalCredito">S/ 0.00</h5>
                                                    <p class="description-text">TOTAL CRÉDITO</p>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6  col-12">
                                                <div class="description-block border-right text-center">
                                                    <span class="description-percentage text-success" id="lblPorcentajeTarjeta"><i class="fa fa-caret-up"></i> 0%</span>
                                                    <h5 class="description-header" id="lblTotalTarjeta">S/ 0.00</h5>
                                                    <p class="description-text">TOTAL TARJETA</p>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6 col-12">
                                                <div class="description-block text-center">
                                                    <span class="description-percentage text-success" id="lblPorcentajeDeposito"><i class="fa fa-caret-up"></i> 0%</span>
                                                    <h5 class="description-header" id="lblTotalDepostio">S/ 0.00</h5>
                                                    <p class="description-text">TOTAL DEPOSITO</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="card-title text-center m-0">Productos más veces vendidos</p>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped border-0">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Producto</th>
                                                        <th>Categoría/Marca</th>
                                                        <th>Veces</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbListMasVendidos">
                                                    <tr>
                                                        <td colspan="4" class="text-center">No hay datos para mostrar</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="card-title text-center m-0">Productos con más cantidades vendidas</p>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped border-0">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Producto</th>
                                                        <th>Categoría/Marca</th>
                                                        <th>Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbListCantidadVendidos">
                                                    <tr>
                                                        <td colspan="4" class="text-center">No hay datos para mostrar</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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

            $(document).ready(function() {
                loadDashboard();
            });

            async function loadDashboard() {
                try {

                    let dashboard = await tools.promiseFetchGet("../app/controller/DashboardController.php");

                    let promise = await Promise.all([dashboard]);
                    let result = await promise;

                    let primer = result[0];

                    $("#lblTotalVentas").html("S/ " + tools.formatMoney(primer.ventas));
                    $("#lblTotalCompras").html("S/ " + tools.formatMoney(primer.compras));
                    $("#lblTotalCuentasPorCobrar").html(primer.ccobrar);
                    $("#lblTotalCuentasPorPagar").html(primer.ccpagar);

                    $("#lblProductos").html(primer.productos);
                    $("#lblClientes").html(primer.clientes);
                    $("#lblProveedores").html(primer.proveedores);
                    $("#lblTrabajadores").html(primer.empleados);


                    let historialVentas = [{
                        id: 0,
                        mes: "Enero",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 1,
                        mes: "Febrero",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 2,
                        mes: "Marzo",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 3,
                        mes: "Abril",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 4,
                        mes: "Mayo",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 5,
                        mes: "Junio",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 6,
                        mes: "Julio",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 7,
                        mes: "Agosto",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 8,
                        mes: "Setiembre",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 9,
                        mes: "Octubre",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 10,
                        mes: "Noviembre",
                        sunat: 0,
                        libre: 0
                    }, {
                        id: 11,
                        mes: "Diciembre",
                        sunat: 0,
                        libre: 0
                    }];

                    for (let i = 0; i < historialVentas.length; i++) {
                        for (let value of primer.historialventastipos) {
                            if (value.Mes == (i + 1)) {
                                historialVentas[i].sunat += parseFloat(value.Sunat);
                                historialVentas[i].libre += parseFloat(value.Libre);
                            }
                        }
                    }

                    $("#tbListTable").empty();
                    for (let value of historialVentas) {
                        $("#tbListTable").append(`
                        <tr>
                            <td  class="text-center text-secondary">${value.mes}</td>
                            <td class="text-right text-secondary">S/ ${tools.formatMoney(value.sunat)}</td>
                            <td class="text-right text-secondary">S/ ${tools.formatMoney(value.libre)}</td>
                            <td class="text-right text-secondary">S/ ${tools.formatMoney(value.sunat+value.libre)}</td>
                        </tr>
                        `);
                    }

                    let dataActual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                    for (let i = 0; i < dataActual.length; i++) {
                        for (let value of primer.hventas) {
                            if (value.Mes == (i + 1)) {
                                dataActual[i] = tools.formatMoney(parseFloat(value.Monto));
                            }
                        }
                    }

                    let efectivo = 0;
                    let credito = 0;
                    let tarjeta = 0;
                    let deposito = 0;
                    let total = 0;

                    for (let value of primer.tipoventa) {
                        if (value.IdNotaCredito == 0 && value.Estado != 3) {
                            if (value.Estado == 2 || value.Tipo == 2 && value.Estado == 1) {
                                credito += parseFloat(value.Total);
                            } else if (value.Estado == 1 || value.Estado == 4) {
                                if (value.FormaName == "EFECTIVO") {
                                    efectivo += parseFloat(value.Total);
                                } else if (value.FormaName == "TARJETA") {
                                    tarjeta += parseFloat(value.Total);
                                } else if (value.FormaName == "MIXTO") {
                                    efectivo += parseFloat(value.Efectivo);
                                    tarjeta += parseFloat(value.Tarjeta);
                                } else {
                                    deposito += parseFloat(value.Total);
                                }
                            }
                        }
                    }

                    total = efectivo + credito + tarjeta + deposito;

                    $("#lblTotalEfectivo").html("S/ " + tools.formatMoney(efectivo));
                    $("#lblTotalCredito").html("S/ " + tools.formatMoney(credito));
                    $("#lblTotalTarjeta").html("S/ " + tools.formatMoney(tarjeta));
                    $("#lblTotalDepostio").html("S/ " + tools.formatMoney(deposito));

                    $("#lblTipoMes").html('<i class="fa fa-stop text-primary"></i> ' + tools.nombreMes(new Date().getMonth() + 1) + " - " + new Date().getFullYear());

                    $("#lblPorcentajeEfectivo").html('<i class="fa fa-caret-up"></i> ' + Math.round(porcent(total, efectivo)) + " %");
                    $("#lblPorcentajeCredito").html('<i class="fa fa-caret-left"></i> ' + Math.round(porcent(total, credito)) + " %");
                    $("#lblPorcentajeTarjeta").html('<i class="fa fa-caret-up"></i> ' + Math.round(porcent(total, tarjeta)) + " %");
                    $("#lblPorcentajeDeposito").html('<i class="fa fa-caret-up"></i> ' + Math.round(porcent(total, deposito)) + " %");


                    $("#tbListMasVendidos").empty();
                    let cv = 0;
                    for (let value of primer.vecesVendidos) {
                        cv++;
                        $("#tbListMasVendidos").append(`
                        <tr>
                            <td>${cv}</td>
                            <td>${value.Clave+"<br>"+value.NombreMarca}</td>
                            <td>${value.Categoria+"<br>"+value.Marca}</td>
                            <td>${tools.formatMoney(value.Cantidad)}</td>
                        </tr>
                        `);
                    }

                    $("#tbListCantidadVendidos").empty();
                    let cc = 0;
                    for (let value of primer.cantidadVendidos) {
                        cc++;
                        $("#tbListCantidadVendidos").append(`
                        <tr>
                            <td>${cc}</td>
                            <td>${value.Clave+"<br>"+value.NombreMarca}</td>
                            <td>${value.Categoria+"<br>"+value.Marca}</td>
                            <td>${tools.formatMoney(value.Suma)+"<br>"+value.Medida}</td>
                        </tr>
                        `);
                    }

                    chartLineaVentas(dataActual);
                    chartPieInventario([primer.innegativo, primer.inintermedio, primer.innecesario, primer.inexcecende]);
                    chartDonutVentas([efectivo, credito, tarjeta, deposito]);
                    $("#divOverlayIndex").addClass("d-none");
                } catch (error) {
                    console.log(error);
                }
            }

            function porcent(total, valor) {
                return (valor * 100) / total;
            }

            function chartLineaVentas(dataActual) {
                const myChart = document.getElementById('myChart');
                const chart = new Chart(myChart, {
                    type: 'bar',
                    data: {
                        labels: ["ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SET", "OCT", "NOV", "DIC"],
                        datasets: [{
                            label: new Date().getFullYear(),
                            data: dataActual,
                            backgroundColor: [
                                'rgb(40, 167, 69)',
                            ],
                            borderColor: [
                                'rgb(40, 167, 69)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: "#020203"
                                }
                            },
                            title: {
                                display: true,
                                text: 'VENTAS POR AÑO',
                                color: "#020203"
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            function chartPieInventario(dataInventario) {
                const myPie = document.getElementById('myPie');
                const pie = new Chart(myPie, {
                    type: 'pie',
                    data: {
                        labels: ['Negativos', 'Intermedios', 'Necesarios', 'Excedentes', ],
                        datasets: [{
                            label: 'Estado del Inventario',
                            data: dataInventario,
                            backgroundColor: [
                                'rgb(220, 53, 69)',
                                'rgb(255, 206, 86)',
                                'rgb(40, 167, 69)',
                                'rgb(4, 94, 191)',
                            ],
                            borderColor: [
                                'rgb(220, 53, 69)',
                                'rgb(255, 206, 86)',
                                'rgb(40, 167, 69)',
                                'rgb(4, 94, 191)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: "#020203"
                                }
                            },
                            title: {
                                display: true,
                                text: 'INVENTARIO',
                                color: "#020203"
                            }
                        }
                    },
                });
            }

            function chartDonutVentas(dataVentas) {
                const myDonut = document.getElementById('myDonut');
                const donut = new Chart(myDonut, {
                    type: 'doughnut',
                    data: {
                        labels: ['Efectivo', 'Crédito', 'Tarjeta', 'Deposito', ],
                        datasets: [{
                            label: 'TIPO DE VENTA',
                            data: dataVentas,
                            backgroundColor: [
                                '#1a9e65',
                                '#ea920d',
                                'rgb(182,162,222)',
                                'rgb(46, 199, 201)',
                            ],
                            borderColor: [
                                '#1a9e65',
                                '#ea920d',
                                'rgb(182,162,222)',
                                'rgb(46, 199, 201)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: "#020203"
                                }
                            },
                            title: {
                                display: true,
                                text: 'TIPO DE VENTAS',
                                color: "#020203"
                            }
                        }
                    },
                });

            }
        </script>
    </body>

    </html>

<?php
}
