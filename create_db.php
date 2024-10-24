<?php
// Database connection details
$servername = "MySQL-8.0";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if database already exists
$db_check_query = "SHOW DATABASES LIKE 'mydatabase'";
$db_check_result = $conn->query($db_check_query);

if ($db_check_result->num_rows > 0) {
    echo "A database with this name already exists!<br>";
} else {
    // Create database
    $sql = "CREATE DATABASE mydatabase";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully!<br>";
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
    }
}

// Select the database
$conn->select_db('mydatabase');

// Create table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();
?>