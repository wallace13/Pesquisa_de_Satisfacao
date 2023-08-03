@extends('layouts.dashboard')

@section('content')

<div class="row mb-3 ml-2 mr-2">
    <div class="col-sm-6 mb-sm-0">
        <div class="card ">
            <div class="card-header">
                Andamento da Votação do Café - <span id="dataCafe"><span>
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
                        <p class="fs-6 text-center">Gráfico Pizza</p>
                        <div id="graficoContainer" style="height: 180px; width: 100%;">
                            <canvas id="pizzaCafe"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-5">
                        <table class="table text-center" style="font-size: 14px; margin-bottom: 0;">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Votos</th>
                                <th scope="col"> % </th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Ótimo</th>
                                    <th scope="row" id='co'></th>
                                    <th scope="row" id='tco'></th>
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
                    <div class="col-7">
                        <p class="fs-6 text-center">Gráfico Coluna</p>
                        <div id="graficoContainer" style="height: 200px; width: 100%;">
                            <canvas id="colunaCafe"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 mb-sm-0">
        <div class="card">
            <div class="card-header">
                Andamento da Votação do Almoço - <span id="dataAlmoco"><span>
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
                        <p class="fs-6 text-center">Gráfico Pizza</p>
                        <div id="graficoContainer" style="height: 180px; width: 100%;">
                            <canvas id="pizzaAlmoco"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-5">
                        <table class="table text-center" style="font-size: 14px; margin-bottom: 0;">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Votos</th>
                                <th scope="col"> % </th>
                              </tr>
                            </thead>
                            <tbody class="item">
                                <tr>
                                    <th scope="row">Ótimo</th>
                                    <th scope="row" id='ao'></th>
                                    <th scope="row" id='tao'></th>
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
                    <div class="col-7">
                        <p class="fs-6 text-center">Gráfico Coluna</p>
                        <div id="graficoContainer" style="height: 200px; width: 100%;">
                            <canvas id="colunaAlmoco"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
<script>
    // Defina a variável global com a URL da rota atualizar votos
    window.atualizarVotosUrl = '{{ route('votos.atualizar') }}';
</script>
<!-- Agora, inclua seu arquivo JavaScript externo -->
<script src="{{ asset('js/dashboard.js') }}"></script>