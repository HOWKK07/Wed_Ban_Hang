<?php include 'app/views/shares/header.php'; ?>

<h1>Đặt lại mật khẩu</h1>

<form method="POST" action="/buoi2/Account/updatePassword">
    <input type="hidden" name="username" value="<?php echo htmlspecialchars($account->username, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="form-group">
        <label for="new_password">Mật khẩu mới:</label>
        <input type="password" id="new_password" name="new_password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="confirm_password">Xác nhận mật khẩu:</label>
        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
</form>

<a href="/buoi2/Account/login" class="btn btn-secondary mt-2">Quay lại đăng nhập</a>

<?php include 'app/views/shares/footer.php'; ?>