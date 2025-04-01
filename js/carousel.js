class Carousel {
    constructor(element) {
        this.carousel = element;
        this.slides = this.carousel.querySelectorAll('.carousel-slide');
        this.totalSlides = this.slides.length;
        this.currentSlide = 0;
        this.autoPlayInterval = null;
        this.init();
    }

    init() {
        // Create navigation buttons
        this.createNavigation();
        
        // Show first slide
        this.showSlide(0);
        
        // Start autoplay
        this.startAutoPlay();

        // Add touch support
        this.addTouchSupport();
    }

    createNavigation() {
        // Create prev/next buttons
        const prevBtn = document.createElement('button');
        prevBtn.className = 'carousel-btn prev';
        prevBtn.innerHTML = '❮';
        prevBtn.setAttribute('aria-label', 'Previous slide');

        const nextBtn = document.createElement('button');
        nextBtn.className = 'carousel-btn next';
        nextBtn.innerHTML = '❯';
        nextBtn.setAttribute('aria-label', 'Next slide');

        // Create dots container
        const dotsContainer = document.createElement('div');
        dotsContainer.className = 'carousel-dots';

        // Create dots
        for (let i = 0; i < this.totalSlides; i++) {
            const dot = document.createElement('button');
            dot.className = 'carousel-dot';
            dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
            dot.addEventListener('click', () => this.showSlide(i));
            dotsContainer.appendChild(dot);
        }

        // Add event listeners
        prevBtn.addEventListener('click', () => this.prevSlide());
        nextBtn.addEventListener('click', () => this.nextSlide());

        // Append navigation to carousel
        this.carousel.appendChild(prevBtn);
        this.carousel.appendChild(nextBtn);
        this.carousel.appendChild(dotsContainer);

        // Store dots for later use
        this.dots = dotsContainer.querySelectorAll('.carousel-dot');
    }

    showSlide(index) {
        // Update current slide index
        this.currentSlide = index;

        // Handle edge cases
        if (this.currentSlide >= this.totalSlides) {
            this.currentSlide = 0;
        } else if (this.currentSlide < 0) {
            this.currentSlide = this.totalSlides - 1;
        }

        // Update slides
        this.slides.forEach((slide, i) => {
            slide.style.display = i === this.currentSlide ? 'block' : 'none';
            slide.setAttribute('aria-hidden', i !== this.currentSlide);
        });

        // Update dots
        this.dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === this.currentSlide);
        });
    }

    nextSlide() {
        this.showSlide(this.currentSlide + 1);
    }

    prevSlide() {
        this.showSlide(this.currentSlide - 1);
    }

    startAutoPlay(interval = 5000) {
        if (this.autoPlayInterval) {
            clearInterval(this.autoPlayInterval);
        }
        this.autoPlayInterval = setInterval(() => this.nextSlide(), interval);

        // Pause on hover
        this.carousel.addEventListener('mouseenter', () => {
            clearInterval(this.autoPlayInterval);
        });

        // Resume on mouse leave
        this.carousel.addEventListener('mouseleave', () => {
            this.autoPlayInterval = setInterval(() => this.nextSlide(), interval);
        });
    }

    addTouchSupport() {
        let touchStartX = 0;
        let touchEndX = 0;

        this.carousel.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        this.carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe();
        }, { passive: true });

        // Handle swipe
        this.handleSwipe = () => {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    this.nextSlide(); // Swipe left
                } else {
                    this.prevSlide(); // Swipe right
                }
            }
        };
    }
}

// Initialize carousels when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const carousels = document.querySelectorAll('.carousel');
    carousels.forEach(carousel => new Carousel(carousel));
}); 