// Wait for the DOM to be fully loaded before executing
document.addEventListener('DOMContentLoaded', () => {
  // Select the theme toggle button and the theme icon
  const themeToggle = document.querySelector(".theme-toggle");
  const themeIcon = document.querySelector(".theme-icon");

  // Check and apply the saved theme from localStorage
  const savedTheme = localStorage.getItem("theme");
  if (savedTheme) {
    document.body.classList.add(savedTheme); // Apply saved theme
    themeIcon.textContent = savedTheme === "dark" ? "🌙" : "🌞"; // Set icon accordingly
  }

  // Function to toggle between light and dark themes
  themeToggle.addEventListener("click", () => {
    if (document.body.classList.contains("dark")) {
      // Switch to light theme
      document.body.classList.remove("dark");
      themeIcon.textContent = "🌞";
      localStorage.setItem("theme", "light");
    } else {
      // Switch to dark theme
      document.body.classList.add("dark");
      themeIcon.textContent = "🌙";
      localStorage.setItem("theme", "dark");
    }
  });
});