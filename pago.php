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
    <link rel="stylesheet" type="text/css" href="view/css/sweetalert.min.css?v=<?php echo (rand()); ?>">
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
                            <h3 class="text-danger">Finalizar Compra - <small>Ingrese los datos requeridos.</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="d-flex align-items-lg-center justify-content-end h-100">
                            <button id="btnRegistrar" class="button-red"><i class="fa fa-save"></i> Registrar</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="bs-component">
                            <div class="card mb-2">
                                <h4 class="card-header">Información del Cliente</h4>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>N° de Documento</label>
                                                <div class="input-group">
                                                    <input id="txtDocumento" class="form-control" type="text" placeholder="DNI, RUC, OTRO">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Apellidos y Nombre o Razón Social</label>
                                                <div class="input-group">
                                                    <input id="txtInformacion" class="form-control" type="text" placeholder="Ingrese información">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>N° de Celular</label>
                                                <div class="input-group">
                                                    <input id="txtCelular" class="form-control" type="text" placeholder="Numero de Celular">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Correo Electrónico</label>
                                                <div class="input-group">
                                                    <input id="txtEmail" class="form-control" type="text" placeholder="Numero de Celular">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <div class="input-group">
                                                    <input id="txtDireccion" class="form-control" type="text" placeholder="Ingrese su dirección">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="bs-component">
                            <div class="card mb-2">
                                <h4 class="card-header">Resumen de la compra</h4>
                                <div class="card-body">
                                    <h4 class="card-title">Cantidad de Productos</h4>
                                    <p class="text-muted" id="lblCantidadTotal">0</p>
                                    <h4 class="card-title">Importe Total</h4>
                                    <p class="text-muted" id="lblImporteTotal">0.00</p>
                                </div>
                            </div>
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
    <script src="view/js/plugins/sweetalert.min.js"></script>
    <script src="view/js/tools.js?v=<?php echo (rand()); ?>"></script>
    <script src="resource/storage/cardStorage.js?v=<?php echo (rand()); ?>"></script>
    <script>
        let tools = new Tools();
        let cardStorage = new CardStorage();


        $(document).ready(function() {
            cardStorage.renderCard();

            $("#btnRegistrar").click(function() {
                registrarCompra();
            });

            tools.keyEnter($("#btnRegistrar"), function(event) {
                registrarCompra();
            });

            loadComponents();

            $('#preloader').fadeOut(1000, function() {
                $(this).remove();
            });
        });

        function loadComponents() {
            $("#lblCantidadTotal").html(cardStorage.getList().length);
            let importe = 0;
            for (let value of cardStorage.getList()) {
                importe += value.cantidad * value.precio;
            }
            $("#lblImporteTotal").html("S/ " + tools.formatMoney(importe));
        }

        function registrarCompra() {
            if (!tools.isText($("#txtDocumento").val())) {
                tools.AlertWarning("", "Ingrese su n° de documento.");
                $("#txtDocumento").focus();
            } else if (!tools.isText($("#txtInformacion").val())) {
                tools.AlertWarning("", "Ingrese su información.");
                $("#txtInformacion").focus();
            } else if (!tools.isText($("#txtCelular").val())) {
                tools.AlertWarning("", "Ingrese su n° de celular");
                $("#txtCelular").focus();
            } else if (!tools.validateEmail($("#txtEmail").val())) {
                tools.AlertWarning("", "Ingrese un correo electrónico valido.");
                $("#txtEmail").focus();
            } else if (cardStorage.getList().length == 0) {
                tools.AlertWarning("", "Noy productos en el carrito para continuar.");
            } else {
                tools.ModalDialog("Pedido", '¿Está seguro de registra el pedido?', async function(value) {
                    if (value == true) {
                        try {
                            let detalle = cardStorage.getList().map(function(item, index) {
                                return {
                                    "IdSuministro": item.idSuministro,
                                    "Cantidad": item.cantidad,
                                    "Precio": item.precio,
                                    "Descuento": 0
                                };
                            });

                            let result = await tools.promiseFetchPost("./app/controller/PedidoController.php", {
                                "type": "webpedido",
                                "Documento": $("#txtDocumento").val().trim(),
                                "Informacion": $("#txtInformacion").val().trim(),
                                "Celular": $("#txtCelular").val().trim(),
                                "Email": $("#txtEmail").val().trim(),
                                "Direccion": $("#txtDireccion").val().trim(),
                                "Detalle": detalle
                            }, function() {
                                tools.ModalAlertInfo("Pedido", "Procesando petición..");
                            });
                            tools.ModalAlertSuccess("Pedido", result, function() {
                                cardStorage.empty();
                                window.open("./", "_self");
                            });
                        } catch (error) {
                            tools.ErrorMessageServer("Pedido", error);
                        }
                    }
                });
            }
        }
    </script>
</body>

</html>