document.addEventListener('DOMContentLoaded', function() {
    console.log('Página cargada');


    // Animación para la descripción del héroe
    const heroDescription = document.querySelector('.hero-description');
    heroDescription.classList.add('animate-in');
});
   
// Animación del carousel
let currentIndex = 0;

function moveCarousel(step) {
    const items = document.querySelectorAll('.carousel-item');
    const totalItems = items.length;
    
    items[currentIndex].classList.remove('active');
    currentIndex = (currentIndex + step + totalItems) % totalItems;
    items[currentIndex].classList.add('active');

    const carouselInner = document.querySelector('.carousel-inner');
    const offset = -currentIndex * 100;
    carouselInner.style.transform = `translateX(${offset}%)`;

    dots: true;
    infinite: true;
    speed: 500;
    autoplay: true;
}

