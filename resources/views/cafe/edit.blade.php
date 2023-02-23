@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pl-0 pr-0 pb-0">
                    <p class="pl-3">Atualizar Café</p>
                    @if(session('msg'))
                        @php $msg = session('msg'); @endphp
                        <div class="alert alert-danger mb-0 text-center" role="alert">
                            {{ session('msg') }}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                @php $valor = (isset($msg)) ? "disabled" : " ";@endphp
                <fieldset {{ $valor }}>
                    <form method="post" action="{{ route('cafe.update', ['cafe' => $cafe->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Data</label>
                            <input type="date" value="{{  $errors->has('data') ? old('data') : $cafe->data }}" class="form-control red" name="data">
                            <span style="color:red">{{ $errors->has('data') ? $errors->first('data') : '' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Principal</label>
                            <input type="text" value="{{ $errors->has('principal') ? old('principal') : $cafe->principal  }}" class="form-control" name="principal">
                            <span style="color:red">{{ $errors->has('principal') ? $errors->first('principal') : '' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Opção</label>
                            <input type="text" value="{{ $errors->has('opcao') ? old('opcao') : $cafe->opcao  }}" class="form-control" name="opcao">
                            <span style="color:red">{{ $errors->has('opcao') ? $errors->first('opcao') : '' }}</span>
                        </div>
                    </fieldset>
                        <div class="d-grid gap-2 d-md-flex justify-content-between">
                            <a href="{{route('cafe.index')}}" class="btn btn-primary">Cancelar</a>
                            @if (isset($msg))
                                <a class="btn btn-danger" href="{{ route('cafe.edit', $cafe->id) }}">Editar</a>
                            @else
                                <button class="btn btn-primary" type="submit">Atualizar</button>
                            @endif                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
