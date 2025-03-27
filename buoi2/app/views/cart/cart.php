<?php include 'app/views/shares/header.php'; ?>

<h1>Giỏ hàng</h1>

<?php if (!empty($cart)): ?>
    <form method="POST" action="/buoi2/Cart/updateCart">
        <ul class="list-group">
            <?php $total = 0; ?>
            <?php foreach ($cart as $id => $item): ?>
                <?php $total += $item['price'] * $item['quantity']; ?>
                <li class="list-group-item">
                    <h2><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    <?php if ($item['image']): ?>
                        <img src="/buoi2/<?php echo $item['image']; ?>" alt="Product Image" style="max-width: 100px;">
                    <?php endif; ?>
                    <p>Giá: <?php echo number_format($item['price'], 0, ',', '.'); ?> VND</p>
                    <p>Số lượng: 
                        <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>" min="1" class="form-control" style="width: 80px; display: inline-block;">
                    </p>
                    <a href="/buoi2/Cart/removeFromCart/<?php echo $id; ?>" class="btn btn-danger">Xóa</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <button type="submit" class="btn btn-primary mt-2">Cập nhật giỏ hàng</button>
    </form>
    <h3 class="mt-4">Tổng giá trị: <?php echo number_format($total, 0, ',', '.'); ?> VND</h3>
    <a href="/buoi2/Cart/checkout" class="btn btn-primary mt-2">Thanh toán</a>
<?php else: ?>
    <p>Giỏ hàng trống.</p>
<?php endif; ?>

<a href="/buoi2/Product" class="btn btn-secondary mt-2">Tiếp tục mua sắm</a>

<?php include 'app/views/shares/footer.php'; ?>