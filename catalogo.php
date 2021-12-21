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

    <div class="catalogo-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="aside">
                        <h4 class="aside-title">Categorias</h4>
                        <div class="navmenu">
                            <ul class="menu" id="divCategorias">
                                <div>
                                    <span> No hay categorías para mostrar.</span>
                                </div>
                            </ul>
                        </div>
                    </div>

                    <div class="aside">
                        <h4 class="aside-title">Marcas</h4>
                        <div class="navmenu">
                            <ul class="menu" id="divMarcas">
                                <div>
                                    <span> No hay marcas para mostrar.</span>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-12 col-sm-12 col-12">

                    <div class="store">
                        <div class="store-title">
                            <h4 id="lblTotalRows">Se encontraron 0 productos</h4>
                        </div>
                        <div class="store-filter">
                            <button id="liGrip" class="active-input"><i class="fa fa-th"></i></button>
                            <button id="liList"><i class="fa fa-th-list"></i></button>
                        </div>
                    </div>

                    <div class="list">
                        <div class="row" id="divCatalogo">

                        </div>
                    </div>

                    <div class="page">
                        <div class="title-pg">
                            <p id="lblTitlePagination">Mostrando 0 de 0 Páginas</p>
                        </div>
                        <div class="content-pg">
                            <ul class="store-pagination" id="myPager">
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include './footer.php'; ?>

    <script src="view/js/jquery-3.3.1.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
    <script src="view/js/main.js"></script>
    <script src="view/js/tools.js"></script>
    <script>
        let tools = new Tools();

        let state = false;
        let paginacion = 0;
        let upperPageBound = 3;
        let lowerPageBound = 0;
        let isPrevBtnActive = 'disabled';
        let isNextBtnActive = '';
        let pageBound = 3;
        let opcion = 0;
        let totalPaginacion = 0;
        let filasPorPagina = 12;
        let divCatalogo = $("#divCatalogo");

        let idCategoria = 0;
        let idMarca = 0;

        $(document).ready(function() {

            $("#liGrip").click(function() {
                if ($("#liList").hasClass("active-input")) {
                    $("#liList").removeClass("active-input");
                }
                $("#liGrip").addClass("active-input");
            });

            $("#liList").click(function() {
                if ($("#liGrip").hasClass("active-input")) {
                    $("#liGrip").removeClass("active-input");
                }
                $("#liList").addClass("active-input");
            });

            $("#txtSearch").keypress(function(event) {
                if (event.which == 13) {
                    if ($("#txtSearch").val().trim().length != 0) {
                        if (!state) {
                            paginacion = 1;
                            fillProductsTable(1, $("#txtSearch").val().trim(), 0, 0);
                            opcion = 1;
                        }
                    }
                    event.preventDefault();
                }
            });

            $("#btnSearch").click(function() {
                if ($("#txtSearch").val().trim().length != 0) {
                    if (!state) {
                        paginacion = 1;
                        fillProductsTable(1, $("#txtSearch").val().trim(), 0, 0);
                        opcion = 1;
                    }
                }
            });


            $("#btnSearch").keypress(function(event) {
                if (event.which == 13) {
                    if ($("#txtSearch").val().trim().length != 0) {
                        if (!state) {
                            paginacion = 1;
                            fillProductsTable(1, $("#txtSearch").val().trim(), 0, 0);
                            opcion = 1;
                        }
                    }
                    event.preventDefault();
                }
            });

            loadCategoria();
            loadMarca();
            let searchUrl = "<?php echo isset($_GET["search"]) ? $_GET["search"] : ""; ?>";

            if (searchUrl !== "") {
                if (!state) {
                    paginacion = 1;
                    fillProductsTable(1, searchUrl, 0, 0);
                    opcion = 1;
                }
            } else {
                loadInitProductos();
            }

            $('#preloader').fadeOut(1000, function() {
                $(this).remove();
            });
        });

        async function loadCategoria() {
            try {
                let result = await tools.promiseFetchGet("./app/controller/DetalleController.php", {
                    "type": "categoriaproducto"
                }, function() {
                    $("#divCategorias").empty();
                    $("#divCategorias").html('Cargando categorías...');
                });
                $("#divCategorias").empty();

                let abc = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
                let objectAbc = [];
                for (let i of abc) {
                    let arrabc = result.filter(function(value) {
                        return value.Nombre.substr(0, 1).toUpperCase() == i;
                    });
                    objectAbc.push({
                        "tipo": i,
                        "categorias": arrabc
                    })
                }

                for (let value of objectAbc) {
                    if (value.categorias.length > 0) {
                        let ulCategorie = '<ul class="accordion_menu">';
                        for (let a of value.categorias) {
                            ulCategorie += '<li><a href="javascript:void(0)" onclick="onEventCheckCategoria(\'' + a.IdDetalle + '\')">' + a.Nombre + '<small>(' + a.Cantidad + ')</small></a></li>';
                        }
                        ulCategorie += '</ul>';

                        $("#divCategorias").append(`
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <span class="icon"><i class="fa fa-stop"></i></span>
                                                        <span class="title">${value.tipo} <small>(${value.categorias.length})</small></span>
                                                        <span class="arrow"><i class="fa fa-sort-down"></i></span>
                                                    </a>
                                                    ${value.categorias.length>0?ulCategorie:""}                                    
                                                </li>
                                            `);
                    }
                }

                $(".navmenu #divCategorias.menu li a").click(function() {
                    if ($(this).parent().hasClass("active")) {
                        $(this).parent().removeClass("active");
                    } else {
                        $(".navmenu ul.menu li").removeClass("active");
                        $(this).parent().addClass("active");
                    }
                });

                $("ul.accordion_menu li a").click(function() {
                    $(this).parent().parent().parent().addClass("active");
                });
            } catch (error) {
                $("#divCategorias").empty();
                $("#divCategorias").html('No hay categorías para mostrar.');
            }
        }

        async function loadMarca() {
            try {
                let result = await tools.promiseFetchGet("./app/controller/DetalleController.php", {
                    "type": "marcaproducto"
                }, function() {
                    $("#divMarcas").empty();
                    $("#divMarcas").html('Cargando categorías...');
                });
                $("#divMarcas").empty();

                if (result.length == 0) {
                    $("#divMarcas").html('No hay marcas para mostrar.');
                    return;
                }

                let abc = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
                let objectAbc = [];
                for (let i of abc) {
                    let arrabc = result.filter(function(value) {
                        return value.Nombre.substr(0, 1).toUpperCase() == i;
                    });
                    objectAbc.push({
                        "tipo": i,
                        "marcas": arrabc
                    })
                }

                for (let value of objectAbc) {
                    if (value.marcas.length > 0) {
                        let ulMarca = '<ul class="accordion_menu">';
                        for (let a of value.marcas) {
                            ulMarca += '<li><a href="javascript:void(0)" onclick="onEventCheckMarca(\'' + a.IdDetalle + '\')">' + a.Nombre + '<small>(' + a.Cantidad + ')</small></a></li>';
                        }
                        ulMarca += '</ul>';

                        $("#divMarcas").append(`
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <span class="icon"><i class="fa fa-stop"></i></span>
                                                        <span class="title">${value.tipo} <small>(${value.marcas.length})</small></span>
                                                        <span class="arrow"><i class="fa fa-sort-down"></i></span>
                                                    </a>
                                                    ${value.marcas.length>0?ulMarca:""}                                    
                                                </li>
                                            `);
                    }
                }

                $(".navmenu #divMarcas.menu li a").click(function() {
                    if ($(this).parent().hasClass("active")) {
                        $(this).parent().removeClass("active");
                    } else {
                        $(".navmenu ul.menu li").removeClass("active");
                        $(this).parent().addClass("active");
                    }
                });

                $("ul.accordion_menu li a").click(function() {
                    $(this).parent().parent().parent().addClass("active");
                });

            } catch (error) {
                $("#divMarcas").empty();
                $("#divMarcas").html('No hay marcas para mostrar.');

            }
        }

        function onEventPaginacion() {
            switch (opcion) {
                case 0:
                    fillProductsTable(0, "", 0, 0);
                    break;
                case 1:
                    fillProductsTable(1, $("#txtSearch").val().trim(), 0, 0);
                    break;
                case 2:
                    fillProductsTable(2, "", idCategoria, 0);
                    break;
                case 3:
                    fillProductsTable(3, "", 0, idMarca);
                    break;
            }
        }

        function loadInitProductos() {
            if (!state) {
                paginacion = 1;
                fillProductsTable(0, "", 0, 0);
                opcion = 0;
            }
        }

        async function fillProductsTable(opcion, buscar, categoria, marca) {
            try {
                let result = await tools.promiseFetchGet("./app/controller/SuministroController.php", {
                    "type": "catalogo",
                    "opcion": opcion,
                    "buscar": buscar,
                    "categoria": categoria,
                    "marca": marca,
                    "posicionPagina": ((paginacion - 1) * filasPorPagina),
                    "filasPorPagina": filasPorPagina
                }, function() {
                    divCatalogo.empty();
                    divCatalogo.append(messageLoading());
                    $("#lblTotalRows").html('Se encontraron 0 resultados.');
                    $("#lblTitlePagination").html('Mostrando 0 de 0 Páginas');
                    totalPaginacion = 0;
                    state = true;
                });
                divCatalogo.empty();

                if (result.data.length == 0) {
                    divCatalogo.append(messageNoData());
                    return;
                }

                $("#lblTotalRows").html(`Se encontraron ${result.data.length} resultados.`);

                for (let value of result.data) {
                    let image = '<img src ="./resource/images/noimage.png" alt="' + value.NombreMarca + '"/>';
                    if (value.Imagen != "") {
                        image = '<img class="img-size-70" src ="' + ("./resource/catalogo/" + value.Imagen) + '" alt="' + value.NombreMarca + '"/>';
                    }
                    divCatalogo.append(
                        item(
                            image,
                            limitar_cadena(value.NombreMarca, 60, '...'),
                            tools.formatMoney(value.PrecioVentaAlto),
                            tools.formatMoney(value.PrecioVentaGeneral)));
                }

                totalPaginacion = parseInt(Math.ceil((parseFloat(result.total) / filasPorPagina)));
                $("#lblTitlePagination").html(`Mostrando ${result.data.length} de ${totalPaginacion} Páginas`);

                const pageNumbers = [];
                for (let i = 1; i <= totalPaginacion; i++) {
                    pageNumbers.push(i);
                }

                const renderPageNumbers = pageNumbers.map(number => {
                    if (number === 1 && paginacion === 1) {
                        return (
                            `<li><a href="javascript:void(0)" id=${number} class="active-input" onclick="handleClick(this)">${number}</a></li>`
                        )
                    } else if ((number < upperPageBound + 1) && number > lowerPageBound) {
                        return (
                            `<li><a href="javascript:void(0)" id=${number} onclick="handleClick(this)">${number}</a></li>`
                        )
                    }
                });

                let pageIncrementBtn = null;
                if (pageNumbers.length > upperPageBound) {
                    pageIncrementBtn = `<li><a href="javascript:void(0)" onclick="btnIncrementClick()"> &hellip; </a></li>`;
                }

                let pageDecrementBtn = null;
                if (lowerPageBound >= 1) {
                    pageDecrementBtn = `<li><a href="javascript:void(0)" onclick="btnDecrementClick()"> &hellip; </a></li>`;
                }

                let renderPrevBtn = null;
                if (isPrevBtnActive === 'disabled') {
                    renderPrevBtn = `<li><a href="javascript:void(0)" class='${isPrevBtnActive}' id="btnPrev"> Prev </a></li>`;
                } else {
                    renderPrevBtn = `<li><a href="javascript:void(0)" class='${isPrevBtnActive}' id="btnPrev" onclick="btnPrevClick()"> Prev </a></li>`;
                }

                let renderNextBtn = null;
                if (isNextBtnActive === 'disabled') {
                    renderNextBtn = `<li><a href="javascript:void(0)" class='${isNextBtnActive}' id="btnNext"> Next </a></li>`;
                } else {
                    renderNextBtn = `<li><a href="javascript:void(0)" class='${isNextBtnActive}' id="btnNext" onclick="btnNextClick()"> Next </a></li>`;
                }


                $("#myPager").empty();
                $("#myPager").append(renderPrevBtn);
                $("#myPager").append(pageDecrementBtn);
                $("#myPager").append(renderPageNumbers);
                $("#myPager").append(pageIncrementBtn);
                $("#myPager").append(renderNextBtn);

                $("#myPager li a.active-input").removeClass('active-input');
                $('#myPager li a#' + paginacion).addClass('active-input');
                state = false;
            } catch (error) {
                console.log(error)
                divCatalogo.empty();
                divCatalogo.append(messageNoData());
                state = false;
            }
        }

        function item(image, name, priceold, pricenew) {
            return `    
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="item item-alter">
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
                                        <div class="csiFormatText">
                                            <p>
                                                <span class="csiGreenText">Envío a todo el Perú, puedes pagar con tus tarjetas preferidas</span>
                                                <strong>Visa Mastercard y Amex a través de PayPal</strong>
                                                <br class="showInCart">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                </div>`;
        }

        function limitar_cadena(cadena, limite, sufijo) {
            if (cadena.length > limite) {
                return cadena.substr(0, limite) + sufijo;
            }
            return cadena;
        }

        function messageLoading() {
            return `<div class="col-md-12 col-sm-12 col-12">
                                <div class="d-flex flex-column justify-content-center align-items-center p-5">
                                    <img width="96" height="96" class="d-block animate-image" src="resource/images/noproducto.png" />
                                    <h4>Cargando lista de productos...</h4>
                                </div>
                            </div>`
        }

        function messageNoData() {
            return `<div class="col-md-12 col-sm-12 col-12">
                                <div class="d-flex flex-column justify-content-center align-items-center p-5">
                                    <img width="96" height="96" class="d-block" src="resource/images/noproducto.png" />
                                    <h4>No se encontraron productos que coincidan con la busqueda.</h4>
                                </div>
                            </div>`;
        }

        function handleClick(event) {
            let listid = parseInt(event.id);
            paginacion = listid;
            $("#myPager li a.active-input").removeClass('active-input');
            $('#myPager li a#' + listid).addClass('active-input');
            setPrevAndNextBtnClass(listid);
        }

        function btnIncrementClick() {
            upperPageBound = upperPageBound + pageBound;
            lowerPageBound = lowerPageBound + pageBound;
            let listid = lowerPageBound + 1;
            paginacion = listid;
            setPrevAndNextBtnClass(listid);
        }

        function btnDecrementClick() {
            upperPageBound = upperPageBound - pageBound;
            lowerPageBound = lowerPageBound - pageBound;
            let listid = upperPageBound;
            paginacion = listid;
            setPrevAndNextBtnClass(listid);
        }

        function btnPrevClick() {
            if ((paginacion - 1) % pageBound === 0) {
                upperPageBound = upperPageBound - pageBound;
                lowerPageBound = lowerPageBound - pageBound;
            }
            let listid = paginacion - 1;
            paginacion = listid;
            setPrevAndNextBtnClass(listid);
        }

        function btnNextClick() {
            if ((paginacion + 1) > upperPageBound) {
                upperPageBound = upperPageBound + pageBound;
                lowerPageBound = lowerPageBound + pageBound;
            }
            let listid = paginacion + 1;
            paginacion = listid;
            setPrevAndNextBtnClass(listid);
        }

        function setPrevAndNextBtnClass(listid) {
            isNextBtnActive = 'disabled';
            isPrevBtnActive = 'disabled';

            if (totalPaginacion === listid && totalPaginacion > 1) {
                isPrevBtnActive = '';
            } else if (listid === 1 && totalPaginacion > 1) {
                isNextBtnActive = '';
            } else if (totalPaginacion > 1) {
                isNextBtnActive = '';
                isPrevBtnActive = '';
            }
            onEventPaginacion();
        }

        function onEventCheckCategoria(idDetalle) {
            idCategoria = idDetalle;
            if (!state) {
                paginacion = 1;
                fillProductsTable(2, "", idCategoria, 0);
                opcion = 2;
            }
        }

        function onEventCheckMarca(idDetalle) {
            idMarca = idDetalle;
            if (!state) {
                paginacion = 1;
                fillProductsTable(3, "", 0, idMarca);
                opcion = 3;
            }
        }
    </script>
</body>

</html>