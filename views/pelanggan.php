<?php
$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    echo "<h1>Pelanggan List</h1>";
    echo "<a href='index.php?controller=pelanggan&action=create'>Add New</a><br>";
    foreach ($pelanggans as $pelanggan) {
        echo "<p>" . htmlspecialchars($pelanggan['NamaPelanggan']) . " (" . htmlspecialchars($pelanggan['NamaPengguna']) . ") - <a href='index.php?controller=pelanggan&action=edit&id=" . $pelanggan['IdPelanggan'] . "'>Edit</a> - <a href='index.php?controller=pelanggan&action=delete&id=" . $pelanggan['IdPelanggan'] . "' onclick='return confirm('Are you sure?')'>Delete</a></p>";
    }
} elseif ($action === 'create' || $action === 'edit') {
    $isEdit = ($action === 'edit');
    $pelanggan = $isEdit ? $pelanggan : ['IdPelanggan' => '', 'IdPengguna' => '', 'NamaPelanggan' => ''];
    $formAction = $isEdit ? "index.php?controller=pelanggan&action=update&id=" . $pelanggan['IdPelanggan'] : "index.php?controller=pelanggan&action=store";
    echo "<form action='" . $formAction . "' method='post'>";
    echo "<input type='hidden' name='IdPengguna' value='" . ($isEdit ? $pelanggan['IdPengguna'] : "") . "'>";
    echo "<label for='NamaPelanggan'>Nama Pelanggan:</label><br>";
    echo "<input type='text' id='NamaPelanggan' name='NamaPelanggan' value='" . ($isEdit ? htmlspecialchars($pelanggan['NamaPelanggan']) : "") . "' required><br>";
    echo "<button type='submit'>" . ($isEdit ? "Update" : "Create") . "</button>";
    echo "</form>";
}
?>

