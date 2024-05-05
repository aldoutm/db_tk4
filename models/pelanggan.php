<?php
class Pelanggan {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getAllPelanggan() {
        $stmt = $this->db->prepare("SELECT p.*, pg.NamaPengguna FROM Pelanggan p JOIN Pengguna pg ON p.IdPengguna = pg.IdPengguna");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPelangganById($idPelanggan) {
        $stmt = $this->db->prepare("SELECT p.*, pg.NamaPengguna FROM Pelanggan p JOIN Pengguna pg ON p.IdPengguna = pg.IdPengguna WHERE p.IdPelanggan = :id");
        $stmt->bindParam(':id', $idPelanggan, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPelanggan($idPengguna, $namaPelanggan) {
        $stmt = $this->db->prepare("INSERT INTO Pelanggan (IdPengguna, NamaPelanggan) VALUES (:idPengguna, :namaPelanggan)");
        $stmt->bindParam(':idPengguna', $idPengguna);
        $stmt->bindParam(':namaPelanggan', $namaPelanggan);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updatePelanggan($idPelanggan, $idPengguna, $namaPelanggan) {
        $stmt = $this->db->prepare("UPDATE Pelanggan SET IdPengguna = :idPengguna, NamaPelanggan = :namaPelanggan WHERE IdPelanggan = :idPelanggan");
        $stmt->bindParam(':idPelanggan', $idPelanggan, PDO::PARAM_INT);
        $stmt->bindParam(':idPengguna', $idPengguna);
        $stmt->bindParam(':namaPelanggan', $namaPelanggan);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletePelanggan($idPelanggan) {
        $stmt = $this->db->prepare("DELETE FROM Pelanggan WHERE IdPelanggan = :id");
        $stmt->bindParam(':id', $idPelanggan, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}

