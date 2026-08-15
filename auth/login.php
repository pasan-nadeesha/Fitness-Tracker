<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $input_password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, first_name, last_name, username, password FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($input_password, $user['password']) || $input_password === $user['password']) {
            
            // Data save
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            $fullName = trim($user['first_name'] . ' ' . $user['last_name']);
            $_SESSION['full_name'] = !empty($fullName) ? $fullName : $user['username'];
            
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password! Please try again.'); window.location.href='login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Email not found! Please register first.'); window.location.href='login.php';</script>";
        exit();
    }
    $stmt->close();
}
$conn->close();
?>