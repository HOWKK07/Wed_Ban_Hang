<?php
require_once 'app/helpers/AuthHelper.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #007bff;
        }
        .navbar-nav .nav-item .nav-link {
            font-weight: 600;
            color: #343a40;
            transition: color 0.3s;
        }
        .navbar-nav .nav-item .nav-link:hover {
            color: #007bff;
        }
        .btn-outline-success {
            border-color: #28a745;
            color: #28a745;
        }
        .btn-outline-success:hover {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="#">Quản lý sản phẩm</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="/buoi2/Product/">Danh sách sản phẩm</a></li>
                <?php if (AuthHelper::isAdmin()): ?>
                <li class="nav-item"><a class="nav-link" href="/buoi2/Category/list">Danh sách danh mục</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="/buoi2/Cart/cart">Giỏ hàng</a></li>
                <?php if (AuthHelper::isAdmin()): ?>
                    <li class="nav-item"><a class="nav-link" href="/buoi2/Admin/orderHistory">Lịch sử bán hàng</a></li>
                    <li class="nav-item"><a class="nav-link" href="/buoi2/Admin/revenue">Doanh thu</a></li>
                    <li class="nav-item"><a class="nav-link" href="/buoi2/User/list">Quản lý tài khoản</a></li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php 
                        if(SessionHelper::isLoggedIn()){
                            echo "<span class='nav-link font-weight-bold text-primary'>".$_SESSION['username']."</span>";
                            echo "<a class='nav-link text-danger' href='/buoi2/account/logout'>Logout</a>";
                        } else {
                            echo "<a class='nav-link text-primary' href='/buoi2/account/login'>Login</a>";
                        }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>