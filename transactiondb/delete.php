<?php
require 'config.php';

if(isset($_GET['delete_orders'])){
    $order_id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->execute([$order_id]);

    echo "Order deleted successfully";
}

if(isset($_GET['delete_customer'])){
    $customer_id = $_GET['delete_customer'];
    $stmt = $pdo->prepare("DELETE FROM customers WHERE customer_id = ?");
    $stmt->execute([$customer_id]);

    echo "Customer deleted successfully";
}

if(isset($_GET['delete_item'])){
    $item_id = $_GET['delete_item'];
    $stmt = $pdo->prepare("DELETE FROM menuitems WHERE item_id = ?");
    $stmt->execute([$item_id]);

    echo "Menu item deleted successfully";
}
