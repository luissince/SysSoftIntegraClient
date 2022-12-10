
import { images } from "../../constants";

const Sales = () => {

    return (
        <>
            <div className="app-title">
                <h1><i className="fa fa-folder"></i> Ventas <small>Lista</small></h1>
            </div>

            <div className="tile mb-4">

                {/* <div className="overlay p-5">
                    <div className="m-loader mr-4">
                        <svg className="m-circular" viewBox="25 25 50 50">
                            <circle className="path" cx="50" cy="50" r="20" fill="none" strokeWidth="4" strokeMiterlimit="10"></circle>
                        </svg>
                    </div>
                    <h4 className="l-text text-center text-white p-10">Cargando información...</h4>
                </div> */}

                <div className="row">
                    <div className="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div className="form-group">
                            <a href="puntoventa.php" className=" btn btn-primary">
                                <i className="fa fa-plus"></i> Nueva venta
                            </a>

                            <button className="btn btn-secondary" id="btnReload">
                                <i className="fa fa-refresh"></i> Recargar
                            </button>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label><img src={images.calendar} width="22" height="22" /> Fecha de Inicio:</label>
                        <div className="form-group">
                            <input className="form-control" type="date" id="txtFechaInicial" />
                        </div>
                    </div>
                    <div className="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label><img src={images.calendar} width="22" height="22" /> Fecha de Fin:</label>
                        <div className="form-group">
                            <input className="form-control" type="date" id="txtFechaFinal" />
                        </div>
                    </div>
                    <div className="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label><img src={images.igual} width="22" height="22" /> Comprobantes:</label>
                        <div className="form-group">
                            <select id="cbComprobante" className="form-control">
                                <option value="0">TODOS</option>
                            </select>
                        </div>
                    </div>
                    <div className="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                        <label><img src={images.information} width="22" height="22" /> Estado:</label>
                        <div className="form-group">
                            <select id="cbEstado" className="form-control">
                                <option value="0">TODOS</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-xl-6 col-lg-8 col-md-12 col-sm-12 col-12">
                        <label><img src={images.search} width="22" height="22" /> Buscar:</label>
                        <div className="form-group d-flex">
                            <div className="input-group">
                                <input type="text" className="form-control" placeholder="Escribir para filtrar" id="txtSearch" />
                                <div className="input-group-append">
                                    <button className="btn btn-success" type="button" id="btnBuscar">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label><img src={images.cantidad} width="22" height="22" /> Total de Ventas:</label>
                        <div className="form-group">
                            <div className="input-group">
                                <div className="input-group-prepend"><span className="input-group-text">S/</span></div>
                                <div className="input-group-append"><span className="input-group-text" id="lblTotalVenta">0.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div className="table-responsive">
                            <table className="table table-hover table-striped">
                                <thead className="table-header-background">
                                    <tr>
                                        <th width="5%" >#</th>
                                        <th width="5%" >Anular</th>
                                        <th width="5%" >PDF</th>
                                        <th width="5%" >Detalle</th>
                                        <th width="10%" >Fecha</th>
                                        <th width="15%" >Comprobante</th>
                                        <th width="15%" >Cliente</th>
                                        <th width="10%" >Tipo</th>
                                        <th width="10%" >Metodo</th>
                                        <th width="10%" >Estado</th>
                                        <th width="10%" >Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-md-12 col-sm-12 col-12 text-center">
                        <label>Paginación</label>
                        <div className="form-group" id="ulPagination">
                            <button className="btn btn-outline-secondary">
                                <i className="fa fa-angle-double-left"></i>
                            </button>
                            <button className="btn btn-outline-secondary">
                                <i className="fa fa-angle-left"></i>
                            </button>
                            <span className="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button className="btn btn-outline-secondary">
                                <i className="fa fa-angle-right"></i>
                            </button>
                            <button className="btn btn-outline-secondary">
                                <i className="fa fa-angle-double-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </>
    );
}

export default Sales;