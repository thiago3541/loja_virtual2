<?php
	class Site extends BD
	{
		public function getData()
		{
			$data = getdate();
			$diaHoje = date('d');
			$array_meses = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
			$horaAgora = date('H:i:s');
			$mesAtual = $data['mon'];
			$anoAtual = date('Y');
			return 'Hoje, '.$diaHoje.' de '.$array_meses[$mesAtual].' de '.$anoAtual.', ás '.$horaAgora.'';
		}

		public function getMenu()
		{
			$listar_categorias = "SELECT * FROM loja_categorias ORDER BY id DESC";
			$executar = self::conn()->prepare($listar_categorias);
			$executar->execute();

			if ($executar->rowCount() == 0) {}
				else
				{
					while ($categoria = $executar->fetchObject()) 
					{
						echo '<li><a href="'.PATH.'/categoria/'.$categoria->slug.'">'.$categoria->titulo.'';

							$listar_subcategorias = "SELECT * FROM loja_subcategorias WHERE id_cat = ?";
							$executar_sub = self::conn()->prepare($listar_subcategorias);
							$executar_sub->execute(array($categoria->id));

							if ($executar_sub->rowCount() == 0) 
							{
								echo '</li>';
							}
							else
							{
								echo '<ul>';
								while ($subcategoria = $executar_sub->fetchObject()) 
								{
									echo '<li><a href="'.PATH.'/categoria/'.$categoria->slug.'/'.$subcategoria->slug.'">'.$subcategoria->titulo.'</a></li>';
								}
								echo '</ul></li>';
							}
					}
				}
		}
		//Pega os banners de ofertas para a página principal...
		public function getBanners()
		{
			$sqlBanners = "SELECT * FROM loja_banners ORDER BY id DESC LIMIT 4";
			return self::conn()->query($sqlBanners);
		}

		public function get_produtos_by_id($prods = array())
		{
			$array = array();

			if (is_array($prods) && count($prods) > 0) 
			{
				$sql = "SELECT * FROM produtos WHERE id IN (".implode(',', $prods).")";
				$sql = $this->db->query($sql);
				if ($sql->rowCount() > 0) 
				{
					$array = $sql->fetchAll();
				}
			}
		}

		public function getProdutosHome($limit = false)
		{
			if (limit == false) 
			{
				$query = "SELECT * FROM loja_produtos ORDER BY id DESC";
			}
			else
			{
				$query = "SELECT * FROM loja_produtos ORDER BY id DESC LIMIT $limit";
			}
			return self::conn()->query($query);
		}

		//atualiza vies da categoria
		public function atualizarViewCat($slug)
		{
			$strSQL = "UPDATE loja_categorias SET views = views+1 WHERE slug = ?";
			$executar_view =self::conn()->prepare($strSQL);
			$executar_view->execute(array($slug));
		}

		//atualiza views da subcategoria
		public function atualizarViewSub($slug)
		{
			$strSQL = "UPDATE loja_subcategorias SET views = views+1 WHERE slug = ?";
			$executar_view =self::conn()->prepare($strSQL);
			$executar_view->execute(array($slug));
		}

		public function inserir($tabela, $dados)
		{
			$pegarCampos = array_keys($dados);
			$contarCampos = count($pegarCampos);
			$pegarValores = array_values($dados);
			$contarValores = count($pegarValores);

			$sql = "INSERT INTO $tabela";
			if ($contarCampos == $contarValores) 
			{
				foreach($pegarCampos as $campo)
				{
					
				}
			}
		}

		public function selecionar($tabela, $dados, $condicao = false, $order = false)
		{
			$pegarValores = implode(', ', $dados);
			$contarValores = count($pegarValores);

			if ($condicao == false)
			{
				if ($contarValores > 0) 
				{
					if ($order != false) 
					{
						$sql = "SELECT $pegarValores FROM $tabela ORDER BY $order";
					}
					else
					{
						$sql = "SELECT $pegarValores FROM $tabela";
					}
					
					$this->conexao = self::conn()->prepare($sql);
					$this->conexao->execute();
					return $this->conexao;
				}
				else
				{
					$pegarCondCampos = array_keys($condicao);
					$contarCondCampos = count($pegarCondCampos);
					$pegarCondValores = array_values($condicao);

					$sql = "SELECT $pegarValores FROM $tabela WHERE";
					foreach($pegarCondCampos as $campoCondicao)
					{
						$sql .= $campoCondicao." = ? AND ";
					}
					$sql = substr_replace($sql, "", -5, 5);

					foreach($pegarCondValores as $condValores)
					{
						$dadosExec[] = $condValores;
					}

					if (order)($sql .= "ORDER BY $order"); 
					$this->conexao = self::conn()->prepare($sql);
					$this->conexao->execute($dadosExec);
					return $this->conexao;
				}
			}
		}

		public function listar()
		{
			$lista = $this->conexao->fetchAll();
			return $lista;
		}

		public function finalizar()
		{
			$dados = array(
				'total' => 0,
				'sessionId' => '',
				'erro' => '',
				'produtos' => array()
			);

			require 'PagSeguroLibrary/PagSeguroLibrary.php';

			$prods = array();
			if (isset($_SESSION['carrinho'])) 
			{
				$prods = $_SESSION['carrinho'];
			}

			if (count($prods > 0)) 
			{	
				$produtos = new produtos();
				$dados['produtos'] = $produtos->get_produtos_by_id($prods);

				foreach($dados['produtos'] as $prod)
				{
					$dados['total'] += $prod['valor_atual'];
				}
			}

			if (isset($_POST['pg_form']) && !empty($_POST['pg_form'])) 
			{
				
			}
			else
			{
				try
				{
					$credentials = PagSeguroConfig::getAccountCredentials();
					$sessionId = PagSeguroSessionService::getSession($credentials);
					
				}
				catch(PagSeguroServiceException $e)
				{
					die($e->getMessage());
				}
			}

			$this->loadTemplate('finalizar', $dados);

		}

		//método para envio de emails junto ao PHPMAILER...

		public function sendMail($subject, $msg, $from, $nomefrom, $destino, $nomedestino)
		{
			require_once "mailer/class.phpmailer.php";
			$mail = new PHPMailer();//instancio a classe phpmailer...

			$mail->isSMTP();//habilita envio smtp
			$mail->SMTPAuth = true;//autentica o envio smtp
			$mail->Host = 'mail.downsmaster.com';
			$mail->Port = '25';

			//começar o envio do email...
			$mail->username = 'contato@downsmaster.com';
			$mail->Password = '';

			$mail->From = $from; //email de quem envia...
			$mail->FromName = $nameFrom; //nome de quem envia...

			$mail->isHTML(true); //seta que é hml o email...
			$mail->subject = utf8_decode($subject);
			$mail->Body = utf8_decode($msg); //corpo da mensagem...
			$mail->AddAdress($destino, utf8_decode($nomedestino));//seto o destino do email...

			if ($mail->Send()) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
	}
?>