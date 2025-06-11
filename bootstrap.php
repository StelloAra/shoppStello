<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("Models/Database.php");
require_once("Models/Cart.php");
require_once("Models/Product.php");
require_once("pages/function/SingleProduct.php");
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Headern.php");

global $dbContext, $session_id, $userId, $cart;

$dbContext = new Database();

$session_id = session_id();
$userId = null;

if ($dbContext->getUsersDatabase()->getAuth()->isLoggedIn()) {
    $userId = $dbContext->getUsersDatabase()->getAuth()->getUserId();
}

$cart = new Cart($dbContext, $session_id, $userId);
