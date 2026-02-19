<?php
require_once("auth/check_session.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Panel Clínico - MedSecure</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">

    <div class="nav">
        <div>
            <strong>MedSecure</strong>
            <span class="badge"><?php echo $_SESSION['rol']; ?></span>
        </div>
        <div>
            <a href="auth/logout.php">Cerrar sesión</a>
        </div>
    </div>

    <!-- ================= AÑADIR PACIENTE ================= -->

    <div class="card">
        <h2>Añadir Paciente</h2>

        <form id="formPaciente">

            Nombre
            <input type="text" name="nombre" required>

            DNI
            <input type="text" name="dni" required>

            Teléfono
            <input type="text" name="telefono" required>

            Diagnóstico
            <input type="text" name="diagnostico" required>

            Historial Médico
            <textarea name="historial" required></textarea>

            Tipo de Encriptación
            <select name="tipo_encriptacion" required>
                <option value="base64">Base64</option>
                <option value="clave">Cifrado con clave</option>
            </select>

            <button type="submit">Guardar Paciente</button>

        </form>
    </div>

    <br>

    <!-- ================= LISTADO ================= -->

    <div class="card">
        <h2>Listado de Pacientes</h2>
        <div id="tabla"></div>
    </div>

    <br>

    <!-- ================= LABORATORIO ================= -->

    <div class="card">
        <h2>Desencriptar</h2>

        ID del paciente
        <input type="number" id="pacienteId">

        <button onclick="verCifrado()">Ver Cifrado</button>
        <button onclick="verDescifrado()">Descifrar</button>

        <pre id="resultado"></pre>
    </div>

</div>

<script>

// =============================
// CARGAR TABLA
// =============================
function cargarPacientes(){
    fetch("api/get_pacientes.php")
    .then(res => res.json())
    .then(data => {

        let html = "<table class='table'>";
        html += "<tr><th>ID</th><th>Nombre</th><th>DNI</th><th>Teléfono</th><th>Diagnóstico</th><th>Método</th><th>Acciones</th></tr>";

        data.forEach(p => {
            html += `<tr>
                <td>${p.id}</td>
                <td>${p.nombre}</td>
                <td>${p.dni}</td>
                <td>${p.telefono}</td>
                <td>${p.diagnostico}</td>
                <td>${p.tipo_encriptacion ?? ''}</td>
                <td>
                    <button onclick="editarPaciente(${p.id})">Editar</button>
                    <button onclick="eliminarPaciente(${p.id})">Eliminar</button>
                </td>
            </tr>`;
        });

        html += "</table>";
        document.getElementById("tabla").innerHTML = html;
    });
}

cargarPacientes();

// =============================
// CREAR
// =============================
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
        this.reset();
        cargarPacientes();
    });
});

// =============================
// ELIMINAR
// =============================
function eliminarPaciente(id){

    if(!confirm("¿Seguro que deseas eliminar este paciente?")) return;

    const formData = new FormData();
    formData.append("id", id);

    fetch("api/delete_paciente.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        alert(data);
        cargarPacientes();
    });
}

// =============================
// EDITAR
// =============================
function editarPaciente(id){

    fetch("api/get_paciente_descifrado.php?id=" + id)
    .then(res => res.json())
    .then(data => {

        let nombre = prompt("Nombre:", data.nombre);
        if(nombre === null) return;

        let dni = prompt("DNI:", data.dni);
        let telefono = prompt("Teléfono:", data.telefono);
        let diagnostico = prompt("Diagnóstico:", data.diagnostico);
        let historial = prompt("Historial:", data.historial_medico);

        const formData = new FormData();
        formData.append("id", id);
        formData.append("nombre", nombre);
        formData.append("dni", dni);
        formData.append("telefono", telefono);
        formData.append("diagnostico", diagnostico);
        formData.append("historial", historial);
        formData.append("tipo_encriptacion", data.tipo_encriptacion);

        fetch("api/update_paciente.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(msg => {
            alert(msg);
            cargarPacientes();
        });
    });
}

// =============================
// VER CIFRADO
// =============================
function verCifrado(){
    const id = document.getElementById("pacienteId").value;

    fetch("api/get_pacientes_raw.php?id=" + id)
    .then(res => res.json())
    .then(data => {
        document.getElementById("resultado").textContent =
            JSON.stringify(data, null, 4);
    });
}

// =============================
// VER DESCIFRADO
// =============================
function verDescifrado(){
    const id = document.getElementById("pacienteId").value;

    fetch("api/get_paciente_descifrado.php?id=" + id)
    .then(res => res.json())
    .then(data => {
        document.getElementById("resultado").textContent =
            JSON.stringify(data, null, 4);
    });
}

</script>

</body>
</html>


