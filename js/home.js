// Infinite horizontal slider functionality
const track = document.getElementById('sliderTrack');
const container = document.querySelector('.slider-container');

if (track && container) {
    // Clone cards for continuous infinite scroll
    const originalCards = Array.from(track.children);
    originalCards.forEach(card => {
        const clone = card.cloneNode(true);
        track.appendChild(clone);
    });

    let isDown = false;
    let startX;
    let scrollLeft;
    let scrollSpeed = 0.6;
    let animationFrameId;

    // Automatic smooth scrolling
    function autoPlay() {
        if (!isDown) {
            container.scrollLeft += scrollSpeed;

            // Reset scroll when reaching halfway
            if (container.scrollLeft >= track.scrollWidth / 2) {
                container.scrollLeft = 0;
            }
        }
        animationFrameId = requestAnimationFrame(autoPlay);
    }

    autoPlay();

    // Mouse drag events
    container.addEventListener('mousedown', (e) => {
        isDown = true;
        cancelAnimationFrame(animationFrameId);
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
    });

    container.addEventListener('mouseleave', () => {
        if (isDown) {
            isDown = false;
            autoPlay();
        }
    });

    container.addEventListener('mouseup', () => {
        isDown = false;
        autoPlay();
    });

    container.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - container.offsetLeft;
        const walk = (x - startX) * 1.5;
        container.scrollLeft = scrollLeft - walk;
    });

    // Touch screen drag events
    container.addEventListener('touchstart', (e) => {
        cancelAnimationFrame(animationFrameId);
        startX = e.touches[0].pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
    });

    container.addEventListener('touchend', () => {
        autoPlay();
    });

    container.addEventListener('touchmove', (e) => {
        const x = e.touches[0].pageX - container.offsetLeft;
        const walk = (x - startX) * 1.5;
        container.scrollLeft = scrollLeft - walk;
    });
}

// Side drawer mobile navigation toggle
const mobileMenu = document.getElementById('mobile-menu');
const navLinks = document.querySelector('.nav_links');

if (mobileMenu && navLinks) {
    // Toggle menu open and close on hamburger click
    mobileMenu.addEventListener('click', () => {
        mobileMenu.classList.toggle('is-active');
        navLinks.classList.toggle('active');
    });

    // Close menu when clicking on any navigation link
    document.querySelectorAll('.nav_links a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('is-active');
            navLinks.classList.remove('active');
        });
    });
}