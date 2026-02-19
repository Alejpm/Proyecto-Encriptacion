<?php
require_once("auth/check_session.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard MedSecure</title>
</head>
<body>

<h2>Panel MedSecure</h2>
<p>Rol: <?php echo $_SESSION['rol']; ?></p>
<a href="auth/logout.php">Cerrar sesión</a>

<h3>Pacientes</h3>
<div id="tabla"></div>

<script>
fetch("api/get_pacientes.php")
.then(res => res.json())
.then(data => {

    let html = "<table border='1'>";
    html += "<tr><th>ID</th><th>Nombre</th><th>DNI</th><th>Teléfono</th><th>Diagnóstico</th></tr>";

    data.forEach(p => {
        html += `<tr>
        <td>${p.id}</td>
        <td>${p.nombre}</td>
        <td>${p.dni}</td>
        <td>${p.telefono}</td>
        <td>${p.diagnostico}</td>
        </tr>`;
    });

    html += "</table>";

    document.getElementById("tabla").innerHTML = html;
});
</script>

</body>
</html>

