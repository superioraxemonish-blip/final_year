<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Explore Farmers Hub | Krishi Connect</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f4fff3;
    overflow-x:hidden;
    color:#1f2937;
}

/* ================= HERO SECTION ================= */

.hero{
    min-height:100vh;
    background:
    linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.45)),
    url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?q=80&w=1400&auto=format&fit=crop');
    background-size:cover;
    background-position:center;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    padding:40px;
    position:relative;
}

.hero-content{
    max-width:900px;
    color:white;
    animation:fadeUp 1.2s ease;
}

.hero h1{
    font-size:72px;
    line-height:1.1;
    margin-bottom:25px;
    font-weight:800;
}

.hero h1 span{
    color:#7CFC8A;
}

.hero p{
    font-size:22px;
    line-height:1.8;
    margin-bottom:40px;
    color:#f1f5f9;
}

.hero-buttons{
    display:flex;
    justify-content:center;
    gap:20px;
    flex-wrap:wrap;
}

.btn{
    padding:16px 34px;
    border:none;
    border-radius:50px;
    font-size:17px;
    font-weight:700;
    cursor:pointer;
    transition:0.4s;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:10px;
}

.primary-btn{
    background:linear-gradient(135deg,#16a34a,#22c55e);
    color:white;
    box-shadow:0 10px 25px rgba(34,197,94,0.35);
}

.primary-btn:hover{
    transform:translateY(-4px);
}

.secondary-btn{
    background:white;
    color:#16a34a;
}

.secondary-btn:hover{
    transform:translateY(-4px);
    background:#dcfce7;
}

/* ================= STATS ================= */

.stats{
    width:90%;
    max-width:1200px;
    margin:-70px auto 80px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
    position:relative;
    z-index:10;
}

.stat-card{
    background:white;
    padding:35px 25px;
    border-radius:25px;
    text-align:center;
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
    transition:0.4s;
}

.stat-card:hover{
    transform:translateY(-8px);
}

.stat-card h2{
    font-size:42px;
    color:#16a34a;
    margin-bottom:10px;
}

.stat-card p{
    color:#6b7280;
    font-size:17px;
}

/* ================= SECTION ================= */

.section{
    width:90%;
    max-width:1300px;
    margin:auto;
    padding:70px 0;
}

.section-title{
    text-align:center;
    margin-bottom:60px;
}

.section-title h2{
    font-size:52px;
    color:#14532d;
    margin-bottom:18px;
}

.section-title p{
    max-width:850px;
    margin:auto;
    color:#6b7280;
    font-size:19px;
    line-height:1.8;
}

/* ================= FARMER CARDS ================= */

.farmer-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:30px;
}

.farmer-card{
    background:white;
    border-radius:28px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
    transition:0.4s;
}

.farmer-card:hover{
    transform:translateY(-10px) scale(1.02);
}

.farmer-card img{
    width:100%;
    height:260px;
    object-fit:cover;
}

.farmer-content{
    padding:28px;
}

.badge{
    display:inline-block;
    padding:8px 16px;
    border-radius:50px;
    background:#dcfce7;
    color:#15803d;
    font-size:13px;
    font-weight:700;
    margin-bottom:16px;
}

.farmer-content h3{
    font-size:28px;
    margin-bottom:14px;
    color:#14532d;
}

.farmer-content p{
    line-height:1.8;
    color:#6b7280;
    margin-bottom:20px;
}

.info-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:12px;
    color:#374151;
    font-weight:600;
}

