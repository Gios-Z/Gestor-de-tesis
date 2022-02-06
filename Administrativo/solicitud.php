<link rel="stylesheet" href="../css/style.css">

<?php
include('../config.php');
$fechaActual = date('D  d,  M  Y');

$registro = $connection->query("select p.cod_postulante, ptt.titulo, ptt.vacantes, p.fecha_maquina, concat(u.nombre,' ' ,u.apellido)
from propuesta_tesis ptt
inner join postulantes p on ptt.cod_propuesta=p.cod_propuesta
inner join usuario u on p.cod_usuario=u.cod_usuario
where p.estado = 'P' and ptt.vacantes>0");
$row = $registro->fetchAll();

$encontro = false;

if (isset($_POST['calificar'])) {
    $cod = $_POST['codigo'];

    foreach ($row as $rowst) {

        if ($cod == $rowst[0]) {
            $encontro = true;

            $sql = "select ptt.cod_propuesta, ptt.vacantes, p.cod_postulante
            from propuesta_tesis ptt
            inner join postulantes p on ptt.cod_propuesta=p.cod_propuesta
            where p.estado = 'P' and p.cod_postulante= '" . $cod . "'";


            $vct = $connection->query($sql);
            $rowcvt = $vct->fetch();

            $sql1 = "";
            $condicion = "";
            if ($_POST['sele'] == "A") {
                $estado = "A";
                $vacantes = $rowcvt[1] - 1;
                if ($vacantes == 0) {
                    $condicion = ",fech_inicio=NOW() , estado='A'";
                }
                $sql1 .= "update propuesta_tesis set vacantes = " . $vacantes . $condicion . " where cod_propuesta=" . $rowcvt[0] . ";";
            } else {
                $estado = "R";
            }
            $sql1 .= "update postulantes set estado = '" . $estado . "' where cod_postulante=" . $rowcvt[2];
            $reg = $connection->prepare($sql1);
            $reg->execute();

?>
            <h4>
                <?php
                echo "Se registro con exito";
                ?>
            </h4>
        <?php

            break;
        }
    }

    if (!$encontro) {
        ?>
        <h4>
            <?php
            echo "El codigo ingresado no existe";
            ?>
        </h4>
<?php

    }
}


?>

<div id="secciones">

    <h2>Solicitudes de aplicación a tesis</h2>

    <div id="fecha">
        <?php
        // Obteniendo la fecha actual del sistema con PHP        
        echo $fechaActual;
        ?>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">

            <br>
            <tr>
                <th width="10%">Código</th>
                <th width="35%">Titulo</th>
                <th width="10%">Vacantes</th>
                <th width="20%">Fecha de aplicación</th>
                <th width="30%">Estudiante</th>
            </tr>

            <?php
            foreach ($row as $rows) {
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
<br>
<h2>Calificar</h2>

<div class="container">

    <br>

    <form action='#' method='post'>

        <div class="form-group">
            <label for="codigo">Codigo del registro:</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required="true" placeholder="Ingrese el codigo del registro a calificar">
        </div>
        <br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sele" id="flexRadioDefault1" value="A" checked>
            <label class="form-check-label" for="flexRadioDefault1">
                Aprovar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sele" id="flexRadioDefault2" value="R">
            <label class="form-check-label" for="flexRadioDefault2">
                Rechazar
            </label>
        </div>
        <br>
        <button type="submit" class="btn btn-default" name="calificar">Calificar</button>

    </form>

</div>