<?php
session_start();
include 'includes/db.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="my-4">Shopping Cart</h1>
    <?php if (empty($cart)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $id => $quantity):
                    $query = "SELECT * FROM products WHERE id = $id";
                    $result = $conn->query($query);
                    $product = $result->fetch_assoc();
                    $subtotal = $product['price'] * $quantity;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= $product['name']; ?></td>
                        <td>$<?= $product['price']; ?></td>
                        <td><?= $quantity; ?></td>
                        <td>$<?= $subtotal; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><strong>Total: $<?= $total; ?></strong></p>
        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    <?php endif; ?>
</div>
</body>
</html>
