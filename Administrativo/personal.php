<?php
include('../config.php');

$tt = $connection->query("select u.cedula, concat(u.nombre,' ',u.apellido), u.correo, r.nombre
from usuario u
inner join usuario_rol ur on u.cod_usuario=ur.cod_usuario
inner join roles r on ur.cod_rol=r.cod_rol");
$rowtt = $tt->fetchAll();
?>
<form action='#' method='post'>
    <div class="form-group">
        <h3>
            <label for="tema">Buscar persona:</label>
        </h3>
        <input type="number" class="form-control" id="cedula" name="cedula" required="true"
            placeholder="Ingrese el número de cedula:">
        <button type="submit" class="btn btn-default" name="buscar">Buscar</button>
    </div>
</form>

<?php
if (isset($_POST['buscar'])) {
                               
    $cedula = $_POST['cedula'];
    
    $sql="select u.cedula, concat(u.nombre,' ',u.apellido), u.correo, r.nombre
    from usuario u
    inner join usuario_rol ur on u.cod_usuario=ur.cod_usuario
    inner join roles r on ur.cod_rol=r.cod_rol
    where u.cedula=".$_POST['cedula'];
    $busqueda = $connection->query($sql);    
    $rowbus = $busqueda->fetchAll();

    if(!$rowbus){
         echo "<h4>"."El usuario no existe!"."</h4>"; 
       
    }else{
    ?><br>
<h3>Persona buscada</h3>
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
                        echo "</tr>";
                    }
                
                ?>

    </table>
</div>
<?php
    }
    
}



?>




<br><br>
<h2>Personal</h2>
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
            foreach ($rowtt as $rows) {
                echo "<tr>";
                echo   "<td>" . $rows[0] . "</td>";
                echo   "<td>" . $rows[1] . "</td>";
                echo   "<td>" . $rows[2] . "</td>";
                echo   "<td>" . $rows[3] . "</td>";
                echo "</tr>";
            }
        
        ?>

    </table>
</div>