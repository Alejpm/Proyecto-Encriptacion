<?php
require_once("../auth/check_session.php");
require_once("../config/database.php");
require_once("../classes/Encriptador.php");

header("Content-Type: application/json");

$enc = new Encriptador();

$id = $_GET['id'] ?? 0;

$stmt = $mysqli->prepare("SELECT * FROM pacientes WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 1){

    $row = $result->fetch_assoc();

    if($row['tipo_encriptacion'] === "base64"){
        $row['dni'] = $enc->desencriptaBase64($row['dni']);
        $row['telefono'] = $enc->desencriptaBase64($row['telefono']);
        $row['diagnostico'] = $enc->desencriptaBase64($row['diagnostico']);
        $row['historial_medico'] = $enc->desencriptaBase64($row['historial_medico']);
    } else {
        $row['dni'] = $enc->desencriptaClave($row['dni']);
        $row['telefono'] = $enc->desencriptaClave($row['telefono']);
        $row['diagnostico'] = $enc->desencriptaClave($row['diagnostico']);
        $row['historial_medico'] = $enc->desencriptaClave($row['historial_medico']);
    }

    echo json_encode($row, JSON_PRETTY_PRINT);

} else {
    echo json_encode(["error" => "Paciente no encontrado"]);
}
?>

