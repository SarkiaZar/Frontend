<?php
require_once __DIR__ . '/config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Obtener la URL solicitada
$request_uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Eliminar la parte de la ruta base
$path = str_replace(API_BASE_PATH, '', $request_uri);
$path = trim($path, '/');

// Dividir la ruta en segmentos
$segments = explode('/', $path);
$resource = $segments[0] ?? '';

// Debug information
error_log("Request URI: " . $request_uri);
error_log("API Base Path: " . API_BASE_PATH);
error_log("Path: " . $path);
error_log("Resource: " . $resource);
error_log("Controller File: " . __DIR__ . '/controllers/' . $resource . 'Controller.php');

// Incluir el controlador correspondiente
$controller_file = __DIR__ . '/controllers/' . $resource . 'Controller.php';

if (file_exists($controller_file)) {
    require_once $controller_file;
    $controller_class = ucfirst($resource) . 'Controller';
    $controller = new $controller_class();

    // Determinar la acción basada en el método HTTP
    switch ($method) {
        case 'GET':
            if (isset($segments[1])) {
                $controller->getById($segments[1]);
            } else {
                $controller->getAll();
            }
            break;
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['error' => 'JSON inválido']);
                break;
            }
            $controller->create($data);
            break;
        case 'PUT':
            if (isset($segments[1])) {
                $data = json_decode(file_get_contents('php://input'), true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    http_response_code(400);
                    echo json_encode(['error' => 'JSON inválido']);
                    break;
                }
                $controller->update($segments[1], $data);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'ID no proporcionado']);
            }
            break;
        case 'DELETE':
            if (isset($segments[1])) {
                $controller->delete($segments[1]);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'ID no proporcionado']);
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
} else {
    http_response_code(404);
    echo json_encode([
        'error' => 'Recurso no encontrado',
        'details' => [
            'request_uri' => $request_uri,
            'api_base_path' => API_BASE_PATH,
            'path' => $path,
            'resource' => $resource,
            'controller_file' => $controller_file
        ]
    ]);
} 