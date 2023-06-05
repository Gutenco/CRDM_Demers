<?php

$servername = "o4kodev.mysql.database.azure.com";
$username_db = "NikMine";
$password = "Misa21122017";
$dbname = "work_demers";
$port = 3306;
$sslCertPath = "DigiCertGlobalRootCA.crt.pem";

// Create database connection
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, $sslCertPath, NULL, NULL);
mysqli_real_connect($conn, $servername, $username_db, $password, $dbname, $port, MYSQLI_CLIENT_SSL);

// Проверка соединения
if (mysqli_connect_errno()) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Check database connection
if (!$conn) {
    die('Failed to connect to database: ' . mysqli_connect_error());
}

