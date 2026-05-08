<?php
include 'db.php';
/** @var mysqli $conn */
if (!($conn instanceof mysqli)) {
    die('Database connection failed.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krishi Community</title>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:linear-gradient(135deg,#eef8ec,#dff1dc);
    min-height:100vh;
    overflow-x:hidden;
}

/* ================= HEADER ================= */

header{
    background:linear-gradient(135deg,#1b5e20,#43a047);
    padding:22px;
    text-align:center;
    color:white;
    position:sticky;
    top:0;
    z-index:1000;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

header h2{
    font-size:34px;
    font-weight:700;
    letter-spacing:1px;
}

/* ================= MAIN CONTAINER ================= */

.container{
    width:90%;
    max-width:1100px;
    margin:40px auto;
}

/* ================= ADD POST BOX ================= */

.add-post{
    background:rgba(255,255,255,0.75);
    backdrop-filter:blur(15px);
    border-radius:25px;
    padding:35px;
    margin-bottom:35px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    border:1px solid rgba(255,255,255,0.4);
    position:relative;
    overflow:hidden;
}

/* Decorative Glow */

.add-post::before{
    content:'';
    position:absolute;
    width:250px;
    height:250px;
    background:rgba(76,175,80,0.12);
    border-radius:50%;
    top:-120px;
    right:-100px;
}

/* ================= FORM TITLE ================= */

.add-post form::before{
    content:'🌱 Ask the Farming Community';
    display:block;
    font-size:32px;
    font-weight:700;
    color:#1b5e20;
    margin-bottom:25px;
}

/* ================= INPUTS ================= */

input,
textarea{
    width:100%;
    padding:16px 18px;
    margin:12px 0;
    border:none;
    border-radius:16px;
    background:#f8fff8;
    font-size:16px;
    transition:0.3s ease;
    box-shadow:
    inset 0 2px 5px rgba(0,0,0,0.04),
    0 3px 8px rgba(0,0,0,0.03);
}

textarea{
    min-height:140px;
    resize:none;
}

input:focus,
textarea:focus{
    outline:none;
    background:white;
    transform:translateY(-2px);
    box-shadow:
    0 0 0 4px rgba(76,175,80,0.2),
    0 8px 20px rgba(76,175,80,0.1);
}

/* ================= BUTTONS ================= */

.btn,
.back-btn{
    display:inline-block;
    border:none;
    padding:14px 24px;
    margin-top:12px;
    margin-right:10px;
    border-radius:14px;
    cursor:pointer;
    font-size:16px;
    font-weight:600;
    transition:0.3s ease;
    text-decoration:none;
}

/* POST BUTTON */

.btn{
    background:linear-gradient(135deg,#2e7d32,#66bb6a);
    color:white;
    box-shadow:0 8px 20px rgba(46,125,50,0.25);
}

.btn:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 25px rgba(46,125,50,0.35);
}

/* BACK BUTTON */

.back-btn{
    background:white;
    color:#2e7d32;
    border:2px solid #2e7d32;
}

.back-btn:hover{
    background:#2e7d32;
    color:white;
    transform:translateY(-3px);
}

/* ================= POST CARD ================= */

.post-box{
    background:white;
    border-radius:24px;
    padding:28px;
    margin-bottom:28px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    transition:0.4s ease;
    position:relative;
    overflow:hidden;
}

/* Hover Animation */

.post-box:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 40px rgba(0,0,0,0.12);
}

/* Left Border Glow */

.post-box::before{
    content:'';
    position:absolute;
    left:0;
    top:0;
    width:8px;
    height:100%;
    background:linear-gradient(#43a047,#81c784);
}

/* Post Title */

.post-box h3{
    color:#1b5e20;
    font-size:28px;
    margin-bottom:14px;
    font-weight:700;
}

/* Post Content */

.post-box p{
    color:#555;
    line-height:1.8;
    font-size:16px;
    margin-bottom:18px;
}

/* User Name */

.post-box small{
    display:inline-block;
    background:#e8f5e9;
    padding:8px 14px;
    border-radius:30px;
    color:#2e7d32;
    font-weight:600;
    font-size:14px;
}

/* ================= DISCUSSION BUTTON ================= */

.post-box .btn{
    margin-top:18px;
    display:inline-flex;
    align-items:center;
    gap:8px;
}

/* ================= SCROLLBAR ================= */

::-webkit-scrollbar{
    width:10px;
}

::-webkit-scrollbar-track{
    background:#eef8ec;
}

::-webkit-scrollbar-thumb{
    background:#66bb6a;
    border-radius:20px;
}

::-webkit-scrollbar-thumb:hover{
    background:#2e7d32;
}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

    header h2{
        font-size:26px;
    }

    .container{
        width:95%;
    }

    .add-post{
        padding:25px;
        border-radius:20px;
    }

    .add-post form::before{
        font-size:24px;
    }

    .post-box{
        padding:22px;
        border-radius:20px;
    }

    .post-box h3{
        font-size:22px;
    }

    .btn,
    .back-btn{
        width:100%;
        text-align:center;
        margin-right:0;
    }
}

/* ================= FLOATING EFFECT ================= */

@keyframes floatCard{
    0%{
        transform:translateY(0px);
    }
    50%{
        transform:translateY(-6px);
    }
    100%{
        transform:translateY(0px);
    }
}

.add-post{
    animation:floatCard 5s ease-in-out infinite;
}

</style>
</head>

<body>

<header>
    <h2>🌾 Krishi Connect Community</h2>
</header>

<div class="container">

    <!-- Add Post -->
    <div class="add-post">
        <form method="POST">
            <input type="text" name="user_name" placeholder="Your Name" required>
            <input type="text" name="title" placeholder="Ask your question..." required>
            <textarea name="content" placeholder="Describe your issue..." required></textarea>
            <button type="submit" class="btn" name="submit">Post</button>
            <button onclick="goHome()" class="back-btn">⬅ Back to Home</button>

<script>
function goHome() {
    window.location.href = "home.html";
}
</script>
        </form>
    </div>

<?php
// Insert Post
if (isset($_POST['submit'])) {
    $user = $_POST['user_name'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO community_posts (user_name, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $title, $content);
    $stmt->execute();
}

// Fetch Posts
$result = $conn->query("SELECT * FROM community_posts ORDER BY id DESC");

while ($row = $result->fetch_assoc()) {
?>
    <div class="post-box">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['content']; ?></p>
        <small>👤 <?php echo $row['user_name']; ?></small><br><br>
        <a class="btn" href="view_post.php?id=<?php echo $row['id']; ?>">
            View Discussion
        </a>
    </div>
<?php } ?>

</div>

</body>
</html>
