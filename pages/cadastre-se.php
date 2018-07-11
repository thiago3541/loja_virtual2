<h1 class="title-page">Faça o seu cadastro e nossa loja</h1>
<?php if(isset($_POST['acao']) && $_POST['acao'] == 'cadCliente')
{
	$nome = strip_tags(filter_input(INPUT_POST, 'nome'));
	$sobrenome = strip_tags(filter_input(INPUT_POST, 'sobrenome'));
	$email = strip_tags(filter_input(INPUT_POST, 'email'));
	$nome = strip_tags(filter_input(INPUT_POST, 'nome'));
	$telefone = strip_tags(filter_input(INPUT_POST, 'telefone'));
	$cpf = strip_tags(filter_input(INPUT_POST, 'cpf'));
	$cpf = preg_replace("/[^0-9]/", "", $cpf);
	$rua = strip_tags(filter_input(INPUT_POST, 'rua'));
	$numero = strip_tags(filter_input(INPUT_POST, 'numero'));
	$complemento = strip_tags(filter_input(INPUT_POST, 'complemento'));
	$bairro = strip_tags(filter_input(INPUT_POST, 'bairro'));
	$cidade = strip_tags(filter_input(INPUT_POST, 'cidade'));
	$uf = strip_tags(filter_input(INPUT_POST, 'uf'));
	$cep = strip_tags(filter_input(INPUT_POST, 'cep'));
	$cep = preg_replace("/[^0-9]/", "", $cep);
	$emailLog = strip_tags(filter_input(INPUT_POST, 'emailLog'));
	$senhaLog = strip_tags(filter_input(INPUT_POST, 'senhaLog'));

	$val = new Validacao();
	$val->set($nome, 'Nome')->obrigatorio();
	$val->set($sobrenome, 'Sobrenome')->obrigatorio();
	$val->set($email, 'Email')->isEmail();
	$val->set($telefone, 'Telefone')->isTel();
	$val->set($cpf, 'Cpf')->isCpf();
	$val->set($rua, 'Rua')->obrigatorio();
	$val->set($numero, 'Numero')->obrigatorio();
	$val->set($complemento, 'Complemento')->obrigatorio();
	$val->set($bairro, 'Bairro')->obrigatorio();
	$val->set($cidade, 'Cidade')->obrigatorio();
	$val->set($uf, 'Uf')->obrigatorio();
	$val->set($cep, 'Cep')->obrigatorio();
	$val->set($emailLog, 'Email de Login')->isEmail();
	$val->set($senhaLog, 'Senha de Login')->obrigatorio();

	if (!$val->validar()) 
	{
		$erros = $val->getErro();
		echo '<p id="aviso">'.$erros[0].'</p>';
	}
	else
	{
		$verificarUsuario = BD::conn()->prepare("SELECT id_cliente FROM loja_clientes WHERE email_log = ?");
		$verificarUsuario->execute(array($emailLog));
		if($verificarUsuario->rowCount() > 0)
		{
			echo '<p id="aviso">Já existe um usuário com este email de Login, por favor cadastre outro.</p>';
		}
		else
		{
			$dados = array(
				'nome' => $nome,
				'sobrenome' => $sobrenome,
				'email' => $email,
				'telefone' => $telefone,
				'cpf' => $cpf,
				'rua' => $rua,
				'numero' => $numero,
				'complemento' => $complemento,
				'bairro' => $bairro,
				'cidade' => $cidade,
				'uf' => $uf,
				'cep' => $cep,
				'email_log' => $emailLog,
				'senha_log' => $senhaLog);
			if($site->inserir('loja_clientes', $dados))
			{
				if (isset($_SESSION['valor_frete'])) 
				{
					echo '<script>alert("Cadastro realizado com sucesso, agora você irá para a página de login para efetuar sua compra");location.href="'.PATH.'/verificar"';
				}
				else
				{
					echo '<p id="ok">Seu cadastro foi realizado com sucessso em nosso site!</p>';
				}
			}
		}
	}
}

?>

<head>
	<link rel="stylesheet" type="text/css" href="assets/css/cadastro-cliente.css">
</head>

<input type="hidden" name="acao" value="cadCliente">
<input type="submit" value="Cadastrar Cliente" class="cadastrar">

<div id="cadastro_cliente">
	<form action="" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>Dados Pessoais</legend>

			<label>
				<span>Nome</span>
				<input type="text" name="nome" class="name">
			</label>

			<label>
				<span>Sobrenome</span>
				<input type="text" name="sobrenome" class="sobrenome">
			</label>

			<label>
				<span>E-mail</span>
				<input type="text" name="email">
			</label>

			<label>
				<span>Telefone</span>
				<input type="text" name="telefone" id="tel">
			</label>

			<label>
				<span>CPF</span>
				<input type="text" name="cpf" id="cpf">
			</label>
		</fieldset>
		
		<fieldset>
			<legend>Endereço</legend>

			<label>
				<span>Rua</span>
				<input type="text" name="rua">
			</label>

			<label>
				<span>Numero</span>
				<input type="text" name="numero">
			</label>

			<label>
				<span>Complemento</span>
				<input type="text" name="complemento">
			</label>

			<label>
				<span>Bairro</span>
				<input type="text" name="bairro">
			</label>

			<label>
				<span>Cidade</span>
				<input type="text" name="cidade">
			</label>

			<label>
				<span>Uf</span>
				<input type="text" name="uf">
			</label>

			<label>
				<span>Cep</span>
				<input type="text" name="cep" id="cep">
			</label>
		</fieldset>

		<fieldset>
			<legend>Dados de Login</legend>

			<label>
				<span>Email-log</span>
				<input type="text" name="email-log">
			</label>

			<label>
				<span>Senha-log</span>
				<input type="text" name="senha-log">
			</label>

			<label>
				<span>Data-log</span>
				<input type="text" name="data-log">
			</label>
		</fieldset>

		
	</form>
</div>