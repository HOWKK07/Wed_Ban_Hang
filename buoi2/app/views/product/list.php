<?php include 'app/views/shares/header.php'; ?> 

<h1>Danh sách sản phẩm</h1> 

<form method="GET" action="/buoi2/Product/search" class="form-inline mb-3">
    <input type="text" name="query" class="form-control mr-2" placeholder="Tìm kiếm sản phẩm" value="<?php echo htmlspecialchars($_GET['query'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>

<?php if (AuthHelper::isAdmin()): ?>
    <a href="/buoi2/Product/add" class="btn btn-success mb-2">Thêm sản phẩm mới</a> 
<?php endif; ?>

<div class="row">
    <?php foreach ($products as $product): ?> 
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <?php if ($product->image): ?> 
                    <img src="/buoi2/<?php echo $product->image; ?>" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                <?php endif; ?> 
                <div class="card-body">
                    <h5 class="card-title"><a href="/buoi2/Product/show/<?php echo $product->id; ?>"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></a></h5>
                    <p class="card-text"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p> 
                    <p class="card-text">Giá: <?php echo number_format($product->price, 0, ',', '.'); ?> VND</p>
                    <p class="card-text">Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p> 
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex justify-content-between">
                        <?php if (AuthHelper::isAdmin()): ?>
                            <a href="/buoi2/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-sm">Sửa</a> 
                            <a href="/buoi2/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a> 
                        <?php endif; ?>
                        <a href="/buoi2/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng</a> 
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?> 
</div> 

<?php include 'app/views/shares/footer.php'; ?>