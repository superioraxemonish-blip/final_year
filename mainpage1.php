<?php
include 'db.php';

/* Fetch products from database */
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html class="light" lang="en">

<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

<title>Krishi Connect</title>

<style>

/* ===== GLOBAL ===== */

*{
  transition:all 0.25s ease;
  box-sizing:border-box;
}

body{
  font-family:'Plus Jakarta Sans',sans-serif;
  background:#f5f7ff;
  overflow-x:hidden;
}

/* ===== BACKGROUND GLOW ===== */

body::before{
  content:"";
  position:fixed;
  width:500px;
  height:500px;
  background:radial-gradient(circle,rgba(99,102,241,0.4),transparent);
  top:-150px;
  left:-150px;
  filter:blur(120px);
  z-index:-1;
}

body::after{
  content:"";
  position:fixed;
  width:400px;
  height:400px;
  background:radial-gradient(circle,rgba(34,197,94,0.4),transparent);
  bottom:-150px;
  right:-150px;
  filter:blur(120px);
  z-index:-1;
}

/* ===== HEADER ===== */

header{
  backdrop-filter:blur(20px) saturate(180%);
  border-bottom:1px solid rgba(255,255,255,0.15);
}

.logo{
  background:linear-gradient(90deg,#4f46e5,#22c55e);
  background-clip:text;
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
}

/* ===== PRODUCTS ===== */

.products{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
  gap:25px;
  margin-top:30px;
}

.card{
  border-radius:24px;
  overflow:hidden;
  background:linear-gradient(145deg,#ffffff,#f1f5ff);
  box-shadow:0 15px 35px rgba(0,0,0,0.08);
}

.card:hover{
  transform:translateY(-8px) scale(1.02);
  box-shadow:0 25px 60px rgba(0,0,0,0.15);
}

.card img{
  width:100%;
  height:240px;
  object-fit:cover;
}

.card-content{
  padding:20px;
}

.category{
  display:inline-block;
  background:#e0f2fe;
  color:#0284c7;
  padding:6px 14px;
  border-radius:30px;
  font-size:13px;
  font-weight:700;
  margin-bottom:12px;
}

.card h2{
  font-size:24px;
  font-weight:800;
  margin-bottom:10px;
  color:#111827;
}

.desc{
  color:#6b7280;
  line-height:1.7;
  margin-bottom:15px;
}

.info{
  margin-bottom:8px;
  color:#374151;
  font-weight:600;
}

.price{
  font-size:24px;
  color:#16a34a;
  font-weight:800;
  margin-top:15px;
}

.buy-btn{
  width:100%;
  margin-top:18px;
  padding:14px;
  border:none;
  border-radius:16px;
  background:linear-gradient(135deg,#4f46e5,#22c55e);
  color:white;
  font-size:16px;
  font-weight:700;
  cursor:pointer;
}

.buy-btn:hover{
  transform:scale(1.03);
}

/* ===== SEARCH ===== */

.search-box{
  width:100%;
  padding:15px 20px;
  border:none;
  border-radius:18px;
  background:white;
  box-shadow:0 8px 20px rgba(0,0,0,0.06);
  font-size:16px;
}

.search-box:focus{
  outline:none;
  box-shadow:0 0 0 3px rgba(99,102,241,0.3);
}

/* ===== CATEGORY ===== */

.chips{
  display:flex;
  gap:12px;
  overflow-x:auto;
  padding-bottom:10px;
  margin-top:20px;
}

.chip{
  padding:10px 18px;
  border-radius:50px;
  background:white;
  font-weight:600;
  white-space:nowrap;
  box-shadow:0 4px 12px rgba(0,0,0,0.05);
}

.active-chip{
  background:#4f46e5;
  color:white;
}
.card img,
.card video{
    width:100%;
    height:260px;
    object-fit:cover;
    border-radius:0;
    display:block;
    background:#f3f4f6;
}
</style>
</head>

<body class="min-h-screen pb-32">

<!-- HEADER -->

<header class="bg-white/80 fixed top-0 w-full z-50 shadow-sm">

<div class="flex items-center justify-between px-5 h-16">

<h1 class="logo text-3xl font-extrabold">
Krishi Connect
</h1>

<div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">

<a href="profile.php">
<span class="material-symbols-outlined text-indigo-600">
person
</span>
</a>

</div>

</div>

</header>

<!-- MAIN -->

<main class="pt-24 px-5">

<!-- SEARCH -->

<input 
type="text" 
class="search-box" 
placeholder="Search products..."
>

<!-- CHIPS -->

<div class="chips">

<div class="chip active-chip">All</div>
<div class="chip">Fruits</div>
<div class="chip">Vegetables</div>
<div class="chip">Flowers</div>

</div>

<!-- PRODUCTS -->

<div class="products">

<?php

if($result && mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

?>

<div class="card">
<?php
$mediaQuery = $conn->query("SELECT * FROM product_media WHERE product_id=".$row['id']);

if($mediaQuery && $mediaQuery->num_rows > 0){

    while($media = $mediaQuery->fetch_assoc()) {

        if($media['file_type'] == 'image') {
?>

<img src="<?php echo $media['file_path']; ?>" alt="Product Image">

<?php
        } else {
?>

<video controls width="100%">
    <source src="<?php echo $media['file_path']; ?>" type="video/mp4">
</video>

<?php
        }
    }

} else {
?>

<img src="uploads/default.jpg" alt="No Image">

<?php
}
?>
<div class="card-content">

<div class="category">
<?php echo $row['category']; ?>
</div>

<h2>
<?php echo $row['title']; ?>
</h2>

<p class="desc">
<?php echo $row['description']; ?>
</p>

<div class="info">
👨 Farmer: <?php echo $row['user_name']; ?>
</div>

<div class="info">
⭐ Quality: <?php echo $row['quality']; ?>
</div>

<div class="info">
📍 Address: <?php echo $row['address']; ?>
</div>

<div class="info">
📞 Phone: <?php echo $row['phone']; ?>
</div>

<div class="price">
₹<?php echo $row['price']; ?>
</div>

<button class="buy-btn">
Buy Now
</button>

</div>

</div>

<?php
}

}else{

echo "<h2 class='text-2xl font-bold text-center mt-10'>No Products Available</h2>";

}
?>

</div>

</main>

<!-- BOTTOM NAV -->

<nav class="fixed bottom-0 left-0 w-full bg-white/90 backdrop-blur-2xl rounded-t-[32px] z-50 shadow-[0_-10px_40px_rgba(0,0,0,0.08)] border-t border-slate-100">

<div class="flex justify-around items-center px-8 pb-8 pt-4">

<a href="#" class="text-indigo-600">
<span class="material-symbols-outlined text-3xl">
home
</span>
</a>

<a href="mainadd.php" class="text-indigo-600">
<span class="material-symbols-outlined text-3xl">
add_circle
</span>
</a>

</div>

</nav>

</body>
</html>