import GraficoColuna from "./graficoColuna";
import GraficoPizza from "./graficoPizza";

let dadosGraficoAlmoco = { data: [] };
let dadosGraficoCafe = { data: [] }; 

let graficoColunaAlmoco = null;
let graficoColunaCafe = null;
let graficoPizzzaAlmoco  = null;
let graficoPizzzaCafe = null;
// Variável de controle para verificar se os gráficos já foram criados
let graficosCriados = false;

const eventSource = new EventSource(window.atualizarVotosUrl);
eventSource.onmessage = function (event) {
    const data = JSON.parse(event.data);
    function formatarData(dataString) {
        if (dataString == null) return '00/00/0000';
        const [ano, mes, dia] = dataString.data.split('-');
        return `${dia}/${mes}/${ano}`;
    }
    function formatarPorcentagem(valor, total) {
        if (total === 0) return '0%';
        return (valor > 0 ? ((valor / total) * 100).toFixed(0) : valor) + '%';
    }

    document.getElementById('dataCafe').innerText = formatarData(data.cafe);
    document.getElementById('dataAlmoco').innerText = formatarData(data.almoco);

    document.getElementById('principal').innerText = (data.cafe != null ? data.cafe.principal : "Principal");
    document.getElementById('opcao').innerText = (data.cafe != null ? data.cafe.opcao : "Opção");

    const co = document.getElementById('co').innerText = data.votoB !== null ? data.votoB.otimo : 0;
    const cb = document.getElementById('cb').innerText = data.votoB !== null ? data.votoB.bom: 0;
    const cre = document.getElementById('cre').innerText = data.votoB !== null ? data.votoB.regular: 0;
    const cru = document.getElementById('cru').innerText = data.votoB !== null ? data.votoB.ruim: 0;

    const ctotal = document.getElementById('ctotal').innerText = co+cb+cre+cru;
    const tco = document.getElementById('tco').innerText = formatarPorcentagem(co, ctotal);
    const tcb = document.getElementById('tcb').innerText = formatarPorcentagem(cb, ctotal);
    const tcre = document.getElementById('tcre').innerText = formatarPorcentagem(cre, ctotal);
    const tcru = document.getElementById('tcru').innerText = formatarPorcentagem(cru, ctotal);

    document.getElementById('salada').innerText = (data.almoco != null ? data.almoco.salada : "Salada");
    document.getElementById('complemento').innerText = (data.almoco != null ? data.almoco.complemento : "Complemento");
    document.getElementById('principalAlmoco').innerText = (data.almoco != null ? data.almoco.principal : "Principal");
    document.getElementById('sobremesa').innerText = (data.almoco != null ? data.almoco.sobremesa : "Sobremesa");
    document.getElementById('suco').innerText = (data.almoco != null ? data.almoco.suco: "Suco");

    const ao = document.getElementById('ao').innerText =  data.votoA !== null ? data.votoA.otimo : 0;
    const ab = document.getElementById('ab').innerText = data.votoA !== null ? data.votoA.bom : 0;
    const are = document.getElementById('are').innerText = data.votoA !== null ? data.votoA.regular : 0;
    const aru = document.getElementById('aru').innerText = data.votoA !== null ? data.votoA.ruim : 0;

    const atotal = document.getElementById('atotal').innerText = ao+ab+are+aru;
    const tao = document.getElementById('tao').innerText = formatarPorcentagem(ao, atotal);
    const tab = document.getElementById('tab').innerText = formatarPorcentagem(ab, atotal);
    const tare = document.getElementById('tare').innerText = formatarPorcentagem(are, atotal);
    const taru = document.getElementById('taru').innerText = formatarPorcentagem(aru, atotal);

    dadosGraficoAlmoco.data = [ao, ab, are, aru];
    dadosGraficoCafe.data = [co, cb, cre, cru];

    if (!graficosCriados) {
        // Gráfico de coluna - Almoço
        const almocoColuna = document.getElementById('colunaAlmoco').getContext('2d');
        graficoColunaAlmoco = GraficoColuna(almocoColuna, dadosGraficoAlmoco.data);

        // Gráfico de coluna - Cafe
        const cafeColuna = document.getElementById('colunaCafe').getContext('2d');
        graficoColunaCafe = GraficoColuna(cafeColuna, dadosGraficoCafe.data);

        // Criação do gráfico de pizza do Almoço
        const pizzaAlmoco = document.getElementById('pizzaAlmoco').getContext('2d');
        graficoPizzzaAlmoco = GraficoPizza(pizzaAlmoco, dadosGraficoAlmoco.data);

        // Criação do gráfico de pizza do Café
        const pizzaCafe = document.getElementById('pizzaCafe').getContext('2d');
        graficoPizzzaCafe = GraficoPizza(pizzaCafe, dadosGraficoCafe.data);

        // Definir a variável de controle como true para evitar a criação adicional
        graficosCriados = true;
    }
    if(graficosCriados){
        graficoColunaAlmoco.data.datasets[0].data = dadosGraficoAlmoco.data;
        graficoColunaCafe.data.datasets[0].data = dadosGraficoCafe.data;

        let dadosGraficoAlmocoPer = [tao, tab, tare, taru];
        let dadosGraficoCafePer = [tco, tcb, tcre, tcru];

        graficoPizzzaAlmoco.data.datasets[0].data = dadosGraficoAlmocoPer.map(porcentagemTexto => parseFloat(porcentagemTexto.replace("%", "")));
        graficoPizzzaCafe.data.datasets[0].data = dadosGraficoCafePer.map(porcentagemTexto => parseFloat(porcentagemTexto.replace("%", "")));

        graficoColunaAlmoco.update();
        graficoColunaCafe.update();
        graficoPizzzaAlmoco.update();
        graficoPizzzaCafe.update();
    }

};
