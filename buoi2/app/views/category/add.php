<?php include 'app/views/shares/header.php'; ?>

<h1 class="my-4">Thêm danh mục mới</h1>



<form action="/buoi2/Category/add" method="POST">
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($description ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Category</button>
</form>

<a href="/buoi2/Category/list" class="btn btn-secondary mt-3">Quay lại danh sách danh mục</a>

<?php include 'app/views/shares/footer.php'; ?>
