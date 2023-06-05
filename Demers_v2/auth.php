<?php
require_once 'config/db_config.php';
session_start();


function authenticateUser($username, $password)
{
    global $conn;

    // Retrieve user data from database based on username
    $query = "SELECT * FROM account WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Error executing query: ' . mysqli_error($conn)); // Handle query execution error
    }

    if (mysqli_num_rows($result) === 0) {
        return false; // User not found, return false
    }

    // Fetch user data
    $row = mysqli_fetch_assoc($result);
    $storedPassword = $row['password'];

    // Verify password
    if (password_verify($password, $storedPassword)) {
        // Password is correct, set session variables
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        return true; // Authentication successful, return true
    }

    return false; // Password is incorrect, return false

}


// Function to check if user is logged in
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

// Function to check if user has admin role
function isAdmin(): bool
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate user
    if (authenticateUser($username, $password)) {
        // Redirect to appropriate page based on role
        if (isAdmin()) {
            $_SESSION['message'] = "You are ADMIN";
            header("Location: admin_mockup.php");
        } else {
            $_SESSION['message'] = "You are USER";
            header('Location: index_demers.php');
        }

    } else {
        $_SESSION['message'] = "Invalid Name or Password";
        header("Location: login.php");
    }
    exit(0);
}

