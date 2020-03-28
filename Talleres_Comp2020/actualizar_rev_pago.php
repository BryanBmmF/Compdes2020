<?php
	/* incluir conexion bd */
	include("conexion.php");

	//recibiendo datos por post desde ajax en formato Json
	$id_participante = $_POST["id"]; //cui del participante
	
    $revis = "1";
	//ejecutando el uptate  >>esto podria trasladarse a un procedimiento almacenado
	$result = $conexion->prepare("UPDATE PARTICIPANTE
    SET Pago_Revisado=? WHERE CUI_Pasaporte=?");	
	// Execute
	if (!$result->execute(array($revis,$id_participante))) {
		//echo "An error occurred.\n";
		/*capturamos el array de error que nos manda el gestor mysql sobre la instruccion */
		$arr1 = $result->errorInfo();
		echo "<script>toastr.error('Fallos en la solicitud!', 'Error!') </script>";
		echo " 
		<div class=\"alert alert-danger\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
            <strong>¡Algo salio mal!</strong>".$arr1[2]." 
        </div>
		";
        
    } else {
		echo "<script>toastr.success('Solicitud Completada!', 'Exito!') </script>";
		echo " 
			<div class=\"alert alert-success\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <strong>¡Exito!</strong> El Número de Pago del Participante seleccionado paso a estar REVISADO
            </div>
		    ";
		
	}


?>