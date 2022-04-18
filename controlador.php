<?php
//configuracion
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DBNAME", "tienda_jj");
define("PORT", 3306);

class DB extends mysqli{
	protected static $instance;

	public function __construct($host,$user,$pass,$dbname,$port) {
        mysqli_report(MYSQLI_REPORT_OFF);
        @parent::__construct($host,$user,$pass,$dbname,$port);
        if( mysqli_connect_errno() ) {
            throw new exception(mysqli_connect_error(), mysqli_connect_errno()); 
        }

    }

	public static function getDBConnection(){
		if( !self::$instance ) {
            self::$instance = new self(HOST,USER,PASS,DBNAME,PORT);
            $consulta = "SET CHARACTER SET UTF8";
			self::$instance->query($consulta);
        }
        return self::$instance;		
	}
	
	/*Crear usuarios*/
	function createUser($nombre,$apellido,$email,$contra,$tipouser){
		$consulta = "INSERT INTO usuarios (id,nombre,apellido,email,contra,tipouser) VALUES ("."NULL,"
			."'".$nombre."', "
			."'".$apellido."', "
			."'".$email."', "
			."'".$contra."', "
			."'".'0'."')";
		return $this->query($consulta);
	}

	function getUser($email,$contra){
		$consulta = "SELECT * FROM usuarios WHERE email='".$email."' AND contra='".$contra."'";
		return $this->query($consulta);
	}

	function getProductos($consulta){
		return $this->query($consulta);
	}


	function updatePrenda($nombre, $descripcion,$oferta,$precio,$imagen,$imagen2, $ventas, $nombre_tabla, $id){
		if($imagen!="" && $imagen2!=""){
			$consulta = "UPDATE $nombre_tabla SET "
			."nombre='".$nombre."',"
			."descripcion='".$descripcion."', "
			."oferta=".$oferta.", "
			."precio=".$precio.", "
			."imagen='".$imagen."', "
			."imagen2='".$imagen2."', "
			."ventas='".$ventas."' "
			."WHERE ".$nombre_tabla.".id='".$id."'";
		} else if($imagen!=""){
			$consulta = "UPDATE $nombre_tabla SET "
			."nombre='".$nombre."',"
			."descripcion='".$descripcion."', "
			."oferta=".$oferta.", "
			."precio=".$precio.", "
			."imagen='".$imagen."', "
			."ventas='".$ventas."' "
			."WHERE ".$nombre_tabla.".id='".$id."'";
		} else if($imagen2!=""){
			$consulta = "UPDATE $nombre_tabla SET "
			."nombre='".$nombre."',"
			."descripcion='".$descripcion."', "
			."oferta=".$oferta.", "
			."precio=".$precio.", "
			."imagen2='".$imagen2."', "
			."ventas='".$ventas."' "
			."WHERE ".$nombre_tabla.".id='".$id."'";
		} else {
			$consulta = "UPDATE $nombre_tabla SET "
			."nombre='".$nombre."',"
			."descripcion='".$descripcion."', "
			."oferta=".$oferta.", "
			."precio=".$precio.", "
			."ventas='".$ventas."' "
			."WHERE ".$nombre_tabla.".id='".$id."'";
		}
		print($consulta."<br>");
		return $this->query($consulta);	

	}
	function deletePrenda($nombre_tabla, $id){ 
		$consulta = "DELETE FROM ".$nombre_tabla." WHERE id='".$id."'";
		print($consulta."<br>");
		return $this->query($consulta);
	}

	function createPrenda($nombre, $descripcion,$oferta,$precio,$imagen,$imagen2, $nombre_tabla, $cat){
		$consulta = "INSERT INTO ".$nombre_tabla." (id, nombre, descripcion, oferta, precio, imagen, imagen2, categoria, fecha, ventas) VALUES ("."NULL, "
		."'".$nombre."', "
		."'".$descripcion."', "
		."'".$oferta."', "
		."'".$precio."', "
		."'".$imagen."', "
		."'".$imagen2."', "
		."'".$cat."', "
		."NULL, "
		."0 )";
		print($consulta."<br>");
		return $this->query($consulta);	

	}

	function addPedido($idUser,$carrito){
		$consulta = "INSERT INTO pedidos (id,idUser, carrito, fecha, despachado) VALUES ("."NULL,"
			."'".$idUser."', "
			."'".$carrito."', "
			."NULL, "
			." 0)";
		return $this->query($consulta);
	}

	function despPedido($id){
		$consulta = "UPDATE pedidos SET "
		."despachado='1' "
		."WHERE pedidos.id='".$id."'";
		return $this->query($consulta);
	}
}
?>