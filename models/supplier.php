<?php
class Supplier {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getAllSuppliers() {
        $stmt = $this->db->prepare("SELECT * FROM Supplier");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSupplierById($idSupplier) {
        $stmt = $this->db->prepare("SELECT * FROM Supplier WHERE idSupplier = :id");
        $stmt->bindParam(':id', $idSupplier, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addSupplier($idPengguna, $namaSupplier) {
        $stmt = $this->db->prepare("INSERT INTO Supplier (idPengguna, namaSupplier) VALUES (:idPengguna, :namaSupplier)");
        $stmt->bindParam(':idPengguna', $idPengguna);
        $stmt->bindParam(':namaSupplier', $namaSupplier);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updateSupplier($idSupplier, $idPengguna, $namaSupplier) {
        $stmt = $this->db->prepare("UPDATE Supplier SET idPengguna = :idPengguna, namaSupplier = :namaSupplier WHERE idSupplier = :id");
        $stmt->bindParam(':id', $idSupplier, PDO::PARAM_INT);
        $stmt->bindParam(':idPengguna', $idPengguna);
        $stmt->bindParam(':namaSupplier', $namaSupplier);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deleteSupplier($idSupplier) {
        $stmt = $this->db->prepare("DELETE FROM Supplier WHERE idSupplier = :id");
        $stmt->bindParam(':id', $idSupplier, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>
