<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Users</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/users.css">
</head>
<body class="general-body">
    <header class="site-header">
        <div class="logo">
            <a href="index.html">
      <img src="images/logo1.png">
      </a>
        </div>
        <div class="header-text-container">
            <h1>ADMIN AREA</h1>
            <p>USER MANAGEMENT</p>
        </div>
    </header>
    <button onclick="window.location.href='admin1.html'" class="top-left">Go Back</button>
    <div class="users-container">
        <form class="add-user-form" action="add_mail_users.php" method="POST">
            <h2>Add User</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <select required name="role">
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <button type="submit">Add User</button>
        </form>
        <div class="users-list">
            <h2>Registered Users</h2>
            <table class="users-table">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
                <?php include 'get_users.php'; ?>
            </table>
        </div>
    </div>
</body>
</html>