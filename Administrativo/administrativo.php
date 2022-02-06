<?php
include('../config.php');

$tt = $connection->query("SELECT u.cedula, mtt.periodo, concat(u.nombre,' ', u.apellido) estudiante, ptt.titulo, sum(ca.avance)
FROM propuesta_tesis ptt
inner join usuario u on ptt.cod_usuario=u.cod_usuario
inner join ruta_postulante rp on u.cod_usuario=rp.cod_usuario
inner join control_avance ca on rp.cod_postulante=ca.cod_postulante
inner join miembrostt mtt on rp.cod_ruta=mtt.cod_ruta
where ptt.estado='A' 
group by 1");
$rowtt = $tt->fetchAll();

?>

<h2>Trabajos de titulacion:</h2>
<div class="table-responsive">
    <table class="table table-hover">
        <br>
        <tr>
            <th width="15%" style="color: rgb(38, 114, 236);">Cedula</th>
            <th width="15%" style="color: rgb(38, 114, 236);">Periodo</th>
            <th width="25%" style="color: rgb(38, 114, 236);">Estudiante</th>
            <th width="30%" style="color: rgb(38, 114, 236);">Tema de tesis</th>
            <th width="15%" style="color: rgb(38, 114, 236);">Avance</th>
        </tr>

        <?php
            foreach ($rowtt as $rows) {
                echo "<tr>";
                echo   "<td>" . $rows[0] . "</td>";
                echo   "<td>" . $rows[1] . "</td>";
                echo   "<td>" . $rows[2] . "</td>";
                echo   "<td>" . $rows[3] . "</td>";
                echo   "<td>" . $rows[4] . " % </td>";
                echo "</tr>";
            }
        
        ?>

    </table>
</div>