<?php
session_start();
include 'db.php';


/* FETCH ORDERS */

$email = $_SESSION['email'];

$result = mysqli_query($conn,
    "SELECT * FROM orders 
     WHERE buyer_email='$email'
     ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>My Orders</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f4f7f2;
}

/* HEADER */

.header{
    background:linear-gradient(to right, #2e7d32, #4CAF50);
    padding:20px 40px;

    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;

    color:white;

    box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

.header h1{
    font-size:32px;
}

/* BACK BUTTON */

.back-btn{
    text-decoration:none;
    background:white;
    color:#2e7d32;
    padding:10px 18px;
    border-radius:8px;
    font-weight:bold;
    transition:0.3s;
}

.back-btn:hover{
    background:#e8f5e9;
}

/* CONTAINER */

.container{
    width:90%;
    margin:40px auto;
}

/* ORDER GRID */

.orders{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:25px;
}

/* CARD */

.card{
    background:white;
    border-radius:20px;
    overflow:hidden;

    box-shadow:0 8px 20px rgba(0,0,0,0.1);

    transition:0.3s;
}

.card:hover{
    transform:translateY(-8px);
}

/* IMAGE */

.card img{
    width:100%;
    height:230px;
    object-fit:cover;
}

/* CONTENT */

.content{
    padding:20px;
}

.content h2{
    color:#2e7d32;
    margin-bottom:10px;
    font-size:24px;
}

.price{
    color:#ff5722;
    font-size:22px;
    font-weight:bold;
    margin-bottom:10px;
}

.date{
    color:#777;
    margin-bottom:20px;
}

/* STATUS */

.status{
    display:inline-block;
    padding:8px 15px;
    border-radius:30px;
    background:#e8f5e9;
    color:#2e7d32;
    font-weight:bold;
}

/* EMPTY */

.empty-box{
    background:white;
    padding:50px;
    border-radius:20px;
    text-align:center;

    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.empty-box h2{
    color:#555;
    margin-bottom:15px;
}

.shop-btn{
    display:inline-block;
    margin-top:15px;

    padding:12px 25px;

    background:#4CAF50;
    color:white;

    text-decoration:none;

    border-radius:10px;

    transition:0.3s;
}

.shop-btn:hover{
    background:#2e7d32;
}

</style>

</head>
<body>

<!-- HEADER -->

<div class="header">

    <h1>🛒 My Orders</h1>

    <a href="buyer_dashboard.php" class="back-btn">
        ← Back
    </a>

</div>

<!-- CONTAINER -->

<div class="container">

<?php
if(mysqli_num_rows($result) > 0){
?>

<div class="orders">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="card">

<img src="<?php echo $row['image']; ?>" alt="Product">

<div class="content">

<h2>
    <?php echo $row['product_name']; ?>
</h2>

<p class="price">
    ₹<?php echo $row['price']; ?>
</p>

<p class="date">
    Ordered on:
    <?php echo date("d M Y", strtotime($row['order_date'])); ?>
</p>

<span class="status">
    Order Placed
</span>

</div>

</div>

<?php } ?>

</div>

<?php
} else {
?>

<div class="empty-box">

<h2>No Orders Yet</h2>

<p>
Start shopping fresh farm products from farmers.
</p>

<a href="products.php" class="shop-btn">
    Shop Now
</a>

</div>

<?php } ?>

</div>

</body>
</html>