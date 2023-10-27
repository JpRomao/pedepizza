function mountCard(cardInfo) {
  return `
    <div class="card" data-id=${cardInfo.id}>
      <img src="${cardInfo.image}" alt="${cardInfo.name}" width="200px" height="200px" />

      <div class="card-body">
        <h2>${cardInfo.name}</h2>
      </div>
    </div>
  `;
}

export const selectedCardsIds = [];

export function cardsSelection() {
  const cards = document.querySelectorAll(".card");
  const nextButton = document.getElementById("nextBtn");

  cards.forEach((card) => {
    card.addEventListener("click", () => {
      if (selectedCardsIds.includes(card.getAttribute("data-id"))) {
        card.classList.remove("selected");

        selectedCardsIds.splice(selectedCardsIds.indexOf(card), 2);

        if (selectedCardsIds.length < 1) {
          nextButton.classList.add("disabled");
        }
      } else {
        card.classList.add("selected");

        selectedCardsIds.push(card.getAttribute("data-id"));

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

  cardsSelection();
}
