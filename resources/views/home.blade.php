@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Postagens</div>

                <button type="button" class="btn btn-labeled btn-success col-2 m-2" onclick="window.location='{{ URL::to('posts/novo') }}'">
                    + Nova
                </button>

                <div class="card-body">
                    @foreach ($postagens as $post)
                        <br>
                        <div class="card" style="width: 18rem;">
                            <img src="/storage/{{ $post->imagem }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->titulo }}</h5>
                                <p class="card-text">{{ $post->descricao }}</p>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Abrir postagem</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {!! $postagens->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
