<?php
require_once "controlador.php";

$db = db::getDBConnection();
$Respuesta = $db->despPedido($_GET['id']);
$db->close();
header("Location: ventas.php");
?>