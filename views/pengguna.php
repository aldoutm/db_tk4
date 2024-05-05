<?php
if (!isset($_GET['action'])) {
    echo "<h1>Pengguna</h1>";
    echo "<a href='?action=create'>Create New Pengguna</a><br>";
    echo "<ul>";
    foreach ($penggunas as $pengguna) {
        echo "<li>" . htmlspecialchars($pengguna['namaPengguna']) . " - <a href='?action=show&id=" . $pengguna['idPengguna'] . "'>View</a> - <a href='?action=edit&id=" . $pengguna['idPengguna'] . "'>Edit</a> - <a href='?action=delete&id=" . $pengguna['idPengguna'] . "'>Delete</a></li>";
    }
    echo "</ul>";
} elseif ($_GET['action'] == 'create' || $_GET['action'] == 'edit') {
    $isEdit = isset($pengguna);
    echo "<form method='post' action='" . ($isEdit ? "?action=update&id=" . $pengguna['idPengguna'] : "?action=store") . "'>";
    echo "<label for='namaPengguna'>Nama Pengguna:</label><br>";
    echo "<input type='text' id='namaPengguna' name='namaPengguna' value='" . ($isEdit ? $pengguna['namaPengguna'] : "") . "' required><br>";
    echo "<label for='password'>Password:</label><br>";
    echo "<input type='password' id='password' name='password' required><br>";
    echo "<label for='namaDepan'>Nama Depan:</label><br>";
    echo "<input type='text' id='namaDepan' name='namaDepan' value='" . ($isEdit ? $pengguna['namaDepan'] : "") . "' required><br>";
    echo "<label for='namaBelakang'>Nama Belakang:</label><br>";
    echo "<input type='text' id='namaBelakang' name='namaBelakang' value='" . ($isEdit ? $pengguna['namaBelakang'] : "") . "' required><br>";
    echo "<button type='submit'>" . ($isEdit ? "Update" : "Create") . "</button>";
    echo "</form>";
} elseif ($_GET['action'] == 'show' && isset($pengguna)) {
    echo "<h1>Detail Pengguna</h1>";
    echo "<p>Nama Pengguna: " . htmlspecialchars($pengguna['namaPengguna']) . "</p>";
    echo "<p>Nama Depan: " . htmlspecialchars($pengguna['namaDepan']) . "</p>";
    echo "<p>Nama Belakang: " . htmlspecialchars($pengguna['namaBelakang']) . "</p>";
}
?>

