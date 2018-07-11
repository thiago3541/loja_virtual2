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
                            WHERE TO_DAYS(NOW()) - TO_DAYS(criado) <= 365 GROUP BY MONTH(criado)");
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