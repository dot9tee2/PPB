// main.js

document.addEventListener('DOMContentLoaded', () => {
    // Initialize smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Initialize animations on scroll
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.animate-on-scroll');
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;
            const isVisible = (elementTop < window.innerHeight) && (elementBottom >= 0);
            
            if (isVisible) {
                element.classList.add('animated');
            }
        });
    };

    // Run animation check on load and scroll
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll();

    // Handle mobile menu
    const menuBtn = document.querySelector('.menu-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            menuBtn.classList.toggle('active');
        });
    }

    // Initialize form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                Array.from(form.elements).forEach(input => {
                    if (!input.checkValidity()) {
                        input.classList.add('invalid');
                    }
                });
            }
        });

        // Remove invalid class on input
        form.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', function() {
                if (this.checkValidity()) {
                    this.classList.remove('invalid');
                }
            });
        });
    });

    // Initialize lazy loading for images
    if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            // Only set src if it's not already set
            if (img.dataset.src && !img.src) {
                img.src = img.dataset.src;
            }
            
            // Add error handling
            img.onerror = function() {
                console.error('Failed to load image:', img.src);
                if (!img.src.includes('placeholder.jpg')) {
                    img.src = 'media/placeholder.jpg';
                }
            };
        });
    } else {
        // Fallback for browsers that don't support lazy loading
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
        document.body.appendChild(script);
    }
});

// Counter animation for About Us section
function animateCounter() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    statNumbers.forEach(number => {
        const target = parseInt(number.getAttribute('data-count'));
        const duration = 2000; // 2 seconds
        const step = target / duration * 20; // Update every 20ms
        let current = 0;
        
        const counterAnimation = setInterval(() => {
            current += step;
            
            if (current >= target) {
                number.textContent = target;
                clearInterval(counterAnimation);
            } else {
                number.textContent = Math.floor(current);
            }
        }, 20);
    });
}

// Check if element is in viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.bottom >= 0
    );
}

// Trigger counter animation when About Us section is visible
function handleScrollAnimation() {
    const aboutSection = document.querySelector('.about-stats');
    
    if (aboutSection && isInViewport(aboutSection)) {
        animateCounter();
        // Remove event listener once animation is triggered
        window.removeEventListener('scroll', handleScrollAnimation);
    }
}

// Add scroll event listener
window.addEventListener('scroll', handleScrollAnimation);

// Check on initial load in case section is already visible
document.addEventListener('DOMContentLoaded', function() {
    handleScrollAnimation();
});
