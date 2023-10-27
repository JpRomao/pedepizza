<?php
include_once './templates/head.php';
?>
<link rel="stylesheet" href="./css/home.css" />

<meta property="og:title" content="PedePizza" />
<title>PedePizza</title>
</head>

<body>
  <div id="root">
    <?php
    include_once './templates/header.php';
    ?>

    <main>
      <h1>PedePizza</h1>

      <div class="container" id="mainContainer">
        <h2 class="align-left margin-top-20 padding-left-right-20">Selecione os ingredientes:</h2>

        <div class="cards-container" id="cards">
          <img src="./img/loading.gif" alt="loading spinner" width="100px" />
        </div>

        <button class="btn align-self-right disabled" id="nextBtn">Próximo</button>
      </div>
    </main>

    <?php
    include_once './templates/footer.php';
    ?>
  </div>

  <script src="./js/index.js" type="module"></script>
</body>

</html>