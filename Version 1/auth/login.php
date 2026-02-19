<?php
session_start();
require_once("../config/database.php");

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../index.php");
    exit();
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if(empty($email) || empty($password)){
    die("Faltan datos del formulario");
}

$stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 1){
    $user = $result->fetch_assoc();

    if(password_verify($password,$user['password'])){
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['rol'] = $user['rol'];
        header("Location: ../dashboard.php");
        exit();
    }
}

echo "Login incorrecto";
?>

