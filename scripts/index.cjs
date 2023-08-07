const nav = document.querySelector("nav");

//calls when page loads
updateColors();

//change navbar color when scroll starts
window.addEventListener("scroll", () => {
  var scrollPosition = window.scrollY;
  if (scrollPosition > 0) {
    nav.style.backgroundColor = "white";
    nav.querySelectorAll("a").forEach((link) => {
      link.style.color = "var(--black)";
    });

    const button = nav.querySelector("button");

    if (button) {
      button.style.backgroundColor = "var(--blue)";
      button.style.color = "var(--white)";
    }
  } else {
    updateColors();
  }
});

//makes the navbar transparent
function updateColors() {
  nav.style.backgroundColor = "transparent";
  nav.querySelectorAll("a").forEach((link) => {
    link.style.color = "var(--white)";
  });

  const button = nav.querySelector("button");
  if (button) {
    button.style.backgroundColor = "var(--white)";
    button.style.color = "var(--blue)";
  }
}
