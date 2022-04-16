<?php
	session_start();
	$_SESSION['carrito'] = NULL;
	session_destroy();
	header("Location: index.php")
?>