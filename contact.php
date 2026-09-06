<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="css/contact.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <nav class="navbar">
            <div class="logo">
                <img src="images/logo1.png" alt="AuraFit Logo" class="logo_img">
                <span class="logo_text"></span> AURAFIT
            </div>

            <div class="menu_toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <ul class="nav_links">
                <li><a href="index.php">Home</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>

        <!-- Vision -->
        <div class="vision_container">
            <div class="vision_title">
                <h2>Our Vision<br></h2>
            </div>
            <div class="vision_content">
                <p>"To empower individuals worldwide to live healthier, happier lives by making holistic fitness and
                lifestyle tracking simple and accessible to all."</p>
            </div>
        </div>

        <!-- Mission -->
        <div class="mission_container">
            <div class="mission_title">
                <h2>Our Mission</h2>
            </div>
            <div class="mission_content">
                <p>"At AuraFit, our mission is to deliver an integrated fitness tracking solution that harmonizes workouts,
                    nutrition, and wellness habits, guiding users toward their personal best every single day."</p>
            </div>
        </div>

        <!-- University Details -->
        <div class="university_banner">
            <!-- Left Logo -->
            <div class="logo_wrapper">
                <img src="images/rajarata_uni_logo.png" alt="Rajarata University Logo" class="uni_logo">
            </div>

            <!-- Middle Text Content -->
            <div class="banner_text">
                <h1 class="uni_title">RAJARATA UNIVERSITY OF SRI LANKA</h1>
                <p class="faculty_info">Faculty of Technology | Department of ICT</p>
                <p class="project_title">Undergraduate Students Project</p>
            </div>
        </div>

        <!-- Group Members Section -->
        <h1 class="team_member_title">Team Members</h1>

        <div class="cards_wrapper">
            <!-- 1st card -->
            <div class="member_card">
                <div class="profile_image_container">
                    <img src="images/Pasan.png" alt="Pasan Profile" class="profile_image">
                </div>
                <div class="member_info">
                    <h2 class="member_name">Pasan Nadeesha</h2>
                    <ul class="member_description">
                        <li>Department: ICT</li>
                        <li>Passionate ICT student enthusiastic about Networking, Web Technologies, and UI/UX Design.</li>
                    </ul>
                </div>
                <div class="social_links">
                    <a href="mailto:itt2024005@tec.rjt.ac.lk" target="_blank" class="social_icon email"><i class="bi bi-envelope-fill"></i></a>
                    <a href="https://www.linkedin.com/in/pasan-nadeesha/" target="_blank" class="social_icon linkedin"><i class="bi bi-linkedin"></i></a>
                    <a href="https://github.com/pasan-nadeesha" target="_blank" class="social_icon github"><i class="bi bi-github"></i></a>
                </div>
            </div>

            <!-- 2nd card -->
            <div class="member_card">
                <div class="profile_image_container">
                    <img src="images/kavishka.jpg" alt="Kavishka Profile" class="profile_image">
                </div>
                <div class="member_info">
                    <h2 class="member_name">Kavishka Dhananjaya</h2>
                    <ul class="member_description">
                        <li>Department: ICT</li>
                        <li>Dedicated ICT student focused on Developing secure backend systems, Database administration, and practical secure tech solutions.</li>
                    </ul>
                </div>
                <div class="social_links">
                    <a href="mailto:itt2024004@tec.rjt.ac.lk" target="_blank" class="social_icon email"><i class="bi bi-envelope-fill"></i></a>
                    <a href="https://www.linkedin.com/in/kavishka-d-abeythunga-0872b1377/" target="_blank" class="social_icon linkedin"><i class="bi bi-linkedin"></i></a>
                    <a href="https://github.com/KavishkaDhananjaya" target="_blank" class="social_icon github"><i class="bi bi-github"></i></a>
                </div>
            </div>
        </div>

        <!-- Contact submission form -->
        <h1 class="team_member_title">Contact Us</h1>

        <div class="contact_container">
            <form id="contactForm" action="contact.php" method="POST" class="contact_form">
                <div class="form_group">
                    <label>Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form_group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form_group">
                    <label>Subject</label>
                    <input type="text" name="subject" required>
                </div>
                <div class="form_group">
                    <label>Message</label>
                    <textarea name="message" rows="5" required></textarea>
                </div>
                <button type="submit" id="submitBtn" name="submit_msg">Send Message</button>
                <div id="formResponse" style="margin-top: 15px; font-weight: bold; text-align: center;"></div>
            </form>
        </div>


        <!-- Footer Section -->
        <footer class="footer">
            <div class="footer_container">
                <!-- Left Section -->
                <div class="footer_left">
                    <div class="info_item">
                        <div class="icon_box">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <p>
                            <span>Rajarata University</span>
                            <strong>Mihintale, Sri Lanka</strong>
                        </p>
                    </div>

                    <div class="info_item">
                        <div class="icon_box">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <p><strong>+94 76 217 7109</strong></p>
                    </div>

                    <div class="info_item">
                        <div class="icon_box">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <p><a href="mailto:aurafit@gmail.com">aurafit@gmail.com</a></p>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="footer_right">
                    <h3>About the Website</h3>
                    <p class="about_text">
                        This website was developed as part of the ICT-1209 | Web Technologies
                        course project. It showcases our learning, practical skills, and application of modern web design, frontend technologies, backend technologies, and web application development principles.
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

        <script src="js/about.js"></script>

        <!-- Vanilla JS to handle form submit -->
        <script>
            // Get elements
            const form    = document.getElementById('contactForm');
            const msgBox  = document.getElementById('formResponse');
            const sendBtn = document.getElementById('submitBtn');

            // Form submit event
            form.addEventListener('submit', async function (e) {
                e.preventDefault(); // Stop page reload

                // Update button state
                sendBtn.disabled = true;
                sendBtn.textContent = 'Sending...';
                msgBox.textContent = '';

                // Get form inputs
                const data = new FormData(form);

                try {
                    // Send data to PHP
                    const res = await fetch('send_message.php', {
                        method: 'POST',
                        body: data
                    });

                    const result = await res.json();

                    // Show response
                    if (result.status === 'success') {
                        msgBox.style.color = '#28a745';
                        msgBox.textContent = result.message;
                        form.reset(); // Clear form
                    } else {
                        msgBox.style.color = '#dc3545';
                        msgBox.textContent = result.message;
                    }
                } catch (err) {
                    // Show error
                    msgBox.style.color = '#dc3545';
                    msgBox.textContent = 'Failed to send message.';
                } finally {
                    // Reset button
                    sendBtn.disabled = false;
                    sendBtn.textContent = 'Send Message';
                }
            });
        </script>
    </body>
</html>