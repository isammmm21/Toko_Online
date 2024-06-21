<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<h2>Add New Product</h2>
<form action="add_product.php" method="POST" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <label for="description">Description:</label>
    <textarea name="description" required></textarea>
    <label for="price">Price:</label>
    <input type="text" name="price" required>
    <label for="image">Image:</label>
    <input type="file" name="image" required>
    <button type="submit" name="submit">Add Product</button>
</form>

<?php
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
    if($conn->query($sql) === TRUE) {
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "<p>Product added successfully!</p>";
        } else {
            echo "<p>Failed to upload image.</p>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include 'includes/footer.php'; ?>
