<?php include_once "inc/header.php";?>
<?php include_once "inc/sidebar.php";?>
		
<div class="conteudo-painel">
	<?php
		if(!isset($_GET['pagina']) || $_GET['pagina'] == '')
		{
			include_once "pages/home.php";
		}
		else
		{
			$pagina = strip_tags($_GET['pagina']);
			if(file_exists('pages/'.$pagina.'.php'))
			{
				include_once "pages/$pagina".'.php';
			}
			else
			{
				echo '<p>Desculpe mas a página que você procura não existe</p>';
			}
		}
	?>
</div>
			

<div style="clear:both;"></div>
</div>
</body>
</html>