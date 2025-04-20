<?php
class BaseController {
    protected $model;
    
    public function __construct($model) {
        $this->model = $model;
    }

    public function getAll() {
        $data = $this->model->getAll();
        echo json_encode($data);
    }

    public function getById($id) {
        $data = $this->model->getById($id);
        if ($data) {
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Recurso no encontrado']);
        }
    }

    public function create($data) {
        $result = $this->model->create($data);
        if ($result) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Recurso creado exitosamente', 'id' => $result]);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Error al crear el recurso']);
        }
    }

    public function update($id, $data) {
        $result = $this->model->update($id, $data);
        if ($result) {
            echo json_encode(['mensaje' => 'Recurso actualizado exitosamente']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Recurso no encontrado']);
        }
    }

    public function delete($id) {
        $result = $this->model->delete($id);
        if ($result) {
            echo json_encode(['mensaje' => 'Recurso eliminado exitosamente']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Recurso no encontrado']);
        }
    }
} 