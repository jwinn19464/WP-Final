<?php
session_start();

$host = "localhost";
$user = "smustafa2";
$pass = "smustafa2";
$dbname = "smustafa2";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    $stmt = $conn->prepare("SELECT password, account_type FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            // Check user type and redirect accordingly
            if ($row['account_type'] === 'seller') {
                // Redirect to buyer dashboard
                header("Location: seller_dashboard.php");
                exit();
            } else {
                // Redirect to homepage or other pages based on different account types
                header("Location: homepage.html");
                exit();
            }
        }
    }
    echo "Invalid username or password!";
}

$conn->close();
?>