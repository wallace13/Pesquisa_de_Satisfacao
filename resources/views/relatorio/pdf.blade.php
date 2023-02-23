<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style>
            .page-break {
                page-break-after: always;
            }

            .titulo {
                border:1px;
                background-color:#c2c2c2;
                text-align:center;
                width:100%;
                text-transform:uppercase;
                font-weight:bold;
                margin-bottom:25px;
            }

            table{
                text-align:center;
            }
            #percentual{
                text-align: right;
            }
            .total{
                margin-top: 20px;
            }
        </style>
    </head>

    <body>

        <div class="titulo">{{ $title }} - {{ $mes }}/{{ $ano }}</div>

        <table style="width:100%" border="1" >
            <thead class="titulo">
                <tr>
                    <th>Data</th>
                    <th>Principal</th>
                    <th>Ótimo</th>
                    <th>Bom</th>
                    <th>Regular</th>
                    <th>Ruim</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($votos as $key => $c)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($c->data)) }}</td>
                        <td>{{ $c->principal}}</td>
                        <td>{{ $c->otimo}}</td>
                        <td>{{ $c->bom}}</td>
                        <td>{{ $c->regular}}</td>
                        <td>{{ $c->ruim  }}</td>
                        @php
                            $total = $c->otimo + $c->bom + $c->regular + $c->ruim;
                        @endphp
                        <td>{{ $total}}</td>
                    </tr>
                    <tr class="titulo">
                        @php
                            $otimo = $c->otimo > 0 ? $otimo = number_format((($c->otimo /$total)*100) , 1) : $otimo = $c->otimo;
                            $bom =  $c->bom > 0 ? $bom = number_format((($c->bom /$total)*100) , 1) : $bom = $c->bom;
                            $regular = $c->regular > 0 ? $regular = number_format((($c->regular /$total)*100) , 1) : $regular = $c->regular;
                            $ruim = $c->ruim > 0 ? $ruim = number_format((($c->ruim /$total)*100) , 1) : $ruim = $c->ruim;
                        @endphp
                        <td colspan="2" id="percentual">Percentual</td>
                        <td>{{ $otimo.'%' }}</td>
                        <td>{{ $bom.'%' }}</td>
                        <td>{{ $regular.'%' }}</td>
                        <td>{{ $ruim.'%' }}</td>
                        @php
                            $percentualTotal = $otimo + $bom + $regular + $ruim;
                        @endphp
                        <td>{{ $percentualTotal.'%'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
        <table style="width:100%" border="1" class="total">
            <thead class="titulo">
                <tr>
                    <th>Descrição</th>
                    <th>Total</th>
                    <th>%</th>
                </tr>
            </thead>
            @php
                if (isset($totais[0]->otimos) && isset($totais[0]->bons) && isset($totais[0]->regulares) && isset($totais[0]->ruins)) {
                    $otimo = $totais[0]->otimos;
                    $bom = $totais[0]->bons;
                    $regular = $totais[0]->regulares;
                    $ruim = $totais[0]->ruins;
                } else if(isset( $totais[0]->aotimos) && isset($totais[0]->abons) && isset($totais[0]->aregulares) && isset($totais[0]->aruins)){
                    $otimo = $totais[0]->aotimos+$totais[1]->cotimos;
                    $bom = $totais[0]->abons+$totais[1]->cbons;
                    $regular = $totais[0]->aregulares+$totais[1]->cregulares;
                    $ruim = $totais[0]->aruins+$totais[1]->cruins;
                }else{
                    $otimo = 0;
                    $bom = 0;
                    $regular = 0;
                    $ruim = 0;
                }
                $Ptotal = $otimo + $bom + $regular + $ruim;

                $Potimo = $otimo > 0 ? $Potimo = number_format((($otimo /$Ptotal)*100) , 1) : $Potimo = $otimo;
                $Pbom =  $bom > 0 ? $Pbom = number_format((($bom /$Ptotal)*100) , 1) : $Pbom = $bom;
                $Pregular = $regular > 0 ? $Pregular = number_format((($regular /$Ptotal)*100) , 1) : $Pregular = $regular;
                $Pruim = $ruim > 0 ? $Pruim = number_format((($ruim /$Ptotal)*100) , 1) : $Pruim = $ruim;

                $TPer = $Potimo + $Pbom + $Pregular + $Pruim;
           @endphp
            <tbody>
                <tr>
                    <td>Ótimo</td>
                    <td>{{ $otimo }}</td>
                    <td>{{ $Potimo.'%' }}</td>
                </tr>
                <tr>
                    <td>Bom</td>
                    <td>{{ $bom }}</td>
                    <td>{{ $Pbom.'%' }}</td>
                </tr>
                <tr>
                    <td>Regular</td>
                    <td>{{ $regular }}</td>
                    <td>{{ $Pregular.'%' }}</td>
                </tr>
                <tr>
                    <td>Ruim </td>
                    <td>{{ $ruim }}</td>
                    <td>{{ $Pruim.'%' }}</td>
                </tr>
                <tr class="titulo">
                    <td>Total </td>
                    <td>{{ $Ptotal }}</td>
                    <td>{{ $TPer.'%' }}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>