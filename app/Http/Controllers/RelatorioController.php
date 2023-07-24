<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cafe;
use App\Models\VotacaoCafe;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RelatoriosExport;
use PDF;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('relatorio.index');

    }
    public function detalhe(Request $request)
    {
        if (isset($request)) {
            $votos = $this->showDetalhe($request->tipo, $request->ano, $request->mes);

            switch ($request->tipo) {
                case 'almoco': $title = 'Relatório do Almoço';
                    break;
                case 'cafe': $title = 'Relatório do Café';
                    break;
                case 'global': $title = 'Relatório Global';
                    break;
                default:
                    $title = null;
                    break;
            }

            $dados = collect(['tipo'=>$request->tipo, 'ano'=>$request->ano, 'mes'=>$request->mes]);
            
            return view('relatorio.detalhe', ['votos' => $votos, 'title' => $title, 'dados'=>$dados]);
        } else {
            return view('relatorio.index');
        }
    }
    public function showDetalhe($tipo,$ano,$mes){
        $votos = null;
        switch ($tipo) {
            case 'almoco':
                $votos = DB::table('votacaoalmocos')
                    ->join('almocos', 'almocos.id', '=', 'votacaoalmocos.almoco_id')
                    ->select('almocos.*', 'votacaoalmocos.*')
                    ->whereMonth('data', $mes)
                    ->whereYear('data', $ano)
                    ->orderBy('data', 'ASC')
                    ->get();
                break;
            case 'cafe':
                $votos = DB::table('votacaocafes')
                    ->join('cafes', 'cafes.id', '=', 'votacaocafes.cafe_id')
                    ->select('cafes.*', 'votacaocafes.*')
                    ->whereMonth('data', $mes)
                    ->whereYear('data', $ano)
                    ->orderBy('data', 'ASC')
                    ->get();
                break;
            case 'global':
                $votosAlmoco = DB::table('votacaoalmocos')
                    ->join('almocos', 'almocos.id', '=', 'votacaoalmocos.almoco_id')
                    ->select('almocos.*', 'votacaoalmocos.*')
                    ->whereMonth('data', $mes)
                    ->whereYear('data', $ano)
                    ->orderBy('data', 'ASC')
                    ->get();
                $votosCafe = DB::table('votacaocafes')
                    ->join('cafes', 'cafes.id', '=', 'votacaocafes.cafe_id')
                    ->select('cafes.*', 'votacaocafes.*')
                    ->whereMonth('data', $mes)
                    ->whereYear('data', $ano)
                    ->orderBy('data', 'ASC')
                    ->get();
                    $votos = $votosAlmoco->merge($votosCafe);
                break;
        }
        return $votos;
    }
    public static function showTotais($tipo,$ano,$mes){
        $totais = null;
        switch ($tipo) {
            case 'almoco':
                $totais = DB::table('votacaoalmocos')
                    ->join('almocos', 'almocos.id', '=', 'votacaoalmocos.almoco_id')
                    ->select(DB::raw('sum(votacaoalmocos.otimo) AS otimos,sum(votacaoalmocos.bom) AS bons,sum(votacaoalmocos.regular) AS regulares,sum(votacaoalmocos.ruim) AS ruins'))
                    ->whereMonth('data', $mes)
                    ->whereYear('data', $ano)
                    ->get();
                break;
            case 'cafe':
                $totais = DB::table('votacaocafes')
                    ->join('cafes', 'cafes.id', '=', 'votacaocafes.cafe_id')
                    ->select(DB::raw('sum(votacaocafes.otimo) AS otimos ,sum(votacaocafes.bom) AS bons,sum(votacaocafes.regular) AS regulares,sum(votacaocafes.ruim) AS ruins'))
                    ->whereMonth('data', $mes)
                    ->whereYear('data', $ano)
                    ->get();
                break;
            case 'global':
                $votosAlmoco = DB::table('votacaoalmocos')
                ->join('almocos', 'almocos.id', '=', 'votacaoalmocos.almoco_id')
                ->select(DB::raw('sum(votacaoalmocos.otimo) AS aotimos,sum(votacaoalmocos.bom) AS abons,sum(votacaoalmocos.regular) AS aregulares,sum(votacaoalmocos.ruim) AS aruins'))
                ->whereMonth('data', $mes)
                ->whereYear('data', $ano)
                ->get();
                $votosCafe = DB::table('votacaocafes')
                ->join('cafes', 'cafes.id', '=', 'votacaocafes.cafe_id')
                ->select(DB::raw('sum(votacaocafes.otimo) AS cotimos ,sum(votacaocafes.bom) AS cbons,sum(votacaocafes.regular) AS cregulares,sum(votacaocafes.ruim) AS cruins'))
                ->whereMonth('data', $mes)
                ->whereYear('data', $ano)
                ->get();
                    $totais = $votosAlmoco->merge($votosCafe);
                break;
        }
        return $totais;
    }
    public static function showTotalAnual($tipo,$ano){
        $totais = null;
        switch ($tipo) {
            case 'almoco':
                $totais = DB::table('votacaoalmocos')
                    ->join('almocos', 'almocos.id', '=', 'votacaoalmocos.almoco_id')
                    ->select(DB::raw('sum(votacaoalmocos.otimo) AS otimos,sum(votacaoalmocos.bom) AS bons,sum(votacaoalmocos.regular) AS regulares,sum(votacaoalmocos.ruim) AS ruins'))
                    ->whereYear('data', $ano)
                    ->get();
                break;
            case 'cafe':
                $totais = DB::table('votacaocafes')
                    ->join('cafes', 'cafes.id', '=', 'votacaocafes.cafe_id')
                    ->select(DB::raw('sum(votacaocafes.otimo) AS otimos ,sum(votacaocafes.bom) AS bons,sum(votacaocafes.regular) AS regulares,sum(votacaocafes.ruim) AS ruins'))
                    ->whereYear('data', $ano)
                    ->get();
                break;
            case 'global':
                $votosAlmoco = DB::table('votacaoalmocos')
                ->join('almocos', 'almocos.id', '=', 'votacaoalmocos.almoco_id')
                ->select(DB::raw('sum(votacaoalmocos.otimo) AS aotimos,sum(votacaoalmocos.bom) AS abons,sum(votacaoalmocos.regular) AS aregulares,sum(votacaoalmocos.ruim) AS aruins'))
                ->whereYear('data', $ano)
                ->get();
                $votosCafe = DB::table('votacaocafes')
                ->join('cafes', 'cafes.id', '=', 'votacaocafes.cafe_id')
                ->select(DB::raw('sum(votacaocafes.otimo) AS cotimos ,sum(votacaocafes.bom) AS cbons,sum(votacaocafes.regular) AS cregulares,sum(votacaocafes.ruim) AS cruins'))
                ->whereYear('data', $ano)
                ->get();
                    $totais = $votosAlmoco->merge($votosCafe);
                break;
        }
        return $totais;
    }

    public function exportacao($extensao,$tipo,$ano,$mes,$title) {
        $votos = $this->showDetalhe($tipo,$ano,$mes);
        $totais = $this->showTotais($tipo,$ano,$mes);

        $nome = 'Relatorio'.ucwords( $tipo ).'_'.$mes.'_'.$ano;
        if(in_array($extensao, ['xlsx', 'csv', 'pdf'])) {
            return Excel::download(new RelatoriosExport($votos,$totais), '.'.$nome.'.'.$extensao);
        }
        
        return redirect()->route('detalhe');
    }
    public function exportar($tipo,$ano,$mes,$title) {
        $votos = $this->showDetalhe($tipo,$ano,$mes);
        $totais = $this->showTotais($tipo,$ano,$mes);
        $pdf = PDF::loadView('Relatorio.pdf', ['votos' => $votos, 'totais' => $totais, 'title' => $title, 'mes' =>$mes, 'ano' =>$ano]);

        $pdf->setPaper('a4', 'portrait');
        //tipo de papel: a4, letter
        //orientação: landscape (paisagem), portrait (retrato)
        //return $pdf->download('Relatorio'.ucwords( $tipo ).'_'.$mes.'_'.$ano.'.pdf');
        return $pdf->stream('Relatorio'.ucwords( $tipo ).'_'.$mes.'_'.$ano.'.pdf');
        
    }
}
