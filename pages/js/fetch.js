import { selectedCardsIds, setCards } from "./cards.js";
import { nextButton } from "./nextButton.js";
import { baseUrl, apiUrl } from "./utils.js";

let page = 1;
let hasMoreItems = true;

async function fetchItems(type = "ingredients", hasReseted = false) {
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

  let url = apiUrl;

  url += `/${type}?start=${start}&end=${end}`;

  if (type === "pizzas") {
    for (let i = 0; i < selectedCardsIds.length; i++) {
      url += `&ingredients[]=${selectedCardsIds[i]}`;
    }
  } else if (type === "pizzerias") {
    url += `&pizzaId=${selectedCardsIds[0]}`;
  }

  const response = await fetch(url);

  const items = await response.json();

  if (items.length < limit) {
    hasMoreItems = false;
  }

  page++;

  return items;
}

export async function setItemsAtPage(type = "ingredients", hasReseted = false) {
  const { data: searchedItems } = await fetchItems(type, hasReseted);

  const items = searchedItems.map((item) => {
    return {
      ...item,
      image: `${baseUrl}/pages/assets/img/${type}/${item.image}`,
      ingredients: item.ingredients ? `${item.ingredients.join(", ")}` : null,
      timeToPrepare: item.timeToPrepare ? `${item.timeToPrepare}` : null,
    };
  });

  selectedCardsIds.length = 0;

  setCards(items);

  nextButton("pizzas");

  return items;
}

export async function setPizzeria() {
  const { data } = await fetchItems("pizzerias");

  return {
    pizzeria: data.pizzeria,
    pizza: data.pizza,
  };
}
