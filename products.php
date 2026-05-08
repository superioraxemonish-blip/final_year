<?php
include 'db.php';

/* SEARCH */
$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $result = mysqli_query($conn,
        "SELECT * FROM products 
         WHERE title LIKE '%$search%' 
         OR description LIKE '%$search%'"
    );

} else {

    $result = mysqli_query($conn, "SELECT * FROM products");

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Available Products</title>

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
    color:white;

    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;

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

/* SEARCH */

.search-box{
    width:90%;
    margin:30px auto;
    display:flex;
    justify-content:center;
}

.search-box form{
    width:100%;
    max-width:700px;
    display:flex;
    gap:10px;
}

.search-box input{
    flex:1;
    padding:15px;
    border-radius:10px;
    border:1px solid #ccc;
    outline:none;
    font-size:16px;
}

.search-box button{
    padding:15px 25px;
    border:none;
    border-radius:10px;
    background:#4CAF50;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

.search-box button:hover{
    background:#388e3c;
}

/* PRODUCTS */

.container{
    width:90%;
    margin:auto;
    padding-bottom:40px;
}

.products{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:30px;
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

.card img,
.card video{
    width:100%;
    height:250px;
    object-fit:cover;
}

/* CONTENT */

.content{
    padding:20px;
}

.content h3{
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

.description{
    color:#555;
    margin-bottom:20px;
    line-height:1.5;
}

/* BUTTON */

.buy-btn{
    width:100%;
    padding:14px;
    border:none;
    background:#4CAF50;
    color:white;
    border-radius:10px;
    font-size:17px;
    cursor:pointer;
    transition:0.3s;
}

.buy-btn:hover{
    background:#2e7d32;
}

/* EMPTY */

.empty{
    text-align:center;
    font-size:22px;
    color:#777;
    margin-top:50px;
}

</style>

</head>
<body>

<!-- HEADER -->

<div class="header">

    <h1>🌾 Available Products</h1>

    <a href="buyer_dashboard.php" class="back-btn">
        ← Back
    </a>

</div>

<!-- SEARCH -->

<div class="search-box">

<form method="GET">

    <input 
        type="text" 
        name="search" 
        placeholder="Search products..."
        value="<?php echo $search; ?>"
    >

    <button type="submit">
        Search
    </button>

</form>

</div>

<!-- PRODUCTS -->

<div class="container">

<div class="products">

<?php
if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)) {
?>

<div class="card">

<?php
$mediaQuery = $conn->query(
    "SELECT * FROM product_media 
     WHERE product_id=".$row['id']
);

if($mediaQuery && $mediaQuery->num_rows > 0){

    while($media = $mediaQuery->fetch_assoc()) {

        if($media['file_type'] == 'image') {
?>

<img src="<?php echo $media['file_path']; ?>" alt="Product Image">

<?php
            break;

        } else {
?>

<video controls>
    <source src="<?php echo $media['file_path']; ?>" type="video/mp4">
</video>

<?php
            break;
        }
    }

} else {
?>

<img src="uploads/default.jpg" alt="No Image">

<?php
}
?>

<div class="content">

<h3>
    <?php echo $row['title']; ?>
</h3>

<p class="price">
    ₹<?php echo $row['price']; ?>
</p>

<p class="description">
    <?php echo $row['description']; ?>
</p>

<a href="buynow.php?id=<?php echo $row['id']; ?>">
    <button class="buy-btn">
        Buy Now
    </button>
</a>

</div>

</div>

<?php
}

} else {
?>

<p class="empty">
    No products found
</p>

<?php } ?>

</div>

</div>

</body>
</html>