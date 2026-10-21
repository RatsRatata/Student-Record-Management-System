<?php
$host     = getenv('DB_HOST') ?: 'gateway01.ap-northeast-1.prod.aws.tidbcloud.com'; // Your TiDB host
$port     = getenv('DB_PORT') ?: 4000;
$dbname   = getenv('DB_NAME') ?: 'test';
$username = getenv('DB_USER') ?: '2hX7b3ZSP1ZKzgC.root';
$password = getenv('DB_PASS') ?: 'KdFWjpsGuVkB94NE';

try {
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_SSL_CA       => true,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    ];

    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}