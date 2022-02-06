<link rel="stylesheet" href="../css/style.css">

    <?php
    include('../config.php');
    $fechaActual = date('D  d,  M  Y');

    $registro = $connection->query("select cod_postulante from postulantes where cod_usuario=" . $_SESSION['user_id']);
    $row = $registro->fetch();
    
        if (isset($_POST['Actualiza'])) {
                               
                $tema = $_POST['tema'];
                $resumen = $_POST['Resumen'];
                $usuario = $row["cod_postulante"];                             

                $sql="insert into control_avance (cod_postulante, fecha_maquina, tema_tratado, resumen, estado, observacion, avance) values (". $usuario .", now(), '". $tema ."' , '". $resumen ."', 'P', null, 0)";
                $ingreso = $connection->prepare($sql);
                $ingreso ->execute();

                echo "<h4>". "Enviado con Exito" ."</h4>";
                
        }
   

    ?>


<br>
<div class="container">

    <div id="fecha">
        <?php
        // Obteniendo la fecha actual del sistema con PHP        
        echo $fechaActual;
        ?>
    </div>
    <h2>Actualizar avance de tesis</h2>
    <br>

    <form action='#' method='post'>
        <div class="form-group">
            <label for="tema">Tema tratado:</label>
            <input type="text" class="form-control" id="tema" name="tema" required="true" placeholder="Ingrese el tema revisado">
        </div>
        <br>
        <div class="form-group">
            <label for="Resumen">Resumen:</label>
            <input type="text" class="form-control" id="Resumen" name="Resumen" required="true" placeholder="Haga un resumen de la reunion">
        </div>
        <br>        
        <br>
        <button type="submit" class="btn btn-default" name="Actualiza">Enviar</button>

    </form>

</div>