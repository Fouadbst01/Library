let menucomp = document.querySelector("#menu-icon");
let navbarcomp = document.querySelector(".navbar");

export const menu = (menucomp.onclick = () => {
  navbarcomp.classList.toggle("active");
});

export const window = (window.onscroll = () => {
  navbarcomp.classList.remove("active");
});
