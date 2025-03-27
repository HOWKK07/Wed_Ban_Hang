<?php 
require_once('app/config/database.php'); 
require_once('app/models/AccountModel.php'); 
require_once('app/helpers/SessionHelper.php');

class AccountController { 
    private $accountModel; 
    private $db; 

    public function __construct() { 
        $this->db = (new Database())->getConnection(); 
        $this->accountModel = new AccountModel($this->db); 
    } 

    public function register() { 
        include_once 'app/views/account/register.php'; 
    } 

    public function login() { 
        include_once 'app/views/account/login.php'; 
    } 

    public function save() { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $username = $_POST['username'] ?? ''; 
            $fullName = $_POST['fullname'] ?? ''; 
            $password = $_POST['password'] ?? ''; 
            $confirmPassword = $_POST['confirmpassword'] ?? ''; 
            $errors =[]; 

            if(empty($username)){ 
                $errors['username'] = "Vui lòng nhập username!"; 
            } elseif(strlen($username) < 6) {
                $errors['username'] = "Username phải có ít nhất 6 ký tự!";
            }

            if(empty($fullName)){ 
                $errors['fullname'] = "Vui lòng nhập fullname!"; 
            } 

            if(empty($password)){ 
                $errors['password'] = "Vui lòng nhập password!"; 
            } elseif(strlen($password) < 8) {
                $errors['password'] = "Password phải có ít nhất 8 ký tự!";
            } elseif(!preg_match('/[A-Z]/', $password)) {
                $errors['password'] = "Password phải chứa ít nhất một chữ cái viết hoa!";
            } elseif(!preg_match('/[0-9]/', $password)) {
                $errors['password'] = "Password phải chứa ít nhất một chữ số!";
            }

            if($password != $confirmPassword){ 
                $errors['confirmPass'] = "Mật khẩu và xác nhận chưa đúng"; 
            } 

            // Kiểm tra username đã được đăng ký chưa? 
            $account = $this->accountModel->getAccountByUsername($username); 
            if($account){ 
                $errors['account'] = "Tài khoản này đã có người đăng ký!"; 
            } 

            if(count($errors) > 0){ 
                include_once 'app/views/account/register.php'; 
            } else { 
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($username, $fullName, $password); 
                if($result){ 
                    header('Location: /buoi2/account/login'); 
                } 
            } 
        }        
    } 

    public function logout() { 
        session_destroy();
        header('Location: /buoi2/product'); 
    } 

    public function checkLogin() { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $username = $_POST['username'] ?? ''; 
            $password = $_POST['password'] ?? ''; 

            $account = $this->accountModel->getAccountByUsername($username); 
            if ($account) { 
                $pwd_hashed = $account->password; 
                if (password_verify($password, $pwd_hashed)) { 
                    $_SESSION['username'] = $account->username; 
                    $_SESSION['account_id'] = $account->id; // Store account_id in session
                    $_SESSION['role'] = $account->role; // Store role in session
                    header('Location: /buoi2/product'); 
                    exit; 
                } else { 
                    echo "Password incorrect."; 
                } 
            } else { 
                echo "Không tìm thấy tài khoản"; 
            } 
        } 
    } 

    public function forgotPassword() {
        include_once 'app/views/account/forgot_password.php';
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $account = $this->accountModel->getAccountByUsername($username);
            if ($account) {
                include_once 'app/views/account/reset_password.php';
            } else {
                echo "Không tìm thấy tài khoản";
            }
        }
    }

    public function updatePassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($newPassword !== $confirmPassword) {
                echo "Mật khẩu và xác nhận mật khẩu không khớp.";
                return;
            }

            $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
            $result = $this->accountModel->updatePassword($username, $passwordHash);

            if ($result) {
                header('Location: /buoi2/account/login');
            } else {
                echo "Đã xảy ra lỗi khi cập nhật mật khẩu.";
            }
        }
    }
}
?>