// main.js

import { showPreloader, hidePreloader } from "./preloader.js";
import { initSlider } from "./slider.js";
import { initSidebar } from "./sidebar.js";
import { initCarousel } from "./carousel.js";

document.addEventListener("DOMContentLoaded", () => {
  initSlider();
  initSidebar();
  initCarousel();

  // ✅ Now calling hidePreloader() properly
  window.addEventListener("load", hidePreloader);
});

// Apply preloader when navigating between pages
document.querySelectorAll("a").forEach((link) => {
  link.addEventListener("click", function (e) {
    const href = this.getAttribute("href");

    if (href && href !== "#" && !this.classList.contains("no-preloader")) {
      e.preventDefault();
      showPreloader();

      setTimeout(() => {
        window.location.href = href;
      }, 700);
    }
  });
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
