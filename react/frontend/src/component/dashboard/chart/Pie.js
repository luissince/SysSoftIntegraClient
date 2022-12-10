import React, { useEffect, useRef } from "react";
import Chart from '../../../assets/js/chart';

function Pie({ data, isSuccess }) {

    const refChart = useRef(null);

    useEffect(() => {

        let currentData = [0, 0, 0, 0];

        if (isSuccess) {
            currentData[0] = data.innegativo;
            currentData[1] = data.inintermedio;
            currentData[2] = data.innecesario;
            currentData[3] = data.inexcecende;
        }

        const pie = new Chart(refChart.current, {
            type: 'pie',
            data: {
                labels: ['Negativos', 'Intermedios', 'Necesarios', 'Excedentes',],
                datasets: [{
                    label: 'Estado del Inventario',
                    data: currentData,
                    backgroundColor: [
                        'rgb(220, 53, 69)',
                        'rgb(255, 206, 86)',
                        'rgb(40, 167, 69)',
                        'rgb(4, 94, 191)',
                    ],
                    borderColor: [
                        'rgb(220, 53, 69)',
                        'rgb(255, 206, 86)',
                        'rgb(40, 167, 69)',
                        'rgb(4, 94, 191)',
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
                        text: 'INVENTARIO',
                        color: "#020203"
                    }
                }
            },
        });

        return () => {
            pie.destroy();
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
            </div>
        </div>
    );
}

export default Pie;