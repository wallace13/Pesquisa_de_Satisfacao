<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Pesquisa de Satisfação";
        return view('welcome',['title' => $title]);
    }
    public function dashboard()
    {
        $dataHoje = date("Y-m-d");
               
        $almoco = VotacaoAlmocoController::show($dataHoje);
        $cafe = VotacaoCafeController::show($dataHoje);

        if (isset($almoco->id)) {
            $idAlmoco = $almoco->id;
        } else {
            $idAlmoco = 0;
        }

        if (isset($cafe->id)) {
            $idCafe = $cafe->id;
        } else {
            $idCafe = 0;
        }
        
        $votoA = VotacaoAlmocoController::showId($idAlmoco);
        $votoB = VotacaoCafeController::showId($idCafe);
        
        return view('dashboard', ['almoco' => $almoco, 'cafe' => $cafe, 'votoA' => $votoA, 'votoB' => $votoB]);
    }
}
