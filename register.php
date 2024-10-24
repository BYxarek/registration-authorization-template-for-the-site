<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);

    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($result) > 0) {
        echo "A user with this email address is already registered!";
    } else {
        if ($password == $confirm_password) {
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            if (mysqli_query($conn, $sql)) {
                // Start a session and store user information
                session_start();
                $_SESSION['user'] = $name;
                header("Location: welcome.php"); // Redirect to a welcome page
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Passwords do not match!";
        }
    }
}
?>

<form method="post" action="register.php">
    Name: <input type="text" name="name" required><br>
    Gmail: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Confirm password: <input type="password" name="confirm_password" required><br>
    <input type="submit" value="Register">
</form>