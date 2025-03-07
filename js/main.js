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
