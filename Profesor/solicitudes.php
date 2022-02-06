<link rel="stylesheet" href="../css/style.css">

<?php
include('../config.php');
$fechaActual = date('D  d,  M  Y');

$registro = $connection->query("select ca.cod_avance,ptt.titulo, ca.fecha_maquina, ca.tema_tratado, ca.resumen 
    from control_avance ca
    right join ruta_postulante rp on ca.cod_postulante=rp.cod_postulante
    inner join miembrostt mtt on rp.cod_ruta = mtt.cod_ruta
    inner join propuesta_tesis ptt on rp.cod_usuario=ptt.cod_usuario
    where ca.estado='P' and ptt.estado='A' and mtt.cod_director=" . $_SESSION['user_id']);
$row = $registro->fetchAll();

if (isset($_POST['calificar'])) {

    $codigo = $_POST['codigo'];

    foreach ($row as $rowst) {

        if ($codigo<>$rowst[0]){
            ?>
<h4>
    <?php
            echo "El codigo ingresado no existe";
            ?>
</h4>
<?php
            break;
        }else{

            $observaciones = $_POST['Observaciones'];

            if ($_POST['sele']=="A"){
               $estado = "A";
               $porcentaje = $_POST['porcentaje'];
            }else{
               $estado = "R";
               $porcentaje = 0;
            }
       
           $sql = "UPDATE control_avance SET estado= '$estado', observacion = '".$observaciones."' , avance = $porcentaje WHERE cod_avance=" . $codigo;
           $reg = $connection->prepare($sql);
           $reg->execute();

           echo "<h4>". "Actualizado con Exito" ."</h4>";

        }        
        
    }  
    
}


?>

<div id="secciones">

    <h2>Solicitudes de avance</h2>

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
                <th width="25%">Titulo</th>
                <th width="20%">Fecha</th>
                <th width="20%">Tema tratado</th>
                <th width="25%">Resumen</th>
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
        <h2>Actualizar avance de tesis</h2>

        <div class="container">

            <br>

            <form action='#' method='post'>
                <div class="form-group">
                    <label for="codigo">Codigo del registro:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" required="true"
                        placeholder="Ingrese el codigo del registro a calificar">
                </div>
                <br>
                <div class="form-group">
                    <label for="Observaciones">Observaciones:</label>
                    <input type="text" class="form-control" id="Observaciones" name="Observaciones" required="true"
                        placeholder="Tiene alguna observacion?">
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
                <div class="form-group">
                    <label for="porcentaje">Porcentaje de avance :</label>
                    <input type="number" class="form-control" id="porcentaje" name="porcentaje" required="true"
                        placeholder="Cual es el porcentaje de avance?">
                </div>
                <br>
                <button type="submit" class="btn btn-default" name="calificar">Calificar</button>

            </form>

        </div>