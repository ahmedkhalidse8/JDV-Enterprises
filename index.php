<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
include 'includes/db.php'; // Include database connection
include 'includes/navbar.php'; // Include navigation bar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">PRODUCTS</h1>
    <div class="row">
        <?php
        $query = "SELECT * FROM products"; // Query to fetch all products
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="assets/images/<?= $row['image']; ?>" class="card-img-top" alt="<?= $row['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name']; ?></h5>
                            <p class="card-text"><?= $row['description']; ?></p>
                            <p class="card-text text-success font-weight-bold">$<?= $row['price']; ?></p>
                            <a href="add_to_cart.php?id=<?= $row['id']; ?>" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>No products available.</p>";
        }
        ?>
    </div>
</div>
<?php include 'includes/footer.php'; // Include footer ?>
</body>
</html>
