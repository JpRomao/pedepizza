export const baseUrl = "http://localhost/TCC_REAL_OFICIAL/api";

export async function setAtPage(callback, type = "ingredients") {
  const data = await callback();

  const table = document.getElementById(type);
  const tbody = table.getElementsByTagName("tbody")[0];

  data.forEach((item) => {
    const tr = document.createElement("tr");

    const id = document.createElement("td");
    const name = document.createElement("td");
    const options = document.createElement("td");
    const optionsButton = document.createElement("button");

    id.innerText = item.id;
    name.innerText = item.name;
    optionsButton.innerText = "...";

    optionsButton.addEventListener("click", () => {
      const options = document.createElement("div");
      const edit = document.createElement("a");
      const remove = document.createElement("a");

      options.classList.add("options");
      edit.classList.add("edit");
      remove.classList.add("remove");

      edit.innerText = "Editar";
      remove.innerText = "Remover";

      let archive = type.substring(0, type.length - 1);

      edit.href = `${baseUrl}/edit-${archive}.php?id=${item.id}`;
      remove.href = `${baseUrl}/delete-${archive}.php?id=${item.id}`;

      options.appendChild(edit);
      options.appendChild(remove);

      optionsButton.appendChild(options);
    });

    options.appendChild(optionsButton);

    tr.appendChild(id);
    tr.appendChild(name);
    tr.appendChild(options);

    tbody.appendChild(tr);
  });
}

export function searchNearestTable(element) {
  if (element.tagName === "TABLE") {
    return element;
  }

  return searchNearestTable(element.nextElementSibling);
}
