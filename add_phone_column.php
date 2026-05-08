<?php
include 'db.php';

/** @var mysqli $conn */
if (!($conn instanceof mysqli)) {
    die('Database connection failed.');
}

try {
    // Check if the phone column already exists
    $result = $conn->query("SHOW COLUMNS FROM signup LIKE 'phone'");
    
    if ($result->num_rows === 0) {
        // Column doesn't exist, add it
        $conn->query("ALTER TABLE signup ADD COLUMN phone VARCHAR(20) NOT NULL DEFAULT ''");
        echo "<script>alert('Phone column added successfully!'); window.location='signup.php';</script>";
    } else {
        echo "<script>alert('Phone column already exists!'); window.location='signup.php';</script>";
    }
} catch (mysqli_sql_exception $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "'); window.location='signup.php';</script>";
}
?>
