<?php
require_once("../config/database.php");

$usuario = $_POST['usuario_id'];
$paciente = $_POST['paciente_id'];
$accion = $_POST['accion'];

$stmt = $mysqli->prepare("INSERT INTO logs_acceso(usuario_id,paciente_id,accion) VALUES (?,?,?)");
$stmt->bind_param("iis",$usuario,$paciente,$accion);
$stmt->execute();
?>

