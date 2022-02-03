@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div
                    class="card-header"
                    style="display: flex; width: 100%; justify-content: center; font-weight: bolder;"
                >Editar postagem</div>

                <div class="card-body">

                    <form action="{{ route('posts.update', $post->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="titulo"><b>Título:</b></label>
                        <br>
                        <input type="text" name="titulo" placeholder="Título" size="40" maxlength="120" value="{{ $post->titulo }}">
                        <br>
                        <br>

                        <label for="descricao"><b>Descrição:</b></label>
                        <br>
                        <textarea name="descricao" placeholder="Descrição" cols="40" rows="8">{{ $post->descricao }}</textarea>
                        <br>

                        <button type="submit" id="send_form" class="btn btn-block btn-success">Salvar</button>
                        <a href="{{ route('home') }}" class="btn btn-block btn-secondary">Cancelar</a>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
