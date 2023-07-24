@extends('layouts.app')
@section('content')
    <div class="d-flex flex-column mb-3">
        <div class="p-2">
            <h4 class="text-center fs-2">O que você deseja fazer?</h4>
        </div>
        <div class="p-2 row">
            <div class="img-container">
                <a href="votacaoCafe">
                    <div class="img-zoom-container">
                        <img src="{{ asset('img/cafe.jpg') }}" alt="Café" id="imagemCafe">
                    </div>
                    <div class="img-text-overlay">
                        <span class="img-text">Votação do Café</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="p-2 row">
            <div class="img-container">
                <a href="votacaoAlmoco">
                    <div class="img-zoom-container">
                        <img src="{{ asset('img/almoco.jpg') }}" alt="Almoço" id="imagemAlmoco">
                    </div>
                    <div class="img-text-overlay">
                        <span class="img-text">Votação do Almoço</span>
                    </div>
                </a>
            </div>
        </div>        
    </div>
    <script>
        // Adiciona uma classe 'active' ao tocar na imagem em dispositivos móveis
        const imgContainers = document.querySelectorAll('.img-container');
        imgContainers.forEach(container => {
            container.addEventListener('touchstart', () => {
                container.classList.add('active');
            });

            container.addEventListener('touchend', () => {
                container.classList.remove('active');
            });
        });
    </script>

@endsection
