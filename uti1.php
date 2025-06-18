<?php
session_start();

// Verifica se o utilizador está autenticado
if (!isset($_SESSION['username'])) {
  header("Location: index.html"); // Manda para o login 
  exit();
}

$nome = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Área de Utilizador</title>
  <link rel="stylesheet" href="styles/style.css" />
</head>

<body>
  <header class="site-header">
    <div class="logo">
      <img src="images/logo1.png" alt="Logo">
    </div>
    <strong class="header-text-container">USER AREA</strong>
  </header>

  <header class="User-header">
    <p><b>User:</b> <?= $nome ?>
    <button onclick="location.href='scripts/logout.php'">Logout</button></p>
  </header>

  <div class="user-area">
    <h2>Selecionar:</h2>

    <div class="botoes">
      <button onclick="location.href='uti2.php'">Manage Order</button>
      <p><button onclick="location.href='uti3.php'">Verify Stock/Customer</button></p>
      <button onclick="location.href='index.html'">Return to Home</button>
    </div>
  </div>
</body>

</html>