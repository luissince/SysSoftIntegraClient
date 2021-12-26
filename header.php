<div class="header-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12 text-center p-2">
                <a href="#">
                    <span class="text-white band_text">TODOS LOS PRODUCTOS PARA SU CARRO EN UN SOLO LUGAR</span>
                    <!-- <span class="band_button">Ver ofertas</span> -->
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-12 p-2">
                <div class="my-justify-center d-flex align-items-lg-center h-100">
                    <div class="header-logo pl-1 pr-1">
                        <a href="./">
                            <img src="resource/images/logo.svg" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-12 col-12 p-2">
                <div class="my-justify-center d-flex align-items-lg-center h-100">
                    <div id="result_categorias">
                        <div class="button_combo">
                            <button id="btnSearch" class="button-vendor">
                                Buscar
                            </button>
                        </div>
                    </div>

                    <div id="resultado_input">
                        <div class="input_amz">
                            <div id="search-lupa" class="lupa"></div>
                            <input id="txtSearch" placeholder="Buscar entre mil millones de productos" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-12 p-2">
                <div class=" my-justify-center d-flex align-items-lg-center justify-content-end h-100">

                    <!-- <div class="lang_selector flag-pe">
                        <div class="lang_selected">
                            <div class="lang_selected imagen_sprite"></div>
                        </div>
                    </div> -->

                    <!-- <a class="text-white text-options" href="#" title="Regístrate">Regístrate</a>

                    <a class="text-white text-options" href="#" title="Regístrate">Mi Cuenta</a> -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 col-12 p-2">
                <div class="d-flex align-items-lg-center h-100">
                    <image class="p-1" src="./resource/images/menu.svg" />
                    <span class="text-white pt-1 pb-1 pl-2 pr-2 text-categoria">Todas las categorías</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-2 ">
                <div class="d-flex align-items-lg-center h-100">
                    <a class="text-white pt-1 pb-1 pl-2 pr-2" href="./">
                        Inicio
                    </a>
                    <a class="text-white  pt-1 pb-1 pl-2 pr-2" href="./catalogo.php">
                        Catálogo
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-12 p-2">
                <div class="d-flex align-items-lg-center justify-content-end h-100">
                    <div class="block-cart-header">
                        <div class="block-content">
                            <a href="javascript:void(0)" id="btnCartAction" class="pt-1 pb-1 pl-2 pr-2">
                                <i class="fa fa-shopping-cart fa-lg"></i>
                                <span class="monto" id="count-cart">0</span>
                                <span>&nbsp;Mi Carrito</span>
                            </a>
                            <div id="capa" class="cart-content">
                                <div>
                                    <ol id="card-add" class="cart-sidebar">
                                    </ol>
                                    <p class="subtotal">
                                        <span class="text">Subtotal del carrito:</span>
                                        <span class="price" id="cart-total">0.00 </span>
                                    </p>
                                    <div class="actions">
                                        <button id="btnDetalleCart" type="button" title="Ver carrito" class="btn_action btn_cart">
                                            Ver carrito
                                        </button>
                                        <!-- <button type="button" title="Finalizar compra" class="btn_action btn_checkout">
                                            Finalizar compra
                                        </button> -->
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