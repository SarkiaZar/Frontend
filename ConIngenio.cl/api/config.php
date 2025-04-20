<?php
// Configuración básica
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de la API
define('API_VERSION', '1.0.0');
define('API_BASE_PATH', '/Programacion-Front-Back/api/');

// Configuración de CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json; charset=utf-8');

// Manejar solicitudes OPTIONS para CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'programacion_front_back');

// Función para obtener la conexión a la base de datos
function getDBConnection() {
    try {
        $conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        error_log("Error de conexión: " . $e->getMessage());
        return null;
    }
}

// Función para debug
function debug($data) {
    if (defined('DEBUG') && DEBUG) {
        error_log(print_r($data, true));
    }
} 