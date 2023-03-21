<?php

include "../util/ApplicationConfig.php";
include "../util/Database.php";
include "MatakuliahMahasiswaRepository.php";
include "MatakuliahMahasiswaService.php";
include "MatakuliahMahasiswaController.php";

$config = ApplicationConfig::get();
$connection = Database::getInstance($config);
$repository = new MatakuliahMahasiswaRepository($connection);
$service = new MatakuliahMahasiswaService($repository);
$controller = new MatakuliahMahasiswaController($service);

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
if ($method === "GET") {
    if (array_key_exists('id_mahasiswa', $_GET)) {
        $id = $_GET['id_mahasiswa'];
        $controller->getByMahasiswaId($id);
        return;
    }

    if (array_key_exists('id_matakuliah', $_GET)) {
        $id = $_GET['id_matakuliah'];
        $controller->getByMatakuliahId($id);
        return;
    }

    echo json_encode([
        "status" => "error",
        "code" => "400",
        "errors" => ["id_mahasiswa or id_matakuliah is required"],
    ]);
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