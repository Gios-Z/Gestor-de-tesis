<?php 
//Seccion profesor

	if (empty($_GET['profesor'])){
		echo 
		require_once('../Profesor/tutorias.php');
	}
	else
	{				
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
	}

	//Seccion estudiante

	if (empty($_GET['estudiante'])){
		require_once('../Estudiante/avance.php');
	}
	else
	{					
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
	}
?>