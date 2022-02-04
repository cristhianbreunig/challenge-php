@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="align-items: center;">
                <div class="card-header" style="width: 100%; display: flex; justify-content: center;">Postagens</div>

                <div class="card-body">
                    @forelse ($postagens as $post)
                        <br>
                        <div class="card" style="width: 18rem;">
                            <img src="/storage/{{ $post->imagem }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->titulo }}</h5>
                                <p class="card-text">{{ $post->descricao }}</p>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary col-12">Abrir postagem</a>
                            </div>
                        </div>
                    @empty
                        <div style="width: 19rem; font-size: larger;">
                            <b>Ops, nenhuma postagem encontrada...</b>
                        </div>
                    @endforelse
                </div>

                {!! $postagens->links() !!}

            </div>
        </div>
    </div>
</div>
@endsection
