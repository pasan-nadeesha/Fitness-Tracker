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

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

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

function calculate_bmi($weight, $height_cm) {
    if ($weight <= 0 || $height_cm <= 0) return ['bmi' => 0.0, 'status' => 'N/A'];
    $height_m = $height_cm / 100;
    $bmi = round($weight / ($height_m * $height_m), 1);
    
    if ($bmi < 18.5) $status = "Underweight";
    elseif ($bmi >= 18.5 && $bmi < 25) $status = "Normal weight";
    elseif ($bmi >= 25 && $bmi < 30) $status = "Overweight";
    else $status = "Obese";

    return ['bmi' => $bmi, 'status' => $status];
}

// User Daily Summary Log (Latest record for Body Details)
function get_latest_fitness_log($conn, $user_id) {
    $stmt = $conn->prepare("SELECT * FROM daily_fitness_logs WHERE user_id = ? ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// User Recent Workouts
function get_recent_workouts($conn, $user_id, $limit = 4) {
    $stmt = $conn->prepare("SELECT * FROM workout_history WHERE user_id = ? ORDER BY workout_datetime DESC LIMIT ?");
    $stmt->bind_param("ii", $user_id, $limit);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Data for Calories Chart 
function get_calories_chart_history($conn, $user_id) {
    $stmt = $conn->prepare("SELECT log_date, SUM(total_calories) as total_calories FROM daily_fitness_logs WHERE user_id = ? GROUP BY log_date ORDER BY log_date ASC LIMIT 7");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $labels = [];
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $labels[] = date('M d', strtotime($row['log_date']));
        $data[] = (int)$row['total_calories'];
    }
    return ['labels' => $labels, 'data' => $data];
}

// අද දවසේ මුළු Workout Time, Calories, සහ Water Intake වල එකතුව ලබා ගැනීම
function get_today_fitness_totals($conn, $user_id) {
    $today = date('Y-m-d');
    $stmt = $conn->prepare("
        SELECT 
            COALESCE(SUM(total_workout_time), 0) as total_time,
            COALESCE(SUM(total_calories), 0) as total_cals,
            COALESCE(SUM(water_intake), 0) as total_water
        FROM daily_fitness_logs 
        WHERE user_id = ? AND log_date = ?
    ");
    $stmt->bind_param("is", $user_id, $today);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
?>