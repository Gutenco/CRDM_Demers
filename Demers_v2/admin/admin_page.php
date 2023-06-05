<?php

require_once '../auth.php';

// Check if user is logged in and has admin role
if ( !isAdmin()) {
    header('Location: ../login.php'); // Update the file path to login.php if it's in the same directory
    exit;
}

$html = @file_get_contents('../index_demers.html');

// Create a DOMDocument object and load the HTML

$dom = new DOMDocument();
@$dom->loadHTML($html);

// Get the text inside span with ID "department"
$department = $dom->getElementById('department')->textContent;

// Get the text inside i with ID "boss-name"
$bossName = $dom->getElementById('boss-name')->textContent;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<header>
    <h1>Admin Panel</h1>
    <nav>
        <ul>
            <li><a href="../index_demers.html">Home</a></li>
            <li><a href="#">New Account</a></li>
            <li><a href="#">Edit Main Page</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <section id="edit_page">
        <div class="container">
            <h2>Edit Main Page</h2>
            <form method="post" action="../update.php">
                <label for="department_name">Department Name:</label>
                <input type="text"  name="department_name" id="department_name">

                <label for="boss_name">Boss Name:</label>
                <input type="text"  name="boss_name" id="boss_name">

                <input type="submit" value="Save Changes">

            </form>
        </div>
        <div class="container">
            <h2>Preview</h2>
            <p><span id="preview_department"> <?php echo $department?> </span></p>
            <p><span id="preview_boss">  <?php echo  $bossName?> </span></p>
        </div>
    </section>

    <section>

        <div class="create-account-section">
            <h2>Create New Account</h2>
            <p>  <?php include('../message.php');?>  </p>
            <form action="../create_user.php" method="post">

                <label>Username: </label>
                <label>
                    <input type="text" name="new_username" required>
                </label>
                <br>
                <label>Password: </label>
                <label>
                    <input type="password" name="new_password" required>
                </label>
                <br>
                <label>Role: </label>
                <label>
                    <select name="new_role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </label>
                <br>
                <input type="submit" value="Create">
            </form>
        </div>
    </section>



    <div class="view-accounts-section">
        <h2>View All Accounts</h2>
        <table>
            <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Permissions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>JohnDoe</td>
                <td>johndoe@example.com</td>
                <td>Admin</td>
            </tr>
            <tr>
                <td>JaneDoe</td>
                <td>janedoe@example.com</td>
                <td>User</td>
            </tr>
            <!-- Add more rows for each account in the database -->
            </tbody>
        </table>
    </div>
</main>
</body>
</html>