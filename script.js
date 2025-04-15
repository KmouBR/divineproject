const menuCloseButton = document.querySelector("#menu-close-button");
const menuOpenButton = document.querySelector("#menu-open-button");

menuOpenButton.addEventListener("click", () => {
    document.body.classList.toggle("show-mobile-menu");
});

menuCloseButton.addEventListener("click", () => menuOpenButton.click()); 