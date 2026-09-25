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