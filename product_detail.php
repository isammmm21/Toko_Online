<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();
?>

<h2><?php echo $product['name']; ?></h2>
<div class="product-detail">
    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <p><?php echo $product['description']; ?></p>
    <p>$<?php echo $product['price']; ?></p>
    <form action="cart.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" value="1" min="1">
        <button type="submit">Add to Cart</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
