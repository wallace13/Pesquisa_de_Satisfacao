<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BalancoController extends Controller
{
    public function balancoMensal()
    {
        $title = "Balanço Mensal";
        return view('balanco.mensal',['title' => $title]);
    }
    public function balancoComparativo()
    {
        $title = "Balanço Comparativo";
        return view('balanco.comparativo',['title' => $title]);
    }
    public function balancoAnual()
    {
        $title = "Balanço Anual";
        return view('balanco.anual',['title' => $title]);
    }
    public function grafico(Request $request)
    {
        if (isset($request->mes)) {
            $totais = RelatorioController::showTotais($request->tipo, $request->ano, $request->mes);
            $title = 'Balanço Mensal '.ucwords( $request->tipo ).' - '.$request->mes.'/'.$request->ano;
        } else {
            $totais = RelatorioController::showTotalAnual($request->tipo, $request->ano);
            $title = 'Balanço Anual '.ucwords( $request->tipo ).' - '.$request->ano;
        }
        
        return view('balanco.grafico', ['title' => $title, 'totais' => $totais,'grafico' => $request->grafico]);

    }
    public function graficoComparativo(Request $request)
    {
        $totais = RelatorioController::showTotais($request->tipo, $request->ano, $request->mes);
        $totais2 = RelatorioController::showTotais($request->tipo, $request->ano, $request->mes2);
        $title = 'Balanço Comparativo '.ucwords( $request->tipo ).' - '.$request->ano;
            
        return view('balanco.graficoComparativo', ['title' => $title, 'totais' => $totais, 'totais2' => $totais2,'grafico' => $request->grafico ,'mes' => $request->mes,'mes2' => $request->mes2]);
    }
}
