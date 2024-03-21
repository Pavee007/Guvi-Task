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

$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the email is already registered
$sql = "SELECT * FROM login WHERE Email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Email already exists";
} else {
    // Insert user into the database
    $sql = "INSERT INTO login (Username, Email, Password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        header('Location: profile.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
