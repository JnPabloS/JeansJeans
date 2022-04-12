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

	function getUser($nombre,$contra){
		$consulta = "SELECT * FROM usuarios WHERE nombre='".$nombre."' AND password='".$contra."'";
		return $this->query($consulta);
	}

	function getProductos(){
		$consulta = "SELECT * FROM ropa_hombre LIMIT 20";
		return $this->query($consulta);
	}
}

	/*function deleteCard($cardName){
		$consulta = "DELETE FROM productos WHERE nombre='".$cardName."'";
		print($consulta."<br>");
		return $this->query($consulta);
	}

	function updateCard($cardName, $newCardName,$desc,$precio,$imagen = ""){
		if($imagen!=""){
			$consulta = "UPDATE productos SET "
			."nombre='".$newCardName."',"
			."descripcion='".$desc."', "
			."precio=".$precio.", "
			."imagen='".$imagen."' "
			."WHERE nombre='".$cardName."'";
		} else {
			$consulta = "UPDATE productos SET "
			."nombre='".$newCardName."',"
			."descripcion='".$desc."', "
			."precio=".$precio." "
			."WHERE nombre='".$cardName."'";
		}
		print($consulta."<br>");
		return $this->query($consulta);
	}


}*/?>