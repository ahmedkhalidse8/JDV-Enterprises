<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cart = $_SESSION['cart'];
    $total = 0;

    foreach ($cart as $id => $quantity) {
        $query = "SELECT * FROM products WHERE id = $id";
        $result = $conn->query($query);
        $product = $result->fetch_assoc();
        $total += $product['price'] * $quantity;
    }

    $query = "INSERT INTO orders (customer_name, customer_email, total_amount) VALUES ('$name', '$email', $total)";
    if ($conn->query($query)) {
        $order_id = $conn->insert_id;

        foreach ($cart as $id => $quantity) {
            $query = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ($order_id, $id, $quantity)";
            $conn->query($query);
        }

        // Clear cart
        unset($_SESSION['cart']);

        echo "Order placed successfully. Thank you!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="my-4">Checkout</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
</body>
</html>
