<?php
class BaseModel {
    protected $data = [];
    protected $lastId = 0;

    public function getAll() {
        return $this->data;
    }

    public function getById($id) {
        return isset($this->data[$id]) ? $this->data[$id] : null;
    }

    public function create($data) {
        $this->lastId++;
        $data['id'] = $this->lastId;
        $this->data[$this->lastId] = $data;
        return $this->lastId;
    }

    public function update($id, $data) {
        if (isset($this->data[$id])) {
            $data['id'] = $id;
            $this->data[$id] = $data;
            return true;
        }
        return false;
    }

    public function delete($id) {
        if (isset($this->data[$id])) {
            unset($this->data[$id]);
            return true;
        }
        return false;
    }
} 