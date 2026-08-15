<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: auth/login.php");
        exit();
    }
}

//Get Login user Full name
function get_logged_in_name($conn, $user_id) {
    $stmt = $conn->prepare("SELECT first_name, last_name, username FROM users WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $full_name = trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''));
        return !empty($full_name) ? $full_name : ($user['username'] ?? 'User');
    }
    return 'User';
}
?>