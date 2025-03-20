<?php
if (isset($_POST['logout'])) {
    session_start();  // Start the session to access session variables
    session_destroy();  // Destroy all session data

    header("Location: index.html");  // Redirect to index.html after logout
    exit();  // Ensure that no further code is executed
}
?>
