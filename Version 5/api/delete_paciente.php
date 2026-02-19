<?php
require_once("../auth/check_session.php");
require_once("../config/database.php");

$id = $_POST['id'] ?? 0;

if($_SESSION['rol'] !== "admin"){
    die("No autorizado");
}

$stmt = $mysqli->prepare("DELETE FROM pacientes WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

echo "Paciente eliminado correctamente";
?>

