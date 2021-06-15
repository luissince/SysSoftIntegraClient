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
                        <a class="app-menu__item" href="index.php">
                                <i class="app-menu__icon fa fa-dashboard"></i>
                                <span class="app-menu__label">Dashboard</span>
                        </a>
                </li>

                <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-external-link-square" style="transform: rotate(180deg) translateX(12px);"></i><span class="app-menu__label">Ingresos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" href="ventas.php"><i class="app-menu__icon fa fa-minus"></i><span class="app-menu__label">Ventas</span></a></li>
                                <li><a class="app-menu__item" href="notacredito.php"><i class="app-menu__icon fa fa-minus"></i><span class="app-menu__label">Nota de Crédito</span></a></li>
                        </ul>
                </li>

                <li class="treeview">
                        <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-external-link-square"></i>
                                <span class="app-menu__label">Gastos</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                        </a>
                </li>

                <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Contactos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-minus"></i><span class="app-menu__label">Clientes</span></a></li>
                        </ul>
                </li>

                <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cubes"></i><span class="app-menu__label">Inventario</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" href="productos.php"><i class="app-menu__icon fa fa-minus"></i><span class="app-menu__label">Productos</span></a></li>
                                <li><a class="app-menu__item" href="inventario.php"><i class="app-menu__icon fa fa-minus"></i><span class="app-menu__label">Inventario</span></a></li>
                                <li><a class="app-menu__item" href="kardexproducto.php"><i class="app-menu__icon fa fa-minus"></i><span class="app-menu__label">Kardex</span></a></li>
                                <li><a class="app-menu__item" href="ajustes.php"><i class="app-menu__icon fa fa-minus"></i><span class="app-menu__label">Ajuste de Inventario</span></a></li>
                        </ul>
                </li>


                <li>
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
                </li>

                <li>
                        <a class="app-menu__item" href="#">
                                <i class="app-menu__icon fa fa-book"></i>
                                <span class="app-menu__label">Reportes</span>
                        </a>
                </li>

                <li>
                        <a class="app-menu__item" href="#">
                                <i class="app-menu__icon fa fa-bar-chart"></i>
                                <span class="app-menu__label">Gráficos</span>
                        </a>
                </li>

                <li>
                        <a class="app-menu__item" href="#">
                                <i class="app-menu__icon fa fa-laptop"></i>
                                <span class="app-menu__label">Tienda en Línea</span>
                        </a>
                </li>


                <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Configuración</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="app-menu__item" href="empresa.php"><i class="app-menu__icon fa fa-minus"></i><span class="app-menu__label">Empresa</span></a></li>
                        </ul>
                </li>

        </ul>
</aside>