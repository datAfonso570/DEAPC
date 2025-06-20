<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Verifica se o utilizador está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Manda para o login 
    session_destroy();
    exit();
}

$nome = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Check Product/Client</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <header class="site-header">
        <div class="logo">
            <a href="index.html">
                <img src="images/logo1.png">
            </a>
        </div>
        <div class="header-text-container">
            <h1>ADMIN AREA</h1>
            <p>STOCK/CLIENT MANAGEMENT</p>
        </div>
    </header>

     <header class="User-header">
    <p><b>User:</b> <?= $nome ?>
    <button onclick="location.href='scripts/logout.php'">Logout</button></p>
  </header>
  
   <div style="text-align:left;">
    <button onclick="window.location.href='admin1.php'" class="go-back-btn">Go Back</button>
</div>
    <div class="search-container">
        <form method="POST" action="admin2.php" class="search-form">
            <input type="text" class="search-input" name="nif_product" placeholder="Product ID/Client NIF" required
                value="<?php echo htmlspecialchars($_POST['nif_product'] ?? ''); ?>" />
            <button type="submit" class="search-button">&#128269; Search</button>
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nif_product'])) {
        include 'check_product_client.php';
    }
    ?>
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
        <div class="success-message">Updated successfully.</div>
    <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <div class="success-message">Deleted successfully.</div>
    <?php endif; ?>
</body>

</html>