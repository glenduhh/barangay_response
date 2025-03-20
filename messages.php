<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// PDO connection to the MySQL database
$pdo = new PDO("mysql:host=localhost:3307;dbname=admin_login", "root", "");

// Check if it's a POST request for adding, editing, or deleting a message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();  // Start the session to access the logged-in user's email

    if (!isset($_SESSION['email'])) {
        echo json_encode(["message" => "You must be logged in to perform this action."]);
        exit;
    }

    $user_email = $_SESSION['email'];  // Get logged-in user's email

    // Fetch user_id from users table based on the logged-in email
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute(['email' => $user_email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        echo json_encode(["message" => "User not found."]);
        exit;
    }

    $user_id = $user['id'];  // Get the user_id for the logged-in user

    if (isset($_POST['id']) && isset($_POST['delete'])) {
        // Delete a message
        $stmt = $pdo->prepare("DELETE FROM messages WHERE id = :id AND user_id = :user_id");
        $stmt->execute(['id' => $_POST['id'], 'user_id' => $user_id]);
        echo json_encode(["message" => "Message deleted!"]);
    } elseif (isset($_POST['id'])) {
        // Edit an existing message
        $stmt = $pdo->prepare("UPDATE messages SET content = :content WHERE id = :id AND user_id = :user_id");
        $stmt->execute(['content' => $_POST['content'], 'id' => $_POST['id'], 'user_id' => $user_id]);
        echo json_encode(["message" => "Message updated!"]);
    } else {
        // Insert new message
        $stmt = $pdo->prepare("INSERT INTO messages (content, user_id) VALUES (:content, :user_id)");
        $stmt->execute(['content' => $_POST['content'], 'user_id' => $user_id]);
        echo json_encode(["message" => "Message posted!"]);
    }
    exit;
}

// Fetch all messages from the messages table
$stmt = $pdo->prepare("SELECT id, content, created_at FROM messages ORDER BY created_at DESC");
$stmt->execute();

// Fetch all results as an associative array and return as JSON
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the messages as a JSON array
header('Content-Type: application/json');
echo json_encode($messages);
?>
