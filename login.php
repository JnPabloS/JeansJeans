<?php
require_once "./controlador.php";

if (isset($_POST['email'])) {
	$db = db::getDBConnection();
	$Respuesta = $db->getUser($_POST['email'],$_POST['password']);
	$usuario = mysqli_fetch_array($Respuesta);

	if (mysqli_num_rows($Respuesta)>0){
		session_start();
		$_SESSION['user'] = $usuario['nombre'];
		$_SESSION['apellido'] = $usuario['apellido'];
		$_SESSION['tipouser'] = $usuario['tipouser'];
		$_SESSION['auth'] = true;
		header("Location: index.php");
	}else{
		header("Location: registrarse.php?error=1");
	}
	$db->close();
} else {
	header("Location: index.php?error=1");
}


?>