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
        $row['dni'] = $enc->desencripta($row['dni']);
        $row['telefono'] = $enc->desencripta($row['telefono']);
        $row['diagnostico'] = $enc->desencripta($row['diagnostico']);
        $row['historial_medico'] = $enc->desencripta($row['historial_medico']);
    } else {
        $row['dni'] = "****";
        $row['diagnostico'] = "Restringido";
        $row['historial_medico'] = "Restringido";
    }

    $datos[] = $row;
}

echo json_encode($datos,JSON_PRETTY_PRINT);
?>

