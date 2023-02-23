@extends('layouts.dashboard')

@section('content')
<div class="row mb-3 ml-2 mr-2">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                Andamento da Votação do Café - {{ isset($cafe->data) ? implode("/",array_reverse(explode("-",$cafe->data))) : "00/00/0000"}}
            </div>
            <div class="card-body">
                    <div class="row">
                      <div class="col-5 h-600 p-3" style=" height: 180px; font-size: 12px;">
                        <p class="card-text text-center">
                            {{ isset($cafe->principal) ? $cafe->principal : "Principal"; }}</br>
                            {{ isset($cafe->opcao) ? $cafe->opcao : "Opção"; }}
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
                        <th scope="col">%</th>
                        <th scope="col">Gráfico</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $CO = isset($votoB->otimo) ? $votoB->otimo : 0;
                            $CB = isset($votoB->bom) ? $votoB->bom : 0;
                            $CRE = isset($votoB->regular) ? $votoB->regular : 0;
                            $CRU = isset($votoB->ruim) ? $votoB->ruim : 0;
                            $total = $CO + $CB + $CRE + $CRU;
                        @endphp
                        <tr>
                            <th scope="row">Ótimo</th>
                            <th scope="row">{{$CO}}</th>
                            <th scope="row">{{ $CO > 0 ? number_format((($CO/$total)*100) , 1) : $CO ,' %' }}</th>
                            <th scope="row" rowspan="4">
                                <div id="colunaCafe" style="width: 400px; height: 100%;"></div>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">Bom</th>
                            <th scope="row">{{ $CB}}</th>
                            <th scope="row">{{ $CB > 0 ? number_format((($CB/$total)*100) , 1) : $CB ,' %' }}</th>
                        </tr>
                        <tr>
                            <th scope="row">Regular</th>
                            <th scope="row">{{ $CRE}}</th>
                            <th scope="row">{{ $CRE > 0 ? number_format((($CRE/$total)*100) , 1) : $CRE ,' %' }}</th>
                        </tr>
                        <tr>
                            <th scope="row">Ruim</th>
                            <th scope="row">{{ $CRU}}</th>
                            <th scope="row">{{ $CRU > 0 ? number_format((($CRU/$total)*100) , 1) : $CRU ,' %' }}</th>
                        </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-header">
                Andamento da Votação do Almoço - {{ isset($almoco->data) ? implode("/",array_reverse(explode("-",$almoco->data))) : "00/00/0000"}}
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-5 h-600 p-3" style=" height: 180px; font-size: 12px;">
                            <p class="card-text text-center">
                                {{ isset($almoco->salada) ? $almoco->salada : "Salada";}}</br>
                                {{ isset($almoco->complemento) ? $almoco->complemento : "Complemento";}}</br>
                                {{ isset($almoco->principal) ? $almoco->principal : "Principal";}}</br>
                                {{ isset($almoco->sobremesa) ? $almoco->sobremesa : "Sobremesa";}}</br>
                                {{ isset($almoco->suco) ? $almoco->suco : "Suco";}}
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
                        <th scope="col">%</th>
                        <th scope="col">Gráfico</th>
                      </tr>
                    </thead>
                    <tbody class="item">
                        @php
                            $AO = isset($votoA->otimo) ? $votoA->otimo : 0;
                            $AB = isset($votoA->bom) ? $votoA->bom : 0;
                            $ARE = isset($votoA->regular) ? $votoA->regular : 0;
                            $ARU = isset($votoA->ruim) ? $votoA->ruim : 0;
                            $total = $AO + $AB + $ARE + $ARU;
                        @endphp
                        <tr>
                            <th scope="row">Ótimo</th>
                            <th scope="row">{{$AO}}</th>
                            <th scope="row">{{ $AO > 0 ? number_format((($AO/$total)*100) , 1) : $AO ,' %' }}</th>
                            <th scope="row" rowspan="4">
                                <div id="colunaAlmoco" style="width: 400px; height: 100%;"></div>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">Bom</th>
                            <th scope="row">{{$AB}}</th>
                            <th scope="row">{{ $AB > 0 ? number_format((($AB/$total)*100) , 1) : $AB ,' %' }}</th>
                        </tr>
                        <tr>
                            <th scope="row">Regular</th>
                            <th scope="row">{{$ARE}}</th>
                            <th scope="row">{{ $ARE > 0 ? number_format((($ARE/$total)*100) , 1) : $ARE ,' %' }}</th>
                        </tr>
                        <tr>
                            <th scope="row">Ruim</th>
                            <th scope="row">{{$ARU}}</th>
                            <th scope="row">{{ $ARU > 0 ? number_format((($ARU/$total)*100) , 1) : $ARU ,' %' }}</th>
                        </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
<?php
echo "<meta HTTP-EQUIV='refresh' CONTENT='10'>";
?>
@endsection

<!--Grafico Coluna Almoco-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ["Element", "votos", { role: "style" } ],
        ["Otimo", {{ $AO }}, "blue"],
        ["Bom", {{ $AB }}, "green"],
        ["Regular", {{ $ARE }}, "orange"],
        ["Ruim", {{ $ARU }}, "red"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                    { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },
                    2]);

    var options = {
        backgroundColor: 'white',
        fontName: 'Arial',
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("colunaAlmoco"));
    chart.draw(view, options);
}
</script>
<!--Grafico Pizza-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
    ['Voto', 'Total'],
    ["Otimo", {{ $AO }}],
    ["Bom", {{ $AB }}],
    ["Regular", {{ $ARE }}],
    ["Ruim", {{ $ARU }}]
    ]);

    var options = {
    backgroundColor: 'white',
    fontName: 'Arial',
    'chartArea': {'width': '90%', 'height': '80%'},
    'legend': {'position': 'bottom'},
    'colors': ['green', 'blue', 'orange', 'red']
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechartAlmoco'));

    chart.draw(data, options);
}
</script>
<!--Grafico Pizza-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
    ['Voto', 'Total'],
    ["Otimo", {{ $CO }}],
    ["Bom", {{ $CB }}],
    ["Regular", {{ $CRE }}],
    ["Ruim", {{ $CRU}}]
    ]);

    var options = {
    backgroundColor: 'white',
    fontName: 'Arial',
    'chartArea': {'width': '90%', 'height': '80%'},
    'legend': {'position': 'bottom'},
    'colors': ['green', 'blue', 'orange', 'red']
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechartCafe'));

    chart.draw(data, options);
}
</script>
 <!--Grafico Coluna Café-->
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script type="text/javascript">
     google.charts.load("current", {packages:['corechart']});
     google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
     var data = google.visualization.arrayToDataTable([
         ["Element", "votos", { role: "style" } ],
         ["Otimo", {{ $CO}}, "blue"],
         ["Bom", {{ $CB }}, "green"],
         ["Regular", {{ $CRE }}, "orange"],
         ["Ruim", {{ $CRU }}, "red"]
     ]);

     var view = new google.visualization.DataView(data);
     view.setColumns([0, 1,
                     { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                     2]);

     var options = {
         backgroundColor: 'white',
         fontName: 'Arial',
         bar: {groupWidth: "95%"},
         legend: { position: "none" },
     };
     var chart = new google.visualization.ColumnChart(document.getElementById("colunaCafe"));
     chart.draw(view, options);
 }
 </script>                       