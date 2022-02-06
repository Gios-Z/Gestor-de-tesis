<link rel="stylesheet" href="../css/style.css">

<?php
include('../config.php');

$sql = "select cod_propuesta, titulo,vacantes,fech_inicio,fech_fin from propuesta_tesis 
where estado='P'";

$prop = $connection->query($sql);
$row1 = $prop->fetchAll();

$consul = $connection->query("select p.estado from propuesta_tesis pt
inner join postulantes p on pt.cod_propuesta = p.cod_propuesta
where pt.cod_usuario=" . $_SESSION['user_id']);
$estado =  $consul->fetch();

?>

<br>
<h2>Propuestas de Tesis</h2>
<br>

<div class="container">
	<h4>
		<?php
		if (!$row1) {
			echo "No hay propuestas disponibles";
		} else {
		?>
	</h4>
	<?php
			if (!$estado) {
	?>
		<form action="#" method='post'>
			<div class="form-group">
				<label for="codigo">Ingrese el codigo:</label>
				<input type="number" class="form-control" id="codigo" name="codigo" required="true" placeholder="ingrese el codigo de la propuesta">
			</div>

			<button type="submit" class="btn btn-default" name="aplicar">Aplicar</button>
		</form>

		<?php
				if (isset($_POST['aplicar'])) {

					$codigo = $_POST['codigo'];

					foreach ($row1 as $rowst) {

						if ($codigo <> $rowst[0]) {
		?>
					<h4>
						<?php
							echo "El codigo ingresado no existe";
						?>
					</h4>
			<?php
							break;
						} else {

							$codigo = $_POST['codigo'];
							$usuario = $_SESSION['user_id'];

							$sql = "insert into postulantes (cod_usuario, cod_propuesta, fecha_maquina, estado) values (" . $usuario . ", " . $codigo . ", now(), 'P')";
							$aplicar = $connection->prepare($sql);
							$aplicar->execute();

							echo "<h4>". "Registrado con Exito" ."</h4>";
						}
					}
				}
			} else {

				if ($estado[0] = "A") {
			?>
			<h4>
				<?php
					echo "Usted ya tiene un tema de tesis !";
				?>
			</h4>
		<?php
				} else {
		?>
			<h4>
				<?php
					echo "Usted  tiene un tema pendiente !";
				?>
			</h4>
	<?php
				}
			}

	?>

	<div class="table-responsive">
		<table class="table table-hover">

			<br>
			<tr>
				<th width="10px">Código</th>
				<th width="350px">Titulo</th>
				<th>Vacantes</th>
				<th>Fecha de inicio</th>
				<th>Fecha de finalización</th>
			</tr>

			<?php
			foreach ($row1 as $rows) {
				"<input type=" . '"number"' . "class=" . '"#"' . " id=" . '"codigo"' . " name=" . $rows[0] . " required=" . '"true">"';
				echo "<tr>";
				echo   "<td>" . $rows[0] . "</td>";
				echo   "<td>" . $rows[1] . "</td>";
				echo   "<td>" . $rows[2] . "</td>";
				echo   "<td>" . $rows[3] . "</td>";
				echo   "<td>" . $rows[4] . "</td>";
				echo "</tr>";
			}
			?>

		</table>
	</div>
</div>
<?php
		}
?>