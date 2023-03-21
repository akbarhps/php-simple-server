<?php

class MatakuliahController
{
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function getAll($page, $limit = 15)
    {
        $res = $this->service->getAll($page, $limit);
        echo json_encode($res);
    }

    public function getById($id)
    {
        $res = $this->service->getById($id);
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

    public function update($data)
    {
        $this->service->update($data);
        echo json_encode(['status' => 'success']);
    }

    public function delete($id)
    {
        $this->service->delete($id);
        echo json_encode(['status' => 'success']);
    }
}
