<link rel="stylesheet" href="../css/style.css">

<?php
include('../config.php');

$fechaActual = date('D  d,  M  Y');

if (isset($_POST['enviar'])) {

    $ttema = $_POST['temat'];
    $usu = $_SESSION['user_id'];
    $vacante = $_POST['vacante'];

    $sql = "insert into propuesta_tesis (titulo, vacantes, fech_inicio, fech_fin, estado, cod_usuario) values ('" . $ttema . "',".$vacante.", now(), now(), 'P'," . $usu . ")";
    $ingreso = $connection->prepare($sql);
    $ingreso->execute();

    echo "<h4>". "Registrado con Exito" ."</h4>";
}

$consul = $connection->query("select p.estado from propuesta_tesis pt
inner join postulantes p on pt.cod_propuesta = p.cod_propuesta
where pt.cod_usuario=" . $_SESSION['user_id']);
$estado =  $consul->fetch();

if(!$estado){
    ?>

    <br>
    <div class="container">

        <div id="fecha">
            <?php
            // Obteniendo la fecha actual del sistema con PHP        
            echo $fechaActual;
            ?>
        </div>
        <h2>Proponer un tema de tesis</h2>
        <br>

        <form action='#' method='post'>
            <div class="form-group">
                <label for="tema">Titulo:</label>
                <input type="text" class="form-control" id="tema" name="temat" required="true" placeholder="Cual es su propuesta?">
            </div>
            <br>
            <div class="form-group">
                <label for="tema">Vacantes:</label>
                <input type="text" class="form-control" id="tema" name="vacante" required="true" placeholder="Cuantes vacantes existen?">
            </div>
            <br>
            <button type="submit" class="btn btn-default" name="enviar">enviar</button>

        </form>

    </div>
    <?php
}else{

switch ($estado[0]) {
    case 'A':
        ?>
        <h4>
        <?php
        echo "Usted ya tiene un tema de tesis !";
        ?>
        </h4>						
        <?php
        break;
    case 'P':
        ?>
        <h4>
        <?php
        echo "Usted  tiene un tema pendiente !";
        ?>
        </h4>						
        <?php
        break;
    
    }	
}