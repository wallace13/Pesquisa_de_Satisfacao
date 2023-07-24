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
        set_time_limit(300);
        $response = new StreamedResponse(function () {
            while (true) {
                $data = $this->getVotacoesData();

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

    private function getVotacoesData()
    {
        $dataHoje = date("Y-m-d");
        $almoco = VotacaoAlmocoController::show($dataHoje);
        $cafe = VotacaoCafeController::show($dataHoje);

        $idAlmoco = isset($almoco->id) ? $almoco->id : 0;
        $idCafe = isset($cafe->id) ? $cafe->id : 0;

        $votoA = VotacaoAlmocoController::showId($idAlmoco);
        $votoB = VotacaoCafeController::showId($idCafe);

        return [
            'almoco' => $almoco,
            'cafe' => $cafe,
            'votoA' => $votoA,
            'votoB' => $votoB,
        ];
    }

    public function showVotacao()
    {
        return view('votacoes.indexVotacoes');
    }

    public function votacao(Request $request)
    {
        $dataSelecionada = $request->input('data');
        $data = $this->getVotacoesData();

        return view('votacoes.votacoes', [
            'dataSeleciona' => $dataSelecionada,
            'almoco' => $data['almoco'],
            'cafe' => $data['cafe'],
            'votoA' => $data['votoA'],
            'votoB' => $data['votoB'],
        ]);
    }
}
