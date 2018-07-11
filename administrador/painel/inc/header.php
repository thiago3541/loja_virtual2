<?php
	session_start();
	include_once "../../config.php";
	function __autoload($classe)
	{
		require_once "../../classes/".$classe.'.class.php';
	}
	BD::conn();

	$login = new Login('adm_','loja_clientes');
	$site = new Site();

	if (!$login->isLogado()) 
	{
		header("Location: ../");
		exit();
	}
	else
	{
		$pegar_dados = BD::conn()->prepare("SELECT * FROM loja_adm WHERE email_log = ? AND senha_log = ?");
		$pegar_dados->execute(array($_SESSION['adm_emailLog'], $_SESSION['adm_senhaLog']));
		$usuario_logado = $pegar_dados->fetchObject();
	}

	if (isset($_GET['acao']) && $_GET['acao'] == 'sair'): 
	{
		if ($login->deslogar()) 
		{
			header("Location: ../");
		}
	}
	endif;
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Loja Virtual - Painel Administrativo</title>
		<link href="css/style_painel.css" rel="stylesheet" type="text/css" media="screen">
		<link rel="stylesheet" type="text/css" href="assets/css/cadastro-cliente.css">
		<?php if(!isset($_GET['pagina'])):?>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
    	<script type="text/javascript" src="../../js/price.js"></script>
    	<script type="text/javascript" src="../js/functions.js"></script>
    <script type="text/javascript">


	      // Load the Visualization API and the corechart package.
	      google.charts.load('current', {'packages':['corechart']});

	      // Set a callback to run when the Google Visualization API is loaded.
	      google.charts.setOnLoadCallback(drawChart);

	      // Callback that creates and populates a data table,
	      // instantiates the pie chart, passes in the data and
	      // draws it.
	      function drawChart() 
	      {

        // Create the data table.
        var data = new google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        <?php
        	$sqlVendas = BD::conn()->prepare("SELECT *, SUM(valor_total)
        	 AS total_venda FROM loja_pedidos WHERE
        	  TO_DAYS(NOW()) - TO_DAYS(criado) <= 90 
        	  GROUP BY MONTH(criado)");
        	$sqlVendas->execute();
        	while($fetchVendas = $sqlVendas->fetchObject()){
        ?>
        ['<?php echo date('m/Y', strtotime($fetchVendas->criado));?>', <?php echo $fetchVendas->total_venda;?>],
        <?php }?>
        ]);

        // Set chart options
        var options = {'title':'Vendas Trimestrais em Reais',
                       'width':1135,
                       'height':350};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('grafico'));
        chart.draw(data, options);
      }
    </script>
<?php endif;?>
	</head>
	<body>
		
			<div class="header">
				
				
			</div>
			
	</body>