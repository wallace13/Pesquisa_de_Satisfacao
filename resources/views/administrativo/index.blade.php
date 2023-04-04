@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Funcionários
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <a href="{{ route('register') }}" class="mr-3">Novo</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Nivel de Permissão</th>
                                <th colspan="3" class="text-center" width="50">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($funcionarios as $key => $funcionario)
                                <tr>
                                    <th>{{ $funcionario->id }}</th>
                                    <td>{{ $funcionario->name }}</td>
                                    <td>{{ $funcionario->email }}</td>
                                    <td>{{ ($funcionario->nivelPermissao == 1) ? 'Gerente' : 'Funcionário' ;  }}</td>
                                    <td width="50"><a href="{{ route('administrativo.show', $funcionario->id) }}">@svg('feathericon-eye')</a></td>
                                    <td width="50"><a href="{{ route('administrativo.edit', $funcionario->id) }}">@svg('feathericon-edit')</a></td>
                                    <td width="50">
                                        <a href="#deleteModal-{{ $funcionario->id }}" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $funcionario->id }}">
                                            @svg('feathericon-trash-2')
                                        </a>  
                                        @include('administrativo.modal')  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{ $funcionarios->previousPageUrl() }}">Voltar</a></li>

                            @for($i = 1; $i <= $funcionarios->lastPage(); $i++)
                                <li class="page-item {{ $funcionarios->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $funcionarios->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            <li class="page-item"><a class="page-link" href="{{ $funcionarios->nextPageUrl() }}">Avançar</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
