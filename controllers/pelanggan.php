<?php
require_once 'models/Pelanggan.php';

class PelangganController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new Pelanggan($dbConnection);
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
        $pelanggans = $this->model->getAllPelanggan();
        require 'views/pelanggan.php';
    }

    private function create() {
        require 'views/pelanggan.php';
    }

    private function store() {
        $this->model->addPelanggan($_POST['IdPengguna'], $_POST['NamaPelanggan']);
        header('Location: index.php?controller=pelanggan&action=index');
    }

    private function edit($id) {
        $pelanggan = $this->model->getPelangganById($id);
        require 'views/pelanggan.php';
    }

    private function update($id) {
        $this->model->updatePelanggan($id, $_POST['IdPengguna'], $_POST['NamaPelanggan']);
        header('Location: index.php?controller=pelanggan&action=index');
    }

    private function delete($id) {
        $this->model->deletePelanggan($id);
        header('Location: index.php?controller=pelanggan&action=index');
    }
}
?>
