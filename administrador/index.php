<?php
	session_start();
	function __autoload($classe)
	{
		require_once "../classes/$classe".'.class.php';
	}
	include_once "../config.php";
	BD::conn();
	$login = new Login('adm_', 'loja_adm');

	if ($login->isLogado()) 
	{
		header("Location: painel/index.php");
	}
?>
<html>
<head>
	<title>Página de Login</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
	<div class="box-log">
		<h1>Efetuar Login</h1>

		<?php
			if (isset($_POST['acao']) && $_POST['acao'] == 'entrar'): 
			{
				$email = strip_tags(filter_input(INPUT_POST, 'email'));
				$senha = strip_tags(filter_input(INPUT_POST, 'senha'));
				if ($email == '' || $senha == '')
				{
					echo '<div class="aviso">Preencha todos os campos por favor!</div>';
				}
				else
				{
					$login->setEmail($email);
					$login->setSenha($senha);
					if ($login->logar()) 
					{
						header("Location: painel/index.php");
					}
					else
					{
						echo '<div class="aviso">Erro, usuário não encontrado na base de dados!</div>';
					}
				}
			}
			endif;
		?>


		<?php if (!$login->isLogado()){?>
		<div class="aviso">
			<p>Para você acessar o painel você precisa ter um acesso como administrador</p>
		</div>
		<?php }?>
		<form action="" method="post" enctype="multpart/form-data">
			<label>
				<span>Email</span>
				<input type="text" name="email">
			</label>

			<label>
				<span>Senha</span>
				<input type="password" name="senha">
			</label>

			<input type="hidden" name="acao" value="entrar">
			<input type="submit" value="Logar">
		</form>
	</div>
</body>
</html>