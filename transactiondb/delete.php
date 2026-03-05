<?php
require 'config.php';

if(isset($_GET['delete'])){
    $users_id = $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->execute([$users_id]);
}