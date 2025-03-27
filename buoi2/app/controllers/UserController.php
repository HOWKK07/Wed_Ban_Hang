<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/helpers/AuthHelper.php');

class UserController
{
    private $accountModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    public function list()
    {
        if (!AuthHelper::isAdmin()) {
            header('Location: /buoi2/account/login');
            exit;
        }

        $users = $this->accountModel->getAllAccounts();
        include 'app/views/admin/user_list.php';
    }

    public function editForm($id)
    {
        if (!AuthHelper::isAdmin()) {
            header('Location: /buoi2/account/login');
            exit;
        }

        $user = $this->accountModel->getAccountById($id);
        if ($user) {
            include 'app/views/admin/user_edit.php';
        } else {
            echo "Không tìm thấy tài khoản.";
        }
    }

    public function edit($id)
    {
        if (!AuthHelper::isAdmin()) {
            header('Location: /buoi2/account/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'user';

            $passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            $result = $this->accountModel->updateAccount($id, $username, $passwordHash, $role);

            if ($result) {
                header('Location: /buoi2/User/list');
            } else {
                echo "Đã xảy ra lỗi khi cập nhật tài khoản.";
            }
        }
    }

    public function delete($id)
    {
        if (!AuthHelper::isAdmin()) {
            header('Location: /buoi2/account/login');
            exit;
        }

        if ($this->accountModel->deleteAccount($id)) {
            header('Location: /buoi2/User/list');
        } else {
            echo "Đã xảy ra lỗi khi xóa tài khoản.";
        }
    }
}
?>