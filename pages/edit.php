<?php
require_once("bootstrap.php");
require_once('Models/Product.php');
require_once('components/Nav.php');
require_once("components/Footer.php");
require_once("components/Headern.php");
require_once("Models/Database.php");

$id = $_GET['id'];
$dbContext = new Database();
$product = $dbContext->getProduct($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product->title = $_POST['title'];
    $product->stockLevel = $_POST['stockLevel'];

    $product->price = $_POST['price'];
    $product->categoryName = $_POST['categoryName'];
    $product->popularity = $_POST['popularity'];

    $dbContext->updateProduct($product);
    header("Location: /admin/products");
    exit;
} else {
    // Det är INTE ett formulär som har postats - utan man har klickat in på länk tex edit.php?id=12
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
    <?php Headern("Edit"); ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

            <form method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $product->title ?>">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" value="<?php echo $product->price ?>">
                </div>
                <div class="form-group">
                    <label for="stockLevel">Stock</label>
                    <input type="text" class="form-control" name="stockLevel" value="<?php echo $product->stockLevel ?>">
                </div>
                <div class="form-group">
                    <label for="categpryName">Category name:</label>
                    <input type="text" class="form-control" name="categoryName" value="<?php echo $product->categoryName ?>">
                </div>
                <div class="form-group">
                    <label for="popularity">Popularity:</label>
                    <input type="number" class="form-control" name="popularity" value="<?php echo $product->popularity ?>">
                </div>
                <input type="submit" class="btn btn-primary bg-gradient-custom" value="Uppdatera">
            </form>
        </div>
    </section>



    <?php Footer(); ?>

</body>

</html>