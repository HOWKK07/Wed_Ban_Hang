<?php include 'app/views/shares/header.php'; ?>

<h1>Danh sách tài khoản</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($user->role, ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <a href="/buoi2/User/editForm/<?php echo $user->id; ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="/buoi2/User/delete/<?php echo $user->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="/buoi2/Product" class="btn btn-primary mt-2">Quay lại</a>

<?php include 'app/views/shares/footer.php'; ?>