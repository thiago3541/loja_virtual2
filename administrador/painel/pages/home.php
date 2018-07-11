<div id="grafico">

</div>

<div class="title-ult-vendas">
	<h1>Últimas Vendas</h1>
</div>

<table class="list" cellpadding="1" cellspacing="1px" border="1px">
	<thead>
		<tr>
			<th>#id</th>
			<th>Tipo de Envio</th>
			<th>Valor Total</th>
			<th>Data de Criação</th>
			<th>Detalhes</th>
			<th>Status</th>
		</tr>
	</thead>

	<tbody>
	<?php
		$dados = array('id','valor_total','status','criado','tipo_frete');
		$site->selecionar('loja_pedidos', $dados, false, 'id DESC LIMIT 10');

		foreach($site->listar() as $campos)
		{
			if ($campos['status'] == 0) 
			{
				$status = 'Pendente';
			}
			elseif ($campos['status'] == 1) 
			{
				$status = 'Aguardando Envio';
			}
			elseif ($campos['status'] == 2) 
			{
				$status = 'Poduto Enviado';
			}
	?>
		<tr>
			<td>#<?php echo $campos['id'];?></td>
			<td><?php echo $campos['tipo_frete'];?></td>
			<td>R$ <?php echo number_format($campos['valor_total'],2,',','.');?></td>
			<td><?php echo date('d/m/Y', strtotime($campos['criado']));?></td>
			<td><a href="#" title="Detalhes"><img src="../../assets/images/pedido-ok.png" border="0"></a></td>
			<td><?php echo $status;?></td>
		</tr>
	<?php }?>
	</tbody>
</table>

<div id="outras-estatisticas">
<?php
	$sqlConfigs = BD::conn()->prepare("SELECT * FROM loja_configs");
	$sqlConfigs->execute();
	$fetchConf = $sqlConfigs->fetchObject();
	$manutenção = ($fetchConf->Manutenção == 0) ? 'Não' : 'Sim';
	//Clientes
	$clientesCad = BD::conn()->prepare("SELECT id_cliente FROM loja_clientes");
	$clientesCad->execute();
	//categorias
	$cats = BD::conn()->prepare("SELECT id FROM loja_categorias");
	$cats->execute();
	//subcategorias
	$subcats = BD::conn()->prepare("SELECT id FROM loja_subcategorias");
	$subcats->execute();
?>
	<h1 class="title">Outras Estatísticas</h1>
	<table class="list2" cellpadding="0" cellspacing="0" border="1">
		<tbody>
			<tr>
				<td>Visitas</td>
				<td><?php echo $fetchConf->visitas;?></td>
			</tr>

			<tr>
				<td>Manutenção</td>
				<td><?php echo $manutenção;?></td>
			</tr>

			<tr>
				<td>Clientes Cadastrados</td>
				<td><?php echo $clientesCad->rowCount();?></td>
			</tr>

			<tr>
				<td>Categorias</td>
				<td><?php echo $cats->rowCount();?></td>
			</tr>

			<tr>
				<td>Subcategorias</td>
				<td><?php echo $subcats->rowCount();?></td>
			</tr>
		</tbody>
	</table>
</div>

<div id="last-tickets">
	<h1 class="title">Últimos Tíckets Abertos</h1>
</div>

<table class="tickets" cellpadding="0" cellspacing="0" border="1px">
	<thead>
		<tr>
			<th>Por</th>
			<th>Descrição</th>
			<th>Datal</th>
			<th>Ver</th>
		</tr>
	</thead>

	<tbody>
	<?php for($i = 1; $i <=10; $i++):?>
		<tr>
			<td>Thiago</td>
			<td>Estou com problemas</td>
			<td>01/01/2001</td>
			<td>00,00</td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>
</div>	