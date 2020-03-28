<?php 
    /* consulta de talleres */
    include("conexion.php");

    /*prepare querycon formato de fecha */
    $result = $conexion->prepare("SELECT * FROM PARTICIPANTE");	
    // Execute si existe el valor consulta
    if (isset($_POST['consulta'])) {
        # code...
        $filtro = $_POST['consulta'];
        $var = "%".$filtro."%";

        $result = $conexion->prepare("SELECT * FROM PARTICIPANTE
                WHERE No_Pago LIKE ? OR CUI_Pasaporte LIKE ? OR Nombre LIKE ?");    
        if (!$result->execute(array($var, $var, $var))) {
            echo "An error occurred.\n";
            exit;
        }

    } else {
        //verifica consulta
        if (!$result->execute()) {
            echo "An error occurred.\n";
            exit;
        }

    }

    /* Encabezado de Tabla */  
    echo "
    <table class=\"table table-hover table-bordered text-center\">
    <thead>
        <th class=\"text-center\" rowspan=\"2\">Participantes Registrados</th>
    </thead>
    <tbody>
        <tr class=\"success\">
            <td><strong>No.</strong></td>
            <td><strong>No.Pago</strong></td>
            <td><strong>CUI/Pasaporte</strong></td>
            <td><strong>Nombre</strong></td>
            <td><strong>Estado de Pago</strong></td>
            <td><strong>Accion</strong></td>
        </tr>  
    
    ";
    
    /*Llenar Tabla */
    $correlativo = 1;
    while ($row = $result->fetch(PDO::FETCH_BOTH)) {
        /* PDO::FETCH_OBJ devuelve un objeto anonimo por nombre de columna ($row->Name_Colmun) */
        /* PDO::FETCH_BOTH devuelve un array indexado por nombre y número de columna */
        $estado = "No Revisado";
        if ($row[Pago_Revisado] == 1) {
            # code...
            $estado = "Revisado";
        }

        echo "
        <tr>
        <td><strong>".$correlativo."</strong></td>
        <td id='id_pago' data-id_pago='".$row[CUI_Pasaporte]."'><strong>".$row[No_Pago]."</strong></td>
        <td id='cui_pasaporte' data-id_cui_pasaporte='".$row[CUI_Pasaporte]."'><strong>".$row[CUI_Pasaporte]."</strong></td>
        <td id='nombre' data-id_nombre='".$row[CUI_Pasaporte]."'><strong>".$row[Nombre]."</strong></td>
        <td id='estado' data-id_estado='".$row[CUI_Pasaporte]."'><strong>".$estado."</strong></td>
        <td><div class=\"container-contact100-form-btn\">
                <button id=\"registrar\" data-id='".$row[CUI_Pasaporte]."' class=\"contact100-form-btn\">	
                    Revisar 
                </button>			
            </div>
        </td>
        </tr>
        ";

        $correlativo = $correlativo+1;
    }

    /*Fin tabla */
    echo "
    </tbody>
	</table> 
    ";

?>