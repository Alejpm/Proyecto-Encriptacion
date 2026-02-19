<?php
require_once("../auth/check_session.php");
require_once("../config/database.php");
require_once("../classes/Encriptador.php");

$enc = new Encriptador();

$id = $_POST['id'] ?? 0;
$nombre = $_POST['nombre'] ?? '';
$dni = $_POST['dni'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$diagnostico = $_POST['diagnostico'] ?? '';
$historial = $_POST['historial'] ?? '';
$tipo = $_POST['tipo_encriptacion'] ?? 'base64';

if(empty($id)){
    die("ID inválido");
}

if($tipo === "base64"){
    $dni = $enc->encriptaBase64($dni);
    $telefono = $enc->encriptaBase64($telefono);
    $diagnostico = $enc->encriptaBase64($diagnostico);
    $historial = $enc->encriptaBase64($historial);
} else {
    $dni = $enc->encriptaClave($dni);
    $telefono = $enc->encriptaClave($telefono);
    $diagnostico = $enc->encriptaClave($diagnostico);
    $historial = $enc->encriptaClave($historial);
}

$stmt = $mysqli->prepare("UPDATE pacientes SET nombre=?, dni=?, telefono=?, diagnostico=?, historial_medico=?, tipo_encriptacion=? WHERE id=?");
$stmt->bind_param("ssssssi",$nombre,$dni,$telefono,$diagnostico,$historial,$tipo,$id);
$stmt->execute();

echo "Paciente actualizado correctamente";
?>

