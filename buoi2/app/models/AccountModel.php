<?php 
class AccountModel 
{ 
    private $conn; 
    private $table_name = "account"; 

    public function __construct($db) 
    { 
        $this->conn = $db; 
    } 

    public function getAccountByUsername($username) 
    { 
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':username', $username, PDO::PARAM_STR); 
        $stmt->execute(); 
        $result = $stmt->fetch(PDO::FETCH_OBJ); 
        return $result; 
    } 

    public function getAccountById($id) 
    { 
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        $stmt->execute(); 
        $result = $stmt->fetch(PDO::FETCH_OBJ); 
        return $result; 
    } 

    public function getAllAccounts() 
    { 
        $query = "SELECT * FROM " . $this->table_name; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(PDO::FETCH_OBJ); 
        return $result; 
    } 

    public function getOrderHistoryByUsername($username) 
    { 
        $query = "SELECT o.id, o.name, o.phone, o.address, o.created_at, SUM(od.quantity * od.price) as total
                  FROM orders o
                  JOIN order_details od ON o.id = od.order_id
                  JOIN account a ON o.user_id = a.id
                  WHERE a.username = :username
                  GROUP BY o.id, o.name, o.phone, o.address, o.created_at
                  ORDER BY o.created_at DESC"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':username', $username, PDO::PARAM_STR); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(PDO::FETCH_OBJ); 
        return $result; 
    } 

    public function save($username, $name, $password, $role = 'user') 
    { 
        $query = "INSERT INTO " . $this->table_name . " (username, password, role) VALUES (:username, :password, :role)"; 
        $stmt = $this->conn->prepare($query); 

        // Làm sạch dữ liệu 
        $name = htmlspecialchars(strip_tags($name)); 
        $username = htmlspecialchars(strip_tags($username)); 

        // Gán dữ liệu vào câu lệnh 
        $stmt->bindParam(':username', $username); 
        $stmt->bindParam(':password', $password); 
        $stmt->bindParam(':role', $role); 

        // Thực thi câu lệnh 
        if ($stmt->execute()) { 
            return true; 
        } 
        return false; 
    } 

    public function updateAccount($id, $username, $password, $role) 
    { 
        $query = "UPDATE " . $this->table_name . " SET username = :username, password = :password, role = :role WHERE id = :id"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        $stmt->bindParam(':username', $username, PDO::PARAM_STR); 
        $stmt->bindParam(':password', $password, PDO::PARAM_STR); 
        $stmt->bindParam(':role', $role, PDO::PARAM_STR); 
        return $stmt->execute(); 
    } 

    public function deleteAccount($id) 
    { 
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        return $stmt->execute(); 
    } 

    public function updatePassword($username, $password) 
    { 
        $query = "UPDATE " . $this->table_name . " SET password = :password WHERE username = :username"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':username', $username, PDO::PARAM_STR); 
        $stmt->bindParam(':password', $password, PDO::PARAM_STR); 
        return $stmt->execute(); 
    } 
}
?>