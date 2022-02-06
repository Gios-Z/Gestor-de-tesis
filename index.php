<?php

include('config.php');
session_start();

if (isset($_POST['login'])) {

    $username = $_POST['correo'];
    $contrasena = $_POST['contrasena'];  
      

    $query = $connection->prepare("SELECT * FROM usuario WHERE correo=:correo and contrasena=:contrasena");
    $query->bindParam("correo", $username, PDO::PARAM_STR);
    $query->bindParam("contrasena", $contrasena, PDO::PARAM_STR);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {        
        echo '<p class="error">Contraseña o Usuario incorrecto!</p> ' ;
    } 
    else {  
        $query = $connection->prepare("select ur.cod_rol, u.perfil
        from usuario u 
        inner join usuario_rol ur on (u.cod_usuario=ur.cod_usuario) 
        inner join roles r on (ur.cod_rol=r.cod_rol)
        where ur.estado = 1 and  r.estado =1 and u.cod_usuario=:cod_usuario");
        $query->bindParam("cod_usuario", $result['cod_usuario'], PDO::PARAM_STR);
        $query->execute();
    
        $result_rol = $query->fetch(PDO::FETCH_ASSOC);
    
            if (!$result_rol) {
                echo '<p class="error">Usuario no autorizado!</p> ' ;
            } 
            else { 
                $_SESSION['user_id'] = $result['cod_usuario'];
                $_SESSION['cod_rol'] = $result_rol['cod_rol'];
                $_SESSION['image'] = $result_rol['perfil'];
                header('location:Layouts/layout.php');                                            
            } 
        
        } 
    
}

?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <title>Gestor de Tesis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
  </head>

<!--*********-->
  <body>  
            <div id="portada" >                
                <img src="img/inicio.jpg" alt="" width="100%">
            </div>
            
                <div class="forma">
                    <form method="post" action="" name="ingreso">
                        <br><br>
                    <div id="logo">
                    <img src="img/logo.png" alt="">
                    </div>                        
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Correo <br> </label>
                        <input type="email" class="form-control" name="correo" aria-describedby="usuario">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña <br> </label>
                        <input type="password" class="form-control" name="contrasena" >
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="recuerdame">
                        <label class="form-check-label" for="Check">Recordarme</label>
                    </div>                    
                    <button type="submit" class="inicio" name="login" value="login">Iniciar sesión</button>

                    </form>
                    <p>
                    Si olvidó su contraseña o desea gestionar sus credenciales de acceso a los servicios de UTPL, haga click
                    <a href="https://gidentidad.utpl.edu.ec">aquí</a>
                    </p>

                    <div id="footer">
                    <div id="footerLinks" class="floatReverse">                        
                        <a id="home" class="pageLink" href="http://utpl.edu.ec">UTPL</a>
                        <a id="privacy" class="pageLink" href="http://utpl.edu.ec/office365/pages/preguntas.html#title">FAQ</a>
                        <a id="helpDesk" class="pageLink" href="http://utpl.edu.ec/office365">Ayuda</a></div>
                    </div>
                    </div>

                </div>                    
    </body>
</html>