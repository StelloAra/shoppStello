<?php
require_once("utils/router.php");
require_once("vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(".");
$dotenv->load();
$router = new Router();

$router->addRoute('/', function () {
    require_once( __DIR__ .'/pages/index.php');
});
$router->addRoute('/category', function () {
    require_once( __DIR__ .'/pages/category.php');
});
$router->addRoute('/admin/products', function () {
    require_once( __DIR__ .'/pages/admin.php' );
});
$router->addRoute('/admin/edit', function () {
    require_once( __DIR__ .'/pages/edit.php');
});
$router->addRoute('/admin/new', function () {
    require_once( __DIR__ .'/pages/add_product.php');
});
$router->addRoute('/admin/delete', function () {
    require_once( __DIR__ .'/pages/delete.php');
});

$router->dispatch();