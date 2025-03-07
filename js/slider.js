// slider.js

export function initSlider() {
  const slides = document.querySelectorAll(".slide");
  const navDots = document.querySelectorAll(".nav-dot");
  const prevButton = document.querySelector(".prev");
  const nextButton = document.querySelector(".next");

  if (!slides.length || !navDots.length || !prevButton || !nextButton) return;

  let currentIndex = 0;

  const updateSlider = (index) => {
    document.querySelector(".slides").style.transform = `translateX(-${
      index * 100
    }%)`;
    slides.forEach((slide, i) => slide.classList.toggle("active", i === index));
    navDots.forEach((dot) => dot.classList.remove("active"));
    navDots[index].classList.add("active");
  };

  const showNextSlide = () => {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlider(currentIndex);
  };

  const showPrevSlide = () => {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    updateSlider(currentIndex);
  };

  nextButton.addEventListener("click", showNextSlide);
  prevButton.addEventListener("click", showPrevSlide);

  navDots.forEach((dot, index) => {
    dot.addEventListener("click", () => {
      currentIndex = index;
      updateSlider(currentIndex);
    });
  });

  setInterval(showNextSlide, 5000); // Auto-slide every 5 seconds
}
