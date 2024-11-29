<?php
session_start();
include 'includes/db.php';

$id = $_GET['id'];

$query = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($query);
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

// Initialize cart if not already
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to cart
$_SESSION['cart'][$id] = isset($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id] + 1 : 1;

header("Location: cart.php");
exit;
?>
