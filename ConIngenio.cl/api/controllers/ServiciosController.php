<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/ServicioModel.php';

class ServiciosController extends BaseController {
    public function __construct() {
        parent::__construct(new ServicioModel());
    }
} 