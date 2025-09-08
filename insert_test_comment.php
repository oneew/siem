<?php
// Simple script to insert a test comment directly into the database

// Database configuration from .env
$host = 'localhost';
$dbname = 'siem';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO comments (incident_id, user_id, comment, created_at) VALUES (1, 1, 'This is a test comment inserted directly', NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    echo "Test comment inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}