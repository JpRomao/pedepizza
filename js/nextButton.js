import { selectedCardsIds } from "./cards.js";
import { setItemsAtPage } from "./fetch.js";

export function nextButton(type = "ingredients") {
  const nextButtonElement = document.getElementById("nextBtn");
  const cardsContainer = document.getElementById("cards");
  const mainContainer = document.getElementById("mainContainer");

  const backButton = document.createElement("button");
  backButton.classList.add("btn");

  backButton.style.alignSelf = "flex-start";
  backButton.style.marginLeft = "18px";

  backButton.innerHTML = "Back";

  nextButtonElement.addEventListener("click", async () => {
    if (selectedCardsIds.length < 1) {
      return;
    }

    nextButtonElement.classList.add("disabled");

    cardsContainer.style.display = "flex";
    cardsContainer.innerHTML = `<img src="./img/loading.gif" alt="loading spinner" width="100px" />`;
    cardsContainer.style.justifyContent = "center";

    const h2 = mainContainer.querySelector("h2");
    h2.innerHTML = "Loading...";

    const items = await setItemsAtPage(type, true);
    type = "ingredients";

    h2.innerHTML =
      items.length > 0 ? "Aqui estão suas pizzas!" : "Nenhuma pizza encontrada";

    mainContainer.insertAdjacentElement("afterbegin", backButton);

    cardsContainer.style.justifyContent = "flex-start";

    nextButtonElement.remove();

    backButton.addEventListener("click", async () => {
      cardsContainer.innerHTML = `<img src="./img/loading.gif" alt="loading spinner" width="100px" />`;
      cardsContainer.style.justifyContent = "center";

      h2.innerHTML = "Loading...";

      backButton.insertAdjacentElement("afterend", h2);

      backButton.remove();

      cardsContainer.insertAdjacentElement("afterend", nextButtonElement);

      await setItemsAtPage(type, true);

      type = "recipes";

      h2.innerHTML = "Selecione seus ingredientes";

      cardsContainer.style.justifyContent = "flex-start";
    });
  });
}
