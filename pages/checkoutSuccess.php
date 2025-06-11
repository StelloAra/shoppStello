<?php
require_once("bootstrap.php");
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once('Models/Database.php');
require_once("Models/Cart.php");

$dbContext = new Database();
$userId = null;
$session_id = null;

if ($dbContext->getUsersDatabase()->getAuth()->isLoggedIn()) {
    $userId = $dbContext->getUsersDatabase()->getAuth()->getUserId();
}
//$cart = $dbContext->getCartByUser($userId);
$session_id = session_id();

$cart = new Cart($dbContext, $session_id, $userId);
$cart->clearCart();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5NXP0GE5CV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-5NXP0GE5CV', {
            'debug_mode': true
        });
    </script>

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
    <?php

    $googleItems = [];
    foreach ($cart->getItems() as $cartitem) {
        array_push($googleItems, [

            "quantity" => $cartitem->quantity,
            "price" => $cartitem->price,
            "item_id" => $cartitem->id,
            "item_name" => $cartitem->productName,
        ]);
    }

    ?>

    <script>
        gtag("event", "purchase", {
            transaction_id: Math.floor(Math.random() * 99999999),
            currency: "SEK",
            value: <?php echo $cart->getTotalPrice(); ?>,
            items: [
                <?php echo json_encode($googleItems); ?>
            ]
        });
    </script>

    <?php Nav(); ?>



    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h1>Tack</h1>
            <p>Tack för ditt köp!</p>

            // TODO CLEAR Cart
            // TODO webhook och lagra i databas = order?




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