<?php 

class carrito{

	public function __construct(){
		session_start();

		if (!isset($_SESSION['carrito'])) {
			$_SESSION['carrito']=NULL;
		}
	}

	public function setCarrito($value)
	{
		$_SESSION['carrito'] = $value;
	}

	public function getCarrito()
	{
		return $_SESSION['carrito'];
	}

	public function load()
	{
		if ($this->getCarrito()==NULL) {
			return "[]";
		}

		return $this->getCarrito();
	}

	public function add($id, $tabla)
	{
		if ($this->getCarrito() == NULL) {
			$items = [];
		} else {
			$items = json_decode($this->getCarrito(),1);

			for ($i=0; $i < sizeof($items) ; $i++) { 
				if ($items[$i]['id'] == $id && $items[$i]['tabla']==$tabla) {
					$items[$i]['cantidad']++;
					$this->setCarrito(json_encode($items));

					return $this->getCarrito();
				}
			}
		}

		$item = ['id' => (int)$id, 'cantidad' => 1, 'tabla' => $_GET['s']];

		array_push($items, $item);

		$this->setCarrito(json_encode($items));

		return $this->getCarrito();
	}

	public function remove($id, $tabla)
	{
		$items = json_decode($this->getCarrito(), 1);

		for ($i=0; $i < sizeof($items); $i++) { 
			if ($items[$i]['id'] == $id && $items[$i]['tabla']==$tabla) {
				$items[$i]['cantidad']--;

				if ($items[$i]['cantidad'] == 0) {
					unset($items[$i]);
					$items = array_values($items);
				}

				$this->setCarrito(json_encode($items));
				return true;
			}
		}
	}
}

?>