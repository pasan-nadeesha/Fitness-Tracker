<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

require_login();

$user_id = $_SESSION['user_id'];

$display_name = get_logged_in_name($conn, $user_id);

$user_initial = !empty($display_name) ? strtoupper(substr($display_name, 0, 1)) : 'U';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AURAFIT</title>
    
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <img src="images/logo1.png" alt="AuraFit Logo" class="logo_img">
            <span class="logo_text"></span> AURAFIT
        </div>
        <ul class="nav_links">
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="auth/logout.php" class="btn-logout">Logout</a></li>
        </ul>
    </nav>

<!--DASHBOARD AREA -->
<div class="dashboard-wrapper">
    
    <!--LEFT SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        
        <!--content -->
        <div class="sidebar-content">
            <div class="user-profile">
                <div class="avatar">
                    <span><?php echo htmlspecialchars($user_initial); ?></span>
                </div>
                <div>
                    <h4><?php echo htmlspecialchars($display_name); ?></h4>
                </div>
            </div>

            <div class="sidebar-section-title">
                <i class="fa-solid fa-scale-balanced"></i> Body Details
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Age</label>
                    <input type="text" class="form-control" value="28">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Weight (kg)</label>
                    <input type="text" class="form-control" value="78" id="body-weight">
                </div>
                <div class="form-group">
                    <label>Height (cm)</label>
                    <input type="text" class="form-control" value="178" id="body-height">
                </div>
            </div>

            <div class="form-group activity-group">
                <label>Select Your Activity Level</label>
                <select class="form-control">
                    <option value="sedentary">Sedentary (Little or no exercise)</option>
                    <option value="lightly_active">Lightly Active (Exercise 1–3 days/week)</option>
                    <option value="moderately_active" selected>Moderately Active (Exercise 3–5 days/week)</option>
                    <option value="very_active">Very Active (Exercise 6–7 days/week)</option>
                    <option value="extra_active">Extra Active (Athlete or physical job)</option>
                </select>
            </div>

            <div class="hr-line"></div>
            <div class="hr-line"></div>
            
            <div class="sidebar-section-title">
                <i class="fa-solid fa-droplet"></i> Hydration Today
            </div>

            <div class="workout-input-row">
                <div class="w-icon-small bg-blue"><i class="fa-solid fa-glass-water"></i></div>
                <div class="w-input-group">
                    <label>Water Intake</label>
                    <div class="input-with-unit">
                        <input type="text" class="form-control" value="1.8" id="water-input">
                        <span>L</span>
                    </div>
                </div>
            </div>

            <div class="sidebar-section-title">
                <i class="fa-regular fa-clock"></i> Today's Workout Time
            </div>
            
            <div class="workout-input-row">
                <div class="w-icon-small bg-purple"><i class="fa-solid fa-shoe-prints"></i></div>
                <div class="w-input-group">
                    <label>Running</label>
                    <div class="input-with-unit">
                        <input type="text" class="form-control" value="0" id="run-input">
                        <span>min</span>
                    </div>
                </div>
            </div>

            <div class="workout-input-row">
                <div class="w-icon-small bg-green"><i class="fa-solid fa-person-biking"></i></div>
                <div class="w-input-group">
                    <label>Cycling</label>
                    <div class="input-with-unit">
                        <input type="text" class="form-control" value="0" id="cycle-input">
                        <span>min</span>
                    </div>
                </div>
            </div>

            <div class="workout-input-row">
                <div class="w-icon-small bg-orange"><i class="fa-solid fa-dumbbell"></i></div>
                <div class="w-input-group">
                    <label>Weight Training</label>
                    <div class="input-with-unit">
                        <input type="text" class="form-control" value="0" id="weight-input">
                        <span>min</span>
                    </div>
                </div>
            </div>

            <div class="workout-input-row">
                <div class="w-icon-small bg-blue"><i class="fa-solid fa-water"></i></div>
                <div class="w-input-group">
                    <label>Swimming</label>
                    <div class="input-with-unit">
                        <input type="text" class="form-control" value="0" id="swim-input">
                        <span>min</span>
                    </div>
                </div>
            </div>

            <button class="btn-calculate" id="calc-btn">
                <i class="fa-solid fa-calculator"></i> Calculate
            </button>
        </div>
    </aside>

    <!-- RIGHT CONTENT-->
    <main class="main-content">
        <section class="hero">
            <h1>Monitor your fitness health journey</h1>
            <p>Track and analyze your performance in real time</p>
        </section>

        <!-- Stat Cards grid -->
        <section class="stats-grid">
            <div class="stat-card stat-steps">
                <i class="fa-solid fa-stopwatch"></i>
                <span class="stat-title">Workout Time</span>
                <span class="stat-value" id="workout-display">1h 45m</span>
                <span class="stat-sub">+15 min since yesterday</span>
            </div>
            <div class="stat-card stat-workouts">
                <i class="fa-solid fa-weight-scale"></i>
                <span class="stat-title">BMI</span>
                <span class="stat-value" id="bmi-display">24.6</span>
                <span class="stat-sub" id="bmi-status">Normal weight</span>
            </div>
            <div class="stat-card stat-calories">
                <i class="fa-solid fa-fire"></i>
                <span class="stat-title">Calories</span>
                <span class="stat-value" id="calories-display">2,847</span>
                <span class="stat-sub">+312 since yesterday</span>
            </div>
            <div class="stat-card stat-hydration">
                <i class="fa-solid fa-droplet"></i>
                <span class="stat-title">Hydration</span>
                <span class="stat-value" id="hydration-display">1.8L</span>
                <span class="stat-sub">Goal: 2.5L today</span>
            </div>
        </section>

        <!-- Total calories chart -->
        <section class="card-panel">
            <div class="section-header">
                <h3>Total calories</h3>
                <div class="chart-legend">
                    <span class="legend-burned"><i class="fa-solid fa-minus"></i> Burned</span>
                    <span class="legend-intake"><i class="fa-solid fa-minus"></i> Intake</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="caloriesChart"></canvas>
            </div>
        </section>

        <!-- Rings & Recent Workouts -->
        <section class="bottom-grid">
            
            <!-- Daily Rings-->
            <div class="card-panel">
                <div class="section-header">
                    <h3 class="rings-title">Daily Rings</h3>
                </div>
                <div class="rings-container">
                    <canvas id="ringsChart"></canvas>
                    <div class="rings-center-text" id="ring-center">0%</div>
                </div>
                
                <div class="progress-bar-group">
                    <div class="progress-label">
                        <span>Move</span> <span class="pct txt-purple" id="move-pct-text">0%</span>
                    </div>
                    <div class="progress-track"><div class="progress-fill bg-purple-fill" id="move-bar"></div></div>
                    <div class="progress-subtext" id="move-subtext">0 / 2,500 kcal</div>
                </div>

                <div class="progress-bar-group">
                    <div class="progress-label">
                        <span>Exercise</span> <span class="pct txt-green" id="exercise-pct-text">0%</span>
                    </div>
                    <div class="progress-track"><div class="progress-fill bg-green-fill" id="exercise-bar"></div></div>
                    <div class="progress-subtext" id="exercise-subtext">0 / 60 min</div>
                </div>

                <div class="progress-bar-group">
                    <div class="progress-label">
                        <span>Hydration</span> <span class="pct txt-blue" id="water-pct-text">0%</span>
                    </div>
                    <div class="progress-track"><div class="progress-fill bg-blue-fill" id="water-bar"></div></div>
                    <div class="progress-subtext" id="water-subtext">0 / 2.5 L</div>
                </div>
            </div>

            <!-- Recent Workouts -->
            <div class="card-panel">
                <div class="section-header">
                    <h3 class="section-subtitle">Recent Workouts</h3>
                    <a href="#" class="view-all-link">View all ></a>
                </div>
                
                <div class="workout-list">
                    <div class="workout-item">
                        <div class="wo-icon bg-purple"><i class="fa-solid fa-shoe-prints"></i></div>
                        <div class="wo-info">
                            <div class="wo-title-row">
                                <span class="wo-title">Running</span>
                                <span class="wo-tag tag-high">High</span>
                            </div>
                            <div class="wo-time">Today, 6:15 AM</div>
                        </div>
                        <div class="wo-stats">
                            <div class="wo-stat-box"><p>42 min</p><p>Duration</p></div>
                            <div class="wo-stat-box"><p>487</p><p>kcal</p></div>
                        </div>
                        <i class="fa-solid fa-chevron-right chevron-icon"></i>
                    </div>

                    <div class="workout-item">
                        <div class="wo-icon bg-green"><i class="fa-solid fa-person-biking"></i></div>
                        <div class="wo-info">
                            <div class="wo-title-row">
                                <span class="wo-title">Cycling</span>
                                <span class="wo-tag tag-mod">Moderate</span>
                            </div>
                            <div class="wo-time">Yesterday, 5:30 PM</div>
                        </div>
                        <div class="wo-stats">
                            <div class="wo-stat-box"><p>61 min</p><p>Duration</p></div>
                            <div class="wo-stat-box"><p>634</p><p>kcal</p></div>
                        </div>
                        <i class="fa-solid fa-chevron-right chevron-icon"></i>
                    </div>

                    <div class="workout-item">
                        <div class="wo-icon bg-orange"><i class="fa-solid fa-dumbbell"></i></div>
                        <div class="wo-info">
                            <div class="wo-title-row">
                                <span class="wo-title">Weight Training</span>
                                <span class="wo-tag tag-high">High</span>
                            </div>
                            <div class="wo-time">Jul 29, 7:00 AM</div>
                        </div>
                        <div class="wo-stats">
                            <div class="wo-stat-box"><p>55 min</p><p>Duration</p></div>
                            <div class="wo-stat-box"><p>312</p><p>kcal</p></div>
                        </div>
                        <i class="fa-solid fa-chevron-right chevron-icon"></i>
                    </div>

                    <div class="workout-item">
                        <div class="wo-icon bg-blue"><i class="fa-solid fa-water"></i></div>
                        <div class="wo-info">
                            <div class="wo-title-row">
                                <span class="wo-title">Swimming</span>
                                <span class="wo-tag tag-mod">Moderate</span>
                            </div>
                            <div class="wo-time">Jul 28, 8:00 AM</div>
                        </div>
                        <div class="wo-stats">
                            <div class="wo-stat-box"><p>35 min</p><p>Duration</p></div>
                            <div class="wo-stat-box"><p>276</p><p>kcal</p></div>
                        </div>
                        <i class="fa-solid fa-chevron-right chevron-icon"></i>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Footer Section -->
<footer class="footer">
    <div class="footer_container">
        <div class="footer_left">
            <div class="info_item">
                <div class="icon_box"><i class="fa-solid fa-location-dot"></i></div>
                <p><span>Rajarata University</span> <strong>Mihintale, Sri Lanka</strong></p>
            </div>
            <div class="info_item">
                <div class="icon_box"><i class="fa-solid fa-phone"></i></div>
                <p><strong>+94 76 207 7199</strong></p>
            </div>
            <div class="info_item">
                <div class="icon_box"><i class="fa-solid fa-envelope"></i></div>
                <p><a href="mailto:aurafit@gmail.com">aurafit@gmail.com</a></p>
            </div>
        </div>

        <div class="footer_right">
            <h3>About the Website</h3>
            <p class="about_text">
                This website was developed as part of the ICT-1209 | Web Technologies course project. It showcases our learning, practical skills, and application of modern web design, frontend technologies, backend technologies, and web application development principles.
            </p>
            <div class="social_icons">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#"><i class="fa-brands fa-github"></i></a>
            </div>
        </div>
    </div>
</footer>

<script src="js/dashboard.js"></script>
</body>
</html>