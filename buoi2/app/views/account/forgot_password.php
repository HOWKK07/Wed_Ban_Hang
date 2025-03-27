<?php include 'app/views/shares/header.php'; ?>

<h1>Quên mật khẩu</h1>

<form method="POST" action="/buoi2/Account/resetPassword">
    <div class="form-group">
        <label for="username">Tên tài khoản:</label>
        <input type="text" id="username" name="username" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Xác nhận</button>
</form>

<a href="/buoi2/Account/login" class="btn btn-secondary mt-2">Quay lại đăng nhập</a>

<?php include 'app/views/shares/footer.php'; ?>