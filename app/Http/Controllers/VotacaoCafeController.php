<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotacaoCafe;
use App\Models\Cafe;

class VotacaoCafeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataHoje = date("Y-m-d");
        
        $cafe = $this->show($dataHoje);
        $data = (isset($cafe)) ? implode("/",array_reverse(explode("-",$cafe->data))) : " ";
        $dado = (isset($cafe)) ? $data : "Votação encerrada" ;
        $title = "Café: $dado";

        return view('votacao.votacaoCafe',['title' => $title],['cafe' => $cafe]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($data)
    {
        $cafe = Cafe::all()->where('data', $data)->first();
        return $cafe;
    }

    public static function showId($id)
    {
        $votacao = VotacaoCafe::all()->where('cafe_id', $id)->first();
        return $votacao;
    }

    public function votarCafe(Request $request,$id)
    {
        if ($id > 0) {
            $voto = $request->voto;
            $votacao = $this->showId($id);
            switch ($voto) {
                case 'otimo':
                    $novoVoto = $votacao->otimo+1;
                    break;
                case 'bom':
                    $novoVoto = $votacao->bom+1;
                    break;
                case 'regular':
                    $novoVoto = $votacao->regular+1;
                    break;
                case 'ruim':
                    $novoVoto = $votacao->ruim+1;
                    break;
                default:
                    break;
            }

            $votos = VotacaoCafe::where('cafe_id', $id)->update([$voto => $novoVoto]);
            
            return redirect('/');
        } else {
            return redirect('/');
        }
        
    }
}
