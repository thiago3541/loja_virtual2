<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		//Chamo a classe Site para fazer parte desta...
		require_once "../classes/Site.class.php";
		//instancio a classe Site para ser usada dentro desta...
		$site = new Site();

		//Recebe o post com o tipo de notificação...
		$tipoNotificacao = $_POST['notificationType'];

		//Recebe o código da notificação...
		$codigoNotificacao = $_POST['notificationCode'];

		if ($tipoNotificacao == 'transaciont') 
		{
			//requer a classe da biblioteca...
			require_once "../classes/PagSeguroLibrary/PagSeguroLibrary.php";

			//Insere as credenciais...
			$credenciais = new PagSeguroAccountCredentials('thiagobmx16@gmail.com','B7A8F25C306448EA8DCDF8D1800421DE');
			//o objeto transaction com todas as informações
			$transação = PagSeguroNotificationService::checkTransaction($credencial, $codigoNotificacao);
			//status da transação...
			$status = $transação->getStatus();

			if ($status->getValue() == 3) 
			{
				//o valor é pago e posso continuar com o código...
				$idPedido = $transação->getReference();

				//incluo o arquivo de conexão...
				include_once "../config.php";
				require_once "../classes/BD.class.php";
				BD::conn();

				$sql = "UPDATE 'loja_pedidos' SET status = '1', modificado = NOW() WHERE id = ?";
				$executarSql = BD::conn()->prepare($sql);
				$executarSql->execute(array($idPedido));

				$pegar_id_cliente = BD::conn()->prepare("SELECT id_cliente FROM 'loja_pedidos' WHERE id = ?");
				$pegar_id_cliente->execute(array($idPedido));
				$fetchCliente = $pegar_id_cliente->fetchObject();

				$pegar_dados_cliente = BD::conn()->prepare("SELECT nome, sobrenome, email FROM 'loja_clientes' WHERE id = ?");
				$pegar_dados_cliente->execute(array($fetchCliente->id));

				//manda email para o cliente...

				$msg = '
				<p>Olá senhor(a): '.$dadosCliente->nome.' '.$dadosCliente->sobrenome.' Recebemos a confirmação de pagamento de sua compra em nossa loja referente a compra do id: <strong>:'.$idPedido.'</strong></p>
				<p>Em breve seu produto será enviado para o endereço informado no cadastro, desde já agradecemos pela compra...</p>
				<p>Para melhor acompanhamento do seu pedido acesse o seu painel administrativo</p>
				';

				$destino = $dadosCliente->email;
				$site->sendMail('Informações de seu produto', $msg, 'contato@downsmaster.com', 'Loja Virtual - Faça suas compras', $destino, $dadosCliente->nome);

				//manda email para o admin...

				$mensagemAdmin = '<p>Uma nova compra foi aprovada para envio na sua loja virtual, para encontrar este pedido em seu painel pesquise pelo seguinte id: '.$idPedido.'</p>';
				$site->sendMail('Compra aprovada para envio', $mensagemAdmin, 'contato@downs,aster.com', 'Sistema Loja Virtual', 'contato@downsmaster.com', 'Administração Loja Virtual');

			}
		}
		//Se for transação...
	}
	//Se receber o request post
?>