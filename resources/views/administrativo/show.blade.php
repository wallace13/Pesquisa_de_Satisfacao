@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Funcionário</div>
                <div class="card-body">
                    <fieldset disabled>
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="text" class="form-control" name="email" value="{{$user->email}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nivel de Permissão</label>
                            @php
                              $opcao1 = ($user->nivelPermissao == 1) ? "Gerente" : "Funcionário" ;   
                              $opcao2 = ($opcao1 == "Gerente") ? "Funcionário" : "Gerente" ;
                              $value1 = ($opcao1  == "Gerente") ? 1 : 2;
                              $value2 = ($opcao2  == "Gerente") ? 1 : 2;
                            @endphp
                            <select class="form-control" id="nivelPermissao" name="nivelPermissao" required>
                                <option value="{{ $value1 }}">{{ $opcao1 }}</option>
                                <option value="{{ $value2 }}">{{ $opcao2 }}</option>    
                            </select> 
                        </div>  
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="text" class="form-control" name="password" value="{{$user->password}}">
                        </div>
                    </fieldset>
                    <div class="d-grid gap-2 d-md-flex justify-content-between">
                        <a href="{{ route('administrativo.edit', $user->id) }}" class="btn btn-danger">Editar</a>
                        <a href="{{route('administrativo.index')}}" class="btn btn-success">Confirmar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
