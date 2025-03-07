// preloader.js

export function showPreloader() {
  const preloader = document.querySelector(".preloader");
  if (preloader) {
    preloader.style.display = "flex";
    document.body.style.overflow = "hidden"; // Prevent scrolling
  }
}

export function hidePreloader() {
  setTimeout(() => {
    const preloader = document.querySelector(".preloader");
    if (preloader) {
      preloader.style.opacity = "0";
      setTimeout(() => {
        preloader.style.display = "none";
        document.body.style.overflow = "auto"; // Enable scrolling
      }, 500);
    }
  }, 2000);
}
