<?php
include 'includes/db.php';

$id = $_GET['id'];
$query = "DELETE FROM products WHERE id = $id";
if ($conn->query($query)) {
    echo "Product deleted successfully.";
} else {
    echo "Error: " . $conn->error;
}

header("Location: index.php");
exit;
?>
