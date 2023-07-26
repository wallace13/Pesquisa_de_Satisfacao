@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            Sugestões dos Comensais
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <table class="table">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Data</th>
                                <th scope="col">Sugestão</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($sugestoes as $key => $s)
                                <tr>
                                    <th scope="row" class="text-center">{{ $s->id }}</th>
                                    <td class="text-center">{{ date('d/m/Y', strtotime($s->data)) }}</td>
                                    <td class="text-start">{{ $s->sugestao }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{ $sugestoes->previousPageUrl() }}">Voltar</a></li>

                            @for($i = 1; $i <= $sugestoes->lastPage(); $i++)
                                <li class="page-item {{ $sugestoes->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $sugestoes->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <li class="page-item"><a class="page-link" href="{{ $sugestoes->nextPageUrl() }}">Avançar</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
