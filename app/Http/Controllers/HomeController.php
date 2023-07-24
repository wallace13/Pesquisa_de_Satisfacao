<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Pesquisa de Satisfação";
        return view('welcome',['title' => $title]);
    }
    public function showDashboard()
    {
        return view('dashboard');
    }
    /*
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
        
        //return view('dashboard', ['almoco' => $almoco, 'cafe' => $cafe, 'votoA' => $votoA, 'votoB' => $votoB]);


        $data = [
            'almoco' => $almoco,
            'cafe' => $cafe,
            'votoA' => $votoA,
            'votoB' => $votoB,
        ];
    
        return Response::json($data);
    }*/
    public function dashboard()
    {
        $response = new StreamedResponse(function () {
            while (true) {
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

                $data = [
                    'almoco' => $almoco,
                    'cafe' => $cafe,
                    'votoA' => $votoA,
                    'votoB' => $votoB,
                ];

                echo "data: " . json_encode($data) . "\n\n";
                ob_flush();
                flush();
                sleep(5); // Defina o intervalo de atualização desejado aqui, por exemplo, 5 segundos.
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }

    public function showVotacao()
    {
        return view('votacoes.indexVotacoes');
    }

    public function votacao(Request $request)
    {
        $dataSelecionada = $request->input('data');

        $almoco = VotacaoAlmocoController::show($dataSelecionada);
        $cafe = VotacaoCafeController::show($dataSelecionada);

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
        
        return view('votacoes.votacoes', ['dataSeleciona' => $dataSelecionada ,'almoco' => $almoco, 'cafe' => $cafe, 'votoA' => $votoA, 'votoB' => $votoB]);
    }


}

