import Alpine from 'alpinejs';
import AOS from 'aos';
import GLightbox from 'glightbox';

// Alpine.js
window.Alpine = Alpine;
Alpine.start();

// AOS - Animate On Scroll
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    offset: 50,
});

// GLightbox
GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
    width: '85vw',
    height: '80vh',
    closeOnOutsideClick: true,
    openEffect: 'fade',
    closeEffect: 'fade',
    cssEf498: 'fade',
    skin: 'clean',
    svg: {
        close: '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
        next: '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>',
        prev: '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>',
    },
});

// Navbar scroll behavior
document.addEventListener('DOMContentLoaded', () => {
    // Disable right-click on gallery images
    document.querySelectorAll('.glightbox img, [data-gallery] img').forEach(img => {
        img.addEventListener('contextmenu', (e) => e.preventDefault());
        img.setAttribute('draggable', 'false');
    });

    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-primary-dark/95', 'backdrop-blur-md', 'shadow-lg');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.remove('bg-primary-dark/95', 'backdrop-blur-md', 'shadow-lg');
                navbar.classList.add('bg-transparent');
            }
        });
    }

    // Counter animation
    const counters = document.querySelectorAll('[data-counter]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.counter);
                let current = 0;
                const increment = target / 60;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        el.textContent = target + '+';
                        clearInterval(timer);
                    } else {
                        el.textContent = Math.floor(current) + '+';
                    }
                }, 30);
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));
});
