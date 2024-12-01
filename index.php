<?php
error_reporting(~E_NOTICE);

$controller = $_GET['c'] ?? 'Auth'; // Default ke Admin
$method = $_GET['m'] ?? 'index';    // Default method index

// Load base controller
include_once "controller/Controller.class.php";

$controllerFile = "controller/$controller.class.php";
if (file_exists($controllerFile)) {
    include_once $controllerFile;
    if (class_exists($controller) && method_exists($controller, $method)) {
        (new $controller)->$method();
    } else {
        echo "Error: Method $method tidak ditemukan di $controller.";
    }
} else {
    echo "Error: Controller $controller tidak ditemukan.";
}
