<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sugestao;
use Illuminate\Support\Facades\DB;

class SugestaoController extends Controller
{
    public function index()
    {
        $sugestoes = DB::table('sugestoes')->orderBy('id', 'DESC')->paginate(10);
        return view('sugestao.index', ['sugestoes' => $sugestoes]);
    }
    public function create()
    {
        $title = "Pesquisa de Satisfação";
        return view('sugestao.sugestao',['title' => $title]);
    }
    public function store(Request $request)
    {
        $sugestao = new Sugestao();
        $sugestao->data = date("Y-m-d");
        $sugestao->sugestao = $request->input('sugestao');
        $sugestao->save();
        $title = "Pesquisa de Satisfação";
        return redirect()->route('welcome',['title' => $title]);
    }
}
