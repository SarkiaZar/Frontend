<?php
require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/../config.php';

class ServicioModel extends BaseModel {
    private $conn;

    public function __construct() {
        $this->conn = getDBConnection();
    }

    public function getAll() {
        try {
            $stmt = $this->conn->query("SELECT * FROM servicios");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error al obtener servicios: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM servicios WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error al obtener servicio: " . $e->getMessage());
            return null;
        }
    }

    public function create($data) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO servicios (nombre, descripcion, icono) VALUES (?, ?, ?)");
            $stmt->execute([$data['nombre'], $data['descripcion'], $data['icono']]);
            return $this->conn->lastInsertId();
        } catch(PDOException $e) {
            error_log("Error al crear servicio: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data) {
        try {
            $stmt = $this->conn->prepare("UPDATE servicios SET nombre = ?, descripcion = ?, icono = ? WHERE id = ?");
            return $stmt->execute([$data['nombre'], $data['descripcion'], $data['icono'], $id]);
        } catch(PDOException $e) {
            error_log("Error al actualizar servicio: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM servicios WHERE id = ?");
            return $stmt->execute([$id]);
        } catch(PDOException $e) {
            error_log("Error al eliminar servicio: " . $e->getMessage());
            return false;
        }
    }
} 