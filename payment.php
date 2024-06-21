<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>
<?php session_start(); ?>

<h2>Payment</h2>
<div class="payment">
    <?php
    if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address'])):
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $total = 0;
        $shipping_cost = 10; // Biaya pengiriman tetap

        if(isset($_SESSION['cart'])):
            foreach($_SESSION['cart'] as $id => $qty):
                $result = $conn->query("SELECT * FROM products WHERE id=$id");
                $product = $result->fetch_assoc();
                $total += $product['price'] * $qty;
            endforeach;
            $total += $shipping_cost;

            $conn->query("INSERT INTO orders (name, phone, address, total, shipping_cost) VALUES ('$name', '$phone', '$address', $total, $shipping_cost)");
            $order_id = $conn->insert_id;

            foreach($_SESSION['cart'] as $id => $qty):
                $result = $conn->query("SELECT * FROM products WHERE id=$id");
                $product = $result->fetch_assoc();
                $price = $product['price'];
                $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $id, $qty, $price)");
            endforeach;

            unset($_SESSION['cart']);
    ?>
    <h3>Pembelian Berhasil Guys!!!</h3>
    <p>Pesanan Anda Telah Dikirm.ID Pengiriman: <?php echo $order_id; ?></p>
    <p><a href="https://wa.me/6281222049446?Saya ingin order ka !!!=Order%20ID%20<?php echo $order_id; ?>%20Name%20<?php echo $name; ?>%20Total%20$<?php echo $total; ?>">Confirm Order via WhatsApp</a></p>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
    <?php else: ?>
        <p>Invalid request.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
