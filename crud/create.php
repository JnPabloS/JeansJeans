<?php
	require_once "../controlador.php";

	session_start();
	if(!isset($_SESSION['auth'])){
		header("Location: index.php?error=2");
	}
	print("<p>".$_POST['nombre'].$_POST['apellido'].$_POST['email'].$_POST['password']."</p>");
	print("alert(".$_POST['nombre'].$_POST['apellido'].$_POST['email'].$_POST['password'].")");
	$_SESSION['user'] = $_POST['user'];
	$_SESSION['auth'] = true;
	$db = db::getDBConnection();
	$Respuesta = $db->createUser($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['password'],"0");
	if(!$Respuesta){
		header("Location: ../index.php?error=1");
	}else {
		header("Location: ../index.php");
	}
?>
