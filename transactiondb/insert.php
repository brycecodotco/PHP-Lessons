<?php

require 'config.php';

if(isset($_POST['add'])) {

    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $phonenumber = $_POST['phone_number'];
    

    //Insert into users
    $stmt = $pdo->prepare("INSERT INTO customers(first_name,last_name,phone_number) VALUES (?,?,?)");
    $stmt->execute([$fname,$lname,$phonenumber]);

    //Get the last inserted users_id
    $users_id = $pdo->lastInsertId();

    //Insert into orders using that users_id
    $stmt2 = $pdo->prepare("INSERT INTO orders(user_id, product, amount) VALUES (?, ? ,?)");
    $stmt2->execute([$users_id,$product,$amount]);

    echo "User and Order added successfully!";
}
?>