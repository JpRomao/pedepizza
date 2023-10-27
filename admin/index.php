<?php
include_once './templates/head.php';
?>
<link rel="stylesheet" href="./css/home.css">
<!-- <link rel="stylesheet" href="./css/pizza.css"> -->

<title>Admin</title>
</head>

<body>
  <main>
    <h1>Admin - Dashboard</h1>

    <div class="container">
      <div id="ingredientsContainer" class="content-container">
        <h2>Ingredientes</h2>

        <button class="minimize-btn">-</button>

        <p aria-labelledby="ingredients-table" hidden>Ingredientes para pizza</p>
        <table id="ingredients" aria-describedby="ingredients-table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nome</th>
              <th>
                <button>+</button>
              </th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

      <div id="pizzasContainer" class="content-container">
        <h2>Pizzas</h2>

        <button class="minimize-btn">-</button>

        <p aria-labelledby="ingredients-table" hidden>Ingredientes para pizza</p>
        <table id="pizzas" aria-describedby="ingredients-table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nome</th>
              <th>
                <button>+</button>
              </th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <script src="./js/ingredients.js" type="module"></script>
  <script src="./js/pizzas.js" type="module"></script>
  <script src="./js/minimize.js" type="module"></script>
</body>