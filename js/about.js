document.addEventListener('DOMContentLoaded', () => {

    // 1. Mobile Navigation Menu Toggle
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.querySelector('.nav_links');

    if (mobileMenu && navLinks) {
        mobileMenu.addEventListener('click', () => {
            mobileMenu.classList.toggle('is-active');
            navLinks.classList.toggle('active');
        });

        document.querySelectorAll('.nav_links a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('is-active');
                navLinks.classList.remove('active');
            });
        });
    }

    // 2. Scroll Reveal Animations
    const animateElements = document.querySelectorAll(
        '.vision_container, .mission_container, .university_banner, .member_card'
    );

    const revealOnScroll = () => {
        const triggerBottom = window.innerHeight * 0.85;

        animateElements.forEach(el => {
            const elementTop = el.getBoundingClientRect().top;

            if (elementTop < triggerBottom) {
                el.classList.add('revealed');
            }
        });
    };

    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll();

    // 3. Contact Form Submission
    const form = document.getElementById('contactForm');
    const msgBox = document.getElementById('formResponse');
    const sendBtn = document.getElementById('submitBtn');

    if (form && msgBox && sendBtn) {
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
    }
});