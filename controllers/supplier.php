<?php
require_once 'models/Supplier.php';

class SupplierController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new Supplier($dbConnection);
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
        $suppliers = $this->model->getAllSuppliers();
        require 'views/supplier.php';
    }

    private function create() {
        require 'views/supplier.php';
    }

    private function store() {
        $this->model->addSupplier($_POST['idPengguna'], $_POST['namaSupplier']);
        header('Location: index.php?controller=supplier&action=index');
    }

    private function edit($id) {
        $supplier = $this->model->getSupplierById($id);
        require 'views/supplier.php';
    }

    private function update($id) {
        $this->model->updateSupplier($id, $_POST['idPengguna'], $_POST['namaSupplier']);
        header('Location: index.php?controller=supplier&action=index');
    }

    private function delete($id) {
        $this->model->deleteSupplier($id);
        header('Location: index.php?controller=supplier&action=index');
    }
}

