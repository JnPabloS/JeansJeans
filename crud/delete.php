<?php
	require_once "../controlador.php";

	session_start();
	if(!isset($_SESSION['auth'])){
		header("Location: ../index.php?error=1");
	}

	$db = db::getDBConnection();

	if (isset($_GET['t']) && isset($_GET['ref'])) {
		$Respuesta = $db->deletePrenda($_GET['t'], $_GET['ref']);
			switch ($_GET['t']) {
			case 'ropa_hombre':
				header("Location: ../hombre.php");
				break;
			
			default:
				header("Location: ../mujer.php");
				break;
			}
	} else {
		header("Location: ../index.php?error=1");
	}

	

?>
