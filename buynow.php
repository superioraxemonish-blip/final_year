<?php
session_start();
include 'db.php';

$id = $_GET['id'];

$product = mysqli_query($conn,
    "SELECT * FROM products WHERE id='$id'"
);

$row = mysqli_fetch_assoc($product);

/* GET PRODUCT IMAGE */

$image = "uploads/default.jpg";

$media = mysqli_query($conn,
    "SELECT * FROM product_media 
     WHERE product_id='$id' LIMIT 1"
);

if(mysqli_num_rows($media) > 0){

    $m = mysqli_fetch_assoc($media);

    $image = $m['file_path'];
}

/* INSERT ORDER */

$email = $_SESSION['email'];

$product_name = $row['title'];
$price = $row['price'];

mysqli_query($conn,
    "INSERT INTO orders
    (buyer_email, product_id, product_name, price, image)

    VALUES
    ('$email','$id','$product_name','$price','$image')"
);

header("Location: orders.php");
exit();
?>