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
    <link rel="stylesheet" type="text/css" href="view/css/glider.min.css?v=<?php echo (rand()); ?>">

</head>

<body>

    <div id="preloader">
    </div>

    <?php include './header.php'; ?>

    <div class="slider-container">
        <div class="glider-contain">
            <div class="glider-slider">
                <div class="resizer">
                    <picture class="image-wrapper">
                        <img src="resource/images/slider1.png" />
                    </picture>
                </div>
                <div class="resizer">
                    <picture class="image-wrapper">
                        <img src="resource/images/slider2.png" />
                    </picture>
                </div>
                <div class="resizer">
                    <picture class="image-wrapper">
                        <img src="resource/images/slider3.png" />
                    </picture>
                </div>
                <div class="resizer">
                    <picture class="image-wrapper">
                        <img src="resource/images/slider4.png" />
                    </picture>
                </div>
            </div>

            <button aria-label="Previous" class="flex-prev flex-button">Previous</button>
            <button aria-label="Next" class="flex-next flex-button">Next</button>
            <div class="flex-point">
                <div role="tablist" class="dots"></div>
            </div>
        </div>
    </div>

    <div id="category-content">
        <div class="container">
            <div class="glider-contain">
                <div class="glider-category">
                    <!-- <div class="item-slider-category">
                        <a href="#" title=" Relojes">
                            <span class="img-slider-category" style="background: url(https://tiendamia.com/newsletter/materiales/categorias/sprite-categorias-home-2020-octubre-min.png) 0px 0px;background-color:<?php echo 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';  ?>"></span>
                            <span>Relojes</span>
                        </a>
                    </div>
                    <div class="item-slider-category">
                        <a href="#" title="Relojes">
                            <span class="img-slider-category" style="background: url(https://tiendamia.com/newsletter/materiales/categorias/sprite-categorias-home-2020-octubre-min.png) -130px 0px;background-color:<?php echo 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';  ?>"></span>
                            <span>Relojes</span>
                        </a>
                    </div>
                    <div class="item-slider-category">
                        <a href="#" title="Relojes">
                            <span class="img-slider-category" style="background: url(https://tiendamia.com/newsletter/materiales/categorias/sprite-categorias-home-2020-octubre-min.png) -520px 0px;background-color:<?php echo 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';  ?>"></span>
                            <span>Relojes</span>
                        </a>
                    </div>
                    <div class="item-slider-category">
                        <a href="#" title="Relojes">
                            <span class="img-slider-category" style="background: url(https://tiendamia.com/newsletter/materiales/categorias/sprite-categorias-home-2020-octubre-min.png) 0px -130px;background-color:<?php echo 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';  ?>"></span>
                            <span>Relojes</span>
                        </a>
                    </div>
                    <div class="item-slider-category">
                        <a href="#" title="Relojes">
                            <span class="img-slider-category" style="background: url(https://tiendamia.com/newsletter/materiales/categorias/sprite-categorias-home-2020-octubre-min.png) -260px -520px;background-color:<?php echo 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';  ?>"></span>
                            <span>Relojes</span>
                        </a>
                    </div>
                    <div class="item-slider-category">
                        <a href="#" title="Relojes">
                            <span class="img-slider-category" style="background: url(https://tiendamia.com/newsletter/materiales/categorias/sprite-categorias-home-2020-octubre-min.png) -130px -130px;background-color:<?php echo 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';  ?>"></span>
                            <span>Relojes</span>
                        </a>
                    </div>
                    <div class="item-slider-category">
                        <a href="#" title="Relojes">
                            <span class="img-slider-category" style="background: url(https://tiendamia.com/newsletter/materiales/categorias/sprite-categorias-home-2020-octubre-min.png) -130px -260px;background-color:<?php echo 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';  ?>"></span>
                            <span>Relojes</span>
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="products-content">
        <div class="container">
            <div class="page-title">
                <a href="#">
                    <h3>Productos destacados <span>Ver más</span></h3>
                </a>
            </div>
        </div>

        <div class="container">
            <div class="glider-contain">
                <div class="glider-products1">

                </div>
                <button aria-label="Previous" class="products1-prev control-prev"></button>
                <button aria-label="Next" class="products1-next control-next"></button>
            </div>
        </div>
    </div>

    <div class="message-content">
        <div class="container">
            <h2>Descubre todos los productos para su carro en un solo lugar</h2>

            <div class="message-subtitle">
                <span class=""></span>
                <button class="button-transparent">
                    Quiero ver más
                </button>
            </div>

        </div>
    </div>

    <div class="products-content">
        <div class="container">
            <div class="page-title">
                <a href="#">
                    <h3>Productos destacados <span>Ver más</span></h3>
                </a>
            </div>
        </div>

        <div class="container">
            <div class="glider-contain">
                <div class="glider-products2">

                </div>
                <button aria-label="Previous" class="products2-prev control-prev"></button>
                <button aria-label="Next" class="products2-next control-next"></button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="banner-publicidad">
            <div class="inner-div">
                <p class="text-1">Conviértete en un</p>
                <p class="text-2">Cliente Estrella de LeatSac</p>
            </div>

            <div class="inner-div">
                <div class="boxes">
                    <span class="box-svg box_1"></span>
                    <span class="box-svg box_2"></span>
                    <span class="box-svg box_3"></span>
                    <span class="box-svg box_4"></span>
                    <span class="text-3">=</span>
                    <span class="box-svg last-box"></span>
                </div>
            </div>

            <div class="inner-div">
                <p class="text-1">Cada 12 pedidos que realices</span>
                </p>
                <p class="text-2">¡Se le va hacer un descuento!</p>
            </div>

            <div class="inner-div">
                <a href="" class="button-primary">
                    Más información
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="banners-info">
            <div class="inner-div">
                <span class="icon-svg box-svg"></span>
                <p>¿ Qué es LeatSac.com ? Catalogo de productos fácil de usar, rápido y seguro de cotizar.
                    <!-- <a id="como_comprar_light">Cómo comprar</a> -->
                </p>
            </div>
            <div class="inner-div border-left">
                <span class="icon-svg aduanas-svg"></span>
                <p>Información de envio de productos a Provincia. Hacemos todo por ti.
                    <!-- <a href="#informacion_aduana_modal">Saber más</a> -->
                </p>
            </div>
            <div class="inner-div border-left">
                <div class="cards-container">
                    <span class="visa-svg solo_ar solo_uy solo_pe solo_ec"></span>
                    <span class="master-svg solo_ar solo_uy solo_pe solo_ec"></span>
                    <span class="amex-svg solo_ar solo_uy solo_pe solo_ec"></span>
                    <span class="pagoefectivo-svg solo_pe"></span>
                </div>
                <p class="solo_uy solo_pe solo_cl">Paga con crédito o débito. <br>
                    <a class="solo_uy text-primary" href="./catalogo.php">Ver promociones</a>
                </p>
            </div>
            <div class="inner-div border-left">
                <span class="icon-svg help-svg"></span>
                <p>Comunicate con nosotros. Centro de ayuda en línea y atencion al cliente.
                    <!-- <a class="solo_ar">Centro de ayuda en línea</a> -->
                    <!-- <br> -->
                    <a class="solo_uy solo_pe solo_cl solo_ec text-primary" href="https://api.whatsapp.com/send?phone=+51<?= $empresa->Celular ?>" target="_blank">Resolver dudas</a>
                </p>
            </div>
        </div>
    </div>

    <?php include './footer.php'; ?>

    <script src="view/js/jquery-3.3.1.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
    <script src="view/js/main.js?v=<?php echo (rand()); ?>"></script>
    <script src="view/js/glider.min.js"></script>
    <script src="view/js/tools.js?v=<?php echo (rand()); ?>"></script>
    <script src="resource/storage/cardStorage.js?v=<?php echo (rand()); ?>"></script>
    <script>
        let tools = new Tools();
        let cardStorage = new CardStorage();

        $(document).ready(function() {
            cardStorage.renderCard();

            let gliderSlider = new Glider(document.querySelector('.glider-slider'), {
                slidesToShow: 1,
                slidesToScroll: 1,
                itemWidth: 1500,
                draggable: true,
                dots: '.dots',
                arrows: {
                    prev: '.flex-prev',
                    next: '.flex-next'
                }
            });

            slideAutoPaly(gliderSlider, '.glider-slider');

            let gliderCategory = new Glider(document.querySelector('.glider-category'), {
                slidesToShow: 5,
                slidesToScroll: 5,
                itemWidth: 130,
                draggable: true,
            });

            fillProductosDestacados();

        });

        async function fillProductosDestacados() {
            try {
                let result1 = await tools.promiseFetchGet("./app/controller/SuministroController.php", {
                    "type": "destacados",
                    "posicionPagina": 0,
                    "filasPorPagina": 10
                }, function() {
                    $(".glider-products1").empty();
                    $(".glider-products1").append(messageLoading());
                    $(".products1-prev").css("display", "none");
                    $(".products1-next").css("display", "none");
                });
                $(".glider-products1").empty();

                if (result1.length == 0) {
                    $(".glider-products1").append(messageNoData());
                } else {
                    for (let value of result1) {
                        // console.log(value)
                        let image = '<img src ="./resource/images/noimage.png" alt="' + value.NombreMarca + '"/>';
                        if (value.Imagen != "") {
                            image = '<img class="img-size-70" src ="' + ("./resource/catalogo/" + value.Imagen) + '" alt="' + value.NombreMarca + '"/>';
                        }
                        $(".glider-products1").append(item(
                            image,
                            tools.limitar_cadena(value.NombreMarca, 60, '...'),
                            tools.formatMoney(value.PrecioVentaAlto),
                            tools.formatMoney(value.PrecioVentaGeneral),
                            value.Clave
                        ));
                    }
                    $(".products1-prev").css("display", "block");
                    $(".products1-next").css("display", "block");

                    let gliderProducts1 = new Glider(document.querySelector('.glider-products1'), {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                        itemWidth: 220,
                        draggable: true,
                        arrows: {
                            prev: '.products1-prev',
                            next: '.products1-next'
                        }
                    });
                }

                let result2 = await tools.promiseFetchGet("./app/controller/SuministroController.php", {
                    "type": "destacados",
                    "posicionPagina": 10,
                    "filasPorPagina": 10
                }, function() {
                    $(".glider-products2").empty();
                    $(".glider-products2").append(messageLoading());
                    $(".products2-prev").css("display", "none");
                    $(".products2-next").css("display", "none");
                });
                $(".glider-products2").empty();

                if (result2.length == 0) {
                    $(".glider-products2").append(messageNoData());
                } else {
                    for (let value of result2) {
                        let image = '<img src ="./resource/images/noimage.png" alt="' + value.NombreMarca + '"/>';
                        if (value.Imagen != "") {
                            image = '<img class="img-size-70" src ="' + ("./resource/catalogo/" + value.Imagen) + '" alt="' + value.NombreMarca + '"/>';
                        }
                        $(".glider-products2").append(item(
                            image,
                            tools.limitar_cadena(value.NombreMarca, 60, '...'),
                            tools.formatMoney(value.PrecioVentaAlto),
                            tools.formatMoney(value.PrecioVentaGeneral),
                            value.Clave
                        ));
                    }
                    $(".products2-prev").css("display", "block");
                    $(".products2-next").css("display", "block");

                    let gliderProducts2 = new Glider(document.querySelector('.glider-products2'), {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                        itemWidth: 220,
                        draggable: true,
                        arrows: {
                            prev: '.products2-prev',
                            next: '.products2-next'
                        }
                    });
                }
            } catch (error) {
                $(".glider-products1").empty();
                $(".glider-products1").append(messageNoData());

                $(".glider-products2").empty();
                $(".glider-products2").append(messageNoData());
            }
            $('#preloader').fadeOut(1000, function() {
                $(this).remove();
            });
        }

        function item(image, name, priceold, pricenew, clave) {
            return `    
            <a href="./producto.php?name=${clave}" class="item">
                        <span class="img_oferta">
                            <span class="text-aviso-item">
                                INSUPERABLES
                            </span>
                        </span>
                        <span class="img_oferta sin_impuestos">
                            <span class="text-impuesto">
                                <b>CON</b>
                                IMPUESTO
                            </span>
                        </span>
                        <span class="product-image">
                           ${image}
                        </span>
                        <div class="block_holder">
                            <h2 class="product-name ">
                                <span>${name}</span>
                            </h2>
                            <div class="price-desde">
                                <span class="list-price currency_price">S/ ${priceold}</span>
                                <span class="discount_blackfriday">10% OFF</span>
                            </div>
                            <div class="price-box">
                                <span class="price_blackfriday currency_price">S/ ${pricenew}</span>                               
                            </div>
                            <div class="rating-fav">
                                <div class="rating-box">
                                    <div id="rating_producto_ajax" class="rating a-icon a-icon-star a-star-4-5"></div>
                                </div>
                            </div>
                            <span class="regular-price">
                                <p>
                                    Oferta del día
                                </p>
                                <span>Productos únicos</span>
                            </span>
                            <div class="csiFormatText">
                                <p class="text-justify">
                                    <span class="csiGreenText">Envío a todo el Perú, puedes pagar con tus tarjetas preferidas</span>
                                    <strong>Visa Mastercard y Amex a través de PayPal</strong>
                                    <br class="showInCart">
                                </p>
                            </div>
                        </div>
                    </a>`;
        }

        function messageLoading() {
            return `<div class="d-flex flex-column justify-content-center align-items-center p-5">
                                    <img width="96" height="96" class="d-block animate-image" src="resource/images/noproducto.png" />
                                    <h4>Cargando lista de productos...</h4>
                                </div>`;
        }

        function messageNoData() {
            return `<div class="d-flex flex-column justify-content-center align-items-center p-5">
                                    <img width="96" height="96" class="d-block" src="resource/images/noproducto.png" />
                                    <h4>No se encontraron productos que coincidan con la busqueda.</h4>
                                </div>
                            `;
        }

        function slideAutoPaly(glider, selector, delay = 3000, repeat = true) {
            let autoplay = null;
            const slidesCount = glider.track.childElementCount;
            let nextIndex = 1;
            let pause = true;

            function move(pos) {
                if (nextIndex >= slidesCount) {
                    if (!repeat) {
                        clearInterval(autoplay);
                    } else {
                        nextIndex = 0;
                    }
                }
                glider.scrollItem(nextIndex++);
            }

            function slide() {
                autoplay = setInterval(() => {
                    move();
                }, delay);
            }

            slide();

        }
    </script>
</body>

</html>