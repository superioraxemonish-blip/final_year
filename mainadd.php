<?php 
session_start();
include 'db.php';

// ✅ Check login session
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Krishi Marketplace</title>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    background:
    linear-gradient(135deg,#e8f5e9,#f1f8e9,#dcedc8);
    background-size:400% 400%;
    animation:bgMove 12s ease infinite;
    overflow-x:hidden;
    position:relative;
}

/* Animated Background */

@keyframes bgMove{
    0%{
        background-position:0% 50%;
    }
    50%{
        background-position:100% 50%;
    }
    100%{
        background-position:0% 50%;
    }
}

/* Floating circles */

body::before,
body::after{
    content:'';
    position:absolute;
    border-radius:50%;
    z-index:-1;
    filter:blur(50px);
}

body::before{
    width:300px;
    height:300px;
    background:#81c784;
    top:-100px;
    left:-80px;
}

body::after{
    width:350px;
    height:350px;
    background:#a5d6a7;
    bottom:-120px;
    right:-100px;
}

/* ================= HEADER ================= */

header{
    width:100%;
    padding:22px 50px;
    background:rgba(46,125,50,0.85);
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 8px 25px rgba(0,0,0,0.1);
    position:sticky;
    top:0;
    z-index:1000;
}

header h2{
    font-size:28px;
    font-weight:700;
    letter-spacing:0.5px;
}

/* Logout Button */

.logout{
    text-decoration:none;
    background:white;
    color:#2e7d32;
    padding:12px 22px;
    border-radius:50px;
    font-weight:600;
    transition:0.4s;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.logout:hover{
    background:#1b5e20;
    color:white;
    transform:translateY(-2px);
}

/* ================= CONTAINER ================= */

.container{
    width:90%;
    max-width:950px;
    margin:50px auto;
}

/* ================= FORM BOX ================= */

.form-box{
    background:rgba(255,255,255,0.75);
    backdrop-filter:blur(20px);
    -webkit-backdrop-filter:blur(20px);
    border:1px solid rgba(255,255,255,0.3);
    padding:45px;
    border-radius:30px;
    box-shadow:
    0 10px 30px rgba(0,0,0,0.08),
    inset 0 1px 1px rgba(255,255,255,0.5);
    transition:0.4s ease;
    position:relative;
    overflow:hidden;
}

.form-box:hover{
    transform:translateY(-5px);
}

/* Top Glow */

.form-box::before{
    content:'';
    position:absolute;
    width:250px;
    height:250px;
    background:rgba(129,199,132,0.2);
    border-radius:50%;
    top:-120px;
    right:-120px;
}

/* Form Heading */

.form-box::after{
    content:'🌾 Add New Product';
    display:block;
    font-size:34px;
    font-weight:700;
    color:#1b5e20;
    margin-bottom:30px;
    position:relative;
    z-index:2;
}

/* ================= INPUTS ================= */

input,
textarea,
select{
    width:100%;
    padding:16px 18px;
    margin:14px 0;
    border:none;
    border-radius:16px;
    background:rgba(255,255,255,0.9);
    font-size:16px;
    transition:0.3s ease;
    box-shadow:
    inset 0 2px 5px rgba(0,0,0,0.05),
    0 3px 8px rgba(0,0,0,0.03);
}

input:focus,
textarea:focus,
select:focus{
    outline:none;
    transform:scale(1.01);
    background:white;
    box-shadow:
    0 0 0 4px rgba(67,160,71,0.2),
    0 8px 20px rgba(67,160,71,0.15);
}

textarea{
    min-height:130px;
    resize:none;
}

/* ================= LABEL ================= */

label{
    font-size:16px;
    font-weight:600;
    color:#2e7d32;
    margin-top:10px;
    display:block;
}

/* ================= FILE INPUT ================= */

input[type="file"]{
    padding:20px;
    background:#f1f8e9;
    border:2px dashed #81c784;
    cursor:pointer;
}

/* ================= BUTTON ================= */

.btn{
    width:100%;
    padding:18px;
    margin-top:25px;
    border:none;
    border-radius:18px;
    background:linear-gradient(135deg,#2e7d32,#66bb6a);
    color:white;
    font-size:20px;
    font-weight:700;
    letter-spacing:0.5px;
    cursor:pointer;
    transition:0.4s;
    position:relative;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(46,125,50,0.3);
}

/* Button shine */

.btn::before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,0.4),
        transparent
    );
    transition:0.6s;
}

