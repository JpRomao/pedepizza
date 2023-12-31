import { selectedIngredientCardsIds } from "./cards.js";
import { setItemsAtPage, setPizzeria } from "./fetch.js";
import { mountPizzeriaCard } from "./pizzeriaCard.js";
import { baseUrl } from "./utils.js";

export function nextButton(type = "ingredients") {
  const nextButtonElement = document.getElementById("nextBtn");
  const cardsContainer = document.getElementById("cards");
  const mainContainer = document.getElementById("mainContainer");

  const backButton = document.createElement("button");
  backButton.classList.add("btn");

  backButton.style.alignSelf = "flex-start";
  backButton.style.marginLeft = "18px";

  backButton.innerHTML = "Back";

  const toPizzeriaButton = document.createElement("button");
  toPizzeriaButton.classList.add("btn");

  toPizzeriaButton.innerHTML = "Ver pizzaria";

  toPizzeriaButton.style.alignSelf = "flex-end";
  toPizzeriaButton.style.marginLeft = "18px";

  let pizzeriaButtonInserted = false;

  nextButtonElement.addEventListener("click", async () => {
    if (selectedIngredientCardsIds.length < 1) {
      return;
    }

    nextButtonElement.classList.add("disabled");

    cardsContainer.style.display = "flex";
    cardsContainer.innerHTML = `<img src="${baseUrl}/pages/assets/img/loading.gif" alt="loading" width="100px" />`;
    cardsContainer.style.justifyContent = "center";

    const h2 = mainContainer.querySelector("h2");

    const items = await setItemsAtPage(type, true);
    type = "ingredients";

    h2.innerHTML =
      items.length > 0
        ? "Aqui estão suas pizzas!"
        : "Nenhuma pizza com esses ingredientes foi encontrada";

    mainContainer.insertAdjacentElement("afterbegin", backButton);

    cardsContainer.style.justifyContent = "flex-start";

    if (items && items.length > 0) {
      nextButtonElement.insertAdjacentElement("afterend", toPizzeriaButton);
      pizzeriaButtonInserted = true;
    }

    nextButtonElement.remove();

    backButton.addEventListener("click", async () => {
      cardsContainer.innerHTML = `<img src="${baseUrl}/pages/assets/img/loading.gif" alt="loading spinner" width="100px" />`;
      cardsContainer.style.justifyContent = "center";

      backButton.remove();

      cardsContainer.insertAdjacentElement("afterend", nextButtonElement);

      await setItemsAtPage(type, true);

      type = "pizzas";

      h2.innerHTML = "Selecione seus ingredientes";

      cardsContainer.style.justifyContent = "flex-start";

      toPizzeriaButton.remove();
    });

    if (pizzeriaButtonInserted) {
      toPizzeriaButton.addEventListener("click", async () => {
        const { pizza, pizzeria } = await setPizzeria();

        cardsContainer.innerHTML = "";

        const pizzeriaCard = mountPizzeriaCard(pizzeria, pizza);

        cardsContainer.innerHTML = pizzeriaCard;

        toPizzeriaButton.remove();
      });
    }
  });
}
