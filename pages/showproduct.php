<?php
require_once('Models/Product.php');
require_once('components/Nav.php');
require_once("components/Footer.php");
require_once("components/Headern.php");
require_once("Models/Database.php");

$userId = null;
$session_id = null;
$id = $_GET['id'];
$dbContext = new Database();
$product = $dbContext->getProduct($id);

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
    <?php Nav($dbContext, $session_id, $userId); ?>

    <?php
    $product = null;

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $product = $dbContext->getProduct($_GET['id']);
    }
    ?>

    <?php if ($product): ?>
        <section class="py-5 bg-dark bg-gradient">
            <div class="container px-4 px-lg-5 my-3">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img class="card-img-top mb-5 mb-md-0" src="assets/th3.jpg" alt="<?php echo $product->title; ?>" />
                    </div>
                    <div class="col-md-6">
                        <?php if ($product->price < 10): ?>
                            <span class="badge bg-dark mb-2">Sale</span>
                        <?php endif; ?>
                        <h1 class="display-5 fw-bolder" style="color:darkcyan"><?php echo $product->title; ?></h1>
                        <p class="lead" style="color:darkcyan"><?php echo $product->description ?? "Du har valt rätt! BRA SMAK !"; ?></p>
                        <div class="fs-5 mb-5">
                            <span style="color:darkcyan">$<?php echo $product->price; ?>.00</span>
                        </div>
                        <form method="post" action="addToCart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                            <button class="btn btn-outline-light flex-shrink-0" style="color:darkcyan" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Lägg i varukorg
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <div class="container text-center py-5">
            <h2>Produkten hittades inte</h2>
            <a href="index.php" class="btn btn-primary mt-3">Tillbaka till butiken</a>
        </div>
    <?php endif; ?>

    <?php Footer(); ?>

</body>

</html>