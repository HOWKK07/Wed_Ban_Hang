<?php
class OrderModel
{
    private $conn;
    private $table_name = "orders";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getOrderHistory()
    {
        $query = "SELECT o.id, o.name, o.phone, o.address, o.created_at, SUM(od.quantity * od.price) as total
                  FROM " . $this->table_name . " o
                  JOIN order_details od ON o.id = od.order_id
                  GROUP BY o.id, o.name, o.phone, o.address, o.created_at
                  ORDER BY o.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getRevenue()
    {
        $query = "SELECT DATE(created_at) as date, SUM(od.quantity * od.price) as total
                  FROM " . $this->table_name . " o
                  JOIN order_details od ON o.id = od.order_id
                  GROUP BY DATE(created_at)
                  ORDER BY DATE(created_at) DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}
?>