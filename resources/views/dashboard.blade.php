@extends('layouts.dashboard')

@section('content')
<div class="row mb-3 ml-2 mr-2">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                Andamento da Votação do Café - <span id="dataCafe"><spa>
            </div>
            <div class="card-body">
                    <div class="row">
                      <div class="col-5 h-600 p-3" style=" height: 180px; font-size: 12px;">
                        <p class="card-text text-center">
                            <span id="principal"></span><br>
                            <span id="opcao"></span>
                        </p>
                      </div>
                      <div class="col-7">
                        <div id="piechartCafe" style="width: 100%; height: 80%;"></div>
                      </div>
                    </div>
                <table class="table text-center" style="font-size: 14px; margin-bottom: 0;">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Votos</th>
                        <th scope="col"> % </th>
                        <th scope="col">Gráfico</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Ótimo</th>
                            <th scope="row" id='co'></th>
                            <th scope="row" id='tco'></th>
                            <th scope="row" rowspan="4">
                                <div id="colunaCafe" style="width: 400px; height: 100%;"></div>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">Bom</th>
                            <th scope="row" id='cb'></th>
                            <th scope="row" id='tcb'></th>
                        </tr>
                        <tr>
                            <th scope="row">Regular</th>
                            <th scope="row" id='cre'></th>
                            <th scope="row" id='tcre'></th>
                        </tr>
                        <tr>
                            <th scope="row">Ruim</th>
                            <th scope="row" id='cru'></th>
                            <th scope="row" id='tcru'></th>
                        </tr>
                        <tr>
                            <th colspan="2">Total de Votos</th>
                            <th scope="row" id="ctotal"></th>
                        </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-header">
                Andamento da Votação do Almoço - <span id="dataAlmoco"><spa>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-5 h-600 p-3" style=" height: 180px; font-size: 12px;">
                            <p class="card-text text-center">
                                <span id="salada"></span><br>
                                <span id="complemento"></span><br>
                                <span id="principalAlmoco"></span><br>
                                <span id="sobremesa"></span><br>
                                <span id="suco"></span><br>
                            </p>
                        </div>
                        <div class="col-7">
                            <div id="piechartAlmoco" style="width: 100%; height: 80%;"></div>
                        </div>
                    </div>
                <table class="table text-center" style="font-size: 14px; margin-bottom: 0;">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Votos</th>
                        <th scope="col"> % </th>
                        <th scope="col">Gráfico</th>
                      </tr>
                    </thead>
                    <tbody class="item">
                        <tr>
                            <th scope="row">Ótimo</th>
                            <th scope="row" id='ao'></th>
                            <th scope="row" id='tao'></th>
                            <th scope="row" rowspan="4">
                                <div id="colunaAlmoco" style="width: 400px; height: 100%;"></div>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">Bom</th>
                            <th scope="row" id='ab'></th>
                            <th scope="row" id='tab'></th>
                        </tr>
                        <tr>
                            <th scope="row">Regular</th>
                            <th scope="row" id='are'></th>
                            <th scope="row" id='tare'></th>
                        </tr>
                        <tr>
                            <th scope="row">Ruim</th>
                            <th scope="row" id='aru'></th>
                            <th scope="row" id='taru'></th>
                        </tr>
                        <tr>
                            <th colspan="2">Total de Votos</th>
                            <th scope="row" id='atotal'></th>
                        </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    const eventSource = new EventSource('{{ route('votos.atualizar') }}');
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
        document.getElementById('tco').innerText = formatarPorcentagem(co, ctotal);
        document.getElementById('tcb').innerText = formatarPorcentagem(cb, ctotal);
        document.getElementById('tcre').innerText = formatarPorcentagem(cre, ctotal);
        document.getElementById('tcru').innerText = formatarPorcentagem(cru, ctotal);

        document.getElementById('salada').innerText = (data.almoco != null ? data.almoco.salada : "Salada");
        document.getElementById('complemento').innerText = (data.almoco != null ? data.almoco.complemento : "Complemento");
        document.getElementById('principalAlmoco').innerText = (data.almoco != null ? data.almoco.principal : "Principal");
        document.getElementById('sobremesa').innerText = (data.almoco != null ? data.almoco.sobremessa : "Sobremessa");
        document.getElementById('suco').innerText = (data.almoco != null ? data.almoco.suco: "Suco");

        const ao = document.getElementById('ao').innerText =  data.votoA !== null ? data.votoA.otimo : 0;
        const ab = document.getElementById('ab').innerText = data.votoA !== null ? data.votoA.bom : 0;
        const are = document.getElementById('are').innerText = data.votoA !== null ? data.votoA.regular : 0;
        const aru = document.getElementById('aru').innerText = data.votoA !== null ? data.votoA.ruim : 0;

        const atotal = document.getElementById('atotal').innerText = ao+ab+are+aru;
        document.getElementById('tao').innerText = formatarPorcentagem(ao, atotal);
        document.getElementById('tab').innerText = formatarPorcentagem(ab, atotal);
        document.getElementById('tare').innerText = formatarPorcentagem(are, atotal);
        document.getElementById('taru').innerText = formatarPorcentagem(aru, atotal);

        // Gráfico de pizza do café
        function drawChartCafe() {
            var dataCafe = google.visualization.arrayToDataTable([
                ['Voto', 'Total'],
                ["Ótimo", co],
                ["Bom", cb],
                ["Regular", cre],
                ["Ruim", cru]
            ]);

            var optionsCafe = {
                backgroundColor: 'white',
                fontName: 'Arial',
                'chartArea': {'width': '90%', 'height': '80%'},
                'legend': {'position': 'bottom'},
                'colors': ['blue', 'green', 'orange', 'red']
            };

            var chartCafe = new google.visualization.PieChart(document.getElementById('piechartCafe'));
            chartCafe.draw(dataCafe, optionsCafe);
        }

        // Gráfico de pizza do almoço
        function drawChartAlmoco() {
            var dataAlmoco = google.visualization.arrayToDataTable([
                ['Voto', 'Total'],
                ["Ótimo", ao],
                ["Bom", ab],
                ["Regular", are],
                ["Ruim", aru]
            ]);

            var optionsAlmoco = {
                backgroundColor: 'white',
                fontName: 'Arial',
                'chartArea': {'width': '90%', 'height': '80%'},
                'legend': {'position': 'bottom'},
                'colors': ['blue', 'green', 'orange', 'red']
            };

            var chartAlmoco = new google.visualization.PieChart(document.getElementById('piechartAlmoco'));
            chartAlmoco.draw(dataAlmoco, optionsAlmoco);
        }

        // Chamar as funções para desenhar os gráficos
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartCafe);
        google.charts.setOnLoadCallback(drawChartAlmoco);

        // Código para desenhar os gráficos de coluna do café e do almoço
        function drawColumnChartCafe() {
            const dataCafe = google.visualization.arrayToDataTable([
                ["Element", "Votos", { role: "style" } ],
                ["Ótimo", co, "blue"],
                ["Bom", cb, "green"],
                ["Regular", cre, "orange"],
                ["Ruim", cru, "red"]
            ]);

            const viewCafe = new google.visualization.DataView(dataCafe);
            viewCafe.setColumns([0, 1,
                { calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" },
                2]);

            const optionsCafe = {
                backgroundColor: 'white',
                fontName: 'Arial',
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            const chartCafe = new google.visualization.ColumnChart(document.getElementById("colunaCafe"));
            chartCafe.draw(viewCafe, optionsCafe);
        }

        function drawColumnChartAlmoco() {
            const dataAlmoco = google.visualization.arrayToDataTable([
                ["Element", "Votos", { role: "style" } ],
                ["Ótimo", ao, "blue"],
                ["Bom", ab, "green"],
                ["Regular", are, "orange"],
                ["Ruim", aru, "red"]
            ]);

            const viewAlmoco = new google.visualization.DataView(dataAlmoco);
            viewAlmoco.setColumns([0, 1,
                { calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" },
                2]);

            const optionsAlmoco = {
                backgroundColor: 'white',
                fontName: 'Arial',
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            const chartAlmoco = new google.visualization.ColumnChart(document.getElementById("colunaAlmoco"));
            chartAlmoco.draw(viewAlmoco, optionsAlmoco);
        }

        // Carregar os gráficos de coluna do café e do almoço
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChartCafe);
        google.charts.setOnLoadCallback(drawChartAlmoco);
        google.charts.setOnLoadCallback(drawColumnChartCafe);
        google.charts.setOnLoadCallback(drawColumnChartAlmoco);
    };
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
