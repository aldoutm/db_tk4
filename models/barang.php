<?php
class Barang {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getAllBarang() {
        $stmt = $this->db->prepare("SELECT * FROM Barang");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBarangById($idBarang) {
        $stmt = $this->db->prepare("SELECT * FROM Barang WHERE idBarang = :id");
        $stmt->bindParam(':id', $idBarang, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addBarang($namaBarang, $keterangan, $satuan, $idPengguna) {
        $stmt = $this->db->prepare("INSERT INTO Barang (namaBarang, keterangan, satuan, idPengguna) VALUES (:namaBarang, :keterangan, :satuan, :idPengguna)");
        $stmt->bindParam(':namaBarang', $namaBarang);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':satuan', $satuan);
        $stmt->bindParam(':idPengguna', $idPengguna);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function updateBarang($idBarang, $namaBarang, $keterangan, $satuan, $idPengguna) {
        $stmt = $this->db->prepare("UPDATE Barang SET namaBarang = :namaBarang, keterangan = :keterangan, satuan = :satuan, idPengguna = :idPengguna WHERE idBarang = :idBarang");
        $stmt->bindParam(':idBarang', $idBarang, PDO::PARAM_INT);
        $stmt->bindParam(':namaBarang', $namaBarang);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':satuan', $satuan);
        $stmt->bindParam(':idPengguna', $idPengguna);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deleteBarang($idBarang) {
        $stmt = $this->db->prepare("DELETE FROM Barang WHERE idBarang = :id");
        $stmt->bindParam(':id', $idBarang, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getProfitAndLoss() {
    $sql = "
        SELECT b.namaBarang, b.keterangan, b.satuan, 
               COALESCE(SUM(pb.jumlahPembelian * pb.hargaBeli), 0) AS totalCost,
               COALESCE(SUM(pj.jumlahPenjualan * pj.hargaJual), 0) AS totalRevenue,
               (COALESCE(SUM(pj.jumlahPenjualan * pj.hargaJual), 0) - COALESCE(SUM(pb.jumlahPembelian * pb.hargaBeli), 0)) AS profit
        FROM Barang b
        LEFT JOIN Pembelian pb ON b.idBarang = pb.idBarang
        LEFT JOIN Penjualan pj ON b.idBarang = pj.idBarang
        GROUP BY b.idBarang, b.namaBarang, b.keterangan, b.satuan
        ORDER BY b.idBarang
    ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