.view-btn{
    width:100%;
    margin-top:20px;
    padding:14px;
    border:none;
    border-radius:16px;
    background:linear-gradient(135deg,#15803d,#22c55e);
    color:white;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:0.3s;
}

.view-btn:hover{
    transform:scale(1.03);
}

/* ================= FEATURES ================= */

.features{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:25px;
}

.feature-box{
    background:white;
    padding:35px;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
    transition:0.4s;
}

.feature-box:hover{
    transform:translateY(-8px);
}

.feature-box .material-symbols-outlined{
    font-size:60px;
    color:#16a34a;
    margin-bottom:20px;
}

.feature-box h3{
    font-size:28px;
    margin-bottom:15px;
    color:#14532d;
}

.feature-box p{
    color:#6b7280;
    line-height:1.8;
}

/* ================= CTA ================= */

.cta{
    background:linear-gradient(135deg,#14532d,#16a34a);
    color:white;
    text-align:center;
    padding:90px 30px;
    border-radius:35px;
    margin-top:80px;
    box-shadow:0 20px 60px rgba(0,0,0,0.15);
}

.cta h2{
    font-size:56px;
    margin-bottom:20px;
}

.cta p{
    max-width:800px;
    margin:auto;
    font-size:20px;
    line-height:1.9;
    margin-bottom:35px;
    color:#dcfce7;
}

/* ================= FOOTER ================= */

footer{
    margin-top:100px;
    background:#052e16;
    color:white;
    text-align:center;
    padding:35px;
}

footer p{
    color:#d1fae5;
    line-height:1.8;
}

/* ================= ANIMATION ================= */

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

    .hero h1{
        font-size:48px;
    }

    .hero p{
        font-size:18px;
    }

    .section-title h2{
        font-size:38px;
    }

    .cta h2{
        font-size:40px;
    }

}

</style>
</head>
<body>

<!-- HERO -->

<section class="hero">

<div class="hero-content">

<h1>
Explore India's <span>Top Farmers Hub</span>
</h1>

<p>
Krishi Connect empowers farmers and buyers through a smart agricultural marketplace. Discover fresh organic produce, trusted farmers, sustainable farming methods, direct partnerships, and transparent trading.
</p>

<div class="hero-buttons">
<a href="mainadd.php" class="btn primary-btn">
<span class="material-symbols-outlined">storefront</span>
Explore Products
</a>

<a href="community.php" class="btn secondary-btn">
<span class="material-symbols-outlined">groups</span>
Join Community
</a>
</div>

</div>

</section>

<!-- STATS -->

<section class="stats">

<div class="stat-card">
<h2>2500+</h2>
<p>Verified Farmers</p>
</div>

<div class="stat-card">
<h2>120+</h2>
<p>Organic Villages</p>
</div>

<div class="stat-card">
<h2>15K+</h2>
<p>Daily Orders</p>
</div>

<div class="stat-card">
<h2>98%</h2>
<p>Buyer Satisfaction</p>
</div>

</section>

<!-- FARMERS SECTION -->

<section class="section">

<div class="section-title">
<h2>Featured Farmers</h2>
<p>
Meet the dedicated farmers growing healthy, fresh, and sustainable produce across India. Connect directly with them and build trusted agricultural partnerships.
</p>
</div>

<div class="farmer-grid">

<div class="farmer-card">
<img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1200&auto=format&fit=crop">

<div class="farmer-content">
<div class="badge">Organic Farming</div>
<h3>Ramesh Gowda</h3>
<p>
Specialized in organic vegetables and chemical-free farming practices for over 15 years.
</p>

<div class="info-row">
<span>Location</span>
<span>Karnataka</span>
</div>

<div class="info-row">
<span>Products</span>
<span>Vegetables</span>
</div>

<button class="view-btn">View Farmer</button>
</div>
</div>

<div class="farmer-card">
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?q=80&w=1200&auto=format&fit=crop">

<div class="farmer-content">
<div class="badge">Fruit Specialist</div>
<h3>Sunita Patil</h3>
<p>
Produces export-quality mangoes, bananas, and papayas with modern irrigation methods.
</p>

<div class="info-row">
<span>Location</span>
<span>Maharashtra</span>
</div>

<div class="info-row">
<span>Products</span>
<span>Fruits</span>
</div>

<button class="view-btn">View Farmer</button>
</div>
</div>

<div class="farmer-card">
<img src="https://images.unsplash.com/photo-1492496913980-501348b61469?q=80&w=1200&auto=format&fit=crop">

<div class="farmer-content">
<div class="badge">Flower Farming</div>
<h3>Mahesh Kumar</h3>
<p>
Expert in flower cultivation with sustainable greenhouse technology and eco-friendly packaging.
</p>

<div class="info-row">
<span>Location</span>
<span>Tamil Nadu</span>
</div>

<div class="info-row">
<span>Products</span>
<span>Flowers</span>
</div>

<button class="view-btn">View Farmer</button>
</div>
</div>

</div>

</section>

<!-- FEATURES -->

<section class="section">

<div class="section-title">
<h2>Why Choose Krishi Connect?</h2>
<p>
We bring farmers and buyers together through transparency, trust, technology, and sustainable agricultural growth.
</p>
</div>

<div class="features">

<div class="feature-box">
<span class="material-symbols-outlined">verified</span>
<h3>Verified Farmers</h3>
<p>
Every farmer is verified for authenticity, quality production, and trusted delivery services.
</p>
</div>

<div class="feature-box">
<span class="material-symbols-outlined">payments</span>
<h3>Direct Payments</h3>
<p>
Buyers can directly pay farmers without intermediaries, ensuring fair profits.
</p>
</div>

<div class="feature-box">
<span class="material-symbols-outlined">eco</span>
<h3>Sustainable Farming</h3>
<p>
Promoting eco-friendly agriculture and reducing harmful farming practices.
</p>
</div>

<div class="feature-box">
<span class="material-symbols-outlined">local_shipping</span>
<h3>Fast Delivery</h3>
<p>
Integrated logistics ensure fresh produce reaches buyers quickly and safely.
</p>
</div>

</div>

<!-- CTA -->

<div class="cta">
<h2>Join the Future of Agriculture</h2>
<p>
Become part of India's growing digital farming ecosystem. Connect with buyers, increase profits, and grow your agricultural business with Krishi Connect.
</p>

<a href="signup.php" class="btn secondary-btn">
Get Started Today
</a>
</div>

</section>

<!-- FOOTER -->

<footer>
<p>
© 2026 Krishi Connect • Empowering Farmers Through Technology • Sustainable Agriculture for a Better Future
</p>
</footer>

</body>
</html>