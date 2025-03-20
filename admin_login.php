<?php
include 'connect.php';  // Make sure this includes your database connection
session_start();

if (isset($_POST['signIn'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Prepare a statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($db_email, $db_password);
            $stmt->fetch();

            // Directly compare the password (no hashing, plain-text comparison)
            if ($password === $db_password) {  // Plain-text comparison
                $_SESSION['email'] = $db_email;
                header("Location: message_section.php");  // Redirect to message section after login
                exit();
            } else {
                echo "<script>alert('Incorrect Password.'); window.location.href='index.html';</script>";
            }
        } else {
            echo "<script>alert('User Not Found.'); window.location.href='index.html';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill in all fields.'); window.location.href='index.html';</script>";
    }
}
?>
