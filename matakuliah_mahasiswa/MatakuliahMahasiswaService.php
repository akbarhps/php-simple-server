<?php

include "../util/Helper.php";

class MatakuliahMahasiswaService
{

    private $repository;
    private $fields = ["nama", "semester", "kode_prodi"];

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getByMahasiswaId($id)
    {
        $data = $this->repository->getByMahasiswaId($id);
        return [
            "status" => "success",
            "code" => "200",
            "data" => $data,
        ];
    }

    public function getByMatakuliahId($id)
    {
        $data = $this->repository->getByMatakuliahId($id);
        return [
            "status" => "success",
            "code" => "200",
            "data" => $data,
        ];
    }

    public function insert($data): array
    {
        $data['id'] = Helper::generateUUID();
        $errors = Helper::validateFields($data, ["id_mahasiswa", "id_matakuliah"]);
        if ($errors !== null) {
            return [
                "status" => "error",
                "code" => "400",
                "errors" => $errors,
            ];
        }

        $this->repository->insert($data);
        return [
            "status" => "success",
            "code" => "200",
            "data" => $data,
        ];
    }

    public function insertAll($data)
    {
        $res = [
            "status" => "success",
            "code" => "200",
            "data" => [],
        ];

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['id'] = Helper::generateUUID();
            $errors = Helper::validateFields($data[$i], ["id_mahasiswa", "id_matakuliah"]);
            if ($errors !== null) {
                return [
                    "status" => "error",
                    "code" => "400",
                    "errors" => $errors,
                ];
            }

            $this->repository->insert($data[$i]);
            $res['data'][] = $data[$i];
        }

        return $res;
    }

    public function delete($id)
    {
        $this->repository->delete($id);
        return [
            "status" => "success",
            "code" => "200",
        ];
    }
}