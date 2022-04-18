<?php
require_once "controlador.php";


session_start();
$db = db::getDBConnection();
$Respuesta = $db->addPedido($_SESSION['id'], $_SESSION['carrito']);
$db->close();
header("Location: carrito-fun.php?action=vender");
?>