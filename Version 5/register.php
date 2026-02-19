<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Registro en MedSecure</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h1>Registro</h1>

        <form action="auth/register.php" method="POST">

            Nombre
            <input type="text" name="nombre" required>

            Email
            <input type="email" name="email" required>

            Contraseña
            <input type="password" name="password" required>

            Rol
            <select name="rol" required>
                <option value="admin">Administrador</option>
                <option value="medico">Médico</option>
                <option value="recepcion">Recepción</option>
            </select>

            <button type="submit">Registrar usuario</button>
        </form>

        <br>
        <a href="index.php">Volver al login</a>
    </div>
</div>

</body>
</html>

