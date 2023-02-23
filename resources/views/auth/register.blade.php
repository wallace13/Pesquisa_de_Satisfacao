@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar novo usuário') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('administrativo.store') }}">

                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nivelPermissao" class="col-md-4 col-form-label text-md-right">{{ __('Nivel de Permissão') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('nivelPermissao') is-invalid @enderror" id="nivelPermissao" 
                                name="nivelPermissao"   autocomplete="nivelPermissao">
                                    @php
                                        if ( old('nivelPermissao') == "01") {
                                            $escolha = "Gerente";
                                        } else if(old('nivelPermissao') == "02"){
                                            $escolha = "Funcionário";
                                        }else{
                                            $escolha = "";
                                        }                                        
                                    @endphp
                                    <option value="{{ old('nivelPermissao') }}">{{ $escolha }}</option>
                                    @if (old('nivelPermissao') == "01")
                                        <option value="02">Funcionário</option>  
                                    @endif 
                                    @if (old('nivelPermissao') == "02")
                                        <option value="01">Gerente</option>
                                    @endif        
                                    @if (old('nivelPermissao') == "")
                                        <option value="01">Gerente</option> 
                                        <option value="02">Funcionário</option> 
                                    @endif  
                                </select> 
                                @error('nivelPermissao')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
                            <button type="submit" class="btn btn-primary">{{ __('Cadastrar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
