@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display: flex; width: 100%; justify-content: center; font-weight: bolder;">Criar postagem</div>

                <div class="card-body">

                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- <form id="post_form" enctype="multipart/form-data" method="post"> --}}
                    <form id="post_form" enctype="multipart/form-data" method="post" action="{{ route('posts.store') }}">
                        @csrf

                        {{-- <div class="row">
                            <div class="col-md-12">
                               <div class="alert alert-success d-none" id="msg_div">
                                       <span id="res_message"></span>
                                  </div>
                            </div>
                         </div> --}}

                        <label for="titulo"><b>Título:</b></label>
                        <br>
                        <input type="text" name="titulo" placeholder="Título" size="40" maxlength="120">
                        <br>
                        <br>

                        <label for="descricao"><b>Descrição:</b></label>
                        <br>
                        <textarea name="descricao" placeholder="Descrição" cols="40" rows="8"></textarea>
                        <br>
                        <br>

                        <input type="file" name="imagem">
                        <br>
                        <br>

                        <hr>
                        <button type="submit" id="send_form" class="btn btn-block btn-success col-6">Salvar</button>
                        <a href="{{ route('home') }}" class="btn btn-block btn-secondary col-6">Cancelar</a>
                    </form>

                    {{-- <script>
                        $('#post_form').on('submit',function(e){
                            e.preventDefault();

                            $('#send_form').html('Salvando..');

                            console.log($('#post_form').serialize());

                            let formData = new FormData();
                            formData.append('imagem', $('#imagem').get(0));

                            // console.log(formData);

                            $.ajax({
                                url: '/posts/store',
                                type: "POST",
                                data: formData,
                                success: function( response ) {
                                    console.log("respondeu ok");
                                    $('#send_form').html('Enviar');
                                    $('#res_message').show();
                                    $('#res_message').html(response.msg);
                                    $('#msg_div').removeClass('d-none');

                                    // document.getElementById("post-form").reset();

                                    setTimeout(function(){
                                        $('#res_message').hide();
                                        $('#msg_div').hide();
                                    },2000);
                                    console.log("ok");
                                }
                            });
                        });
                    </script> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
