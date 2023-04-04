@extends('layouts.app')
@section('content') 
<div class="painel-votos">
    <div class="container text-center">
        <div class="row">
            <div class="col">{{ isset($almoco->salada) ? $almoco->salada : "Salada";}}</div>
        </div>
        <div class="row">
            <div class="col">{{ isset($almoco->complemento) ? $almoco->complemento : "Complemento";}}</div>
        </div>
        <div class="row">
            <div class="col">{{ isset($almoco->principal) ? $almoco->principal : "Principal";}}</div>
        </div>
        <div class="row">
            <div class="col">{{ isset($almoco->sobremesa) ? $almoco->sobremesa : "Sobremesa";}}</div>
        </div>
        <div class="row">
            <div class="col">{{ isset($almoco->suco) ? $almoco->suco : "Suco";}}</div>
        </div>
    </div>
    @php
        $valor = (isset($almoco->principal)) ? "" : "disabled";
    @endphp
    <div id="vote">Vote Abaixo:</div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <span class="btn-voto text-center" id="tipoVoto">Ótimo</span>
            <span class="btn-voto text-center" id="tipoVoto">Bom</span>
            <span class="btn-voto text-center" id="tipoVoto">Regular</span>    
            <span class="btn-voto text-center" id="tipoVoto">Ruim</span>
        </div>
        <form method="post" action="/votacaoAlmoco/votarAlmoco/{{ isset($almoco->id) ? $almoco->id : 0; }}">
            @csrf
            @method('PUT')
            <fieldset {{ $valor }}>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button class="btn btn-success btn-voto" name="voto" value="otimo">
                        @svg('bi-emoji-laughing-fill')
                    </button>
                    <button class="btn btn-primary btn-voto"  name="voto" value="bom">
                        @svg('bi-emoji-smile-fill')
                    </button>
                    <button class="btn btn-warning btn-voto" name="voto" value="regular">
                        @svg('bi-emoji-neutral-fill')
                    </button>    
                    <button class="btn btn-danger btn-voto"name="voto" value="ruim">
                        @svg('bi-emoji-frown-fill')
                    </button>
                </div>
            </fieldset>
        </form>  
        
</div>
@endsection