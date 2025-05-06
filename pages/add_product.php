<?php

require_once ("Models/Database.php");

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lägg till produkt</title>
</head>
<body>
    <h2>Lägg till Produkt</h2>
    <form method="post">
    <input type="text" name="title" placeholder="Title" required><br><br>
    <input type="number" name="price" placeholder="Price" required><br><br>
    <input type="number" name="stockLevel" placeholder="Stocklevel" required><br><br>
    <input type="text" name="categoryName" placeholder="Categori" required><br><br>
    <input type="number" name="popularity" placeholder="Popularity" required><br><br>
    <input type="submit" placeholder="Skicka"><br><br>
    </form>

</body>
</html>


