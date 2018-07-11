<h1 class="titulo">Cadastrar Novo Produto</h1>

<div id="formularios">
	<form action="" method="post" enctype="multipart/form-data">
		<label>
			<span>Imagem Padrão</span>
			<input type="file" name="img_padrao">
			<br>
		</label>

		<label>
			<span>Titulo do Produto</span>
			<input type="text" name="titulo">
			<br>
		</label>

		<div class="fix">
			<label>
				<span>Escolha a categoria</span>
				<select name="categoria">
					<option value="" selected="selected">Selecione...</option>
				</select>
				<br>
			</label>

			<label>
				<span>Escolha a Subcategoria</span>
				<select name="subcategoria">
					<option value="" selected="selected">Selecione...</option>
				</select>
				<br>
			</label>
		</div>

		<div class="fix">
			<label>
				<span>Valor Anterior</span>
				<input type="text" name="valAnterior" id="preco">
				<br>
			</label>

			<label>
				<span>Valor Atual</span>
				<input type="text" name="valAtual" id="preco1">
				<br>
			</label>
		</div>

		<label>
			<span>Escreva as características deste produto...</span>
			<br>
			<textarea name="descricao" cols="30" rows="5"></textarea>
		</label>

		<div class="fix">
			<label>
				<span>Peso do produto...</span>
				<input type="text" name="peso">
				<br>
			</label>

			<label>
				<span>Quantidade em estoque:</span>
				<input type="text" name="qtdEstoque">
				<br>
			</label>
		</div>

		<input type="hidden" name="acao" value="cadastrar">
		<input type="submit" value="Próximo Passo">
	</form>
</div>