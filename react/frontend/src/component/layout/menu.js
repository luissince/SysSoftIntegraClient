import React from "react";
import { Link  } from 'react-router-dom';
import {images } from '../../constants';

const Menu = () => {

    const treeViewMenu = (event) => {
        event.preventDefault();

        const value = document.querySelectorAll('.app-menu li .app-menu__item[data-bs-toggle="treeview"]');

        value.forEach(rmElement => {
            if (!event.currentTarget.parentNode.classList.contains("is-expanded")) {
                rmElement.parentNode.classList.remove("is-expanded");
            }
        });

        event.currentTarget.parentNode.classList.toggle("is-expanded")
    }

    return <>
        <div className="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
        <aside className="app-sidebar">
            <div className="app-sidebar__user">
                <div className="m-2">
                    <img className="img-fluid" src={images.logo} alt="User Image" />
                </div>

                <div className="m-1">
                    <p className="app-sidebar__user-name">TIENDA FRANCIA</p>
                </div>
            </div>
            <ul className="app-menu">

                <li>
                    <Link className="app-menu__item" id="tab-index" to={"dashboard"}>
                        <i className="app-menu__icon fa fa-dashboard"></i>
                        <span className="app-menu__label">Dashboard</span>
                    </Link>
                </li>

                <li className="treeview" id="treeview-ingresos">
                    <a
                        className="app-menu__item"
                        href="#"
                        data-bs-toggle="treeview"
                        aria-expanded="false"
                        role="button"
                        onClick={(event) => treeViewMenu(event)}>
                        <i className="app-menu__icon fa fa-external-link-square" style={{ transform: 'rotate(180deg) translateX(12px)' }}></i>
                        <span className="app-menu__label">Ingresos</span>
                        <i className="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul className="treeview-menu">
                        <li><Link className="app-menu__item" id="tab-ventas" to={"sales"}><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Ventas</span></Link></li>
                        <li><a className="app-menu__item" id="tab-pago" href="pago.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Pagos recibidos</span></a></li>
                        <li><a className="app-menu__item" id="tab-notacredito" href="notacredito.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Nota de crédito</span></a></li>
                        <li><a className="app-menu__item" id="tab-guiaremision" href="#"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Guía remisión</span></a></li>
                        <li><a className="app-menu__item" id="tab-cotizacion" href="cotizacion.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Cotización</span></a></li>
                    </ul>
                </li>

                <li className="treeview" id="treeview-egresos">
                    <a
                        className="app-menu__item"
                        href="#"
                        data-bs-toggle="treeview"
                        aria-expanded="false"
                        role="button"
                        onClick={(event) => treeViewMenu(event)}>
                        <i className="app-menu__icon fa fa-external-link-square"></i>
                        <span className="app-menu__label">Gastos</span>
                        <i className="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul className="treeview-menu">
                        <li><a className="app-menu__item" id="tab-compras" href="compras.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Compras</span></a></li>
                        <li><a className="app-menu__item" id="tab-cobro" href="cobro.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Pagos echos</span></a></li>
                        <li><a className="app-menu__item" id="tab-ordencompra" href="ordencompra.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Orden de compra</span></a></li>
                    </ul>
                </li>

                <li className="treeview" id="treeview-facturacion">
                    <a
                        className="app-menu__item"
                        href="#"
                        data-bs-toggle="treeview"
                        aria-expanded="false"
                        role="button"
                        onClick={(event) => treeViewMenu(event)}>
                        <i className="app-menu__icon fa fa-skyatlas" style={{ transform: 'rotate(180deg) translateX(12px)' }}></i>
                        <span className="app-menu__label">Facturación Electrónica</span>
                        <i className="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul className="treeview-menu">
                        <li><Link className="app-menu__item" id="tab-cpeelectronicos" to={"cpeelectronicos"}><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">CPE-Electrónicos</span></Link></li>
                        <li><a className="app-menu__item" id="tab-consultaindividual" href="consultaindividual.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Consultar Estado</span></a></li>
                        <li><a className="app-menu__item" id="tab-consultaglobal" href="consultaglobal.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Consulta Global</span></a></li>
                    </ul>
                </li>

                <li className="treeview" id="treeview-contactos">
                    <a
                        className="app-menu__item"
                        href="#"
                        data-bs-toggle="treeview"
                        role="button"
                        onClick={(event) => treeViewMenu(event)}>
                        <i className="app-menu__icon fa fa-users"></i>
                        <span className="app-menu__label">Contactos</span>
                        <i className="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul className="treeview-menu">
                        <li><a className="app-menu__item" id="tab-clientes" href="clientes.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Clientes</span></a></li>
                        <li><a className="app-menu__item" id="tab-proveedores" href="proveedores.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Proveedores</span></a></li>
                    </ul>
                </li>

                <li className="treeview" id="treeview-inventario">
                    <a
                        className="app-menu__item"
                        href="#"
                        data-bs-toggle="treeview"
                        role="button"
                        onClick={(event) => treeViewMenu(event)}>
                        <i className="app-menu__icon fa fa-cubes">
                        </i>
                        <span className="app-menu__label">Inventario</span>
                        <i className="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul className="treeview-menu">
                        <li><a className="app-menu__item" id="tab-productos" href="productos.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Productos</span></a></li>
                        <li><a className="app-menu__item" id="tab-kardexproducto" href="kardexproducto.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Kardex</span></a></li>
                        <li><a className="app-menu__item" id="tab-ajustes" href="ajustes.php"><i className="app-menu__icon fa fa-circle-o"></i><span className="app-menu__label">Ajustes</span></a></li>
                    </ul>
                </li>

                <li>
                    <Link className="app-menu__item" id="tab-reporte" to={"/report"}>
                        <i className="app-menu__icon fa fa-book"></i>
                        <span className="app-menu__label">Reportes</span>
                    </Link>
                </li>

                <li>
                    <a className="app-menu__item" id="tab-reporte" href="tiendavirtural.php">
                        <i className="app-menu__icon fa fa-desktop"></i>
                        <span className="app-menu__label">Tienda Virtual</span>
                    </a>
                </li>

                <li className="treeview" id="treeview-configuracion">
                    <a
                        className="app-menu__item"
                        href="#"
                        data-bs-toggle="treeview"
                        aria-expanded="false"
                        role="button"
                        onClick={(event) => treeViewMenu(event)}>
                        <i className="app-menu__icon fa fa-cog"></i>
                        <span className="app-menu__label">Configuración</span>
                        <i className="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul className="treeview-menu">
                        <li>
                            <a className="app-menu__item" id="tab-empresa" href="empresa.php">
                                <i className="app-menu__icon fa fa-circle-o"></i>
                                <span className="app-menu__label">Empresa</span>
                            </a>
                        </li>
                        <li>
                            <a className="app-menu__item" id="tab-mantenimiento" href="mantenimiento.php">
                                <i className="app-menu__icon fa fa-circle-o"></i>
                                <span className="app-menu__label">Tabla básica</span>
                            </a>
                        </li>
                        <li>
                            <a className="app-menu__item" id="tab-moneda" href="moneda.php">
                                <i className="app-menu__icon fa fa-circle-o"></i>
                                <span className="app-menu__label">Moneda</span>
                            </a>
                        </li>
                        <li>
                            <a className="app-menu__item" id="tab-comprobante" href="comprobante.php">
                                <i className="app-menu__icon fa fa-circle-o"></i>
                                <span className="app-menu__label">Comprobante</span>
                            </a>
                        </li>
                        <li>
                            <a className="app-menu__item" id="tab-impuesto" href="impuesto.php">
                                <i className="app-menu__icon fa fa-circle-o"></i>
                                <span className="app-menu__label">Impuesto</span>
                            </a>
                        </li>
                        <li>
                            <a className="app-menu__item" id="tab-usuario" href="usuario.php">
                                <i className="app-menu__icon fa fa-circle-o"></i>
                                <span className="app-menu__label">Usuario</span>
                            </a>
                        </li>
                        <li>
                            <a className="app-menu__item" id="tab-almacen" href="almacen.php">
                                <i className="app-menu__icon fa fa-circle-o"></i>
                                <span className="app-menu__label">Almacen</span>
                            </a>
                        </li>
                        <li>
                            <a className="app-menu__item" id="tab-bancos" href="bancos.php">
                                <i className="app-menu__icon fa fa-circle-o"></i>
                                <span className="app-menu__label">Bancos</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </aside>
    </>
}

export default Menu;