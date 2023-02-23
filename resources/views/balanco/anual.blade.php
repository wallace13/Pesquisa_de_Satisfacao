@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            Pesquisa de Satisfação - Consultar {{ $title }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('balancoDetalhe')}}" method="post">
                        @csrf
                        <div class="container text-center p-3">
                            <div class="row">
                                <div class="col-6">
                                    Selecione o relatório que deseja pesquisar: 
                                </div>
                                <div class="col-2">
                                    <input class="form-check-input" type="radio" name="tipo" value="cafe" required>Café
                                </div>
                                <div class="col-2">
                                    <input class="form-check-input" type="radio" name="tipo" value="almoco" required>Almoço
                                </div>
                                <div class="col-2">
                                    <input class="form-check-input" type="radio" name="tipo" value="global" required>Global
                                </div>
                            </div>
                        </div>
                        <div class="container text-center">
                            <div class="row">
                                <div class="col-6">
                                    Selecione o ano que deseja pesquisar:
                                </div>
                                <div class="col-6">
                                    <select class="w-100" id="ano" name="ano" required>
                                        <option></option>
                                            <?php   
                                            for ($i = 2019; $i <= date("Y"); $i++) {
                                                print("<option value=$i>$i</option>");
                                                
                                            }?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="container text-center p-3">
                            <div class="row">
                                <div class="col-6">
                                    Selecione o Grafico que deseja visualizar: 
                                </div>
                                <div class="col-3">
                                    <input class="form-check-input" type="radio" name="grafico" value="pizza" required>Pizza
                                </div>
                                <div class="col-3">
                                    <input class="form-check-input" type="radio" name="grafico" value="coluna" required>Coluna
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex pt-5 justify-content-md-end">
                            <button type="submit" class="btn btn-success btn-lg">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
