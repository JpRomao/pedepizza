export const baseUrl = "http://localhost/TCC_REAL_OFICIAL/api";

export function removeLastLetter(str) {
  return str.slice(0, -1);
}

export function changeElementDisplayByWindowsWidth(element) {
  const isGridNeeded = window.innerWidth > 768;

  element.style.display = isGridNeeded ? "grid" : "flex";
}
