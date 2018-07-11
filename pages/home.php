<head>
	<script type="text/javascript" src="assets/js/banner1.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">

	<!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="paginator">
				<div class="bolinha" onclick="mudarSlide(0)"></div>
				<div class="bolinha" onclick="mudarSlide(1)"></div>
				<div class="bolinha" onclick="mudarSlide(2)"></div>
				<div class="bolinha" onclick="mudarSlide(3)"></div>
			</div>

			<div class="divslider" id="slideshow">
				<div class="divsliderarea">
					<div class="slide" style="background-image:url('assets/images/banner/iphone.jpg')"></div>
					<div class="slide" style="background-image:url('assets/images/banner/lgq3.jpg')"></div>
					<div class="slide" style="background-image:url('assets/images/banner/iphone6.jpg')"></div>
					<div class="slide" style="background-image:url('assets/images/banner/notebook asus.jpg')"></div>
					<div class="slide" style="background-image:url('assets/images/banner/banner.jpg')"></div>
				</div>
			</div>

			

			<div class="segundobloco">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<span>Apresentação dos principais produtos</span>
							<hr>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="video1">
								<h2>Galaxy S8</h2>
								<video width="400" height="300" controls>
									<source src="assets/videos/galaxys8.mp4" type="video/mp4">
								</video>
							</div>
						</div>

						<div class="col-md-4">
							<div class="video2">
								<h2>Iphone 8</h2>
								<video width="400" height="300" controls>
									<source src="assets/videos/iphone8.mp4" type="video/mp4">
								</video>
							</div>
						</div>

						<div class="col-md-4">
							<div class="video3">
								<h2>Lg Q6</h2>
								<video width="400" height="300" controls>
									<source src="assets/videos/lgq6.mp4" type="video/mp4">
								</video>
							</div>
						</div>
					</div>
				</div>
			</div>


			
			<div class="produtos">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">

						</div>
					</div>

					<div class="produtos-left">
						<div class="row">
							<div class="col-md-4">
								<?php
									include_once "includes/sidebar-menu.php";
								?>
							</div>
						</div>
					</div>

					<div class="produtos-right">
						<div class="container">
							<div class="row">
								<div class="col-xs-12">
									<h1>Produtos em destaque <br><small>Conheça alguns dos nossos produtos</small></br></h1>
								</div>
							</div>

							<?php
								foreach($site->getProdutosHome(3) as $produto)
								{
							?>

							<div class="row">
								<div class="col-md-4">
									<div class="produtos-box">
										<a href=""> <?php //<?php echo PATH.'/produto/'.$produto['slug'];" title="<?php echo $produto['titulo'];?>
											<img src="<?php echo PATH;?>/assets/images/produtos/<?php echo $produto['img_padrao'];?>" border="0" title="<?php echo $produto['titulo'];?>" alt="" />
											<span class="title"><?php echo $produto['titulo'];?></span>
											<br>
											<span class="preco">Por: R$ <?php echo number_format($produto['valor_atual'], 2,',','.');?></span>
										</a>
										<a href="<?php echo PATH.'/carrinho/add/'.$produto['id'];?>" id="cart"></a>
									</div>
								</div>
							<?php };?>
							</div>
							
						</div>	
					</div>
				</div>
			</div>
	</div>

	<div class="videos">

	</div>

	<script src="assets/js/bootstrap.min.js"></script>

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
 </body>
