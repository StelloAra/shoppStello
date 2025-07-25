<?php
function Nav()
{
?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" style="font-style: italic; color:darkgreen" href="/">Stello's Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategorier</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/category">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <?php
                            $dbContext = new Database();
                            foreach ($dbContext->getAllCategories() as $cat) {
                                echo "<li><a class='dropdown-item' href='/category?catname=$cat'>$cat</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#!">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Create account</a></li>
                </ul>
                <form action="/search" method="GET">
                    <input type="text" name="q" placeholder="Search" class="form-control">
                </form>

                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

<?php
}
?>