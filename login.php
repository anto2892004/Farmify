<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmers";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Secure the query to prevent SQL Injection
    $stmt = $conn->prepare("SELECT * FROM info WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Redirect to home.html on successful login
            header("Location: home.html");
            exit();
        } else {
            echo "Invalid login credentials.";
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
