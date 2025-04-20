<?php

if (file_exists('/home/edudemohon/db.php')) {
    include '/home/edudemohon/db.php';
} else {
    $host = getenv("MYSQL_HOST") ?: "localhost";
    $port = getenv("MYSQL_PORT") ?: "3306";
    $dbname = getenv("MYSQL_DATABASE") ?: "college_finder";
    $username = getenv("MYSQL_USER") ?: "root";
    $password = getenv("MYSQL_PASSWORD") ?: "";
}

// Create connection using PDO for MySQL
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
