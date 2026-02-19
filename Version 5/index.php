<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>MedSecure Login</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h1>MedSecure</h1>
        <p class="muted">Sistema Clínico Encriptado</p>

        <h3>Acceso profesional</h3>

        <form action="auth/login.php" method="POST">
            Email
            <input type="email" name="email" required>

            Contraseña
            <input type="password" name="password" required>

            <button type="submit">Iniciar sesión</button>
        </form>

        <br>
        <a href="register.php">Crear cuenta profesional</a>
    </div>
</div>

</body>
</html>

