<?php
	include_once "includes/header.php";
?>

<div class="conteudo">
	<?php
		$url = (isset($_GET['url'])) ? htmlentities(strip_tags($_GET['url'])) : '';

		//mostra o caminho que o usuário quer acessar em forma de array...
		$parametros = explode('/', $url);

		//Paginas permitidas do meu site...
		$paginas_permitidas = array('login','produto','carrinho','verificar','finalizar','cadastre-se');
		
		// Se existir um get ele vai pra pagina de busca...
		if (isset($_GET['s']) && $_GET['s']  != '')
		{
			include_once "pages/busca.php";
		}
		//senão
		else
		{
			//Se a url for vazia ele redireciona para a página Home...
			if ($url == '') 
			{
				include_once "pages/home.php";
			}
			//Senao
			//Se existir um primeiro parâmetro e este estiver dentro das páginas que eu defini como permitidas
			//ele redireciona para a página em questão...
			else if(in_array($parametros[0], $paginas_permitidas))
			{
				include_once "pages/".$parametros[0].'.php';
			}
			//Senão, ele redireciona um Erro...
			elseif ($parametros[0] == 'categoria') 
			{
				if (isset($parametros[1]) && !isset($parametros[2])) 
				{
					include_once "pages/categoria.php";
				}
				elseif (isset($parametros[2])) 
				{
					include_once "pages/subcategoria.php";
				}
			}
			else
			{
				include_once "pages/erro404.php";
			}
		}
	?>
</div>


<?php
	include_once "includes/footer.php";
?>


