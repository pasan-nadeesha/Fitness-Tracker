<?php
session_start();
// erase all session
session_unset();
session_destroy();

// move to login
header("Location: ../html/login.html#toggle-login");
exit();
?>