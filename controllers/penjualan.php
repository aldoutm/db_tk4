<?php
require_once 'models/Penjualan.php';

class PenjualanController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new Penjualan($dbConnection);
    }

    public function handleRequest($action) {
        switch ($action) {
            case 'create':
                $this->create();
                break;
            case 'store':
                $this->store();
                break;
            case 'edit':
                $id = $_GET['id'] ?? null;
                $this->edit($id);
                break;
            case 'update':
                $id = $_GET['id'] ?? null;
                $this->update($id);
                break;
            case 'delete':
                $id = $_GET['id'] ?? null;
                $this->delete($id);
                break;
            case 'index':
            default:
                $this->index();
                break;
        }
    }

    private function index() {
        $penjualans = $this->model->getAllPenjualan();
        require 'views/penjualan.php';
    }

    private function create() {
        require 'views/penjualan.php';
    }

    private function store() {
        $this->model->addPenjualan($_POST['idPelanggan'], $_POST['tanggal'], $_POST['total']);
        header('Location: index.php?controller=penjualan&action=index');
    }

    private function edit($id) {
        $penjualan = $this->model->getPenjualanById($id);
        require 'views/penjualan.php';
    }

    private function update($id) {
        $this->model->updatePenjualan($id, $_POST['idPelanggan'], $_POST['tanggal'], $_POST['total']);
        header('Location: index.php?controller=penjualan&action=index');
    }

    private function delete($id) {
        $this->model->deletePenjualan($id);
        header('Location: index.php?controller=penjualan&action=index');
    }
}

