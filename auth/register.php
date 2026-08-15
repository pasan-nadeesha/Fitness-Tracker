<?php

require '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect data from the registration form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    
    // hashing the password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // enter the data into the database
    $sql = "INSERT INTO users (first_name, last_name, email, username, password) 
            VALUES ('$first_name', '$last_name', '$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        
        echo "<script>alert('Registration Successful! Please Log in.'); window.location.href='../html/login.html?action=login';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>