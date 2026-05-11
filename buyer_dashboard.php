<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Buyer Dashboard</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    min-height:100vh;

    background:
    linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
    url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?q=80&w=1600&auto=format&fit=crop');

    background-size:cover;
    background-position:center;
}

/* HEADER */

.header{
    width:100%;
    padding:20px 40px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    background:rgba(255,255,255,0.1);

    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);

    box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

.logo{
    color:white;
    font-size:32px;
    font-weight:bold;
}

/* BACK BUTTON */

.back-btn{
    text-decoration:none;
    background:white;
    color:#2e7d32;

    padding:12px 20px;

    border-radius:10px;

    font-weight:bold;

    transition:0.3s;
}

.back-btn:hover{
    background:#dcedc8;
    transform:scale(1.05);
}

/* MAIN CONTAINER */

.container{
    width:90%;
    margin:auto;
    padding:50px 0;
}

/* TITLE */

.title{
    text-align:center;
    color:white;
    margin-bottom:50px;
}

.title h1{
    font-size:50px;
    margin-bottom:15px;
}

.title p{
    font-size:18px;
    color:#f1f1f1;
}

/* BOXES */

.boxes{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:30px;
}

/* CARD */

.box{
    background:rgba(255,255,255,0.15);

    -webkit-backdrop-filter: blur(12px);
    backdrop-filter: blur(12px);

    border:1px solid rgba(255,255,255,0.2);

    padding:40px 25px;

    border-radius:25px;

    text-align:center;

    box-shadow:0 8px 25px rgba(0,0,0,0.2);

    transition:0.4s;
}

.box:hover{
    transform:translateY(-10px) scale(1.03);
}

/* ICON */

.icon{
    font-size:60px;
    margin-bottom:20px;
}

/* HEADING */

.box h2{
    color:white;
    margin-bottom:15px;
    font-size:28px;
}

/* TEXT */

.box p{
    color:#f1f1f1;
    margin-bottom:25px;
    line-height:1.6;
}

/* BUTTON */

.box a{
    display:inline-block;

    padding:14px 28px;

    background:#4CAF50;
    color:white;

    text-decoration:none;

    border-radius:12px;

    font-size:17px;
    font-weight:bold;

    transition:0.3s;
}

.box a:hover{
    background:#2e7d32;
    transform:scale(1.05);
}

/* RESPONSIVE */

@media(max-width:768px){

    .title h1{
        font-size:38px;
    }

    .header{
        padding:20px;
    }

    .logo{
        font-size:24px;
    }
}

</style>
</head>
<body>

<!-- HEADER -->

<div class="header">

    <div class="logo">
        🌾 Krishi Connect
    </div>

    <a href="getstated.html" class="back-btn">
        ← Back
    </a>

</div>

<!-- MAIN -->

<div class="container">

    <div class="title">

        <h1>Buyer Dashboard</h1>

        <p>
            Explore fresh farm products directly from farmers
        </p>

    </div>

    <div class="boxes">

        <!-- PRODUCTS -->

        <div class="box">

            <div class="icon">🛍️</div>

            <h2>View Products</h2>

            <p>
                Browse all available vegetables, fruits, grains and more.
            </p>

            <a href="products.php">
                Open
            </a>

        </div>

        <!-- ORDERS -->

        <div class="box">

            <div class="icon">📦</div>

            <h2>My Orders</h2>

            <p>
                Check your purchased products and order history.
            </p>

            <a href="orders.php">
                Open
            </a>

        </div>

    </div>

</div>

</body>
</html>