<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

$stmt = $conn->prepare("SELECT fullname, email FROM signup WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Profile</title>

<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #0f172a, #020617);
  color: white;
  margin: 0;
}

/* CONTAINER */
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

/* PROFILE CARD */
.profile-card {
  width: 350px;
  padding: 30px;
  border-radius: 15px;
  background: rgba(255,255,255,0.05);
  backdrop-filter: blur(20px);
  box-shadow: 0 20px 60px rgba(0,0,0,0.6);
  text-align: center;
}

/* AVATAR */
.avatar {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  background: linear-gradient(135deg, #22c55e, #3b82f6);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 36px;
  margin: 0 auto 15px;
}

/* NAME */
.profile-card h2 {
  margin: 10px 0;
}

/* DETAILS */
.info {
  margin-top: 20px;
  text-align: left;
}

.info p {
  background: rgba(255,255,255,0.08);
  padding: 10px;
  border-radius: 8px;
  margin: 8px 0;
}

/* BUTTON */
.logout {
  margin-top: 20px;
  display: inline-block;
  padding: 10px 20px;
  border-radius: 8px;
  background: #ef4444;
  color: white;
  text-decoration: none;
}

.logout:hover {
  background: #dc2626;
}
/* BUTTON GROUP */
.buttons {
  margin-top: 20px;
  display: flex;
  justify-content: space-between;
  gap: 10px;
}

/* BACK BUTTON */
.back-btn {
  flex: 1;
  text-align: center;
  padding: 8px;
  border-radius: 3px;
  background: #3b82f6;
  color: white;
  text-decoration: none;
  transition: 0.3s;
}

.back-btn:hover {
  background: #2563eb;
}

/* LOGOUT BUTTON (IMPROVED) */
.logout {
  flex: 1;
  text-align: center;
  padding: 10px;
  border-radius: 8px;
  background: #ef4444;
  color: white;
  text-decoration: none;
  transition: 0.3s;
}

.logout:hover {
  background: #dc2626;
}
</style>

</head>

<body>

<div class="container">
  <div class="profile-card">

    <div class="avatar">
      <?php echo strtoupper(substr($user['fullname'], 0, 1)); ?>
    </div>

    <h2><?php echo $user['fullname']; ?></h2>

    <div class="info">
      <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
      <?php if (isset($user['phone'])): ?>
      <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
      <?php endif; ?>
    </div>

    <!-- BUTTONS -->
    <div class="buttons">
      <a href="mainpage1.php" class="back-btn">⬅ Back</a>
      <a href="logout.php" class="logout">Logout</a>
    </div>

  </div>
</div>

</body>
</html>