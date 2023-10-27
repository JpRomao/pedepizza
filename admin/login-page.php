<title>Admin - Login</title>
</head>

<?php
include_once './templates/head.php';

if (isset($_COOKIE['key'])) {
  header('Location: index.php');
}
?>

<body>
  <main>
    <h1>Admin - Login</h1>

    <div>
      <form action="login.php" method="post">
        <div>
          <label for="username">Username</label>
          <input type="text" name="username" id="username" required>
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required>
        </div>
        <div>
          <button type="submit">Login</button>
        </div>
      </form>
    </div>
  </main>
</body>
