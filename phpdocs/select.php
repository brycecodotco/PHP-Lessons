<?php
require 'config.php';

$stmt = $pdo->query("SELECT users.users_id, users.name, users.email, orders.product, orders.amount  FROM users
                     INNER JOIN orders ON users.users_id = orders.user_id;");
$users = $stmt->fetchall(PDO::FETCH_ASSOC);
?>