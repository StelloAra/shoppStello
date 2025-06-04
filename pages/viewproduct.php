<?php
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once('Models/Database.php');
require_once("Utils/Validator.php");

$id = $_GET['id'];
$dbContext = new Database();
$product = $dbContext->getProduct($id); // TODO felhantering om inget produkt

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

    <script>
        gtag("event", "view_item", {
            currency: "SEK",
            value: <?php echo $product->price; ?>,
            items: [{
                item_id: "<?php echo $product->id; ?>",
                item_name: "<?php echo $product->title; ?>",
                price: <?php echo $product->price; ?>,
                quantity: 1
            }]
        });
    </script>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

            <h1><?php echo $product->title;  ?></h1>

            </form>
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