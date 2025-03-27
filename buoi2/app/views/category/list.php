<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="my-4">Danh sách danh mục</h1>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form action="/buoi2/Category/search" method="GET" class="form-inline">
                <div class="input-group w-100">
                    <input type="text" 
                           name="keyword" 
                           class="form-control" 
                           placeholder="Nhập từ khóa tìm kiếm..."
                           value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <?php if (AuthHelper::isAdmin()): ?>
            <div class="col-md-4 text-right">
                <a href="/buoi2/Category/addForm" class="btn btn-success">
                    <i class="fas fa-plus"></i> Thêm mới
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Category List -->
    <?php if (empty($categories)): ?>
        <div class="alert alert-info">Không tìm thấy danh mục nào</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                            </h5>
                            <p class="card-text text-muted">
                                <?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                        </div>
                        <?php if (AuthHelper::isAdmin()): ?>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between">
                                    <a href="/buoi2/Category/editForm/<?php echo $category->id; ?>" 
                                       class="btn btn-warning btn-sm">
                                       <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a href="/buoi2/Category/delete/<?php echo $category->id; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                       <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>