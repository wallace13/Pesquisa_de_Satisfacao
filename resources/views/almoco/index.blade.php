@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Almoço
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <a href="{{route('almoco.create')}}" class="mr-3">Novo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table  text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Data</th>
                                <th scope="col">Salada</th>
                                <th scope="col">Complemento</th>
                                <th scope="col">Principal</th>
                                <th scope="col">Sobremesa</th>
                                <th scope="col">Suco</th>
                                <th colspan="2">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($almocos as $key => $a)
                                <tr>
                                    <th scope="row">{{ $a->id }}</th>
                                    <td>{{ date('d/m/Y', strtotime($a->data)) }}</td>
                                    <td>{{ $a->salada }}</td>
                                    <td>{{ $a->complemento }}</td>
                                    <td>{{ $a->principal }}</td>
                                    <td>{{ $a->sobremesa }}</td>
                                    <td>{{ $a->suco }}</td>
                                    <td><a href="{{ route('almoco.edit', $a->id) }}">Editar</a></td>
                                    <td>
                                        <a href="#deleteModal-{{ $a->id }}" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $a->id }}">Excluir</a>  
                                        @include('almoco.modal')  
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{ $almocos->previousPageUrl() }}">Voltar</a></li>

                            @for($i = 1; $i <= $almocos->lastPage(); $i++)
                                <li class="page-item {{ $almocos->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $almocos->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            <li class="page-item"><a class="page-link" href="{{ $almocos->nextPageUrl() }}">Avançar</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
