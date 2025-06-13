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
    <button onclick="window.location.href='admin1.html'" class="top-left">Go Back</button>
    <div class="search-container">
        <form method="POST" action="admin2.php" class="search-form">
            <input type="text" class="search-input" name="nif_product" placeholder="Product ID/Client NIF" required value="<?php echo htmlspecialchars($_POST['nif_product'] ?? ''); ?>" />
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