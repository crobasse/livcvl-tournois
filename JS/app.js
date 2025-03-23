const switchTheme = document.getElementById("switchTheme");
const menuLogo = document.getElementById("menu-logo");

if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
  document.body.setAttribute("data-bs-theme", "dark");
  switchTheme.checked = true;
  menuLogo.setAttribute("src", "IMGS/logo.png");
} else {
  document.body.setAttribute("data-bs-theme", "light");
  switchTheme.checked = false;
  menuLogo.setAttribute("src", "IMGS/logo_dark.png");
}

window
  .matchMedia("(prefers-color-scheme: dark)")
  .addEventListener("change", (event) => {
    if (event.matches) {
      document.body.setAttribute("data-bs-theme", "dark");
      menuLogo.setAttribute("src", "IMGS/logo.png");
    } else {
      document.body.setAttribute("data-bs-theme", "light");
      menuLogo.setAttribute("src", "IMGS/logo_dark.png");
    }
  });

switchTheme.addEventListener("change", () => {
  if (switchTheme.checked) {
    document.body.setAttribute("data-bs-theme", "dark");
    menuLogo.setAttribute("src", "IMGS/logo.png");
  } else {
    document.body.setAttribute("data-bs-theme", "light");
    menuLogo.setAttribute("src", "IMGS/logo_dark.png");
  }
});
