@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            Pesquisa de Satisfação - Consultar Relatórios de Votação
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('detalhe')}}" method="post">
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
                                    Selecione o mês que deseja pesquisar:
                                </div>
                                <div class="col-6">
                                    <select class="w-100" id="mes" name="mes" required>
                                        <option></option>
                                        <option value="01">Janeiro</option>
                                        <option value="02">Fevereiro</option>
                                        <option value="03">Março</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Maio</option>
                                        <option value="05">Junho</option>
                                        <option value="07">Julho</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Setembro</option> 
                                        <option value="10">Outubro</option>
                                        <option value="11">Novembro</option>
                                        <option value="12">Dezembro</option>           
                                    </select>      
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
