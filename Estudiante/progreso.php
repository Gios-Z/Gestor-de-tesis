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

if ($row[0]<>null){
$sql = "select fecha_maquina, tema_tratado, resumen, estado, observacion, avance from control_avance
where cod_postulante=" . $row["cod_postulante"];

$avances = $connection->query($sql);
$row1 = $avances->fetchAll();
}

?>

<div id="atras">
	<h3>
	Tiene un avance del: <br>
		<h5>
			<?php
				if($row[0]==null){
				echo "0%";
				}else{
				echo $row["avance"] . "%";
				}
			?>
		</h5>
		<a href="?estudiante=avance" data-bs-parent="#sidebar">Mostrar Gráfico </a>
	</h3>

</div>

<br>
<h2>Progreso alcanzado </h2>
<br><br>
<div class="container">
		<h3>
		<?php
		if ($row[0]==null) {
			echo "Tema: Sin asignar";
		} else {
			echo "Director TT: " . $row["director"] . "<br><br/>";
			echo "Presidente: " . $row["presidente"] . "<br><br/>";
			echo "Vocal: " . $row["vocal"] . "<br><br/>";
			echo "Tema: " . $row["titulo"] . "<br><br/>";
			?>
		</h3>
		<div class="table-responsive">
		<table class="table table-hover">

			<tr>
				<th width="10%">Fecha</th>
				<th width="25%x">Tema tratado</th>
				<th width="25%">Resumen</th>
				<th width="15%">Estado</th>
				<th width="15%">Observacion</th>
				<th width="10%">Avance</th>
			</tr>


			<?php			
			foreach ($row1 as $rows) {
				echo "<tr>";
				echo   "<td>" . $rows[0] . "</td>";
				echo   "<td>" . $rows[1] . "</td>";
				echo   "<td>" . $rows[2] . "</td>";

				switch ($rows[3]) {
					case 'A':
						echo "<td style=".'"color:#28B463"'.">Aprovado</td>";
						break;
					case 'P':
						echo "<td style=".'"color:#2471A3"'."><b>Pendiente</b></td>";
						break;
					case 'R':
						echo "<td style=".'"color:#FF0000"'.">Rechazado</td>";
						break;
				}	

				echo   "<td>" . $rows[4] . "</td>";
				echo   "<td>" . $rows[5] . "</td>";
				echo "</tr>";
				}
			
			?>


		</table>
	</div>
			<?php
		}
		?>
	
	<br>

	
</div>
<td ></td>