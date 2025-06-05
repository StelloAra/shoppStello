<?php
require_once("bootstrap.php");
require_once("Models/Product.php");
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Headern.php");
require_once("Models/Database.php");
require_once("Models/Cart.php");
require_once("pages/function/SingleProduct.php");

$dbContext = new Database();

$userId = null;
$session_id = null;

if ($dbContext->getUsersDatabase()->getAuth()->isLoggedIn()) {
    $userId = $dbContext->getUsersDatabase()->getAuth()->getUserId();
}
//$cart = $dbContext->getCartByUser($userId);
$session_id = session_id();

$cart = new Cart($dbContext, $session_id, $userId, $cart);




// POPULÄRA PRODUKTER - product 1 to many reviews text+betyg
// Vi gör enkelt : i products skapar vi PopularityFactor som är en int mellan 1-100
// ju högre ju mer populär

// På startsidan så visas de 10 mest populära produkterna
// Skapa en  getPopularProducts() i Database.php som returnerar en array av produkter
// select * from products order by popularityFactor desc limit 10	

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
        gtag("event", "view_cart", {
            currency: "SEK",
            value: <?php echo $cart->getTotalPrice(); ?>,
            items: [
                <?php echo json_encode($googleItems); ?>
            ]
        });



        function onCheckout() {
            gtag("event", "begin_checkout", {
                currency: "SEK",
                value: <?php echo $cart->getTotalPrice(); ?>,
                items: [
                    <?php echo json_encode($googleItems); ?>
                ]
            });

        }
    </script>




    <!-- Navigation-->
    <?php Nav(); ?>

    <!-- Header-->
    <?php Headern("<h3>Din Cart</h3>"); ?>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Row Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="cartItemsTable">
                        <?php foreach ($cart->getItems() as $item) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $item->productName; ?>
                                </td>
                                <td>
                                    <?php echo $item->quantity; ?>
                                </td>

                                <td>
                                    <?php echo $item->productPrice; ?>
                                </td>

                                <td>
                                    <?php echo $item->rowPrice; ?>
                                </td>
                                <td>
                                    <a href="javascript:addToCart(<?php echo $item->productId;  ?>, true)" class="btn btn-info">PLUS JS</a>

                                    <a href="/addToCart?productId=<?php echo $item->productId ?>&fromPage=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" class="btn btn-primary">+</a>
                                    <a href="/removeFromCart?productId=<?php echo $item->productId ?>&fromPage=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" class="btn btn-danger">-</a>
                                    <a href="/removeFromCart?removeCount=<?php echo $item->quantity ?>&productId=<?php echo $item->productId ?>&fromPage=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" class="btn btn-danger">DELETE ALL</a>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td id="totalPrice"><?php echo $cart->getTotalPrice(); ?></td>
                            <td>
                                <a href="/checkout" onclick="onCheckout()" class="btn btn-success">Checkout</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </section>

    <?php Footer(); ?>

</body>

</html>