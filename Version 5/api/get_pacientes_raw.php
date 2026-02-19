<?php
require_once("../auth/check_session.php");
require_once("../config/database.php");

header("Content-Type: application/json");

$id = $_GET['id'] ?? 0;

$stmt = $mysqli->prepare("SELECT * FROM pacientes WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 1){
    echo json_encode($result->fetch_assoc(), JSON_PRETTY_PRINT);
} else {
    echo json_encode(["error" => "Paciente no encontrado"]);
}
?>

