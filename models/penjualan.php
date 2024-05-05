<?php
class Penjualan {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getAllPenjualan() {
        $stmt = $this->db->prepare("SELECT * FROM Penjualan");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPenjualanById($idPenjualan) {
        $stmt = $this->db->prepare("SELECT * FROM Penjualan WHERE idPenjualan = :id");
        $stmt->bindParam(':id', $idPenjualan, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPenjualan($idPelanggan, $idBarang, $jumlahPenjualan, $hargaJual) {
        $stmt = $this->db->prepare("INSERT INTO Penjualan (idPelanggan, idBarang, jumlahPenjualan, hargaJual) VALUES (:idPelanggan, :idBarang, :jumlahPenjualan, :hargaJual)");
        $stmt->bindParam(':idPelanggan', $idPelanggan);
        $stmt->bindParam(':idBarang', $idBarang);
        $stmt->bindParam(':jumlahPenjualan', $jumlahPenjualan);
        $stmt->bindParam(':hargaJual', $hargaJual);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updatePenjualan($idPenjualan, $idPelanggan, $idBarang, $jumlahPenjualan, $hargaJual) {
        $stmt = $this->db->prepare("UPDATE Penjualan SET idPelanggan = :idPelanggan, idBarang = :idBarang, jumlahPenjualan = :jumlahPenjualan, hargaJual = :hargaJual WHERE idPenjualan = :idPenjualan");
        $stmt->bindParam(':idPenjualan', $idPenjualan, PDO::PARAM_INT);
        $stmt->bindParam(':idPelanggan', $idPelanggan);
        $stmt->bindParam(':idBarang', $idBarang);
        $stmt->bindParam(':jumlahPenjualan', $jumlahPenjualan);
        $stmt->bindParam(':hargaJual', $hargaJual);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletePenjualan($idPenjualan) {
        $stmt = $this->db->prepare("DELETE FROM Penjualan WHERE idPenjualan = :id");
        $stmt->bindParam(':id', $idPenjualan, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}

