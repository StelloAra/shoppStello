<?php
function SingleProduct($prod)
{
?>
    <div class="col mb-5">
        <a href="/showoneproduct?id=<?php echo $prod->id ?>" class="text-decoration-none text-dark">

            <div class="card h-100">
                <?php if ($prod->price < 10) {  ?>
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                <?php } ?>
                <img class="card-img-top" src="assets/th4.jpg" alt="smiley" />
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="fw-bolder"><?php echo $prod->title; ?></h5>
                        $<?php echo $prod->price; ?>.00
                    </div>
                </div>
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="javascript:addToCart(<?php echo $prod->id; ?>)">Add to cart</a></div>
                </div>
            </div>
    </div>
<?php
} ?>