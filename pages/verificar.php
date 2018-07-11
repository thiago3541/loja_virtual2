<?php		

	if ($login->isLogado()) 
	{
		header("Location: ".PATH."/finalizar");
	}
	else
	{
		if (isset($_POST['acao']) && $_POST['acao'] == 'logar'): 
		
			$email = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
			$senha = strip_tags(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));

			if ($email == '' || $senha == '')
			{
				echo '<script>alert("Por favor, preencha todos os campos...");
										 location.href="'.PATH.'/verificar"</script>';
			}
			else
			{
				$login->setEmail($email);
				$login->setSenha($senha);

				if ($login->logar()) 
				{
					header("Location: ".PATH."/finalizar");
				}
				else
				{
					echo '<script>alert("Desculpe, mas o usuário informado não foi encontrado");
										 location.href="'.PATH.'/verificar"</script>';

				}
			}
		endif;
	}
?>

<head>
	<link rel="stylesheet" type="text/css" href="<?php echo PATH;?>/assets/css/verificar.css" />
</head>

<div class="title">
	<span class="titulo">Cadastro</span><br>
	<span class="subtitulo">Você precisa ter um cadastro para continuar...</span>
</div>

<div id="verification">
	<div class="text">
		<span class="spn-title">Ainda não é cadastrado?</span>
		<p>Se você ainda não é cadastrado em nossa loja, por favor, cadastre-se para prosseguir...</p>
		<p><a href="<?php echo PATH;?>/cadastre-se">Clicando Aqui</a></p>
	</div>

	<div class="logar">
		<span class="spn-title">Já é cadastrado? faça login</span>
		<form action="" method="post" enctype="multipart/form-data">
			<label>
				<span>E-mail</span>
				<input class="email" type="text" name="email">
			</label>

			<br>

			<label>
				<span>Senha</span>
				<input class="senha" type="password" name="senha">
				<input type="hidden" name="acao" value="logar">
				<input class="submit" type="submit" value="Efetuar Login">
			</label>

			<br>

			
			<br>
			<a href="#">Esqueceu sua senha?</a>
		</form>
	</div>
</div>