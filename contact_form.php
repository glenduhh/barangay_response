<?php
// Include database connection
include 'connect.php';

// Validate and sanitize input data
$firstname = htmlspecialchars($_POST['firstname']);
$lastname = htmlspecialchars($_POST['lastname']);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$phone_number = htmlspecialchars($_POST['phone_number']);

if (!$email) {
    echo "Invalid email format";
    exit;
}

// Insert data into the database
$sql = "INSERT INTO contacts (firstname, lastname, email, phone_number)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $firstname, $lastname, $email, $phone_number);

if ($stmt->execute()) {
    echo "Form submitted!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>