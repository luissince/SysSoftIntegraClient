import React, { useEffect, useRef, useState } from "react";
import Chart from '../../../assets/js/chart';
import { formatMoney, monthName, porcent } from "../../../constants/tools";

function Doughnut({ data, isSuccess }) {

    const refChart = useRef(null);
    const [efectivo, setEfectivo] = useState(0);
    const [credito, setCredito] = useState(0);
    const [tarjeta, setTarjeta] = useState(0);
    const [deposito, setDeposito] = useState(0);
    const [total, setTotal] = useState(0);

    useEffect(() => {

        let currentData = [0, 0, 0, 0];

        if (isSuccess) {
            for (let value of data.tipoventa) {
                if (value.IdNotaCredito == 0 && value.Estado != 3) {
                    if (value.Estado == 2 || value.Tipo == 2 && value.Estado == 1) {
                        currentData[1] += parseFloat(value.Total);
                    } else if (value.Estado == 1 || value.Estado == 4) {
                        if (value.FormaName == "EFECTIVO") {
                            currentData[0] += parseFloat(value.Total);
                        } else if (value.FormaName == "TARJETA") {
                            currentData[2] += parseFloat(value.Total);
                        } else if (value.FormaName == "MIXTO") {
                            currentData[0] += parseFloat(value.Efectivo);
                            currentData[2] += parseFloat(value.Tarjeta);
                        } else {
                            currentData[3] += parseFloat(value.Total);
                        }
                    }
                }
            }

            setEfectivo(currentData[0]);
            setCredito(currentData[1]);
            setTarjeta(currentData[2]);
            setDeposito(currentData[3]);
            setTotal(currentData[0] + currentData[1] + currentData[2] + currentData[3]);
        }
        const doughnut = new Chart(refChart.current, {
            type: 'doughnut',
            data: {
                labels: ['Efectivo', 'Crédito', 'Tarjeta', 'Deposito',],
                datasets: [{
                    label: 'TIPO DE VENTA',
                    data: currentData,
                    backgroundColor: [
                        '#1a9e65',
                        '#ea920d',
                        'rgb(182,162,222)',
                        'rgb(46, 199, 201)',
                    ],
                    borderColor: [
                        '#1a9e65',
                        '#ea920d',
                        'rgb(182,162,222)',
                        'rgb(46, 199, 201)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: "#020203"
                        }
                    },
                    title: {
                        display: true,
                        text: 'TIPO DE VENTAS',
                        color: "#020203"
                    }
                }
            },
        });

        return () => {
            doughnut.destroy();
        };
    }, [isSuccess]);

    const style = {
        minHeight: '300px',
        height: '300px',
        maxHeight: '300px',
        maxWidth: '100%'
    };


    return (
        <div className="card">
            <div className="card-body">
                <canvas ref={refChart} style={style}></canvas>
                <div className="d-flex flex-row justify-content-end">
                    <span className="mr-2">
                        <i className="fa fa-stop text-primary"></i> {isSuccess ? `${monthName(new Date().getMonth() + 1)} ${new Date().getFullYear()}` : "MES - 0"}
                    </span>
                </div>
            </div>
            <div className="card-footer">
                <div className="row">
                    <div className="col-md-3 col-sm-6  col-12">
                        <div className="description-block border-right text-center">
                            <span className="description-percentage text-success"><i className="fa fa-caret-up"></i> {Math.round(porcent(total, efectivo))}%</span>
                            <h5 className="description-header" >S/ {formatMoney(efectivo)}</h5>
                            <p className="description-text">TOTAL EFECTIVO</p>
                        </div>
                    </div>

                    <div className="col-md-3 col-sm-6  col-12">
                        <div className="description-block border-right text-center">
                            <span className="description-percentage text-warning"><i className="fa fa-caret-left"></i> {Math.round(porcent(total, credito))}%</span>
                            <h5 className="description-header">S/ {formatMoney(credito)}</h5>
                            <p className="description-text">TOTAL CRÉDITO</p>
                        </div>
                    </div>

                    <div className="col-md-3 col-sm-6  col-12">
                        <div className="description-block border-right text-center">
                            <span className="description-percentage text-success"><i className="fa fa-caret-up"></i> {Math.round(porcent(total, tarjeta))}%</span>
                            <h5 className="description-header">S/ {formatMoney(tarjeta)}</h5>
                            <p className="description-text">TOTAL TARJETA</p>
                        </div>
                    </div>

                    <div className="col-md-3 col-sm-6 col-12">
                        <div className="description-block text-center">
                            <span className="description-percentage text-success"><i className="fa fa-caret-up"></i> {Math.round(porcent(total, deposito))}%</span>
                            <h5 className="description-header">S/ {formatMoney(deposito)}</h5>
                            <p className="description-text">TOTAL DEPOSITO</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    )

}

export default Doughnut;