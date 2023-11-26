<body>
  <div id="root">
    <?php
    $links = [
      'index.php' => 'Home',
      'about.php' => 'Sobre nós',
      'contact.php' => 'Contato'
    ];
    ?>

    <header>
      <nav>
        <div class="navbar">
          <img src="./img/logo.svg" alt="logo image" />

          <ul>
            <?php
            foreach ($links as $link => $label) {
              echo "<li><a href='$link'>$label</a></li>";
            }
            ?>
          </ul>
        </div>
      </nav>
    </header>