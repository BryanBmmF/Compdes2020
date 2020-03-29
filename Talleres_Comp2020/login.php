<?php
    //Inicializando sesion
	session_start();
	include("conexion.php");
	//$conexion = new mysqli("localhost","root","adminmariadb","Cuestionarios");

	$User = $_POST['user'];
    $Pass = $_POST['pass'];

    $result = $conexion->prepare("SELECT * FROM USUARIO WHERE N_User=?");
    $result->execute(array($User));
    /*manejo de errores basico hay que mejorarlo */
    if($result->rowCount()!=1){
           /*error */ 
           echo "<script>toastr.warning('Fallo en el Login!', 'Advertencia!') </script>";
                echo "<br> 
                <div class=\"alert alert-warning\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <strong>¡Usuario Inexistente !</strong> El Usuario ".$User." no existe porfavor verifica bien al ingresarlo. 
                </div>
                ";

    } else {
        
        /*obteniendo datos de consulta */
        $row = $result->fetch(PDO::FETCH_BOTH);

        /*desencriptando pass */
        $pass_verif = password_verify($Pass,$row[Pass]);
        /*verificacion de pass ingresado */
        if ($pass_verif) {
            # code...
            $_SESSION['logueado']="si";
            $_SESSION['User'] = $User;
            /*redireccionar al index */
            echo "<script>window.location.href = \"inicio.php\";</script>";
           // header("Refresh: 1; url=index.html");

        } else {
             /*error */ 
           echo "<script>toastr.warning('Fallo en el Login!', 'Advertencia!') </script>";
           echo "<br> 
           <div class=\"alert alert-warning\">
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
           <strong>¡Fallo de Autenticacion !</strong> Usuario ".$User.", la contraseña ingresada no corresponde a tu usuario. 
           </div>
           ";

        }

    }

?>