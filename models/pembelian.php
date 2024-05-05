<?php
class Pembelian {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getAllPembelian() {
        $stmt = $this->db->prepare("SELECT * FROM Pembelian");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPembelianById($idPembelian) {
        $stmt = $this->db->prepare("SELECT * FROM Pembelian WHERE idPembelian = :id");
        $stmt->bindParam(':id', $idPembelian, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPembelian($idSupplier, $idBarang, $jumlahPembelian, $hargaBeli) {
        $stmt = $this->db->prepare("INSERT INTO Pembelian (idSupplier, idBarang, jumlahPembelian, hargaBeli) VALUES (:idSupplier, :idBarang, :jumlahPembelian, :hargaBeli)");
        $stmt->bindParam(':idSupplier', $idSupplier);
        $stmt->bindParam(':idBarang', $idBarang);
        $stmt->bindParam(':jumlahPembelian', $jumlahPembelian);
        $stmt->bindParam(':hargaBeli', $hargaBeli);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updatePembelian($idPembelian, $idSupplier, $idBarang, $jumlahPembelian, $hargaBeli) {
        $stmt = $this->db->prepare("UPDATE Pembelian SET idSupplier = :idSupplier, idBarang = :idBarang, jumlahPembelian = :jumlahPembelian, hargaBeli = :hargaBeli WHERE idPembelian = :idPembelian");
        $stmt->bindParam(':idPembelian', $idPembelian, PDO::PARAM_INT);
        $stmt->bindParam(':idSupplier', $idSupplier);
        $stmt->bindParam(':idBarang', $idBarang);
        $stmt->bindParam(':jumlahPembelian', $jumlahPembelian);
        $stmt->bindParam(':hargaBeli', $hargaBeli);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletePembelian($idPembelian) {
        $stmt = $this->db->prepare("DELETE FROM Pembelian WHERE idPembelian = :id");
        $stmt->bindParam(':id', $idPembelian, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}

