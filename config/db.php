<?php
// Database configuration - Using PostgreSQL connection from environment variables
$host = getenv("PGHOST") ?: "localhost";
$port = getenv("PGPORT") ?: "5432";
$dbname = getenv("PGDATABASE") ?: "postgres"; // Use the default database from environment variables
$username = getenv("PGUSER") ?: "postgres";
$password = getenv("PGPASSWORD") ?: "";

// Create connection using PDO for PostgreSQL
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $conn = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
