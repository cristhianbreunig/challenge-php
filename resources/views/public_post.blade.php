@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #e3eeff">{{ $post->titulo }}</div>

                <div class="card-body">
                    <img src="/storage/{{ $post->imagem }}">

                    <br>
                    <p class="card-text">{{ $post->descricao }}</p>
                </div>

                @auth
                    <hr>
                    <div style="display: flex; flex-direction: row; flex-wrap: wrap; flex-flow: inherit; gap: 5px; margin-left: 5px;">
                        <a href="{{ route('home') }}" class="btn btn-secondary col-3">Voltar</a>

                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary col-3">Editar</a>

                        @if ($post->ativa == 'N')
                            <a href="{{ route('posts.publish', $post->id) }}" class="btn btn-primary col-3">Publicar</a>
                        @endif

                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger col-3">Excluir</button>
                        </form>

                        <br>
                    </div>
                @endauth

                @guest
                    <hr>
                    <div style="display: flex; flex-direction: row; flex-wrap: wrap; flex-flow: inherit; gap: 5px; margin-left: 5px;">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary col-3">Voltar</a>
                        <br>
                    </div>
                @endguest

            </div>
        </div>
    </div>
</div>
@endsection
