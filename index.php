<?php
error_reporting(~E_NOTICE);

$connect = mysqli_connect("localhost", "root", "", "starluxetransport");
if($connect->connect_error){
    die("Database connect failed: " . $connect->connect_error);
}

$controller = $_GET['c'] ?? 'Auth'; // Default ke Auth
$method = $_GET['m'] ?? 'index';    // Default method index

// Load base controller
include_once "controller/Controller.class.php";

$controllerFile = "controller/$controller.class.php";
if (file_exists($controllerFile)) {
    include_once $controllerFile;
    if (class_exists($controller) && method_exists($controller, $method)) {
        (new $controller($connect))->$method(); //Oper koneksi db ke controller
    } else {
        echo "Error: Method $method tidak ditemukan di $controller.";
    }
} else {
    echo "Error: Controller $controller tidak ditemukan.";
}
