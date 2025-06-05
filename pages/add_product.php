<?php
require_once("bootstrap.php");
require_once('Models/Product.php');
require_once('components/Nav.php');
require_once("components/Footer.php");
require_once("components/Headern.php");
require_once("Models/Database.php");

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $price = $_POST["price"];
    $stockLevel = $_POST["stockLevel"];
    $categoryName = $_POST["categoryName"];
    $db->addproduct($title, $price, $stockLevel, $categoryName);
    header("Location: /admin/products");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="/css/styles.css" rel="stylesheet" />
</head>

<body>
    <?php Nav(); ?>
    <section class="py-5 bg-dark bg-gradient full-height-section">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-white w-100" style="max-width: 500px;">
                <h2 class="text-center mb-4 th-custom">Lägg till Produkt</h2>
                <form method="post" class="bg-light p-4 rounded shadow">
                    <input type="text" name="title" placeholder="Title" required><br><br>
                    <input type="number" name="price" placeholder="Price" required><br><br>
                    <input type="number" name="stockLevel" placeholder="Stocklevel" required><br><br>
                    <input type="text" name="categoryName" placeholder="Categori" required><br><br>
                    <input type="number" name="popularity" placeholder="Popularity" required><br><br>
                    <input type="submit" placeholder="Skicka"><br><br>
                </form>
            </div>
        </div>
    </section>
    <?php Footer(); ?>


</body>

</html>