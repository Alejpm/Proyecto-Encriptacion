<?php
require_once("../auth/check_session.php");
require_once("../config/database.php");
require_once("../classes/Encriptador.php");

$enc = new Encriptador();

$nombre = $_POST['nombre'] ?? '';
$dni = $_POST['dni'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$diagnostico = $_POST['diagnostico'] ?? '';
$historial = $_POST['historial'] ?? '';
$tipo = $_POST['tipo_encriptacion'] ?? 'base64';

if(empty($nombre)) {
    die("Faltan datos");
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

$stmt = $mysqli->prepare("INSERT INTO pacientes(nombre,dni,telefono,diagnostico,historial_medico,tipo_encriptacion) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss",$nombre,$dni,$telefono,$diagnostico,$historial,$tipo);
$stmt->execute();

echo "Paciente añadido correctamente con método: " . $tipo;
?>

