import { baseUrl, setAtPage } from "./utils.js";

async function fetchIngredients() {
  const response = await fetch(baseUrl + "/ingredient/fetch-ingredients.php");

  const ingredients = await response.json();

  return ingredients;
}

setAtPage(fetchIngredients, "ingredients");
