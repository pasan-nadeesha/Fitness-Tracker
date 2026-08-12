<?php

session_start();

require '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect data from the login form
    $email = $_POST['email'];
    $input_password = $_POST['password'];

    // check email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // check password
        if (password_verify($input_password, $user['password'])) {
            
            // save user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            header("Location: ../html/dashboard.html");
            exit();
        } else {
            // if password is incorrect
            echo "<script>alert('Incorrect password! Please try again.'); window.location.href='../html/login.html#toggle-login';</script>";
        }
    } else {
        // if email is not found
        echo "<script>alert('Email not found! Please register first.'); window.location.href='../html/login.html';</script>";
    }
}

$conn->close();
?>