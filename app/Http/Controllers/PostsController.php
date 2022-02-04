<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Postagem as ModelPostagem;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function novo()
    {
        return view('novo');
    }

    // public function store(StorePostRequest $request)
    public function store(Request $request)
    {

        $validacao = \Validator::make($request->all(),[
            'titulo' => 'required|max:120',
            'descricao' => 'required|min:20',
            'imagem' => 'required|image',
        ],[
            'titulo.required' => 'Ops, é necessário informar o título!',
            'descricao.required' => 'Ops, é necessário informar a descrição!',
            'descricao.min' => 'Ops, é necessário informar pelo menos 20 caracteres na descrição!',
            'imagem.required' => 'Ops, é necessário enviar uma imagem!',
            'imagem.image' => 'Ops, somente imagens são aceitas!',
        ]);

        if (!$validacao->passes()){
            return response()->json([
                'code' => 0,
                'error' => $validacao->errors()->toArray(),
            ]);

        } else {

            $post = new ModelPostagem();
            $post->titulo = $request->titulo;
            $post->descricao = $request->descricao;

            $imagem = $request->file('imagem');
            $nome_imagem = time() . "_" . $imagem->getClientOriginalName();

            $request->imagem->storeAs('',$nome_imagem);

            $post->imagem = $nome_imagem;
            $post->save();

            return response()->json([
                'code' => 1,
                'msg' => 'Post salvo com sucesso!',
                'url' => route('home'),
            ], 200);
        }
    }

    public function publish($id)
    {
        $post = ModelPostagem::find($id);
        $post->ativa = "S";
        $post->save();

        return redirect()->route('home');
    }

    public function show($id)
    {
        if (!$post = ModelPostagem::find($id)){
            return redirect()->back();
        }

        return view('public_post', [
            'post' => $post
        ]);
    }

    public function edit($id)
    {
        if (!$post = ModelPostagem::find($id)){
            return redirect()->back();
        }

        return view('edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!$post = ModelPostagem::find($id)){
            return redirect()->back();
        }

        $validacao = \Validator::make($request->all(),[
            'titulo' => 'required|max:120',
            'descricao' => 'required|min:20'
        ],[
            'titulo.required' => 'Ops, é necessário informar o título!',
            'descricao.required' => 'Ops, é necessário informar a descrição!',
            'descricao.min' => 'Ops, é necessário informar pelo menos 20 caracteres na descrição!',
        ]);

        if (!$validacao->passes()){
            return response()->json([
                'code' => 0,
                'error' => $validacao->errors()->toArray(),
            ]);

        } else {

            $post->update($request->all());

            return response()->json([
                'code' => 1,
                'msg' => 'Post atualizado com sucesso!',
                'url' => route('home'),
            ], 200);
        }
    }

    public function destroy($id)
    {
        $post = ModelPostagem::find($id);
        $imagem = $post->imagem;

        if (!ModelPostagem::destroy($id)){
            return redirect()->back();
        }

        Storage::delete($imagem);

        return redirect()->route('home');
    }
}
