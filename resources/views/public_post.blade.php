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
                    <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>

                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Editar</a>

                    @if ($post->ativa == 'N')
                        <a href="{{ route('posts.publish', $post->id) }}" class="btn btn-primary">Publicar</a>
                    @endif

                    {{-- <a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger">Excluir</a> --}}

                    <form action="{{ route('posts.destroy', $post->id) }}"></form>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                @endauth

            </div>
        </div>
    </div>
</div>
@endsection
