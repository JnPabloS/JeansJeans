<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--CSS y JS-->
	<link rel="stylesheet" href="css/estilo.css?n=1">
	<script type="text/javascript" src="js/carrito.js"></script>


	<!--Boostrap-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">


	<!--Logo-->
	<link rel="icon" type="image/png" href="img/logoj.png">
	<title>JeansJeans</title>
	<!--Logo-->

</head>
<body>
	<?php 
	if (isset($_GET['error']) && $_GET['error'] == 1) {
		echo'<script type="text/javascript">
          alert("No fue posible actualizar el producto");
          window.location.href="editarproducto.php?t='.$_GET['t'].'&ref='.$_GET['ref'].';
          </script>';
		}
	?>

	<!--Nav-->
	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="container-fluid row divnav">
			<div class="col-md-3">
				<a href="index.php" class="link-logo"><img class="img-logo" src="img/logoj.png"></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse col-md-6 row" id="navbarTogglerDemo03">
					<div class="col-md-12 centerdiv">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0 center">
						<?php
							if(isset($_GET['t'])){
								if ($_GET['t']=='ropa_hombre') {
									$tabla = "ropa_hombre";
									print('<li class="nav-item">
										<a class="nav-link" aria-current="page" href="mujer.php">MUJER</a>
										</li>
										<li class="nav-item">
										<a class="nav-link activo" href="hombre.php">HOMBRE</a>
										</li>'
									);
								}
								else {
									$tabla = "ropa_mujer";
									print('<li class="nav-item">
									<a class="nav-link activo" aria-current="page" href="mujer.php">MUJER</a>
									</li>
									<li class="nav-item">
									<a class="nav-link" href="hombre.php">HOMBRE</a>
									</li>'
									);
								}								
							} else {
								header("Location: index.php?error=1");
							}
						?>
						</ul>
					</div>
			</div>

			<div class="col-md-3 row ">
				<div class="dropdown show col-2 divdata ">
  					<a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="img/usuario.png"></a>
  					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  					<?php
  						session_start();
  						if(!isset($_SESSION['auth'])){
  							print('<a class="dropdown-item" href="registrarse.php?tp=2">Iniciar sesi??n</a>
  								<a class="dropdown-item" href="registrarse.php?tp=1">Registrarse</a>');
  						}
  						else{
  							print('<label class="text-center">Hola, '.$_SESSION['user'].' '.$_SESSION['apellido']);
  							if ($_SESSION['tipouser'] == 1) {
  								print('<p class="alerta">admin</p><div class="dropdown-divider"></div><a class="dropdown-item" href="agregar.php">Agregar producto</a><a class="dropdown-item" href="ventas.php">Ventas</a>');
  							} else {
  								print('<div class="dropdown-divider"></div>');
  							}
  							
  							print('<a class="dropdown-item" href="logout.php">Cerrar sesi??n</a></label>');
  						}
  					?>
  					</div>
				</div>
			</div>
		</div>
	</nav>
	<!--Nav-->
	<?php
		require_once "./controlador.php";
		$db = db::getDBConnection();
		if(isset($_GET['ref'])){
			$consulta = "SELECT * FROM ".$tabla." WHERE id=".$_GET['ref'];
			$Respuesta = $db->getProductos($consulta);
			$Prenda = $Respuesta->fetch_assoc();
			$desc = number_format($Prenda['precio']*1000*((100-$Prenda['oferta'])/100),0,',','.');
			print('
				<div class="row">
          <input type="hidden" value='.$Prenda['id'].' />
					<input type="hidden" value='.$tabla.' />
					<div class="col-md-4">
						<p class="titulo-imagen">Imagen 1</p>
						<img class="img-prenda center" src="'.$Prenda['imagen'].'">
					</div>
          
					<div class="col-md-4">
						<p class="titulo-imagen">Imagen 2</p>
						<img class="img-prenda center" src="'.$Prenda['imagen2'].'">
					</div>
          
					<div class="col-md-4">
					<form action="crud/update.php?id='.$Prenda['id'].'&t='.$tabla.'" enctype="multipart/form-data" method="POST">
					<div class="descripcion">
							<input class="input-edit-vendidos" type="number_format" name="ventas" value="'.$Prenda['ventas'].'""><label>Vendidos</label>
						</div>
						<div class="row">
							<div class="div-titulo col-md-7">
								<input class="input-edit-titulo h2" type="text" name="nombre" value="'.$Prenda['nombre'].'">
							</div>
							<div class="div-titulo col-md-4">');
			if ($Prenda['oferta']!=0) {
				print('
							<input class="input-edit-titulo h2 let_roja" type="number_format" name="precio" value=" '.$Prenda['precio'].'">
							<label class="titulo-oferta">Oferta</label><input class="input-edit-oferta h4" type="number_format" name="oferta" value="'.$Prenda['oferta'].'">
								'

					);
				
			} else {
				print('
								<input class="input-edit-titulo h2 let_roja" type="number_format" name="precio" value=" '.$Prenda['precio'].'">
								<label class="titulo-oferta">Oferta</label><input class="input-edit-oferta h4" type="number_format" name="oferta" value="'.$Prenda['oferta'].'">
							
					');
			}
			print('
							</div>
						</div>
							<textarea class="especificacion espe-editar" rows="6" cols="40" name="descripcion">'.$Prenda['descripcion'].'</textarea>
							<p class="ref">REF: '.$Prenda['id'].'</p>
							<div class="div-file">
								<p class="titulo-insertar">Insertar imagen 1</p>
								<input class="file" type="file" name="imagen1"></input>
							</div>
							<div class="div-file-2">
								<p class="titulo-insertar">Insertar imagen 2</p>
								<input class="file" type="file" name="imagen2"></input>
							</div>
							<div class="div-actualizar">
								<input class="actualizar" type="submit" value="Actualizar">
							</div>
							</form>
								</div>
							</div>
						</div>');
			}
	?>
<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>JeansJeans
          </h6>
          <p>
            Empresa de ropa, dedicada a complacer tus necesidades con el mejor estilo que puedas llevar en tu d??a a d??a, formal e informal, combina y diviertete con tu ropa de la mano de nosotros.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            CATEGOR??AS
          </h6>
          <p>
            <a href="mujer.php" class="text-reset">Mujer</a>
          </p>
          <p>
            <a href="hombre.php" class="text-reset">Hombre</a>
          </p>
        </div>
        <!-- Grid column -->

       <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contacto</h6>
          <p>Medell??n, Colombia, Cra 53 #12a - 21, C.C BuenaVida.</p>
          
          <p>
            info@jeansjeans.co
          </p>
          <p>+ 57 321 567 88</p>
          <p>+ 57 310 567 89</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>

        
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    ?? 2022
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

</html>