<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Registro MedSecure</title>
</head>
<body>

<h2>Registro de Usuario</h2>

<form action="auth/register.php" method="POST">

Nombre:<br>
<input type="text" name="nombre" required><br><br>

Email:<br>
<input type="email" name="email" required><br><br>

Password:<br>
<input type="password" name="password" required><br><br>

Rol:<br>
<select name="rol" required>
    <option value="admin">Admin</option>
    <option value="medico">Médico</option>
    <option value="recepcion">Recepción</option>
</select><br><br>

<button type="submit">Registrarse</button>

</form>

<br>
<a href="index.php">Volver al login</a>

</body>
</html>

