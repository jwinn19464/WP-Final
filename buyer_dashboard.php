<?php
session_start();

// Check if the user is logged in as a buyer
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}
// Check if it's the user's first login
if (!isset($_SESSION['first_login']) || $_SESSION['first_login'] === true) {
    echo "<div class='header'>";
    echo "<h1>Welcome to PropertEase! Thank you for choosing us.</h1>";
    echo "<a href='logout.php'>Logout</a>";
    echo "</div>";
    // Set first login as false after displaying the message
    $_SESSION['first_login'] = false;
}
// Fetch user's first name from the database
$host = "localhost";
$user = "smustafa2";
$pass = "smustafa2";
$dbname = "smustafa2";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$sql = "SELECT first_name FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstName = $row['first_name'];
} else {
    $firstName = "User";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard</title>
    <link rel="stylesheet" href="buyer.css">
</head>

<body>
    <div class="header">
        <h1>Welcome, <?php echo $firstName; ?></h1>
        <a href="logout.php">Logout</a>
    </div>

    <div class="search-bar">
        <form action="search.php" method="GET">
            <input type="text" name="search_term" placeholder="Search...">
            <input type="submit" value="Search">
        </form>
    </div>

    <div class="house-cards">
        <!-- House cards -->
        <div class="card">
            <div class="house-image">
                <img src="img/house1.png" alt="big red brick house with garage and multiple windows">
            </div>
            <div class="house-details">
                <div class="house-name">1516 Cutters Mill Dr, Lithonia, GA 30058</div>
            </div>
        </div>

        <div class="card">
            <div class="house-image">
                <img src="img/house2.png" alt="House 1">
            </div>
            <div class="house-details">
                <div class="house-name">113 Lincoln Rd, Branchland, WV 25506</div>
            </div>
        </div>

        <div class="card">
            <div class="house-image">
                <img src="img/house3.png" alt="House 1">
            </div>
            <div class="house-details">
                <div class="house-name">41 Woodland Villa Dr, Jasper, AL 35504</div>
            </div>
        </div>

        <div class="card">
            <div class="house-image">
                <img src="img/house4.png" alt="House 1">
            </div>
            <div class="house-details">
                <div class="house-name">6625 California Ave, Hammond, IN 46323</div>
            </div>
        </div>

        <div class="card">
            <div class="house-image">
                <img src="img/house5.png" alt="House 1">
            </div>
            <div class="house-details">
                <div class="house-name">9 Island Ave #2007, Miami Beach, FL 33139</div>
            </div>
        </div>

        <div class="card">
            <div class="house-image">
                <img src="img/house6.png" alt="House 1">
            </div>
            <div class="house-details">
                <div class="house-name">886 Pond Rd, Mount Vernon, ME 04352</div>
            </div>
        </div>
        <!-- End of house cards -->
    </div>

    <div class="footer">