<?php
require_once("Models/Product.php");
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Feader.php");
require_once("Models/Database.php");

$dbContext = new Database();
$sortCol = $_GET['sortCol'] ?? "";
$sortOrder = $_GET['sortOrder'] ?? "";

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
        <?php Headern("Admin"); ?>

        <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
        <a href="/admin/new" class="btn btn-primary">Create new</a>
            <table class="table">
                <thead>
                        <th>
                        <a href="/admin/products?sortCol=title&sortOrder=asc"><i class="bi bi-arrow-down-circle-fill"></i></a>
                            Name
                        <a href="/admin/products?sortCol=title&sortOrder=desc"><i class="bi bi-arrow-up-circle-fill"></i></a>
                        </th>
                        <th>
                        <a href="/admin/products?sortCol=categoryName&sortOrder=asc"><i class="bi bi-arrow-down-circle-fill"></i></a>
                            Category
                        <a href="/admin/products?sortCol=categoryName&sortOrder=desc"><i class="bi bi-arrow-up-circle-fill"></i></a>
                        </th>
                        <th>
                        <a href="/admin/products?sortCol=price&sortOrder=asc"><i class="bi bi-arrow-down-circle-fill"></i></a>
                            Price
                        <a href="/admin/products?sortCol=price&sortOrder=desc"><i class="bi bi-arrow-up-circle-fill"></i></a>
                        </th>
                        <th>
                        <a href="/admin/products?sortCol=stockLevel&sortOrder=asc"><i class="bi bi-arrow-down-circle-fill"></i></a>
                            Stock level
                        <a href="/admin/products?sortCol=stockLevel&sortOrder=desc"><i class="bi bi-arrow-up-circle-fill"></i></a>
                        </th>
                        <th>
                        <a href="/admin/products?sortCol=popularity&sortOrder=asc"><i class="bi bi-arrow-down-circle-fill"></i></a>
                            Popularity
                        <a href="/admin/products?sortCol=popularity&sortOrder=desc"><i class="bi bi-arrow-up-circle-fill"></i></a>
                        </th>
                        <th>action</th>
                </thead>

                <tbody>
                <?php foreach($dbContext->getAllProducts(
                    $sortCol, $sortOrder
                ) as $prod){ ?>
                    <tr>
                        <td><?php echo $prod->title; ?></td>
                        <td><?php echo $prod->categoryName; ?></td>
                        <td><?php echo $prod->price; ?></td>
                        <td><?php echo $prod->stockLevel; ?></td>
                        <td><?php echo $prod->popularity; ?></td>
                        <td>
                          <a href="edit?id=<?php echo $prod->id; ?>" class="btn btn-primary">Edit</a>
                          <a href="delete?id=<?php echo $prod->id; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        </section>

        <?php Footer(); ?>


    </body>
</html>

