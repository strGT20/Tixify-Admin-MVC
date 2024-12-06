<?php
session_start();

$connect = mysqli_connect("localhost", "root", "", "starluxetransport");
if($connect->connect_error){
    die("Database connect failed: " . $connect->connect_error);
}

if(isset($_SESSION['id_user'])){
    $controller = $_GET['c'] ?? 'Bus';
} else {
    $controller = $_GET['c'] ?? 'Auth';
}
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

include "view/header.php";
include "view/footer.php";