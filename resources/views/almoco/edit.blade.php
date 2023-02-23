@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pl-0 pr-0 pb-0">
                    <p class="pl-3">Atualizar Almoço</p>
                    @if(session('msg'))
                        @php $msg = session('msg');@endphp
                        <div class="alert alert-danger mb-0 text-center" role="alert">
                            {{ session('msg') }}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                @php
                    $valor = (isset($msg)) ? "disabled" : " ";
                @endphp
                <fieldset {{ $valor }}>
                    <form method="post" action="{{ route('almoco.update', ['almoco' => $almoco->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Data</label>
                            <input type="date" value="{{  $errors->has('data') ? old('data') : $almoco->data }}" class="form-control red" name="data">
                            <span style="color:red">{{ $errors->has('data') ? $errors->first('data') : '' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salada</label>
                            <input type="text" value="{{  $errors->has('salada') ? old('salada') : $almoco->salada}}" class="form-control" name="salada">
                            <span style="color:red">{{ $errors->has('salada') ? $errors->first('salada') : '' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Complemento</label>
                            <input type="text" value="{{ $errors->has('complemento') ? old('complemento') : $almoco->complemento }}" class="form-control" name="complemento">
                            <span style="color:red">{{ $errors->has('complemento') ? $errors->first('complemento') : '' }}</span>
                        </div>  
                        <div class="mb-3">
                            <label class="form-label">Principal</label>
                            <input type="text" value="{{ $errors->has('principal') ? old('principal') : $almoco->principal  }}" class="form-control" name="principal">
                            <span style="color:red">{{ $errors->has('principal') ? $errors->first('principal') : '' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sobremesa</label>
                            <input type="text" value="{{ $errors->has('sobremesa') ? old('sobremesa') : $almoco->sobremesa  }}" class="form-control" name="sobremesa">
                            <span style="color:red">{{ $errors->has('sobremesa') ? $errors->first('sobremesa') : '' }}</span>
                        </div> 
                        <div class="mb-3">
                            <label class="form-label">Suco</label>
                            <input type="text" value="{{ $errors->has('suco') ? old('suco') : $almoco->suco  }}" class="form-control" name="suco">
                            <span style="color:red">{{ $errors->has('suco') ? $errors->first('suco') : '' }}</span>
                        </div>     
                    </fieldset>
                        <div class="d-grid gap-2 d-md-flex justify-content-between">
                            <a href="{{route('almoco.index')}}" class="btn btn-primary">Cancelar</a>
                            @if (isset($msg))
                                <a class="btn btn-danger" href="{{ route('almoco.edit', $almoco->id) }}">Editar</a>
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
