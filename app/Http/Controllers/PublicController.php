<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postagem as ModelPostagem;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $array['postagens'] = ModelPostagem::where('ativa', '=', 'S')->paginate(10);

        return view('public', $array);
    }

    public function postagem()
    {
        return view('public_post');
    }
}
