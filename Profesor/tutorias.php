<link rel="stylesheet" href="../css/style.css">

<?php

include('../config.php');

$tutodir = $connection->query("select ptt.titulo, ptt.fech_fin, ptt.fech_fin, sum(ca.avance)
from propuesta_tesis ptt
inner join postulantes p on ptt.cod_propuesta=p.cod_propuesta
inner join control_avance ca on p.cod_postulante=ca.cod_postulante
inner join ruta_postulante rp on ca.cod_postulante=rp.cod_postulante
inner join miembrostt mtt on rp.cod_ruta=mtt.cod_ruta
 where ptt.estado='A' and mtt.cod_director=" . $_SESSION['user_id']);
 $rowdir = $tutodir->fetchAll();

//-------------------------------------------------

$tutopre = $connection->query("select ptt.titulo, ptt.fech_fin, ptt.fech_fin, sum(ca.avance)
from propuesta_tesis ptt
inner join postulantes p on ptt.cod_propuesta=p.cod_propuesta
inner join control_avance ca on p.cod_postulante=ca.cod_postulante
inner join ruta_postulante rp on ca.cod_postulante=rp.cod_postulante
inner join miembrostt mtt on rp.cod_ruta=mtt.cod_ruta
 where ptt.estado='A' and mtt.cod_presidente=" . $_SESSION['user_id']);
$rowpre = $tutopre->fetchAll();

//---------------------------------------------------

$tutovo = $connection->query("select ptt.titulo, ptt.fech_fin, ptt.fech_fin, sum(ca.avance)
from propuesta_tesis ptt
inner join postulantes p on ptt.cod_propuesta=p.cod_propuesta
inner join control_avance ca on p.cod_postulante=ca.cod_postulante
inner join ruta_postulante rp on ca.cod_postulante=rp.cod_postulante
inner join miembrostt mtt on rp.cod_ruta=mtt.cod_ruta
 where ptt.estado='A' and mtt.cod_vocal=" . $_SESSION['user_id']);
$rowvo = $tutovo->fetchAll();

?>


<br>
<div id="secciones">
    <h3>- Usted es Director de tutoria en:</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <?php
        if (!$rowdir) {
            echo "No asignado";
        } else {
        ?>
            <br>
            <tr>
                <th width="25%" style="color: rgb(38, 114, 236);">Titulo</th>
                <th width="25%" style="color: rgb(38, 114, 236);">Fecha de inicio</th>
                <th width="25%" style="color: rgb(38, 114, 236);">Fecha de finalización</th>
                <th width="25%" style="color: rgb(38, 114, 236);">Avance</th>
            </tr>

            <?php
            foreach ($rowdir as $rows) {
                echo "<tr>";
                echo   "<td>" . $rows[0] . "</td>";
                echo   "<td>" . $rows[1] . "</td>";
                echo   "<td>" . $rows[2] . "</td>";
                echo   "<td>" . $rows[3] . " % </td>";
                echo "</tr>";
            }
        }
        ?>

        </table>
    </div>
</div>



<br>
<div id="secciones">
    <h3>- Usted es Presidente de tutoria en:</h3>
    <div class="table-responsive">
        <table class="table table-hover">

            <?php
        if (!$rowpre) {
            echo "No asignado";
        } else {
        ?>

            <br>
            <tr>
                <th width="25%" style="color: rgb(38, 114, 236);">Titulo</th>
                <th width="25%" style="color: rgb(38, 114, 236);">Fecha de inicio</th>
                <th width="25%" style="color: rgb(38, 114, 236);">Fecha de finalización</th>
                <th width="25%" style="color: rgb(38, 114, 236);">Avance</th>
            </tr>

            <?php
            foreach ($rowpre as $rows) {
                echo "<tr>";
                echo   "<td>" . $rows[0] . "</td>";
                echo   "<td>" . $rows[1] . "</td>";
                echo   "<td>" . $rows[2] . "</td>";
                echo   "<td>" . $rows[3] . " % </td>";
                echo "</tr>";
            }
        }

        ?>
        </table>
    </div>
</div>

<br>
<div id="secciones">
    <h3>- Usted es vocal de tutoria en:</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <?php

            if (!$rowvo) {
                echo "No asignado";
            } else {
            ?>
            <br>
            <tr>
                <th width="25%" style="color: rgb(38, 114, 236);">Titulo</th>
                <th width="25%" style="color: rgb(38, 114, 236);">Fecha de inicio</th>
                <th width="25%" style="color: rgb(38, 114, 236);">Fecha de finalización</th>
                <th width="25%" style="color: rgb(38, 114, 236);">Avance</th>
            </tr>

            <?php
                foreach ($rowvo as $rows) {
                    echo "<tr>";
                    echo   "<td>" . $rows[0] . "</td>";
                    echo   "<td>" . $rows[1] . "</td>";
                    echo   "<td>" . $rows[2] . "</td>";
                    echo   "<td>" . $rows[3] . " % </td>";
                    echo "</tr>";
                }
            }
            ?>

        </table>
    </div>
</div>