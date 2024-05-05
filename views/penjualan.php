<?php
$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    echo "<h1>Penjualan List</h1>";
    echo "<a href='index.php?controller=penjualan&action=create'>Add New</a><br>";
    foreach ($penjualans as $penjualan) {
        echo "<p>Customer ID: " . htmlspecialchars($penjualan['idPelanggan']) . ", Item ID: " . htmlspecialchars($penjualan['idBarang']) . ", Quantity: " . htmlspecialchars($penjualan['jumlahPenjualan']) . ", Price: " . htmlspecialchars($penjualan['hargaJual']) . " - <a href='index.php?controller=penjualan&action=edit&id=" . $penjualan['idPenjualan'] . "'>Edit</a> - <a href='index.php?controller=penjualan&action=delete&id=" . $penjualan['idPenjualan'] . "' onclick='return confirm('Are you sure?')'>Delete</a></p>";
    }
} elseif ($action === 'create' || $action === 'edit') {
    $isEdit = ($action === 'edit');
    $penjualan = $isEdit ? $penjualan : ['idPenjualan' => '', 'idPelanggan' => '', 'idBarang' => '', 'jumlahPenjualan' => '', 'hargaJual' => ''];
    $formAction = $isEdit ? "index.php?controller=penjualan&action=update&id=" . $penjualan['idPenjualan'] : "index.php?controller=penjualan&action=store";
    echo "<form action='" . $formAction . "' method='post'>";
    echo "<label for='idPelanggan'>Customer ID:</label><br>";
    echo "<input type='text' id='idPelanggan' name='idPelanggan' value='" . ($isEdit ? htmlspecialchars($penjualan['idPelanggan']) : "") . "' required><br>";
    echo "<label for='idBarang'>Item ID:</label><br>";
    echo "<input type='text' id='idBarang' name='idBarang' value='" . ($isEdit ? htmlspecialchars($penjualan['idBarang']) : "") . "' required><br>";
    echo "<label for='jumlahPenjualan'>Quantity:</label><br>";
    echo "<input type='number' id='jumlahPenjualan' name='jumlahPenjualan' value='" . ($isEdit ? htmlspecialchars($penjualan['jumlahPenjualan']) : "") . "' required><br>";
    echo "<label for='hargaJual'>Price:</label><br>";
    echo "<input type='number' id='hargaJual' name='hargaJual' value='" . ($isEdit ? htmlspecialchars($penjualan['hargaJual']) : "") . "' required><br>";
    echo "<button type='submit'>" . ($isEdit ? "Update" : "Create") . "</button>";
    echo "</form>";
}
?>

