<?php

class MatakuliahRepository
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getAll($page = 0, $limit = 10): array
    {
        $query = "SELECT * FROM matakuliah LIMIT ? OFFSET ?";
        $result = mysqli_execute_query($this->conn, $query, [$limit, $page * $limit]);
        return $this->handleResult($result);
    }

    public function getById($id): array
    {
        $query = "SELECT * FROM matakuliah WHERE id = ?";
        $result = mysqli_execute_query($this->conn, $query, [$id]);
        return $this->handleResult($result);
    }

    public function insert($data)
    {
        $query = "INSERT INTO matakuliah (id, nama, semester, kode_prodi) VALUES (?, ?, ?, ?)";
        mysqli_execute_query($this->conn, $query, [
            $data['id'],
            $data['nama'],
            $data['semester'],
            $data['kode_prodi'],
        ]);
    }

    public function update($data)
    {
        $query = "UPDATE matakuliah SET nama = ?, semester = ? WHERE id = ?";
        mysqli_execute_query($this->conn, $query, [
            $data['nama'],
            $data['semester'],
            $data['id'],
        ]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM matakuliah WHERE id = ?";
        mysqli_execute_query($this->conn, $query, [$id]);
    }

    private function toArray($row)
    {
        return [
            "id" => $row['id'],
            "nama" => $row['nama'],
            "semester" => $row['semester'],
            "kode_prodi" => $row['kode_prodi'],
        ];
    }

    public function handleResult($result)
    {
        if ($result == null) {
            return [];
        }

        $rows = mysqli_fetch_assoc($result);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount === 1) {
            return $this->toArray($rows);
        }

        $array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $this->toArray($row);
        }
        return $array;
    }
}
