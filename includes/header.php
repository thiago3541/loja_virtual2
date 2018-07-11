<?php
ob_start();
	session_start();
	date_default_timezone_set("America/Sao_Paulo");
	include_once "config.php";
	require_once "classes/BD.class.php";
	require_once "classes/Carrinho.class.php";
	require_once "classes/Site.class.php";
	require_once "classes/Login.class.php";

	function __autoload($classe)
	{
		if (!strstr($classe, 'PagSeguroLibrary')) 
		{
			require_once 'classes/'.$classe.'.class.php';
		}
	}

	BD::conn();	
	$site = new Site();
	$carrinho = new Carrinho();
	$login = new Login('loja_', 'loja_clientes');

	if ($login->isLogado()) 
	{
		$strSQL = "SELECT * FROM loja_clientes WHERE email_log = ? AND senha_log = ?";
		$stmt = BD::conn()->prepare($strSQL);
		$stmt->execute(array($_SESSION['loja_emailLog'], $_SESSION['loja_senhaLog']));
		$usuarioLogado = $stmt->fetchObject();
	}
	if (isset($_POST['acao']) && $_POST['acao'] == 'logar') 
	{
		$email = strip_tags(filter_input(INPUT_POST, 'email'));
		$senha = strip_tags(filter_input(INPUT_POST, 'senha'));

		if ($email == '' || $senha == '') 
		{
			echo '<script>alert("Por favor, preencha todos os campos")</script>';
		}
		else
		{
			$login->setEmail($email);
			$login->setSenha($senha);
			if ($login->logar()) 
			{
				echo '<script>alert("Login efetuado com sucesso...");location.href="'.PATH.'"</script>';
			}
			else
			{
				echo '<script>alert("Usuário não encontrado...");location.href="'.PATH.'"</script>';
			}
		}
	}
	if (isset($_GET['acao']) && $_GET['acao'] == 'sair') 
	{
		if ($login->deslogar()) 
		{
			echo '<script>alert("Você acaba de efetuar Log-out...");location.href="'.PATH.'"</script>';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf8">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH;?>/assets/css/style.css">
	<title>Loja virtual</title>
	<script type="text/javascript" src="<?php echo PATH;?>/assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo PATH;?>/assets/js/cycle.js"></script>
	<script type="text/javascript" src="<?php echo PATH;?>/assets/js/mask.js"></script>
	<script type="text/javascript" src="<?php echo PATH;?>/assets/js/funcoes.js"></script>
	<script type="text/javascript" src="<?php echo PATH;?>/assets/js/banner1.js"></script>

	<!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo PATH;?>/assets/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
	<div class="topo">
		<div class="logo">
			<a href="<?php echo PATH;?>/index.php"><img src="<?php echo PATH;?>/assets/images/logo.png"></a>
		</div>


		
		<?php
			if($login->isLogado()):
		?>
			<a href="?acao=sair">Sair</a>
			<a href="#"><img src="" border="0"/>Meus Pedidos</a>
			<a href="#"><img src="" border="0"/>Atendimento</a>
			<a href="<?php echo PATH.'/carrinho'?>"><img src="" border="0"/>(<?php echo $carrinho->qtdProdutos();?>) Produtos</a>
			<?php endif;?>
			<br>
			<span id="hours"><?php echo $site->getdata();?></span>
	</div>
	
	
	<?php
		if ($login->isLogado()) 
		{
			echo '<span id="welcome">Olá senhor(a): '.$usuarioLogado->nome.', <a href="'.PATH.'/admUser">Ir para o painel</a></span>';
		}
		else
		{
			echo '<span id="welcome">Olá visitante, não é cadastrado? <a href="'.PATH.'/cadastre-se">Cadastre-se</a></span><br>';
			echo '<span id="welcome">Olá visitante, Você não está logado, Por favor entre para usufruir de nossa loja!</span>';
		}
	?>
	<?php if(!$login->isLogado()){?>
	<form id="login" action="" method="post" enctype="multipart/form-data">
		<label><span>Email:</span><input type="text" name="email"></label>
		<label><span>Email:</span><input type="password" name="senha"></label>
		<input type="hidden" name="acao" value="logar">
		<input type="submit" value="ok">
	</form>
	<?php }?>

	<div class="menu">
		<form action="<?php echo PATH;?>" method="get" enctype="multipart/form-data">
			<label>
				<span>O que Procura?</span><br>
				<input type="text" name="s" value="" placeholder="Digite o que deseja buscar...">
			</label>
		</form>
	</div>

</body>
</html>