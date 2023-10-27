import { baseUrl, setAtPage } from "./utils.js";

async function fetchPizzas() {
  const response = await fetch(baseUrl + "/pizza/fetch-pizzas.php");

  const ingredients = await response.json();

  return ingredients;
}

setAtPage(fetchPizzas, "pizzas");
