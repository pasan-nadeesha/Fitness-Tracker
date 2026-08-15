<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

require_login();

$user_id = $_SESSION['user_id'];

$display_name = get_logged_in_name($conn, $user_id);
$user_initial = !empty($display_name) ? strtoupper(substr($display_name, 0, 1)) : 'U';

include 'html/dashboard.html';
?>