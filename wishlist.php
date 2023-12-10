<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

// Fetch wishlist items for the logged-in user from the database
// Adjust database connection details as needed
$host = "localhost";
$user = "smustafa2";
$pass = "smustafa2";
$dbname = "smustafa2";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];

// Query to fetch wishlist items for the logged-in user
$sql = "SELECT * FROM wishlist WHERE username = '$username'"; // Replace 'wishlist' with your table name
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <!-- Add your CSS file -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="header">
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <a href="logout.php">Logout</a>
    </div>

    <div class="wishlist">
        <h2>My Wishlist</h2>
        <?php
        if ($result->num_rows > 0) {
            // Display wishlist items
            while ($row = $result->fetch_assoc()) {
                echo '<div class="wishlist-item">';
                echo '<h3>' . $row['property_name'] . '</h3>'; // Replace 'property_name' with your column name
                // Display more details of the wishlist item
                echo '</div>';
            }
        } else {
            echo "Your wishlist is empty.";
        }

        $conn->close();
        ?>
    </div>

    <div class="footer">
        ⓒ 2023 PropertEase
