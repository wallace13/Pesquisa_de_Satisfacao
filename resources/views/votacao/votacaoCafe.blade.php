@extends('layouts.app')
@section('content') 
<div class="painel-votos">
    <div class="container text-center">
        <div class="row">
            <div class="col">{{ isset($cafe->principal) ? $cafe->principal : "Principal"; }}</div>
        </div>
        <div class="row">
            <div class="col">{{ isset($cafe->opcao) ? $cafe->opcao : "Opção"; }}</div>
        </div>
    </div>
    @php
        $valor = (isset($cafe->principal)) ? "" : "disabled";
    @endphp
    <div id="vote">Vote Abaixo:</div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <span class="btn-voto text-center" id="tipoVoto">Ótimo</span>
            <span class="btn-voto text-center" id="tipoVoto">Bom</span>
            <span class="btn-voto text-center" id="tipoVoto">Regular</span>    
            <span class="btn-voto text-center" id="tipoVoto">Ruim</span>
        </div>
        <form method="post" action="/votacaoCafe/votarCafe/{{ isset($cafe->id) ? $cafe->id : 0; }}">
            @csrf
            @method('PUT')
            <fieldset {{ $valor }}>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <button class="btn btn-success btn-voto" name="voto" value="otimo"><img src = "/img/otimo.png" alt = "projeto"></button>
                <button class="btn btn-primary btn-voto"  name="voto" value="bom"><img src = "/img/bom.png" alt = "projeto"></button>
                <button class="btn btn-warning btn-voto" name="voto" value="regular"><img src = "/img/regular.png" alt = "projeto"></button>    
                <button class="btn btn-danger btn-voto"name="voto" value="ruim"><img src = "/img/ruim.png" alt = "projeto"></button>
                
            </div>
            </fieldset>
        </form>  
        
</div>
@endsection