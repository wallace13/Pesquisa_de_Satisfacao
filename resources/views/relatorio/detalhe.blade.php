@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            {{ $title }}
                        </div>
                        @if (isset($votos))
                            <div class="col-6">
                                <div class="float-right">
                                    <a href="{{route('relatorio.exportacao', ['extensao' => 'xlsx', 'tipo' => $dados['tipo'], 'ano' => $dados['ano'], 'mes' => $dados['mes'], 'titulo' => $title])}}" class="mr-3">XLSX</a>
                                    <a href="{{route('relatorio.exportacao', ['extensao' => 'csv', 'tipo' => $dados['tipo'], 'ano' => $dados['ano'], 'mes' => $dados['mes'], 'titulo' => $title])}}" class="mr-3">CSV</a>
                                    <a href="{{route('relatorio.exportar', ['tipo' => $dados['tipo'], 'ano' => $dados['ano'], 'mes' => $dados['mes'], 'titulo' => $title])}}" target="_blank">PDF</a>
                                </div>
                            </div>
                        @endif                        
                    </div>
                </div>

                <div class="card-body">
                    
                    <table class="table" >
                        <thead>
                            <tr>
                                <th scope="col" colspan="7">Pesquisa de Satisfação - {{ $title }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Principal</th>
                                <th scope="col">Ótimo</th>
                                <th scope="col">Bom</th>
                                <th scope="col">Regular</th>
                                <th scope="col">Ruim</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($votos))
                            @foreach($votos as $key => $c)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($c->data)) }}</td>
                                    <td>{{ $c->principal}}</td>
                                    <td>{{ $c->otimo}}</td>
                                    <td>{{ $c->bom}}</td>
                                    <td>{{ $c->regular}}</td>
                                    <td>{{ $c->ruim  }}</td>
                                    @php
                                        $total = $c->otimo + $c->bom + $c->regular + $c->ruim;
                                    @endphp
                                    <td>{{ $total}}</td>
                                </tr>
                                <tr>
                                    @php
                                        $otimo = $c->otimo > 0 ? $otimo = number_format((($c->otimo /$total)*100) , 1) : $otimo = $c->otimo;
                                        $bom =  $c->bom > 0 ? $bom = number_format((($c->bom /$total)*100) , 1) : $bom = $c->bom;
                                        $regular = $c->regular > 0 ? $regular = number_format((($c->regular /$total)*100) , 1) : $regular = $c->regular;
                                        $ruim = $c->ruim > 0 ? $ruim = number_format((($c->ruim /$total)*100) , 1) : $ruim = $c->ruim;
                                    @endphp
                                    <td colspan="2">Percentual</td>
                                    <td>{{ $otimo.'%' }}</td>
                                    <td>{{ $bom.'%' }}</td>
                                    <td>{{ $regular.'%' }}</td>
                                    <td>{{ $ruim.'%' }}</td>
                                    @php
                                        $percentualTotal = $otimo + $bom + $regular + $ruim;
                                    @endphp
                                    <td>{{ $percentualTotal.'%'}}</td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
