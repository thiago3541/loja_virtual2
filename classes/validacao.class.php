<?php
	class Validacao
	{
		private $dados;
		private $erro = array();

		public function set($valor, $nome)
		{
			$this->dados = array("valor" => strip_tags(trim($valor)), "nome" => $nome);
			return $this;
		}

		public function obrigatorio()
		{
			if (empty($this->dados['valor'])) 
			{
				$this->erro[] = sprintf("O campo é obrigatório", $this->dados['valor']);
			}

			return $this;
		}

		public function isEmail()
		{
			if (!preg_match("/^[a-z0-9\.\-]+\.[a-z]{2-4}$/i", $this->dados['valor'])) 
			{
				$this->erro[] =sprintf("O campo %s só aceita emails validos", $this->dados['nome']);
			}
			return $this;
		}

		public function isTel()
		{
			//(xx)xxxx-xxxx
			if (!preg_match("/^\([0-9]{2}\)[0-9]{4}\-[0-9]{4}$/", $this->dados['valor'])) 
			{
				$this->erro[] = sprintf("O campo %s só aceita no formato (xx) xxxx-xxxx", $this->dados['nome']);
			}

			return $this;
		}

		public function validar()
		{
			if (count($this->erro) > 0) 
			{
				return false;
			}
			else
			{
				return true;
			}

		}

		public function getErro()
		{
			return $this->erro;
		}

		public function isCpf($cpf)
		{
			$cpf = preg_replace("/[^0-9]/", "", $cpf);
			$digitoUm = 0;
			$digitoDois = 0;

			for($i = 0, $x = 10; $i <= 8; $i ++, $x--)
			{

			}



		}
	}
?>