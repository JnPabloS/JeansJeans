<?php
	require_once "../controlador.php";

	session_start();
	if(!isset($_SESSION['auth'])){
		header("Location: index.php?error=1");
	}

	$db = db::getDBConnection();
	$destino1 = "";
	$destino2 = "";
	if(isset($_GET['id']) && isset($_GET['t'])){
		if(isset($_FILES['imagen1']) && $_FILES['imagen1']['name']!=""){
			$img1 = 1;
			$origen1  = $_FILES['imagen1']['tmp_name'];
			$destino1 = "prendas/".$_FILES['imagen1']['name'];
			move_uploaded_file($origen1, "../".$destino1);
		} 
		if(isset($_FILES['imagen2']) && $_FILES['imagen2']['name']!=""){
			$img2 = 1;
			$origen2  = $_FILES['imagen2']['tmp_name'];
			$destino2 = "prendas/".$_FILES['imagen2']['name'];
			move_uploaded_file($origen2, "../".$destino2);
		}
		$Respuesta = $db->updatePrenda($_POST['nombre'],$_POST['descripcion'],$_POST['oferta'],$_POST['precio'],$destino1, $destino2, $_POST['ventas'], $_GET['t'], $_GET['id']);

		if(!$Respuesta){
			echo "no da";
			//header("Location: ../editarproducto.php?t=".$_GET['t']."&ref=".$_GET['id']."&error=1");
		}else {
			switch ($_GET['t']) {
				case 'ropa_hombre':
					header("Location: ../producto.php?s=M&ref=".$_GET['id']);
					break;		
				default:
					header("Location: ../producto.php?s=F&ref=".$_GET['id']);
					break;
			}
		}

	} else {
		header("Location: index.php?error=1");
	}
?>		