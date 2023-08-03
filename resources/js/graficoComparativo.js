import { Chart } from "chart.js/auto";

function GraficoComparativo(ctx, dataA, dataB, tipo) {
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Ótimo', 'Bom', 'Regular', 'Ruim'],
            datasets: [
                {
                    label: tipo.mes,
                    data: dataA,
                    backgroundColor: 'rgba(163, 207, 187, 1)', // Verde
                    borderColor: 'rgba(163, 207, 187, 1)', // Verde
                    borderWidth: 1
                },
                {
                    label: tipo.mes2,
                    data: dataB,
                    backgroundColor: 'rgba(158, 197, 254, 1)', // Azul
                    borderColor: 'rgba(158, 197, 254, 1)', // Azul
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true, // Agora exibe a legenda para identificar as séries
                }
            },
            maintainAspectRatio: false,
            responsive: true,
            aspectRatio: 1.5,
        }
    });
}

export default GraficoComparativo;
