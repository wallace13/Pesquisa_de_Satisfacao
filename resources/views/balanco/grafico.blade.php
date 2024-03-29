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
                                <th scope="col" colspan="2">Total de Ótimos</th>
                                <th scope="col" colspan="2">Total de Bons</th>
                                <th scope="col" colspan="2">Total de Regulares</th>
                                <th scope="col"colspan="2">Total de Ruins</th>
                            </tr>
                        </thead>
                        @php
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
                            // Create a PHP array to hold the data
                            $data = [$otimo, $bom, $regular, $ruim];
                            // Convert the PHP array to a JSON string
                            $jsonData = json_encode($data);

                            $Ptotal = $otimo + $bom + $regular + $ruim;
            
                            $Potimo = $otimo > 0 ? $Potimo = number_format((($otimo /$Ptotal)*100) , 1) : $Potimo = $otimo;
                            $Pbom =  $bom > 0 ? $Pbom = number_format((($bom /$Ptotal)*100) , 1) : $Pbom = $bom;
                            $Pregular = $regular > 0 ? $Pregular = number_format((($regular /$Ptotal)*100) , 1) : $Pregular = $regular;
                            $Pruim = $ruim > 0 ? $Pruim = number_format((($ruim /$Ptotal)*100) , 1) : $Pruim = $ruim;
            
                            $TPer = $Potimo + $Pbom + $Pregular + $Pruim;
                    @endphp
                        <tbody>
                            <tr>
                                <td>{{ $otimo }}</td>
                                <td>{{ $Potimo.'%' }}</td>
                                <td>{{ $bom }}</td>
                                <td>{{ $Pbom.'%' }}</td>
                                <td>{{ $regular }}</td>
                                <td>{{ $Pregular.'%' }}</td>
                                <td>{{ $ruim }}</td>
                                <td>{{ $Pruim.'%' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    @php 
                        $tipo=($grafico == "pizza" ? "piechart" : "coluna");
                        $tipoGrafico = ['tipo' => $tipo];
                        $jsonTipo = json_encode($tipoGrafico);
                    @endphp
                    <div id="graficoContainer" style="height: 350px; width: 100%;">
                        <canvas id="{{ $tipo }}"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    var satisfactionData = {!! $jsonData !!};
    var tipoGrafico = {!! $jsonTipo !!};
</script>
<script src="{{ asset('js/balancos.js') }}" defer></script>