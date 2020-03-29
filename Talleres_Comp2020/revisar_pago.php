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
	<title>Verificación Pago Compdes 2020</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css">
	
	
	<!--Funcionamiento de toastr-->
  	<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
  	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" >
  	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  
	<script src="js/modernizr.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<!--======================================== Boton ir arriba ========================================
	-->
	<i class="btn-up fa fa-arrow-circle-o-up hidden-xs"></i>
	<!--======================================== Navegación ========================================-->
	<header class="full-reset header">
		<!--======================================== Logo(Nombre INS) ========================================-->
		<div class="full-reset logo">
			<span class="hidden-lg hidden-md"> COMPDES</span>
			<span class="hidden-xs hidden-sm">COMPDES 2020 USAC-CUNOC GUATEMALA</span>
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
				<section class="col-xs-12 col-sm-8 col-md-9 info-section-ins">
					
					<!--======================================== General ========================================-->
					<article class="full-reset" id="b-general">	
					<h3><strong>Verificación de Pagos COMPDES 2020</strong></h3>
					<p class="lead">
                        Acontinuación se muestran los pagos que han sido registrados en la inscripción de participantes, 
                        para revisar el pago debe ingresar el número de transacción de pago, Nombre o CUI/Pasaporte del 
                        participante para buscarlo en la tabla y luego de click en REVISAR.
					</p>
						<br>
						<label class="label-input100" for="identifier">Ingresa el Número de Transacción de Pago, Nombre o CUI/Pasaporte del Participante </label>
				            <div class="wrap-input100 validate-input">
					            <input id="identifier" class="form-control" type="text" name="identifier" placeholder="Ej. 3303226512202" value="">
								<div id="result-reg" class="wrap-input100 validate-input">
								<!-- Respuesta de registro ajax-->
								</div>
                            </div>
                            <br>
							
							<div id="result" class="table-responsive">
							<!-- Tabla cargada con ajax-->
							</div>
						
					</article>
					
				</section>
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
							<a href="http://ingenieria.cunoc.usac.edu.gt/portal/" style="color:rgb(255, 255, 255);"> Ingeniería Cunoc</a>
						</p>
					</div>
					<div class="col-xs-12 col-sm-4">
						<h4 class="titles text-center">Contactanos</h4>
						<p class="text-center">(+502)7873 0000 ext 2267</p>
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
	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!-- Script Para Resetear Campo cada vez que se cargue la pagina-->	
	<script>
		// cuando se muestre la página
		window.addEventListener('pageshow', function(event) {
    	// borra el input (asumiendo que sólo hay uno; si hay más, especifica su Id)
    	document.getElementById("identifier").value = "";
		});
	</script>
	<script>
		/*1. script de llenado de tabla con id=result */	
		$(document).ready(function () {
            //var consulta = document.getElementById("identifier").value;
			//obteniendo los datos de bd
			function obtener_datos(consulta){
				$.ajax({
					//type: "method",
					url: "mostrar_participantes.php",
					method: "POST",
					data: {consulta: consulta},
					//dataType: "dataType",
					success: function (data) {
						$("#result").html(data)
					}
				})

			}
			obtener_datos();


            /*2. filtar busqueda por campo ingresado */
			$(document).on("keyup","#identifier", function () {
			//obteniendo el valor que se puso en campo identifier
			var valor = $(this).val();
        	//condición de campo no vacio
        	if (valor!= "") {
                obtener_datos(valor); //busqueda en base al valor
        	} else {
				obtener_datos(); //desplegar todo
			}

			})


			/*3. script para revisar el pago de participante*/
			$(document).on("click","#registrar", function () {
			var id = $(this).data("id"); //manda a traer el data-id del boton registrar
                //solicitud ajax
				$.ajax({
					//type: "method",
					url: "actualizar_rev_pago.php",
					method: "POST",
					data: { id: id}, //por Json
					//data: "data",
					//dataType: "dataType",
					success: function (data) {
						$("#result-reg").html(data)
						obtener_datos(); //actualizar tabla
					},
					complete : function(xhr, status) {
        				document.getElementById("identifier").value = "";
    				}
				})

			})

		});

	</script>
							
</body>
</html>