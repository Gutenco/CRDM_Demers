<?php
require_once 'config/db_config.php';
session_start();

function createUser($username, $password, $role)
{
    global $conn;

    // Check if username already exists
    $existingUserQuery = "SELECT id FROM users WHERE username = '$username'";
    $existingUserResult = mysqli_query($conn, $existingUserQuery);

    if (!$existingUserResult) {
        die('Error executing query: ' . mysqli_error($conn)); // Handle query execution error
    }

    if (mysqli_num_rows($existingUserResult) > 0) {
        return false; // Username already exists, return false
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user/admin into the database
    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashedPassword', '$role')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error executing query: ' . mysqli_error($conn)); // Handle query execution error
    }
    return true; // User/Admin created successfully, return true
}

// PHP code to handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];
    $newRole = $_POST['new_role'];

    // Create new user/admin
    $result = createUser($newUsername, $newPassword, $newRole);

    // Display success message or error message
    if ($result) {

        $_SESSION['message'] = "User Created";
    } else {
        $_SESSION['message'] = "Failed to create User/Admin. Username already exists.";
    }
   // header('Location: admin/admin_page.php');
    header('Location: admin_mockup.php');





    exit(0);
}