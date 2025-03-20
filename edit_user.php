<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection
    require 'connect.php';

    // Sanitize and validate input data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';

    // Validate required fields
    if ($id <= 0 || empty($firstname) || empty($lastname) || empty($email) || empty($phone_number)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email format.']);
        exit;
    }

    // Update query with prepared statement
    $sql = "UPDATE contacts SET firstname = ?, lastname = ?, email = ?, phone_number = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ssssi', $firstname, $lastname, $email, $phone_number, $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'User updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error updating user: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
    }

    $conn->close();
}
?>
