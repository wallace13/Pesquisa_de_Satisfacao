<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('almoco.index')}}" class="nav-link">Almoço</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('cafe.index')}}" class="nav-link">Café</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('relatorioIndex')}}" class="nav-link">Relatorios</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('votacoes')}}" class="nav-link">Votações</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('sugestoes')}}" class="nav-link">Sugestões</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Balanços
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('mensal') }}">Mensal</a>
                            <a class="dropdown-item" href="{{route('comparativo') }}">Comparativo</a>
                            <a class="dropdown-item" href="{{route('anual') }}">Anual</a>
                        </div>
                    </li>
                    @if ( Auth::user()->nivelPermissao == 1)
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Administrativo
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('administrativo.index') }}">Funcionario</a>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ ucfirst(Auth::user()->name) }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (Route::has('password.request'))
                                <a class="dropdown-item" href="{{ route('password.request') }}">Alterar senha</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
