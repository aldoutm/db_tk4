<?php
class Pengguna {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function checkCredentials($username, $password) {
        $stmt = $this->db->prepare("SELECT p.*, h.NamaAkses AS role FROM Pengguna p INNER JOIN HakAkses h ON p.IdAkses = h.IdAkses WHERE p.NamaPengguna = :username AND p.Password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPengguna() {
        $stmt = $this->db->prepare("SELECT * FROM Pengguna");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPenggunaById($idPengguna) {
        $stmt = $this->db->prepare("SELECT * FROM Pengguna WHERE idPengguna = :id");
        $stmt->bindParam(':id', $idPengguna, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPengguna($namaPengguna, $password, $namaDepan, $namaBelakang, $noHp, $alamat) {
        $stmt = $this->db->prepare("INSERT INTO Pengguna (namaPengguna, password, namaDepan, namaBelakang, noHp, alamat) VALUES (:namaPengguna, :password, :namaDepan, :namaBelakang, :noHp, :alamat)");
        $stmt->bindParam(':namaPengguna', $namaPengguna);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':namaDepan', $namaDepan);
        $stmt->bindParam(':namaBelakang', $namaBelakang);
        $stmt->bindParam(':noHp', $noHp);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updatePengguna($idPengguna, $namaPengguna, $password, $namaDepan, $namaBelakang, $noHp, $alamat) {
        $stmt = $this->db->prepare("UPDATE Pengguna SET namaPengguna = :namaPengguna, password = :password, namaDepan = :namaDepan, namaBelakang = :namaBelakang, noHp = :noHp, alamat = :alamat WHERE idPengguna = :id");
        $stmt->bindParam(':id', $idPengguna, PDO::PARAM_INT);
        $stmt->bindParam(':namaPengguna', $namaPengguna);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':namaDepan', $namaDepan);
        $stmt->bindParam(':namaBelakang', $namaBelakang);
        $stmt->bindParam(':noHp', $noHp);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletePengguna($idPengguna) {
        $stmt = $this->db->prepare("DELETE FROM Pengguna WHERE idPengguna = :id");
        $stmt->bindParam(':id', $idPengguna, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>

