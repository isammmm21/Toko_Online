<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>
<?php session_start(); ?>

<h2>Keranjang anda kosong :( </h2>
<div class="cart">
    <?php
    if(isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $_SESSION['cart'][$product_id] = $quantity;
    }

    $total = 0;
    if(isset($_SESSION['cart'])):
        foreach($_SESSION['cart'] as $id => $qty):
            $result = $conn->query("SELECT * FROM products WHERE id=$id");
            $product = $result->fetch_assoc();
            $total += $product['price'] * $qty;
    ?>
        <div class="cart-item">
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $qty; ?> x $<?php echo $product['price']; ?></p>
        </div>
    <?php endforeach; ?>
    <h3>Total: $<?php echo $total; ?></h3>
    <a href="order.php">Proceed to Order</a>
    <?php else: ?>
        <p>Keranjang kamu kosong nihh :( .</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
