<?php 
include 'db.php';
/** @var mysqli $conn */
if (!($conn instanceof mysqli)) {
    die('Database connection failed.');
}

// Ensure comments table exists
$tableCreate = "CREATE TABLE IF NOT EXISTS comments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    post_id INT UNSIGNED NOT NULL,
    user_name VARCHAR(255) NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!$conn->query($tableCreate)) {
    die("Database error: " . $conn->error);
}

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Post ID");
}

$post_id = $_GET['id'];

// Fetch post
$stmt = $conn->prepare("SELECT * FROM community_posts WHERE id=?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    die("Post not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Post</title>
   <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:linear-gradient(135deg,#eef7ea,#dcedc8);
    min-height:100vh;
    overflow-x:hidden;
    color:#2c3e2f;
}

/* ================= HEADER ================= */

header{
    background:linear-gradient(135deg,#1b5e20,#43a047);
    padding:22px 40px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
    position:sticky;
    top:0;
    z-index:1000;
}

.back-btn{
    color:white;
    text-decoration:none;
    font-size:18px;
    font-weight:600;
    transition:0.3s;
    display:inline-flex;
    align-items:center;
    gap:8px;
}

.back-btn:hover{
    transform:translateX(-5px);
    color:#dcedc8;
}

/* ================= CONTAINER ================= */

.container{
    width:90%;
    max-width:1000px;
    margin:40px auto;
}

/* ================= POST BOX ================= */

.post-box{
    background:rgba(255,255,255,0.85);
    backdrop-filter:blur(15px);
    padding:35px;
    border-radius:28px;
    margin-bottom:35px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    border:1px solid rgba(255,255,255,0.3);
    position:relative;
    overflow:hidden;
}

/* Decorative Background */

.post-box::before{
    content:'';
    position:absolute;
    width:220px;
    height:220px;
    background:rgba(129,199,132,0.15);
    border-radius:50%;
    top:-80px;
    right:-80px;
}

/* Post Title */

.post-box h2{
    font-size:36px;
    color:#1b5e20;
    margin-bottom:20px;
    font-weight:700;
    line-height:1.3;
}

/* Post Content */

.post-box p{
    font-size:17px;
    line-height:1.9;
    color:#555;
    margin-bottom:25px;
}

/* User Tag */

.post-box small{
    display:inline-block;
    background:#e8f5e9;
    color:#2e7d32;
    padding:10px 18px;
    border-radius:30px;
    font-weight:600;
    font-size:14px;
}

/* ================= SECTION TITLES ================= */

h3{
    font-size:28px;
    color:#1b5e20;
    margin-bottom:20px;
    margin-top:30px;
    font-weight:700;
}

/* ================= COMMENT BOX ================= */

.comment-box{
    background:white;
    padding:22px;
    border-radius:22px;
    margin-bottom:20px;
    box-shadow:0 8px 20px rgba(0,0,0,0.06);
    transition:0.3s ease;
    border-left:6px solid #43a047;
    position:relative;
}

.comment-box:hover{
    transform:translateY(-4px);
    box-shadow:0 15px 30px rgba(0,0,0,0.1);
}

/* Username */

.comment-box b{
    color:#2e7d32;
    font-size:17px;
    display:block;
    margin-bottom:10px;
}

/* ================= COMMENT FORM ================= */

form{
    background:rgba(255,255,255,0.8);
    padding:30px;
    border-radius:28px;
    margin-top:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    backdrop-filter:blur(10px);
}

/* Inputs */

input,
textarea{
    width:100%;
    padding:16px 18px;
    margin:12px 0;
    border:none;
    border-radius:18px;
    background:#f8fff7;
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
    0 8px 20px rgba(76,175,80,0.15);
}

/* ================= BUTTON ================= */

.btn{
    background:linear-gradient(135deg,#2e7d32,#66bb6a);
    color:white;
    padding:15px 28px;
    border:none;
    border-radius:18px;
    font-size:17px;
    font-weight:600;
    cursor:pointer;
    transition:0.4s;
    margin-top:10px;
    box-shadow:0 8px 20px rgba(46,125,50,0.25);
}

.btn:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 30px rgba(46,125,50,0.35);
}

/* ================= SCROLLBAR ================= */

::-webkit-scrollbar{
    width:10px;
}

::-webkit-scrollbar-track{
    background:#eef7ea;
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

    .container{
        width:95%;
    }

    header{
        padding:18px 20px;
    }

    .post-box{
        padding:25px;
        border-radius:22px;
    }

    .post-box h2{
        font-size:28px;
    }

    h3{
        font-size:24px;
    }

    form{
        padding:22px;
        border-radius:22px;
    }

    input,
    textarea{
        padding:14px;
    }

    .btn{
        width:100%;
        padding:16px;
    }
}

/* ================= FLOATING ANIMATION ================= */

@keyframes floatBox{
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

.post-box{
    animation:floatBox 5s ease-in-out infinite;
}

</style>
</head>

<body>

<header>
    <a href="community.php" class="back-btn">⬅ Back to Community</a>
</header>

<div class="container">

    <!-- Post -->
    <div class="post-box">
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        <small>👤 <?php echo htmlspecialchars($post['user_name']); ?></small>
    </div>

    <!-- Comments -->
    <h3>💬 Comments</h3>

    <?php
    $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id DESC");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $comments = $stmt->get_result();

    while ($row = $comments->fetch_assoc()) {
    ?>
        <div class="comment-box">
            <b><?php echo htmlspecialchars($row['user_name']); ?></b><br>
            <?php echo nl2br(htmlspecialchars($row['comment'])); ?>
        </div>
    <?php } ?>

    <!-- Add Comment -->
    <h3>Add Comment</h3>
    <form method="POST">
        <input type="text" name="user_name" placeholder="Your Name" required>
        <textarea name="comment" placeholder="Write your comment..." required></textarea>
        <button class="btn" name="add_comment">Submit</button>
    </form>

</div>

</body>
</html>

<?php
// Insert comment securely
if (isset($_POST['add_comment'])) {
    $user = $_POST['user_name'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_name, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $post_id, $user, $comment);
    $stmt->execute();

    header("Location: view_post.php?id=" . $post_id);
    exit();
}
?>