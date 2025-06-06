<?php
// Produtos
$product_name    = $_POST['product_name'] ?? null;
$supplier        = $_POST['supplier'] ?? null;
$price           = $_POST['price'] ?? null;
$category        = $_POST['category'] ?? null;
$notes           = $_POST['notes'] ?? null;
$date            = $_POST['date'] ?? null;

// Clientes
$client_name     = $_POST['client_name'] ?? null;
$email           = $_POST['email'] ?? null;
$address         = $_POST['address'] ?? null;
$nif             = $_POST['nif'] ?? null;
$payment_method  = $_POST['payment_method'] ?? null;
$phone           = $_POST['phone'] ?? null;
$client_date     = $_POST['date'] ?? null;


$servername = "localhost";
$username = "datfonso25";
$password = "lasanha123";
$dbname = "deapc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!empty($product_name)) {
    $stmt = $conn->prepare("INSERT INTO products (name, supplier, price, category, notes, date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsss", $product_name, $supplier, $price, $category, $notes, $date);
    $stmt->execute();
    $stmt->close();
}

if (!empty($client_name)) {
    $stmt = $conn->prepare("INSERT INTO clients (name, email, address, nif, payment, phone, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $client_name, $email, $address, $nif, $payment_method, $phone, $client_date);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: /DEAPC/admin3.html");
exit();
?>