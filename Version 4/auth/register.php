<?php
require_once("../config/database.php");

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../register.php");
    exit();
}

$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$rol = $_POST['rol'] ?? '';

if(empty($nombre) || empty($email) || empty($password) || empty($rol)){
    die("Faltan datos");
}

// Comprobar si el email ya existe
$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    die("El email ya está registrado");
}

// Hash seguro
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("INSERT INTO usuarios(nombre,email,password,rol) VALUES (?,?,?,?)");
$stmt->bind_param("ssss",$nombre,$email,$passwordHash,$rol);

if($stmt->execute()){
    echo "Usuario registrado correctamente.<br>";
    echo '<a href="../index.php">Ir al login</a>';
} else {
    echo "Error al registrar usuario";
}
?>

