import React, { useEffect, useRef } from "react";
import Chart from '../../../assets/js/chart';
import { formatMoney } from '../../../constants/tools';

function Bar({ data, isSuccess }) {

    const refChart = useRef(null);

    useEffect(() => {

        let currentData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        if (isSuccess) {
            for (let i = 0; i < currentData.length; i++) {
                for (let value of data.hventas) {
                    if (value.Mes == (i + 1)) {
                        currentData[i] = formatMoney(parseFloat(value.Monto));
                    }
                }
            }
        }

        const bar = new Chart(refChart.current, {
            type: 'bar',
            data: {
                labels: ["ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SET", "OCT", "NOV", "DIC"],
                datasets: [{
                    label: new Date().getFullYear(),
                    data: currentData,
                    backgroundColor: [
                        'rgb(40, 167, 69)',
                    ],
                    borderColor: [
                        'rgb(40, 167, 69)',
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
                        text: 'VENTAS POR AÑO',
                        color: "#020203"
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        return () => {
            bar.destroy();
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

export default Bar;