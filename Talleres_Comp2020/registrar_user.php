<?php

	include("conexion.php");

	$User = $_POST['user'];
	$Pass = $_POST['pass'];

    /*encriptando password */
    $pass_encript = password_hash($Pass,PASSWORD_DEFAULT);
    
    $result = $conexion->prepare("INSERT INTO USUARIO VALUES(?,?)");

    /*manejo de errores basico hay que mejorarlo */
    if(!$result->execute(array($User,$pass_encript))){
           /*error */ 
           echo "<script>toastr.warning('Registro no Completado!', 'Advertencia!') </script>";
                echo "<br> 
                <div class=\"alert alert-warning\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <strong>¡Fallos de Registro!</strong> Es posible que este usuario ya exista, porfavor piensa en otro.  
                </div>
                ";

    } else {
        /*ir al index i hacer sesion start */
        echo "<script>toastr.success('Registro Completado!', 'Exito!') </script>";
                echo "<br> 
                <div class=\"alert alert-info\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <strong>¡Exito en el Registro!</strong> tu usuario a sido registrado 
                </div>
                ";

    }

?>