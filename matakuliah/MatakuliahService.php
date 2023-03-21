<?php

include "../util/Helper.php";

class MatakuliahService
{

    private $repository;
    private $fields = ["nama", "semester", "kode_prodi"];

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getAll($page, $limit = 10)
    {
        $data = $this->repository->getAll($page, $limit);
        return [
            "status" => "success",
            "code" => "200",
            "data" => $data,
        ];
    }

    public function getById($id)
    {
        $data = $this->repository->getById($id);
        return [
            "status" => "success",
            "code" => "200",
            "data" => $data,
        ];
    }

    public function insert($data): array
    {
        $data['id'] = Helper::generateUUID();
        $errors = Helper::validateFields($data, $this->fields);
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
            $errors = Helper::validateFields($data[$i], $this->fields);
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

    public function update($data)
    {
        $this->repository->update($data);
        return [
            "status" => "success",
            "code" => "200",
        ];
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
