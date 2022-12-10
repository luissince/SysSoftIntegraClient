import React from 'react';
import { formatMoney } from '../../../constants/tools';

function Productos({ data, isSuccess }) {

    return (
        <div className="card">
            <div className="card-header">
                <p className="card-title text-center m-0">Productos más veces vendidos</p>
            </div>
            <div className="card-body p-0">
                <div className="table-responsive">
                    <table className="table table-striped border-0">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Producto</th>
                                <th>Categoría/Marca</th>
                                <th>Veces</th>
                            </tr>
                        </thead>
                        <tbody id="tbListMasVendidos">
                            {
                                isSuccess ?
                                    data.vecesVendidos.map((value, index) => (
                                        <tr key={index}>
                                            <td>{index + 1}</td>
                                            <td>{value.Clave} <br /> {value.NombreMarca}</td>
                                            <td>{value.Categoria} <br /> {value.Marca}</td>
                                            <td>{formatMoney(value.Cantidad)}</td>
                                        </tr>
                                    ))
                                    :
                                    <tr>
                                        <td colSpan="4" className="text-center">No hay datos para mostrar</td>
                                    </tr>
                            }
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
}

export default Productos;