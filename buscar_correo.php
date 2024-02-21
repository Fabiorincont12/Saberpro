<?php
// Datos de conexión a la base de datos
$servername = "127.0.0.1";
$username = "root";
$password = "fama1112";
$database = "saberpro";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener identificación del formulario
$identificacion = $_POST['identificacion'];

// Consulta SQL para obtener el correo asociado a la identificación
$sql = "SELECT usuario FROM saberpro.credenciales WHERE numero_documento = '$identificacion'";
$result = $conn->query($sql);

// Verificar si se encontró el correo
if ($result->num_rows > 0) {
    // Mostrar el correo encontrado
    $row = $result->fetch_assoc();
    echo "El correo asociado a la identificación $identificacion es: " . $row["correo"];
} else {
    echo "No se encontró ningún correo asociado a la identificación $identificacion";
}

// Cerrar conexión
$conn->close();
?>
