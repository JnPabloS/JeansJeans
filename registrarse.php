<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--CSS y JS-->
	<link rel="stylesheet" href="css/estilo.css?n=1">
	<script type="text/javascript" src="js/codigo.js"></script>


	<!--Boostrap-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


	<!--Logo-->
	<link rel="icon" type="image/png" href="img/logoj.png">
	<title>JeansJeans</title>
	<!--Logo-->

</head>
<body>
	<?php
		session_start();
		if(isset($_SESSION['auth'])){
			header("Location: index.php");
		}
	?>
	<!--Nav-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid row divnav">
			<div class="col-md-3 divlogo">
				<a href="index.php" class="link-logo"><img href="index.php" class="img-logo" src="img/logoj.png"></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<!--<a class="navbar-brand" href="#">JeansJeans</a>-->
			</div>
			<div class="collapse navbar-collapse col-md-6 row" id="navbarTogglerDemo03">
					<div class="col-md-12 centerdiv">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0 center">
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="mujer.php">MUJER</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="hombre.php">HOMBRE</a>
							</li>
						</ul>
					</div>
			</div>

			<div class="col-md-3 row ">
				<div class="dropdown show col-2 divdata ">
  					<a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="img/usuario.png"></a>
  					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    				<a class="dropdown-item" href="?tp=2">Iniciar sesi??n</a>
    				<a class="dropdown-item" href="?tp=1">Registrarse</a>
  					</div>
				</div>

				<!--Carrito de compras-->
				<div class="col-2">
						<a href="#" class="btn-carrito"><img src="img/carrito-compra.png"></a>
						<div id="carrito-container">
							<div id="tabla">
							</div>
  					</div>
				</div>

			</div>
		</div>
	</nav>
	<!--Nav-->


	<div class="row">
		<div class="col-md-6">
			<div class="divform">
				<h5 class="titulo-form">Ingrese sus datos</h5>	
				<?php
					if (isset($_GET['tp']) && $_GET['tp']==1) {
						print('
							<form method="POST" name="registro" id="formulario" action="crud/create.php">
								<label>Nombre<sup> *</sup></label>
								<input type="text" id="nombre" class="form-control" name="nombre" required>
								<p id="alertaNombre" class="alerta"></p>
								<label>Apellido<sup> *</sup></label>
								<input type="text" id="apellido" class="form-control" name="apellido" required>
								<p id="alertaApellido" class="alerta"></p>
								<label>Email<sup> *</sup></label>
								<input type="email" id="email" class="form-control" name="email" required>
								<p id="space" class="alerta"></p>
								<div class="row">
									<div class="col-md-10">
										<label>Contrase??a<sup> *</sup></label>
										<input type="password" id="password" class="form-control inputcontra" name="password" required>
										<p id="alertaContra" class="alerta"></p>
									</div>
									<div class="col-md-2 ">
										<br>
										<button class="btncontra" type="button"><img id="imgContra" src="img/no-ver.png"></button>
									</div>
								</div>

								<div class="row">
									<div class="col-md-10">
										<label>Repetir contrase??a<sup> *</sup></label>
										<input type="password" id="reppassword" class="form-control inputcontra" name="reppassword" required>
										<p id="alertaRepContra" class="alerta"></p>
									</div>
									<div class="col-md-2 ">
										<br>
										<button class="repbtncontra" type="button"><img id="repImgContra" src="img/no-ver.png"></button>
									</div>
								</div>
								<p>??Ya tienes una cuenta? <a href="registrarse.php?tp=2">Inicia sesi??n</a></p>
								<div class="divbtnenviar">	
									<input type="submit" name="enviar" class="btnenviar" value="Registrarse">
								</div>
							</form>');
					} else {
						if (isset($_GET['error']) && $_GET['error']==1) {
							$mensaje='Credenciales incorrectas';
						} else {
							$mensaje=' ';
						}
						print('
							<form method="POST" name="login" id="formulario" action="login.php">
								<label>Email<sup> *</sup></label>
								<input type="email" id="email" class="form-control" name="email" required>
								<p id="space" class="alerta"></p>
								<div class="row">
									<div class="col-md-10">
										<label>Contrase??a<sup> *</sup></label>
										<input type="password" id="password" class="form-control inputcontra" name="password" required>
										<p id="alertaContra" class="alerta"></p>
									</div>
									<div class="col-md-2 ">
										<br>
										<button class="btncontra" type="button"><img id="imgContra" src="img/no-ver.png"></button>
									</div>
								</div>
								<p class="alerta">'.$mensaje.'</p>
								<p>??No tienes una cuenta? <a href="registrarse.php?tp=1">Reg??strate</a></p>
								<div class="divbtnenviar">	
									<input type="submit" name="enviar" class="btnenviar" value="Iniciar sesi??n">
								</div>
							</form>');
					}
				?>
			</div>
		</div>
		<div class="col-md-6">
			<img class="img-registro" src="img/hombreregistro.jpg">
		</div>
	</div>

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
            <a  href="hombre.php" class="text-reset">Hombre</a>
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
</body>
</html>
