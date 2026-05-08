<?php
session_start();
include 'db.php';

/** @var mysqli $conn */
if (!($conn instanceof mysqli)) {
    die('Database connection failed.');
}

if (isset($_POST['signup'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM signup WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result && $result->num_rows > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO signup (fullname, email, phone_no, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $email, $phone_no, $password);
        if ($stmt->execute()) {
            echo "<script>alert('Signup Successful! Please Login'); window.location='login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error occurred! Please try again.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>

<style>
/* RESET */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* BODY BACKGROUND WITH GLOW */
body {
  font-family: 'Poppins', sans-serif;
  background: radial-gradient(circle at top, #1e3a8a, #020617 70%);
  color: #fff;
  min-height: 100vh;
  overflow: hidden;
}

/* FLOATING BACKGROUND EFFECT */
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

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 50px;
  background: rgba(2, 6, 23, 0.6);
  backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(255,255,255,0.1);
}

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

/* CENTER CONTAINER */
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: calc(100vh - 120px);
}

/* GLASS CARD */
.signup-box {
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
.signup-box h2 {
  text-align: center;
  margin-bottom: 30px;
  font-size: 26px;
  background: linear-gradient(90deg, #22c55e, #3b82f6);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* INPUT GROUP */
.signup-box input {
  width: 100%;
  padding: 14px;
  margin: 12px 0;
  border-radius: 10px;
  border: none;
  outline: none;
  background: rgba(255,255,255,0.08);
  color: #fff;
  font-size: 14px;
  transition: all 0.3s ease;
}

.signup-box input::placeholder {
  color: #94a3b8;
}

/* INPUT FOCUS ANIMATION */
.signup-box input:focus {
  background: rgba(255,255,255,0.15);
  box-shadow: 0 0 0 2px #22c55e, 0 0 15px rgba(34,197,94,0.5);
  transform: scale(1.02);
}

/* BUTTON */
.signup-box button {
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
  transition: all 0.3s ease;
}

/* BUTTON HOVER */
.signup-box button:hover {
  transform: translateY(-3px) scale(1.03);
  box-shadow: 0 15px 30px rgba(34,197,94,0.5);
}

/* LOGIN LINK */
.signup-box p {
  text-align: center;
  margin-top: 18px;
  font-size: 14px;
}

.signup-box a {
  color: #3b82f6;
  font-weight: 600;
  text-decoration: none;
}

.signup-box a:hover {
  text-decoration: underline;
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
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
</head>

<body>

<header>
  <a href="home.html" class="logo">
    <img src="page\templates\mm.png" alt="Logo"> 
    <span>Krishi Connect</span>
  </a>
</header>

<div class="container">
  <div class="signup-box">
    <h2>Create Account</h2>

    <form method="POST">
      <input type="text" name="fullname" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone_no" placeholder="Phone Number" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="signup">Sign Up</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
</div>

<footer>
  © <?php echo date("Y"); ?> Krishi Connect | All Rights Reserved
</footer>

</body>
</html>