.btn:hover::before{
    left:100%;
}

.btn:hover{
    transform:translateY(-3px) scale(1.01);
    box-shadow:0 15px 35px rgba(46,125,50,0.35);
}

/* ================= PRODUCT CARD ================= */

.product-box{
    background:white;
    margin-top:25px;
    border-radius:24px;
    padding:25px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
    transition:0.4s;
}

.product-box:hover{
    transform:translateY(-5px);
}

/* ================= MEDIA ================= */

img,
video{
    width:160px;
    height:160px;
    object-fit:cover;
    border-radius:18px;
    margin:10px;
    transition:0.4s;
    border:4px solid #e8f5e9;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

img:hover,
video:hover{
    transform:scale(1.05);
}

/* ================= SCROLLBAR ================= */

::-webkit-scrollbar{
    width:10px;
}

::-webkit-scrollbar-track{
    background:#e8f5e9;
}

::-webkit-scrollbar-thumb{
    background:#66bb6a;
    border-radius:20px;
}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

    header{
        flex-direction:column;
        gap:15px;
        text-align:center;
        padding:20px;
    }

    header h2{
        font-size:22px;
        line-height:1.5;
    }

    .container{
        width:95%;
    }

    .form-box{
        padding:30px 22px;
        border-radius:24px;
    }

    .form-box::after{
        font-size:26px;
    }

    .btn{
        font-size:18px;
        padding:16px;
    }

    input,
    textarea,
    select{
        padding:14px;
    }
}

</style>

</head>

<body>

<header>
    <h2>
        🌾 Welcome <?php echo $_SESSION['user']; ?> | Krishi Marketplace
        <a href="mainpage1.php" class="logout">Main Page</a>
    </h2>
</header>

<div class="container">

<!-- Add Product -->
<div class="form-box">
<form method="POST" enctype="multipart/form-data">

<select id="category" name="category" required onchange="updateProducts()">
    <option value="">Select Category</option>
    <option value="Fruits">Fruits</option>
    <option value="Vegetables">Vegetables</option>
    <option value="Flowers">Flowers</option>
    <option value="Nuts">Nuts</option>
    <option value="Grains">Grains</option>
</select>

<select id="title" name="title" required>
    <option value="">Select Product</option>
</select>

