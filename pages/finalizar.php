<link rel="stylesheet" type="text/css" href="assets/css/finalizar.css" />
<!DOCTYPE>
<h1>Finalizar Compra</h1>

<form method="POST" id="form">
	<fieldset id="el##">
		<legend>Informações do Usuário:</legend>
		Nome:<br>
		<input type="text" name="nome"><br><br>

		Email: <br>
		<input type="email" name="email"><br><br>

		Senha: <br>
		<input type="password" name="senha"> <br><br>

		Telefone: <br>
		<input type="text" name="ddd"> <input type="text" name="telefone">

	</fieldset>
	<br>

	<fieldset>
		<legend>Informações de Endereço:</legend>

		CEP:<br>
		<input type="text" name="endereco[cep]"><br><br>

		Endereço:<br>
		<input type="text" name="endereco[rua]"><br><br>

		Número:<br>
		<input type="text" name="endereco[numero]"><br><br>

		Complemento:<br>
		<input type="text" name="endereco[comp]"><br><br>

		Bairro:<br>
		<input type="text" name="endereco[bairro]"><br><br>

		Cidade:<br>
		<input type="text" name="endereco[cidade]"><br><br>

		Estado:<br>
		<input type="text" name="endereco[estado]"><br><br>
	</fieldset>
	<br>
	<fieldset>
		<legend>Resumo da Compra:</legend>

		Total a pagar:<br>
		<input type="text" name="compra" value="<?php echo $_SESSION['total_compra'];?>">
	</fieldset>
	<br>

	<fieldset>
		<legend>Informações de Pagamento</legend>

		<select name="pg_form" id="pg_form" onchange="selectPg()">
			<option value="CREDIT_CARD">Cartão de Crédito</option>
			<option value="BOLETO">Boleto</option>
			<option value="BALANCE">Saldo PagSeguro</option>
		</select>

		<div id="cc" style="display:none">
			Qual a bandeira do seu cartão?<br>
			<div id="bandeiras"></div>
			<br>
			<div id="cardinfo" style="display:none">
				Parcelamento: <br>
				<select name="parc" id="parc"></select><br><br>

				Titular do Cartão: <br>
				<input type="text" name="c_titular"><br><br>

				CPF do Titular: <br>
				<input type="text"><br><br>

				Número do cartão: <br>
				<input type="text" name="cartao" id="cartao"> <br><br>

				Dígito: <br>
				<input type="text" name="digito" id="cvv" maxlenght="4"> <br><br>

				Validade:<br>
				<input type="text" name="validade" id="validade">
			</div>
		</div>
	</fieldset>

	<br>

	<input type="submit" value="Efetuar Pagamento" id="efetuaPagamento">

	<input type="hidden" name="bandeira" id="bandeira">
	<input type="hidden" name="ctoken" id="ctoken">
	<input type="hidden" name="shash" id="shash">
	<input type="hidden" name="sessionId" value="">

</form>

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

<script type="text/javascript">
	var sessionId = '<?php echo $sessionId;?>';
	var valor = '<?php echo $_SESSION['total_compra'];?>';
	var formOk = false;
</script>

<script type="text/javascript" src="assets/js/ckt.js"></script>

