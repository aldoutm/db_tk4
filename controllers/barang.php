<?php
require_once 'models/Barang.php';

class BarangController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new Barang($dbConnection);
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
        $barangs = $this->model->getAllBarang();
        require 'views/barang.php';
    }

    private function create() {
        require 'views/barang.php';
    }

    private function store() {
        $this->model->addBarang($_POST['namaBarang'], $_POST['keterangan'], $_POST['satuan'], $_POST['idPengguna']);
        header('Location: index.php?controller=barang&action=index');
    }

    private function edit($id) {
        $barang = $this->model->getBarangById($id);
        require 'views/barang.php';
    }

    private function update($id) {
        $this->model->updateBarang($id, $_POST['namaBarang'], $_POST['keterangan'], $_POST['satuan'], $_POST['idPengguna']);
        header('Location: index.php?controller=barang&action=index');
    }

    private function delete($id) {
        $this->model->deleteBarang($id);
        header('Location: index.php?controller=barang&action=index');
    }
}
?>
