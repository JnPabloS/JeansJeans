<?php 

include_once 'carrito.php';
include_once 'controlador.php';

if(isset($_GET['action'])) {
	$action = $_GET['action'];
	$carrito = new Carrito();

	switch ($action) {
		case 'mostrar':
			mostrar($carrito);
			break;
		
		case 'add':
			agregar($carrito);
			break;
		
		case 'remove':
			quitar($carrito);
			break;

		case 'vaciar':
			vaciar($carrito);
			break;

		case 'vender':
			vender($carrito);
			break;
		
		default:
			// code...
			break;
	}
} else {
	header("Location: index.php?error=1");
}

function mostrar($carrito)
{
	$itemsCarrito = json_decode($carrito->load(), 1);
	$fullItems = [];
	$total = 0;
	$totalItems = 0;
	$db = db::getDBConnection();

	foreach ($itemsCarrito as $itemCarrito) {
		$consulta = "SELECT * FROM ".$itemCarrito['tabla']." WHERE id='".$itemCarrito['id']."'";
		$Respuesta = $db->getProductos($consulta);
		$Prenda = $Respuesta->fetch_assoc();
		$Prenda['cantidad'] = $itemCarrito['cantidad'];
		$Prenda['tabla'] = $itemCarrito['tabla'];

		switch ($Prenda['oferta']) {
			case 0:
				$Prenda['subtotal'] = $itemCarrito['cantidad']*$Prenda['precio']*1000;
				break;
			
			default:
				$Prenda['subtotal'] = $itemCarrito['cantidad']*$Prenda['precio']*1000*((100-$Prenda['oferta'])/100);
				break;
		}

		$total += $Prenda['subtotal'];
		$totalItems += $Prenda['cantidad'];

		array_push($fullItems, $Prenda);
	}

	$resArray = array('info' => ['count' => $totalItems, 'total' => $total], 'items' => $fullItems);


	echo json_encode($resArray);
}

function agregar($carrito)
{
	if (isset($_GET['id'])) {
		$res = $carrito->add($_GET['id'], $_GET['s']);
		echo $res;
	} else {
		echo json_encode(['statuscode' => 404,
							'response' => 'No se puede procesar']);
	}
}

function quitar($carrito)
{
	if (isset($_GET['id'])) {
		$res = $carrito->remove($_GET['id'], $_GET['s']);
		echo $res;
	}
}

function vender($carrito)
{
	$itemsCarrito = json_decode($carrito->load(), 1);
	$db = db::getDBConnection();

	foreach ($itemsCarrito as $itemCarrito) {
		$ventas = 0;
		$consulta = "SELECT * FROM ".$itemCarrito['tabla']." WHERE id='".$itemCarrito['id']."'";
		$Respuesta = $db->getProductos($consulta);
		$Prenda = $Respuesta->fetch_assoc();
		$ventas = $Prenda['ventas'];
		$ventas += $itemCarrito['cantidad'];
		$consulta = "UPDATE ".$itemCarrito['tabla']." SET "
			."ventas='".$ventas."' "
			."WHERE ".$itemCarrito['tabla'].".id='".$itemCarrito['id']."'";


		$Respuesta = $db->getProductos($consulta);
	}
	
	header("Location: carrito-fun.php?action=vaciar");
}

function vaciar($carrito)
{
	foreach(json_decode($carrito->load(), 1) as $itemCarrito){
		$carrito->remove($itemCarrito['id'], $itemCarrito['tabla']);
	}
	header("Location: index.php");
}

?>