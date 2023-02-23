@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Atualizar Dados do Funcionário</div>

                <div class="card-body">
                    <form method="post" action="{{ route('administrativo.update',$user->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label class="form-label">{{ __('Nome') }}</label>
                            <input id="name"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ ($errors->has('name')) ? old('name')  : $user->name; }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('E-Mail') }}</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ ($errors->has('email')) ? old('email')  : $user->email; }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nivelPermissao" class="form-label">{{ __('Nivel de Permissão') }}</label>
                            @php
                              $opcao1 = ($user->nivelPermissao == 1) ? "Gerente" : "Funcionário" ;   
                              $opcao2 = ($opcao1 == "Gerente") ? "Funcionário" : "Gerente" ;
                              $value1 = ($opcao1  == "Gerente") ? 1 : 2;
                              $value2 = ($opcao2  == "Gerente") ? 1 : 2;
                            @endphp
                            <select class="form-control @error('nivelPermissao') is-invalid @enderror" id="nivelPermissao" 
                            name="nivelPermissao"   autocomplete="nivelPermissao">
                                <option value="{{ $value1 }}">{{ $opcao1 }}</option>
                                <option value="{{ $value2 }}">{{ $opcao2 }}</option>    
                            </select> 
                            @error('nivelPermissao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <fieldset disabled>
                            <div class="mb-3">
                                <label class="form-label">Senha</label>
                                <input type="text" class="form-control" name="password" value="{{$user->password}}">
                            </div>
                        </fieldset>
                        <div class="d-grid gap-2 d-md-flex justify-content-between">
                            <a href="{{route('administrativo.index')}}" class="btn btn-primary">Cancelar</a>
                            <button class="btn btn-primary " type="submit">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
