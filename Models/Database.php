<?php
require_once("vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(".");
$dotenv->load();
class Database
{
    public $pdo;

    function __construct()
    {
        $host = $_ENV["host"];
        $db   = $_ENV["db"];
        $user = $_ENV["user"];
        $pass = $_ENV["pass"];
        $PORT = $_ENV["PORT"];


        $dsn = "mysql:host=$host:$PORT;dbname=$db";
        $this->pdo = new PDO($dsn, $user, $pass);
        $this->initDatabase();
        $this->addColumn();
    }

    function initDatabase()
    {
        $this->pdo->query('CREATE TABLE IF NOT EXISTS Products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(50),
                price INT,
                stockLevel INT,
                categoryName VARCHAR(50)
            )');
    }

    function getProduct($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM Products WHERE id = :id");
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'Product');
        return $query->fetch();
    }

    function updateProduct($product)
    {
        $s = "UPDATE Products SET title = :title," .
            " price = :price, stockLevel = :stockLevel, categoryName = :categoryName, popularity = :popularity WHERE id = :id";
        $query = $this->pdo->prepare($s);
        $query->execute([
            'title' => $product->title,
            'price' => $product->price,
            'stockLevel' => $product->stockLevel,
            'categoryName' => $product->categoryName,
            'id' => $product->id,
            'popularity' => $product->popularity,
        ]);
    }

    function deleteProduct($id)
    {
        $query = $this->pdo->prepare("DELETE FROM Products WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    function addproduct($title, $price, $stockLevel, $categoryName)
    {
        $stmt = $this->pdo->prepare('INSERT INTO Products (title, price, stockLevel, categoryName) VALUES (?,?,?,?)');
        return $stmt->execute([$title, $price, $stockLevel, $categoryName]);
    }
    function getAllProducts($sortCol = "id", $sortOrder = "asc")
    {

        if (!in_array($sortCol, ["id", "categoryName",  "title", "price", "stockLevel"])) {
            $sortCol = "id";
        }
        if (!in_array($sortOrder, ["asc", "desc"])) {
            $sortOrder = "asc";
        }

        $query = $this->pdo->query("SELECT * FROM Products ORDER BY $sortCol $sortOrder");
        return $query->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    function getCategoryProducts($catName)
    {
        if ($catName == "") {
            $query = $this->pdo->query("SELECT * FROM Products");
            return $query->fetchAll(PDO::FETCH_CLASS, 'Product');
        }
        $query = $this->pdo->prepare("SELECT * FROM Products WHERE categoryName = :categoryName");
        $query->execute(['categoryName' => $catName]);
        return $query->fetchAll(PDO::FETCH_CLASS, 'Product');
    }
    function getAllCategories()
    {
        $data = $this->pdo->query('SELECT DISTINCT categoryName FROM Products')->fetchAll(PDO::FETCH_COLUMN);
        return $data;
    }

    function columnExists($table, $column)
    {
        $query = $this->pdo->prepare("SHOW COLUMNS  FROM $table LIKE :column");
        $query->execute(['column' => $column]);
        return $query->rowCount() > 0;
    }

    function addColumn()
    {
        if ($this->columnExists("Products", "popularity")) {
            return;
        }
        $query = $this->pdo->query('ALTER TABLE Products ADD COLUMN popularity int default 0');
    }
    function getPopularProducts()
    {
        $query = $this->pdo->query("SELECT * FROM Products ORDER BY popularity DESC LIMIT 3");
        return $query->fetchAll(PDO::FETCH_CLASS, 'Product');
    }
}
