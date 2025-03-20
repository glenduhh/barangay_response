<?php

session_start();
// If there's no session (user is not logged in), redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: admin_login.php"); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a message</title>

    <link rel="stylesheet" href="message_section.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="admin.js"></script>



    <style>
        .inputDesign{
                min-width: 450px;
                min-height: 40px;
                padding: 10px;
                font-family: 'Courier New', Courier, monospace;
                outline: none;
                background: #e8e8e8;
                box-shadow: 5px 5px 17px #c8c8c8,
                            -5px -5px 17px #ffffff;
                border: none;
                border-radius: 10px;
                transition: all .5s;
        }

        .inputDesign:focus {
            background: #e8e8e8;
            box-shadow: inset 5px 5px 17px #c8c8c8,
                        inset -5px -5px 17px #ffffff;
        }
  </style>
</head>
    
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="assets/images/bb1_logo.png" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">ResponseSystem</span> </a>
                <div class="nav_list"> 
                    
                    
                    <a href="message_section.php" class="nav_link active"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span> </a> 
                    <a href="received_contact_form.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a> 
                    <a href="about_us.php" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a> 
                    
                </div>
            </div> 
            <form method="post" action="logout.php" style="display: inline;">
                <button type="submit" name="logout" class="nav_link" style="border: none; background: none;">
                    <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
                </button>
            </form>
        </nav>
    </div>
    <br><br><br>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Post or Edit a Message</h2>
                <textarea id="message" class="inputDesign" style="height: 200px; "></textarea>
                <input type="hidden" id="message_id">
                <br>
                <button onclick="saveMessage()" class="btn btn-primary mt-2">Save</button>
            </div>
            <div class="col-md-6">
                <h2>Messages</h2>
                <div id="messages" class="bg-white p-2"></div>
            </div>
        </div>
    </div>

    <script>
        function loadMessages() {
            fetch('messages.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('messages').innerHTML = data.map(msg =>
                        `<p>
                            <strong>${msg.created_at}:</strong> ${msg.content}
                            <button onclick="editMessage(${msg.id}, '${msg.content}')" class="btn btn-secondary btn-sm">Edit</button>
                            <button onclick="deleteMessage(${msg.id})" class="btn btn-danger btn-sm">Delete</button>
                        </p>`
                    ).join('');
                });
        }

        function saveMessage() {
            const message = document.getElementById('message').value;
            const messageId = document.getElementById('message_id').value;

            let formData = new URLSearchParams();
            formData.append("content", message);
            if (messageId) formData.append("id", messageId);

            fetch('user/messages.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: formData.toString()
            }).then(response => response.text()).then(msg => {
                alert(msg);
                document.getElementById('message').value = "";
                document.getElementById('message_id').value = "";
                loadMessages();
            });
        }

        function editMessage(id, content) {
            document.getElementById('message').value = content;
            document.getElementById('message_id').value = id;
        }

        function deleteMessage(id) {
            if (!confirm("Are you sure you want to delete this message?")) return;

            let formData = new URLSearchParams();
            formData.append("id", id);
            formData.append("delete", "true");

            fetch('user/messages.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: formData.toString()
            }).then(response => response.text()).then(msg => {
                alert(msg);
                loadMessages();
            });
        }

        loadMessages();
    </script>
</body>
</html>
