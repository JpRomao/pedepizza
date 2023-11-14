<html lang="pt-BR">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="<?php echo FULL_PATH . '/views/assets/img/favicon.ico'; ?>" type="image/x-icon">

  <link rel="stylesheet" href="<?php echo FULL_PATH . '/views/styles/global.css'; ?>" />

  <?php
  if (isset($data["styles"]) && !empty($data["styles"])) {
    foreach ($data["styles"] as $style) {
      echo "<link rel='stylesheet' href='" . FULL_PATH . "/views/styles/$style.css' />";
    }
  }
  ?>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <meta name="description" content="<?php echo $data['description']; ?>" />
  <meta name="keywords" content="PedePizza, Pizzaria, Pizza, Delivery, Pizzaria Online" />
  <meta name="author" content="PedePizza" />

  <meta property="og:type" content="website" />
  <meta property="og:title" content="PedePizza" />
  <meta property="og:description" content="<?php echo $data['description']; ?>" />
  <meta property="og:image" content="<?php echo FULL_PATH . '/views/assets/img/logo.svg'; ?>" />
  <meta property="og:url" content="<?php echo FULL_PATH; ?>" />
  <meta property="og:site_name" content="PedePizza" />

  <meta name="twitter:title" content="PedePizza" />
  <meta name="twitter:description" content="<?php echo $data['description']; ?>" />
  <meta name="twitter:image" content="<?php echo '/views/assets/img/logo.svg'; ?>" />
  <meta name="twitter:card" content="summary_large_image" />

  <title><?php echo $data["title"]; ?></title>
</head>