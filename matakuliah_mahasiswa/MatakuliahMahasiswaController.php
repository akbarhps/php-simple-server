<?php

class MatakuliahMahasiswaController
{
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function getByMahasiswaId($id)
    {
        $res = $this->service->getByMahasiswaId($id);
        echo json_encode($res);
    }

    public function getByMatakuliahId($id)
    {
        $res = $this->service->getByMatakuliahId($id);
        echo json_encode($res);
    }

    public function insert($data)
    {
        $res = $this->service->insert($data);
        if ($res['status'] != 'success') {
            http_response_code((int)$res['code']);
        }
        echo json_encode($res);
    }

    public function insertAll($data)
    {
        $res = $this->service->insertAll($data);
        if ($res['status'] != 'success') {
            http_response_code((int)$res['code']);
        }
        echo json_encode($res);
    }

    public function delete($id)
    {
        $this->service->delete($id);
        echo json_encode(['status' => 'success']);
    }
}
