@extends('layouts.app')
@section('content')
<div class="painel-votos">
    <div class="container text-center">
        <div class="row">
            <div class="col">Deixe aqui suas críticas, elogios ou sugestões para melhorar nosso atendimento!</div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <form method="post" action="{{ route('sugestaoStore') }}">
                        @csrf
                        <label for="exampleFormControlTextarea1" class="form-label"></label>
                        <textarea class="form-control" name="sugestao" rows="5" style="resize: none"></textarea>
                        <div class="d-grid gap-2 pt-5 pb-2 d-md-flex justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-success btns-sugestao">Voltar</a>
                            <button type="submit" class="btn btn-outline-success btns-sugestao">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
