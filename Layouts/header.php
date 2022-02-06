<link rel="stylesheet" href="../css/style.css">

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto px-0">
            <div id="sidebar" class="collapse collapse-horizontal show border-end">
                <div id="sidebar-nav" class="list-group border-2 rounded-2 text-sm-start min-vh-100">


                    <!-- Aqui todos los items del menu -->
                    <!-- Seccion Estudiante -->
                    <?php
                    session_start();

                    if ($_SESSION['cod_rol'] == 2) {                        
                    ?>
                    <br><br>
                        <h1>Estudiante</h1>

                        <div id="foto">
                            <?php
                            echo '<img src="data:url/jpeg;base64,' . base64_encode($_SESSION['image']) . '"/>'
                            ?>
                        </div>
                     
                        <a href="?estudiante=progreso" class="list-group-item" data-bs-parent="#sidebar"><span>Progreso</span> </a>
                        <a href="?estudiante=actualizacion" class="list-group-item" data-bs-parent="#sidebar"><span>Actualización</span> </a>
                        <a href="?estudiante=propuestas" class="list-group-item" data-bs-parent="#sidebar"><span>Propuestas de Tesis</span> </a>
                        <a href="?estudiante=proponer" class="list-group-item" data-bs-parent="#sidebar"><span>Proponer un Tema</span> </a>
                        <br><br><br><br><br><BR></BR>

                        <div id="eva">
                            <a href="https://utpl.instructure.com/" target="blank"><img src="../img/eva.png" alt="" height="40%"></a>
                        </div>

                        <a href="../logout.php" class="list-group-item" data-bs-parent="#sidebar"><span>Cerrar Sesión</span> </a>
                    <?php     }
                    ?>


                    <?php

                    if ($_SESSION['cod_rol'] == 1) {
                     ?>
                    <br><br>
                        <h1>Profesor</h1>

                        <div id="foto">
                            <?php
                            echo '<img src="data:url/jpeg;base64,' . base64_encode($_SESSION['image']) . '"/>'
                            ?>
                        </div>
                        <br><br><br>
                        <a href="?profesor=Tutorias" class="list-group-item" data-bs-parent="#sidebar"><span>Tutorias</span> </a>
                        <a href="?profesor=Solicitudes" class="list-group-item" data-bs-parent="#sidebar"><span>Solicitudes</span> </a>
                        <br><br><br><br><br><br><br><BR></BR>

                        <div id="eva">
                            <a href="https://utpl.instructure.com/" target="blank"><img src="../img/eva.png" alt="" height="40%"></a>
                        </div>

                        <a href="../logout.php" class="list-group-item" data-bs-parent="#sidebar"><span>Cerrar Sesión</span> </a>
                    <?php     }
                    ?>


                    <?php
                    if ($_SESSION['cod_rol'] == 3) {
                        ?>
                        <br>
                            <h1>Administrativo</h1>    
                            <div id="foto">
                                <?php
                                echo '<img src="data:url/jpeg;base64,' . base64_encode($_SESSION['image']) . '"/>'
                                ?>
                            </div>
                            <a href="?administrativo=personal" class="list-group-item" data-bs-parent="#sidebar"><span>Personal</span> </a>                            
                            <a href="?administrativo=administrar" class="list-group-item" data-bs-parent="#sidebar"><span>Administrar</span> </a>
                            <a href="?administrativo=tesis" class="list-group-item" data-bs-parent="#sidebar"><span>Trabajos de titulacion</span> </a>
                            <a href="?administrativo=solicitudes" class="list-group-item" data-bs-parent="#sidebar"><span>Solicitudes</span> </a>
                            <a href="?administrativo=ingresar" class="list-group-item" data-bs-parent="#sidebar"><span>Ingresar nuevo tema</span> </a>
                            <a href="?administrativo=miembros" class="list-group-item" data-bs-parent="#sidebar"><span>Miembros de junta</span> </a>
                            <br><br><br></BR>
    
                            <div id="eva">
                                <a href="https://utpl.instructure.com/" target="blank"><img src="../img/eva.png" alt="" height="30%"></a>
                            </div>
    
                            <a href="../logout.php" class="list-group-item" data-bs-parent="#sidebar"><span>Cerrar Sesión</span> </a>
                        <?php     }
                    ?>
                </div>
            </div>
        </div>
        <main class="col ps-md-2 pt-2">
            <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="border rounded-3 p-1 text-decoration-none">
                <>
            </a>
            <div class="row">
                <div class="col-12">
                    <section>
                        <div class="container">
                            <?php
                            // carga el archivo routing.php para direccionar a la página .php que se incrustará entre la header y el footer
                            require_once('../routing.php');
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
</div>