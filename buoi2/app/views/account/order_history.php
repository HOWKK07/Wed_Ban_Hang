<?php include 'app/views/shares/header.php'; ?>

<h1>Lịch sử mua hàng</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Ngày tạo</th>
            <th>Tổng tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order->id; ?></td>
                <td><?php echo htmlspecialchars($order->name, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($order->phone, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($order->address, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo $order->created_at; ?></td>
                <td><?php echo number_format($order->total, 0, ',', '.'); ?> VND</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="/buoi2/Product" class="btn btn-primary mt-2">Tiếp tục mua sắm</a>

<?php include 'app/views/shares/footer.php'; ?>