const track = document.getElementById('sliderTrack');
const container = document.querySelector('.slider-container');

let isDown = false;
let startX;
let scrollLeft;
let scrollSpeed = 0.5;
let animationFrameId;


function autoPlay() {
  
  container.scrollLeft += scrollSpeed;
  

  if (container.scrollLeft >= (track.scrollWidth - container.clientWidth)) {
    container.scrollLeft = 0;
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