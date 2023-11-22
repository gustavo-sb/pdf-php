@extends('layouts.temp')
@section('css')
@include('impressoes.css')
<style>
    @page {
        size: 210mm 297mm;
        margin: 0px;
        margin-bottom: 0px;
        margin-left: 0px;
        margin-right: 0px
    }

    table {
        max-width: 100%;
        width: 100%;
        margin: 0px;
    }

    .nao_quebra {
        page-break-inside: avoid;
    }

    html,
    body {
        margin-left: 0px !important;
        margin-right: 0px !important;
        height: 250mm;
        print-color-adjust: exact;
    }

    .border_bottom2 {
        border-bottom: 2px black solid
    }

    .quebra-pagina {
        clear: both !important;
        page-break-after: always !important;
    }

    .blue {
        background-color: #192a7c;
    }

    .fonte {
        font-size: 180%
    }
</style>
<style>
    @media print {
        .div1 {
            width: 100% !important;
        }
    }

    .sua-div {
        background-color: #192a7c;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }

    .gold {
        background-color: gold !important;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }

    .gray {
        background-color: gold !important;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }

    @media print {
        .sua-div {
            background-color: #192a7c;
            -webkit-print-color-adjust: exact;
            /* Para navegadores Webkit (Chrome, Safari) */
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }

        .gold {
            background-color: gold !important;
            -webkit-print-color-adjust: exact;
            /* Para navegadores Webkit (Chrome, Safari) */
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }

        .gray {
            background-color: gray;
            -webkit-print-color-adjust: exact;
            /* Para navegadores Webkit (Chrome, Safari) */
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }
    }

    .top {
        position: fixed;
        top: 128px !important;
        width: 262mm !important;
        left: 15px;
        right: 15px;

    }

    .table {
        position: relative;
        top: 0px !important;
        bottom: -70px !important;
    }

    .teste {
        z-index: -2;
    }

    .footer {
        position: fixed;
        top: 370mm !important;
        /* width: 265mm !important; */
        /* transform: rotate(90deg);
            transform-origin: left bottom; */
        left: 0px;
        z-index: -1;
    }

    .header {
        top: -60px;
        padding-bottom: 0px !important;
    }

    .footer2 {
        top: -460px;
        padding-bottom: 0px !important;
    }

    .teste2 {
        top: -40px;
    }

    .teste3 {
        top: -200px;
    }

    .rodape {
        padding: 10px;
        position: absolute;
        bottom: 20;
        left: -30mm;
        /* transform: rotate(90deg);
            transform-origin: right bottom; */
        white-space: nowrap;
        /* Impede que o texto do rodapé quebre em várias linhas */
    }
</style>
@endsection
@section('content')
<div class="row justify-content-center">
    <button id="imprimir" type="button" class="btn btn-primary btn-sm my-4 d-print-none"
        onclick="window.print();">Imprimir</button>
</div>

<?php
        $obs2 = explode('|', $venda->VENDAS_OBS_CONTRATO);
        $observacoes = json_decode($venda->VENDAS_CARACTERISTICAS);
        $campo6 = '';
        $campo2 = '';
        $campo7 = '';
        $campo8 = '';
        $campo9 = '';
        $campo10 = '';
        
        if($observacoes){
            foreach ($observacoes as $key => $observacao) {
                if ($observacao->campo == '2. Considerações Importantes:') {
                    $campo2 = $observacao->valor;
                }
                if ($observacao->campo == '6. Pagamento:') {
                    $campo6 = $observacao->valor;
                }
                if ($observacao->campo == '7. Impostos:') {
                    $campo7 = $observacao->valor;
                }
                if ($observacao->campo == '8. Condições de Entrega:') {
                    $campo8 = $observacao->valor;
                }
                if ($observacao->campo == '9. Taxas em caso de cancelamento:') {
                    $campo9 = $observacao->valor;
                }
                if ($observacao->campo == '10. Garantia:') {
                    $campo10 = $observacao->valor;
                }
            }
        }

        $campo = explode('|', $campo2);
        $campo_6 = explode('|', $campo6);
        $campo_7 = explode('|', $campo7);
        $campo_8 = explode('|', $campo8);
        $campo_9 = explode('|', $campo9);
        $campo_10 = explode('|', $campo10);

        $pg = 1;
    ?>
@if ($venda->produtos->where('VENDAS_PRODUTOS_VALOR_UNITARIO', '==', 0)->count())
<table class="py_15 border-none">
    <th class="py_15 border-none">
        <div class="text-center font_180" style="color:red;">Aviso!</div>
        <div class="text-center font_180">Existe {{ $venda->produtos->where('VENDAS_PRODUTOS_VALOR_UNITARIO', '==',
            0)->count() == 1 ? $venda->produtos->where('VENDAS_PRODUTOS_VALOR_UNITARIO', '==', 0)->count().' Item' :
            $venda->produtos->where('VENDAS_PRODUTOS_VALOR_UNITARIO', '==', 0)->count().' Itens' }} com o Valor Igual a
            0</div>
        <div class="text-center font_125 negrito">Verificar Itens do Contrato</div>
        @foreach ($venda->produtos->where('VENDAS_PRODUTOS_VALOR_UNITARIO', '==', 0) as $item)
        <span class="text-center font_125 negrito" style="color:red;">{{ $loop->first ? '( ' : '' }} {{
            $item->produto->PRODUTOS_IDENTIFICACAO }} {{ $loop->last ? ' )' : ', ' }}</span>
        @endforeach
    </th>
</table>
@else
<div class="div1">
    <table class="border-none m-0 p-0 quebra-pagina">
        <tr class="p-0 pl-4 m-0">
            <th class="border-none p-0 pr-4 pl-4 m-0 fonte" style="max-height: 180px !important;" colspan="7">
                <div class="row" style="height: 160px !important">
                    <div class="col-6 teste2">
                        <div class="text-left pt-10"><br>
                            <div class="m-0 small text-body">Cód. R066-rev.02</div>
                            <h1 class="h4 pb-0">
                                <div class="m-0 h1 pb-0" style="font-size: 16pt !important"><b>PROPOSTA COMERCIAL</b>
                                </div>
                                <div class="m-0 h4 pt-0"><b>G: {{ $venda->VENDAS_NUMERO_CONTROLE }} &nbsp; {{
                                        ($venda->VENDAS_VERSAO_REVISAO) }}</b></div>
                            </h1>
                            <div class="m-0"><b>São Paulo, {{ $semana }}, {{ $dia }} de {{ $mes }} de {{ $ano }}</b>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-right header p-0 m-0"
                        style="float:left !important; z-index: -10 !important;">
                        <img style="height: 19rem; z-index: -10 !important;" class="mb-0"
                            src="{{ \App\Helpers\General::MakeImageURL('layouts.temp', $estab->logo_path()) }}">
                    </div>
                </div>
                <div class="clearfix border_bottom2"></div>
            </th>
        </tr>
        <tr>
            <th class="border-none p-0 fonte" colspan="7">
                <div class="row p-0 pl-4 pr-4">
                    <div class="col-12 p-0" style="padding-left: 110px; height: 249mm">
                        <div class="card-body pl-3 pr-3 pt-2 pb-2">
                            <div class="row justify-content-between align-items-top mb-5"
                                style="height: 240px !important">
                                <div class="col-4 text-left">
                                    <h3 class="h3 m-0"><b>Informações do Cliente:</b></h3>
                                    <div>{{ $venda->cliente->CLIENTES_NOME_ABREVIADO }}</div>
                                    <div class="mb-3">{{ $venda->cliente->pessoa->PESSOA_CNPJ }}</div>
                                    <div class="h3 mb-3"><u><b>Projeto: {{ ($venda->VENDAS_PROJETOS) }}</b> - {{
                                            $venda->projeto ? $venda->projeto->PROJETOS_CIDADE : '' }}/{{
                                            $venda->projeto ? $venda->projeto->PROJETOS_ESTADO : '' }}</u></div>
                                    <div><b>A/C:</b> {{ count($contato) > 0 ? $contato[0] : '' }}</div>
                                    <div>{{ count($contato) > 1 ? $contato[1] : '' }}</div>
                                    <div>{{ count($contato) > 2 ? $contato[2] : '' }}</div>
                                </div>
                                <div class="col-8 text-right mb-5 mb-sm-0" style="float:left !important">
                                    <h2 class="h2 m-0"><b>{{ $estabelecimento->ESTABELECIMENTOS_DESCRICAO }}</b></h2>
                                    <address class="m-0 medium">{{ $estabelecimento->ESTABELECIMENTOS_CNPJ }}</address>
                                    <address class="m-0 medium">{{ $estabelecimento->ESTABELECIMENTOS_ENDERECO }}, {{
                                        $estabelecimento->ESTABELECIMENTOS_NUMERO }} - {{
                                        $estabelecimento->ESTABELECIMENTOS_COMPLEMENTO }}</address>
                                    <address class="m-0 medium">{{ $estabelecimento->ESTABELECIMENTOS_BAIRRO }}, {{
                                        $estabelecimento->ESTABELECIMENTOS_CIDADE }}/{{
                                        $estabelecimento->ESTABELECIMENTOS_UF }}</address>
                                    <address class="m-0 medium">CEP: {{ $estabelecimento->ESTABELECIMENTOS_CEP }}
                                    </address>
                                    <address class="m-0 medium">Telefone: {{ $estabelecimento->ESTABELECIMENTOS_TELEFONE
                                        }}</address>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row justify-content-between mb-5">
                                <div class="col-12 text-left">
                                    <div class="text-left badge badge-primary col-12 blue p-2 sua-div">
                                        <div class="m-0 white medium h4">Para informações e esclarecimentos comerciais,
                                            favor entrar em contato com:</div>
                                        <div class="m-0 white medium h4">{{ $venda->vendedor ? ($venda->vendedor->pessoa
                                            ? $venda->vendedor->pessoa->cliente->CLIENTES_FANTASIA : '') : '' }}</div>
                                        <div class="m-0 white medium h4">{{ $venda->vendedor ? ($venda->vendedor->pessoa
                                            ? ($venda->vendedor->pessoa->cliente ?
                                            $venda->vendedor->pessoa->cliente->CLIENTES_TELEFONE : '') : '') : '' }} -
                                            {{ $venda->vendedor ? ($venda->vendedor->pessoa ?
                                            ($venda->vendedor->pessoa->cliente ?
                                            $venda->vendedor->pessoa->cliente->CLIENTES_EMAIL : '') : '') : '' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row justify-content-between mb-5">
                                <div class="col-12 text-left">
                                    <div>
                                        Prezados Senhores,<br>
                                        Apresentamos abaixo, a oferta solicitada e também as soluções do GRUPO xxxxx para
                                        sua instalação.<br>
                                        Contamos com a mais completa linha de quadros e painéis de baixa tensão,
                                        cubículos de média tensão, cabines primárias, SKIDSOLAR, barramentos blindados
                                        de baixa e média tensão, sistema de medição eletrônica centralizada, painéis de
                                        média tensão isolados em SF6 e equipamentos para SMARTGRID, além de sensores de
                                        monitoramento de temperatura e vibração 100% sustentáveis, para e manutenção
                                        preventiva, preditiva e corretiva, todas conectadas com as mais modernas
                                        soluções da indústria 4.0.
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix border_bottom2 mb-5 mt-5"></div>
                            <div class="row justify-content-between mb-2 mt-5">
                                <div class="col-12 p-0">
                                    <table class="border-none" style="width: 97%" class="text-left">
                                        <tr>
                                            <th class="border-none p-0 fonte" width="50px">1.</th>
                                            <th class="border-none p-0 fonte text-left" colspan="12" width="450px">
                                                Consciência Ambiental e com a vida</th>
                                            <th class="border-none p-0 fonte" width="50px">6.</th>
                                            <th class="border-none p-0 fonte text-left" colspan="12" width="400px">
                                                Pagamento</th>
                                        </tr>
                                        <tr>
                                            <th class="border-none p-0 fonte" width="50px">2.</th>
                                            <th class="border-none p-0 fonte text-left" colspan="12" width="450px">
                                                Considerações importantes</th>
                                            <th class="border-none p-0 fonte" width="50px">7.</th>
                                            <th class="border-none p-0 fonte text-left" colspan="12" width="400px">
                                                Impostos</th>
                                        </tr>
                                        <tr>
                                            <th class="border-none p-0 fonte" width="50px">3.</th>
                                            <th class="border-none p-0 fonte text-left" colspan="12" width="450px">
                                                Preços</th>
                                            <th class="border-none p-0 fonte" width="50px">8.</th>
                                            <th class="border-none p-0 fonte text-left" colspan="12" width="400px">
                                                Condições de entrega</th>
                                        </tr>
                                        <tr>
                                            <th class="border-none p-0 fonte" width="50px">4.</th>
                                            <th class="border-none p-0 fonte text-left" colspan="12" width="450px">
                                                Relação de componentes</th>
                                            <th class="border-none p-0 fonte" width="50px">9.</th>
                                            <th class="border-none p-0 fonte text-left" colspan="12" width="400px">Taxas
                                                em caso de cancelamento</th>
                                        </tr>
                                        <tr>
                                            <th class="border-none p-0 fonte" width="50px">5.</th>
                                            <th class="border-none p-0 fonte text-left" colspan="12" width="450px">
                                                Características mecânicas e elétricas</th>
                                            <th class="border-none p-0 fonte" width="50px">10.</th>
                                            <th class="border-none p-0 fonte text-left" colspan="12" width="400px">
                                                Garantia</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row justify-content-between mt-10">
                                <div class="col-12 text-left">
                                    <div class="h4 m-0"><b>xxxxxx</b></div>
                                    <div class="mb-3 m-0">xxxxxx</div>
                                    <div class="h4 m-0"><b>xxxxxxx</b></div>
                                    <div class="m-0">xxxxxx</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="font_80 d-print-block">
                    <img src="xxxxx.png" class=""
                        style="width: 100% !important; height: 298px !important;">
                </div>
            </th>
        </tr>
    </table>
    <div class="d-none d-print-block footer p-0">
        <div class="mt-2 mb-5 p-0" style="width: 100%">
            <img src="xxxxx.png" class=""
                style="width: 15mm !important; height: 372mm !important;">
        </div>
    </div>
    <table class="border-none data-table p-0 m-0">
        <thead class="border-none cabecalho">
            <tr class="p-0 m-0">
                <th class="border-none p-0 m-0"
                    style="max-height: 180px !important; padding-left: 20mm !important; padding-right: 5mm !important"
                    colspan="7">
                    <div class="row" style="height: 160px !important">
                        <div class="col-6 teste2">
                            <div class="text-left pt-10"><br>
                                <div class="m-0 small text-body">Cód. R066-rev.02</div>
                                <h1 class="h4 pb-0">
                                    <div class="m-0 h1 pb-0" style="font-size: 16pt !important"><b>PROPOSTA
                                            COMERCIAL</b></div>
                                    <div class="m-0 h4 pt-0"><b>G: {{ $venda->VENDAS_NUMERO_CONTROLE }} &nbsp; {{
                                            ($venda->VENDAS_VERSAO_REVISAO) }}</b></div>
                                </h1>
                                <div class="m-0"><b>São Paulo, {{ $semana }}, {{ $dia }} de {{ $mes }} de {{ $ano }}</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-right header p-0 m-0"
                            style="float:left !important; z-index: -10 !important;">
                            <img id="" style="height: 19rem; z-index: -10 !important;" class="mb-0 img"
                                src="{{ \App\Helpers\General::MakeImageURL('layouts.temp', $estab->logo_path()) }}">
                        </div>
                    </div>
                    <div class="clearfix border_bottom2"></div>
                </th>
            </tr>
        </thead>
        <tbody style="z-index: -1 !important;">
            <tr>
                <th class="border-none text-top p-0 div4 quebra-pagina"
                    style="padding-left: 15mm !important; padding-right: 5mm !important" colspan="7">
                    <div class="card-body pt-2 pb-2">
                        <div class="row justify-content-between mb-5">
                            <div class="col-12 text-left">
                                <div class="h3 m-0"><b>1. Consciência Ambiental e com a vida:</b></div>
                                <div class="mb-3">
                                    A xxxxx, preocupada com o meio ambiente e com a qualidade de vida de nossos
                                    colaboradores, têm adotado práticas para reduzir a zero em nossos produtos,
                                    processos que envolvam solda e pintura. Para isso, desenvolvemos fornecedores de
                                    chaparia pré-zincada e pré-pintada e desenvolvemos máquinas e processos para o uso
                                    de rebites nos nossos produtos.
                                </div>
                                <div class="mb-3">
                                    Esse processo de tratamento e pintura da chaparia oferece 03 anos de garantia contra
                                    oxidação, já adotado na indústria de fogões, geladeiras, micro-ondas, lavadoras de
                                    roupa e telhados metálicos para galpões e agora, de maneira revolucionária, por nós.
                                    O uso de rebites já é adotado em larga escala na fabricação de aviões em todo o
                                    mundo.
                                </div>
                                <div class="mb-3">
                                    A xxxxx, à frente de seu tempo, recentemente se certificou na ISO 14000, essas
                                    medidas de preocupação e responsabilidade com o meio ambiente que já estavam no
                                    nosso DNA desde 1971, agora fazem parte integrante dos nossos processos.
                                </div>
                                <div>
                                    Esperamos contar com o apoio dos senhores nessa nossa empreitada para um mundo
                                    melhor. Se ainda assim, esses processos não os atenderem, por favor avise o depto.
                                    comercial para que ele reconsidere os preços desta proposta para o método
                                    tradicional.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-2">
                        <div id="" class="row ">
                            <div class="col-12 text-left" style="page-break-inside: always !important">
                                <div class="h3 m-0"><b>2. Considerações Importantes:</b></div>
                                @foreach ($campo as $c)
                                <?php
                                                $string = $c;
            
                                                $pattern = '/\*\*(.*?)--/s';
                                                preg_match_all($pattern, $string, $matches);
            
                                                foreach ($matches[0] as $match) {
                                                    $formatted_match = str_replace("**", "<strong>", $match);
                                                    $formatted_match = str_replace("--", "</strong>", $formatted_match);
            
                                                    $string = str_replace($match, $formatted_match, $string);
                                                }
            
                                                $pg++;
                                            ?>
                                <div class="pt-1 border-none"
                                    style="white-space: pre-wrap; word-wrap: break-word; page-break-inside: always !important">
                                    <?php print_r($string) ?>
                                </div>
                                {{-- @if ($loop->last)
                                <div class="d-none d-print-block quebra-pagina"></div>
                                @endif --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </th>
            </tr>
            <?php
                        $t = 1;
                        $item = [];
                    ?>
            <tr>
                <th class="border-none div2" style="padding-left: 20mm !important; padding-right: 5mm !important"
                    colspan="7">
                    <table class="border-none pl-3 pr-3">
                        <tr>
                            <th class="border-none" colspan="19">
                                <div class="h3 m-0 text-left"><b>3. Preços:</b></div>
                            </th>
                        </tr>
                        <tr class="sua-div">
                            <th class="blue white border_lightgray p-0">Item</th>
                            <th class="blue white border_lightgray p-0" colspan="8">Produto</th>
                            <th class="blue white border_lightgray p-0" colspan="2">Qtde</th>
                            {{-- <th class="blue white border_lightgray p-0" colspan="2">Comprimento</th> --}}
                            <th class="blue white border_lightgray p-0" colspan="2">NCM</th>
                            <th class="blue white border_lightgray p-0">IPI</th>
                            <th class="blue white border_lightgray p-0">ICMS</th>
                            <th class="blue white border_lightgray p-0" colspan="2">Preço Un. s/ IPI</th>
                            <th class="blue white border_lightgray p-0" colspan="2">Subtotal s/ IPI</th>
                        </tr>
                        @foreach ($venda->produtos->groupBy('VENDAS_PRODUTOS_TAG_COMERCIAL') as $produto)
                        @if (!$produto->first()->VENDAS_PRODUTOS_TAG_COMERCIAL)
                        @foreach ($venda->produtos->whereNull('VENDAS_PRODUTOS_TAG_COMERCIAL') as $prod)
                        <?php
                                                $item[$prod->VENDAS_PRODUTOS_ID] = $t;
                                            ?>
                        <tr style="page-break-inside: avoid !important;">
                            <th class="border_lightgray p-0">{{ $t }}</th>
                            <th class="text-left border_lightgray p-0 pl-2" colspan="8">
                                <span class="d-block h5 text-hover-primary mb-0">{{ $prod->produto ?
                                    $prod->produto->PRODUTOS_DESCRICAO : '' }}</span>
                                <span class="d-block font-size-sm text-body">{{ $prod->produto ?
                                    $prod->produto->PRODUTOS_IDENTIFICACAO : '' }} {{ $prod->VENDAS_PRODUTOS_TAG ? " |
                                    Tag: ".$prod->VENDAS_PRODUTOS_TAG : '' }}</span>
                                <span class="d-block font-size-sm text-body">{{ $prod->VENDAS_PRODUTOS_CARACTERISTICA
                                    }}</span>
                            </th>
                            <th class="border_lightgray p-0" colspan="2">{{
                                forceFloat($prod->VENDAS_PRODUTOS_QDE_PEDIDA, 2) }} {{ $prod->produto ?
                                $prod->produto->PRODUTOS_UM : '' }}</th>
                            {{-- <th class="border_lightgray p-0" colspan="2">{{
                                forceFloat($prod->VENDAS_PRODUTOS_QDE_PEDIDA * $prod->VENDAS_PRODUTOS_COMPRIMENTO, 2) }}
                            </th> --}}
                            <th class="border_lightgray p-0" colspan="2">{{ $prod->produto ?
                                $prod->produto->PRODUTOS_NCM : '' }}</th>
                            <th class="border_lightgray p-0">{{ $prod->VENDAS_PRODUTOS_VALOR_IPI ?
                                ($prod->VENDAS_PRODUTOS_VALOR_UNITARIO_ORIGINAL != 0 ?
                                round(($prod->VENDAS_PRODUTOS_VALOR_IPI * 100) /
                                $prod->VENDAS_PRODUTOS_VALOR_UNITARIO_ORIGINAL, 2).' %' : '') : '' }}</th>
                            <th class="border_lightgray p-0">{{ $prod->VENDAS_PRODUTOS_VALOR_ICMS ?
                                round(($prod->VENDAS_PRODUTOS_VALOR_ICMS * 100) / $prod->VENDAS_PRODUTOS_VALOR_UNITARIO,
                                2).' %' : '' }}</th>
                            <th class="border_lightgray p-0" colspan="2">{{ $tipo_moeda }} {{ forceFloat(
                                $prod->VENDAS_PRODUTOS_VALOR_UNITARIO, 2) }}</th>
                            <th class="border_lightgray p-0" colspan="2">{{ $tipo_moeda }} {{
                                forceFloat(($prod->VENDAS_PRODUTOS_VALOR_UNITARIO) * $prod->VENDAS_PRODUTOS_QDE_PEDIDA,
                                2) }}</th>
                        </tr>
                        <?php
                                                $t++;
                                            ?>
                        @endforeach
                        @else
                        <?php
                                            $item[$produto->first()->VENDAS_PRODUTOS_TAG_COMERCIAL] = $t;
                                        ?>
                        <tr>
                            <th class="border_lightgray p-0 text-center">{{ $t }}</th>
                            <th class="border_lightgray text-left p-0 pr-2 pl-2" colspan="8">{{
                                $produto->first()->VENDAS_PRODUTOS_TAG_COMERCIAL }}</th>
                            <th class="border_lightgray p-0 text-center" colspan="2">{{
                                forceFloat($produto->sum('VENDAS_PRODUTOS_QDE_PEDIDA'), 2) }} {{
                                $produto->first()->produto ? $produto->first()->produto->PRODUTOS_UM : '' }}</th>
                            {{-- <th class="border_lightgray p-0 text-center" colspan="2">{{
                                forceFloat($produto->sum(function($item) { return $item->VENDAS_PRODUTOS_QDE_PEDIDA *
                                $item->VENDAS_PRODUTOS_COMPRIMENTO; }), 2) }}</th> --}}
                            <th class="border_lightgray p-0 text-center" colspan="2">{{ $produto->first()->produto ?
                                $produto->first()->produto->PRODUTOS_NCM : '' }}</th>
                            <th class="border_lightgray p-0 text-center">{{ $produto->first()->VENDAS_PRODUTOS_VALOR_IPI
                                ? ($produto->first()->VENDAS_PRODUTOS_VALOR_UNITARIO_ORIGINAL != 0 ?
                                round(($produto->first()->VENDAS_PRODUTOS_VALOR_IPI * 100) /
                                $produto->first()->VENDAS_PRODUTOS_VALOR_UNITARIO_ORIGINAL, 2).' %' : '') : '' }}</th>
                            <th class="border_lightgray p-0 text-center">{{
                                $produto->first()->VENDAS_PRODUTOS_VALOR_ICMS ?
                                round(($produto->first()->VENDAS_PRODUTOS_VALOR_ICMS * 100) /
                                $produto->first()->VENDAS_PRODUTOS_VALOR_UNITARIO, 2).' %' : '' }}</th>
                            <th class="border_lightgray p-0" colspan="2">{{ $tipo_moeda }} {{ forceFloat(
                                $produto->sum(function($item) { return (($item->VENDAS_PRODUTOS_VALOR_UNITARIO)); }), 2)
                                }}</th>
                            <th class="border_lightgray p-0" colspan="2">{{ $tipo_moeda }} {{
                                forceFloat($produto->sum(function($item) { return
                                (($item->VENDAS_PRODUTOS_VALOR_UNITARIO)) * $item->VENDAS_PRODUTOS_QDE_PEDIDA; }), 2) }}
                            </th>
                        </tr>
                        @endif
                        @endforeach
                        <tbody style="page-break-inside: avoid !important;">
                            <tr>
                                <th class="border-none" colspan="13"></th>
                                <th class="border-none text-right p-0 pr-2" colspan="2">Subtotal s/ IPI</th>
                                <th class="border_lightgray text-right p-0 pl-1" colspan="4">{{ $tipo_moeda }} {{
                                    forceFloat($venda->produtos->sum(function($item) { return
                                    (($item->VENDAS_PRODUTOS_VALOR_UNITARIO)) * $item->VENDAS_PRODUTOS_QDE_PEDIDA; }),
                                    2) }}</th>
                            </tr>
                            <tr>
                                <th class="border-none" colspan="13"></th>
                                <th class="border-none text-right p-0 pr-2" colspan="2">IPI</th>
                                <th class="border_lightgray text-right p-0 pl-1" colspan="4">{{ $tipo_moeda }} {{
                                    forceFloat($venda->produtos->sum(function($item) { return
                                    ($item->VENDAS_PRODUTOS_VALOR_IPI * $item->VENDAS_PRODUTOS_QDE_PEDIDA); }), 2) }}
                                </th>
                            </tr>
                            <tr>
                                <th class="border-none" colspan="13"></th>
                                <th class="border-none text-right p-0 pr-2" colspan="2">Valor Total</th>
                                <th class="border_lightgray text-right p-0 pl-1" colspan="4">{{ $tipo_moeda }} {{
                                    forceFloat($venda->produtos->sum(function($item) { return
                                    (($item->VENDAS_PRODUTOS_VALOR_IPI + $item->VENDAS_PRODUTOS_VALOR_UNITARIO) ) *
                                    $item->VENDAS_PRODUTOS_QDE_PEDIDA; }) , 2) }}</th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="">
                        <div class="row justify-content-between mt-10" style="page-break-inside: avoid">
                            <div class="col-6 text-left" style="text-align:center !important">
                                <h2 class="m-0">__________________________________</h2>
                                <address class="m-0">{{ $estabelecimento->ESTABELECIMENTOS_DESCRICAO }}</address>
                                <address class="m-0">(Assinatura/Data)</address>
                            </div>
                            <div class="col-6 text-left" style="text-align:center !important">
                                <h2 class="m-0">__________________________________</h2>
                                <address class="m-0">{{ $venda->cliente ? $venda->cliente->CLIENTES_NOME_ABREVIADO :
                                    'Cliente' }}</address>
                                <address class="m-0">(Assinatura/Data)</address>
                            </div>
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th class="border-none div3" style="padding-left: 20mm !important; padding-right: 5mm !important"
                    colspan="7">
                    <table class="border-none pl-3 pr-3 quebra-pagina">
                        <tr>
                            <th class="border-none" colspan="13">
                                <div class="h3 m-0 text-left"><b>4. Relação de Componentes:</b></div>
                            </th>
                        </tr>
                        <?php
                                    $a = 0;
                                    $b = 0;
                                    $c = 0;
                                ?>
                        @foreach ($venda->produtos->groupBy('VENDAS_PRODUTOS_TAG_COMERCIAL') as $produto)
                        <?php
                                        $a++;    
                                    ?>
                        @if (!$produto->first()->VENDAS_PRODUTOS_TAG_COMERCIAL)
                        @foreach ($venda->produtos->whereNull('VENDAS_PRODUTOS_TAG_COMERCIAL') as $prod)
                        <?php
                                                $a++;
                                                $obs = explode('|', $prod->VENDAS_PRODUTOS_VARIACOES_DESCRICAO);
                                            ?>
                        <tr>
                            <th class="white text-left pr-2 pl-2 border_lightgray gray" colspan="13"
                                style="background-color: gray !important">Item: {{ $item[$prod->VENDAS_PRODUTOS_ID] }} -
                                {{ $prod->produto ? $prod->produto->PRODUTOS_DESCRICAO : '' }} {{
                                $prod->VENDAS_PRODUTOS_TAG ? " | Tag: ".$prod->VENDAS_PRODUTOS_TAG : '' }} {{
                                $prod->VENDAS_PRODUTOS_NITEMPED ? '| Documento: '.$prod->VENDAS_PRODUTOS_NITEMPED : ''
                                }}</th>
                        </tr>
                        @foreach ($prod->kits->sortBy('VPK_TAG_AGRUPAMENTO')->groupBy('VPK_TAG_AGRUPAMENTO') as $kit)
                        <?php
                                                    $a++;
                                                ?>
                        <tr>
                            <th class="sua-div white text-left border_lightgray pr-2 pl-2" colspan="13"
                                style="flex: 1; width: 800px;">{{ $kit->first()->VPK_TAG_AGRUPAMENTO }} - {{
                                $kit->first()->VPK_TAG_TECNICA }}</th>
                        </tr>

                        <tr>
                            <th class="text-left border_lightgray pr-2 pl-2" colspan="12">PRODUTO / SERVIÇO</th>
                            <th class="text-left border_lightgray pr-2 pl-2">Qtde</th>
                        </tr>
                        @foreach ($kit as $k)
                        @if ($k->VPK_EXIBIR_PROPOSTA == 'S')
                        <?php
                                                            $a++;
                                                        ?>
                        <tr>
                            <th class="text-left border_lightgray pr-2 pl-2" colspan="12">
                                <span class="d-block h6 text-hover-primary mb-0">{{ $k->produto ?
                                    $k->produto->PRODUTOS_DESCRICAO : '' }}</span>
                                <span class="d-block text-body">{{ $k->produto ? $k->produto->PRODUTOS_IDENTIFICACAO :
                                    '' }}</span>
                            </th>
                            <th class="text-left border_lightgray pr-2 pl-2">{{ forceFloat($k->VPK_QTDE, 2) }}</th>
                        </tr>
                        @endif
                        @endforeach
                        @endforeach
                        <tr>
                            <th class="text-left border_lightgray pr-2 pl-2 gold" colspan="13"
                                style="background-color: gold !important">Observação: @foreach($obs as $o)
                                @if($loop->first) {{ $o }} @else <div>{{ $o }}</div> @endif @endforeach</th>
                        </tr>
                        <tr>
                            <th class="text-left pr-2 pl-2 border-none" colspan="13"
                                style="background-color: #ffff  !important"></th>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <th class="sua-div white text-left border_lightgray pr-2 pl-2" colspan="13">{{
                                $item[$produto->first()->VENDAS_PRODUTOS_TAG_COMERCIAL] }} - {{
                                $produto->first()->VENDAS_PRODUTOS_TAG_COMERCIAL }}</th>
                        </tr>
                        <tr>
                            <th class="text-left border_lightgray pr-2 pl-2" colspan="12">PRODUTO / SERVIÇO</th>
                            <th class="text-left border_lightgray pr-2 pl-2">Qtde</th>
                        </tr>
                        @foreach ($produto as $prod)
                        <?php
                                                $a++;    
                                            ?>
                        <tr>
                            <th class="white text-left border_lightgray pr-2 pl-2 gray" colspan="12"
                                style="background-color: gray !important">Item: {{ $loop->index + 1 }} - {{
                                $prod->produto ? $prod->produto->PRODUTOS_DESCRICAO : '' }} {{
                                $prod->VENDAS_PRODUTOS_TAG ? " | Tag: ".$prod->VENDAS_PRODUTOS_TAG : '' }} </th>
                            <th class="white text-left border_lightgray pr-2 pl-2 gray"
                                style="background-color: gray !important">{{
                                forceFloat($prod->VENDAS_PRODUTOS_QDE_PEDIDA, 2) }}</th>
                        </tr>
                        <tr>
                            <th class="text-left border_lightgray pr-2 pl-2 gold" colspan="13"
                                style="background-color: gold !important">Observação: {!!
                                $prod->VENDAS_PRODUTOS_VARIACOES_DESCRICAO !!}</th>
                        </tr>
                        <tr>
                            <th class="text-left pr-2 pl-2 border-none" colspan="13"
                                style="background-color: #ffff  !important"></th>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                    </table>
                </th>
            </tr>
            <tr>
                <th class="border-none" style="padding-left: 15mm !important; padding-right: 5mm !important"
                    colspan="7">
                    <div class="card-body pt-0 pb-2">
                        <div class="row justify-content-between quebra-pagina">
                            <div class="col-12 text-left">
                                <div class="h3 m-0"><b>5. Características Mecânicas e Elétricas:</b></div>
                                @foreach ($obs2 as $o)
                                <?php
                                                $pg++;
                                            ?>
                                <div class="teste3">
                                    <?php print_r($o) ?>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="" class="row quebra-pagina">
                            <div class="col-12 text-left">
                                <div class="h3 m-0"><b>6. Pagamento:</b></div>
                                @foreach ($campo_6 as $c)
                                <?php
                                                $string = $c;
            
                                                $pattern = '/\*\*(.*?)--/s';
                                                preg_match_all($pattern, $string, $matches);
            
                                                foreach ($matches[0] as $match) {
                                                    $formatted_match = str_replace("**", "<strong>", $match);
                                                    $formatted_match = str_replace("--", "</strong>", $formatted_match);
                                                    $string = str_replace($match, $formatted_match, $string);
                                                }
            
                                                $pg++;
                                            ?>
                                <div class="pt-1 border-none teste3"
                                    style="white-space: pre-wrap; word-wrap: break-word; page-break-inside: always !important">
                                    <?php print_r($string) ?>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="" class="row quebra-pagina">
                            <div class="col-12 text-left">
                                <div class="h3 m-0"><b>7. Impostos:</b></div>
                                @foreach ($campo_7 as $c)
                                <?php
                                                $string = $c;
                                                $pattern = '/\*\*(.*?)--/s';
                                                preg_match_all($pattern, $string, $matches);
            
                                                foreach ($matches[0] as $match) {
                                                    $formatted_match = str_replace("**", "<strong>", $match);
                                                    $formatted_match = str_replace("--", "</strong>", $formatted_match);
                                                    $string = str_replace($match, $formatted_match, $string);
                                                }
            
                                                $pg++;
                                            ?>
                                <div class="pt-1 border-none teste3"
                                    style="white-space: pre-wrap; word-wrap: break-word; page-break-inside: always !important">
                                    <?php print_r($string) ?>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="" class="row quebra-pagina">
                            <div class="col-12 text-left">
                                <div class="h3 m-0"><b>8. Condições de Entrega:</b></div>
                                @foreach ($campo_8 as $c)
                                <?php
                                                $string = $c;
                                                $pattern = '/\*\*(.*?)--/s';
                                                preg_match_all($pattern, $string, $matches);
                                                foreach ($matches[0] as $match) {
                                                    $formatted_match = str_replace("**", "<strong>", $match);
                                                    $formatted_match = str_replace("--", "</strong>", $formatted_match);
            
                                                    $string = str_replace($match, $formatted_match, $string);
                                                }
            
                                                $pg++;
                                            ?>
                                <div class="pt-1 border-none teste3"
                                    style="white-space: pre-wrap; word-wrap: break-word; page-break-inside: always !important">
                                    <?php print_r($string) ?>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="" class="row ">
                            <div class="col-12 text-left">
                                <div class="h3 m-0"><b>9. Taxas em caso de cancelamento:</b></div>
                                @foreach ($campo_9 as $c)
                                <?php
                                                $string = $c;
                                                $pattern = '/\*\*(.*?)--/s';
                                                preg_match_all($pattern, $string, $matches);
            
                                                foreach ($matches[0] as $match) {
                                                    $formatted_match = str_replace("**", "<strong>", $match);
                                                    $formatted_match = str_replace("--", "</strong>", $formatted_match);
            
                                                    $string = str_replace($match, $formatted_match, $string);
                                                }
                                            ?>
                                <div class="pt-1 border-none"
                                    style="white-space: pre-wrap; word-wrap: break-word; page-break-inside: always !important">
                                    <?php print_r($string) ?>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="" class="row pt-5">
                            <div class="col-12 text-left">
                                <div class="h3 m-0"><b>10. Garantia:</b></div>
                                @foreach ($campo_10 as $c)
                                <?php
                                                $string = $c;
            
                                                $pattern = '/\*\*(.*?)--/s';
                                                preg_match_all($pattern, $string, $matches);
            
                                                foreach ($matches[0] as $match) {
                                                    $formatted_match = str_replace("**", "<strong>", $match);
                                                    $formatted_match = str_replace("--", "</strong>", $formatted_match);
                                                    $string = str_replace($match, $formatted_match, $string);
                                                }
                                            ?>
                                <div class="pt-1 border-none"
                                    style="white-space: pre-wrap; word-wrap: break-word; page-break-inside: always !important">
                                    <?php print_r($string) ?>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </th>
            </tr>
        </tbody>
    </table>
</div>
@endif
@endsection
