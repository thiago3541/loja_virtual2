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
						<?php
							$pegar_categoria = htmlentities($parametros[1]);
							$pegar_subcategoria = htmlentities($parametros[2]);

							$sql = "SELECT * FROM loja_produtos WHERE categoria = ? AND subcategoria = ? ORDER BY id DESC";
							$executar_sub = BD::conn()->prepare($sql);
							$executar_sub->execute(array($pegar_categoria, $pegar_subcategoria));

							$produto = $executar_sub->fetchObject();
						?>
						<h1><?php echo $produto->subcategoria;?><br><hr></br></h1>
					</div>
				</div>

				<?php

					$pg = (isset($_GET['pagina'])) ? (int)htmlentities($_GET['pagina']) : '1';
					$maximo = '9'; //Numero de posts por página
					$inicio = (($pg * $maximo) - $maximo);

					$pegar_categoria = htmlentities($parametros[1]);
					$pegar_subcategoria = htmlentities($parametros[2]);

					$site->atualizarViewSub($pegar_subcategoria);
					
					$sql = "SELECT * FROM loja_produtos WHERE categoria = ? AND subcategoria = ? ORDER BY id DESC";
					$executar_sub = BD::conn()->prepare($sql);
					$executar_sub->execute(array($pegar_categoria, $pegar_subcategoria));

					if ($executar_sub->rowCount() == 0) 
					{
						echo '<p align="center">Não existem produtos nesta categoria</p>';
					}
					else
					{
						while ($produto = $executar_sub->fetchObject()) 
						{
				?>

				<div class="row">
					<div class="col-md-4">
						<div class="produtos-box">
							<a href="<?php echo PATH.'/produto/'.$produto->slug;?>" title="<?php echo $produto->titulo;?>">
								<img src="<?php echo PATH;?>/assets/images/produtos/<?php echo $produto->img_padrao;?>" border="0" title="<?php echo $produto->titulo;?>" alt="" />
								<span class="title"><?php echo $produto->titulo;?></span>
								<br>
								<span class="preco">Por: <?php echo number_format($produto->valor_atual, 2,',','.');?></span>
							</a>
							<a href="<?php echo PATH.'/carrinho/add/'.$produto->id;?>" id="cart"></a>
						</div>
					</div>
				
				<?php }}?>
			</div>

			<div id="paginator">
				<?php
					$sql_res = BD::conn()->prepare("SELECT * FROM loja_produtos WHERE categoria = ? AND subcategoria = ?");
					$sql_res->execute(array($pegar_categoria, $pegar_subcategoria));
					$total = $sql_res->rowCount();
					$pags = ceil($total/$maximo);
					$links = 'S';

					echo '<span class="page">Página: '.$pg.' de '.$pags.'</span>';
					for($i = $pg-$links; $i<=$pg-1; $i++)
					{
						if ($i<=0) 
						{
							
						}
						else
						{
							echo '<a href="'.PATH.'/categoria/'.$pegar_categoria.'$pagina='.$i.'">'.$i.'</a>';
						}
					}
					
					echo '<strong>'.$pg.'</strong>';

					for($i = $pg+1; $i<=$pg+$links; $i++)
					{
						if ($i>pags) 
						{
							
						}
						else
						{
							echo '<a href="'.PATH.'/categoria/'.$pegar_categoria.'$pagina='.$i.'">'.$i.'</a>';
						}
					}
					echo '<a href="'.PATH.'/categoria/'.$pegar_categoria.'$pagina='.$i.'">Última Página</a>';
				?>
			</div>
		</div>
	</div>
</div>

						