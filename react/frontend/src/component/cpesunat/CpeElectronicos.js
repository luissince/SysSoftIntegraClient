import React, {} from 'react';
import {images} from '../../constants';

function CpeElectronicos() {
    return (
        <>
            <div className="app-title">
                <h1><i className="fa fa-folder"></i> Comprobante de Pago Electrónico <small>Lista</small></h1>
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
                            <h4> Resumen de Boletas/Facturas/Nota Crédito/Nota Débito</h4>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div className="form-group">
                            <img src={images.sunat_logo} width="28" height="28" />
                            <span className="small"> Estados SUNAT:</span>
                        </div>
                    </div>
                    <div className="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div className="form-group">
                            <img src={images.accept} width="28" height="28" />
                            <span className="small"> Aceptado</span>
                        </div>
                    </div>
                    <div className="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div className="form-group">
                            <img src={images.unable} width="28" height="28" />
                            <span className="small"> Rechazado</span>
                        </div>
                    </div>
                    <div className="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div className="form-group">
                            <img src={images.reuse} width="28" height="28" />
                            <span className="small"> Pendiente de Envío</span>
                        </div>
                    </div>
                    <div className="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div className="form-group">
                            <img src={images.error} width="28" height="28" />
                            <span className="small"> Comunicación de Baja (Anulado)</span>
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
                                <option value="1">DECLARAR</option>
                                <option value="3">ANULAR</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-xl-6 col-lg-8 col-md-12 col-sm-12 col-12">
                        <label>Buscar:</label>
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
                        <label>Opción:</label>
                        <div className="form-group">
                            <button className="btn btn-secondary" id="btnReload">
                                <i className="fa fa-refresh"></i> Recargar
                            </button>
                        </div>
                    </div>

                    <div className="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Procesar:</label>
                        <div className="form-group">
                            <button className="btn btn-primary" id="btnEnvioMasivo">
                                <i className="fa fa-arrow-circle-up"></i> Envío masivo
                            </button>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div className="table-responsive">
                            <table className="table table-hover table-striped">
                                <thead className="table-header-background">
                                    <tr>
                                        <th >#</th>
                                        <th >Anular</th>
                                        <th >PDF</th>
                                        <th >Detalle</th>
                                        <th>Fecha</th>
                                        <th>Comprobante</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                        <th>Total</th>
                                        <th>Estado <br />SUNAT</th>
                                        <th>Observación <br /> SUNAT</th>
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


export default CpeElectronicos;