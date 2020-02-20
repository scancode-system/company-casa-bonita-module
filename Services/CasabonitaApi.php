<?php

namespace Modules\CompanyCasaBonita\Services;

use Exception;

class CasabonitaApi {

    private $url;
    private $login;
    private $senha;

    public function __construct() {
        $this->url = 'http://casabonita.omegasoft.net.br/Casabonita/api/v1';
        //$this->url = 'http://casabonita.omegasoft.net.br/Desenv/api/v1';
        $this->login = '';
        $this->senha = '';

    }


    public function import($pedido){
        $cliente = $pedido->order_client;

        try {
            //$cliente_codigo = $cliente->id_cliente;
            $cliente_codigo = $this->checkClient($cliente);
            if($cliente_codigo == 0){
                $cliente_codigo = $this->importClient($cliente);
            }



            $pagamentos = [[
                'dtVencimento' => $pedido->closing_date->__toString(),
                'vlParcela' => $pedido->total,
                'codFormaPagto' => $pedido->order_payment->payment_id,
                'descFormaPagto' => $pedido->order_payment->description
            ]];

            $enderecos = [[
                'tpEndereco' => 'E',
                'bairro' => $cliente->order_client_address->neighborhood,
                'cep' => $cliente->order_client_address->postcode,
                'cidade' => $cliente->order_client_address->city,
                'endereco' => $cliente->order_client_address->street,
                'numero' => '0',
                'pais' => 'Sem Pais',
                'siglaUf' => $cliente->order_client_address->st,
                'complementoEnd' => '',
                'referenciaEnd' => '',
            ]];

            $itens = [];
            foreach ($pedido->items as $pedido_item) {
                $tax_ipi = $pedido_item->item_taxes()->where('module', 'ipi')->first();
                if($tax_ipi)
                {
                    $ipi =  $tax_ipi->porcentage;
                }else
                {
                    $ipi =  0;
                }


                array_push($itens, [
                    'codProduto' => $pedido_item->item_product->sku,
                    'aliquotaIPI' => $ipi,
                    'descComercial' => $pedido_item->item_product->description,
                    'aliquotaICMS' => '0',
                    'csosn' => '400',
                    'precoUnit' => $pedido_item->price,
                    'quantidade' => $pedido_item->qty,
                    'cfop' => '5.102',
                    'cst' => '00']);
            }

            $data = [
                'codEmpresa' => '3',
                'codCliente' => $cliente_codigo,
                'nomeCliente' => $cliente->corporate_name,
                'codPedidoEcommerce' => null,
                'nrPedCompraCli' => $pedido->id,
                'codTpAplicacao' => null,
                'indEnderecoUnico' => 1,
                'situacao' => '10',
                'dtEntregaComprometida' => $pedido->closing_date->__toString(),
                'vlTotalProdutos' => '0',
                'vlTotalICMSST' => '0',
                'vlTotalPedido' => '0',
                'vlFrete' => '0',
                'vlTotalIPI' => '0',
                'vlDesconto' => '0',
                "tbPreco" => "TabPadrao",
                "nop" => "5.102_SF",
                'itens' => $itens,
                'enderecos' => $enderecos,
                'pagamentos' => $pagamentos
            ];

            $data_string = json_encode($data);  
            //dd($data_string);
            //dd('Nao passar daqui');

            $curl = curl_init($this->url.'/pedidos');
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);   

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                'Content-Length: ' . strlen($data_string),
                'Authorization: eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ7XCJ1c2VybmFtZVwiOlwidW5vc29sXCIsXCJ0eXBlXCI6XCJDT0xBQk9SQURPUlwifSJ9.7Fv-yr5xzl_a1wDmzOGOnrKCfiic5zEFVnU7HnqXukg'
                //'Authorization: eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ7XCJ1c2VybmFtZVwiOlwidW5vc29sXCIsXCJ0eXBlXCI6XCJDT0xBQk9SQURPUlwifSJ9.U_MyaoT1pQ61c6b7HsiRGHOGRzPw5fdyOV4DSr51KQM'
            ));    

            $response = json_decode(utf8_encode(curl_exec($curl)));

            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);
            
            //dd( $status);

            if($status == 200){
                //echo $response;
                //echo $status;
                //die();
                $data = ['status' => $status, 'message' => 'pedido importado com sucesso', 'codigo' => $response->codPedido];  
            } else {
                //echo $response;
                //echo $status;
                //dd($data);
                //die();
//                dd($status);
                 //dd($data); 
              // dd($response->message); 
                if(is_null($response->message)){
                    $response->message =  'Erro sem mensagem';
                }
                $data = ['status' => $status, 'message' => $response->message, 'codigo' => null];   
                //dd('oi'); 
            }
           // dd($data);
            return $data;

        } catch(Exception $e) {
            //if($e->getCode() == 10){
            return ['status' => 500, 'message' => $e->getMessage(), 'codigo' => null];
            //} else {
             //   dd($e->getMessage());
            //}
        }
    }


    public function checkClient($cliente){
        $cpf_cnpj = preg_replace('/[^0-9]/', '', $cliente->cpf_cnpj);
        $cnpj_cpf_key = 'cnpj';
        if(strlen($cpf_cnpj) == 11){
            $cnpj_cpf_key = 'cpf';

        } 

        $curl = curl_init($this->url.'/clientes/?'.$cnpj_cpf_key.'='.$cpf_cnpj);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);   
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',
            'Authorization: eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ7XCJ1c2VybmFtZVwiOlwidW5vc29sXCIsXCJ0eXBlXCI6XCJDT0xBQk9SQURPUlwifSJ9.7Fv-yr5xzl_a1wDmzOGOnrKCfiic5zEFVnU7HnqXukg'
            //'Authorization: eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ7XCJ1c2VybmFtZVwiOlwidW5vc29sXCIsXCJ0eXBlXCI6XCJDT0xBQk9SQURPUlwifSJ9.U_MyaoT1pQ61c6b7HsiRGHOGRzPw5fdyOV4DSr51KQM'
        ));
        $response = json_decode(utf8_encode(curl_exec($curl)));
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($status == 200){
            return $response[0]->codCliente;
        } else {
            return 0;
        }
    }

    public function importClient($cliente){
        //dd('importar');
        $cpf_cnpj = preg_replace('/[^0-9]/', '', $cliente->cpf_cnpj);
        $tp_cliente = 'J';
        $cnpj_cpf_key = 'cnpj';
        if(strlen($cpf_cnpj) == 11){
            $tp_cliente = 'F';
            $cnpj_cpf_key = 'cpf';

        } 

        $endereco = $cliente->order_client_address;

        $data = [
            "codEmpresa" => "3",
            "tpCliente" => $tp_cliente,
            $cnpj_cpf_key => $cpf_cnpj,
            "inscEstadual" => '',//$cliente->inscricao_estadual,
            "nomeCliente" => $cliente->buyer,
            "razaoSocial" => $cliente->corporate_name,
            "situacao" => "1",
            "site" => '',
            "email" => $cliente->email,
            "emailNfe" => $cliente->email,
            "nomeContato" => 'Contato FIXO', //$cliente->nome_contato,
            "situacaoContato" => "1",
            "observacao" => '',
            'tpTelefone' => '1',
            "dddTelefone" => "0",
            "telefone" => substr($cliente->phone, 0 , 15),
            "indEnderecoUnico" => "1",
            "tpContribuinte" => "1",
            "tbPreco" => "TabPadrao",
            "sexo" => "M",
            "enderecos" => [[
                "tpEndereco" => "E",
                "endereco" => $endereco->street,
                "numero" => "0",
                "bairro" => $endereco->neighborhood,
                "cidade" => $endereco->city,
                "siglaUf" => $endereco->st,
                "cep" => $endereco->postcode,
                "complementoEnd" => "",
                "referenciaEnd" => "",
                "pais" => "Sem Pais" 
            ]]];

          //dd($data);
            $data_string = json_encode($data);  


            $curl = curl_init($this->url.'/clientes');
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);   

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                'Content-Length: ' . strlen($data_string),
                'Authorization: eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ7XCJ1c2VybmFtZVwiOlwidW5vc29sXCIsXCJ0eXBlXCI6XCJDT0xBQk9SQURPUlwifSJ9.7Fv-yr5xzl_a1wDmzOGOnrKCfiic5zEFVnU7HnqXukg'
                //'Authorization: eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ7XCJ1c2VybmFtZVwiOlwidW5vc29sXCIsXCJ0eXBlXCI6XCJDT0xBQk9SQURPUlwifSJ9.U_MyaoT1pQ61c6b7HsiRGHOGRzPw5fdyOV4DSr51KQM'
            ));  

            $response =  json_decode(utf8_encode(curl_exec($curl)));
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);


            if($status == 200){
                return $response->codCliente;
            } else {
                throw new Exception("Cliente não pode ser cadastrado", 10);
            }


        }

    }
