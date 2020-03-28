<?php 
    /* consulta de talleres que tienen cupo ahun*/
    include("conexion.php");

    $tipo_actividad = "Taller";

    /*prepare querycon formato de fecha */
    $result = $conexion->prepare("SELECT ID_Actividad,Nombre,Tipo_Actividad,Lugar, DATE_FORMAT(Fecha_Realizacion, '%d/%m/%Y  %H:%i \hrs.'),
    Precio,Descripcion,Modalidad,Cupo_Limite FROM ACTIVIDAD WHERE Tipo_Actividad=? AND Cupo_Limite>?");	
    // Execute   
    if (!$result->execute(array($tipo_actividad,0))) {
        echo "An error occurred.\n";
        exit;
    }
  
    /*Llenar catalogo de talleres*/
    $correlativo = 1;
    while ($row = $result->fetch(PDO::FETCH_BOTH)) {
        /* PDO::FETCH_OBJ devuelve un objeto anonimo por nombre de columna ($row->Name_Colmun) */
        /* PDO::FETCH_BOTH devuelve un array indexado por nombre y número de columna */         

        $img = rand(22, 40); /*temporal debera asignarse un numero de imagen a cada taller */

        echo "
        <div class=\"col-xs-12 col-sm-6 col-md-4\">
			<div class=\"tile-gallery\">
			    <img src=\"assets/gallery/icon".$img.".png\" alt=\"Default\">
				    <p class=\"text-center\"><strong>".$correlativo.". ".$row[Nombre]."</strong></p>
                    <span class=\"text-center\">
                        <strong><small>Lugar: ".$row[Lugar]."</small></strong><br>
                        <strong><small>Fecha: ".$row[4]."</small></strong><br>
                        <strong><small>Modalidad: ".$row[Modalidad]."</small></strong><br>
                        <strong><small>Cupo Disponible: ".$row[Cupo_Limite]."</small></strong>
                    </span>
				    <div class=\"divider-general\"></div>
                    <div class=\"container-contact100-form-btn\">
                        <button id=\"registrar\" data-id='".$row[ID_Actividad]."' class=\"contact100-form-btn\">	
                            Asignarme
                        </button>			
                    </div>
			</div>
		</div>        
        ";

        $correlativo = $correlativo+1;
    }


?>