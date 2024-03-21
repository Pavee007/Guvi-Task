<?php

session_start();

// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM login WHERE Email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch data and store in array
        while($row = $result->fetch_assoc()) {
            $username = $row['Username'];
        }
    } else {
        // Handle the case where the user is not found
        $username = "User not found";
    }

    // Store fetched data in session variable
    $_SESSION['Username'] = $username;
} else {
    // Handle the case where the email is not set in session
    $_SESSION['Username'] = "User not found";
}
$user=$email;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <div class="profile-container">
        <h2>Welcome..! <?php echo $_SESSION['Username']; ?></h2>
        <?php if ($user): ?>
            <?php if (!empty($user['personal_info'])): ?>
                <h3>Personal Information:</h3>
                <p>Name: <?php echo $user['personal_info']['name']; ?></p>
                <p>Age: <?php echo $user['personal_info']['age']; ?></p>
                <p>Contact: <?php echo $user['personal_info']['contact']; ?></p>
            <?php else: ?>
                <p>No personal information available. <a href="update.php">Update Now</a></p>
            <?php endif; ?>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
