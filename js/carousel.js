// carousel.js

export function initCarousel() {
  const carousel = document.querySelector(".carousel-container");
  if (!carousel) return;

  const images = carousel.querySelectorAll(".carousel-image");
  const thumbnails = document.querySelectorAll(
    ".carousel-thumbnails .thumbnail"
  );
  const prevButton = document.querySelector(".carousel-prev");
  const nextButton = document.querySelector(".carousel-next");

  let currentIndex = 0;

  if (images.length === 0) {
    console.warn("No carousel images found.");
    return;
  }

  function showImage(index) {
    images.forEach((img, i) => img.classList.toggle("active", i === index));
    thumbnails.forEach((thumb, i) =>
      thumb.classList.toggle("active", i === index)
    );
  }

  if (prevButton) {
    prevButton.addEventListener("click", () => {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      showImage(currentIndex);
    });
  }

  if (nextButton) {
    nextButton.addEventListener("click", () => {
      currentIndex = (currentIndex + 1) % images.length;
      showImage(currentIndex);
    });
  }

  thumbnails.forEach((thumb) => {
    thumb.addEventListener("click", () => {
      currentIndex = parseInt(thumb.dataset.index);
      showImage(currentIndex);
    });
  });

  setInterval(() => {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
  }, 5000);
}
