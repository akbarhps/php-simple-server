<?php

include "../util/ApplicationConfig.php";
include "../util/Database.php";
include "../mahasiswa/MahasiswaRepository.php";
include "../matakuliah/MatakuliahRepository.php";
include "../matakuliah_mahasiswa/MatakuliahMahasiswaRepository.php";

$config = ApplicationConfig::get();
$connection = Database::getInstance($config);

$mhsRepo = new MahasiswaRepository($connection);
$mkRepo = new MatakuliahRepository($connection);
$mkMhsRepo = new MatakuliahMahasiswaRepository($connection);

$matakuliah = $mkRepo->getAll(1, 100);
$mahasiswa = $mhsRepo->getAll(0, 100);

for ($i = 0; $i < count($mahasiswa); $i++) {
    for ($j = 0; $j < count($matakuliah); $j++) {
        $data = [
            "id_mahasiswa" => $mahasiswa[$i]['id'],
            "id_matakuliah" => $matakuliah[$j]['id'],
        ];
        $mkMhsRepo->insert($data);
    }
}