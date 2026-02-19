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

<h3>Añadir Paciente</h3>

<form id="formPaciente">

Nombre:<br>
<input type="text" name="nombre" required><br><br>

DNI:<br>
<input type="text" name="dni" required><br><br>

Teléfono:<br>
<input type="text" name="telefono" required><br><br>

Diagnóstico:<br>
<input type="text" name="diagnostico" required><br><br>

Historial Médico:<br>
<textarea name="historial" required></textarea><br><br>

Tipo de Encriptación:<br>
<select name="tipo_encriptacion" required>
    <option value="base64">Base64</option>
    <option value="clave">Cifrado con clave</option>
</select><br><br>

<button type="submit">Guardar Paciente</button>

</form>

<hr>


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
	document.getElementById("formPaciente").addEventListener("submit", function(e){
	    e.preventDefault();

	    const formData = new FormData(this);

	    fetch("api/add_paciente.php", {
		method: "POST",
		body: formData
	    })
	    .then(res => res.text())
	    .then(data => {
		alert(data);
		location.reload();
	    })
	    .catch(err => {
		alert("Error al guardar paciente");
		console.error(err);
	    });
	});

</script>



</body>
</html>

