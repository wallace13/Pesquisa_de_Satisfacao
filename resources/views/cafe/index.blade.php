@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Café
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <a href="{{route('cafe.create')}}" class="mr-3">Novo</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <table class="table text-center">
                        <thead >
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Data</th>
                                <th scope="col">Principal</th>
                                <th scope="col">Opção</th>
                                <th colspan="2">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($cafes as $key => $c)
                                <tr>
                                    <th scope="row">{{ $c->id }}</th>
                                    <td>{{ date('d/m/Y', strtotime($c->data)) }}</td>
                                    <td>{{ $c->principal }}</td>
                                    <td>{{ $c->opcao }}</td>
                                    <td><a href="{{ route('cafe.edit', $c->id) }}">Editar</a></td>
                                    <td>
                                        <a href="#deleteModal-{{ $c->id }}" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $c->id }}" >Excluir</a>                           
                                        @include('cafe.modal')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{ $cafes->previousPageUrl() }}">Voltar</a></li>

                            @for($i = 1; $i <= $cafes->lastPage(); $i++)
                                <li class="page-item {{ $cafes->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $cafes->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            <li class="page-item"><a class="page-link" href="{{ $cafes->nextPageUrl() }}">Avançar</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
