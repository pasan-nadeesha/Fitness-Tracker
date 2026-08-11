<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AuraFit - Register & Log In</title>
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>

    <div class="page-container">
        <header class="logo-container">
            <img src="images/logo1.png" alt="AuraFit brand logo" class="logo-img">
            <span class="logo-text">AURAFIT</span>
        </header>

        <input type="radio" id="toggle-register" name="form-toggle" checked class="radio-toggle">
        <input type="radio" id="toggle-login" name="form-toggle" class="radio-toggle">

        <main class="form-card">
            <div class="tab-navigation">
                <label for="toggle-register" class="tab-btn label-register">Register</label>
                <label for="toggle-login" class="tab-btn label-login">Log in</label>
            </div>

            <!-- REGISTER FORM -->
            <form class="form-content form-register" action="auth/register.php" method="POST">
                <div class="form-row-inline">
                    <div class="form-group">
                        <input type="text" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="submit-btn">Register</button>
            </form>

            <!-- LOG IN FORM -->
            <form class="form-content form-login" action="auth/login.php" method="POST">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="submit-btn">Log in</button>
            </form>
        </main>

        <footer class="footer-text">
            &copy; 2026 AuraFit. All rights reserved.
        </footer>
    </div>

</body>
</html>