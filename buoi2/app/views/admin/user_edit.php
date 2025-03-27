<?php include 'app/views/shares/header.php'; ?>

<h1>Sửa tài khoản</h1>

<form method="POST" action="/buoi2/User/edit/<?php echo $user->id; ?>">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="role">Role:</label>
        <select id="role" name="role" class="form-control" required>
            <option value="user" <?php echo $user->role == 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?php echo $user->role == 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
</form>

<a href="/buoi2/User/list" class="btn btn-secondary mt-2">Quay lại danh sách tài khoản</a>

<?php include 'app/views/shares/footer.php'; ?>