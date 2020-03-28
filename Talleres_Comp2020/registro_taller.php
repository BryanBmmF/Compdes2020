<?php 

/* incluir conexion bd */
include("conexion.php");

//recibiendo datos por post desde ajax en formato Json
$name = $_POST["name"];
$place = $_POST["place"];
$date = $_POST["date"];
$modo = $_POST["modo"];
$cupo = $_POST["cupo"];
$comentary = $_POST["comentary"];

//por defecto
$precio = 1;
$tipo = "Taller"; 

/*Formato de fecha para enviar a bd */
$fe = "".$date.":00";
$dateForm = date_create($fe);
$dateEnviar = date_format($dateForm, 'Y-m-d H:i:s');

/*llamamos al procedimiento almacenado */
$result = $conexion->prepare("CALL crearActividad(?,?,?,?,?,?,?,?)");

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="assets/images/icons/compdes_ico.png"/>
	<title>Información de Taller</title>
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
                <li><a href="index.html">Inicio</a></li>
				<li><a href="inscripcion.html">Inscripción</a></li>
				<li><a href="registro_taller.html">Registro Talleres</a></li>
				<li><a href="asignacion_taller.php">Asignación Talleres</a></li>
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

            <!--Insertando codigo PHP para mostrar mensaje de inscripcion-->
            <?php 
                if (!$result->execute(array($name,$tipo,$place,$dateEnviar,$precio,$comentary,$modo,$cupo))) {
                    //echo "An error occurred.\n";
                    /*capturamos el array de error que nos manda el gestor mysql sobre la instruccion */
                    $arr1 = $result->errorInfo();
        
                    echo "<script>toastr.error('Fallos en la solicitud!', 'Error!') </script>";
                    /*Error en consultas */
                    # Si hay algun dato erroneos como el numero de Pago o identificacion del participante
                    echo " <div class=\"container\">
                        <h2>Ocurrió un Fallo Durante el Registro del Taller</h2>
                        <div class=\"panel panel-warning\">
                            <div class=\"panel-heading\">Puede deberse a lo siguiente: </div>
                            <div class=\"panel-body\">
                                <div class=\"alert alert-danger\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                    <strong>¡Datos Incorrectos!</strong> Es posible que alguna de los campos ingresados no sean correctos. Por favor verifica. 
                                    Error: ".$arr1[2]." 
                                </div>
                            </div>
                            <div class=\"panel-footer\">
                                <div class=\"container-contact100-form-btn\">
                                    <button class=\"contact100-form-btn\">	
                                        <a href=\"registro_taller.html\" style=\"color:rgb(255, 255, 255);\"> Volver a intentarlo</a>
                                    </button>			
                                </div>
                            </div>
                        </div>
                    </div> ";
            
                } else { 
                    /* Exito el taller se registro correctamente*/
                    echo "<script>toastr.success('Solicitud Completada!', 'Exito!') </script>";
                    /* Detalles de Pago y confirmacion */
                    echo " <div class=\"container\">
                        <h2>Nuevo Taller:  ".$name." Registrado</h2>
                        <div class=\"panel panel-info\">
                            <div class=\"panel-heading\">Info. a tomar en cuenta!!!</div>
                            <div class=\"panel-body\">
                                <div class=\"alert alert-success\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                        <strong>¡Importante!</strong> Puedes registrar otro taller presionando el boton de abajo. 
                                        El nuevo taller ya lo puedes visualizar en la parte de Asignación de Talleres.
                                    </div>
                                </div>
                            <div class=\"panel-footer\">
                                <div class=\"container-contact100-form-btn\">
                                    <button class=\"contact100-form-btn\">	
                                        <a href=\"registro_taller.html\" style=\"color:rgb(255, 255, 255);\"> Registrar otro Taller</a>
                                    </button>			
                                </div>
                            </div>
                        </div>
                    </div> ";
        
                }
                
                
                ?>

                <figure>
					<img src="assets/img/banner_tec8.png" alt="bachillerato general" class="img-responsive img-rounded center-box">
                </figure>
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

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>