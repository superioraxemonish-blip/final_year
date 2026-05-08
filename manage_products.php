<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Products</title>

<style>

body{
    font-family:Arial;
    background:#f5f5f5;
    padding:30px;
}

h1{
    text-align:center;
    color:#2e7d32;
    margin-bottom:30px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

table th,
table td{
    padding:15px;
    border:1px solid #ddd;
    text-align:center;
}

table th{
    background:#4CAF50;
    color:white;
}

img{
    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:10px;
}

.edit-btn{
    background:#2196F3;
    color:white;
    padding:8px 15px;
    text-decoration:none;
    border-radius:5px;
}

.delete-btn{
    background:red;
    color:white;
    padding:8px 15px;
    text-decoration:none;
    border-radius:5px;
}

</style>
</head>
<body>

<h1>Manage Products</h1>

<table>

<tr>
    <th>Image</th>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td>
    <img src="uploads/<?php echo $row['uploaded_photo']; ?>">
</td>

<td>
    <?php echo $row['title']; ?>
</td>

<td>
    ₹<?php echo $row['price']; ?>
</td>

<td>
    <?php echo $row['quality']; ?>
</td>

<td>

    <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="edit-btn">
        Edit
    </a>

    <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="delete-btn">
        Delete
    </a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>