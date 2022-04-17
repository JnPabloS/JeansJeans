<?php
	require_once "../controlador.php";

	session_start();
	if(!isset($_SESSION['auth'])){
		header("Location: index.php?error=2");
	}
	$db = db::getDBConnection();
	$Respuesta = $db->createUser($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['password'],"0");
	if(!$Respuesta){
		header("Location: ../index.php?error=2");
	}else {
		header("Location: ../login.php?email=".$_POST['email']."&password=".$_POST['password']);
	}
?>
