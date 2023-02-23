<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RelatoriosExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($votos,$totais) {
        $this->votos = $votos;
        //tentar colocar os totais na importacao
        $this->totais = $totais;
    }
    public function collection()
    {
       return $this->votos;
    }
    public function headings():array { //declarando o tipo de retorno
        return [
            'Data', 
            'Principal', 
            'Ótimo',
            'Bom',
            'Regular',
            'Ruim',
            'Total',
        ];			
    }
    public function map($linha):array {
        $total = $linha->otimo+$linha->bom+$linha->regular+$linha->ruim;
        $otimo = $linha->otimo > 0 ? $otimo = number_format((($linha->otimo /$total)*100) , 1) : $otimo = $linha->otimo;
        $bom =  $linha->bom > 0 ? $bom = number_format((($linha->bom /$total)*100) , 1) : $bom = $linha->bom;
        $regular = $linha->regular > 0 ? $regular = number_format((($linha->regular /$total)*100) , 1) : $regular = $linha->regular;
        $ruim = $linha->ruim > 0 ? $ruim = number_format((($linha->ruim /$total)*100) , 1) : $ruim = $linha->ruim;
        $percentualTotal = $otimo + $bom + $regular + $ruim;
        return [ 
            [
                date('d/m/Y', strtotime($linha->data)),
                $linha->principal,
                $linha->otimo,
                $linha->bom,
                $linha->regular,
                $linha->ruim,
                $total,
            ],
            [
                '',
                'Percentual',
                $otimo.'%',
                $bom.'%',
                $regular.'%',
                $ruim.'%',
                $percentualTotal.'%',
            
            ]
        ];
    }
}
