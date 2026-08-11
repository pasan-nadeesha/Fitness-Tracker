const track = document.getElementById('sliderTrack');
const container = document.querySelector('.slider-container');

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

function autoPlay() {
  if (!isDown) {
    container.scrollLeft += scrollSpeed;

    if (container.scrollLeft >= track.scrollWidth / 2) {
      container.scrollLeft = 0;
    }
  }
  
  animationFrameId = requestAnimationFrame(autoPlay);
}

autoPlay();


container.addEventListener('mousedown', (e) => {
  isDown = true;
  cancelAnimationFrame(animationFrameId);
  startX = e.pageX - container.offsetLeft;
  scrollLeft = container.scrollLeft;
});

container.addEventListener('mouseleave', () => {
  if(isDown) {
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

const mobileMenu = document.getElementById('mobile-menu');
const navLinks = document.querySelector('.nav_links');

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