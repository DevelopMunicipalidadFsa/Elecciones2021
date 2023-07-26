
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<meta http-equiv="refresh" content="10">
	<?php
error_reporting(0);
$stmt = Conexiones::conEl()->prepare("SELECT      COUNT(DISTINCT id)as CantidadMesas
FROM         MESAS
WHERE     (VERIFICADO IS NOT NULL)");
		$stmt->execute();
		$resultadoM= $stmt->fetchAll();
	
    $consulta2=ControladorElecciones::ctrTotalCandidato();
$diferencia=$consulta2[0][0]-$consulta2[1][0];

    ?>
	<center>
		<h3>
			<b>Mesas Escrutadas: </b>
			<?php echo $resultadoM[0][0] ?>
			<b class="ml-5">Diferencia de Votos:  </b>
			<?php echo $diferencia ?>
		</h3>
	</center>
<script type="text/javascript">

/*ULTIMO*/
// Cargar gráficos y los paquetes corechart y barchart.
/* GRAFICO DE TORTA */
google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Task', 'TOTAL VOTOS', { role: 'style' }, { role: 'annotation' }],


    ["<?php echo $consulta2[0][1]?>", <?php echo $consulta2[0][0];?>,'#00BFFF',<?php echo $consulta2[0][0];?>],
    ["<?php echo $consulta2[1][1]?>", <?php echo $consulta2[1][0];?>,'#065991',<?php echo $consulta2[1][0];?>]
    <?php
// }
    ?>
    ]);
  /* HACE LLAMADO AL GRAFICO DE BARRAS HORIZONTAL DE CANTIDAD DE VOTOS DE CANDIDATOS POR SUBLEMAS */
  var options = {
    title: 'PORCENTAJE DE VOTOS POR CANDIDATOS',
    chartArea: {width: '50%'},
    pieHole: 0.4,
    colors: ['#00BFFF', '#065991'],      
  };

  var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
  chart.draw(data, options);

  /* HACE LLAMADO AL GRAFICO DE TORTA DE PORCENTAJES DE CANDIDATOS POR SUBLEMAS */
  var options = {
    title: 'TOTAL DE VOTOS POR CANDIDATOS',
    chartArea: {width: '30%'},
    hAxis: {
      title: 'TOTAL DE VOTOS',
      minValue: 0
    },
    vAxis: {
      title: 'SUBLEMAS'
    }
  };

  var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

  chart.draw(data, options);
}
/*******************************************************************************************/
/*GRAFICO DE TOTAL DE VOTOS POR SUBLEMAS*/
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawAnnotations);

function drawAnnotations() {
  var data = google.visualization.arrayToDataTable([
    ['SUBLEMAS', 'ELECCIONES 2021',],
    <?php

    $consulta=ControladorElecciones::ctrTotalLemas();


    foreach($consulta as $total){
      ?>

      ["<?php echo $total[1]?>", <?php echo $total[0];?>],

      <?php
    }
    ?>
    ]);

  var data = google.visualization.arrayToDataTable([
    ['SUBLEMAS', 'VOTOS', {type: 'string', role: 'annotation'}],
    <?php

    $consulta=ControladorElecciones::ctrTotalLemas();


    foreach($consulta as $total){ 
      ?>

      ["<?php echo $total[1]?>", <?php echo $total[0];?>,<?php echo $total[0];?>],


      <?php 
    }
    ?>
    ]);

  var options = {
    title: 'TOTAL DE VOTOS POR SUBLEMAS',
    chartArea: {width: '50%'},
    annotations: {
      alwaysOutside: true,
      textStyle: {
        auraColor: 'none',
      },
      boxStyle: {
        stroke: '#ccc',
        strokeWidth: 1,
        gradient: {
          color1: '#f3e5f5',
          color2: '#f3e5f5',
          x1: '0%', y1: '0%',
          x2: '100%', y2: '100%'
        }
      }
    },
    hAxis: {
      title: 'TOTAL DE VOTOS',
      minValue: 0,
    },
    vAxis: {
      title: 'SUBLEMAS'
    }
  };
  var chart = new google.visualization.BarChart(document.getElementById('chart_div2'));
  chart.draw(data, options);
}


</script>
<script>
  /* GRAFICO DE TORTA POR PARTIDO*/
 

  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php $consulta4=ControladorElecciones::ctrTotalPartidos();?>
          ["<?php echo $consulta4[0][1]?>", <?php echo $consulta4[0][0];?>],
          ["<?php echo $consulta4[1][1]?>", <?php echo $consulta4[1][0];?>]
        ]);

        var options = {
          title: 'PORCENTAJE DE VOTOS POR PARTIDOS',
          colors: ['#00BFFF', '#065991'], 
          chartArea: {width: '60%'},
        };
        
        var chart = new google.visualization.PieChart(document.getElementById('partido'));

        chart.draw(data, options);
      }
</script>
<div class="container mt-5">
<?php  
    $consulta2=ControladorElecciones::ctrTotalCandidato();
    if (empty($consulta2[0][1])){
 ?>
<script>
    Swal.fire({
      icon: 'error',
      title: '¡No se encontraron votos cargados!',
      text: 'Ante cualquier duda comunicarse con el Administrador',
     
    }).then((result) => {
        window.location.href='./';
    })

</script>
  
<?php
     }else{ 
 ?>
  <div class="row">
    <!-- GRAFICO DE BARRA DE TOTAL DE VOTOS ACUMULADO POR CANDIDATOS -->
    <div class="col-sm-12 col-md-12 col-lg-6">
      <div id="chart_div" class="float-left mb-3" style="height: 500px; width: 100%;"></div>
    </div>
     <!-- GRAFICO DE TORTA DE PORCENTAJES DE VOTOS ACUMULADO POR CANDIDATOS -->
    <div class="col-sm-12 col-md-12 col-lg-6">
      <div id="donutchart" class="float-left mb-3" style="height: 500px; width: 100%;"></div> 
    </div>
     <!-- GRAFICO DE BARRA DE TOTAL DE VOTOS ACUMULADO POR SUBLEMAS -->
    <div class="col-sm-12 col-md-12 col-lg-12">
      <div id="chart_div2" class="float-left mb-5" style="height: 500px; width: 100%;"></div>
    </div>
    <!-- GRAFICO DE BARRA DE TOTAL DE VOTOS ACUMULADO POR SUBLEMAS -->
    <div class="col-sm-12 col-md-12 col-lg-12">
      <div id="partido" class="float-left mb-5" style="height: 500px; width: 100%;"></div>
    </div>
  </div>
  <form action="./" method="POST">
		<button type="submit" class="btn btn-flotante btn-flotante-left mb-1 color" ><i class="fas fa-reply"></i> Volver</button>
	</form>
<?php } ?>
</div>
