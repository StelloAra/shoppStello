<?php
require_once("bootstrap.php");
require_once("components/Nav.php");
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once('Models/Database.php');
require_once('Models/UserDatabase.php');

$dbContext = new Database();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/styles.css" rel="stylesheet" />
</head>

<body>

    <!-- Navigation-->
    <?php Nav(); ?>


    <!-- Header-->
    <?php Headern("Nu är du med!"); ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h1>Tack</h1>
            <p>Tack för din registrering</p>
            <a href="/user/login" class="btn btn-primary">Logga in</a>




        </div>
    </section>



    <?php Footer(); ?>


</body>

</html>

<!-- 
<input type="text" name="title" value="<?php echo $product->title ?>">
        <input type="text" name="price" value="<?php echo $product->price ?>">
        <input type="text" name="stockLevel" value="<?php echo $product->stockLevel ?>">
        <input type="text" name="categoryName" value="<?php echo $product->categoryName ?>">
        <input type="submit" value="Uppdatera"> -->