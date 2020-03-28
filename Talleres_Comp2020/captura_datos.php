<?php
	/* incluir conexion bd */
	include("conexion.php");

	//recibiendo datos por post desde ajax en formato Json
	$id_actividad = $_POST["id"];
	$id_pago = $_POST["identifier"];

	//$result = $conexion->prepare("SELECT *FROM PARTICIPANTE WHERE No_Pago=?");
	//verificacion con el procedimiento almacenado verificar_pago
	$result = $conexion->prepare("SELECT verificar_pago(?)");	
	// Execute
	//$result->execute(array($id_pago));
	
	/*Parametros por defecto incluyendo fecha y hora local del sistema */
	$lugar = "Ciudad";
	//$fecha = "2020-06-04 14:35:06.00";
	$fecha = date("Y-m-d H:i:s");
	$monto = 1; //sin cobro
	$concepto = "Taller";
	$rol = "Participante";

	if (!$result->execute(array($id_pago))) {
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
		//obteniendo una unica columna en este caso el valor de retorno de la funcion
		$row = $result->fetchColumn();

		/* Query de Registro */
        $stmtRegistro = $conexion->prepare("INSERT INTO REGISTRO_PAGO(ID_Pago,P_CUI_Pasaporte,
		A_ID_Actividad,Lugar,Fecha_Pago,Monto,Concepto_Pago,Tipo_Rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        // Bind
        $stmtRegistro->bindParam(1, $id_pago);
		//$stmtRegistro->bindParam(2, $row->CUI_Pasaporte);
		$stmtRegistro->bindParam(2, $row);
        $stmtRegistro->bindParam(3, $id_actividad);
        $stmtRegistro->bindParam(4, $lugar);
        $stmtRegistro->bindParam(5, $fecha);
        $stmtRegistro->bindParam(6, $monto);
        $stmtRegistro->bindParam(7, $concepto);
        $stmtRegistro->bindParam(8, $rol);
        // Execute
        //$stmtRegistro->execute();

		if (!$stmtRegistro->execute()) {
			/*capturamos el array de error que nos manda el gestor mysql sobre la instruccion */
			$arr2 = $stmtRegistro->errorInfo();
			//error
			echo "<script>toastr.error('Fallos en la solicitud!', 'Error!') </script>";
			echo " 
			<div class=\"alert alert-danger\">
            	<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
            	<strong>¡Algo salio mal! </strong>".$arr2[2]."  
        	</div>
			";

			//El numero de transaccion de pago no ha sido verificado o o el taller esta sin mas cupo disponible!!.
		} else {
			echo "<script>toastr.success('Solicitud Completada!', 'Exito!') </script>";
			echo " 
			<div class=\"alert alert-success\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <strong>¡Exito!</strong> Tu inscripción al taller  se completo correctamente
            </div>
			";

		}
		
		
	}


?>