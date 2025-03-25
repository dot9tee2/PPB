// slider.js

export function initSlider() {
  const slides = document.querySelectorAll(".slide");
  const navDots = document.querySelectorAll(".nav-dot");
  const prevButton = document.querySelector(".prev");
  const nextButton = document.querySelector(".next");

  if (!slides.length || !navDots.length || !prevButton || !nextButton) return;

  let currentIndex = 0;

  const updateSlider = (index) => {
    const slidesContainer = document.querySelector(".slides");
    if (slidesContainer) {
      slidesContainer.style.transform = `translateX(-${index * 100}%)`;
      
      // Update active class for slides
      slides.forEach((slide, i) => {
        if (i === index) {
          slide.classList.add("active");
        } else {
          slide.classList.remove("active");
        }
      });
      
      // Update active class for nav dots
      navDots.forEach((dot, i) => {
        if (i === index) {
          dot.classList.add("active");
        } else {
          dot.classList.remove("active");
        }
      });
    }
  };

  const showNextSlide = () => {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlider(currentIndex);
  };

  const showPrevSlide = () => {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    updateSlider(currentIndex);
  };

  // Initialize the first slide
  updateSlider(currentIndex);

  // Add event listeners
  nextButton.addEventListener("click", showNextSlide);
  prevButton.addEventListener("click", showPrevSlide);

  navDots.forEach((dot, index) => {
    dot.addEventListener("click", () => {
      currentIndex = index;
      updateSlider(currentIndex);
    });
  });

  // Auto-slide every 5 seconds
  const autoSlideInterval = setInterval(showNextSlide, 5000);
  
  // Pause auto-slide when hovering over the slider
  const slidesContainer = document.querySelector(".testimonials-slider");
  if (slidesContainer) {
    slidesContainer.addEventListener("mouseenter", () => {
      clearInterval(autoSlideInterval);
    });
    
    slidesContainer.addEventListener("mouseleave", () => {
      setInterval(showNextSlide, 5000);
    });
  }
}
