<?php include 'app/views/shares/header.php'; ?>

<h1>Doanh thu</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Ngày</th>
            <th>Tổng doanh thu</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($revenues as $revenue): ?>
            <tr>
                <td><?php echo $revenue->date; ?></td>
                <td><?php echo number_format($revenue->total, 0, ',', '.'); ?> VND</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'app/views/shares/footer.php'; ?>