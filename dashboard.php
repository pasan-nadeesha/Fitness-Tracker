<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

require_login();
$user_id = $_SESSION['user_id'];

// Data save to database when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_fitness'])) {
    $age = (int)$_POST['age'];
    $gender = sanitize_input($_POST['gender']);
    $weight = (float)$_POST['weight'];
    $height = (float)$_POST['height'];
    $activity_level = sanitize_input($_POST['activity_level']);
    $water_intake = (float)$_POST['water_intake'];
    
    $running = (int)$_POST['running_time'];
    $cycling = (int)$_POST['cycling_time'];
    $weight_train = (int)$_POST['weight_training'];
    $swimming = (int)$_POST['swimming_time'];

    $total_workout_time = $running + $cycling + $weight_train + $swimming;
    
    $run_cals = $running * 10;
    $cycle_cals = $cycling * 8;
    $weight_cals = $weight_train * 6;
    $swim_cals = $swimming * 9;
    $workout_burn = $run_cals + $cycle_cals + $weight_cals + $swim_cals;
    $total_calories = 2000 + $workout_burn;

    $bmi_data = calculate_bmi($weight, $height);
    $bmi = $bmi_data['bmi'];
    $bmi_status = $bmi_data['status'];
    $today = date('Y-m-d');
    $now = date('Y-m-d H:i:s');

    // Save Daily Summary
    $stmt = $conn->prepare("INSERT INTO daily_fitness_logs (user_id, age, gender, weight, height, activity_level, water_intake, total_workout_time, total_calories, bmi, bmi_status, log_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisddsdiidss", $user_id, $age, $gender, $weight, $height, $activity_level, $water_intake, $total_workout_time, $total_calories, $bmi, $bmi_status, $today);
    $stmt->execute();
    $stmt->close();

    // Save Workouts History
    $workout_entries = [
        ['Running', $running, $run_cals, 'High'],
        ['Cycling', $cycling, $cycle_cals, 'Moderate'],
        ['Weight Training', $weight_train, $weight_cals, 'High'],
        ['Swimming', $swimming, $swim_cals, 'Moderate']
    ];

    $hist_stmt = $conn->prepare("INSERT INTO workout_history (user_id, workout_type, duration_min, calories_burned, intensity, workout_datetime) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($workout_entries as $entry) {
        if ($entry[1] > 0) {
            $hist_stmt->bind_param("isiiss", $user_id, $entry[0], $entry[1], $entry[2], $entry[3], $now);
            $hist_stmt->execute();
        }
    }
    $hist_stmt->close();

    header("Location: dashboard.php");
    exit();
}

// 2. Fetch User & History Data
$display_name = get_logged_in_name($conn, $user_id);
$user_initial = !empty($display_name) ? strtoupper(substr($display_name, 0, 1)) : 'U';

$latest_log = get_latest_fitness_log($conn, $user_id);
$recent_workouts = get_recent_workouts($conn, $user_id, 4);
$chart_history = get_calories_chart_history($conn, $user_id);

// 3. Daily Rings & Card Calculations (New User Check)
$has_log = !empty($latest_log);

$cal = $has_log ? (int)$latest_log['total_calories'] : 0;
$mins = $has_log ? (int)$latest_log['total_workout_time'] : 0;
$water = $has_log ? (float)$latest_log['water_intake'] : 0.0;

$pct_move = $has_log ? min(round(($cal / 2500) * 100), 100) : 0;
$pct_exercise = $has_log ? min(round(($mins / 60) * 100), 100) : 0;
$pct_water = $has_log ? min(round(($water / 2.5) * 100), 100) : 0;
$avg_ring_pct = $has_log ? round(($pct_move + $pct_exercise + $pct_water) / 3) : 0;

include 'html/dashboard.html';
?>