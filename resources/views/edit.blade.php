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

                    <form method="post" id="form">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="titulo"><b>Título:</b></label>
                            <input type="text" name="titulo" placeholder="Título" size="40" maxlength="120" class="form-control" value="{{ $post->titulo }}">
                            <span class="text-danger error-text titulo_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="descricao"><b>Descrição:</b></label>
                            <textarea name="descricao" placeholder="Descrição" cols="40" rows="8" class="form-control">{{ $post->descricao }}</textarea>
                            <span class="text-danger error-text descricao_error"></span>
                        </div>

                        <hr>
                        <button type="submit" id="botao_formulario" class="btn btn-block btn-success col-6">Salvar</button>
                        <a href="{{ route('home') }}" class="btn btn-block btn-secondary col-6">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#form").on('submit', function(e){
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#botao_formulario").html("Salvando...");
            var form = this;

            $.ajax({
                url: "{{ route('posts.update', $post->id) }}",
                type: "POST",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend : function()
                {
                    $(form).find('span.error-text').text('');
                },
                success: function( response ) {
                    if (response.code == 0) {
                        $("#botao_formulario").html("Salvar");
                        $.each(response.error, function(campo, valor){
                            $(form).find('span.'+campo+'_error').text(valor[0]);
                        });
                    } else {
                        $(form)[0].reset();
                        alert(response.msg);
                        window.location = response.url;
                    }
                }
            })
        })
    })
</script>
@endsection
