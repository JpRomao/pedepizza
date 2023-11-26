export const baseUrl = window.location.origin + "/pedepizza"
export const apiUrl = `${baseUrl}/api`;

export function removeLastLetter(str) {
  return str.slice(0, -1);
}

export function isGridNeeded() {
  return window.innerWidth > 1049;
}

export function changeElementDisplayByWindowsWidth(element) {
  element.style.display = isGridNeeded() ? "grid" : "flex";
}
