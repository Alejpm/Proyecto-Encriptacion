<?php
require_once("../auth/check_session.php");
require_once("../config/database.php");
require_once("../classes/Encriptador.php");

header("Content-Type: application/json");

$enc = new Encriptador();

$result = $mysqli->query("SELECT * FROM pacientes");

$datos = [];

while($row = $result->fetch_assoc()){

    if($_SESSION['rol'] !== "recepcion"){

        if($row['tipo_encriptacion'] === "base64"){
            $row['dni'] = $enc->desencriptaBase64($row['dni']);
            $row['telefono'] = $enc->desencriptaBase64($row['telefono']);
            $row['diagnostico'] = $enc->desencriptaBase64($row['diagnostico']);
            $row['historial_medico'] = $enc->desencriptaBase64($row['historial_medico']);
        } 
        else if($row['tipo_encriptacion'] === "clave"){
            $row['dni'] = $enc->desencriptaClave($row['dni']);
            $row['telefono'] = $enc->desencriptaClave($row['telefono']);
            $row['diagnostico'] = $enc->desencriptaClave($row['diagnostico']);
            $row['historial_medico'] = $enc->desencriptaClave($row['historial_medico']);
        }

    } else {
        $row['dni'] = "****";
        $row['diagnostico'] = "Restringido";
        $row['historial_medico'] = "Restringido";
    }

    $datos[] = $row;
}

echo json_encode($datos, JSON_PRETTY_PRINT);
?>

