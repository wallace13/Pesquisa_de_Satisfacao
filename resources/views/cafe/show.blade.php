@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pl-0 pr-0 pb-0 pt-0">
                    @if(session('msg'))
                        @php $msg = session('msg'); 
                        $alerta = ($msg == "Cadastro existente!") ? "alert alert-danger mb-0 text-center" : "alert alert-success mb-0 text-center" ;
                        @endphp
                        <div class="{{ $alerta }}" role="alert">
                            {{ session('msg') }}
                        </div>
                    @else
                        @php
                            $msg = " "
                        @endphp
                        <div class="mb-3 pt-3 pl-3">Cardápio</div>
                    @endif
                </div>
                <div class="card-body">
                    <fieldset disabled>
                        <div class="mb-3">
                            <label class="form-label">Data</label>
                            <input type="date" class="form-control" value="{{ $cafe->data }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Principal</label>
                            <input type="text" class="form-control" value="{{ $cafe->principal }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Opção</label>
                            <input type="text" class="form-control" value="{{ $cafe->opcao }}">
                        </div>  
                        <div class="mb-3">
                            <label class="form-label">Cardápio cadastrado por:</label>
                            <input type="text" class="form-control" value="{{ $nome->name }}">
                        </div>  
                    </fieldset>
                    @php
                    if ($msg == "Cadastro criado com sucesso!" || $msg == "Edição efetuada com sucesso!") {
                        $rota1 = url()->previous();
                        $name1 = "Voltar";
                        $rota2 = route('cafe.index');
                        $name2 = "Confirmar";
                        $cor = "btn btn-success";
                    } else {
                        $rota1 = route('cafe.index');
                        $name1 = "Cancelar";
                        $rota2 = route('cafe.edit', $cafe->id);
                        $name2 = "Editar";
                        $cor = "btn btn-danger" ;
                    }          
                    ($msg == " ") ? $name1 = "Voltar" : $name1 ;              
                    @endphp
                    <div class="d-grid gap-2 d-md-flex justify-content-between">
                        <a href="{{ $rota1 }}" class="btn btn-primary">{{ $name1 }}</a>
                        <a href="{{ $rota2 }}" class="{{ $cor }}">{{ $name2 }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
