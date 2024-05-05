<?php
require_once 'models/Pengguna.php';

class PenggunaController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new Pengguna($dbConnection);
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
        $penggunas = $this->model->getAllPengguna();
        require 'views/pengguna.php';
    }

    private function create() {
        require 'views/pengguna.php';
    }

    private function store() {
        $this->model->addPengguna($_POST);
        header('Location: index.php?controller=pengguna&action=index');
    }

    private function edit($id) {
        $pengguna = $this->model->getPenggunaById($id);
        require 'views/pengguna.php';
    }

    private function update($id) {
        $this->model->updatePengguna($id, $_POST);
        header('Location: index.php?controller=pengguna&action=index');
    }

    private function delete($id) {
        $this->model->deletePengguna($id);
        header('Location: index.php?controller=pengguna&action=index');
    }
}
?>

