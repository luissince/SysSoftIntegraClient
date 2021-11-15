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

                <li class="treeview" id="treeview-ingresos"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-external-link-square" style="transform: rotate(180deg) translateX(12px);"></i><span class="app-menu__label">Ingresos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" id="tab-ventas" href="ventas.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Ventas</span></a></li>
                                <li><a class="app-menu__item" id="tab-pagosrecibidos" href="#"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Pagos recibidos</span></a></li>
                                <li><a class="app-menu__item" id="tab-notacredito" href="notacredito.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Nota de crédito</span></a></li>
                                <li><a class="app-menu__item" id="tab-guiaremision" href="#"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Guía remisión</span></a></li>
                                <li><a class="app-menu__item" id="tab-cotizacion" href="cotizacion.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Cotización</span></a></li>
                        </ul>
                </li>

                <li class="treeview" id="treeview-facturacion"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-skyatlas" style="transform: rotate(180deg) translateX(12px);"></i><span class="app-menu__label">Facturación Electrónica</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" id="tab-comprobantes" href="comprobantes.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Boletas/Facturas</span></a></li>
                                <li><a class="app-menu__item" id="tab-creditofactura" href="creditofactura.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Nota de Crédito</span></a></li>
                                <li><a class="app-menu__item" id="tab-debitofactura" href="#"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Nota de Débito</span></a></li>
                                <li><a class="app-menu__item" id="tab-consultaindividual" href="consultaindividual.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Consultar Estado</span></a></li>
                                <li><a class="app-menu__item" id="tab-consultaglobal" href="consultaglobal.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Consulta Global</span></a></li>

                        </ul>
                </li>

                <!-- <li class="treeview">
                        <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-external-link-square"></i>
                                <span class="app-menu__label">Gastos</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                        </a>
                </li> -->

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


                <!-- <li>
                        <a class="app-menu__item" href="#">
                                <i class="app-menu__icon fa fa-university"></i>
                                <span class="app-menu__label">Bancos</span>
                        </a>
                </li>


                <li class="treeview">
                        <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-fax"></i>
                                <span class="app-menu__label">Contabilidad</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                        </a>
                </li>-->

                <li>
                        <a class="app-menu__item" id="tab-reporte" href="reporte.php">
                                <i class="app-menu__icon fa fa-book"></i>
                                <span class="app-menu__label">Reportes</span>
                        </a>
                </li>

                <!--<li>
                        <a class="app-menu__item" id="tab-reportes" href="#">
                                <i class="app-menu__icon fa fa-bar-chart"></i>
                                <span class="app-menu__label">Gráficos</span>
                        </a>
                </li> 

                <li>
                        <a class="app-menu__item" id="tab-graficos" href="#">
                                <i class="app-menu__icon fa fa-laptop"></i>
                                <span class="app-menu__label">Tienda en Línea</span>
                        </a>
                </li> -->


                <li class="treeview" id="treeview-configuracion"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Configuración</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" id="tab-empresa" href="empresa.php"><i class="app-menu__icon fa fa-circle-o"></i><span class="app-menu__label">Empresa</span></a></li>
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
                "pagosrecibidos",
                "notacredito",
                "guiaremision",
                "cotizacion",

                "comprobantes",
                "creditofactura",
                "debitofactura",
                "consultaindividual",
                "consultaglobal",

                "clientes",
                "proveedores",

                "productos",
                "inventario",
                "kardexproducto",
                "ajustes",

                "registrarproducto",
                "actualizarproducto",

                "reporte",
                "empresa"
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
                if (id == "tab-ventas" || id == "tab-pagosrecibidos" || id == "tab-notacredito" || id == "tab-guiaremision" || id == "tab-cotizacion") {
                        document.getElementById("treeview-ingresos").setAttribute("class", "treeview is-expanded");
                        if (id == "tab-ventas") {
                                document.getElementById("tab-ventas").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-pagosrecibidos") {
                                document.getElementById("tab-pagosrecibidos").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-notacredito") {
                                document.getElementById("tab-notacredito").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-guiaremision") {
                                document.getElementById("tab-guiaremision").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-cotizacion") {
                                document.getElementById("tab-cotizacion").setAttribute("class", "app-menu__item active");
                        }
                } else if (id == "tab-comprobantes" || id == "tab-creditofactura" || id == "tab-debitofactura" || id == "tab-consultaindividual" || id == "tab-consultaglobal") {
                        document.getElementById("treeview-facturacion").setAttribute("class", "treeview is-expanded");
                        if (id == "tab-comprobantes") {
                                document.getElementById("tab-comprobantes").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-creditofactura") {
                                document.getElementById("tab-creditofactura").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-debitofactura") {
                                document.getElementById("tab-debitofactura").setAttribute("class", "app-menu__item active");
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
                } else if (id == "tab-productos" || id == "tab-inventario" || id == "tab-kardexproducto" || id == "tab-ajustes" || id == "tab-registrarproducto" || id == "tab-actualizarproducto") {
                        document.getElementById("treeview-inventario").setAttribute("class", "treeview is-expanded");
                        if (id == "tab-productos") {
                                document.getElementById("tab-productos").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-inventario") {
                                document.getElementById("tab-inventario").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-kardexproducto") {
                                document.getElementById("tab-kardexproducto").setAttribute("class", "app-menu__item active");
                        } else if (id == "tab-ajustes") {
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
                } else if (id == "tab-empresa") {
                        document.getElementById("treeview-configuracion").setAttribute("class", "treeview is-expanded");
                        if (id == "tab-empresa") {
                                document.getElementById("tab-empresa").setAttribute("class", "app-menu__item active");
                        }
                } else {
                        document.getElementById(id).setAttribute("class", "app-menu__item active");
                }
        }
</script>