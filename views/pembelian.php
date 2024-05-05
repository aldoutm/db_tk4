<?php
$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    echo "<h1>Pembelian List</h1>";
    echo "<a href='index.php?controller=pembelian&action=create'>Add New</a><br>";
    foreach ($pembelians as $pembelian) {
        echo "<p>Supplier ID: " . htmlspecialchars($pembelian['idSupplier']) . ", Item ID: " . htmlspecialchars($pembelian['idBarang']) . ", Quantity: " . htmlspecialchars($pembelian['jumlahPembelian']) . ", Price: " . htmlspecialchars($pembelian['hargaBeli']) . " - <a href='index.php?controller=pembelian&action=edit&id=" . $pembelian['idPembelian'] . "'>Edit</a> - <a href='index.php?controller=pembelian&action=delete&id=" . $pembelian['idPembelian'] . "' onclick='return confirm('Are you sure?')'>Delete</a></p>";
    }
} elseif ($action === 'create' || $action === 'edit') {
    $isEdit = ($action === 'edit');
    $pembelian = $isEdit ? $pembelian : ['idPembelian' => '', 'idSupplier' => '', 'idBarang' => '', 'jumlahPembelian' => '', 'hargaBeli' => ''];
    $formAction = $isEdit ? "index.php?controller=pembelian&action=update&id=" . $pembelian['idPembelian'] : "index.php?controller=pembelian&action=store";
    echo "<form action='" . $formAction . "' method='post'>";
    echo "<label for='idSupplier'>Supplier ID:</label><br>";
    echo "<input type='text' id='idSupplier' name='idSupplier' value='" . ($isEdit ? htmlspecialchars($pembelian['idSupplier']) : "") . "' required><br>";
    echo "<label for='idBarang'>Item ID:</label><br>";
    echo "<input type='text' id='idBarang' name='idBarang' value='" . ($isEdit ? htmlspecialchars($pembelian['idBarang']) : "") . "' required><br>";
    echo "<label for='jumlahPembelian'>Quantity:</label><br>";
    echo "<input type='number' id='jumlahPembelian' name='jumlahPembelian' value='" . ($isEdit ? htmlspecialchars($pembelian['jumlahPembelian']) : "") . "' required><br>";
    echo "<label for='hargaBeli'>Price:</label><br>";
    echo "<input type='number' id='hargaBeli' name='hargaBeli' value='" . ($isEdit ? htmlspecialchars($pembelian['hargaBeli']) : "") . "' required><br>";
    echo "<button type='submit'>" . ($isEdit ? "Update" : "Create") . "</button>";
    echo "</form>";
}
?>

