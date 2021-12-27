<?php

use SysSoftIntegra\Model\EmpresaADO;

require __DIR__ . '/app/src/autoload.php';

$empresa = EmpresaADO::Index();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="description" content="Importaciones Leonardo - LeatSact encuentre de todo para su vehículo en un solo lugar.">
    <meta name="language" content="es-PE">
    <meta name="country" content="PER">
    <meta name="currency" content="S/">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./resource/images/icono.png">

    <title><?= $empresa->NombreComercial ?></title>

    <link rel="shortcut icon" href="#" />

    <link rel="stylesheet" type="text/css" href="view/css/main.css?v=<?php echo (rand()); ?>">
    <link rel="stylesheet" type="text/css" href="view/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="view/css/shop.css?v=<?php echo (rand()); ?>">
    <link rel="stylesheet" type="text/css" href="view/css/catalogo.css?v=<?php echo (rand()); ?>">

</head>

<body>
    <div id="preloader">
    </div>

    <?php include './header.php'; ?>

    <div class="public-content">
        <div class="container">
            <div class="image">
                <a href="#">
                    <img src="./resource/images/banner.jpeg">
                </a>
            </div>
        </div>
    </div>

    <section class="detailt-list-cart">
        <div class="container">
            <div class="card p-3">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="d-flex align-items-lg-center h-100">
                            <h3 class="text-danger">Mi carrito - <small>Haz click en “Finalizar compra” para ingresar tus datos.</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="d-flex align-items-lg-center justify-content-end h-100">
                            <button class="button-red">Finalizar compra</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class=" table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Quitar</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Valor Unitario</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">
                                    <tr>
                                        <td class="text-center" colspan="5">!No hay producto para mostrar¡</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="d-flex align-items-lg-center justify-content-end h-100">
                            <table class="table border-0 w-auto">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span>TOTAL A PAGAR:</span>
                                        </td>
                                        <td>
                                            <span id="lblImporteNeto" class="h4">S/ 0.00</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include './footer.php'; ?>

    <script src="view/js/jquery-3.3.1.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
    <script src="view/js/plugins/bootstrap-notify.min.js"></script>
    <script src="view/js/main.js?v=<?php echo (rand()); ?>"></script>
    <script src="view/js/tools.js?v=<?php echo (rand()); ?>"></script>
    <script src="resource/storage/cardStorage.js?v=<?php echo (rand()); ?>"></script>
    <script>
        let tools = new Tools();
        let cardStorage = new CardStorage();
        let importeTotal = 0;

        $(document).ready(function() {
            cardStorage.renderCard();

            $("#tbList").empty();
            for (let value of cardStorage.getList()) {
                $("#tbList").append(`<tr>
                <td class="text-center"><button class="button-red"><i class="fa fa-trash"></i></button></td>
                <td>
                <div class="d-flex align-items-center">
                <img class="m-1" width="100" src="${value.image}" alt="${value.nombre}"/>
                <p class="m-1">${value.nombre}<p/>
                </div>
               
                </td>
                <td class="text-right">${value.cantidad}</td>
                <td class="text-right">S/ ${tools.formatMoney(value.precio)}</td>
                <td class="text-right">S/ ${tools.formatMoney(value.cantidad*value.precio)}</td>
            </tr>`);
                importeTotal += value.cantidad * value.precio;
            }

            $("#lblImporteNeto").html("S/ " + tools.formatMoney(importeTotal));

            $('#preloader').fadeOut(1000, function() {
                $(this).remove();
            });
        });
    </script>
</body>

</html>