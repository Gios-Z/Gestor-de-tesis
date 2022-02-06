<?php
include('../config.php');

if (isset($_POST['cambiar'])) {                                       


$admirol=
$estadorol = $_POST['adminrol'];
$roll = $_POST['roll'];    

$sql="UPDATE usuario_rol SET cod_rol = $roll, estado = $estadorol WHERE cod_usuario=" . $admirol;
$reg = $connection->prepare($sql);
$reg->execute();

}


?>

<br><br>
<form action='#' method='post'>
    <div class="form-group">
        <h2>
            <label for="tema">Administar el rol de usuario</label>
        </h2>
        <br>
        <h3>
            <label for="tema">Buscar persona:</label>
        </h3>
        <input type="number" class="form-control" id="cedula" name="cedula" required="true"
            placeholder="Ingrese el número de cedula:">
        <button type="submit" class="btn btn-default" name="buscar">Buscar</button>
    </div>
</form>
<br>

<?php

if (isset($_POST['buscar'])) {

    $sql = "select u.cedula, concat(u.nombre,' ',u.apellido), u.correo, r.nombre, u.cod_usuario
    from usuario u
    inner join usuario_rol ur on u.cod_usuario=ur.cod_usuario
    inner join roles r on ur.cod_rol=r.cod_rol
    where u.cedula=" . $_POST['cedula'];
    $busqueda = $connection->query($sql);
    $rowbus = $busqueda->fetchAll();

    if (!$rowbus) {
        echo "<h4>" . "El usuario no existe!" . "</h4>";
    } else {

?>

<br>
<h3>Persona encontrada!</h3>
<div class="table-responsive">
    <table class="table table-hover">
        <br>
        <tr>
            <th width="20%" style="color: rgb(38, 114, 236);">Cedula</th>
            <th width="30%" style="color: rgb(38, 114, 236);">Nombres y Apellidos</th>
            <th width="30%" style="color: rgb(38, 114, 236);">Correo</th>
            <th width="20%" style="color: rgb(38, 114, 236);">Rol</th>
        </tr>

        <?php
                foreach ($rowbus as $rows1) {
                    echo "<tr>";
                    echo   "<td>" . $rows1[0] . "</td>";
                    echo   "<td>" . $rows1[1] . "</td>";
                    echo   "<td>" . $rows1[2] . "</td>";
                    echo   "<td>" . $rows1[3] . "</td>";
                    $admirol= $rows1[4];
                    echo "</tr>";
                }        
         
        ?>

    </table>
</div>

<br>
<form action='#' method='post'>

    <?php $admirol ?>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="adminrol" id="flexRadioDefault1" value=1 checked>
        <label class="form-check-label" for="flexRadioDefault1">
            Activo
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="adminrol" id="flexRadioDefault2" value=0>
        <label class="form-check-label" for="flexRadioDefault2">
            Pasivo
        </label>
    </div>
    <br>
    <select class="form-select" aria-label="Default select example" name="roll" required>
        <option selected>Seleccione un rol para el usuario</option>
        <option value="1">Profesor</option>
        <option value="2">Estudiante</option>
        <option value="3">Administrativo</option>
    </select>
    <br>
    <button type="submit" class="btn btn-default" name="cambiar">Cambiar</button>
</form>

<?php

    }

}

?>