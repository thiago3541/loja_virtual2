<?php
	function frete(array $dados){
        $retorno = array();
        $data['nCdEmpresa'] = '';
        $data['sDsSenha'] = '';
        $data['sCepOrigem'] = $dados['origem'];
        $data['sCepDestino'] = $dados['destino'];
        $data['nVlPeso'] = $dados['peso'];
        $data['nCdFormato'] = '1';
        $data['nVlComprimento'] = $dados['comprimento'];
        $data['nVlAltura'] = $dados['altura'];
        $data['nVlLargura'] = $dados['largura'];
        $data['nVlDiametro'] = '0';
        $data['sCdMaoPropria'] = 'n';
        $data['nVlValorDeclarado'] = '0';
        $data['sCdAvisoRecebimento'] = 'n';
        $data['StrRetorno'] = 'xml';
         // '40010' => sedex varejo;
         // 41106 => PAC varejo
         //40215 => Sedex 10
        $data['nCdServico'] = '40010,41106';
        $data = http_build_query($data);
        $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
        $curl = curl_init($url . '?' . $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        $result = simplexml_load_string($result);

        $n = 0;
        foreach($result->cServico as $i => $row) {
             //Os dados de cada serviço estará aqui
            if($row->Erro == 0 || $row->Erro == '010') {
                $retorno[0][] = (string)str_replace(',', '.', $row->Valor);
                $retorno[1][] = (string)$row->PrazoEntrega;
            }
            $n++;
        }
        return $retorno;
    }

     $dados = [
        'origem'  => '03189150',
        'destino' => '45350000',
        'comprimento' => '21',
        'altura' => '21',
        'largura' => '21',
        'peso' => '0.800'
    ];
    $calculo = frete($dados);
    echo '<pre>';
    print_r($calculo);