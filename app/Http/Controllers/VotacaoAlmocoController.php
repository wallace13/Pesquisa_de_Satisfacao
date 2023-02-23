<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotacaoAlmoco;
use App\Models\Almoco;

class VotacaoAlmocoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataHoje = date("Y-m-d");
        
       
        $almoco = $this->show($dataHoje);
        $data = (isset($almoco)) ? implode("/",array_reverse(explode("-",$almoco->data))) : " ";
        $dado = (isset($almoco)) ? $data : "Votação encerrada" ;
        $title = "Almoço: $dado";

        return view('votacao.votacaoAlmoco',['title' => $title],['almoco' => $almoco]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($data)
    {
        $almoco = Almoco::all()->where('data', $data)->first();
        return $almoco;
    }

    public static function showId($id)
    {
        $votacao = VotacaoAlmoco::all()->where('almoco_id', $id)->first();
        return $votacao;
    }

    public function votarAlmoco(Request $request,$id)
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

            $votos = VotacaoAlmoco::where('almoco_id', $id)->update([$voto => $novoVoto]);
            
            return redirect('/');
        } else {
            return redirect('/');
        }
        
        
    }
}
