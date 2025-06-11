<?php
require_once("bootstrap.php");
require_once("components/Nav.php");
require 'vendor/autoload.php';
require_once('Models/Database.php');
require_once('Models/UserDatabase.php');


$dbContext = new Database();

$dbContext->getUsersDatabase()->getAuth()->logOut();
header('Location: /');
