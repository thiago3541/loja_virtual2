<head>
	<link rel="stylesheet" type="text/css" href="<?php echo PATH;?>/assets/css/carrinho.css" />
</head>

<?php
	
	//unset($_SESSION['realizado']);
	if (isset($parametros[1]) && $parametros[1] == 'add' && isset($parametros[2]) && $parametros[2] != '0') 
	{
		$id = (int)$parametros[2];
		$carrinho->verificaAdciona($id);
	}

	if (isset($parametros[1]) && $parametros[1] == 'add' || isset($_POST['atualizar'])) 
	{
		unset($_SESSION['valor_frete']);
		foreach($_SESSION['loja_produto'] as $id => $qtd)
		{
			unset($_SESSION['valor_frete_'.$id]);
		}
	}

	if (isset($parametros[1]) && $parametros[1] == 'del' && isset($parametros[2])) 
	{
		$idDel = (int)$parametros[2];
		if ($carrinho->deletaProduto($idDel)) 
		{
			echo '<script>alert("Produto deletado do carrinho");location.href="'.PATH.'/carrinho"</script';
		}
		else
		{
			echo '<script>alert("Erro ao deletar produto do carrinho");location.href="'.PATH.'/carrinho"</script';
		}
	}

	if (isset($_POST['atualizar'])) 
	{
		unset($_SESSION['valor_frete']);
		$produto = $_POST['prod'];
		print_r($produto);
		foreach($produto as $chave => $qtd)
		{
			$selecionar_produto = BD::conn()->prepare("SELECT estoque FROM loja_produtos WHERE id = ?");
			$selecionar_produto->execute(array($chave));
			$fetchProd = $selecionar_produto->fetchObject();
			if ($qtd > $fetchProduto->estoque) 
			{
				echo '<p>Não é possível setar mais que: '.$fetchProduto->estoque.' produtos para comprar este produto: '.$fetchProduto->titulo.'</p>';
			}
		}

		if ($carrinho->atualizarQuantidades($produto)) 
		{
			echo '<script>alert("Quantidade foi alterada! Por favor calcule novamente o frete!");location.href="'.PATH.'/carrinho"</script>';
			$_SESSION['valor_frete'] = 0;
		}
		else
		{
			echo '<script>alert("Erro ao alterar quantidade");location.href="'.PATH.'/carrinho"</script>';
		}
	}

	//frete
	if (isset($_POST['acao']) && $_POST['acao'] == 'calcular'): 
	$frete = $_POST['frete'];
	$_SESSION['frete_type'] = $frete;
	$cep = strip_tags(filter_input(INPUT_POST, 'cep'));
	switch ($frete) 
	{
		case 'pac';
			$valor = '41106';
			$peso_total = 0;
			foreach ($_SESSION['loja_produto'] as $id => $qtd) 
			{
				$selecionar_produto = BD::conn()->prepare("SELECT peso FROM loja_produtos WHERE id = ?");
				$selecionar_produto->execute(array($id));
				$fetch_produto = $selecionar_produto->fetchObject();

				$_SESSION['valor_frete_'.$id] = $carrinho->calculaFrete($valor, 18134240, $cep, $fetch_produto->peso);
				
			}
			
		break;

		case 'sedex';
		{
			$valor = '40010';
			$peso_total = 0;
			foreach ($_SESSION['loja_produto'] as $id => $qtd) 
			{
				$selecionar_produto = BD::conn()->prepare("SELECT peso FROM loja_produtos WHERE id = ?");
				$selecionar_produto->execute(array($id));
				$fetch_produto = $selecionar_produto->fetchObject();

				$_SESSION['valor_frete_'.$id] = $carrinho->calculaFrete($valor, 18134240, $cep, $fetch_produto->peso);
				
			}
		}
		break;
	}
	endif;

	$_SESSION['valor_frete'] = 0;
	foreach($_SESSION['loja_produto'] as $id => $qtd)
	{
		$_SESSION['valor_frete_'.$id] = str_replace(",",".",$_SESSION['valor_frete_'.$id]);
		$_SESSION['valor_frete_'.$id] = $_SESSION['valor_frete_'.$id]*$qtd;

		$_SESSION['valor_frete'] += $_SESSION['valor_frete_'.$id];
	}
