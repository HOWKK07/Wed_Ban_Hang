<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    public function addForm()
    {
        include 'app/views/category/add.php';
    }

    public function add()
    {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';

        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));

        $errors = [];
        if (empty($name)) {
            $errors[] = "Category name is required.";
        }

        if (empty($description)) {
            $errors[] = "Description is required.";
        }

        if (!empty($errors)) {
            include 'app/views/category/add.php'; 
            return;
        }

        $isAdded = $this->categoryModel->addCategory($name, $description);

        if ($isAdded) {
            header("Location: /buoi2/Category/list");
            exit;
        } else {
            echo "Failed to add category.";
        }
    }

    public function editForm($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include 'app/views/category/edit.php';
        } else {
            echo "Category not found.";
        }
    }

    public function edit($id)
    {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';

        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));

        $errors = [];
        if (empty($name)) {
            $errors[] = "Category name is required.";
        }

        if (empty($description)) {
            $errors[] = "Description is required.";
        }

        if (!empty($errors)) {
            $category = $this->categoryModel->getCategoryById($id);
            include 'app/views/category/edit.php'; 
            return;
        }

        $isUpdated = $this->categoryModel->updateCategory($id, $name, $description);

        if ($isUpdated) {
            header("Location: /buoi2/Category/list");
            exit;
        } else {
            echo "Failed to update category.";
        }
    }

    public function delete($id)
    {
        $isDeleted = $this->categoryModel->deleteCategory($id);

        if ($isDeleted) {
            header("Location: /buoi2/Category/list");
            exit;
        } else {
            echo "Failed to delete category.";
        }
    }

    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $categories = $this->categoryModel->searchCategory($keyword);
        include 'app/views/category/list.php';
    }
}
?>
