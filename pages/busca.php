<head>
	<link rel="stylesheet" type="text/css" href="assets/css/busca.css">

	<!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<h1 class="title-page">Resultados da Pesquisa</h1>

<div class="content_erro">
	<div id="content_produtos" class="page_erro">
<div id="produtos">

<?php
$pesquisa = strip_tags(trim(htmlentities($_GET['s'])));

	if ($_GET['s'] != '') 
	{
		$explode = explode(' ', $_GET['s']);
		$num = count($explode);
		$busca = '';

		for($i = 0; $i < $num; $i++)
		{	
			$busca .= "'titulo' LIKE :busca";
			if($i<>$num-1){$busca .= 'AND';}
		}
		$pg = (isset($_GET['pagina'])) ? (int)htmlentities($_GET['pagina']) : '1';
		$maximo = '9';
		$inicio = (($pg * $maximo) - $maximo);
		$buscar = BD::conn()->prepare("SELECT * FROM loja_produtos WHERE $busca LIMIT $inicio, $maximo");
		for($i = 0; $i < $num; $i++)
		{
			$buscar->bindValue(":busca", '%', PDO::PARAM_STR);
		}
		$buscar->execute();
	}//se a busca for diferente que vazio...

	if ($buscar->rowCount() > 0) 
	{	
	echo '<p id="aviso">Sua busca retornou '.$buscar->rowCount().' resultados</p>';
	echo '<div id="produtos">';
		while ($resultado = $buscar->fetchObject()) 
		{
?>

	<div class="produto_box_erro">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					
				</div>
			</div>

			<div class="produtos-box">
				<div class="row">
					<div class="col-md-4">
						<a href="<?php echo PATH;?>/produto/<?php echo $resultado->slug;?>" title="<?php echo $resultado->titulo;?>">
							<div class="imgProd erro">
								<img src="<?php echo PATH;?>/produtos/<?php echo $resultado->img_padrao;?>"  border="0" title="<?php echo $resultado->titulo;?>" alt="">
							</div>
							<span class="title"><?php echo $resultado->titulo;?></span>
							<span class="preco">Por: R$ <?php echo number_format($resultado->valor_atual, 2,',','.');?></span>
						</a>
						<a href="<?php echo PATH;?>/carrinho/add/<?php echo $resultado->id;?>" id="cart"></a>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
		}
	}
?>

</div>

<div class="paginator">
	<?php
		$sql_res = BD::conn()->prepare("SELECT id FROM 'loja_produtos' WHERE $busca");
		for($i=0; $i<$num; $i++)
		{
			$sql_res->bindValue(":busca", '%'.$explode[$i].'%', PDO::PARAM_STR);
		}
		$sql_res->execute();
		$total = $sql_res->rowCount();
		$pags = cell($total/$maximo);
		$links = 'S';

		echo '<span class="page">Página: '.$pg.' de '.$pags.'</span>';
		for($i = $pg->$links; $i<=$pg-1; $i++)
		{
			if ($i<=0){}
			else 
			{
				echo '<a href="'.PATH.'/?s='.$pesquisa.'$pagina='.$i.'">'.$i.'</a>';
			}
		}
		echo '<strong>'.$pg.'</strong>';

		for($i = $pg+1; $i<=$pg+$links; $i++)
		{
			if ($i>$pags){}
			else
			{
				echo '<a href="'.PATH.'/?s='.$pesquisa.'$pagina='.$i.'">'.$i.'</a>';
			}
		}
		echo '<a href="'.PATH.'/?s='.$pesquisa.'$pagina='.$pags.'">Última Página</a>';
	?>
</div>

</div>
</div>
		