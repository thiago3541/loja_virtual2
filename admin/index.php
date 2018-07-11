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
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen">
</head>
<body>
	<div id="box_log">
		<h1>Efetuar Login</h1>

		<?php
			if (isset($_POST['acao']) && $_POST['acao'] == 'entrar'):
				$email = strip_tags(filter_input(INPUT_POST, 'email'));
				$senha = strip_tags(filter_input(INPUT_POST, 'senha'));

				if ($email == '' || $senha == '')
				{
					echo '<div class="aviso">Preencha todos os campos, por favor</div>';
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
						echo '<div class="aviso">Erro, usuário não encontrado, Provavelmente o usuário ou a senha estão incorretos</div>';
					}
				}
			endif;
		?>

		<?php if (!$login->isLogado()) 
		{
		?>

		<div class="aviso">
			<p>Para você fazer Login nessa página, é necessário que tenha um acesso liberado como administrador do site!</p>
		</div>

		<?php }?>
		<form action="" method="post" enctype="multipart/form-data">
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