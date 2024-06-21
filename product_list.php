<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<h2>Product List</h2>
<div class="products">
    <?php
    $result = $conn->query("SELECT * FROM products");
    while($row = $result->fetch_assoc()):
    ?>
        <div class="product">
            <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
            <h3><?php echo $row['name']; ?></h3>
            <p><?php echo $row['description']; ?></p>
            <p>$<?php echo $row['price']; ?></p>
            <a href="product_detail.php?id=<?php echo $row['id']; ?>">Beli</a>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>
