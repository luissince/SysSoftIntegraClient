<?php

use SysSoftIntegra\Model\EmpresaADO;

require __DIR__ . '/app/src/autoload.php';

$empresa = EmpresaADO::Index();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="description"
        content="Importaciones Leonardo - LeatSact encuentre de todo para su vehículo en un solo lugar.">
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
                                <h3 class="product-price" id="lblNewPrice">0.00 <del class="product-old-price"
                                        id="lblOldPrice">0.00</del></h3>
                                <span class="product-available">En Stock</span>
                            </div>

                            <p id="txtDescripcion" class="text-uppercase"></p>

                            <div class="row pb-3">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                    <span><strong>Categoria:</strong></span>
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                    <span class="text-muted font-italic" id="lblCategoria"></span>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                    <span><strong>Marca:</strong></span>
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                    <span class="text-muted font-italic" id="lblMarca"></span>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                    <span><strong>Presentacion:</strong></span>
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                    <p class="text-muted font-italic" id="lblPresentacion"></p>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                    <span><strong>Unidad:</strong></span>
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                    <p class="text-muted font-italic" id="lblUnidad"></p>
                                </div>

                            </div>
                            
                            <!-- <h6 class="text-muted" id="lblUnidad"></h6> -->
                            
                            <div class="add-to-cart">
                                <div class="qty-label">
                                    Cantidad
                                    <div class="input-number">
                                        <input type="text" id="txtCantidad" inputmode="numeric" value="1"
                                            autocomplete="off" />
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                    </div>
                                </div>
                                <button class="add-to-cart-btn" id="btnAddCard"><i class="fa fa-shopping-cart"></i>
                                    Agregar</button>
                            </div>
                            <div class="csiFormatText">
                                <p>
                                    <span class="csiGreenText">Envío a todo el Perú, puedes pagar con tus tarjetas
                                        preferidas</span>
                                    <strong>Visa Mastercard y Amex a través de PayPal</strong>
                                    <br class="showInCart">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


                        <div class="tabset">

                            <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
                            <label for="tab1" class="label-tab">Descripción</label>

                            <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
                            <label for="tab2" class="label-tab">Ficha Técnica</label>

                            <input type="radio" name="tabset" id="tab3" aria-controls="dunkles">
                            <label for="tab3" class="label-tab">Adjuntos</label>

                            <div class="tab-panels">
                                <section id="marzen" class="tab-panel">
                                    <h2>Descripción</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem repellendus
                                        recusandae accusamus eius sit, porro dolor deserunt sapiente nam ratione non
                                        facere cum illum quaerat, accusantium optio asperiores, quo nesciunt?</p>

                                </section>
                                <section id="rauchbier" class="tab-panel">
                                    <h2>Ficha Técnica</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem repellendus
                                        recusandae accusamus eius sit, porro dolor deserunt sapiente nam ratione non
                                        facere cum illum quaerat, accusantium optio asperiores, quo nesciunt?</p>

                                </section>
                                <section id="dunkles" class="tab-panel">
                                    <h2>Adjuntos</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem repellendus
                                        recusandae accusamus eius sit, porro dolor deserunt sapiente nam ratione non
                                        facere cum illum quaerat, accusantium optio asperiores, quo nesciunt?</p>

                                </section>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        
                    </div>
                </div> -->

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

    let name_product = "<?= (isset($_GET["name"]) ? $_GET["name"] : null)  ?>";
    let idSuministro = "";
    let precio = 0;

    $(document).ready(function() {
        if (name_product == "") {
            history.back()
            return;
        }

        cardStorage.renderCard();

        $(".qty-up").click(function() {
            let cantidad = tools.isNumeric($("#txtCantidad").val()) ? parseInt($("#txtCantidad")
                .val()) : 1;
            cantidad = cantidad <= 0 ? 0 : cantidad;
            cantidad++;
            $("#txtCantidad").val(cantidad);
        });

        $(".qty-down").click(function() {
            let cantidad = tools.isNumeric($("#txtCantidad").val()) ? parseInt($("#txtCantidad")
                .val()) : 1;
            if (cantidad <= 1) {
                return;
            }
            cantidad--;
            $("#txtCantidad").val(cantidad);
        });

        tools.keyNumberInteger($("#txtCantidad"));

        $("#txtCantidad").focusout(function() {
            let cantidad = tools.isNumeric($("#txtCantidad").val()) ? parseInt($("#txtCantidad")
                .val()) : 1;
            cantidad = cantidad <= 0 ? 1 : cantidad;
            $("#txtCantidad").val(cantidad);
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
            precio = parseFloat(result.PrecioVentaGeneral);
            $("#lblName").html(result.NombreMarca);
            $("#lblNewPrice").html("S/ " + tools.formatMoney(result.PrecioVentaGeneral) +
                ' <del class="product-old-price" >S/ ' + tools.formatMoney(result.PrecioVentaAlto) + '</del>');
            let image = '<img src ="./resource/images/noimage.png" alt="' + result.NombreMarca + '"/>';
            if (result.Imagen != "") {
                image = '<img class="img-size-70" src ="' + ("./resource/catalogo/" + result.Imagen) + '" alt="' +
                    result.NombreMarca + '"/>';
            }
            $("#lblImage").html(image);
            $("#txtDescripcion").html(result.Descripcion);
            $("#lblCategoria").html(result.CategoriaNombre);
            $("#lblMarca").html(result.MarcaNombre);
            $("#lblPresentacion").html(result.PresentacionNombre);
            $("#lblUnidad").html(result.UnidadCompraNombre);
            $('#preloader').fadeOut(1000, function() {
                $(this).remove();
            });
        } catch (error) {
            history.back()
            return;
        }
    }

    function addCard() {
        cardStorage.add({
            "idSuministro": idSuministro,
            "cantidad": tools.isNumeric($("#txtCantidad").val()) ? parseInt($("#txtCantidad").val()) : 1,
            "image": $("#lblImage").find("img")[0].src,
            "nombre": $("#lblName").html(),
            "precio": precio,
        });
        cardStorage.renderCard();
        tools.AlertSuccess("", "Se agregó el producto.")
    }
    </script>
</body>

</html>