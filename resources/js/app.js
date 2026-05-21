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
});

// Navbar scroll behavior
document.addEventListener('DOMContentLoaded', () => {
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
