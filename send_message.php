<?php
// Return response as JSON
header('Content-Type: application/json; charset=utf-8');

// Database config
$host = 'localhost';
$db   = 'aurafit_db';
$user = 'root';
$pass = '';

try {
    // DB connect
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Get form inputs
        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        // Validate empty fields
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields.']);
            exit;
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
            exit;
        }

        // Insert into database
        $sql = "INSERT INTO contacts (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name'    => $name,
            ':email'   => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);

        // Success response
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
    }
} catch (PDOException $e) {
    // Error response
    echo json_encode(['status' => 'error', 'message' => 'DB Error: ' . $e->getMessage()]);
}
?>