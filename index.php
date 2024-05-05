<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once 'controllers/pengguna.php';
require_once 'controllers/supplier.php';
require_once 'controllers/pelanggan.php';
require_once 'controllers/pembelian.php';
require_once 'controllers/penjualan.php';
require_once 'controllers/barang.php';

$dbConnection = new PDO('mysql:host=localhost;dbname=yourdbname', 'username', 'password');

function displayMenu($role) {
    $menu = [
        'admin' => [
            'Pengguna' => '?controller=pengguna&action=index',
            'Supplier' => '?controller=supplier&action=index',
            'Pelanggan' => '?controller=pelanggan&action=index',
            'Pembelian' => '?controller=pembelian&action=index',
            'Penjualan' => '?controller=penjualan&action=index',
            'Barang' => '?controller=barang&action=index'
            'Dashboard' => '?controller=profitLoss&action=report'
        ],
        'Supplier' => [
            'Pembelian' => '?controller=pembelian&action=index',
            'Barang' => '?controller=barang&action=index'
        ],
        'Pelanggan' => [
            'Penjualan' => '?controller=penjualan&action=index',
            'Barang' => '?controller=barang&action=index'
        ]
    ];

    echo "<ul>";
    if (array_key_exists($role, $menu)) {
        foreach ($menu[$role] as $key => $value) {
            echo "<li><a href='" . $value . "'>" . $key . "</a></li>";
        }
    }
    echo "</ul>";
}

displayMenu($_SESSION['role'] ?? 'guest');

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'pengguna':
        $controllerInstance = new PenggunaController($dbConnection);
        break;
    case 'supplier':
        $controllerInstance = new SupplierController($dbConnection);
        break;
    case 'pelanggan':
        $controllerInstance = new PelangganController($dbConnection);
        break;
    case 'pembelian':
        $controllerInstance = new PembelianController($dbConnection);
        break;
    case 'penjualan':
        $controllerInstance = new PenjualanController($dbConnection);
        break;
    case 'barang':
        $controllerInstance = new BarangController($dbConnection);
        break;
    case 'profitLoss':
        $profitLossController = new ProfitLossController($dbConnection);
        if ($action == 'report') {
            $profitLossController->showReport();
        }
        break;
    default:
        echo "404 Controller not found";
        exit;
}

$controllerInstance->handleRequest($action);
?>

