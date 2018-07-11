<?php
	class Carrinho
	{
		private $pref = 'loja_';

		private function existe($id)
		{
			//Verifica a existência da SESSION
			if (!isset($_SESSION[$this->pref.'produto'])) 
			{
				$_SESSION[$this->pref.'produto'] = array();
			}

			//Verifica a existência do produto com o aquele id no carrinho...
			if (!isset($SESSION[$this->pref.'produto'][$id])) 
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		//verifica e adciona mais um produto no carrinho...
		public function verificaAdciona($id)
		{
			if (!$this->existe($id)) 
			{
				$_SESSION[$this->pref.'produto'][$id] = 1;
			}
			else
			{
				$_SESSION[$this->pref.'produto'][$id] += 1;
			}
		}

		private function prodExiste($id)
		{
			if (isset($_SESSION[$this->pref.'produto'][$id])) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		//deletar produto do carrinho de compras
		public function deletaProduto($id)
		{
			if (!$this->prodExiste($id)) 
			{
				return false;
			}
			else
			{
				unset($_SESSION[$this->pref.'produto'][$id]);
				return true;
			}
		}

		//verifica se o post pasado por parametro é ou não um array
		private function isArray($post)
		{
			if (is_array($post)) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function atualizarQuantidades($post)
		{
			if ($this->isArray($post)) 
			{
				foreach ($post as $id => $qtd) 
				{
					$id = (int)$id;
					$qtd = (int)$qtd;

					if ($qtd != '') 
					{
						$_SESSION[$this->pref.'produto'][$id] = $qtd;
					}
					else
					{
						unset($_SESSION[$this->pref.'produto'][$id]);
					}
				}
				return true;
			}
			else
			{
				return false;
			}//Se não for um array
		}//deleta ou atualiza quantidades referente a um produto no nosso carrinho...

		public function qtdProdutos()
		{
			return count($_SESSION[$this->pref.'produto']);
		}

		//Função para cálculo do frete

		public function calculaFrete($cod_servico, $cep_origem, $cep_destino, $peso, $altura='2',
										 $largura='11', $comprimento='16', $valor_declarado='18.00')
		{
			# Código dos serviços dos Correios

			#41116 PAC sem contrato
			#40010 SEDEX sem contrato
			#40045 SEDEX a Cobrar, sem contrato
			#40215 SEDEX 10, sem contrato

			$correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?"."nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n"."&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=n"."&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";
			$xml = simplexml_load_file($correios);
			if (!$xml->cServico->Erro == '') 
			{
				return $xml->cServico->Valor;
			}
			else
			{
				return false;
			}
			echo calculaFrete('04014','45350000','18117250','0.200');
		}

	}
?>