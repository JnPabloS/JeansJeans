<?php
	require_once "../controlador.php";

	session_start();
	if(!isset($_SESSION['auth'])){
		header("Location: index.php?error=1");
	}

	if(isset($_FILES['imagen1'])){
		$origen1  = $_FILES['imagen1']['tmp_name'];
		$destino1 = "prendas/".$_FILES['imagen1']['name'];
		move_uploaded_file($origen1, "../".$destino1);

		$origen2  = $_FILES['imagen2']['tmp_name'];
		$destino2 = "prendas/".$_FILES['imagen2']['name'];
		move_uploaded_file($origen2, "../".$destino2);

		$db = db::getDBConnection();
		$Respuesta = $db->createPrenda($_POST['nombre'],$_POST['descripcion'],$_POST['oferta'],$_POST['precio'],$destino1,$destino2,$_POST['t'],$_POST['cat']);
		if(!$Respuesta){
			header("Location: ../agregar.php?error=1");
		}else {
			switch ($_POST['t']) {
				case 'ropa_hombre':
					header("Location: ../hombre.php");
					break;
				
				default:
					header("Location: ../mujer.php");
					break;
			}
			
		}
	} else {
		header("Location: ../index.php?error=1");
	}

	
?>
