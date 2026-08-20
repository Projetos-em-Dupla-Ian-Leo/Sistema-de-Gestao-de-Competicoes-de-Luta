<?php
    require_once __DIR__ . '/controller/LutadorController.php';
    $controller = new LutadorController();
    $action = isset($_GET['action']) ? $_GET['action'] : 'listar';
    switch ($action) {
        case 'criar'  : $controller->criar(); break;
        case 'editar' : $controller->editar(); break;
        case 'excluir': $controller->excluir(); break;
        case 'buscar' : $controller->buscar(); break;
        case 'listar' :
        default       : $controller->listar();
    }
?>