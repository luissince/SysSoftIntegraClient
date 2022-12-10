import React from 'react';
import Bar from './chart/Bar';
import Pie from './chart/Pie';
import Doughnut from './chart/Doughnut';
import Ventas from './table/Ventas';
import Productos from './table/Productos';
import Cantidades from './table/Cantidades';
import { formatMoney } from '../../constants/tools';
import { useGetDashboardQuery } from '../../api/dashboardApi';
import { images } from '../../constants';

const Dashboard = () => {

    const { data, isLoading, isFetching, isSuccess } = useGetDashboardQuery(undefined, {
        refetchOnMountOrArgChange: false,
        refetchOnFocus: false,
        refetchOnReconnect: true,
        // pollingInterval: 3000
    });

    return (
        <>
            <div className="app-title">
                <h1><i className="fa fa fa-dashboard"></i> Dashboard <small>{isFetching && <span className="spinner-border spinner-border-sm"></span>} </small></h1>
            </div>

            <div className="tile mb-4">

                {
                    isLoading ?
                        <div className="overlay">
                            <div className="m-loader mr-4">
                                <svg className="m-circular" viewBox="25 25 50 50">
                                    <circle className="path" cx="50" cy="50" r="20" fill="none" strokeWidth="4" strokeMiterlimit="10">
                                    </circle>
                                </svg>
                            </div>
                            <h4 className="l-text text-white">Cargando información...</h4>
                        </div>
                        :
                        null
                }

                <div className="tile-body">
                    {/*  */}
                    <div className="row">
                        <div className="col-lg-3 col-md-6 col-12">
                            <div className="card mb-3 text-white bg-primary">
                                <div className="card-body">
                                    <h3 className="text-white">{isSuccess ? "S/ " + formatMoney(data.ventas) : "S/ 0.00"}</h3>
                                    <p className="m-0">VENTAS DEL DÍA</p>
                                </div>
                            </div>
                        </div>

                        <div className="col-lg-3 col-md-6 col-12">
                            <div className="card mb-3 text-white bg-danger">
                                <div className="card-body">
                                    <h3 className="text-white">{isSuccess ? "S/ " + formatMoney(data.compras) : "S/ 0.00"}</h3>
                                    <p className="m-0">COMPRAS DEL DÍA</p>
                                </div>
                            </div>
                        </div>

                        <div className="col-lg-3 col-md-6 col-12">
                            <div className="card mb-3 text-white bg-warning">
                                <div className="card-body">
                                    <h3 className="text-white">{isSuccess ? data.ccobrar : "0"}</h3>
                                    <p className="m-0">CUENTAS POR COBRAR</p>
                                </div>
                            </div>
                        </div>

                        <div className="col-lg-3 col-md-6 col-12">
                            <div className="card mb-3 text-white bg-success">
                                <div className="card-body">
                                    <h3 className="text-white">{isSuccess ? data.ccpagar : "0"}</h3>
                                    <p className="m-0">CUENTAS POR PAGAR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {/*  */}

                    {/*  */}
                    <div className="row">
                        <div className="col-lg-3 col-md-6 col-12">
                            <div className="card mb-3 text-white bg-secondary">
                                <div className="card-body">
                                    <div className="d-flex">
                                        <div className="">
                                            <img src={images.producto} width="32" />
                                        </div>
                                        <div className="ml-2">
                                            <p className="m-0"> Productos</p>
                                            <h3 className="text-white"> {isSuccess ? data.productos : "0"}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="col-lg-3 col-md-6 col-12">
                            <div className="card mb-3 text-white bg-secondary">
                                <div className="card-body">
                                    <div className="d-flex">
                                        <div className="">
                                            <img src={images.clients} width="32" />
                                        </div>
                                        <div className="ml-2">
                                            <p className="m-0"> Clientes</p>
                                            <h3 className="text-white"> {isSuccess ? data.clientes : "0"}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="col-lg-3 col-md-6 col-12">
                            <div className="card mb-3 text-white bg-secondary">
                                <div className="card-body">
                                    <div className="d-flex">
                                        <div className="">
                                            <img src={images.providers} width=" 32" />
                                        </div>
                                        <div className="ml-2">
                                            <p className="m-0"> Proveedores</p>
                                            <h3 className="text-white"> {isSuccess ? data.proveedores : "0"}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="col-lg-3 col-md-6 col-12">
                            <div className="card mb-3 text-white bg-secondary">
                                <div className="card-body">
                                    <div className="d-flex">
                                        <div className="">
                                            <img src={images.employees} width=" 32" />
                                        </div>
                                        <div className="ml-2">
                                            <p className="m-0"> Trabajadores</p>
                                            <h3 className="text-white"> {isSuccess ? data.empleados : "0"}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {/*  */}

                    {/*  */}
                    <div className="row">
                        <div className="col-lg-6 col-md-12 col-12">
                            <div className=" form-group">
                                <Bar data={data} isSuccess={isSuccess} />
                            </div>
                        </div>

                        <div className="col-lg-6 col-md-12 col-12">
                            <div className=" form-group">
                                <Pie data={data} isSuccess={isSuccess} />
                            </div>
                        </div>
                    </div>
                    {/*  */}

                    {/*  */}
                    <div className="row">
                        <div className="col-lg-6 col-md-12 col-sm-12">
                            <div className="form-group">
                                <Ventas data={data} isSuccess={isSuccess} />
                            </div>
                        </div>

                        <div className="col-lg-6 col-md-12 col-sm-12">
                            <div className="form-group">
                                <Doughnut data={data} isSuccess={isSuccess} />
                            </div>
                        </div>
                    </div>
                    {/*  */}

                    {/*  */}
                    <div className="row">
                        <div className="col-lg-6 col-md-12 col-sm-12">
                            <div className="form-group">
                                <Productos data={data} isSuccess={isSuccess} />
                            </div>
                        </div>

                        <div className="col-lg-6 col-md-12 col-sm-12">
                            <div className="form-group">
                                <Cantidades data={data} isSuccess={isSuccess} />
                            </div>
                        </div>
                    </div>
                    {/*  */}
                </div>
            </div>

        </>
    );
}

export default Dashboard;
