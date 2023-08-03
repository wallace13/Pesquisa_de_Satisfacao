import GraficoColuna from "./graficoColuna";
import GraficoPizza from "./graficoPizza";
import GraficoComparativo from "./graficoComparativo";

document.addEventListener('DOMContentLoaded', function () {

    const grafico = document.getElementById(tipoGrafico.tipo).getContext('2d');

    if(tipoGrafico.tipo == 'piechart'){
        GraficoPizza(grafico, satisfactionData);
    }
    if(tipoGrafico.tipo == 'coluna'){
        GraficoColuna(grafico, satisfactionData);
    }

    if(tipoGrafico.tipo == 'chart_div'){
        GraficoComparativo(grafico, satisfactionData,satisfactionData2,tipoGrafico);
    }

});