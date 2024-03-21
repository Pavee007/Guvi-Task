<?php
session_start();
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Credentials: true");

use MongoDB\Client;
// Connect to MongoDB
// try {
//     $mongoClient = new Client("mongodb://localhost:27017");
//     $db = $mongoClient->selectDatabase('Profile');
//     $collection = $db->selectCollection('PsInfo');
// } catch (Exception $e) {
//     echo "Error connecting to MongoDB: " . $e->getMessage();
//     exit();
// }
$mongoClient=new Client("mongodb://localhost:27017");
$collection=$Client->Profile->PsInfo;
// Check if user session exists
if (!isset($_SESSION['email'])) {
    echo "User session not found. Please log in.";
    exit();
}

$email = $_SESSION['email'];
$user = $collection->findOne(['email' => $email]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for updating profile
    $name = htmlspecialchars($_POST['name']);
    $age = intval($_POST['age']);
    $contact = htmlspecialchars($_POST['contact']);

    // Basic form validation
    if (empty($name) || $age <= 0 || empty($contact)) {
        echo "Please fill in all fields with valid data.";
        exit();
    }

    // Update personal information
    try {
        $updateResult = $collection->updateOne(
            ['email' => $email],
            ['$set' => ['personal_info' => ['name' => $name, 'age' => $age, 'contact' => $contact]]]
        );

        if ($updateResult->getModifiedCount() > 0) {
            // Redirect back to profile page after successful update
            header('Location: mongo.php');
            exit();
        } else {
            echo "No changes were made to the profile.";
        }
    } catch (Exception $e) {
        echo "Error updating profile: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../css/update.css">
</head>
<body>
    <div class="update-container">
        <h2>Update Profile</h2>
        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
