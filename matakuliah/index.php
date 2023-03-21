<?php

include "../util/ApplicationConfig.php";
include "../util/Database.php";
include "MatakuliahRepository.php";
include "MatakuliahService.php";
include "MatakuliahController.php";

$config = ApplicationConfig::get();
$connection = Database::getInstance($config);
$repository = new MatakuliahRepository($connection);
$service = new MatakuliahService($repository);
$controller = new MatakuliahController($service);

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
if ($method === "GET") {
    if (array_key_exists('id', $_GET)) {
        $id = $_GET['id'];
        $controller->getById($id);
        return;
    }

    $page = 0;
    $limitPerPage = 15;
    if (array_key_exists('page', $_GET)) {
        $page = $_GET['page'];
    }
    $controller->getAll($page, $limitPerPage);
    return;
}

if ($method === "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    if (count($data) == 1) {
        $controller->insert($data);
        return;
    }

    $controller->insertAll($data);
    return;
}