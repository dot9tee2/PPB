// sidebar.js

export function initSidebar() {
  const nav = document.querySelector("nav");
  const sidebarClose = document.querySelector(".sidebarClose");
  const sidebarOpen = document.querySelector(".sidebarOpen");

  if (!nav || !sidebarClose || !sidebarOpen) return;

  sidebarOpen.addEventListener("click", () => {
    nav.classList.add("active");
  });

  sidebarClose.addEventListener("click", () => {
    nav.classList.remove("active");
  });
}
