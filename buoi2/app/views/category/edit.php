<?php include 'app/views/shares/header.php'; ?>

<h1 class="my-4">Sửa danh mục</h1>

<!-- Check if category is not null before trying to use its properties -->
<?php if ($category): ?>

    <form method="POST" action="/buoi2/Category/edit/<?php echo $category->id; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục:</label>
            <input type="text" id="name" name="name" class="form-control" 
                   value="<?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả:</label>
            <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
<?php else: ?>
    <p>Danh mục không tồn tại.</p>
<?php endif; ?>

<a href="/buoi2/Category/list" class="btn btn-secondary mt-3">Quay lại danh sách danh mục</a>

<?php include 'app/views/shares/footer.php'; ?>
 