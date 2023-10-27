import { searchNearestTable } from "./utils.js";

const minimizeButtons = document.querySelectorAll(".minimize-btn");

minimizeButtons.forEach((minimizeButton) => {
  minimizeButton.addEventListener("click", () => {
    const table = searchNearestTable(minimizeButton);

    table.classList.toggle("minimized");

    if (table.classList.contains("minimized")) {
      minimizeButton.innerHTML = "+";
    } else {
      minimizeButton.innerHTML = "-";
    }
  });
});
