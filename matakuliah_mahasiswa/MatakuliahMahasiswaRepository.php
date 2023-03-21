<?php

class MatakuliahMahasiswaRepository
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getByMahasiswaId($id): array
    {
        $query = "select * from matakuliah_mahasiswa mk_mhs join matakuliah mk on mk.id = mk_mhs.id_matakuliah where id_mahasiswa = ?";
        $result = mysqli_execute_query($this->conn, $query, [$id]);
        return $this->handleResult($result);
    }

    public function getByMatakuliahId($id): array
    {
        $query = "select * from matakuliah_mahasiswa mk_mhs join matakuliah mk on mk.id = mk_mhs.id_matakuliah where id_matakuliah = ?";
        $result = mysqli_execute_query($this->conn, $query, [$id]);
        return $this->handleResult($result);
    }

    public function insert($data)
    {
        $query = "INSERT INTO matakuliah_mahasiswa (id_mahasiswa, id_matakuliah) VALUES (?, ?)";
        mysqli_execute_query($this->conn, $query, [
            $data['id_mahasiswa'],
            $data['id_matakuliah'],
        ]);
    }

    public function delete($id_mahasiswa, $id_matakuliah)
    {
        $query = "DELETE FROM matakuliah_mahasiswa WHERE id_mahasiswa = ? AND id_matakuliah = ?";
        mysqli_execute_query($this->conn, $query, [$id_mahasiswa, $id_matakuliah]);
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

        $array = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $this->toArray($row);
        }
        return $array;
    }
}
