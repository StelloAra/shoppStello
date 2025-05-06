<?php
require_once('Models/Product.php');
require_once('components/Nav.php');
require_once("components/Footer.php");
require_once("Models/Database.php");

$id = $_GET['id'];
$dbContext = new Database();
$product = $dbContext->getProduct($id);

 ?>
<!DOCTYPE html>
<html lang="en">

<?php
// Anslutning / logik
$product = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product = $dbContext->getProduct($_GET['id']);
}
?>

<?php if ($product): ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x400/dee2e6/6c757d.jpg" alt="<?php echo $product->title; ?>" />
            </div>
            <div class="col-md-6">
                <?php if ($product->price < 10): ?>
                    <span class="badge bg-dark mb-2">Sale</span>
                <?php endif; ?>
                <h1 class="display-5 fw-bolder"><?php echo $product->title; ?></h1>
                <p class="lead"><?php echo $product->description ?? "Ingen beskrivning tillgänglig."; ?></p>
                <div class="fs-5 mb-5">
                    <span>$<?php echo $product->price; ?>.00</span>
                </div>
                <form method="post" action="addToCart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Lägg i varukorg
                    </button>
                </form>
                <div class="mt-4">
                    <a href="/" class="btn btn-link">← Tillbaka till produkter</a>
                </div>
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