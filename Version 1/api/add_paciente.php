<?php
require_once("../config/database.php");
require_once("../classes/Encriptador.php");

$enc = new Encriptador();

$nombre = $_POST['nombre'] ?? '';
$dni = $_POST['dni'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$diagnostico = $_POST['diagnostico'] ?? '';
$historial = $_POST['historial'] ?? '';

if(empty($nombre)) {
    die("Faltan datos");
}

$dni = $enc->encripta($dni);
$telefono = $enc->encripta($telefono);
$diagnostico = $enc->encripta($diagnostico);
$historial = $enc->encripta($historial);

$stmt = $mysqli->prepare("INSERT INTO pacientes(nombre,dni,telefono,diagnostico,historial_medico) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss",$nombre,$dni,$telefono,$diagnostico,$historial);
$stmt->execute();

echo "Paciente añadido correctamente";
?>

