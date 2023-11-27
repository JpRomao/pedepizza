import { changeElementDisplayByWindowsWidth } from "./utils.js";

function mountCard(cardInfo) {
  return `
    <div class="card" data-id=${cardInfo.id}>
      <img src="${cardInfo.image}" alt="${
    cardInfo.name
  }" width="200px" height="200px" />
      <div class="card-body">
        <h2>${cardInfo.name}</h2>
        ${
          cardInfo.ingredients
            ? `
              <p><strong>Ingredientes: </strong>${cardInfo.ingredients}</p>
              <p><strong>Tempo de preparo: </strong>${cardInfo.timeToPrepare} minutos</p>
            `
            : ""
        }
        ${
          cardInfo.address
            ? `
              <p><strong>Endereço: </strong>${cardInfo.address}</p>
              <p><strong>Telefone: </strong>${cardInfo.phone}</p>
            `
            : ""
        }
      </div>
    </div>
  `;
}

export const selectedIngredientCardsIds = [];

export function ingredientCardsSelection() {
  removeClickFromCards();

  const cards = document.querySelectorAll(".card");
  const nextButton = document.getElementById("nextBtn");

  cards.forEach((card) => {
    card.addEventListener("click", () => {
      if (selectedIngredientCardsIds.includes(card.getAttribute("data-id"))) {
        card.classList.remove("selected");

        selectedIngredientCardsIds.splice(
          selectedIngredientCardsIds.indexOf(card),
          2
        );

        if (selectedIngredientCardsIds.length < 1) {
          nextButton.classList.add("disabled");
        }
      } else {
        card.classList.add("selected");

        selectedIngredientCardsIds.push(card.getAttribute("data-id"));

        nextButton.classList.remove("disabled");
      }
    });
  });
}

export function setCards(cardsInfo) {
  const cardsContainer = document.getElementById("cards");

  cardsContainer.innerHTML = "";

  cardsInfo.forEach((cardInfo) => {
    cardsContainer.innerHTML += mountCard(cardInfo);
  });

  cardsContainer.style.justifyContent = "flex-start";

  changeElementDisplayByWindowsWidth(cardsContainer);

  window.addEventListener("resize", () => {
    changeElementDisplayByWindowsWidth(cardsContainer);
  });
}

export let selectedCard = null;

export function selectCard() {
  const cards = document.querySelectorAll(".card");

  cards.forEach((card) => {
    card.addEventListener("click", () => {
      if (selectedCard && selectedCard !== card.getAttribute("data-id")) {
        const selectedCardElement = document.querySelector(
          `[data-id="${selectedCard}"]`
        );

        selectedCardElement.classList.remove("selected");

        selectedCard = null;
      }

      if (selectedCard === card.getAttribute("data-id")) {
        card.classList.remove("selected");

        selectedCard = null;
      } else {
        card.classList.add("selected");

        selectedCard = card.getAttribute("data-id");
      }
    });
  });
}

export function removeClickFromCards() {
  const pizzeriaCards = document.querySelectorAll(".card");

  pizzeriaCards.forEach((pizzeriaCard) => {
    pizzeriaCard.removeEventListener("click", () => {});
  });
}
