import React from 'react';
import { formatMoney } from '../../../constants/tools';

const Ventas = ({ data, isSuccess }) => {

    const ventas = [{
        id: 0,
        mes: "Enero",
        sunat: 0,
        libre: 0
    }, {
        id: 1,
        mes: "Febrero",
        sunat: 0,
        libre: 0
    }, {
        id: 2,
        mes: "Marzo",
        sunat: 0,
        libre: 0
    }, {
        id: 3,
        mes: "Abril",
        sunat: 0,
        libre: 0
    }, {
        id: 4,
        mes: "Mayo",
        sunat: 0,
        libre: 0
    }, {
        id: 5,
        mes: "Junio",
        sunat: 0,
        libre: 0
    }, {
        id: 6,
        mes: "Julio",
        sunat: 0,
        libre: 0
    }, {
        id: 7,
        mes: "Agosto",
        sunat: 0,
        libre: 0
    }, {
        id: 8,
        mes: "Setiembre",
        sunat: 0,
        libre: 0
    }, {
        id: 9,
        mes: "Octubre",
        sunat: 0,
        libre: 0
    }, {
        id: 10,
        mes: "Noviembre",
        sunat: 0,
        libre: 0
    }, {
        id: 11,
        mes: "Diciembre",
        sunat: 0,
        libre: 0
    }];

    if (isSuccess) {
        for (let i = 0; i < ventas.length; i++) {
            for (let value of data.historialventastipos) {
                if (value.Mes == (i + 1)) {
                    ventas[i].sunat += parseFloat(value.Sunat);
                    ventas[i].libre += parseFloat(value.Libre);
                }
            }
        }
    }

    return (
        <div className="card">
            <div className="card-body p-0">
                <div className="table-responsive">

                    <table className="table table-striped border-0">
                        <thead className="bg-white">
                            <tr>
                                <th scope="col" width="5%">Mes</th>
                                <th scope="col" width="5%">Venta Sunat</th>
                                <th scope="col" width="5%">Venta Libre</th>
                                <th scope="col" width="5%">Venta Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {
                                isSuccess ?
                                    <>
                                        {
                                            ventas.map((value, index) => (
                                                <tr key={index}>
                                                    <td className="text-center text-secondary">{value.mes}</td>
                                                    <td className="text-right text-secondary">S/ {formatMoney(value.sunat)}</td>
                                                    <td className="text-right text-secondary">S/ {formatMoney(value.libre)}</td>
                                                    <td className="text-right text-secondary">S/ {formatMoney(value.sunat + value.libre)}</td>
                                                </tr>
                                            ))
                                        }
                                    </>
                                    :
                                    <>
                                        <tr>
                                            <td className="text-center text-secondary">Enero</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Febrero</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Marzo</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Abril</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Mayo</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Junio</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Julio</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Agosto</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Setiembre</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Octubre</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Noviembre</td>
                                        </tr>
                                        <tr>
                                            <td className="text-center text-secondary">Diciembre</td>
                                        </tr>
                                    </>
                            }
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
}

export default Ventas;