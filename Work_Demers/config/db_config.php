<?php

// Create database connection
$conn = mysqli_connect("localhost", "root", "", "demers_db");

// Check database connection
if (!$conn) {
    die('Failed to connect to database: ' . mysqli_connect_error());
}

