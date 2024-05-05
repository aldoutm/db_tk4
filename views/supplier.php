<?php
$action = $_GET['action'] ?? 'index';

if ($action == 'index') {
    echo "<h1>Supplier List</h1>";
    echo "<a href='index.php?controller=supplier&action=create'>Add New</a><br>";
    foreach ($suppliers as $supplier) {
        echo "<p>" . htmlspecialchars($supplier['namaSupplier']) . " - <a href='index.php?controller=supplier&action=edit&id=" . $supplier['idSupplier'] . "'>Edit</a> - <a href='index.php?controller=supplier&action=delete&id=" . $supplier['idSupplier'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></p>";
    }
} else {
    $isEdit = $action == 'edit';
    $formAction = $isEdit ? "index.php?controller=supplier&action=update&id=" . $supplier['idSupplier'] : "index.php?controller=supplier&action=store";
    echo "<form action='" . $formAction . "' method='post'>";
    echo "<input type='hidden' id='idPengguna' name='idPengguna' value='1'>";
    echo "<label for='namaSupplier'>Nama Supplier:</label><br>";
    echo "<input type='text' id='namaSupplier' name='namaSupplier' value='" . ($isEdit ? $supplier['namaSupplier'] : "") . "' required><br>";
    echo "<button type='submit'>" . ($isEdit ? "Update" : "Create") . "</button>";
    echo "</form>";
}
?>

