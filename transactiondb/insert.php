<?php
require 'config.php';

if(isset($_POST['add_customer'])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $phonenumber = $_POST['phone_number'];

    $stmt = $pdo->prepare("INSERT INTO customers(first_name, last_name, phone_number) VALUES (?, ?, ?)");
    $stmt->execute([$fname, $lname, $phonenumber]);

    echo "Customer added successfully!";
}


if(isset($_POST['add_item'])) {
    $dish_name = $_POST['dish_name'];
    $price = $_POST['price'];
    $category = $_POST['category']; 

    $stmt = $pdo->prepare("INSERT INTO menuitems(dish_name, price, category) VALUES (?, ?, ?)");
    $stmt->execute([$dish_name, $price, $category]);

    echo "Menu item added successfully!";
}


if(isset($_POST['place_order'])) {
    $customer_id = $_POST['customer_id'];  
    $item_id = $_POST['item_id'];          
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("INSERT INTO orders(customer_id, item_id, order_date, quantity) VALUES (?, ?, NOW(), ?)");
    $stmt->execute([$customer_id, $item_id, $quantity]);

    echo "Order placed successfully!";
}
?>