@extends('layouts.app')
@section('content')
    <div class="d-flex flex-column mb-3">
        <div class="p-2">
            <h4 class="text-center fs-2">O que você deseja?</h4>
        </div>
        <div class="p-2">
        <div class="buttons">
            <span class="title-votacao">Fazer votação do Café: </span>
            <a type="button" class="btn btn-primary" id="cadastrar" href="votacaoCafe">Clique Aqui!</a>
        </div>
        </div>
        <div class="p-2">
        <div class="buttons">
            <span class="title-votacao">Fazer votação do Almoço: </span>
            <a type="button" class="btn btn-primary" id="cadastrar" href="votacaoAlmoco">Clique Aqui!</a>
        </div>
        </div>
    </div>
@endsection