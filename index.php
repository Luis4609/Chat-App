<?php
session_start();
// Include functions and connect to the database using PDO MySQL
//Change file config.php if needed, for the MySQL conection
include 'functions.php';
$pdo = pdo_connect_mysql();
// Page is set to login (login.php) by default, so when the visitor visits that will be 
// the page they see.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'login';
// Include and show the requested page
include $page . '.php';
