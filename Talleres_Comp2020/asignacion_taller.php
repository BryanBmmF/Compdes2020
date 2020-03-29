
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="assets/images/icons/compdes_ico.png"/>
	<title>Talleres Compdes 2020</title>
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
				<li><a href="index.html">Inicio</a></li>
				<li><a href="inscripcion.html">Inscripción</a></li>
				<li><a href="asignacion_taller.php">Asignación Talleres</a></li>
				<li><a href="login.html">Login</a></li>
			</ul>
		</nav>
		<!--======================================== Boton menu mobil ========================================
		-->
		<a href="#" class=" hidden-sm hidden-md hidden-lg pull-right button-menu-mobile show-close-menu-m"><i class="fa fa-ellipsis-v"></i></a>
	</header>
	<!--======================================== contenido de la pagina ========================================-->
	<section class="full-reset" style="background-color: #fff; padding: 20px 0;">
		<article class="container">
			<h3><strong>Talleres COMPDES 2020</strong></h3>
			<p class="lead">
				Acontinuación se muestran los talleres que se impartirán en el Compdes 2020, 
				tomando encuenta que debió haber pagado su inscripción y tambien haber recibido un correo
				con la comprobación de su pago en linea para poder asignarse como maximo un taller.
			</p>
			<br>
			<div id="ingreso-pin" class="row">
				<div class="col-md-6 offset-md-3">
				<label class="label-input100" for="identifier">Ingresa tu Pin o Numero de Transacción de Pago *</label>
			    <div class="wrap-input100 validate-input" data-validate="Campo Obligatorio">
					<input id="identifier" class="input100" type="text" name="identifier" placeholder="Ej. 3303226512202" value="">
					<span class="focus-input100"></span>
				</div>
				</div>
			</div>
			<div id="result-reg" class="col-md-10 offset-md-5">
					<!-- Respuesta de registro ajax-->
			</div>
			<br>
			<div id="div-catalog" class="row">
				<div class="divider-general"></div>
			</div>	
			<br>
			<div id="content-catalog" class="row">
			<div id="catalog" class="container-contact100">
				<div id="result" class="row">
				<!-- Respuesta de peticion de talleres ajax-->
				</div>
			</div>
			</div>		
		</article>
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
		/* script de llenado de tabla con id=result */	
		$(document).ready(function () {
			//obteniendo los datos de bd
			function obtener_datos(){
				$.ajax({
					//type: "method",
					url: "mostrar_datos.php",
					method: "POST",
					//data: "data",
					//dataType: "dataType",
					success: function (data) {
						$("#result").html(data)
					}
				});

			}
			obtener_datos();
		});

	</script>

	<script>
		/* script para registrar datos de participacion en taller seleccionado*/
		$(document).on("click","#registrar", function () {
		var id = $(this).data("id"); //manda a traer el data-id del boton registrar
		//obteniendo el valor que se puso en campo identifier
		var identifier = document.getElementById("identifier").value;
    	//condición de campo no vacio
    	if (identifier.length == 0) {
			toastr.error('Debe ingresar su Pin o Numero de Transaccion de pago para asignarse!', 'Error al Asignar Taller!')
    	} else {
			//solicitud ajax
			$.ajax({
				//type: "method",
				url: "captura_datos.php",
				method: "POST",
				data: { id: id, identifier: identifier }, //por Json
				//data: "data",
				//dataType: "dataType",
				success: function (data) {
					$("#ingreso-pin").html("")
					$("#div-catalog").html("")
					$("#result-reg").html(data)
					$("#content-catalog").html("") //limpiamos el catalogo de talleres
					//obtener_datos(); //actualizar tabla
				},
				complete : function(xhr, status) {
    				document.getElementById("identifier").value = "";
				}
			});
		}
		});
	</script>
							
</body>
</html>