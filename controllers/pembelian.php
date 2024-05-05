<?php
require_once 'models/Pembelian.php';

class PembelianController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new Pembelian($dbConnection);
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
        $pembelians = $this->model->getAllPembelian();
        require 'views/pembelian.php';
    }

    private function create() {
        require 'views/pembelian.php';
    }

    private function store() {
        $this->model->addPembelian($_POST['idSupplier'], $_POST['tanggal'], $_POST['total']);
        header('Location: index.php?controller=pembelian&action=index');
    }

    private function edit($id) {
        $pembelian = $this->model->getPembelianById($id);
        require 'views/pembelian.php';
    }

    private function update($id) {
        $this->model->updatePembelian($id, $_POST['idSupplier'], $_POST['tanggal'], $_POST['total']);
        header('Location: index.php?controller=pembelian&action=index');
    }

    private function delete($id) {
        $this->model->deletePembelian($id);
        header('Location: index.php?controller=pembelian&action=index');
    }
}

