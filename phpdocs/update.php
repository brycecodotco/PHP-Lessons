<?php
require 'config.php';

if(isset($_POST['update'])){
    $users_id = $_POST['users_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $amount = $_POST['amount'];

    $stmt = $pdo->prepare("UPDATE users INNER JOIN orders on users.users_id = orders.user_id  
    SET users.name = ?, users.email = ?, orders.product = ?, orders.amount = ? WHERE users.users_id = ?");
    $stmt->execute([$name, $email, $product, $amount, $users_id]);
}
?>