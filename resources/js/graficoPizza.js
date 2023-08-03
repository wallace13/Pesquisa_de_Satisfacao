import { Chart } from "chart.js/auto";

function calcularPorcentagens(data) {
    const total = data.reduce((acc, value) => acc + value, 0);
    return data.map(value => ((value / total) * 100).toFixed(0));  
}

function GraficoPizza(ctx, data) {
    const porcentagens = calcularPorcentagens(data);
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Ótimo', 'Bom', 'Regular', 'Ruim'],
            datasets: [{
                data: porcentagens,
                backgroundColor: [
                    'rgba(163, 207, 187, 1)', //Verde
                    'rgba(158, 197, 254, 1)',//Azul
                    'rgba(255, 230, 156, 1)', //Amarelo
                    'rgba(241, 174, 181, 1)', //Vermelho
                ],
                borderColor: 'white',
                borderWidth: 2
            }]
        },
        options: {
            plugins: { // Adicione esta seção para exibir o símbolo de porcentagem nos rótulos
                tooltip: {
                    callbacks: {
                        label: (context) => {
                            const value = context.raw;
                            const label = context.label || '';
                            return label + ': ' + value + '%';
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'right',
                },
            },
            maintainAspectRatio: false,
            responsive: true,
            aspectRatio: 1.5,
        },
    });
    return myChart;
}
    
export default GraficoPizza;
