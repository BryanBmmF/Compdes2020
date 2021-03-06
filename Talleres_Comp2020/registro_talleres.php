<?php
  //si no esta logueado mandarlo al index principal
  session_start();  if (!isset($_SESSION["logueado"])){ header("Location:index.html"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="assets/images/icons/compdes_ico.png"/>
	<title>Registro Taller Compdes 2020</title>
<!--===================Para centrar header y footer===============================-->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
<!--===================Para calendario y hora=====================================-->
	<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>	
<!--===================Tipo de letra de menu y footer=============================-->	
	<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
<!--Funcionamiento de toastr-->
<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" >
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	
<!--=========================================Vista de Formulario======================================================-->
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===================================CSS============================================================-->
	<link rel="stylesheet" href="css/style.css">	
	
	
<!--===============================================================================================-->
</head>
<body>
	<!--======================================== Boton ir arriba ========================================
	-->
	<i class="btn-up fa fa-arrow-circle-o-up hidden-xs"></i>
	<!--======================================== Navegación ========================================-->
	<header class="full-reset header">
		<!--======================================== Logo(Nombre INS) ========================================-->
		<div class="full-reset logo">
			<span class="hidden-lg hidden-md">COMPDES 2020</span>
			<span class="hidden-xs hidden-sm">COMPDES 2020 GUATEMALA</span>
		</div>
		<!--======================================== Links de navegación ========================================-->
		<nav class="full-reset navigation">
			<ul class="full-reset list-unstyled">
				<li><a href="inicio.php">Inicio</a></li>
				<li><a href="revisar_pago.php">Revisar Pagos</a></li>
				<li><a href="registro_talleres.php">Registro Talleres</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
		<!--======================================== Boton menu mobil ========================================
		-->
		<a href="#" class=" hidden-sm hidden-md hidden-lg pull-right button-menu-mobile show-close-menu-m"><i class="fa fa-ellipsis-v"></i></a>
	</header>
	<!--======================================== contenido de la pagina ========================================-->
	<section class="full-reset" style="background-color: #fff; padding: 20px 0;">
		<div class="container">
			<div class="row">
				
				<form id="Form_1" class="contact100-form validate-form" action="registro_taller.php" method="POST">
					<span class="contact100-form-title">
						Registro de Talleres COMPDES 2020  
					</span>
					<label class="label-input100" for="name">Nombre *</label>
					<div class="wrap-input100 validate-input" data-validate="Campo Obligatorio">
						<input id="name" class="input100" type="text" name="name" placeholder="Ej. Taller Arduino" value="" required>
						<span class="focus-input100"></span>
					</div>
								
					<label class="label-input100" for="place">Lugar *</label>
					<div class="wrap-input100 validate-input" data-validate="Campo Obligatorio">
						<input id="place" class="input100" type="text" name="place" placeholder="Ej. Salon Tics Modulo G" value="" required>
						<span class="focus-input100"></span>
					</div>
					<label class="label-input100" for="datetimepicker">Fecha </label>
					<div class="wrap-input100" >
						<input type="text" value="" id="datetimepicker" name="date"/>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100">
						<div class="label-input100">Modalidad </div>
						<div>
							<select class="js-select2" name="modo">
								<option>Presencial</option>
								<option>Online</option>
							</select>
							<div class="dropDownSelect2"></div>
						</div>
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100">
						<div class="label-input100">Cupo Límite </div>
						<div>
							<select class="js-select2" name="cupo">
								<option>10</option>
								<option>20</option>
								<option>30</option>
								<option>40</option>
								<option>50</option>
								<option>60</option>
								<option>70</option>
								<option>80</option>
							</select>
							<div class="dropDownSelect2"></div>
						</div>
						<span class="focus-input100"></span>
					</div>

					<label class="label-input100" for="message">Descripción </label>
					<div class="wrap-input100">
						<textarea id="comentary" class="input100" name="comentary" placeholder="Escribe aquí la descripción..." value="" required></textarea>
						<span class="focus-input100"></span>
					</div>
	
					<div class="container-contact100-form-btn">
						<button type="submit" class="contact100-form-btn">	
							Registrar Taller
						</button>			
					</div>
				</form>
				
				<!--======================================== Navegacion fija lateral derecha ========================================-->
				<nav class="hidden-xs scroll-navigation-ins">
					<figure class="full-reset">
						<img src="assets/images/icons/compdes_ico.png" alt="Logo" class="img-responsive center-box">
					</figure>
					<h4 class="text-center titles">Talleres</h4>
					
				</nav>
			</div>
		</div>
	</section>
	<!--======================================== Pie de pagina ========================================-->
	<footer class="full-reset footer">
		<div class="full-reset" style="padding: 15px 0;">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<h4 class="titles text-center">Visitanos en</h4>
						<p class="text-center">
							<a href="http://ingenieria.cunoc.usac.edu.gt/portal/"  class="open-link-newTab" style="color:rgb(255, 255, 255);"> Ingeniería Cunoc</a>
						</p>
					</div>
					<div class="col-xs-12 col-sm-4">
						<h4 class="titles text-center">Contactanos</h4>
						<p class="text-center" style="color:rgb(255, 255, 255);">(+502)7873 0000 ext 2267</p>
					</div>
					<div class="col-xs-12 col-sm-4">
						<h4 class="titles subtitles-footer">Siguenos en</h4>
						<ul class="list-unstyled links-footer">
							<li><a href="#!" class="open-link-newTab"><i class="fa fa-facebook"></i> &nbsp; Facebook</a></li>
							<li><a href="#!" class="open-link-newTab"><i class="fa fa-twitter"></i> &nbsp; Twitter</a></li>
							<li><a href="#!" class="open-link-newTab"><i class="fa fa-google-plus"></i> &nbsp; Google+</a></li>
						</ul>
					</div>
					<div class="col-xs-12">
						<div class="full-reset footer-copyright"><i class="fa fa-copyright"></i> 2020 Compdes USAC-CUNOC</div>
					</div>
				</div>
			</div>
		</div>
    </footer>
	<div id="dropDownSelect1"></div>
<!-- Script Para Resetear Formulario cada vez que se cargue la pagina-->	
	<script>
		// cuando se muestre la página
		window.addEventListener('pageshow', function(event) {
    	// borra el formulario (asumiendo que sólo hay uno; si hay más, especifica su Id)
    	document.querySelector("form").reset();
		});
	</script>	

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
		$(".js-select2").each(function(){
			$(this).on('select2:open', function (e){
				$(this).parent().next().addClass('eff-focus-selection');
			});
		});
		$(".js-select2").each(function(){
			$(this).on('select2:close', function (e){
				$(this).parent().next().removeClass('eff-focus-selection');
			});
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!--======================Script para recibir fecha y hora===============================-->
<script src="js/jquery.datetimepicker.full.js"></script>	

	<script type="text/javascript">
		$(document).ready(function () {
			$.datetimepicker.setLocale('es');
			$('#datetimepicker').datetimepicker({value: '2020/07/05 11:22', step: 10});

		});
	</script>

</body>
</html>