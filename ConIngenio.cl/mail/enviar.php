<?php
header('Content-Type: application/json');

// Configuración del correo
$destinatario = "contacto@coningenio.cl";
$asunto = "Nuevo mensaje de contacto - Servicio: " . ucfirst($_POST['servicio'] ?? '');

// Obtener datos del formulario
$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$servicio = $_POST['servicio'] ?? '';
$mensaje = $_POST['mensaje'] ?? '';

// Validar datos requeridos
if (empty($nombre) || empty($email) || empty($servicio) || empty($mensaje)) {
    echo json_encode(['success' => false, 'message' => 'Por favor complete todos los campos requeridos.']);
    exit;
}

// Construir el cuerpo del mensaje
$cuerpo = "Nombre: $nombre\n";
$cuerpo .= "Email: $email\n";
$cuerpo .= "Teléfono: $telefono\n";
$cuerpo .= "Servicio de interés: $servicio\n";
$cuerpo .= "Mensaje:\n$mensaje";

// Cabeceras del correo
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// En entorno de desarrollo, simulamos el envío exitoso
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false) {
    // Guardar en un archivo de log para desarrollo
    $logFile = 'mail/contactos.log';
    $logMessage = date('Y-m-d H:i:s') . " - Nuevo mensaje de contacto:\n" . $cuerpo . "\n\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
    
    echo json_encode(['success' => true, 'message' => '¡Mensaje enviado con éxito! Nos pondremos en contacto contigo pronto.']);
} else {
    // En producción, intentar enviar el correo real
    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
        echo json_encode(['success' => true, 'message' => '¡Mensaje enviado con éxito! Nos pondremos en contacto contigo pronto.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.']);
    }
}
?> 