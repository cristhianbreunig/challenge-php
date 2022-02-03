<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postagem as ModelPostagem;

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

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:120',
            'descricao' => 'required',
            'imagem' => 'required|image',
        ]);

        $post = new ModelPostagem();
        $post->titulo = $request->titulo;
        $post->descricao = $request->descricao;

        $imagem = $request->imagem->store('');
        $post->imagem = $imagem;
        $post->save();

        return redirect()->route('home');
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

        $post->update($request->all());

        return redirect()->route('home');
    }

    public function destroy($id)
    {
        ModelPostagem::destroy($id);

        return redirect()->route('home');
    }
}
