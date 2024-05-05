<?php
require_once 'models/Barang.php';

class ProfitLossController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new Barang($dbConnection);
    }

    public function showReport() {
        $profitLossData = $this->model->getProfitAndLoss();
        include 'views/profit_loss_dashboard.php';
    }
}
?>
