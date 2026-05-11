<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {

    $contact = trim($_POST['contact']);

if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
    // It's an email
    $email = $contact;
    $phone = null;
} else {
    // Assume it's phone number
    $phone = $contact;
    $email = null;
}
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM signup WHERE email=? OR phone_no=?");
    $stmt->bind_param("ss", $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];

            header("Location: mainpage1.php");
            exit();

        } else {
            echo "<script>alert('Wrong Password');</script>";
        }

    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
/* RESET */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* BACKGROUND */
body {
  font-family: 'Poppins', sans-serif;
  background: radial-gradient(circle at top, #1e3a8a, #020617 70%);
  color: #fff;
  min-height: 100vh;
  overflow: hidden;
}

/* GLOW EFFECT */
body::before {
  content: "";
  position: absolute;
  width: 500px;
  height: 500px;
  background: #22c55e;
  filter: blur(180px);
  top: -100px;
  left: -100px;
  opacity: 0.3;
}

body::after {
  content: "";
  position: absolute;
  width: 400px;
  height: 400px;
  background: #3b82f6;
  filter: blur(180px);
  bottom: -100px;
  right: -100px;
  opacity: 0.3;
}

/* HEADER (same as signup) */
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 50px;
  background: rgba(2, 6, 23, 0.6);
  backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(255,255,255,0.1);
}

/* LOGO TOP LEFT */
.logo {
  display: flex;
  align-items: center;
  gap: 12px;
  color: #22c55e;
  text-decoration: none;
  font-weight: 600;
  font-size: 20px;
}

.logo img {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  border: 2px solid #22c55e;
  transition: 0.4s;
}

.logo:hover img {
  transform: rotate(360deg) scale(1.1);
}

/* CENTER BOX */
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: calc(100vh - 120px);
}

/* GLASS LOGIN BOX */
.login-box {
  width: 380px;
  padding: 40px;
  border-radius: 18px;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(25px);
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 25px 80px rgba(0,0,0,0.7);
  animation: fadeUp 0.8s ease;
}

/* TITLE */
.login-box h2 {
  text-align: center;
  margin-bottom: 30px;
  font-size: 26px;
  background: linear-gradient(90deg, #22c55e, #3b82f6);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* INPUT */
.login-box input {
  width: 100%;
  padding: 14px;
  margin: 12px 0;
  border-radius: 10px;
  border: none;
  outline: none;
  background: rgba(255,255,255,0.08);
  color: #fff;
  font-size: 14px;
  transition: 0.3s;
}

.login-box input::placeholder {
  color: #94a3b8;
}

/* FOCUS */
.login-box input:focus {
  background: rgba(255,255,255,0.15);
  box-shadow: 0 0 0 2px #22c55e, 0 0 15px rgba(34,197,94,0.5);
  transform: scale(1.02);
}

/* BUTTON */
.login-box button {
  width: 100%;
  padding: 14px;
  margin-top: 18px;
  border-radius: 10px;
  border: none;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  color: #fff;
  background: linear-gradient(135deg, #22c55e, #3b82f6);
  transition: 0.3s;
}

.login-box button:hover {
  transform: translateY(-3px) scale(1.03);
  box-shadow: 0 15px 30px rgba(34,197,94,0.5);
}

/* LINK */
.login-box p {
  text-align: center;
  margin-top: 18px;
  font-size: 14px;
}

.login-box a {
  color: #3b82f6;
  font-weight: 600;
  text-decoration: none;
}

/* FOOTER */
footer {
  text-align: center;
  padding: 12px;
  font-size: 13px;
  color: #94a3b8;
  position: fixed;
  bottom: 0;
  width: 100%;
  background: rgba(2, 6, 23, 0.6);
  backdrop-filter: blur(10px);
}

/* ANIMATION */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>

<header>
  <a href="home.html" class="logo">
    <img src="page/templates/mm.png" alt="Logo">
    <span>Krishi Connect</span>
  </a>
</header>

<div class="container">
  <div class="login-box">
    <h2>Login</h2>

    <form method="POST">
    <input type="text" name="contact" placeholder="Email or Phone Number" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="login">Login</button>
    </form>

     <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
  </div>
</div>

<footer>
  © <?php echo date("Y"); ?> Krishi Connect | All Rights Reserved
</footer>

</body>
</html>