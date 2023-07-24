@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            Pesquisa de Satisfação - Consultar Votações
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('votacaoDetalhe')}}" method="post">
                        @csrf
                        <div class="container text-center">
                            <div class="row">
                                <div class="col-6">
                                    Selecione a data que deseja pesquisar:
                                </div>
                                <div class="col-6">
                                    <input type="date" class="form-control" name="data">
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
