<?php
	include_once "includes/header.php";
?>

<!DOCTYPE>
<html>
	<head>
		<meta charset = "utf8">
		<title>Single</title>

		<script type="text/javascript" src="../assets/js/shadowbox/jquery.js" ></script>
		<script type="text/javascript" src="<?php echo PATH;?>/assets/js/shadowbox/shadowbox.js" ></script>
		<link rel="stylesheet" type="text/css" href="<?php echo PATH;?>/assets/js/shadowbox/shadowbox.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo PATH;?>/assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo PATH;?>/assets/css/single.css">
		<link rel="stylesheet" type="text/css" href="<?php echo PATH;?>/assets/css/style.css">

		<script type="text/javascript">
			Shadowbox.init
			({
			  language: 'pt',
			  players: ['img'],
			});
		</script>

		<!-- Bootstrap -->
    	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>


	<?php
		$pegar_slug = strip_tags(trim($parametros[1]));

		$selecionar_produto = "SELECT * FROM loja_produtos WHERE slug = ?";
		$executar = BD::conn()->prepare($selecionar_produto);
		$executar->execute(array($pegar_slug));

		$fetch_produto = $executar->fetchObject();

		//Pegar mais imagens do produto
		$sqlPegar = "SELECT * FROM loja_imgprod WHERE id_produto = ?";
		$executarImg = BD::conn()->prepare($sqlPegar);
		$executarImg->execute(array($fetch_produto->id));
	?>

		<div class="geral">
			<div class="geral-left">
				<div class="img-big">
					<a id="" title="Imagem big" href="<?php echo PATH;?>/assets/images/produtos/<?php echo $fetch_produto->img_padrao;?>" rel="shadowbox[vocation];width=500">
					<img src="<?php echo PATH;?>/assets/images/produtos/<?php echo $fetch_produto->img_padrao;?>" width="100%" height="200"/></a>
				</div>

				<!-- Aqui vou ultiliar ul futuramente -->

				<?php
					if($executarImg->rowCount() == 0)
					{
						echo '<p>Desculpe, não existem mais imagens deste produto!</p>';
					}
					else
					{
				?>

				<div id="gallery">
					<?php
						while($imgProd = $executarImg->fetchObject())
						{
					?>
					<a id="" title="Produto 1" href="<?php echo PATH;?>/assets/images/produtos/<?php echo $fetch_produto->img_padrao;?>" rel="shadowbox[vocation];width=500">
					<img src="<?php echo PATH;?>/assets/images/produtos/<?php echo $fetch_produto->img_padrao;?>" width="90" height="90"/></a>
					<?php }?>
				</div>
				<?php }?>

				<a href="#" id="enviar_amigo"></a>
			</div>

			<div class="geral-right">
				<h1 class="title"><?php echo $fetch_produto->titulo;?></h1>

				<form action="<?php echo PATH.'/carrinho/atualizar';?>" method="post" enctype="multipart/form-data">
					<div class="dados-produto">
						<div class="qtd">
							<label>
								<span>Quantidade</span>
								<input id="qtd" type="text" name="prod[<?php echo $fetch_produto->id;?>]" value="1">
								<input type="submit" value="" name="comprar" id="btn-buy">
							</label>
						</div>
						<span class="de">de: <strike>R$ <?php echo number_format($fetch_produto->valor_anterior,2,',','.');?></strike></span>
						<span class="por">Por: R$ <?php echo number_format($fetch_produto->valor_atual,2,',','.');?></span>

						<span class="parcelas">Em até 12x sem juros no cartão</span>
						<span class="exemplares">Vendidos: 0 unidades</span>
					</div>
				</form>

				<h2 class="related">Produtos Relacionados</h2>

					
					<div id="related">

					<?php
						$pegar_relacionado = "SELECT id, img_padrao, titulo, slug, valor_atual FROM loja_produtos WHERE subcategoria = ? AND id != ? ORDER BY id DESC LIMIT 4";
						$execRel = BD::conn()->prepare($pegar_relacionado);
						$execRel->execute(array($fetch_produto->subcategoria, $fetch_produto->id));

						if ($execRel->rowCount() == 0)
						{
							echo '<p>Não encontramos nenhum produto relacionado a este!</p>';
						}
						else
						{
							while($prod_rel = $execRel->fetchObject())
							{
					?>

						<div class="prod_rel">
							<a href="<?php echo PATH.'/produto/'.$prod_rel->slug;?>" title="">
								<span class="title"><?php echo $prod_rel->titulo;?></span>
								<br>
								<img src="<?php echo PATH;?>/assets/images/produtos/<?php echo $fetch_produto->img_padrao;?>" width="90%" height="80%" border="0" title="" alt="" />
								<span class="preco">Por: R$ <?php echo number_format($prod_rel->valor_atual,2,',','.');?></span>
							</a>
							<a href="<?php echo PATH;?>/carrinho/add/<?php echo $prod_rel->id;?>" id="cart"></a>
						</div>
					<?php }}?>
					</div>
			</div>
		</div>

		<div class="divider"></div>

		<h1 class="title-dados">Dados do Produto</h1>

		<div class="divider"></div>

		<div class="content-dados-produto">
		<?php echo html_entity_decode($fetch_produto->descricao);?>
		</div>

		<script src="assets/js/bootstrap.min.js"></script>

    	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	</body>
</html>

<?php
	include "includes/footer.php";
?>
