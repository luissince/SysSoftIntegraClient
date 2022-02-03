<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
        <div class="app-sidebar__user">
                <div class="m-2">
                        <img class="img-fluid" src="./images/logo.png" alt="User Image">
                </div>

                <div class="m-1">
                        <p class="app-sidebar__user-name"><?php echo $_SESSION["RolName"] ?></p>
                </div>
        </div>
        <ul class="app-menu">

                <li>
                        <a class="app-menu__item" id="tab-index" href="index.php">
                                <i class="app-menu__icon fa fa-dashboard"></i>
                                <span class="app-menu__label">Dashboard</span>
                        </a>
                </li>

                <li class="treeview" id="treeview-ingresos">
                        <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-external-link-square" style="transform: rotate(180deg) translateX(12px);"></i>
                                <span class="app-menu__label">Ingresos</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" id="tab-ventas" href="ventas.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Ventas</span></a></li>
                                <li><a class="app-menu__item" id="tab-pago" href="pago.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Pagos recibidos</span></a></li>
                                <li><a class="app-menu__item" id="tab-notacredito" href="notacredito.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Nota de crédito</span></a></li>
                                <li><a class="app-menu__item" id="tab-guiaremision" href="#"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Guía remisión</span></a></li>
                                <li><a class="app-menu__item" id="tab-cotizacion" href="cotizacion.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Cotización</span></a></li>
                        </ul>
                </li>

                <li class="treeview" id="treeview-egresos">
                        <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-external-link-square" style="transform: rotate(0deg) translateX(0px);"></i>
                                <span class="app-menu__label">Gastos</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" id="tab-compras" href="compras.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Compras</span></a></li>
                                <li><a class="app-menu__item" id="tab-cobro" href="cobro.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Pagos echos</span></a></li>
                                <li><a class="app-menu__item" id="tab-ordencompra" href="ordencompra.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Orden de compra</span></a></li>
                        </ul>
                </li>

                <li class="treeview" id="treeview-facturacion"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-skyatlas" style="transform: rotate(180deg) translateX(12px);"></i><span class="app-menu__label">Facturación Electrónica</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" id="tab-cpeelectronicos" href="cpeelectronicos.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">CPE-Electrónicos</span></a></li>
                                <li><a class="app-menu__item" id="tab-consultaindividual" href="consultaindividual.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Consultar Estado</span></a></li>
                                <li><a class="app-menu__item" id="tab-consultaglobal" href="consultaglobal.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Consulta Global</span></a></li>

                        </ul>
                </li>

                <li class="treeview" id="treeview-contactos"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Contactos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" id="tab-clientes" href="clientes.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Clientes</span></a></li>
                                <li><a class="app-menu__item" id="tab-proveedores" href="proveedores.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Proveedores</span></a></li>
                        </ul>
                </li>

                <li class="treeview" id="treeview-inventario"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cubes"></i><span class="app-menu__label">Inventario</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" id="tab-productos" href="productos.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Productos</span></a></li>
                                <!-- <li><a class="app-menu__item" id="tab-inventario" href="inventario.php"><i class="app-menu__icon fa fa-minus"></i><span class="app-menu__label">Inventario</span></a></li> -->
                                <li><a class="app-menu__item" id="tab-kardexproducto" href="kardexproducto.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Kardex</span></a></li>
                                <li><a class="app-menu__item" id="tab-ajustes" href="ajustes.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Ajustes</span></a></li>
                        </ul>
                </li>

                <li>
                        <a class="app-menu__item" id="tab-reporte" href="reporte.php">
                                <i class="app-menu__icon fa fa-book"></i>
                                <span class="app-menu__label">Reportes</span>
                        </a>
                </li>

                <li>
                        <a class="app-menu__item" id="tab-reporte" href="tiendavirtural.php">
                                <i class="app-menu__icon fa fa-desktop"></i>
                                <span class="app-menu__label">Tienda Virtual</span>
                        </a>
                </li>

                <li class="treeview" id="treeview-configuracion">
                        <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-cog"></i>
                                <span class="app-menu__label">Configuración</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu">
                                <li>
                                        <a class="app-menu__item" id="tab-empresa" href="empresa.php">
                                                <i class="app-menu__icon fa fa-circle-o"></i>
                                                <span class="app-menu__label">Empresa</span>
                                        </a>
                                </li>
                                <li>
                                        <a class="app-menu__item" id="tab-mantenimiento" href="mantenimiento.php">
                                                <i class="app-menu__icon fa fa-circle-o"></i>
                                                <span class="app-menu__label">Tabla básica</span>
                                        </a>
                                </li>
                                <li>
                                        <a class="app-menu__item" id="tab-moneda" href="moneda.php">
                                                <i class="app-menu__icon fa fa-circle-o"></i>
                                                <span class="app-menu__label">Moneda</span>
                                        </a>
                                </li>
                                <li>
                                        <a class="app-menu__item" id="tab-comprobante" href="comprobante.php">
                                                <i class="app-menu__icon fa fa-circle-o"></i>
                                                <span class="app-menu__label">Comprobante</span>
                                        </a>
                                </li>
                                <li>
                                        <a class="app-menu__item" id="tab-impuesto" href="impuesto.php">
                                                <i class="app-menu__icon fa fa-circle-o"></i>
                                                <span class="app-menu__label">Impuesto</span>
                                        </a>
                                </li>
                                <li>
                                        <a class="app-menu__item" id="tab-usuario" href="usuario.php">
                                                <i class="app-menu__icon fa fa-circle-o"></i>
                                                <span class="app-menu__label">Usuario</span>
                                        </a>
                                </li>
                                <li>
                                        <a class="app-menu__item" id="tab-almacen" href="almacen.php">
                                                <i class="app-menu__icon fa fa-circle-o"></i>
                                                <span class="app-menu__label">Almacen</span>
                                        </a>
                                </li>
                                <li>
                                        <a class="app-menu__item" id="tab-bancos" href="bancos.php">
                                                <i class="app-menu__icon fa fa-circle-o"></i>
                                                <span class="app-menu__label">Bancos</span>
                                        </a>
                                </li>
                        </ul>
                </li>

        </ul>
