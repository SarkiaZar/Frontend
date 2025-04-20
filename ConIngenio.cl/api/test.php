<?php
require_once 'config.php';

try {
    $conn = getDBConnection();
    if ($conn) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Conexión a la base de datos establecida correctamente'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No se pudo establecer la conexión a la base de datos'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?> 