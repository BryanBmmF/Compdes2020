<?php 
    /* consulta de talleres */
    include("conexion.php");

    $tipo_actividad = "Taller";

    /*prepare querycon formato de fecha */
    $result = $conexion->prepare("SELECT ID_Actividad,Nombre,Tipo_Actividad,Lugar, DATE_FORMAT(Fecha_Realizacion, '%d/%m/%Y  %H:%i \hrs.'),
    Precio,Descripcion,Modalidad,Cupo_Limite FROM ACTIVIDAD WHERE Tipo_Actividad=?");	
    // Execute
    //$result->execute(array("Taller"));    
    if (!$result->execute(array($tipo_actividad))) {
        echo "An error occurred.\n";
        exit;
    }
    
    /* Encabezado de Tabla */  
    echo "
    <table class=\"table table-hover table-bordered text-center\">
    <thead>
        <th class=\"text-center\" rowspan=\"2\">Talleres Disponibles</th>
    </thead>
    <tbody>
        <tr class=\"success\">
            <td><strong>No.</strong></td>
            <td><strong>Taller</strong></td>
            <td><strong>Lugar</strong></td>
            <td><strong>Fecha y Hora</strong></td>
            <td><strong>Modalidad</strong></td>
            <td><strong>Cupo Disponible</strong></td>
            <td><strong>Acción</strong></td>
        </tr>  
    
    ";
    
    /*Llenar Tabla */
    $correlativo = 1;
    while ($row = $result->fetch(PDO::FETCH_BOTH)) {
        /* PDO::FETCH_OBJ devuelve un objeto anonimo por nombre de columna ($row->Name_Colmun) */
        /* PDO::FETCH_BOTH devuelve un array indexado por nombre y número de columna */
        echo "
        <tr>
        <td><strong>".$correlativo."</strong></td>
        <td id='nombre' data-id_actividad='".$row[ID_Actividad]."'><strong>".$row[Nombre]."</strong></td>
        <td id='lugar' data-id_lugar='".$row[ID_Actividad]."'><strong>".$row[Lugar]."</strong></td>
        <td id='fecha_realizacion' data-id_fecha_realizacion='".$row[ID_Actividad]."'><strong>".$row[4]."</strong></td>
        <td id='modalidad' data-id_modalidad='".$row[ID_Actividad]."'><strong>".$row[Modalidad]."</strong></td>
        <td id='cupo_limite' data-id_cupo_limite='".$row[ID_Actividad]."'><strong>".$row[Cupo_Limite]."</strong></td>
        <td><div class=\"container-contact100-form-btn\">
                <button id=\"registrar\" data-id='".$row[ID_Actividad]."' class=\"contact100-form-btn\">	
                    Registrar Participación
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