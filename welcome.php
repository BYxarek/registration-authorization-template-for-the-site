<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: php/login.php");
    exit();
}
echo "Authorization/Registration successful! Welcome, " . $_SESSION['user'];
?>