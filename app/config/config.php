<?php
$host = getenv('ep-mute-river-a5u5swcf-pooler.us-east-2.aws.neon.tech');
$port = getenv('5432');
$dbname = getenv('db_inventory');
$username = getenv('andre_owner');
$password = getenv('npg_8oqNJRxbuni9');

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    die("Connection failed: " . $e->getMessage());
}
?>