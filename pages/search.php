<?php
require_once("bootstrap.php");
require_once("Models/Product.php");
require_once("components/Footer.php");
require_once("Models/Database.php");
require_once("Models/UserDatabase.php");
require_once("./pages/function/SingleProduct.php");
require_once("Utils/SearchEngine.php");
require_once("components/Nav.php");
require_once("components/Headern.php");

$userId = null;
$session_id = null;
$dbContext = new Database();

$q = $_GET['q'] ?? "";
$sortCol = $_GET['sortCol'] ?? "title";
$sortOrder = $_GET['sortOrder'] ?? "asc";
$pageNo = $_GET['pageNo'] ?? "1";

$pageSize = $_GET['pageSize'] ?? "10";

$searchEngine = new SearchEngine();

$result = $searchEngine->search($q, $sortCol, $sortOrder, $pageNo, $pageSize);
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

    <?php Headern("Stello's Shop" . "" . "<h5>Populära produkter</h5>", $dbContext); ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5 d-flex gap-3">
            <div>
                <div class="text-center mb-4">
                    <a href="?sortCol=title&sortOrder=asc&q=<?php echo $q; ?>" class="btn btn-secondary">Title asc</a>
                    <a href="?sortCol=title&sortOrder=desc&q=<?php echo $q; ?>" class="btn btn-secondary">Title desc</a>
                    <a href="?sortCol=price&sortOrder=asc&q=<?php echo $q; ?>" class="btn btn-secondary">Price asc</a>
                    <a href="?sortCol=price&sortOrder=desc&q=<?php echo $q; ?>" class="btn btn-secondary">Price desc</a>
                </div>

                <div class="text-center mb-4">
                    <?php if (!empty($result['message'])): ?>
                        <h3><?php echo htmlspecialchars($result['message']); ?></h3>
                    <?php else: ?>
                        <?php foreach ($result["aggregations"] as $agg): ?>
                            <h3><?php echo htmlspecialchars($agg["key"]); ?></h3>
                            <p>
                                <?php foreach ($agg["values"]["buckets"] as $bucket): ?>
                            <div>
                                <a href="">
                                    <?php echo htmlspecialchars($bucket["key"]); ?> (<?php echo $bucket["doc_count"]; ?>)
                                </a>
                            </div>
                        <?php endforeach; ?>
                        </p>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
                <div class="text-center mb-4">
                    <div>
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                            <?php
                            foreach ($result["data"] as $prod) {
                                SingleProduct($prod);
                            } ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container px-4 px-lg-5 mt-5">

            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $result["num_pages"]; $i++) {
                        if ($i == $pageNo) {
                            echo " <li class='page-item active'><span class='page-link'>$i</span></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='?q=$q&pageNo=$i&sortCol=$sortCol&sortOrder=$sortOrder'>$i</a></li>";
                        }
                    } ?>

                </ul>
            </nav>

        </div>
    </section>

    <?php Footer(); ?>


</body>

</html>