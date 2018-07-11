<?php
	session_start();
	include_once "../../config.php";

	function __autoload($classe)
	{
		require_once "../../classes/".$classe.'.class.php';
	}
	BD::conn();

	$login = new login('adm_', 'loja_adm');
	$site = new Site();

	if (!$login->isLogado()) 
	{
		header("Location: ../");
		exit;
	}
	else
	{
		$pegar_dados = BD::conn()->prepare("SELECT * FROM loja_adm WHERE email_log = ? AND senha_log = ?");
		$pegar_dados->execute(array($_SESSION['adm_emailLog'], $_SESSION['adm_senhaLog']));
		$usuarioLogado = $pegar_dados->fetchObject();

	}

	if (isset($_GET['acao']) && $_GET['acao'] == 'sair'):
		if ($login->deslogar()) 
		{
			header("Location: ../");
		}
	endif;
?>

<html>
<head>
	<title>Painel Administrativo</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" src="js/estatísticas-venda.js"></script>

	<script type="text/javascript">
		// Load the Visualization API and the corechart package.
	  google.charts.load('current', {'packages':['corechart']});

	  // Set a callback to run when the Google Visualization API is loaded.
	  google.charts.setOnLoadCallback(drawChart);

	  // Callback that creates and populates a data table,
	  // instantiates the pie chart, passes in the data and
	  // draws it.
	  function drawChart() {

	    // Create the data table.
	    var data = new google.visualization.DataTable();
	    data.addColumn('string', 'Topping');
	    data.addColumn('number', 'Slices');
	    data.addRows
	    ([
	    	<?php
	    		$sqlVendas = BD::conn()->prepare("SELECT *, SUM(valor_total) AS total_venda FROM loja_pedidos
	    											WHERE TO_DAYS(NOW()) - TO_DAYS(criado) <= 120 GROUP BY MONTH(criado)");
	    		$sqlVendas->execute();
	    		while($fetchVendas = $sqlVendas->fetchObject())
	    		{
	    	?>
	        ['<?php echo date('m/Y', strtotime($fetchVendas->criado));?>', <?php echo $fetchVendas->total_venda;?>],
	      	<?php }?>
	    ]);

	    // Set chart options
	    var options = {'title':'Ganho Trimestral de vendas em R$',
	                   'width':1400,
	                   'height':502};

	    // Instantiate and draw our chart, passing in some options.
	    var chart = new google.visualization.PieChart(document.getElementById('grafico'));
	    chart.draw(data, options);
	  }
	</script>

</head>
<body>
	<div id="content-painel">
		<div id="header">

		</div>

		<div id="sidebar">
			<h1>Gerenciamento</h1>

			<label><a href="#">Home</a></label>
			<label><a href="?acao=sair" id="logout">Finalizar Sessão</a></label>

			<ul>
				<li class="title"><a href="#"></a>Produtos</li>
				<ul>
					<li><a href="?pagina=cadProdutos">Cadastrar Produtos</a></li>
					<li><a href="#">Editar Produtos</a></li>
					<li><a href="#">Gerenciar Estoque</a></li>
				</ul>

				<li class="title">Clientes</li>
				<ul>
					<li><a href="#">Listar Clientes</a></li>
					<li><a href="#">Cadastrar Clientes</a></li>
				</ul>

				<li class="title">Administradores</li>
				<ul>
					<li><a href="#">Cadastrar Novo</a></li>
					<li><a href="#">Editar Cadastrados</a></li>
				</ul>

				<li class="title">Categorias</li>
				<ul>
					<li><a href="#">Cadastrar Categorias</a></li>
					<li><a href="#">Editar Categorias</a></li>
				</ul>

				<li class="title">Subcategorias</li>
				<ul>
					<li><a href="#">Cadastrar Subcategorias</a></li>
					<li><a href="#">Editar Subcategorias</a></li>
				</ul>

				<li class="title">Tickets</li>
				<ul>
					<li><a href="#">Tickets Pendentes</a></li>
					<li><a href="#">Tickets Fechados</a></li>
					<li><a href="#">Todos os Tickets</a></li>
				</ul>
			</ul>
		</div>

		<div id="inc-conteudo">
			<div id="title-page">
				<label>DASHBOARD</label>
			</div>

			<div id="dados">
				<div id="qtd-visitas">
					<h1>Visitas</h1>
					<label>00</label>
				</div>

				<div id="qtd-vendas">
					<?php
						$sqlVendasHoje = BD::conn()->prepare("SELECT *, SUM(valor_total) AS total_venda FROM loja_pedidos
		    											WHERE criado = DATE(NOW())");
			    		$sqlVendasHoje->execute();
			    		$fetchVendasHoje = $sqlVendasHoje->fetchObject();
					?>
					<h1>Vendas Hoje</h1>
					<label>R$ <?php echo $fetchVendasHoje->total_venda;?></label>
				</div>

				<div id="qtd-clientes">
					<?php
						$sqlqtdClientes = BD::conn()->prepare("SELECT COUNT(*) AS total FROM loja_clientes");
			    		$sqlqtdClientes->execute();
			    		$fetchClientes = $sqlqtdClientes->fetchObject();
			    	?>
					<h1>Clientes cadastrados</h1>
					<label><?php echo $fetchClientes->total;?></label>
				</div>

				
			</div>

			<div id="estatisticas-vendas">
				<label>Estatísticas de Vendas</label>
			</div>

			<div id="grafico">

			</div>

			<div id="ult-vendas">
				<label>Ultimas Vendas</label>
			</div>

			<table class="list" cellpadding="0" cellspacing="0" border="1">
				<thead>
					<tr>
						<th>ID</th>
						<th>TIPO DE ENVIO</th>
						<th>VALOR TOTAL</th>
						<th>DATA</th>
						<th>Detalhes</a></th>
						<th>STATUS</th>
					</tr>
				</thead>

				<tbody>
					<?php 
						$dados = array('id','valor_total','status','criado','tipo_frete');
						$site->selecionar('loja_pedidos', $dados, false, 'id DESC limit 7');

						foreach($site->listar() as $campos)
						{
							if ($campos['status'] == 0) 
							{
								$status = 'Pendente';
							}
							elseif ($campos['status'] == '1') 
							{
								$status = 'Aguardando envio';
							}
							elseif ($campos['status'] == '2') 
							{
								$status = 'Produto Enviado';
							}
					?>
						<tr>
							<td>#<?php echo $campos['id'];?></td>
							<td><?php echo $campos['tipo_frete'];?></td>
							<td>R$ <?php echo number_format($campos['valor_total'],2,',','.');?></td>
							<td><?php echo date('d/m/Y', strtotime($campos['criado']));?></td>
							<td><a href="#" title="Detalhes"><img src="images/detalhes.png"></td>
							<td><?php echo $status;?></td>
						</tr>
					<?php };?>
				</tbody>
			</table>

			<div id="ult-tickets">
				<label>Ultimos Tickets</label>
			</div>

			<table class="list" cellpadding="0" cellspacing="0" border="1">
				<thead>
					<tr>
						<th>POR</th>
						<th>DESCRIÇÃO</th>
						<th>DATA</th>
						<th>VER</a></th>
					</tr>
				</thead>

				<tbody>
					<?php for($i = 0; $i <= 5; $i++):?>
						<tr>
							<td>Thiago</td>
							<td>Estou com problemas...</td>
							<td>01/01/2001</td>
							<td><a href="#"><img src="images/view.png"></a></td>
						</tr>
					<?php endfor;?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>