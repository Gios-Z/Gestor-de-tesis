<?php
include('../config.php');

$busqueda = $connection->query("select pt.titulo, concat (u1.nombre,' ',u1.apellido) director, concat (u2.nombre,' ',u2.apellido) presidente, concat (u3.nombre,' ',u3.apellido) vocal, ca.cod_postulante, sum(ca.avance) avance
from postulantes p 
inner join propuesta_tesis pt on p.cod_propuesta=pt.cod_propuesta
inner join ruta_postulante rp on p.cod_postulante = rp.cod_postulante
inner join miembrostt mtt on rp.cod_ruta = mtt.cod_ruta
inner join usuario u1 on mtt.cod_director= u1.cod_usuario 
inner join usuario u2 on mtt.cod_presidente= u2.cod_usuario 
inner join usuario u3 on mtt.cod_vocal= u3.cod_usuario 
left join control_avance ca on p.cod_postulante=ca.cod_postulante
where p.estado='A' and p.cod_usuario=" . $_SESSION['user_id']);
$row = $busqueda->fetch();

//Chart

$dataPoints = array(
	array("label" => "Por completar", "symbol" => "Por completar", "y" => (100 - $row["avance"])),
	array("label" => "Avance", "symbol" => "Avance", "y" => $row["avance"]),
)

?>

<script>
	window.onload = function() {

		var chart = new CanvasJS.Chart("chartContainer", {
			theme: "light2",
			animationEnabled: true,
			title: {
				text: "Control de Avance"
			},
			data: [{
				type: "doughnut",
				indexLabel: "{symbol} - {y}",
				yValueFormatString: "#,##0.0\"%\"",
				showInLegend: true,
				legendText: "{label} : {y}",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();

	}
</script>


		<div id="chartContainer" style="height: 500px; width: 100%;"></div>		

