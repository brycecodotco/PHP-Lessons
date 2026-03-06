<?php
require 'config.php';

if (isset($_POST['update_customer'])) {
    $customer_id = $_POST['customer_id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];

    $stmt = $pdo->prepare("UPDATE customers SET first_name = ?, last_name = ?, phone_number = ? WHERE customer_id = ?");
    $stmt->execute([$fname, $lname, $phone_number, $customer_id]);

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

if (isset($_POST["update_item"])) {
    $item_id = $_POST['item_id'];
    $dish_name = $_POST["dish_name"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    $stmt = $pdo->prepare("UPDATE menuitems SET dish_name = ?, price = ?, category = ? WHERE item_id = ?");
    $stmt->execute([$dish_name, $price, $category, $item_id]);

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $customer_id = $_POST['customer_id'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("UPDATE orders SET customer_id = ?, item_id = ?, quantity = ? WHERE order_id = ?");
    $stmt->execute([$customer_id, $item_id, $quantity, $order_id]);

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}
?>