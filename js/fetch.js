import { selectedCardsIds, setCards } from "./cards.js";
import { nextButton } from "./nextButton.js";
import { baseUrl, removeLastLetter } from "./utils.js";

let page = 1;
let hasMoreItems = true;

async function fetchItems(type = "pizzas", hasReseted = false) {
  if (hasReseted) {
    page = 1;
    hasMoreItems = true;
  }

  if (!hasMoreItems) {
    return [];
  }

  const limit = 10;

  const start = (page - 1) * limit;
  const end = start + limit;

  let url = "";

  if (type !== "recipes") {
    url = new URL(
      baseUrl +
        `/${removeLastLetter(type)}/fetch-${type}.php?start=${start}&end=${end}`
    );
  } else {
    url += new URL(
      baseUrl +
        `/${removeLastLetter(
          type
        )}/fetch-pizzas-by-ingredients.php?ingredientsIds=${
          selectedCardsIds.length > 0 ? selectedCardsIds.join(",") : ""
        }&start=${start}&end=${end}`
    );
  }

  const response = await fetch(url);

  const pizzas = await response.json();

  if (pizzas.length < limit) {
    hasMoreItems = false;
  }

  page++;

  return pizzas;
}

export async function setItemsAtPage(type = "ingredients", hasReseted = false) {
  const searchedItems = await fetchItems(type, hasReseted);

  if (type === "recipes") {
    type = "pizzas";
  }
  const items = searchedItems.map((item) => {
    return {
      ...item,
      image: `./img/${type}/${item.image}`,
    };
  });

  selectedCardsIds.length = 0;

  setCards(items);

  nextButton("recipes");

  return items;
}
