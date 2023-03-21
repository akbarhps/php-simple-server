<?php


class MahasiswaRepository
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getAll($page = 0, $limit = 10)
    {
        $query = "SELECT * FROM mahasiswa LIMIT ? OFFSET ?";
        $result = mysqli_execute_query($this->conn, $query, [$limit, $page * $limit]);
        return $this->handleResult($result);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM mahasiswa WHERE id = ?";
        $result = mysqli_execute_query($this->conn, $query, [$id]);
        return $this->handleResult($result);
    }

    public function insert($data)
    {
        $query = "INSERT INTO mahasiswa (id, nama, alamat, tanggal_lahir, nim, email) VALUES (?, ?, ?, ?, ?, ?)";
        mysqli_execute_query($this->conn, $query, [
            $data['id'],
            $data['nama'],
            $data['alamat'],
            $data['tanggal_lahir'],
            $data['nim'],
            $data['email'],
        ]);
    }

    public function update($data)
    {
        $query = "UPDATE mahasiswa SET nama = ?, alamat = ?, tanggal_lahir = ?, nim = ?, email = ? WHERE id = ?";
        mysqli_execute_query($this->conn, $query, [
            $data['nama'],
            $data['alamat'],
            $data['tanggal_lahir'],
            $data['nim'],
            $data['email'],
            $data['id'],
        ]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id = ?";
        mysqli_execute_query($this->conn, $query, [$id]);
    }

    private function toArray($row)
    {
        return array(
            "id" => $row['id'],
            "nama" => $row['nama'],
            "alamat" => $row['alamat'],
            "tanggal_lahir" => $row['tanggal_lahir'],
            "nim" => $row['nim'],
            "email" => $row['email'],
        );
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
