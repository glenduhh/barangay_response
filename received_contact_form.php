<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin.js"></script>
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
                <a href="message_section.php" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span> </a>
                    <a href="received_contact_form.php" class="nav_link active"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a> 
                     
                    <a href="about_us.php" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a> 
                </div>
            </div> 
            <form method="post" action="logout.php">
                <button type="submit" name="logout" class="nav_link" style="border: none; background: none;">
                    <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
                </button>
            </form>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
        <div class="container">
            <h2 class="mt-4">Registered Users</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Created At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    <!-- User data will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="editUserId">
                        <div class="mb-3">
                            <label for="editFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editFirstName">
                        </div>
                        <div class="mb-3">
                            <label for="editLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editLastName">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail">
                        </div>
                        <div class="mb-3">
                            <label for="editPhoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="editPhoneNumber">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Fetch user data and display it in the table
            $.ajax({
                url: 'fetch_users.php',
                type: 'GET',
                success: function(data) {
                    var userTable = $('#userTable');
                    userTable.empty(); // Clear existing table data

                    data.forEach(function(user) {
                        var row = '<tr>' +
                            '<td>' + user.id + '</td>' +
                            '<td>' + user.firstname + '</td>' +
                            '<td>' + user.lastname + '</td>' +
                            '<td>' + user.email + '</td>' +
                            '<td>' + user.phone_number + '</td>' +
                            '<td>' + user.created_at + '</td>' +
                            '<td><button class="btn btn-primary edit-btn" data-id="' + user.id + '">Edit</button></td>' +
                            '<td><button class="btn btn-danger delete-btn" data-id="' + user.id + '">Delete</button></td>' +
                            '</tr>';
                        userTable.append(row);
                    });

                    // Edit button click event
                    $('.edit-btn').on('click', function() {
                        var userId = $(this).data('id');
                        var user = data.find(u => u.id == userId);

                        // Populate the form with user data
                        $('#editUserId').val(user.id);
                        $('#editFirstName').val(user.firstname);
                        $('#editLastName').val(user.lastname);
                        $('#editEmail').val(user.email);
                        $('#editPhoneNumber').val(user.phone_number);

                        // Show the modal
                        $('#editUserModal').modal('show');
                    });

                    // Delete button click event
                    $('.delete-btn').on('click', function() {
                        var userId = $(this).data('id');

                        if (confirm('Are you sure you want to delete this user?')) {
                            $.ajax({
                                url: 'delete_user.php',
                                type: 'POST',
                                data: { id: userId },
                                success: function(response) {
                                    alert(response);
                                    // Reload the user data
                                    location.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.error('Failed to delete user: ' + error);
                                }
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch user data: ' + error);
                }
            });

            // Handle edit form submission
            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'edit_user.php',
                    type: 'POST',
                    data: {
                        id: $('#editUserId').val(),
                        firstname: $('#editFirstName').val(),
                        lastname: $('#editLastName').val(),
                        email: $('#editEmail').val(),
                        phone_number: $('#editPhoneNumber').val()
                    },
                    success: function(response) {
                        alert(response);
                        // Reload the user data
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to update user: ' + error);
                    }
                });
            });
        });
    </script>
</body>
</html>
