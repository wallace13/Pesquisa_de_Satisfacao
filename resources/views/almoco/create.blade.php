@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Almoço</div>

                <div class="card-body">
                    <form method="post" action="{{ route('almoco.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Data</label>
                            <input type="date" value="{{ old('data') }}" class="form-control red" name="data">
                            <span style="color:red">{{ $errors->has('data') ? $errors->first('data') : '' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salada</label>
                            <input type="text" value="{{ old('salada') }}" class="form-control" name="salada">
                            <span style="color:red">{{ $errors->has('salada') ? $errors->first('salada') : '' }}</span> 
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Complemento</label>
                            <input type="text" value="{{ old('complemento') }}" class="form-control" name="complemento">
                            <span style="color:red">{{ $errors->has('complemento') ? $errors->first('complemento') : '' }}</span>
                        </div>  
                        <div class="mb-3">
                            <label class="form-label">Principal</label>
                            <input type="text" value="{{ old('principal') }}" class="form-control" name="principal">
                            <span style="color:red">{{ $errors->has('principal') ? $errors->first('principal') : '' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sobremesa</label>
                            <input type="text" value="{{ old('sobremesa') }}" class="form-control" name="sobremesa">
                            <span style="color:red">{{ $errors->has('sobremesa') ? $errors->first('sobremesa') : '' }}</span>
                        </div> 
                        <div class="mb-3">
                            <label class="form-label">Suco</label>
                            <input type="text" value="{{ old('suco') }}" class="form-control" name="suco">
                            <span style="color:red">{{ $errors->has('suco') ? $errors->first('suco') : '' }}</span>
                        </div>           
                        <div class="d-grid gap-2 d-md-flex justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