</aside>

<script>
        /// Url actual
        let url = window.location.href;

        /// Elementos de li
        const tabs = [
                "index",

                "ventas",
                "pago",
                "notacredito",
                "guiaremision",
                "cotizacion",

                "compras",
                "cobro",
                "ordencompra",

                "cpeelectronicos",
                "consultaindividual",
                "consultaglobal",

                "clientes",
                "proveedores",

                "productos",
                "inventario",
                "kardexproducto",
                "ajustes",
                "ajusteproceso",

                "registrarproducto",
                "actualizarproducto",

                "reporte",
                "empresa",
                "mantenimiento",
                "moneda",
                "usuario",
                "comprobante",
                "bancos"
        ];

        tabs.forEach(e => {
                /// Agregar .php y ver si lo contiene en la url
                if (url.indexOf(e + ".php") !== -1) {
                        /// Agregar tab- para hacer que coincida la Id
                        setActive("tab-" + e);
                }

        });

        /// Funcion que asigna la clase active
        function setActive(id) {
                if (id == "tab-ventas" || id == "tab-pago" || id == "tab-notacredito" || id == "tab-guiaremision" || id == "tab-cotizacion") {
                        document.getElementById("treeview-ingresos").setAttribute("class", "treeview is-expanded");
                        if (id == "tab-ventas") {
                                document.getElementById("tab-ventas").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-pago") {
                                document.getElementById("tab-pago").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-notacredito") {
                                document.getElementById("tab-notacredito").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-guiaremision") {
                                document.getElementById("tab-guiaremision").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-cotizacion") {
                                document.getElementById("tab-cotizacion").setAttribute("class", "app-menu__item active");
                        }
                } else if (id == "tab-compras" || id == "tab-cobro" || id == "tab-ordencompra") {
                        document.getElementById("treeview-egresos").setAttribute("class", "treeview is-expanded");
                        if (id == "tab-compras") {
                                document.getElementById("tab-compras").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-cobro") {
                                document.getElementById("tab-cobro").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-ordencompra") {
                                document.getElementById("tab-ordencompra").setAttribute("class", "app-menu__item active");
                        }
                } else if (id == "tab-cpeelectronicos" || id == "tab-consultaindividual" || id == "tab-consultaglobal") {
                        document.getElementById("treeview-facturacion").setAttribute("class", "treeview is-expanded");
                        if (id == "tab-cpeelectronicos") {
                                document.getElementById("tab-cpeelectronicos").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-consultaindividual") {
                                document.getElementById("tab-consultaindividual").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-consultaglobal") {
                                document.getElementById("tab-consultaglobal").setAttribute("class", "app-menu__item active");
                        }
                } else if (id == "tab-clientes" || id == "tab-proveedores") {
                        document.getElementById("treeview-contactos").setAttribute("class", "treeview is-expanded");
                        if (id == "tab-clientes") {
                                document.getElementById("tab-clientes").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-proveedores") {
                                document.getElementById("tab-proveedores").setAttribute("class", "app-menu__item active");
                        }
                } else if (id == "tab-productos" || id == "tab-inventario" || id == "tab-kardexproducto" || id == "tab-ajustes" || id == "tab-registrarproducto" || id == "tab-ajusteproceso" || id == "tab-actualizarproducto") {
                        document.getElementById("treeview-inventario").setAttribute("class", "treeview is-expanded");
                        if (id == "tab-productos") {
                                document.getElementById("tab-productos").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-inventario") {
                                document.getElementById("tab-inventario").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-kardexproducto") {
                                document.getElementById("tab-kardexproducto").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-ajustes" || id == "tab-ajusteproceso") {
                                document.getElementById("tab-ajustes").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-registrarproducto") {
                                document.getElementById("tab-productos").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-actualizarproducto") {
                                document.getElementById("tab-productos").setAttribute("class", "app-menu__item active");
                        }
                } else if (id == "tab-reporte") {
                        if (id == "tab-reporte") {
                                document.getElementById("tab-reporte").setAttribute("class", "app-menu__item active");
                        }
                } else if (id == "tab-empresa" || id == "tab-mantenimiento" || id == "tab-usuario" || id == "tab-moneda" || id == "tab-comprobante" || id == "tab-bancos") {
                        document.getElementById("treeview-configuracion").setAttribute("class", "treeview is-expanded");
                        if (id == "tab-empresa") {
                                document.getElementById("tab-empresa").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-mantenimiento") {
                                document.getElementById("tab-mantenimiento").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-moneda") {
                                document.getElementById("tab-moneda").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-comprobante") {
                                document.getElementById("tab-comprobante").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-bancos") {
                                document.getElementById("tab-bancos").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-usuario") {
                                document.getElementById("tab-usuario").setAttribute("class", "app-menu__item active");
                        }
                } else {
                        document.getElementById(id).setAttribute("class", "app-menu__item active");
                }
        }
</script>