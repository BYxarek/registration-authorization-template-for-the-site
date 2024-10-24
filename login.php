<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST['identifier'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE (name='$identifier' OR email='$identifier') AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Start a session and store user information
        session_start();
        $_SESSION['user'] = $identifier;
        header("Location: welcome.php"); // Redirect to a welcome page
        exit();
    } else {
        echo "Incorrect username or password!";
    }
}
?>

<form method="post" action="login.php">
    Name or email: <input type="text" name="identifier" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="login">
</form>