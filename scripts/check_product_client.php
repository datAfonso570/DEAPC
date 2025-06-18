<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o utilizador está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Manda para o login 
    exit();
}

$nome = htmlspecialchars($_SESSION['username']);


$servername = "localhost";
$db_username = "datfonso25";
$db_password = "lasanha123";
$dbname = "deapc";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("<div class='error-message'>Connection failed: " . $conn->connect_error . "</div>");
}

$nif_idproduct = $_POST['nif_product'] ?? null;
$action = $_POST['action'] ?? null;
$message = "";
$table = '';
$id_field = '';
$row = null;

// Handle update
if ($action === "update" && isset($_POST['nif_product'])) {
    if (strlen($_POST['nif_product']) == 9) {
        $table = "clients";
        $id_field = "nif";
    } else {
        $table = "products";
        $id_field = "id";
    }
    $fields = [];
    $params = [];
    $types = "";
    foreach ($_POST as $key => $value) {
        if ($key !== 'action' && $key !== 'nif_product') {
            $fields[] = "$key=?";
            $params[] = $value;
            $types .= "s";
        }
    }
    $params[] = $_POST['nif_product'];
    $types .= "s";
    $sql = "UPDATE $table SET " . implode(",", $fields) . " WHERE $id_field=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        $message = "<div class='success-message'><strong>Updated successfully.</strong></div>";
        header("Location: admin2.php?msg=updated");
        exit();
    } else {
        $message = "<div class='error-message'>Update failed.</div>";
    }
}

// Handle delete
if ($action === "delete" && isset($_POST['nif_product'])) {
    if (strlen($_POST['nif_product']) == 9) {
        $table = "clients";
        $id_field = "nif";
    } else {
        $table = "products";
        $id_field = "id";
    }
    $sql = "DELETE FROM $table WHERE $id_field=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_POST['nif_product']);
    if ($stmt->execute()) {
        $message = "<div class='success-message'>Deleted successfully.</div>";
        header("Location: admin2.php?msg=deleted");
        exit();
    } else {
        $message = "<div class='error-message'>Delete failed.</div>";
    }
}

// Fetch and display row
if ($nif_idproduct && !$action) {
    if (strlen($nif_idproduct) == 9) {
        $stmt = $conn->prepare("SELECT * FROM clients WHERE nif = ?");
        $stmt->bind_param("s", $nif_idproduct);
        $table = 'clients';
        $id_field = 'nif';
    } else {
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("s", $nif_idproduct);
        $table = 'products';
        $id_field = 'id';
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

echo $message;

if ($row) {
    echo '<div class="dynamic-form">';
    echo '<form method="POST" action="check_product_client.php">';
    foreach ($row as $key => $value) {
        $readonly = ($key === $id_field) ? 'readonly' : '';
        echo "<div class='form-row'>";
        echo "<label for='" . htmlspecialchars($key) . "'>" . htmlspecialchars(ucfirst($key)) . ":</label>";
        echo "<input id='" . htmlspecialchars($key) . "' type='text' name='" . htmlspecialchars($key) . "' value='" . htmlspecialchars($value) . "' $readonly>";
        echo "</div>";
    }
    echo "<input type='hidden' name='nif_product' value='" . htmlspecialchars($nif_idproduct) . "'>";
    echo '<div class="form-actions">';
    echo '<button class="update" type="submit" name="action" value="update">Save Alterations</button>';
    echo '<button class="delete" type="submit" name="action" value="delete" onclick="return confirm(\'Are you sure you want to remove this record?\')">Remove</button>';
    echo '</div>';
    echo '</form></div>';
} elseif ($nif_idproduct && !$row && !$message) {
    echo '<div class="error-message"><strong>No record found.</strong></div>';
}
?>