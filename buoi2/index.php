<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require_once 'app/models/ProductModel.php';
        require_once 'app/models/CategoryModel.php';
        require_once 'app/helpers/SessionHelper.php';

        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $urlSegments = explode('/', $url);

        $validControllers = ['Product', 'Category', 'Cart', 'Account', 'Admin', 'User'];

        $controllerBase = isset($urlSegments[0]) && in_array(ucfirst($urlSegments[0]), $validControllers)
            ? ucfirst($urlSegments[0])
            : 'Product';
        $controllerName = $controllerBase . 'Controller';
        $action = isset($urlSegments[1]) && $urlSegments[1] !== '' ? $urlSegments[1] : 'index';

        $controllerFile = 'app/controllers/' . $controllerName . '.php';
        if (!file_exists($controllerFile)) {
            http_response_code(404);
            die('404 - Controller not found');
        }

        require_once $controllerFile;
        if (!class_exists($controllerName)) {
            http_response_code(500);
            die('500 - Controller class not found');
        }

        try {
            $controller = new $controllerName();
        } catch (Exception $e) {
            http_response_code(500);
            die('500 - Error initializing controller');
        }

        if (!method_exists($controller, $action)) {
            http_response_code(404);
            die('404 - Action not found');
        }

        $params = array_slice($urlSegments, 2);

        try {
            call_user_func_array([$controller, $action], $params);
        } catch (Exception $e) {
            http_response_code(500);
            die('500 - Runtime error: ' . $e->getMessage());
        }
        ?>
    </div>
</body>
</html>
