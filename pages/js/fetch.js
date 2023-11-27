import {
  ingredientCardsSelection,
  selectCard,
  selectedCard,
  selectedIngredientCardsIds,
  setCards,
} from "./cards.js";
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
    for (let i = 0; i < selectedIngredientCardsIds.length; i++) {
      url += `&ingredients[]=${selectedIngredientCardsIds[i]}`;
    }
  } else if (type === "pizzerias") {
    url += `&pizzaId=${selectedCard}`;
  }

  const response = await fetch(url);

  if (response.status === 404) {
    alert("Not found");

    return null;
  }

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

  selectedIngredientCardsIds.length = 0;

  setCards(items);

  if (type === "ingredients") {
    ingredientCardsSelection();
  } else {
    selectCard();
  }

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
