<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection
    include 'connect.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM contacts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo 'User deleted successfully.';
    } else {
        echo 'Error deleting user: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
