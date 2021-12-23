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

    <link rel="stylesheet" type="text/css" href="view/css/main.css">
    <link rel="stylesheet" type="text/css" href="view/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="view/css/shop.css">
    <link rel="stylesheet" type="text/css" href="view/css/catalogo.css">

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

    <section class="product-content">
        <div class="container">
            <div class="card p-5">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-image">
                            <div class="image" id="lblImage">
                                <img src="./resource/images/noimage.png">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-details">
                            <h2 class="product-name" id="lblName"></h2>
                            <div>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="product-price" id="lblNewPrice">0.00 <del class="product-old-price" id="lblOldPrice">0.00</del></h3>
                                <span class="product-available">En Stock</span>
                            </div>
                            <p id="txtDescripcion"></p>
                            <h6 class="text-muted" id="lblCategoria"></h6>
                            <h6 class="text-muted" id="lblMarca"></h6>
                            <h6 class="text-muted" id="lblPresentacion"></h6>
                            <h6 class="text-muted" id="lblUnidad"></h6>
                            <div class="add-to-cart">
                                <div class="qty-label">
                                    Cantidad
                                    <div class="input-number">
                                        <input type="text" id="txtCantidad" />
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                    </div>
                                </div>
                                <button class="add-to-cart-btn" id="btnAddCard"><i class="fa fa-shopping-cart"></i> Agregar</button>
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
    <script src="view/js/main.js"></script>
    <script src="view/js/tools.js"></script>
    <script>
        let tools = new Tools();
        let name_product = "<?= (isset($_GET["name"]) ? $_GET["name"] : null)  ?>";
        let idSuministro = "";

        $(document).ready(function() {
            if (name_product == "") {
                history.back()
                return;
            }


            $("#txtSearch").keypress(function(event) {
                if (event.which == 13) {
                    if ($("#txtSearch").val().trim().length != 0) {
                        window.location.href = "./catalogo.php?search=" + $("#txtSearch").val().trim();
                    }
                    event.preventDefault();
                }
            });

            $("#btnSearch").click(function() {
                if ($("#txtSearch").val().trim().length != 0) {
                    window.location.href = "./catalogo.php?search=" + $("#txtSearch").val().trim();
                }
            });

            $("#btnSearch").keypress(function(event) {
                if (event.which == 13) {
                    if ($("#txtSearch").val().trim().length != 0) {
                        window.location.href = "./catalogo.php?search=" + $("#txtSearch").val().trim();
                    }
                    event.preventDefault();
                }
            });

            $("#txtCantidad").keypress(function(event) {
                var key = window.Event ? event.which : event.keyCode;
                var c = String.fromCharCode(key);
                if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                    event.preventDefault();
                }
                if (c == '.' && $("#txtCantidad").val().includes(".")) {
                    event.preventDefault();
                }
            });

            $("#btnAddCard").click(function() {
                addCard();
            });

            $("#btnAddCard").keypress(function(event) {
                if (event.keyCode == 13) {
                    addCard();
                    event.preventDefault();
                }
            });

            getProducto();
        });

        async function getProducto() {
            try {
                let result = await tools.promiseFetchGet("./app/controller/SuministroController.php", {
                    "type": "valueSuministro",
                    "value": name_product
                });

                idSuministro = result.IdSuministro;
                $("#lblName").html(result.NombreMarca);
                $("#lblNewPrice").html("S/ " + tools.formatMoney(result.PrecioVentaGeneral) + ' <del class="product-old-price" >S/ ' + tools.formatMoney(result.PrecioVentaAlto) + '</del>');
                let image = '<img src ="./resource/images/noimage.png" alt="' + result.NombreMarca + '"/>';
                if (result.Imagen != "") {
                    image = '<img class="img-size-70" src ="' + ("./resource/catalogo/" + result.Imagen) + '" alt="' + result.NombreMarca + '"/>';
                }
                $("#lblImage").html(image);
                $("#txtDescripcion").html(result.Descripcion);
                $("#lblCategoria").html("<span>CATEGORIA:</span> " + result.CategoriaNombre);
                $("#lblMarca").html("<span>MARCA:</span> " + result.MarcaNombre);
                $("#lblPresentacion").html("<span>PRESENTACIÓN:</span> " + result.PresentacionNombre);
                $("#lblUnidad").html("<span>UNIDAD:</span> " + result.UnidadCompraNombre);
                $('#preloader').fadeOut(1000, function() {
                    $(this).remove();
                });
            } catch (error) {
                history.back()
                return;
            }
        }

        function addCard() {

        }
    </script>
</body>

</html>