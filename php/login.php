<?php
session_start();

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

// Check if the user exists
$sql = "SELECT * FROM login WHERE Email='$email' AND Password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['name'] = $row['name'];
    $_SESSION['email'] = $email;
    header('Location: profile.php');
} else {
    echo "Invalid email or password";
}
$conn->close();
?>
