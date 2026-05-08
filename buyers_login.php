<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM signup WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        if(password_verify($password, $row['password'])){

            $_SESSION['email'] = $row['email'];
            $_SESSION['fullname'] = $row['fullname'];

            header("Location: buyer_dashboard.php");
            exit();

        } else {
            $error = "Incorrect Password";
        }

    } else {
        $error = "Email not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Buyer Login</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;

    background:url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?q=80&w=1600&auto=format&fit=crop') no-repeat center center/cover;
}

.overlay{
    position:absolute;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
}

.login-box{

    position:relative;
    z-index:1;

    width:400px;

    background:rgba(255,255,255,0.15);

    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);

    padding:40px;

    border-radius:20px;

    border:1px solid rgba(255,255,255,0.3);

    box-shadow:0 10px 25px rgba(0,0,0,0.3);

    text-align:center;
}

.login-box h1{
    color:white;
    margin-bottom:25px;
}

.input-box{
    width:100%;
    margin-bottom:20px;
}

.input-box input{
    width:100%;
    padding:14px;
    border:none;
    border-radius:10px;
    outline:none;
    font-size:16px;
}

.login-btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:10px;
    background:#4CAF50;
    color:white;
    font-size:18px;
    cursor:pointer;
    transition:0.3s;
}

.login-btn:hover{
    background:#388e3c;
}

.error{
    color:#ffcccc;
    margin-bottom:15px;
}

.register-link{
    margin-top:20px;
    color:white;
}

.register-link a{
    color:#FFD54F;
    text-decoration:none;
}

</style>

</head>
<body>

<div class="overlay"></div>

<div class="login-box">

    <h1>Buyer Login</h1>

    <?php
    if(isset($error)){
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="POST">

        <div class="input-box">
            <input type="email" name="email" placeholder="Enter Email" required>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Enter Password" required>
        </div>

        <button type="submit" name="login" class="login-btn">
            Login
        </button>

    </form>

    <div class="register-link">
        Don't have an account?
        <a href="signup.php">Register</a>
    </div>

</div>

</body>
</html>