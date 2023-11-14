<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <main>
    <div id="client-type">
      <button>Cliente</button>
      <button>Pizzaria</button>
    </div>

    <form action="./api/login/login.php?type=" method="POST">
      <input type="text" name="username" placeholder="Username" />
      <input type="password" name="password" placeholder="Password" />

      <button type="submit">Login</button>
    </form>

    <div>
      <p>Not registered yet? <a href="./register.php">Register here</a></p>
    </div>
  </main>

  <script src="<?php echo FULL_PATH . '/views/js/login.js' ?>"></script>
</body>

</html>