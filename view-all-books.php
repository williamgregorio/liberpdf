<?php 
ini_set('display_errors', 1);
ini_set('display_setup_errors', 1);
?>

<?php
$pageTitle = 'All books';
include 'header.php';
require 'functions.php';

loadEnvironment();
isAuthenticated();

$database = database();

