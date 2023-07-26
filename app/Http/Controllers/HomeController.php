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
        return view('welcome', ['title' => $title]);
    }

    public function showDashboard()
    {
        return view('dashboard');
    }

    public function dashboard()
    {
        $response = new StreamedResponse(function () {
            while (true) {
                $data = $this->getData();
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
        $data = $this->getData($dataSelecionada);
        
        return view('votacoes.votacoes', [
            'dataSeleciona' => $dataSelecionada,
            'almoco' => $data['almoco'],
            'cafe' => $data['cafe'],
            'votoA' => $data['votoA'],
            'votoB' => $data['votoB']
        ]);
    }

    private function getData($dataSelecionada = null)
    {
        $dataHoje = date("Y-m-d");

        $almoco = app(VotacaoAlmocoController::class)->show($dataSelecionada ?? $dataHoje);
        $cafe = app(VotacaoCafeController::class)->show($dataSelecionada ?? $dataHoje);

        $idAlmoco = isset($almoco->id) ? $almoco->id : 0;
        $idCafe = isset($cafe->id) ? $cafe->id : 0;

        $votoA = app(VotacaoAlmocoController::class)->showId($idAlmoco);
        $votoB = app(VotacaoCafeController::class)->showId($idCafe);

        return [
            'almoco' => $almoco,
            'cafe' => $cafe,
            'votoA' => $votoA,
            'votoB' => $votoB,
        ];
    }
}
