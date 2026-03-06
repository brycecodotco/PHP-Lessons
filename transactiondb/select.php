<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM customers");
$customers = $stmt->fetchall(PDO::FETCH_ASSOC);

$stmt2 = $pdo->query("SELECT orders.order_id, CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name,
                     menuitems.dish_name, (menuitems.price * orders.quantity) AS total_price, 
                     orders.order_date FROM orders JOIN customers 
                     ON orders.customer_id = customers.customer_id JOIN menuitems ON orders.item_id = menuitems.item_id");
$orders = $stmt2->fetchall(PDO::FETCH_ASSOC);

$stmt3 = $pdo->query("SELECT * FROM menuitems");
$menuItems = $stmt3->fetchall(PDO::FETCH_ASSOC);

?>