@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Café</div>

                <div class="card-body">
                    <form method="post" action="{{ route('cafe.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Data</label>
                            <input type="date" value="{{ old('data') }}" class="form-control red" name="data">
                            <span style="color:red">{{ $errors->has('data') ? $errors->first('data') : '' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Principal</label>
                            <input type="text" value="{{ old('principal') }}" class="form-control" name="principal">
                            <span style="color:red">{{ $errors->has('principal') ? $errors->first('principal') : '' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Opção</label>
                            <input type="text" value="{{ old('opcao') }}" class="form-control" name="opcao">
                            <span style="color:red">{{ $errors->has('opcao') ? $errors->first('opcao') : '' }}</span>
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
