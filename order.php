<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>
<?php session_start(); ?>

<h2>Order Summary</h2>
<div class="order-summary">
    <?php
    $total = 0;
    if(isset($_SESSION['cart'])):
        foreach($_SESSION['cart'] as $id => $qty):
            $result = $conn->query("SELECT * FROM products WHERE id=$id");
            $product = $result->fetch_assoc();
            $total += $product['price'] * $qty;
    ?>
        <div class="order-item">
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $qty; ?> x $<?php echo $product['price']; ?></p>
        </div>
    <?php endforeach; ?>
    <h3>Total: $<?php echo $total; ?></h3>
    <form action="payment.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" required>
        <label for="address">Address:</label>
        <textarea name="address" required></textarea>
        <button type="submit">Proceed to Payment</button>
    </form>
    <?php else: ?>
        <p>Keranjang kamu kosong nihh.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
