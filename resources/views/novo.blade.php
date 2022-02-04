@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display: flex; width: 100%; justify-content: center; font-weight: bolder;">Criar postagem</div>

                <div class="card-body">

                    {{-- @include('includes.alerts') --}}

                    <form enctype="multipart/form-data" id="form">
                        @csrf

                         <div class="form-group">
                             <label for="titulo">Título:</label>
                             <input type="text" name="titulo" placeholder="Título" class="form-control" value="{{ old('titulo') }}">
                             <span class="text-danger error-text titulo_error"></span>
                            </div>

                        <div class="form-group">
                            <label for="descricao"><b>Descrição:</b></label>
                            <textarea name="descricao" placeholder="Descrição" class="form-control" cols="40" rows="8">{{ old('descricao') }}</textarea>
                            <span class="text-danger error-text descricao_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="imagem">Imagem:</label>
                            <input type="file" name="imagem">
                            <span class="text-danger error-text imagem_error"></span>
                        </div>

                        <hr>
                        <button type="submit" id="botao_formulario" class="btn btn-block btn-primary col-6">Salvar</button>
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
                url: "{{ route('posts.store') }}",
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
