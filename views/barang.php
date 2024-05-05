<?php
$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    echo "<h1>Barang List</h1>";
    echo "<a href='index.php?controller=profitLoss&action=report'>View Profit and Loss Report</a><br><br>";  // Profit and Loss Dashboard
    echo "<a href='index.php?controller=barang&action=create'>Add New</a><br>";
    foreach ($barangs as $barang) {
        echo "<p>" . htmlspecialchars($barang['namaBarang']) . ", " . htmlspecialchars($barang['keterangan']) . ", " . htmlspecialchars($barang['satuan']) . " - <a href='index.php?controller=barang&action=edit&id=" . $barang['idBarang'] . "'>Edit</a> - <a href='index.php?controller=barang&action=delete&id=" . $barang['idBarang'] . "' onclick='return confirm('Are you sure?')'>Delete</a></p>";
    }
} elseif ($action === 'create' || $action === 'edit') {
    $isEdit = ($action === 'edit');
    $barang = $isEdit ? $barang : ['idBarang' => '', 'namaBarang' => '', 'keterangan' => '', 'satuan' => '', 'idPengguna' => ''];
    $formAction = $isEdit ? "index.php?controller=barang&action=update&id=" . $barang['idBarang'] : "index.php?controller=barang&action=store";
    echo "<form action='" . $formAction . "' method='post'>";
    echo "<label for='namaBarang'>Nama Barang:</label><br>";
    echo "<input type='text' id='namaBarang' name='namaBarang' value='" . ($isEdit ? htmlspecialchars($barang['namaBarang']) : "") . "' required><br>";
    echo "<label for='keterangan'>Keterangan:</label><br>";
    echo "<input type='text' id='keterangan' name='keterangan' value='" . ($isEdit ? htmlspecialchars($barang['keterangan']) : "") . "' required><br>";
    echo "<label for='satuan'>Satuan:</label><br>";
    echo "<input type='text' id='satuan' name='satuan' value='" . ($isEdit ? htmlspecialchars($barang['satuan']) : "") . "' required><br>";
    echo "<input type='hidden' name='idPengguna' value='" . ($isEdit ? $barang['idPengguna'] : "1") . "'>";
    echo "<button type='submit'>" . ($isEdit ? "Update" : "Create") . "</button>";
    echo "</form>";
}
?>

