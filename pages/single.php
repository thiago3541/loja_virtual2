<?php
	include_once "includes/header.php";
?>

<!DOCTYPE>
<html>
	<head>
		<meta charset = "utf8">
		<title>Single</title>

		<script type="text/javascript" src="../assets/js/shadowbox/jquery.js" ></script>
		<script type="text/javascript" src="../assets/js/shadowbox/shadowbox.js" ></script>
		<link rel="stylesheet" type="text/css" href="../assets/js/shadowbox/shadowbox.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/single.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/style.css">

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
		<div class="geral">
			<div class="geral-left">
				<div class="img-big">

				</div>

				<!-- Aqui vou ultiliar ul futuramente -->

				<div id="gallery">
					<a id="" title="Produto 1" href="../assets/images/produtos/imagem-big.jpg" rel="shadowbox[vocation];width=500">
					<img src="../assets/images/produtos/imagem-big.jpg" width="90" height="90"/></a>

					<a id="" title="Produto 1" href="../assets/images/produtos/imagem-big.jpg" rel="shadowbox[vocation];width=500">
					<img src="../assets/images/produtos/imagem-big.jpg" width="90" height="90"/></a>

					<a id="" title="Produto 1" href="../assets/images/produtos/imagem-big.jpg" rel="shadowbox[vocation];width=500">
					<img src="../assets/images/produtos/imagem-big.jpg" width="90" height="90"/></a>

					
					
				</div>

				<a href="#" id="enviar_amigo"></a>
			</div>

			<div class="geral-right">
				<h1 class="title">Dados de venda do Produto 1</h1>

				<div class="dados-produto">
					<div class="qtd">
						<label>
							<span>Quantidade</span>
							<input id="qtd" type="text" name="qtd[]" value="1">
							<input type="submit" value="" name="comprar" id="btn-buy">
						</label>
					</div>
					<span class="de">de: R$ 00,00</span>
					<span class="por">Por: R$ 00,00</span>

					<span class="parcelas">Em até 12x sem juros no cartão</span>
					<span class="exemplares">Vendidos: 0 unidades</span>
				</div>

				<h2 class="related">Produtos Relacionados</h2>

					
					<div id="related">
						<div class="prod_rel">
							<a href="#" title="">
								<img src="../assets/images/produtos/produto1.png" border="0" title="" alt="" />
								<span class="title">PRODUTO 1</span>
								<br>
								<span class="preco">Por: R$ 00,00</span>
							</a>
							<a href="#" id="cart"></a>
						</div>

						<div class="prod_rel">
							<a href="#" title="">
								<img src="../assets/images/produtos/produto1.png" border="0" title="" alt="" />
								<span class="title">PRODUTO 1</span>
								<br>
								<span class="preco">Por: R$ 00,00</span>
							</a>
							<a href="#" id="cart"></a>
						</div>

						<div class="prod_rel">
							<a href="#" title="">
								<img src="../assets/images/produtos/produto1.png" border="0" title="" alt="" />
								<span class="title">PRODUTO 1</span>
								<br>
								<span class="preco">Por: R$ 00,00</span>
							</a>
							<a href="#" id="cart"></a>
						</div>

						<div class="prod_rel">
							<a href="#" title="">
								<img src="../assets/images/produtos/produto1.png" border="0" title="" alt="" />
								<span class="title">PRODUTO 1</span>
								<br>
								<span class="preco">Por: R$ 00,00</span>
							</a>
							<a href="#" id="cart"></a>
						</div>

					</div>
			</div>
		</div>

		<div class="divider"></div>

		<h1 class="title-dados">Dados do Produto</h1>

		<div class="divider"></div>

		<div class="content-dados-produto">

		</div>

		<script src="assets/js/bootstrap.min.js"></script>

    	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	</body>
</html>

<?php
	include "../includes/footer.php";
?>
