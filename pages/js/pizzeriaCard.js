import { baseUrl } from "./utils.js";

export function mountPizzeriaCard(pizzeria, pizza) {
  const text = `Gostaria de pedir uma pizza de ${pizza.name}, por favor!
  Meu endereço é: `;
  const textUrlEncoded = encodeURI(text);

  return `
      <div class="card pizzeria-card" data-id=${pizzeria.id}>
        <img src="${baseUrl}/pages/assets/img/pizzerias/${pizzeria.image}" alt="${pizzeria.name}" width="200px" height="200px" />

        <div class="card-body">
          <h2>${pizzeria.name}</h2>
          <p><strong>Telefone: </strong>${pizzeria.phone}</p>
          <p><strong>Email: </strong>${pizzeria.email}</p>
        </div>

        <div class="card-footer">
          <a class="btn" href="https://wa.me/55${pizzeria.phone}?text=${textUrlEncoded}" target="_blank">Chamar no whatsapp</a>
        </div>
      </div>
    `;
}
