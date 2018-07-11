<head>
	<link rel="stylesheet" type="text/css" href="../assets/css/page404.css">
	

	<!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<h1 class="title-page">Ops, o que você procura não está aqui!</h1>
<div class="content-erro">
	<p>O que você procura infelizmente não está aqui, mas não se preocupe,
	 temos vários produtos que você pode se interessar...</p>
	 <p>Confira...</p>

	<div class="produtos-right">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					
				</div>
			</div>

			<?php
				foreach($site->getProdutosHome(6) as $produto)
				{
			?>

				<div class="row">
					<div class="col-md-4">
						<div class="produtos-box">
							<a href="">
								<img src="<?php echo PATH;?>/assets/images/produtos/<?php echo $produto['img_padrao'];?>" border="0" title="<?php echo $produto['titulo'];?>" alt="" />
								<span class="title"><?php echo $produto['titulo'];?></span>
								<br>
								<span class="preco">Por: R$ <?php echo number_format($produto['valor_atual'], 2,',','.');?></span>
							</a>
							<a href="<?php echo PATH.'/carrinho/add/'.$produto['id'];?>" id="cart"></a>
						</div>
					</div>
				</div>	
				<?php };?>
		</div>
	</div>	
</div>

