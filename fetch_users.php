<?php
// Include database connection
include 'connect.php';

// Fetch user data from the database
$sql = "SELECT id, firstname, lastname, email, phone_number, created_at FROM contacts";
$result = $conn->query($sql);

$users = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($users);

$conn->close();
?>
