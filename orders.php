<?php
session_start();
include 'db.php';

/* CHECK LOGIN */

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

/* CANCEL ORDER */

if (isset($_GET['cancel_id'])) {

    $cancel_id = intval($_GET['cancel_id']);

    $delete = mysqli_query($conn,
        "DELETE FROM orders 
         WHERE id='$cancel_id' 
         AND buyer_email='$email'"
    );

    if ($delete) {
        echo "<script>
                alert('Order Cancelled Successfully');
                window.location='orders.php';
              </script>";
    }else {

        echo "<script>
                alert('Failed To Cancel Order');
                window.location='orders.php';
              </script>";
    }
}

$result = mysqli_query($conn,
    "SELECT 
        orders.*,
        products.user_name,
        products.address,
        products.phone,
        products.title,
        products.description

     FROM orders

     INNER JOIN products
     ON orders.product_name = products.title

     WHERE orders.buyer_email='$email'

     ORDER BY orders.id DESC"
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
    font-family:'Poppins', sans-serif;
}

body{
    background:linear-gradient(135deg,#edf7ed,#f5fff5);
    min-height:100vh;
    color:#333;
}

/* HEADER */

.header{
    background:linear-gradient(135deg,#1b5e20,#43a047);
    padding:22px 45px;

    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;

    color:white;

    position:sticky;
    top:0;
    z-index:1000;

    box-shadow:0 8px 25px rgba(0,0,0,0.18);
}

.header h1{
    font-size:34px;
    letter-spacing:1px;
    font-weight:700;
}

/* BACK BUTTON */

.back-btn{
    text-decoration:none;
    background:white;
    color:#1b5e20;
    padding:12px 22px;
    border-radius:12px;
    font-weight:600;
    transition:0.3s ease;
    box-shadow:0 5px 12px rgba(0,0,0,0.15);
}

.back-btn:hover{
    background:#e8f5e9;
    transform:translateY(-3px);
}

/* CONTAINER */

.container{
    width:92%;
    margin:45px auto;
}

/* ORDER GRID */

.orders{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(340px,1fr));
    gap:30px;
}

/* CARD */

.card{
    background:white;
    border-radius:25px;
    overflow:hidden;

    position:relative;

    box-shadow:0 12px 30px rgba(0,0,0,0.10);

    transition:0.4s ease;
    border:1px solid rgba(255,255,255,0.4);
}

.card:hover{
    transform:translateY(-10px) scale(1.01);
    box-shadow:0 18px 35px rgba(0,0,0,0.18);
}

/* IMAGE */

.card img{
    width:100%;
    height:240px;
    object-fit:cover;
    transition:0.4s;
}

.card:hover img{
    transform:scale(1.05);
}

/* CONTENT */

.content{
    padding:24px;
}

.content h2{
    color:#1b5e20;
    margin-bottom:12px;
    font-size:28px;
    font-weight:700;
}

.price{
    color:#ff5722;
    font-size:26px;
    font-weight:bold;
    margin-bottom:18px;
}

/* INFO BOX */

.info{
    margin-bottom:14px;
    color:#555;
    line-height:1.7;
    word-break:break-word;

    background:#f8faf8;
    padding:12px 14px;
    border-radius:12px;

    border-left:4px solid #4CAF50;
}

.label{
    font-weight:700;
    color:#222;
}

/* STATUS */

.status{
    display:inline-block;
    padding:10px 18px;
    border-radius:40px;

    background:linear-gradient(135deg,#d4edda,#b7f5c5);
    color:#1b5e20;

    font-weight:700;
    margin-top:12px;

    box-shadow:0 4px 10px rgba(76,175,80,0.2);
}

/* BUTTONS */

.btn-group{
    margin-top:25px;
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.copy-btn,
.cancel-btn{
    border:none;
    padding:12px 20px;
    border-radius:12px;
    cursor:pointer;
    font-weight:600;
    font-size:15px;
    transition:0.3s ease;
}

/* COPY BUTTON */

.copy-btn{
    background:linear-gradient(135deg,#2196f3,#1976d2);
    color:white;

    box-shadow:0 6px 15px rgba(33,150,243,0.3);
}

.copy-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 18px rgba(33,150,243,0.4);
}

/* CANCEL BUTTON */

.cancel-btn{
    background:linear-gradient(135deg,#ef5350,#c62828);
    color:white;
    text-decoration:none;

    box-shadow:0 6px 15px rgba(244,67,54,0.3);
}

.cancel-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 18px rgba(244,67,54,0.4);
}

/* EMPTY BOX */

.empty-box{
    background:white;
    padding:60px 40px;
    border-radius:25px;
    text-align:center;

    box-shadow:0 10px 30px rgba(0,0,0,0.1);

    max-width:650px;
    margin:auto;
}

.empty-box h2{
    color:#444;
    margin-bottom:18px;
    font-size:34px;
}

.empty-box p{
    color:#666;
    font-size:18px;
}

/* SHOP BUTTON */

.shop-btn{
    display:inline-block;
    margin-top:25px;

    padding:14px 30px;

    background:linear-gradient(135deg,#43a047,#1b5e20);
    color:white;

    text-decoration:none;

    border-radius:14px;

    font-weight:600;
    font-size:16px;

    transition:0.3s ease;

    box-shadow:0 8px 18px rgba(76,175,80,0.3);
}

.shop-btn:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 22px rgba(76,175,80,0.45);
}

/* SCROLLBAR */

::-webkit-scrollbar{
    width:10px;
}

::-webkit-scrollbar-thumb{
    background:#43a047;
    border-radius:10px;
}

/* RESPONSIVE */

@media(max-width:768px){

    .header{
        padding:20px;
        text-align:center;
        gap:15px;
    }

    .header h1{
        font-size:28px;
    }

    .content h2{
        font-size:24px;
    }

    .price{
        font-size:22px;
    }

    .btn-group{
        flex-direction:column;
    }

    .copy-btn,
    .cancel-btn{
        width:100%;
        text-align:center;
    }
}

</style>

</head>
<body>

<!-- HEADER -->

<div class="header">

    <h1>🛒 My Orders</h1>

    <a href="products.php" class="back-btn">
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
    <?php echo $row['title']; ?>
</h2>

<p class="price">
    ₹<?php echo $row['price']; ?>
</p>

<p class="info">
    <span class="label">Seller Name:</span>
<?php echo $row['user_name']; ?></p>

<p class="info">
    <span class="label">Address:</span>
    <?php echo $row['address']; ?>
</p>

<p class="info">
    <span class="label">Phone:</span>
    <span id="phone<?php echo $row['id']; ?>">
        <?php echo $row['phone']; ?>
    </span>
</p>

<p class="info">
    <span class="label">Details:</span>
   <?php echo $row['description']; ?>
</p>

<p class="info">
    <span class="label">Ordered on:</span>
    <?php echo date("d M Y", strtotime($row['order_date'])); ?>
</p>

<span class="status">
    Order Placed
</span>

<div class="btn-group">

<button class="copy-btn"
onclick="copyPhone('phone<?php echo $row['id']; ?>')">
    Copy Number
</button>

<a class="cancel-btn"
href="?cancel_id=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure to cancel this order?')">
    Cancel Order
</a>

</div>

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

<script>

function copyPhone(id){

    let text =
        document.getElementById(id).innerText;

    navigator.clipboard.writeText(text);

    alert("Phone Number Copied");
}

</script>

</body>
</html>