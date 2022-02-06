<?php
include('../config.php');

//$mi_variable = $_POST["mi_combobox"];

$codruta = 0;

if (isset($_POST['designar'])) {
    $director =     $_POST['cbxDirector'];
    $presidente =     $_POST['cbxPresidente'];
    $vocal =     $_POST['cbxVocal'];
    $estadoUTE =     $_POST['estadoUTE'];
    $seccion =     $_POST['seccion'];
    $periodo =     $_POST['periodo'];
    $observacion =     $_POST['observacion'];
    $fecha =     $_POST['fin'];
    $cod_propuesta =     $_POST['idCodRuta'];

    $sqlmtt = "insert into miembrostt(cod_ruta, cod_director,cod_presidente,cod_vocal,estadoUTE,seccion,periodo,observaciones) 
                             values (".$cod_ruta.", ".$director.", ".$presidente.", ".$vocal.", '".$estadoUTE."', '".$seccion."', '".$periodo."', '".$observacion."')";
    $regmtt = $connection->prepare($sqlmtt);
    $regmtt->execute();

    $sqlfin = "update propuesta_tesis set fech_fin='".$fecha."' where cod_propuesta=". $cod_propuesta;
    $regfin = $connection->prepare($sqlfin);
    $regfin->execute();

    echo "<h4>". "Registrado con Exito" ."</h4>";


}

?>

<form action='#' method='post'>
    <div class="form-group">
        <h3>
            <label for="tema">Buscar:</label>
        </h3>
        <br>
        <input type="number" class="form-control" id="cedula" name="cedula" required="true" placeholder="Ingrese el número de cedula:">
        <button type="submit" class="btn btn-default" name="buscar">Buscar</button>
    </div>
</form>


<?php

if (isset($_POST['buscar'])) {

    $existeTribunal = false;

    $sql = "select u4.cedula, concat(u4.nombre,' ',u4.apellido) estudiante, concat(u1.nombre,' ',u1.apellido) Director, concat(u2.nombre,' ',u2.apellido) Presidente, concat(u3.nombre, u3.apellido) Vocal, mtt.estadoUTE, mtt.seccion, ptt.fech_inicio, mtt.periodo, mtt.observaciones, ptt.cod_propuesta
                            from ruta_postulante rp 
                            inner join usuario u4 on rp.cod_usuario = u4.cod_usuario
                            inner join propuesta_tesis ptt on u4.cod_usuario=ptt.cod_usuario
                            left join miembrostt mtt on mtt.cod_ruta=rp.cod_ruta
                            left join usuario u1 on mtt.cod_director=u1.cod_usuario
                            left join usuario u2 on mtt.cod_presidente=u2.cod_usuario
                            left join usuario u3 on mtt.cod_vocal=u3.cod_usuario
                            where ptt.estado='A' and rp.estado='A' and u4.cedula=" . $_POST['cedula'];
    $busqueda = $connection->query($sql);
    $rowbus = $busqueda->fetchAll();



    foreach ($rowbus as $rows1) {
        if (isset($rows1[2])) {
            $existeTribunal = true;
        } else {
            $codruta = $rows1[10];
        }
    }

    if (!$rowbus) {
        echo "<h4>" . "El usuario no existe o no ha sido aprobado" . "</h4>";
    } else if (!$existeTribunal) {

        $sqlconsulta = "select u.cod_usuario, concat(u.nombre,' ',u.apellido) 
        FROM usuario u
        inner join usuario_rol ur on u.cod_usuario=ur.cod_usuario
        where ur.cod_rol=1";
        $sqlbusqueda = $connection->query($sqlconsulta);
        $usuario = $sqlbusqueda->fetchAll();
?>
        <h3>No registra, Asignar Tribunal!</h3>
        <br>
        <form action='#' method='post'>
            <div class="form-group">
                <div class="form-group">

                    <div>
                        <?php
                        echo " <input type=\"hidden\" id=\"idCodRuta\" name=\"idCodRuta\" value=\" " . $codruta . " \"  >";
                        ?>

                    </div>

                    <div class="form-group">
                        <select width="50px" name="cbxDirector" class="form-control" aria-label="Default select example" required="true">
                            <option value="">--- Director de Proyecto --- </option>
                            <?php
                            foreach ($usuario as $rows1) {
                                echo "<option value='" . $rows1[0] . "'>" . $rows1[1] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <select name="cbxPresidente" class="form-control" aria-label="Default select example" required="true">
                            <option value="">--- Presidente de Proyecto --- </option>
                            <?php
                            foreach ($usuario as $rows1) {
                                echo "<option value='" . $rows1[0] . "'>" . $rows1[1] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <select name="cbxVocal" class="form-control" aria-label="Default select example" required="true">
                            <option value="">--- Vocal de Proyecto --- </option>
                            <?php
                            foreach ($usuario as $rows1) {
                                echo "<option value='" . $rows1[0] . "'>" . $rows1[1] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                    <BR>

                    <div class="form-group">
                        <input type="text" class="form-control" id="codigo" name="estadoUTE" required="true" placeholder="Estado UTE:">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="text" class="form-control" id="codigo" name="seccion" required="true" placeholder="A que Sección pertenece:">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="text" class="form-control" id="codigo" name="periodo" required="true" placeholder="En que Período esta?">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="text" class="form-control" id="codigo" name="observacion" required="true" placeholder="Existe alguna observacion?:">
                    </div>

                    <br>
                    <div class="form-group">
                        <label for="start">Fecha de Finalización:</label>
                        <input type="date" class="paswordhept" id="start" name="fin">
                        <br>
                        <button type="submit" class="btn btn-default" name="designar">Designar</button>
                    </div>
                </div>



        </form>

    <?php


    } else {
    ?><br>
        <h3>Miembros del tribunal de TT</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <br>
                <tr>
                    <th>Cedula</th>
                    <th>Estudiante</th>
                    <th>Presidente</th>
                    <th>Vocal</th>
                    <th>Estado UTE</th>
                    <th>Seccion</th>
                    <th>Fecha de Aprovación</th>
                    <th>Período</th>
                    <th>Observaciones</th>
                </tr>

                <?php
                foreach ($rowbus as $rows1) {
                    echo "<tr>";
                    echo   "<td>" . $rows1[0] . "</td>";
                    echo   "<td>" . $rows1[1] . "</td>";
                    echo   "<td>" . $rows1[2] . "</td>";
                    echo   "<td>" . $rows1[3] . "</td>";
                    echo   "<td>" . $rows1[4] . "</td>";
                    echo   "<td>" . $rows1[5] . "</td>";
                    echo   "<td>" . $rows1[6] . "</td>";
                    echo   "<td>" . $rows1[7] . "</td>";
                    echo   "<td>" . $rows1[8] . "</td>";
                    echo "</tr>";
                }

                ?>

            </table>
        </div>
<?php
    }
}



?>