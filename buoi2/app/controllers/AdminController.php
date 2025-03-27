<?php
require_once('app/config/database.php');
require_once('app/models/OrderModel.php');
require_once('app/helpers/AuthHelper.php');

class AdminController
{
    private $orderModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->orderModel = new OrderModel($this->db);
    }

    public function orderHistory()
    {
        if (!AuthHelper::isAdmin()) {
            header('Location: /buoi2/account/login');
            exit;
        }

        $orders = $this->orderModel->getOrderHistory();
        include 'app/views/admin/order_history.php';
    }

    public function revenue()
    {
        if (!AuthHelper::isAdmin()) {
            header('Location: /buoi2/account/login');
            exit;
        }

        $revenues = $this->orderModel->getRevenue();
        include 'app/views/admin/revenue.php';
    }
}
?>