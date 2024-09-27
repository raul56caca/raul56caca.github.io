<?php 
$h = "localhost";
$u = "root"; 
$p = ""; 
$db = "formulario";

$conn = new mysqli($h, $u, $p, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    if (!empty($correo) && !empty($mensaje)) {
        $sql = "INSERT INTO datos (correo, mensaje) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $correo, $mensaje);

        if ($stmt->execute()) {
            echo "Mensaje enviado con éxito";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Por favor completa todos los campos";
    }
}

$conn->close();
?>