<?php
session_start();

// Get form data
$firstname = $_POST['firstName'] ?? '';
$lastname = $_POST['lastName'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validate inputs
if (!$firstname || !$lastname || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$password) {
    echo "Please fill in all fields correctly.";
    exit;
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Connect to database
$conn = new mysqli("localhost", "root", "", "farmify");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Prevent duplicate emails
$stmt = $conn->prepare("SELECT email FROM Logininformation WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Email already exists.";
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

// Insert new user
$stmt = $conn->prepare("INSERT INTO Logininformation (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $firstname, $lastname, $email, $hashedPassword);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
