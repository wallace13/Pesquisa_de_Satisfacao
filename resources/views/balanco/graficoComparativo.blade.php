@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            Pesquisa de Satisfação - {{ $title }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table text-center" border="1">
                        <thead>
                            <tr>
                                <th scope="col">Mês</th>
                                <th scope="col" colspan="2">Total de Ótimos</th>
                                <th scope="col" colspan="2">Total de Bons</th>
                                <th scope="col" colspan="2">Total de Regulares</th>
                                <th scope="col"colspan="2">Total de Ruins</th>
                            </tr>
                        </thead>
                        @php
                            ////Mes 1
                            if (isset($totais[0]->otimos) && isset($totais[0]->bons) && isset($totais[0]->regulares) && isset($totais[0]->ruins)) {
                                $otimo = $totais[0]->otimos;
                                $bom = $totais[0]->bons;
                                $regular = $totais[0]->regulares;
                                $ruim = $totais[0]->ruins;
                            } else if(isset( $totais[0]->aotimos) && isset($totais[0]->abons) && isset($totais[0]->aregulares) && isset($totais[0]->aruins)){
                                $otimo = $totais[0]->aotimos+$totais[1]->cotimos;
                                $bom = $totais[0]->abons+$totais[1]->cbons;
                                $regular = $totais[0]->aregulares+$totais[1]->cregulares;
                                $ruim = $totais[0]->aruins+$totais[1]->cruins;
                            }else{
                                $otimo = 0;
                                $bom = 0;
                                $regular = 0;
                                $ruim = 0;
                            }
                            $Ptotal = $otimo + $bom + $regular + $ruim;
            
                            $Potimo = $otimo > 0 ? $Potimo = number_format((($otimo /$Ptotal)*100) , 1) : $Potimo = $otimo;
                            $Pbom =  $bom > 0 ? $Pbom = number_format((($bom /$Ptotal)*100) , 1) : $Pbom = $bom;
                            $Pregular = $regular > 0 ? $Pregular = number_format((($regular /$Ptotal)*100) , 1) : $Pregular = $regular;
                            $Pruim = $ruim > 0 ? $Pruim = number_format((($ruim /$Ptotal)*100) , 1) : $Pruim = $ruim;
            
                            $TPer = $Potimo + $Pbom + $Pregular + $Pruim;
                            ////Mes 2

                            if (isset($totais2[0]->otimos) && isset($totais2[0]->bons) && isset($totais2[0]->regulares) && isset($totais2[0]->ruins)) {
                                $otimo2 = $totais2[0]->otimos;
                                $bom2 = $totais2[0]->bons;
                                $regular2 = $totais2[0]->regulares;
                                $ruim2 = $totais2[0]->ruins;
                            } else if(isset( $totais2[0]->aotimos) && isset($totais2[0]->abons) && isset($totais2[0]->aregulares) && isset($totais2[0]->aruins)){
                                $otimo2 = $totais2[0]->aotimos+$totais2[1]->cotimos;
                                $bom2 = $totais2[0]->abons+$totais2[1]->cbons;
                                $regular2 = $totais2[0]->aregulares+$totais2[1]->cregulares;
                                $ruim2 = $totais2[0]->aruins+$totais2[1]->cruins;
                            }else{
                                $otimo2 = 0;
                                $bom2 = 0;
                                $regular2 = 0;
                                $ruim2 = 0;
                            }
            
                            $Ptotal2 = $otimo2 + $bom2 + $regular2 + $ruim2;
            
                            $Potimo2 = $otimo2 > 0 ? $Potimo2 = number_format((($otimo2 /$Ptotal2)*100) , 1) : $Potimo2 = $otimo2;
                            $Pbom2 =  $bom2 > 0 ? $Pbom2 = number_format((($bom2 /$Ptotal2)*100) , 1) : $Pbom2 = $bom2;
                            $Pregular2 = $regular2 > 0 ? $Pregular2 = number_format((($regular2 /$Ptotal2)*100) , 1) : $Pregular2 = $regular2;
                            $Pruim2 = $ruim2 > 0 ? $Pruim2 = number_format((($ruim2 /$Ptotal2)*100) , 1) : $Pruim2 = $ruim2;
            
                            $TPer2 = $Potimo2 + $Pbom2 + $Pregular2 + $Pruim2;
                        @endphp
                        <tbody>
                            <tr>
                                <td>{{ $mes }}</td>
                                <td>{{ $otimo }}</td>
                                <td>{{ $Potimo.'%' }}</td>
                                <td>{{ $bom }}</td>
                                <td>{{ $Pbom.'%' }}</td>
                                <td>{{ $regular }}</td>
                                <td>{{ $Pregular.'%' }}</td>
                                <td>{{ $ruim }}</td>
                                <td>{{ $Pruim.'%' }}</td>
                            </tr>
                            <tr>
                                <td>{{ $mes2 }}</td>
                                <td>{{ $otimo2 }}</td>
                                <td>{{ $Potimo2.'%' }}</td>
                                <td>{{ $bom2 }}</td>
                                <td>{{ $Pbom2.'%' }}</td>
                                <td>{{ $regular2 }}</td>
                                <td>{{ $Pregular2.'%' }}</td>
                                <td>{{ $ruim2 }}</td>
                                <td>{{ $Pruim2.'%' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="chart_div" style="width: 100%; height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!--Grafico Comparativo-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawVisualization);

function drawVisualization() {
// Some raw data (not necessarily accurate)
var data = google.visualization.arrayToDataTable([
    ['','{{ $mes }}','{{ $mes2 }}'],
    ['Otimo',{{ $otimo }},{{ $otimo2 }}],
    ['Bom',{{ $bom }},{{ $bom2 }}],
    ['Regular',{{ $regular }},{{ $regular2 }}],
    ['Ruim',{{ $ruim }},{{ $ruim2 }}]
]);

var options = {
    vAxis: {title: 'Votos'},
    seriesType: 'bars',
    series: {5: {type: 'line'}}
};

var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
chart.draw(data, options);
}
</script>
