<?php
	/* incluir conexion bd */
	include("conexion.php");

	//recibiendo datos por post desde ajax en formato Json
	$id_actividad = $_POST["id"];
	$id_pago = $_POST["identifier"];

	$result = $conexion->prepare("SELECT verificar_pago(?)");	
	
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
		echo "<script>toastr.warning('Fallos en la solicitud!', 'Advertencia!') </script>";
		
		echo "<br> <div class=\"row\">
            <div class=\"panel panel-success\">
                <div class=\"panel-heading\">Lo sentimos no pudo completarse tu asignacion!!! </div>
                <div class=\"panel-body\">
                    <div class=\"alert alert-warning\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>¡Detalles!</strong> ".$arr1[2]." 
                    </div>
                </div>
                <div class=\"panel-footer\">
                    <div class=\"container-contact100-form-btn\">
                        <button class=\"contact100-form-btn\">	
                            <a href=\"asignacion_taller.php\" style=\"color:rgb(255, 255, 255);\"> Volver a Intentarlo</a>
                        </button>			
                    </div>
                </div>
            </div>
        </div> ";
        
    } else {
		//obteniendo una unica columna en este caso el valor de retorno de la funcion que es el cui
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

			/* Verificamos a que error corresponde en este caso es el de (Ya Asignado)*/
			if ($arr2[0] = '45004') {
				# code... Mostramos info del taller asignado

				$result = $conexion->prepare("SELECT u.ID_Actividad,u.Nombre,u.Tipo_Actividad,u.Lugar, DATE_FORMAT(Fecha_Realizacion, '%d/%m/%Y  %H:%i \hrs.'),
					u.Precio,u.Descripcion,u.Modalidad,u.Cupo_Limite, d.ID_Pago FROM ACTIVIDAD u INNER JOIN REGISTRO_PAGO d ON u.ID_Actividad = d.A_ID_Actividad
					WHERE d.ID_Pago =?");
				$result->execute(array($id_pago));

				$row = $result->fetch(PDO::FETCH_BOTH);

				$result2 = $conexion->prepare("SELECT * FROM PARTICIPANTE WHERE No_Pago=?");
				$result2->execute(array($id_pago));

				$row2 = $result2->fetch(PDO::FETCH_BOTH);
				$img = rand(22, 40);
				//error
         		echo "<script>toastr.warning('Asignado Actualmente!', 'Advertencia!') </script>";
         		echo "<br> <div class=\"row\">
                 <div class=\"panel panel-success\">
                     <div class=\"panel-heading\">Estimado participante ".$row2[Nombre]." no te podemos asignar al taller que solicitaste.</div>
                     <div class=\"panel-body\">
                        <div class=\"alert alert-warning\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                            <strong>¡Detalles!</strong> ".$arr2[2]." 
						</div>
						<h3> Taller asignado actualmente:</h3>
						<div class=\"col-xs-12 col-sm-6 col-md-4\">
                        	<div class=\"tile-gallery\">
                        	    <img src=\"assets/gallery/icon".$img.".png\" alt=\"Default\">
                        		    <p class=\"text-center\"><strong>".$row[Nombre]."</strong></p>
                                    <span class=\"text-center\">
                                        <strong><small>Lugar: ".$row[Lugar]."</small></strong><br>
                                        <strong><small>Fecha: ".$row[4]."</small></strong><br>
                                        <strong><small>Modalidad: ".$row[Modalidad]."</small></strong><br>
                                    </span>
                        		    <div class=\"divider-general\"></div>
                        	</div>
						</div>        
                     </div>
                     <div class=\"panel-footer\">
                         <div class=\"container-contact100-form-btn\">
                             <button class=\"contact100-form-btn\">	
                                 <a href=\"index.html\" style=\"color:rgb(255, 255, 255);\"> Volver al Inicio</a>
                             </button>			
                         </div>
                     </div>
                 </div>
             	</div> ";
			} else {
        		//otro error de cupo lleno pero ya no es necesario porque no se muestran los talleres llenos
        		echo "<script>toastr.warning('Asignacion no completada!', 'Advertencia!') </script>";
        		echo "<br> <div class=\"row\">
                <div class=\"panel panel-warning\">
                    <div class=\"panel-heading\">Lo sentimos no pudo completarse tu asignacion!!! </div>
                    <div class=\"panel-body\">
                        <div class=\"alert alert-warning\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                            <strong>¡Detalles!</strong> ".$arr2[2]." 
                        </div>
                    </div>
                    <div class=\"panel-footer\">
                        <div class=\"container-contact100-form-btn\">
                            <button class=\"contact100-form-btn\">	
                                <a href=\"index.html\" style=\"color:rgb(255, 255, 255);\"> Volver al inicio</a>
                            </button>			
                        </div>
                    </div>
                </div>
            	</div> ";

			}
			
		} else {
			//obteniendo info de taller asignado
			$result3 = $conexion->prepare("SELECT ID_Actividad,Nombre,Tipo_Actividad,Lugar, DATE_FORMAT(Fecha_Realizacion, '%d/%m/%Y  %H:%i \hrs.'),
			Precio,Descripcion,Modalidad,Cupo_Limite FROM ACTIVIDAD WHERE ID_Actividad=?");
			$result3->execute(array($id_actividad));

			$row = $result3->fetch(PDO::FETCH_BOTH);
			$img = rand(22, 40);

			echo "<script>toastr.success('Solicitud Completada!', 'Exito!') </script>";
			echo " <div class=\"row\">
                    <div class=\"panel panel-success\">
                        <div class=\"panel-heading\">Tu Asignacion al taller solicitado se completo con exito!!!</div>
                        <div class=\"panel-body\">
                            <div class=\"alert alert-success\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
									<strong>¡Importante!</strong> Ahora te encuentras asignado a un taller en el Compdes, espera 
									nuestras instrucciones, te estaremos informando.
                            </div>	
							<h3> Taller Asignado:</h3>
                     		<div class=\"col-xs-12 col-sm-6 col-md-4\">
                             	<div class=\"tile-gallery\">
                             	    <img src=\"assets/gallery/icon".$img.".png\" alt=\"Default\">
                             		    <p class=\"text-center\"><strong>".$row[Nombre]."</strong></p>
                                        <span class=\"text-center\">
                                            <strong><small>Lugar: ".$row[Lugar]."</small></strong><br>
                                            <strong><small>Fecha: ".$row[4]."</small></strong><br>
                                            <strong><small>Modalidad: ".$row[Modalidad]."</small></strong><br>
                                        </span>
                             		    <div class=\"divider-general\"></div>
                             	</div>
							</div> 
						</div>       
                        <div class=\"panel-footer\">
                            <div class=\"container-contact100-form-btn\">
                                <button class=\"contact100-form-btn\">	
                                    <a href=\"index.html\" style=\"color:rgb(255, 255, 255);\"> Volver al Inicio</a>
                                </button>			
                            </div>
                        </div>
                    </div>
                </div> ";
		}
		
		
	}


?>