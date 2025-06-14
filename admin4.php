<?php
session_start();

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
    <title> Relearning HTML</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body class="general-body">
    <header class="site-header">
        <div class="logo">
            <a href="index.html">
      <img src="images/logo1.png">
      </a>
        </div>
        <div class="header-text-container">
            <h1>AREA UTILIZADOR</h1>
            <p>PREPARAR ENCOMENDA</p>
        </div>
    </header>
    <div class="top-left">
        <p><button onclick="window.location.href='admin1.php'" class="top-left">Go Back</button></p>
    </div>
    <div class="">
        <label for="searchID">Order Number</label><br>
        <input type="text" id="searchID">
        <br>
        <button type="button" style="margin-top:8px;">Search</button>
        <br>
        <button type="button" style="margin-top:8px;">Create</button>
    </div>
    <div class="product-container">
        <table border="1">
            <caption>Order Information</caption>
            <tr>
                <th>ORDER ID</th>
                <th>CLIENT</th>
                <th>STATUS</th>
            </tr>
            <tr>
                <td id="orderID">1234</td>
                <td id="client">Sell Thing ltd</td>
                <td id="status">Pending</td>
            </tr>
        </table>
    </div>
    </div>
    </div>
    <div class="retangle below-center">
        <table border="1">
            <caption>Products</caption>
            <tr>
                <th>CODE</th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>QUANTITY</th>
                <th>ADDED TO ORDER</th>
            </tr>
            <tr>
                <td>1we34</td>
                <td>box</td>
                <td>things in a box</td>
                <td>things in a box</td>
                <td><input type="checkbox" id="added1"></td>
            </tr>
            <tr>
                <td>1we34</td>
                <td>box</td>
                <td>things in a box</td>
                <td>things in a box</td>
                <td><input type="checkbox" id="added2"></td>
            </tr>
        </table>
        <div class="center">
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td><button type="button" id="preped">Prepared</button></td>
                    <td><button type="button" id="sent">Sent</button></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="button" id="cancel" class="center-td">Cancel Order</button></td>
                </tr>

            </table>
        </div>
    </div>
    <div class="retangle below-center">
        <form id="createOrderForm">
            <table border="1" id="orderProductsTable">
                <caption><strong>Create New Order</strong></caption>
                <tr>
                    <th>CODE</th>
                    <th>QUANTITY</th>
                </tr>
                <tr>
                    <td><input type="text" name="code[]" required></td>
                    <td><input type="number" name="quantity[]" min="1" required></td>
                </tr>
            </table>
            <div class="center" style="margin-top: 10px;">
                <button type="button" onclick="addProductRow()">Add Product</button>
            </div>
            <div class="center" style="margin-top: 10px;">
                <label for="clientName"><strong>Client Name:</strong></label>
                <input type="text" id="clientName" name="clientName" required>
            </div>
            <div class="center" style="margin-top: 10px;">
                <button type="submit" id="createOrder">Create Order</button>
            </div>
        </form>
    </div>
    <script>
    function addProductRow() {
        const table = document.getElementById('orderProductsTable');
        const row = table.insertRow(-1);
        row.innerHTML = `
            <td><input type="text" name="code[]" required></td>
            <td><input type="number" name="quantity[]" min="1" required></td>
        `;
    }
    </script>
</body>

</html>