?>

<div class="carrinho-page">
	<h1 class="title-page">Minhas Compras</h1>
	<hr>

	<form action="<?php echo PATH.'/carrinho/atualizar';?>" method="post" enctype="multipart/form-data">
		<table border="1" cellpadding="0" cellspacing="0" class="carrinho">
			<thead>
				<tr>
					<th>Produto</th>
					<th>Quantidade</th>
					<th>Valor Unitário</th>
					<th>Sub-Total</th>
					<th>Remover</th>
				</tr>
			</thead>

			<tbody>
				<?php
					if ($carrinho->qtdProdutos() == 0) 
					{
						echo '<tr><td colspan="5">Não existem produtos em seu carrinho!</td></tr>';
					}
					else
					{
						$total = 0;
						foreach ($_SESSION['loja_produto'] as $id => $quantidade) 
						{
							$id = (int)$id;
							$selecao = BD::conn()->prepare("SELECT * FROM loja_produtos WHERE id = ?");
							$selecao->execute(array($id));
							$fetchProduto = $selecao->fetchObject();
				?>
				<tr>
					<td><?php echo $fetchProduto->titulo;?></td>
					<td><input type="text" name="prod[<?php echo $id;?>]" size="3" value="<?php echo $quantidade;?>"/><br><br>
					<input type="submit" value="Atualizar Quantidades" id="update" name="atualizar"></td>
					<td class="unitario">R$ <?php echo number_format($fetchProduto->valor_atual, 2,',','.');?></td>
					<td class="sub">R$ <?php echo number_format($fetchProduto->valor_atual * $quantidade, 2,',','.');?></td>
					<td><a href="<?php echo PATH.'/carrinho/del/'.$id;?>" title="Deletar Produto"><img src="<?php echo PATH;?>/assets/images/del.png" border="0" alt=""></a></td>
				</tr>

				<?php $total += $fetchProduto->valor_atual * $quantidade;}}?>

				<tr>
					<td colspan="4" align="right" class="last">Total</td>
					<td class="total last">R$ <?php echo (isset($_SESSION['valor_frete'])) ? number_format($total+$_SESSION['valor_frete'],2,',','.') : number_format($total,2,',','.');?></td>
				</tr>
			</tbody>
		</table>
	</form>

	<div class="opcoes">
		<div class="outros">

			<span class="resultado-frete">Valor do frete: 
			<?php echo ($_SESSION['valor_frete'] == '6,00 ') ? number_format($_SESSION['valor_frete'],2,',','.') : $_SESSION['valor_frete'];?></span>
			<a href="<?php echo PATH.'/verificar';?>" class="finalizar">Finalizar Compra</a>
			<a href="<?php echo PATH;?>" class="continuar">Continuar comprando</a>
		</div>
		<div class="calcular">
			<form action="<?php echo PATH.'/carrinho';?>" method="post" enctype="multipart/form-data">
				<label>
					<span>Escolha a foma de envio</span>
					<select name="frete">
						<option value="">Selecione...</option>
						<option value="carta">CARTA REGISTRADA</option>
						<option value="pac">PAC</option>
						<option value="sedex">SEDEX</option>
					</select>
				</label>
				<label>
					<span>Seu CEP</span>
					<input type="hidden" name="acao" value="calcular">
					<input type="text" name="cep">
					<input type="submit" value="calcularFrete">
				</label>
			</form>
		</div>
	</div>
</div>
<?php
	(isset($_SESSION['valor_frete'])) ?
	$_SESSION['total_compra'] = $total+$_SESSION['valor_frete']: 
	$total = str_replace(",", ".", $total);
	$_SESSION['total_compra'] = $total;
?>