<script>
function updateProducts() {

    const category = document.getElementById("category").value;
    const title = document.getElementById("title");

    // Clear previous options
    title.innerHTML = '<option value="">Select Product</option>';

    // Product lists
    const products = {
        Fruits: [
            "Apple",
            "Banana",
            "Mango",
            "Orange",
            "Grapes",
            "Pineapple",
            "Watermelon",
            "Guava",
            "Pomegranate",
            "Strawberry",
            "Cherry",
            "Kiwi",
            "Pear",
            "Peach",
            "Plum",
            "Coconut",
            "Lemon",
            "Lychee",
            "Dragon Fruit",
            "Jackfruit",
            "Custard Apple",
            "Fig",
            "Avocado",
            "Blueberry",
            "Raspberry",
            "Muskmelon",
            "Sapota (Chikoo)",
            "Blackberry",
            "Apricot"
        ],

        Vegetables: [
            "Potato",
            "Tomato",
            "Onion",
            "Carrot",
            "Cabbage",
            "Cauliflower",
            "Brinjal (Eggplant)",
            "Spinach",
            "Radish",
            "Beetroot",
            "Lady Finger (Okra)",
            "Green Peas",
            "Capsicum",
            "Pumpkin",
            "Bottle Gourd",
            "Bitter Gourd",
            "Ridge Gourd",
            "Cucumber",
            "Broccoli",
            "Corn",
            "Mushroom",
            "Sweet Potato",
            "Turnip",
            "Drumstick",
            "Ginger",
            "Garlic",
            "Lettuce",
            "Celery",
            "Zucchini",
            "Spring Onion"
        ],

        Flowers: [
            "Rose",
            "Lotus",
            "Sunflower",
            "Jasmine",
            "Lily",
            "Tulip",
            "Marigold",
            "Hibiscus",
            "Orchid",
            "Daisy",
            "Lavender",
            "Chrysanthemum",
            "Daffodil",
            "Carnation",
            "Peony",
            "Magnolia",
            "Poppy",    
            "Bluebell",
            "Camellia",
            "Geranium",
            "Petunia",
            "Bougainvillea",
            "Periwinkle",
            "Snapdragon",
            "Water Lily",
            "Night Queen",
            "Morning Glory",
            "Dahlia",
            "Zinnia",
            "Aster"
        ],

        Nuts: [
            "Almond",
            "Cashew",
            "Walnut",
            "Pistachio",
            "Peanut",
            "Hazelnut"
        ],
         Grains: [
            "Rice",
            "Wheat",
            "Maize (Corn)",
            "Barley",
            "Oats",
            "Millet",
            "Sorghum",
            "Rye",
            "Quinoa",
            "Buckwheat",
            "Brown Rice",
            "Pearl Millet",
            "Finger Millet (Ragi)",
            "Foxtail Millet",
            "Little Millet",
            "Kodo Millet",
            "Barnyard Millet",
            "Amaranth",
            "Teff",
            "Wild Rice",
            "Bulgur",
            "Semolina",
            "Couscous",
            "Cracked Wheat",
            "Spelt",   
            "Farro",
            "Triticale",   
            "Job’s Tears",
            "Canary Seed",
            "Fonio"
        ]
    };

    // Add new options
    if (products[category]) {
        products[category].forEach(function(item) {
            const option = document.createElement("option");
            option.value = item;
            option.text = item;
            title.appendChild(option);
        });
    }
}
</script>

<textarea name="description" placeholder="Details about product"></textarea>

<input type="text" name="quality" placeholder="Quality (Fresh, Organic, etc)">

<input type="number" name="price" placeholder="Price">

<input type="text" name="address" placeholder="Address" required>

<input type="text" name="phone" placeholder="Phone Number" required>

<label>Upload Images/Videos</label>
<input type="file" name="media[]" multiple required>

<button class="btn" type="submit" name="add_product">Add Product</button>

</form>
</div>

<?php
// ✅ Insert Product
if (isset($_POST['add_product'])) {

    $user = $_SESSION['user']; // FIXED
    $category = $_POST['category'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $quality = $_POST['quality'];
    $price = $_POST['price'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO products 
    (user_name, category, title, description, quality, price, address, phone) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssdss", $user, $category, $title, $desc, $quality, $price, $address, $phone);
    $stmt->execute();

    $product_id = $stmt->insert_id;

    // ✅ Handle file uploads safely
   // Create uploads folder if not exists
if(!is_dir("uploads")){
    mkdir("uploads", 0777, true);
}

// Multiple file upload
// Create uploads folder if not exists
if(!is_dir("uploads")){
    mkdir("uploads", 0777, true);
}

// Multiple file upload
foreach($_FILES['media']['tmp_name'] as $key => $tmp_name){

    if(!empty($tmp_name)){

        $file_name = time() . "_" . basename($_FILES['media']['name'][$key]);

        $target_path = "uploads/" . $file_name;

        // Move uploaded file
        if(move_uploaded_file($tmp_name, $target_path)){

            // Get file extension
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Detect file type
            if(in_array($ext, ['jpg','jpeg','png','gif','webp'])){

                $file_type = "image";

            } 
            else if(in_array($ext, ['mp4','mov','avi','mkv'])){

                $file_type = "video";

            } 
            else{

                continue;
            }

            // Insert into database
            $stmt2 = $conn->prepare("
                INSERT INTO product_media
                (product_id, file_path, file_type)
                VALUES (?, ?, ?)
            ");

            $stmt2->bind_param(
                "iss",
                $product_id,
                $target_path,
                $file_type
            );

            $stmt2->execute();
        }
    }
}

    echo "<script>alert('Product Added Successfully!'); window.location='mainpage1.php';</script>";
}
?>


</div>

</div>




</body>
</html>