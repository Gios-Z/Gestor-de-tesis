<?php 
	if (empty($_GET['estudiante']) && empty($_GET['profesor']) && empty($_GET['administrativo']) ) {

		switch ($_SESSION['cod_rol']) {
			case 1:
				require_once('../Profesor/tutorias.php');
				break;
			case 2:
				require_once('../Estudiante/avance.php');
				break;
			case 3:
				require_once('../Administrativo/administrativo.php');				
				break;
		}	
		
	}
	else
	{
		//Seccion estudiante			
		if (!empty($_GET['estudiante']) && $_GET['estudiante']=='avance') {
			require_once('../Estudiante/avance.php');
		}
		if (!empty($_GET['estudiante']) && $_GET['estudiante']=='progreso') {
			require_once('../Estudiante/progreso.php');
		}
		if (!empty($_GET['estudiante']) && $_GET['estudiante']=='actualizacion') {
			require_once('../Estudiante/solicitud_A.php');
		}
		if (!empty($_GET['estudiante']) && $_GET['estudiante']=='propuestas') {
			require_once('../Estudiante/propuestas.php');
		}
		if (!empty($_GET['estudiante']) && $_GET['estudiante']=='proponer') {
			require_once('../Estudiante/proponer.php');
		}

		//Seccion profesor
		if (!empty($_GET['profesor']) && $_GET['profesor']=='Solicitudes') {
			require_once('../Profesor/solicitudes.php');
		}
		if (!empty($_GET['profesor']) && $_GET['profesor']=='Tutorias') {
			require_once('../Profesor/tutorias.php');
		}

		//Seccion estudiante
		if ( !empty($_GET['administrativo']) && $_GET['administrativo']=='personal') {
			require_once('../Administrativo/personal.php');
		}
		if (!empty($_GET['administrativo']) && $_GET['administrativo']=='tesis') {
			require_once('../Administrativo/administrativo.php');
		}
		if (!empty($_GET['administrativo']) && $_GET['administrativo']=='administrar') {
			require_once('../Administrativo/administrar.php');
		}
		if (!empty($_GET['administrativo']) && $_GET['administrativo']=='solicitudes') {
			require_once('../Administrativo/solicitud.php');
		}
		if (!empty($_GET['administrativo']) && $_GET['administrativo']=='miembros') {
			require_once('../Administrativo/miembros.php');
		}
		if (!empty($_GET['administrativo']) && $_GET['administrativo']=='formulario') {
			require_once('../Administrativo/formulario.php');
		}
		if (!empty($_GET['administrativo']) && $_GET['administrativo']=='ingresar') {
			require_once('../Administrativo/ingresar.php');
		}
	} 
 ?>